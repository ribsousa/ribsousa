<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        
        <!-- CSRF-TOKEN -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>
    <body>
        
        <div id="app">
            <router-view></router-view>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>

    </body>
</html>
