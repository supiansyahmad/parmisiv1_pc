<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <body class="font-sans antialiased">
        
        <div class="min-h-screen bg-gradient-to-br from-emerald-600 to-green-900 relative">
            
            <div class="fixed top-0 left-0 -mt-20 -ml-20 w-96 h-96 rounded-full bg-white opacity-5 pointer-events-none blur-3xl"></div>
            <div class="fixed bottom-0 right-0 -mb-20 -mr-20 w-96 h-96 rounded-full bg-white opacity-5 pointer-events-none blur-3xl"></div>

            <div class="relative z-10">
                
                @include('layouts.navigation')

                @if (isset($header))
                    <header class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
                        <div class="bg-white/95 backdrop-blur-sm shadow-lg rounded-xl border border-white/20 py-6 px-6">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <main>
                    {{ $slot }}
                </main>
                
                <div class="pb-6 text-center text-emerald-100/60 text-xs mt-8">
                    &copy; {{ date('Y') }} Pengadilan Agama Barabai | PARMISI
                </div>
            </div>
        </div>
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif
    </body>
</html>