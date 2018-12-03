<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'ProductoController@all');

Route::get('/detalles-producto/{id}', 'ProductoController@showProduct');

Route::get('/agregar-a-carrito/{producto}',[
    'as'=>'carrito-agregar',
    'uses'=>'CarritoController@add'
]);

Route::get('carrito',[
    'as'=>'carrito',
    'uses'=>'CarritoController@show'
]);

Route::get('carritoShow/borrar/{producto}',[
    'as'=>'carrito-borrar',
    'uses'=>'CarritoController@remove'
]);

Route::get('vaciar-carrito/',[
    'as'=>'carrito-vaciar',
    'uses'=>'CarritoController@removeAll'
]);

Route::get('carrito/actualizar/{producto}/{cantidad?}',[
    'as'=>'carrito-actualizar',
    'uses'=>'CarritoController@update'
]);

/*Route::get('/test', function () {
    return view('child');
});*/
