<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Orden;
use App\OrdenItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PaypalController extends Controller {
    private $_api_context;

    public function __construct() {
        $this->middleware('auth');
        // setup PayPal api context
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment() {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items = array();
        $subtotal = 0;
        $carrito = \Session::get('carrito');
        $currency = 'MXN';

        foreach($carrito as $producto){
            $item = new Item();
            $item->setName($producto['nombre'])
            ->setCurrency($currency)
            ->setDescription($producto['codigo_barras'])
            ->setQuantity($producto['cantidad'])
            ->setPrice($producto['precio']);

            $items[] = $item;
            $subtotal += $producto['cantidad'] * $producto['precio'];
        }
        $item = new Item();
        $item->setName('Costo de Envío')
            ->setCurrency($currency)
            ->setDescription('00')
            ->setQuantity(1)
            ->setPrice(100);
        $items[] = $item;
        $subtotal += 100;

        $item_list = new ItemList();
        $item_list->setItems($items);

        $taxes = bcdiv(bcmul(16, $subtotal, 2), 100, 2);
        $details = new Details();
        $details->setSubtotal($subtotal)
        ->setShipping(0)
        ->setTax($taxes);

        $total = $subtotal + $taxes;

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Pedido de prueba en mi Laravel App Store');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(\URL::route('payment.status'))
            ->setCancelUrl(\URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Ups! Algo salió mal');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        \Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            // redirect to paypal
            return \Redirect::away($redirect_url);
        }

        return \Redirect::route('carrito')
            ->with('error', 'Ups! Error desconocido.');
    }

    public function getPaymentStatus() {
        // Get the payment ID before session clear
        $payment_id = \Session::get('paypal_payment_id');

        // clear the session payment ID
        \Session::forget('paypal_payment_id');

        $payerId = Input::get('PayerID');
        $token = Input::get('token');

        //if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
        if (empty($payerId) || empty($token)) {
            return \Redirect::route('inicio')
                ->with('message', 'Hubo un problema al intentar pagar con Paypal');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made
            // Registrar el pedido --- ok
            // Registrar el Detalle del pedido  --- ok
            // Eliminar carrito
            // Enviar correo a user
            // Enviar correo a admin
            // Redireccionar

            $this->saveOrder(\Session::get('carrito'));

            $carrito = \Session::get('carrito');

            \Session::forget('carrito');

            $this->printInvoice($carrito);

            return \Redirect::route('index')
                ->with('message', 'Compra realizada de forma correcta');
        }
        return \Redirect::route('inicio')
            ->with('error_message', 'La compra fue cancelada');
    }

    private function saveOrder($carrito) {
        $subtotal = 0;

        foreach($carrito as $item){
            $subtotal += $item->precio * $item->cantidad;
        }

        $order = Orden::create([
            'subtotal' => $subtotal,
            'gasto_envio' => 100,
            'id_usuario' => Auth::user()['id']
        ]);

        foreach($carrito as $item){
            $this->saveOrderItem($item, $order->id);
        }
    }

    private function saveOrderItem($item, $order_id) {
        OrdenItem::create([
            'cantidad' => $item->cantidad,
            'precio' => $item->precio,
            'id_producto' => $item->id,
            'id_orden' => $order_id
        ]);
    }

    private function printInvoice($carrito) {
        $invoice = \ConsoleTVs\Invoices\Classes\Invoice::make('Factura');
        foreach($carrito as $producto) {
            $invoice = $invoice->addItem($producto['nombre'], $producto['precio'], $producto['cantidad'], $producto['codigo_barras']);
        }

        $destinationPath = '/invoices/'.Auth::user()->id.'.pdf';
        $completePath = $destinationPath;

        $invoice = $invoice->addItem('Costo de envío', 100.00, 1, 00)
            ->number(4021)
            ->tax(16)
            ->notes('Salida la mercancía no se aceptan devoluciones.')
            ->customer([
                'name' => Auth::user()->name,
                'id' => Auth::user()->id,
                'location' => Auth::user()->direccion,
            ])
            ->save($completePath);
    }
}
