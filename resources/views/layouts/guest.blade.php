<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>PARMISI | Pengadilan Agama Barabai</title>
        <link rel="icon" href="/parmisi/favicon.png?v=2" type="image/png">
        <link rel="apple-touch-icon" sizes="180x180" href="/parmisi/logo-aplikasi.png?v=3">
        <link rel="icon" sizes="192x192" href="/parmisi/logo-aplikasi.png?v=3">
        <link rel="manifest" href="/parmisi/manifest.json">

        <meta name="theme-color" content="#10b981">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('manual_assets/app.css') }}">

        <script src="/parmisi/manual_assets/app.js" defer></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-emerald-600 to-green-900 relative overflow-hidden">
            
            <div class="absolute top-0 left-0 -mt-20 -ml-20 w-64 h-64 rounded-full bg-white opacity-5"></div>
            <div class="absolute bottom-0 right-0 -mb-20 -mr-20 w-80 h-80 rounded-full bg-white opacity-5"></div>

            <div class="z-10 mb-6 flex flex-col items-center">
                <div class="p-3 bg-white rounded-full shadow-xl mb-4">
                    <a href="/parmisi">
                        <img src="/parmisi/logo.png" alt="Logo" class="w-20 h-20 object-contain">
                    </a>
                </div>
                <h2 class="text-white text-2xl font-bold tracking-wider uppercase text-center shadow-sm">
                    PARMISI
                </h2>
                <p class="text-green-100 text-xs font-medium tracking-widest uppercase mt-1">
                    Pengadilan Agama Barabai
                </p>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-2xl z-10 border border-gray-100">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center z-10">
                <p class="text-green-100/60 text-xs">
                    &copy; {{ date('Y') }} Pengadilan Agama Barabai. All rights reserved.
                </p>
            </div>
        </div>
    </body>
</html>