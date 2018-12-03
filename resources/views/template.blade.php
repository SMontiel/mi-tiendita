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
          @include('menu')
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
