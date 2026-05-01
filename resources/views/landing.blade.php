<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PARMISI | Pengadilan Agama Barabai</title>
    <link rel="icon" href="/parmisi/favicon.png?v=2" type="image/png">
    <link rel="apple-touch-icon" sizes="180x180" href="/parmisi/logo-aplikasi.png?v=3">
    <link rel="icon" sizes="192x192" href="/parmisi/logo-aplikasi.png?v=3">
    <link rel="manifest" href="/parmisi/manifest.json">

    <meta name="theme-color" content="#10b981">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('manual_assets/app.css') }}">

    <script src="/parmisi/manual_assets/app.js" defer></script>
    
    <meta http-equiv="refresh" content="60">
</head>
<body class="antialiased bg-gradient-to-br from-emerald-600 to-green-900 min-h-screen flex flex-col relative selection:bg-green-300 selection:text-green-900 overflow-x-hidden">

    <div class="fixed top-0 left-0 -mt-20 -ml-20 w-96 h-96 rounded-full bg-white opacity-5 pointer-events-none z-0 blur-3xl"></div>
    <div class="fixed bottom-0 right-0 -mb-20 -mr-20 w-96 h-96 rounded-full bg-white opacity-5 pointer-events-none z-0 blur-3xl"></div>

    <header class="bg-white/95 backdrop-blur-sm shadow-md border-b border-white/10 w-full z-20 sticky top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-center justify-center sm:justify-start">
                <img src="/parmisi/logo.png" onerror="this.style.display='none'" alt="Logo" class="h-[50px] sm:h-[55px] w-auto mb-0 mr-4 object-contain drop-shadow-sm">
                
                <div class="text-left">
                    <h2 class="font-extrabold text-lg sm:text-2xl text-gray-800 leading-tight uppercase tracking-tight">
                        Pengadilan Agama Barabai
                    </h2>
                    <p class="text-xs sm:text-sm text-emerald-600 font-bold tracking-[0.2em] uppercase mt-0.5">
                        Kelas IB
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow flex flex-col items-center justify-start py-12 px-4 sm:px-6 lg:px-8 z-10">
        <div class="max-w-7xl w-full">
            
            <div class="text-center mb-12"> 
                <div class="flex items-center justify-center gap-3 sm:gap-5 mb-4">
                    
                    <img src="/parmisi/logo-aplikasi.png" alt="Logo App" class="h-16 sm:h-24 w-auto object-contain drop-shadow-lg">
                    
                    <h1 class="text-5xl sm:text-7xl font-black text-white tracking-tight drop-shadow-lg">
                        PARMISI
                    </h1>
                </div>
                <p class="text-lg sm:text-xl text-green-100 font-medium drop-shadow-md">
                    (PA Barabai Manajemen Izin Secara Online)
                </p>
                <p class="text-lg sm:text-xl text-green-100 font-medium drop-shadow-md">
                    Sistem Informasi Izin Keluar Kantor
                </p>

                </div>
                
                <div class="my-10 flex justify-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-3 bg-white text-emerald-700 border border-transparent rounded-full font-bold text-sm uppercase tracking-widest hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-emerald-600 shadow-xl transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                Masuk Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="group inline-flex items-center px-8 py-3 bg-emerald-500 hover:bg-emerald-400 border-2 border-emerald-400 text-white rounded-full font-bold text-base shadow-xl hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Masuk Dashboard
                            </a>
                        @endauth
                    @endif
                </div>
            </div>

            <div class="bg-white/95 backdrop-blur shadow-2xl rounded-2xl border border-white/20 overflow-hidden ring-1 ring-black/5">
                
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <span class="bg-emerald-100 text-emerald-600 p-2 rounded-xl mr-3 flex-shrink-0 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </span>
                        Monitoring Izin Hari Ini
                    </h3>
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold font-mono bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ date('d F Y') }}
                    </span>
                </div>

                <div class="p-4 sm:p-0">
                    <table class="w-full border-collapse block md:table">
                        <thead class="block md:table-header-group hidden md:table-header-group">
                            <tr class="border-b border-gray-200 bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider block md:table-row">
                                <th class="px-6 py-4 text-left block md:table-cell">No</th>
                                <th class="px-6 py-4 text-left block md:table-cell">Pegawai</th>
                                <th class="px-6 py-4 text-center block md:table-cell">Jam Keluar</th>
                                <th class="px-6 py-4 text-center block md:table-cell">Rencana Kembali</th>
                                <th class="px-6 py-4 text-left block md:table-cell">Keperluan</th>
                                <th class="px-6 py-4 text-center block md:table-cell">Status</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group divide-y divide-gray-100">
                            @forelse($sedangIzin as $index => $izin)
                                <tr class="bg-white border border-gray-200 md:border-none block md:table-row rounded-xl shadow-sm md:shadow-none mb-4 md:mb-0 hover:bg-gray-50 transition duration-150 relative group">
                                    
                                    <td class="px-4 py-2 md:px-6 md:py-4 text-gray-500 block md:table-cell border-b md:border-b-0 border-gray-100 text-sm">
                                        <span class="inline-block w-1/3 md:hidden font-bold text-gray-400 uppercase text-xs">No</span>
                                        <span class="font-mono font-bold text-emerald-600">{{ $index + 1 }}</span>
                                    </td>

                                    <td class="px-4 py-2 md:px-6 md:py-4 block md:table-cell border-b md:border-b-0 border-gray-100">
                                        <span class="inline-block w-1/3 md:hidden font-bold text-gray-400 uppercase text-xs">Pegawai</span>
                                        <div class="inline-block align-middle">
                                            <div class="font-bold text-gray-900 text-base group-hover:text-emerald-700 transition">{{ $izin->user->name }}</div>
                                            <div class="text-xs text-gray-500 font-mono">{{ $izin->user->nip }}</div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-2 md:px-6 md:py-4 text-left md:text-center block md:table-cell border-b md:border-b-0 border-gray-100">
                                        <span class="inline-block w-1/3 md:hidden font-bold text-gray-400 uppercase text-xs">Keluar</span>
                                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg font-mono font-bold text-sm border border-blue-100">
                                            {{ substr($izin->jam_keluar, 0, 5) }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-2 md:px-6 md:py-4 text-left md:text-center block md:table-cell border-b md:border-b-0 border-gray-100">
                                        <span class="inline-block w-1/3 md:hidden font-bold text-gray-400 uppercase text-xs">Kembali</span>
                                        <span class="font-mono text-gray-600 text-sm bg-gray-100 px-2 py-1 rounded">
                                            {{ substr($izin->jam_kembali, 0, 5) }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-2 md:px-6 md:py-4 text-gray-600 italic block md:table-cell border-b md:border-b-0 border-gray-100 text-sm">
                                        <span class="inline-block w-1/3 md:hidden font-bold text-gray-400 uppercase text-xs align-top">Keperluan</span>
                                        <span class="inline-block w-3/5 md:w-auto">{{ $izin->keperluan }}</span>
                                    </td>

                                    <td class="px-4 py-3 md:px-6 md:py-4 text-left md:text-center block md:table-cell bg-gray-50 md:bg-transparent rounded-b-xl md:rounded-none">
                                        <span class="inline-block w-1/3 md:hidden font-bold text-gray-400 uppercase text-xs">Status</span>
                                        
                                        @if($izin->user->atasan_id == null)
                                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800 border border-blue-200 shadow-sm">
                                                <span class="w-2 h-2 bg-blue-600 rounded-full mr-2"></span>
                                                SEDANG DI LUAR
                                            </span>
                                        @elseif($izin->status == 1)
                                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-bold rounded-full bg-red-100 text-red-700 border border-red-200 shadow-sm animate-pulse">
                                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                                SEDANG DI LUAR
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-ping"></span>
                                                MENUNGGU PERSETUJUAN
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="block md:table-row">
                                    <td colspan="6" class="px-6 py-16 text-center text-gray-400 block md:table-cell">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-gray-50 p-6 rounded-full mb-4 shadow-inner">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                            <p class="font-bold text-gray-500 text-lg">Semua Pegawai di Kantor Kecuali yang Cuti dan Dinas Luar</p>
                                            <p class="text-sm text-gray-400 mt-1">Tidak ada data izin aktif saat ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="bg-gray-50/80 px-6 py-4 border-t border-gray-200 text-center hidden md:block backdrop-blur-sm">
                    <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold">&copy; {{ date('Y') }} PARMISI | Versi 1.0</p>
                </div>
            </div>

        </div>
    </main>

</body>
</html>