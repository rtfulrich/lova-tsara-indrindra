<!DOCTYPE html>
<html lang="{{-- str_replace('_', '-', app()->getLocale()) --}}mg">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @hasSection('title')
            <title>@yield('title')</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://rsms.me/inter/inter.css"> --}}
        <link rel="stylesheet" href="{{ asset('fonts/interfonts/inter.css') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        @livewireStyles
        @stack('css')

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="{{ mix('js/app.js') }}"></script>
        
    </head>

    <body>
        @yield('body')

        @livewireScripts
        @stack('js')
        
    </body>
</html>
