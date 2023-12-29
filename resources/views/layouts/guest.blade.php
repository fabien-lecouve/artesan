<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Artesan | @yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body id="body">
        
        <div id="guest-container">
            <img id="artesan_logo" src="{{ asset('storage/images/artesan.png') }}" alt="Logo de Art-e-san">
            @yield('content')
        </div>

        <div id="background_image">
            <h1>ART-E-SAN</h1>
            <p>L'outil informatique de création de devis en ligne</p>
        </div>

    </body>
</html>
