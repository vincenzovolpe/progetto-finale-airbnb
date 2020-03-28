<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type='text/javascript' src={{ asset('assets/js/mobile-or-tablet.js')}}></script>
    <script type='text/javascript' src={{ asset('assets/js/formatters.js')}}></script>
    <!-- Include Handlebars from a CDN -->
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Istok+Web:400,700&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel='stylesheet' type='text/css' href="{{asset('assets/ui-library/index.css')}}"/>

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">
</head>
<body>
        <main>
            <div id="homepicture" class="container-fluid">
                @include('layouts.partials.publicnavbar')
                @yield('searchbox')
                @yield('login-content')
                @yield('reset_box')
                @yield('reset_confirm_box')
                @yield('page_404')
            </div>
            @yield('content')
        </main>
        <footer>
            @include('layouts.partials.footer')
        </footer>
</body>
</html>
