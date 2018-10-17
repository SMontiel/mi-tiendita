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
            margin: 15px;
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
      <div>
        @include('menu')
        @yield('content')
        @include('footer')
      </div>
      <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
