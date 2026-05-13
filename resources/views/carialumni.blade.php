<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Alumni - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-custom-gradient {
            background: radial-gradient(circle at 10% 10%, #f0f7ff 0%, #ffffff 50%, #f5f3ff 100%);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

    {{-- ===== NAVBAR ===== --}}
    <nav class="w-full shrink-0 bg-white shadow-sm">
        <div class="w-full px-8 py-5 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('image/PolijeLogo.png') }}" alt="Logo" class="h-10 w-auto">
                <div class="flex flex-col">
                    <h1 class="font-[700] text-base text-[#0067B1] leading-none uppercase tracking-tight">Politeknik Negeri Jember</h1>
                    <p class="text-[8px] tracking-[0.3em] font-bold text-[#0067B1] uppercase mt-1 opacity-60">Alumni Portal</p>
                </div>
            </div>
            <div class="flex items-center space-x-10">
                <a href='/' class="text-[#0067B1] font-bold text-sm hover:opacity-70 transition-all border-b-2 border-transparent hover:border-[#0067B1] pb-1">
                    Home
                </a>
                <a href="{{ route('login') }}" class="bg-[#0067B1] text-white px-8 py-2.5 rounded-full font-bold text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/10">
                    Login
                </a>
            </div>
        </div>
    </nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="w-full px-8 py-12">

        {{-- Header & Search --}}
        <div class="text-center mb-12">
            <h2 class="text-4xl font-[800] text-[#1E3A8A] mb-4 tracking-tight">Temukan Koneksi Alumni</h2>
            <p class="text-slate-500 text-sm max-w-2xl mx-auto font-medium opacity-80">
                Jelajahi jaringan profesional lulusan Politeknik Negeri Jember dari berbagai angkatan dan program studi.
            </p>

            {{-- Search Form --}}
            <form method="GET" action="{{ route('alumni.search') }}">
                <div class="mt-10 max-w-3xl mx-auto relative">
                    <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama, jabatan, lokasi...."
                        class="w-full bg-white border border-slate-100 py-5 pl-16 pr-8 rounded-full shadow-xl shadow-slate-200/50 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-sm font-medium"
                    >
                </div>

                {{-- Filter Row - auto submit tanpa tombol --}}
<div class="flex flex-wrap justify-center gap-3 mt-6 mb-20">

    {{-- Tahun Lulus (dari database, dinamis) --}}
    <div class="relative flex items-center">
        <span class="absolute left-4 z-10 opacity-60 text-xs">📅</span>
        <select name="tahun_lulus"
            onchange="this.form.submit()"
            class="appearance-none bg-slate-100 hover:bg-slate-200 text-slate-600 pl-10 pr-10 py-2.5 rounded-full text-xs font-bold transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer border-none">
            <option value="">Tahun Lulus</option>
            @foreach($tahunList as $tahun)
                <option value="{{ $tahun }}" {{ request('tahun_lulus') == $tahun ? 'selected' : '' }}>
                    {{ $tahun }}
                </option>
            @endforeach
        </select>
        <div class="absolute right-4 pointer-events-none opacity-40">
            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    {{-- Program Studi (dari database, dinamis) --}}
    <div class="relative flex items-center">
        <span class="absolute left-4 z-10 opacity-60 text-xs">🎓</span>
        <select name="program_studi"
            onchange="this.form.submit()"
            class="appearance-none bg-slate-100 hover:bg-slate-200 text-slate-600 pl-10 pr-10 py-2.5 rounded-full text-xs font-bold transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer border-none">
            <option value="">Program Studi</option>
            @foreach($prodiList as $prodi)
                <option value="{{ $prodi }}" {{ request('program_studi') == $prodi ? 'selected' : '' }}>
                    {{ $prodi }}
                </option>
            @endforeach
        </select>
        <div class="absolute right-4 pointer-events-none opacity-40">
            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    {{-- Lokasi (dari database, dinamis) --}}
    <div class="relative flex items-center">
        <span class="absolute left-4 z-10 opacity-60 text-xs">📍</span>
        <select name="lokasi"
            onchange="this.form.submit()"
            class="appearance-none bg-slate-100 hover:bg-slate-200 text-slate-600 pl-10 pr-10 py-2.5 rounded-full text-xs font-bold transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer border-none">
            <option value="">Lokasi</option>
            @foreach($lokasiList as $lok)
                <option value="{{ $lok }}" {{ request('lokasi') == $lok ? 'selected' : '' }}>
                    {{ $lok }}
                </option>
            @endforeach
        </select>
        <div class="absolute right-4 pointer-events-none opacity-40">
            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    {{-- Tombol reset saja, tidak perlu "Terapkan Filter" --}}
    @if(request()->anyFilled(['search', 'tahun_lulus', 'program_studi', 'lokasi']))
    <a href="{{ route('alumni.search') }}"
        class="bg-slate-200 hover:bg-slate-300 text-slate-600 px-6 py-2.5 rounded-full text-xs font-bold transition-all">
        Reset
    </a>
    @endif
</div>

        <hr class="border-slate-200 mb-10">

        {{-- ===== DIREKTORI HEADER + TOGGLE ===== --}}
        <div class="flex justify-between items-center mb-8">
            <div class="border-l-4 border-[#0067B1] pl-4">
                <h3 class="font-[800] text-slate-800 text-lg">Direktori Alumni</h3>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                    Menampilkan {{ $alumnis->total() }} hasil
                    @if(request()->anyFilled(['search', 'tahun_lulus', 'program_studi', 'lokasi']))
                        untuk pencarian Anda
                    @endif
                </p>
            </div>
            {{-- Toggle Buttons --}}
            <div class="flex space-x-2">
                <button id="btn-grid" onclick="setView('grid')"
                    title="Tampilan Grid"
                    class="p-2 rounded-lg transition-all bg-[#0067B1] text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </button>
                <button id="btn-list" onclick="setView('list')"
                    title="Tampilan List"
                    class="p-2 rounded-lg transition-all bg-slate-100 text-slate-400 hover:text-[#0067B1]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- ===== GRID VIEW ===== --}}
        <div id="view-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($alumnis as $alumni)
            <div class="bg-white rounded-[40px] p-8 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-50 group">
                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-5">
                        <div class="absolute inset-0 bg-blue-100 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        @if($alumni->foto_profile)
                            <img src="{{ Storage::url($alumni->foto_profile) }}" class="relative w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover" alt="{{ $alumni->nama }}">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->nama) }}&background=0D8ABC&color=fff" class="relative w-24 h-24 rounded-full border-4 border-white shadow-lg" alt="{{ $alumni->nama }}">
                        @endif
                    </div>
                    <h4 class="font-extrabold text-slate-800 text-lg mb-1">{{ $alumni->nama }}</h4>

{{-- ✅ PERBAIKAN: Ambil jobdesk dari pekerjaan aktif/terbaru --}}
<p class="text-[#0067B1] font-bold text-xs mb-1 uppercase tracking-wider">
    @php
        // Ambil pekerjaan AKTIF atau terbaru
        $pekerjaanAktif = $alumni->pekerjaan()
            ->where(function($q) {
                $q->whereNull('tahun_selesai')
                  ->orWhere('tahun_selesai', '>=', now());
            })
            ->latest('tahun_masuk')
            ->first();
        
        $pekerjaan = $pekerjaanAktif ?? $alumni->pekerjaan()->latest('tahun_masuk')->first();
    @endphp
    {{ $pekerjaan?->jobdesk ?? '-' }}
</p>

{{-- ✅ PERBAIKAN: Ambil nama_perusahaan dari pekerjaan yang sama --}}
<p class="text-slate-500 font-medium text-[11px] mb-3 uppercase tracking-tight">
    {{ $pekerjaan?->nama_perusahaan ?? '-' }}
</p>

<div class="flex items-center text-slate-400 text-[11px] font-bold uppercase tracking-wider mb-8">
    <span class="mr-2">🎓</span> {{ $alumni->tahun_lulus ?? '-' }}
</div>

<a href="{{ route('alumni.show', $alumni->nim) }}" class="w-full py-3.5 border-2 border-slate-100 rounded-2xl text-slate-600 font-bold text-xs hover:bg-[#0067B1] hover:text-white hover:border-[#0067B1] transition-all text-center">
    Lihat Profil
</a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="text-5xl mb-4">🔍</div>
                <p class="text-slate-800 font-extrabold text-lg mb-2">Alumni Tidak Ditemukan</p>
                <p class="text-slate-400 font-medium text-sm">Coba ubah kata kunci atau filter pencarian Anda.</p>
                @if(request()->anyFilled(['search', 'tahun_lulus', 'program_studi', 'lokasi']))
                <a href="{{ route('alumni.search') }}" class="inline-block mt-6 bg-[#0067B1] text-white px-8 py-3 rounded-full text-xs font-bold hover:bg-blue-800 transition-all">
                    Lihat Semua Alumni
                </a>
                @endif
            </div>
            @endforelse
        </div>

        {{-- ===== LIST VIEW ===== --}}
        <div id="view-list" class="hidden flex-col gap-3">
            @forelse($alumnis as $alumni)
            <div class="bg-white rounded-2xl px-6 py-5 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-100 group flex items-center justify-between gap-4">
                {{-- Kiri: Avatar + Info --}}
                <div class="flex items-center gap-5 min-w-0">
                    <div class="relative shrink-0">
                        @if($alumni->foto_profile)
                            <img src="{{ Storage::url($alumni->foto_profile) }}" class="w-14 h-14 rounded-full border-2 border-white shadow-md object-cover" alt="{{ $alumni->nama }}">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->nama) }}&background=0D8ABC&color=fff" class="w-14 h-14 rounded-full border-2 border-white shadow-md" alt="{{ $alumni->nama }}">
                        @endif
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-extrabold text-slate-800 text-base leading-tight truncate">{{ $alumni->nama }}</h4>
                        <p class="text-[#0067B1] font-bold text-xs mt-0.5">
                            {{ $alumni->jabatan_sekarang ?? 'Alumni' }}
                            @if($alumni->pekerjaan->first()?->nama_perusahaan)
                                <span class="text-slate-400 font-medium">at {{ $alumni->pekerjaan->first()?->nama_perusahaan }}</span>
                            @endif
                        </p>
                        <div class="flex items-center text-slate-400 text-[11px] font-bold uppercase tracking-wider mt-1.5">
                            <span class="mr-1.5">🎓</span> {{ $alumni->tahun_lulus ?? '-' }}
                        </div>
                    </div>
                </div>
                {{-- Kanan: Tombol --}}
                <a href="{{ route('alumni.show', $alumni->nim) }}"
                    class="shrink-0 px-6 py-2.5 border-2 border-slate-100 rounded-xl text-slate-600 font-bold text-xs hover:bg-[#0067B1] hover:text-white hover:border-[#0067B1] transition-all whitespace-nowrap">
                    Lihat Profil
                </a>
            </div>
            @empty
            <div class="py-20 text-center">
                <div class="text-5xl mb-4">🔍</div>
                <p class="text-slate-800 font-extrabold text-lg mb-2">Alumni Tidak Ditemukan</p>
                <p class="text-slate-400 font-medium text-sm">Coba ubah kata kunci atau filter pencarian Anda.</p>
                @if(request()->anyFilled(['search', 'tahun_lulus', 'program_studi', 'lokasi']))
                <a href="{{ route('alumni.search') }}" class="inline-block mt-6 bg-[#0067B1] text-white px-8 py-3 rounded-full text-xs font-bold hover:bg-blue-800 transition-all">
                    Lihat Semua Alumni
                </a>
                @endif
            </div>
            @endforelse
        </div>

        {{-- ===== PAGINATION ===== --}}
        @if($alumnis->hasPages())
        <div class="mt-16 flex justify-center">
            {{ $alumnis->appends(request()->input())->links() }}
        </div>
        @endif

    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="mt-auto py-10 bg-white border-t border-slate-100">
        <div class="w-full px-8 flex flex-col md:flex-row justify-between items-center text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            <p>© 2026 Politeknik Negeri Jember</p>
            <div class="flex space-x-8 mt-4 md:mt-0">
                <a href="#" class="hover:text-blue-500">Kebijakan Privasi</a>
                <a href="#" class="hover:text-blue-500">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-blue-500">Bantuan</a>
            </div>
        </div>
    </footer>

    {{-- ===== SCRIPT TOGGLE VIEW ===== --}}
    <script>
        const STORAGE_KEY = 'alumni_view_mode';

        function setView(mode) {
            const gridEl   = document.getElementById('view-grid');
            const listEl   = document.getElementById('view-list');
            const btnGrid  = document.getElementById('btn-grid');
            const btnList  = document.getElementById('btn-list');

            if (mode === 'list') {
                // Tampilkan list, sembunyikan grid
                gridEl.classList.add('hidden');
                listEl.classList.remove('hidden');
                listEl.classList.add('flex');

                // Aktifkan tombol list
                btnList.classList.add('bg-[#0067B1]', 'text-white');
                btnList.classList.remove('bg-slate-100', 'text-slate-400');
                btnGrid.classList.remove('bg-[#0067B1]', 'text-white');
                btnGrid.classList.add('bg-slate-100', 'text-slate-400');
            } else {
                // Tampilkan grid, sembunyikan list
                listEl.classList.add('hidden');
                listEl.classList.remove('flex');
                gridEl.classList.remove('hidden');

                // Aktifkan tombol grid
                btnGrid.classList.add('bg-[#0067B1]', 'text-white');
                btnGrid.classList.remove('bg-slate-100', 'text-slate-400');
                btnList.classList.remove('bg-[#0067B1]', 'text-white');
                btnList.classList.add('bg-slate-100', 'text-slate-400');
            }

            // Simpan preferensi ke localStorage agar diingat saat reload
            localStorage.setItem(STORAGE_KEY, mode);
        }

        // Terapkan preferensi tampilan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            const saved = localStorage.getItem(STORAGE_KEY) || 'grid';
            setView(saved);
        });
    </script>

</body>
</html>