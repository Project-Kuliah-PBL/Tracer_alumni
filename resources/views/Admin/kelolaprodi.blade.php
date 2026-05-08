<!DOCTYPE html>
<html lang="id" x-data="{ 
    openModal: false, 
    openEditModal: false,
    prodiEdit: { nama: '', dept: '', akr: '' }
}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Kelola Program Studi - Portal Alumni Polije</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .glass-card { background: white; border: 1px solid #f1f5f9; border-radius: 24px; }
        .sidebar-item-active { background-color: #eff6ff; color: #2563eb; border-right: 4px solid #2563eb; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-screen w-full flex flex-col overflow-hidden">

    <div class="shrink-0 w-full z-20 shadow-sm">
        @include('partials.header-admin')
    </div>

    <div class="flex flex-1 overflow-hidden w-full">
     <aside class="w-64 shrink-0 bg-white/90 backdrop-blur-sm border-r border-slate-100 flex flex-col justify-between h-full overflow-y-auto no-scrollbar">
            <div class="py-6 flex flex-col gap-3">
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group mx-2"> 
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

                <a href="/admin/kelola-prodi" class="flex items-center gap-3 mx-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs border-r-4 border-blue-600 transition-all">  
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

        <main class="flex-1 p-8 overflow-y-auto no-scrollbar bg-[#f8fafc]">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Kelola Program Studi</h1>
                    <p class="text-slate-500 text-sm mt-1">Sistem Kelola Program Studi Politeknik Negeri Jember.</p>
                </div>
                <button @click="openModal = true" class="bg-[#0284c7] hover:bg-sky-700 text-white px-6 py-3 rounded-2xl font-bold text-sm flex items-center gap-3 shadow-xl shadow-sky-100 transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Prodi Baru
                </button>
            </div>

            <div class="glass-card p-6 shadow-sm">
                <div class="mb-8">
                    <div class="relative w-full max-w-md">
                        <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" placeholder="Cari nama program studi..." class="block w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-sky-500 focus:bg-white transition-all outline-none">
                    </div>
                </div>

                <div class="overflow-hidden border border-slate-50 rounded-2xl">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-400 text-[10px] uppercase tracking-[0.15em] font-black border-b border-slate-100">
                                <th class="px-6 py-5">Nama Program Studi</th>
                                <th class="px-6 py-5">Jurusan</th>
                                <th class="px-6 py-5 text-center">Akreditasi</th>
                                <th class="px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @php
                                $prodiData = [
                                    ['nama' => 'Teknik Informatika', 'dept' => 'Teknologi Informasi', 'akr' => 'Unggul', 'color' => 'green'],
                                    ['nama' => 'Manajemen Informatika', 'dept' => 'Teknologi Informasi', 'akr' => 'A', 'color' => 'blue'],
                                    ['nama' => 'Teknik Mesin', 'dept' => 'Teknik', 'akr' => 'B', 'color' => 'indigo'],
                                ];
                            @endphp

                            @foreach($prodiData as $item)
                            <tr class="hover:bg-slate-50/80 transition-all group">
                                <td class="px-6 py-5 font-bold text-slate-700 text-sm">{{ $item['nama'] }}</td>
                                <td class="px-6 py-5 text-slate-500 font-medium text-xs">{{ $item['dept'] }}</td>
                                <td class="px-6 py-5 text-center">
                                    @php
                                        $style = match($item['color']) {
                                            'green' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                            'blue' => 'bg-sky-50 text-sky-600 border-sky-100',
                                            'indigo' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
                                            default => 'bg-slate-50 border-slate-100 text-slate-500'
                                        };
                                    @endphp
                                    <span class="px-4 py-1.5 border rounded-full text-[10px] font-black uppercase tracking-wider {{ $style }}">
                                        {{ $item['akr'] }}
                                    </span>
                                </td>
                             <td class="px-6 py-5 text-right">
    <div class="flex justify-end items-center gap-2">
        {{-- Tombol Edit --}}
        {{-- Perhatikan: Menggunakan $item['nama'] (kurung siku) bukan $item->nama --}}
        <button @click="openEditModal = true; prodiEdit = { nama: '{{ $item['nama'] }}', dept: '{{ $item['dept'] }}', akr: '{{ $item['akr'] }}' }"
            class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </button>

        {{-- Tombol Hapus --}}
        <button class="p-1.5 text-red-400 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
    </div>
</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div x-show="openModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div @click.away="openModal = false" class="bg-white w-full max-w-lg rounded-[32px] shadow-2xl overflow-hidden" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="px-8 pt-8 pb-4 flex justify-between items-center">
                <h2 class="text-xl font-extrabold text-slate-800">Tambah Prodi Baru</h2>
                <button @click="openModal = false" class="p-2 bg-slate-50 text-slate-400 rounded-full hover:bg-red-50 hover:text-red-500 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="#" method="POST" class="px-8 pb-8 space-y-5">
                @csrf
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Nama Program Studi</label>
                    <input type="text" placeholder="Contoh: Teknik Informatika" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-sky-500 focus:bg-white outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1"> Jurusan</label>
                    <select class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-sky-500 focus:bg-white outline-none transition-all font-semibold">
                        <option value="">Pilih Departemen</option>
                        <option>Teknologi Informasi</option>
                        <option>Teknik</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Akreditasi</label>
                    <select class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-sky-500 focus:bg-white outline-none transition-all font-semibold">
                        <option>Unggul</option>
                        <option>A</option>
                        <option>B</option>
                    </select>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" @click="openModal = false" class="flex-1 py-3.5 rounded-2xl font-bold text-slate-500 bg-slate-50 hover:bg-slate-100 transition-all text-sm">Batal</button>
                    <button type="submit" class="flex-1 py-3.5 rounded-2xl font-bold text-white bg-[#0284c7] hover:bg-sky-700 shadow-lg shadow-sky-100 transition-all text-sm">Simpan Prodi</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="openEditModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div @click.away="openEditModal = false" class="bg-white w-full max-w-lg rounded-[32px] shadow-2xl overflow-hidden" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="px-8 pt-8 pb-4 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-extrabold text-slate-800">Update Program Studi</h2>
                    <p class="text-xs text-slate-400 mt-1">Simpan perubahan data akademik.</p>
                </div>
                <button @click="openEditModal = false" class="p-2 bg-slate-50 text-slate-400 rounded-full hover:bg-red-50 hover:text-red-500 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="#" method="POST" class="px-8 pb-8 space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Nama Program Studi</label>
                    <input type="text" x-model="prodiEdit.nama" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-sky-500 focus:bg-white outline-none transition-all font-semibold text-slate-700">
                </div>
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Departemen / Jurusan</label>
                    <select x-model="prodiEdit.dept" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-sky-500 focus:bg-white outline-none transition-all font-semibold text-slate-700">
                        <option>Teknologi Informasi</option>
                        <option>Teknik</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Akreditasi</label>
                    <select x-model="prodiEdit.akr" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-2 focus:ring-sky-500 focus:bg-white outline-none transition-all font-semibold text-slate-700">
                        <option>Unggul</option>
                        <option>A</option>
                        <option>B</option>
                    </select>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" @click="openEditModal = false" class="flex-1 py-3.5 rounded-2xl font-bold text-slate-500 bg-slate-50 hover:bg-slate-100 transition-all text-sm">Batal</button>
                    <button type="submit" class="flex-1 py-3.5 rounded-2xl font-bold text-white bg-sky-600 hover:bg-sky-700 shadow-lg shadow-sky-100 transition-all text-sm flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>