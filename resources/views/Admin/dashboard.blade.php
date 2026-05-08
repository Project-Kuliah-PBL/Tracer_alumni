<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Dashboard Admin - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        body {
            background-color: #f1f5f9;
            overflow-x: hidden;
        }
        /* Sembunyikan scrollbar - agar lebih rapi */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .responsive-container {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }
        @media (max-width: 1024px) {
            .chart-container .bar-container {
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body class="bg-slate-50 h-screen w-full flex flex-col overflow-hidden">

    <!-- Header -->
    <div class="shrink-0 w-full">
        @include('partials.header-admin')
    </div>

  <div class="flex flex-1 overflow-hidden w-full max-w-full">
    <aside class="w-64 shrink-0 bg-white/90 backdrop-blur-sm border-r border-slate-100 flex flex-col justify-between h-full overflow-y-auto no-scrollbar">
            <div class="py-6 flex flex-col gap-3">
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 mx-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs border-r-4 border-blue-600 transition-all">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="font-bold text-xs">Dashboard</span>
                </a>

                <a href="{{ route('admin.kelola_akun') }}" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="font-bold text-xs">Kelola Akun</span>
                </a>

                <a href="/admin/kelola-prodi" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group mx-2"> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                    <span class="font-bold text-xs">Kelola Prodi</span>
                </a>

                <a href="/admin/biodata-alumni" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2M12 7v10m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-bold text-xs">Edit Biodata Alumni</span>
                </a>

            </div>

            <div class="px-4 pb-6">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center justify-center gap-3 bg-[#D32F2F] text-white w-full py-3 rounded-xl hover:bg-red-700 transition-all shadow-md group cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-transform group-hover:scale-105" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="font-bold text-sm tracking-wide">LogOut</span>
                    </button>
                </form>
            </div>
        </aside>


        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-y-auto px-4 md:px-6 lg:px-8 py-4 md:py-6 no-scrollbar w-full min-w-0">
            <!-- Header Statistik -->
            <div class="mb-5 md:mb-7">
                <h2 class="text-xl md:text-2xl font-extrabold text-slate-800 tracking-tight">Statistik Alumni</h2>
                <p class="text-slate-500 text-xs font-medium mt-0.5">Gambaran keterserapan alumni Polije di dunia profesional.</p>
            </div>

            <!-- Card Statistik-->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mb-6 md:mb-8">
                <!-- Card 1: Alumni Terverifikasi -->
                <div class="bg-white rounded-2xl shadow-md p-4 md:p-5 border border-slate-100 transition-all hover:shadow-lg">
                    <div class="flex justify-between items-start mb-3">
                        <div class="bg-blue-50 p-2 md:p-2.5 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalAlumni) }}</h3>
                    <p class="text-slate-400 text-[9px] md:text-[10px] font-bold uppercase tracking-widest mt-1">Alumni Terverifikasi</p>
                </div>

                <!-- Card 2: Terserap Kerja -->
                <div class="bg-white rounded-2xl shadow-md p-4 md:p-5 border border-slate-100 transition-all hover:shadow-lg">
                    <div class="flex justify-between items-start mb-3">
                        <div class="bg-indigo-50 p-2 md:p-2.5 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-[9px] font-black">{{ $persentaseTerserap }}%</span>
                    </div>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-slate-800">{{ $persentaseTerserap }}%</h3>
                    <p class="text-slate-400 text-[9px] md:text-[10px] font-bold uppercase tracking-widest mt-1">Terserap Kerja</p>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                        <div class="bg-indigo-500 h-full rounded-full" style="width: {{ $persentaseTerserap }}%"></div>
                    </div>
                </div>
            </div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- 1. GRAFIK MASA TUNGGU (KATEGORI TAHUN) -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 md:p-6 flex flex-col">
        <div class="border-l-4 border-[#0067B1] pl-4 mb-6">
            <h3 class="font-extrabold text-slate-800 text-base md:text-lg">Masa Tunggu Kerja</h3>
            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Berdasarkan Kategori Tahun</p>
        </div>

        @php
            $masaTunggu = $masaTunggu ?? collect([
                (object)['label' => '< 1 Tahun', 'jumlah' => $kurangSatuTahun ?? 0],
                (object)['label' => '1 - 2 Tahun', 'jumlah' => $satuDuaTahun ?? 0],
                (object)['label' => '> 2 Tahun', 'jumlah' => $lebihDuaTahun ?? 0],
            ]);
            $maxMasaTunggu = $masaTunggu->max('jumlah') ?: 1;
        @endphp

        <div class="flex-1 flex items-end justify-around gap-4 h-64 px-4">
            @foreach($masaTunggu as $data)
                @php
                    $tinggiFix = $data->jumlah > 0 ? max(($data->jumlah / $maxMasaTunggu) * 100, 15) : 5;
                @endphp
                <div class="flex flex-col items-center gap-4 w-full max-w-[80px]">
                    <div class="relative group w-full flex flex-col items-center justify-end h-48">
                        <!-- Tooltip -->
                        <div class="opacity-0 group-hover:opacity-100 absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-3 py-1.5 rounded-lg font-bold whitespace-nowrap transition-all duration-200 z-20 shadow-xl">
                            {{ $data->jumlah }} Alumni
                            <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-slate-800 rotate-45"></div>
                        </div>
                        <!-- Bar -->
                        <div class="w-full rounded-t-xl transition-all duration-500 ease-out {{ $data->jumlah > 0 ? 'bg-gradient-to-t from-[#0067B1] to-[#0085E5]' : 'bg-slate-100' }} group-hover:brightness-110 shadow-sm group-hover:shadow-md cursor-pointer" 
                             style="height: {{ $tinggiFix }}%;"></div>
                    </div>
                    <div class="text-center">
                        <span class="block text-[11px] font-black text-slate-700 leading-none">{{ $data->label }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
<!-- GRAFIK TREN TAHUNAN -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 md:p-6 flex flex-col">
    
    <div class="border-l-4 border-blue-400 pl-4 mb-6">
        <h3 class="font-extrabold text-slate-800 text-base md:text-lg">
            Masa Kerja Rata-Rata
        </h3>
        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">
            Durasi Kerja rata-rata (Tahun)
        </p>
    </div>

    @php
        // LABEL TAHUN
        $tahunLabels = ['2019', '2020', '2021', '2022', '2023', '2024'];

        // DATA CONTOH (GANTI SESUAI KEBUTUHAN)
        $dataTahunan = $dataTahunan ?? [12, 25, 40, 30, 20, 35];

        $maxData = max($dataTahunan) ?: 1;
    @endphp

    <div class="overflow-x-auto custom-scrollbar">
        <div class="flex items-end justify-between gap-2 h-64 min-w-[500px] px-2 pb-2">

            @foreach($tahunLabels as $index => $label)
                @php
                    $jumlah = $dataTahunan[$index] ?? 0;
                    $tinggiFix = $jumlah > 0 ? max(($jumlah / $maxData) * 100, 10) : 5;
                @endphp

                <div class="flex flex-col items-center gap-3 flex-1">

                    <div class="relative group w-full flex flex-col items-center justify-end h-44">

                        <!-- Tooltip -->
                        <div class="opacity-0 group-hover:opacity-100 absolute -top-9 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-[9px] px-2 py-1 rounded-md font-bold whitespace-nowrap transition-all z-20 shadow-lg">
                            {{ $jumlah }}
                        </div>

                        <!-- Bar -->
                        <div class="w-full rounded-t-md transition-all duration-500 
                            {{ $jumlah > 0 ? 'bg-blue-400' : 'bg-slate-50' }} 
                            group-hover:bg-[#0067B1] cursor-pointer"
                            style="height: {{ $tinggiFix }}%;">
                        </div>

                    </div>

                    <!-- LABEL TAHUN -->
                    <span class="text-[10px] font-bold text-slate-500">
                        {{ $label }}
                    </span>

                </div>
            @endforeach

        </div>
    </div>
</div>

<style>
    /* Agar scrollbar tren bulanan terlihat lebih halus */
    .custom-scrollbar::-webkit-scrollbar { height: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

    <script>
        console.log("Dashboard Alumni Polije - Konten penuh, chart terlihat, statistik muncul - Responsif untuk layar laptop");
    </script>

</body>
</html>