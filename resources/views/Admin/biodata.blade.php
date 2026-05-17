<!DOCTYPE html>
<html lang="id" x-data="{ openModal: false, openEduModal: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Alumni - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow: hidden; }
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#f8fafc] h-screen flex flex-col">

    <div class="shrink-0 z-20 shadow-sm">
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

                @if(auth()->user()->role === 'SuperAdmin')
                <a href="/admin/kelola-prodi" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group mx-2"> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z8" />
                    </svg>
                    <span class="font-bold text-xs">Kelola Prodi</span>
                </a>
                @endif

                <a href="/admin/edit-biodata" class="flex items-center gap-3 mx-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs border-r-4 border-blue-600 transition-all"> 
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

        <main class="flex-1 overflow-y-auto custom-scroll p-8 bg-[#f8fafc]">
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <nav class="flex items-center gap-2 text-slate-400 text-[10px] uppercase font-black tracking-widest mb-2">
                        <a href="{{ route('admin.editbiodata') }}" class="hover:text-blue-600 transition-colors">Edit Biodata</a>
                        <span>›</span>
                        <span class="text-slate-600">{{ $alumni->nama }}</span>
                    </nav>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Detail Biodata</h1>
                    <p class="text-slate-500 text-sm mt-1">NIM: {{ $alumni->nim }} · {{ $alumni->prodi ?? '—' }}</p>
                </div>
                <a href="{{ route('admin.editbiodata') }}" class="px-8 py-3.5 bg-white border border-slate-200 text-slate-500 rounded-2xl font-bold text-xs hover:bg-slate-50 transition-all shadow-sm">Kembali</a>
            </div>

            @if(session('success'))
            <div class="mb-6 px-4 py-3 bg-green-50 border border-green-100 text-green-700 rounded-xl text-xs font-semibold">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden mb-8">
                <div class="px-8 py-5 border-b border-slate-50 flex justify-between items-center bg-slate-50/20">
                    <h3 class="font-extrabold text-slate-800 text-lg tracking-tight">💼 Pengalaman & Detail Pekerjaan</h3>
                    <button type="button" @click="openModal = true" class="text-[#074799] text-xs font-bold hover:underline flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Pekerjaan
                    </button>
                </div>

                <div class="p-8 space-y-10">
                    @forelse($alumni->pekerjaan as $pek)
                    <div class="flex gap-6 items-start group">
                        <div class="h-14 w-14 bg-slate-100 rounded-2xl flex items-center justify-center shrink-0 border border-slate-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#074799]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-1">
                                <div>
                                    <h4 class="text-xl font-bold text-slate-900 tracking-tight">{{ $pek->jobdesk ?? 'Posisi tidak diisi' }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[#074799] font-bold text-sm">{{ $pek->nama_perusahaan }}</span>
                                        <span class="text-slate-300">•</span>
                                        <span class="text-slate-500 text-sm">
                                            {{ $pek->tahun_masuk ? \Carbon\Carbon::parse($pek->tahun_masuk)->format('M Y') : '—' }}
                                            –
                                            {{ $pek->tahun_selesai ? \Carbon\Carbon::parse($pek->tahun_selesai)->format('M Y') : 'Sekarang' }}
                                        </span>
                                    </div>
                                    <span class="inline-block mt-1 text-[10px] font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">{{ $pek->status_pekerjaan }}</span>
                                </div>
                                <form action="{{ route('admin.biodata.pekerjaan.destroy', [$alumni->nim, $pek->id]) }}" method="POST"
                                    onsubmit="return confirm('Hapus pekerjaan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-bold mt-2 md:mt-0">Hapus</button>
                                </form>
                            </div>
                            @if($pek->deskripsi)
                            <p class="mt-4 text-slate-600 text-sm leading-relaxed max-w-3xl">{{ $pek->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-400 text-sm text-center py-4">Belum ada data pekerjaan.</p>
                    @endforelse
                </div>
            </div>
                        
            <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-50 flex justify-between items-center bg-slate-50/20">
                    <h3 class="font-extrabold text-slate-800 text-lg tracking-tight">🎓 Riwayat Pendidikan</h3>
                    <button type="button" @click="openEduModal = true" class="text-[#074799] text-xs font-bold hover:underline flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Pendidikan
                    </button>
                </div>

                <div class="p-8 space-y-10">
                    @forelse($alumni->riwayatPendidikan as $edu)
                    <div class="flex gap-6 items-start">
                        <div class="h-14 w-14 bg-slate-100 rounded-2xl flex items-center justify-center shrink-0 border border-slate-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#074799]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-xl font-bold text-slate-800 tracking-tight">{{ $edu->jenjang_pendidikan }} - {{ $edu->jurusan ?? '—' }}</h4>
                                    <p class="text-[#074799] font-bold text-base mt-0.5">{{ $edu->nama_instansi }}</p>
                                    <p class="text-slate-500 text-sm mt-1">
                                        {{ $edu->tahun_masuk ? \Carbon\Carbon::parse($edu->tahun_masuk)->format('Y') : '—' }}
                                        – {{ $edu->tahun_keluar ? \Carbon\Carbon::parse($edu->tahun_keluar)->format('Y') : 'Sekarang' }}
                                    </p>
                                    @if($edu->nilai_akhir)
                                    <div class="mt-3 inline-flex items-center gap-2 px-3 py-1 bg-slate-100 rounded-full border border-slate-200">
                                        <span class="text-slate-500 text-[10px] font-bold uppercase">IPK:</span>
                                        <span class="text-slate-800 text-xs font-black">{{ number_format($edu->nilai_akhir, 2) }}/4.00</span>
                                    </div>
                                    @endif
                                    @if($edu->judul_skripsi)
                                    <p class="text-slate-500 text-xs mt-2 italic">📄 {{ $edu->judul_skripsi }}</p>
                                    @endif
                                </div>
                                <form action="{{ route('admin.biodata.pendidikan.destroy', [$alumni->nim, $edu->id]) }}" method="POST"
                                    onsubmit="return confirm('Hapus riwayat pendidikan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-bold">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-400 text-sm text-center py-4">Belum ada riwayat pendidikan.</p>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
<div x-show="openModal" 
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" 
     x-cloak 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 scale-95"
     x-transition:enter-end="opacity-100 scale-100">
    
    <div @click.away="openModal = false" 
         class="bg-white w-full max-w-xl rounded-[24px] shadow-2xl overflow-hidden border border-slate-100">
        
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-white">
            <h3 class="text-[#074799] font-extrabold text-lg tracking-tight">💼 Tambah Pengalaman Kerja</h3>
            <button @click="openModal = false" class="text-slate-400 hover:text-red-500 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.biodata.pekerjaan.store', $alumni->nim) }}" method="POST">
        @csrf
        <div class="p-6 space-y-4 max-h-[75vh] overflow-y-auto custom-scroll">
            <div>
                <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Jabatan / Posisi</label>
                <input type="text" name="jobdesk" placeholder="Contoh: Senior Software Engineer" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-[#074799] outline-none transition-all">
            </div>

            <div>
                <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" placeholder="Contoh: Gojek Indonesia" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-[#074799] outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Divisi / Departemen</label>
                    <input type="text" name="divisi" placeholder="Contoh: IT Development" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799]">
                </div>
                <div>
                    <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Lokasi</label>
                    <input type="text" name="lokasi" placeholder="Contoh: Jakarta (Hybrid)" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799]">
                </div>
            </div>

            <div>
                <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Status Kerja <span class="text-red-400">*</span></label>
                <select name="status_pekerjaan" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799]">
                    <option value="">-- Pilih Status --</option>
                    <option>Pekerjaan Tetap</option>
                    <option>Kontrak</option>
                    <option>Freelance</option>
                    <option>Magang (Internship)</option>
                    <option>Part Time</option>
                    <option>Wirausaha</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4" x-data="{ isCurrent: false }">
                <div>
                    <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Tahun Mulai</label>
                    <div class="relative">
                        <input type="date" name="tahun_masuk" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799]">
                    </div>
                </div>
                <div>
                    <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Tahun Selesai</label>
                    <div class="relative">
                        <input type="date" name="tahun_selesai"
                               :disabled="isCurrent"
                               :class="isCurrent ? 'bg-slate-100 text-slate-400' : 'bg-slate-50'"
                               class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799]">
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <input type="checkbox" id="stillWorking" x-model="isCurrent" class="w-4 h-4 rounded border-slate-300 text-[#074799] focus:ring-[#074799]">
                        <label for="stillWorking" class="text-[11px] font-bold text-slate-500">Masih bekerja di sini</label>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Deskripsi Pekerjaan (Opsional)</label>
                <textarea name="deskripsi" rows="3" placeholder="Ceritakan tanggung jawab dan pencapaian Anda..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799] resize-none"></textarea>
            </div>
        </div>

        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
            <button @click="openModal = false" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-500 rounded-xl font-bold text-xs hover:bg-slate-100 transition-all shadow-sm">Batal</button>
            <button type="submit" class="px-6 py-2.5 bg-[#074799] text-white rounded-xl font-bold text-xs hover:bg-blue-900 transition-all shadow-md">Simpan Pekerjaan</button>
        </div>
        </form>
    </div>
</div>
    <div x-show="openEduModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" 
         x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        
        <div @click.away="openEduModal = false" 
             class="bg-white w-full max-w-xl rounded-[24px] shadow-2xl overflow-hidden border border-slate-100">
            
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-white">
                <h3 class="text-[#074799] font-extrabold text-lg tracking-tight">🎓 Tambah Riwayat Pendidikan</h3>
                <button @click="openEduModal = false" class="text-slate-400 hover:text-red-500 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form action="{{ route('admin.biodata.pendidikan.store', $alumni->nim) }}" method="POST">
            @csrf
            <div class="p-6 space-y-4 max-h-[75vh] overflow-y-auto custom-scroll">
                <div>
                    <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Nama Institusi / Universitas</label>
                    <input type="text" name="nama_instansi" placeholder="Contoh: Politeknik Negeri Jember" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-[#074799] outline-none transition-all placeholder:text-slate-300">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Jenjang</label>
                        <select name="jenjang_pendidikan" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799] appearance-none">
                            <option>SD</option>
                            <option>SMP</option>
                            <option>SMA/SMK</option>
                            <option>D1</option>
                            <option>D2</option>
                            <option>D3</option>
                            <option>D4</option>
                            <option>S1</option>
                            <option>S2</option>
                            <option>S3</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Jurusan / Prodi</label>
                        <input type="text" name="jurusan" placeholder="Teknik Informatika" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799]">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Tahun Mulai</label>
                        <div class="relative">
                            <input type="date" name="tahun_masuk" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799]">
                            <svg class="w-4 h-4 absolute right-4 top-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                    <div>
                        <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Tahun Lulus</label>
                        <div class="relative">
                            <input type="date" name="tahun_keluar" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799]">
                            <svg class="w-4 h-4 absolute right-4 top-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Nilai Akhir / IPK</label>
                    <input type="number" name="nilai_akhir" step="0.01" min="0" max="4" placeholder="Contoh: 3.85 / 4.00" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-[#074799] outline-none">
                </div>

                <div>
                    <label class="block text-slate-600 font-bold text-[11px] uppercase tracking-widest mb-2">Judul Skripsi / Tugas Akhir (Opsional)</label>
                    <textarea name="judul_skripsi" rows="3" placeholder="Masukkan judul skripsi Anda..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-[#074799] resize-none"></textarea>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                <button @click="openEduModal = false" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-500 rounded-xl font-bold text-xs hover:bg-slate-100 transition-all shadow-sm">Batal</button>
                <button type="submit" class="px-6 py-2.5 bg-[#074799] text-white rounded-xl font-bold text-xs hover:bg-blue-900 transition-all shadow-md">Simpan Pendidikan</button>
            </div>
            </form>
        </div>
    </div>

</body>
</html>