<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') &middot; Don Balón</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
        .ex1 .bump {
            float: left;
            margin: 10px;
            -webkit-transition: margin 0.5s ease-out;
            -moz-transition: margin 0.5s ease-out;
            -o-transition: margin 0.5s ease-out;
        }

        .ex1 .bump:hover {
            margin-top: 2px;
        }
        </style>

    </head>
    <body>
      <div class="min-h-screen flex flex-col font-sans">
        <div class="flex-grow">
          @include('admin.menu')

          <!-- will be used to show any messages -->
          @if (Session::has('message'))
            <div class="flex justify-center items-center bg-secondary text-soft-black text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p>{{ Session::get('message') }}</p>
            </div>
          @endif

          @yield('content')
        </div>

        @include('footer')
      </div>

      <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

      <script type="text/javascript">
        const buttons = document.querySelectorAll('.btn-update-item');
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].onclick = function(e) {
                console.log('Hello');

                e.preventDefault();

                var id = this.getAttribute('data-id');
                var href = this.getAttribute('data-href');
                var cantidad = document.getElementById('producto_' + id).value;
                window.location.href = href + "/" + cantidad;
            };
        }
      </script>
    </body>
</html>
