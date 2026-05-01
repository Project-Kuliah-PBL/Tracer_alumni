<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Dashboard Admin - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow: hidden; }
    </style>
</head>
<body class="bg-slate-50 h-screen flex flex-col">

    <div class="shrink-0">
        @include('partials.header-admin')
    </div>

    <div class="flex flex-1 overflow-hidden w-full">

        <!-- Sidebar -->
        <aside class="w-64 shrink-0 px-6 py-8 flex flex-col gap-4 bg-white border-r border-slate-100 shadow-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 bg-[#2563EB] text-white px-5 py-3 rounded-full shadow-lg shadow-blue-600/20 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="font-bold text-xs">Dashboard</span>
            </a>

            <a href="{{ route('admin.kelola_akun') }}" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="font-bold text-xs group-hover:text-blue-600">Kelola Akun</span>
            </a>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 px-8 py-8 flex flex-col overflow-hidden">

            <header class="mb-8">
                <h2 class="text-3xl font-[800] text-slate-800 mb-1 tracking-tight">Statistik Alumni</h2>
                <p class="text-slate-500 text-xs font-medium opacity-80">
                    Gambaran keterserapan alumni Polije di dunia profesional.
                </p>
            </header>

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-[30px] shadow-sm flex flex-col items-start border border-slate-50">
                    <div class="flex justify-between w-full items-start mb-4">
                        <div class="bg-blue-50 p-2 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                            </svg>
                        </div>
                        <span class="bg-green-50 text-green-600 px-2 py-0.5 rounded-full text-[9px] font-black">+4.2%</span>
                    </div>
                    <h3 class="text-3xl font-[800] text-slate-800 mb-0.5">12,060</h3>
                    <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest">Alumni Terverifikasi</p>
                </div>

                <div class="bg-white p-6 rounded-[30px] shadow-sm flex flex-col items-start border border-slate-50">
                    <div class="flex justify-between w-full items-start mb-4">
                        <div class="bg-indigo-50 p-2 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full text-[9px] font-black">88.4%</span>
                    </div>
                    <h3 class="text-3xl font-[800] text-slate-800 mb-0.5">88.4%</h3>
                    <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest">Terserap Kerja</p>
                    <div class="w-full bg-slate-100 h-1 rounded-full mt-3 overflow-hidden">
                        <div class="bg-indigo-500 h-full w-[88%] rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white p-6 rounded-[30px] shadow-sm border border-slate-50 flex-1 flex flex-col min-h-0">
                <div class="border-l-4 border-[#0067B1] pl-4 mb-4 shrink-0">
                    <h3 class="font-[800] text-slate-800 text-base">Pertumbuhan Alumni</h3>
                    <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest">Data tahunan 2018 - 2023.</p>
                </div>
                <div class="flex-1 flex items-end justify-between px-4 relative mt-4 min-h-0 pb-2">
                    <div class="absolute bottom-6 left-0 w-full h-[1px] bg-slate-100"></div>
                    @foreach(['2018', '2019', '2020', '2021', '2022', '2023'] as $year)
                    <div class="flex flex-col items-center flex-1 gap-2">
                        <div class="w-1 bg-slate-50 rounded-full h-full relative max-h-[120px]">
                            @if($year == '2023')
                            <div class="absolute bottom-0 w-full h-[80%] bg-blue-600 rounded-full">
                                <div class="absolute -top-7 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[8px] px-2 py-0.5 rounded-full font-bold">2,590</div>
                            </div>
                            @endif
                        </div>
                        <span class="text-[9px] font-black text-slate-400 tracking-tighter">{{ $year }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>

    <script>
        history.replaceState(null, '', window.location.href);
    </script>
</body>
</html>
