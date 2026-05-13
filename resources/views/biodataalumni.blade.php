<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil {{ $alumni->nama }} - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#F1F5F9] min-h-screen flex flex-col">

    {{-- ── Navbar ── --}}
    <nav class="w-full bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-[1300px] mx-auto px-6 md:px-10 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('image/PolijeLogo.png') }}" class="h-10">
                <div>
                    <h1 class="font-extrabold text-[#0067B1] text-lg leading-none">Politeknik Negeri Jember</h1>
                    <p class="text-[10px] tracking-widest text-[#0067B1] font-bold opacity-60 uppercase">Alumni Portal</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('alumni.search') }}"
                   class="flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-[#0067B1] transition-colors uppercase tracking-widest">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('alumni.dashboard') }}"
                       class="bg-[#0067B1] text-white px-5 py-2 rounded-full font-semibold text-sm hover:bg-[#005792] transition-all">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="bg-[#0067B1] text-white px-5 py-2 rounded-full font-semibold text-sm hover:bg-[#005792] transition-all">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-1 py-10 px-6">
        <div class="max-w-[1200px] mx-auto">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-12 gap-6 w-full">

                {{-- ══════════════════════════════════════════
                     BARIS 1: Hero Card (col-8) + Kontak (col-4)
                ══════════════════════════════════════════ --}}

                {{-- Profile Hero Card --}}
                <div class="col-span-12 lg:col-span-8 bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-200">
                    {{-- Foto Sampul --}}
                    <div class="h-28 overflow-hidden relative">
                        @if($alumni->foto_sampul)
                            <img src="{{ Storage::url($alumni->foto_sampul) }}" alt="Foto Sampul" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-r from-[#004a80] via-[#005792] to-[#0072b8] relative overflow-hidden">
                                <svg class="absolute inset-0 w-full h-full opacity-10" preserveAspectRatio="none" viewBox="0 0 800 112" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 50 Q200 0 400 50 Q600 100 800 50 L800 112 L0 112 Z" fill="white"/>
                                    <path d="M0 70 Q200 20 400 70 Q600 120 800 70 L800 112 L0 112 Z" fill="white" opacity="0.5"/>
                                </svg>
                                <div class="absolute top-3 left-6 flex items-center gap-2 opacity-30">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                    </svg>
                                    <span class="text-white text-xs font-bold tracking-widest uppercase">Politeknik Negeri Jember</span>
                                </div>
                                <div class="absolute -top-6 -right-6 w-32 h-32 rounded-full bg-white opacity-5"></div>
                                <div class="absolute -bottom-8 right-24 w-24 h-24 rounded-full bg-white opacity-5"></div>
                            </div>
                        @endif
                    </div>

                    <div class="px-8 pb-8 relative">
                        {{-- Avatar — tanpa tombol Edit Profil --}}
                        <div class="-mt-12 mb-4">
                            @if($alumni->foto_profile)
                                <img src="{{ Storage::url($alumni->foto_profile) }}" alt="Foto Profil"
                                     class="w-24 h-24 rounded-full border-4 border-white shadow-sm object-cover"
                                     onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'">
                            @else
                                <div class="w-24 h-24 rounded-full border-4 border-white shadow-sm bg-[#005792] flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold select-none">
                                        {{ strtoupper(substr($alumni->nama, 0, 1)) }}{{ strtoupper(substr(strstr($alumni->nama, ' ') ?: '', 1, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <h2 class="text-2xl font-bold text-slate-800">{{ $alumni->nama }}</h2>
                        <p class="text-slate-500 text-sm font-medium">{{ $alumni->jabatan_sekarang ?? 'Belum diisi' }}</p>

                        <div class="flex items-center gap-4 mt-3 text-[11px] text-slate-400 font-semibold flex-wrap">
                            @if($alumni->prodi)
                                <span class="flex items-center gap-1 text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">
                                    {{ $alumni->prodi }}
                                </span>
                            @endif
                            @if($alumni->tahun_lulus)
                                <span class="flex items-center gap-1 bg-slate-100 px-2 py-0.5 rounded-full">
                                    Angkatan {{ $alumni->tahun_lulus }}
                                </span>
                            @endif
                            @if($alumni->alamat)
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    {{ $alumni->alamat }}
                                </span>
                            @endif
                            @if($alumni->lama_tunggu_kerja)
                                <span class="flex items-center gap-1 text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Lama Tunggu Kerja: {{ $alumni->lama_tunggu_kerja }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Kontak Card — tanpa tombol Edit --}}
                <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
                    <h3 class="text-slate-800 font-bold mb-6">Kontak</h3>
                    <div class="space-y-4">
                        {{-- Email --}}
                        @if($alumni->show_email)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-slate-400 uppercase">Email</p>
                                <p class="text-xs font-semibold text-slate-700 break-all">{{ $alumni->email ?? '-' }}</p>
                            </div>
                        </div>
                        @else
                        <div class="flex items-center gap-3 opacity-40">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-slate-400 uppercase">Email</p>
                                <p class="text-xs font-semibold text-slate-400 italic">Disembunyikan</p>
                            </div>
                        </div>
                        @endif

                        {{-- Telepon --}}
                        @if($alumni->show_telepon)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-slate-400 uppercase">Telepon</p>
                                <p class="text-xs font-semibold text-slate-700">{{ $alumni->no_telepon ?? '-' }}</p>
                            </div>
                        </div>
                        @else
                        <div class="flex items-center gap-3 opacity-40">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-slate-400 uppercase">Telepon</p>
                                <p class="text-xs font-semibold text-slate-400 italic">Disembunyikan</p>
                            </div>
                        </div>
                        @endif
                        
                    </div>
                </div>

                {{-- ══════════════════════════════════════════
                     BARIS 2: Pendidikan (col-5) + Pekerjaan (col-7)
                ══════════════════════════════════════════ --}}

                {{-- Riwayat Pendidikan — tanpa tombol tambah/edit --}}
                <div class="col-span-12 lg:col-span-5 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <h3 class="text-slate-800 font-bold text-sm mb-6">Riwayat Pendidikan</h3>
                    <div class="space-y-6">
                        @forelse($riwayat_pendidikan as $pendidikan)
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-800">
                                        {{ $pendidikan->jenjang_pendidikan }} - {{ $pendidikan->jurusan ?? '-' }}
                                    </h4>
                                    <p class="text-[11px] text-slate-400 font-medium">{{ $pendidikan->nama_instansi }}</p>
                                    <p class="text-[10px] text-slate-300 font-bold mt-1">
                                        {{ $pendidikan->tahun_masuk ? $pendidikan->tahun_masuk->format('Y') : '-' }} -
                                        {{ $pendidikan->tahun_keluar ? $pendidikan->tahun_keluar->format('Y') : 'Sekarang' }}
                                    </p>
                                    @if($pendidikan->nilai_akhir)
                                        <div class="mt-2 inline-block px-2 py-0.5 bg-blue-50 text-blue-600 text-[9px] font-bold rounded-md">
                                            IPK: {{ number_format($pendidikan->nilai_akhir, 2) }} / 4.00
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 text-center py-4 italic">Belum ada riwayat pendidikan.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Pengalaman Kerja — tanpa tombol tambah/edit, dengan toggle lihat lebih --}}
                <div class="col-span-12 lg:col-span-7 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <h3 class="text-slate-800 font-bold text-sm mb-6">Pengalaman & Detail Pekerjaan</h3>

                    @php $totalPekerjaan = $exp->count(); @endphp

                    <div id="pekerjaanList" class="space-y-6 overflow-hidden transition-all duration-300"
                         style="{{ $totalPekerjaan > 3 ? 'max-height: 280px;' : '' }}">
                        @forelse($exp as $pekerjaan)
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 overflow-hidden">
                                    @if($pekerjaan->logo_perusahaan)
                                        <img src="{{ Storage::url($pekerjaan->logo_perusahaan) }}" alt="Logo"
                                             class="w-full h-full object-cover"
                                             onerror="this.onerror=null;this.style.display='none';this.parentElement.innerHTML='<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'h-5 w-5 text-slate-400\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z\' /></svg>'">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-xs font-bold text-slate-800">{{ $pekerjaan->jobdesk ?? 'Posisi tidak diisi' }}</h4>
                                            <p class="text-[11px] text-slate-400 font-medium">{{ $pekerjaan->nama_perusahaan }}</p>
                                        </div>
                                        <div class="text-right shrink-0 ml-3">
                                            <p class="text-[9px] font-bold text-slate-300">
                                                {{ $pekerjaan->tahun_masuk ? $pekerjaan->tahun_masuk->format('M Y') : '-' }} -
                                                {{ $pekerjaan->tahun_selesai ? $pekerjaan->tahun_selesai->format('M Y') : 'Sekarang' }}
                                            </p>
                                            <span class="inline-block px-2 py-0.5 bg-blue-50 text-blue-600 text-[8px] font-bold rounded uppercase mt-1">
                                                {{ $pekerjaan->status_pekerjaan }}
                                            </span>
                                        </div>
                                    </div>
                                    @if($pekerjaan->deskripsi)
                                        <p class="text-[10px] text-slate-500 leading-relaxed mt-2">
                                            {{ Str::limit($pekerjaan->deskripsi, 120) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 text-center py-4 italic">Belum ada pengalaman kerja.</p>
                        @endforelse
                    </div>

                    {{-- Toggle Lihat Lebih — hanya tampil jika pekerjaan > 3 --}}
                    @if($totalPekerjaan > 3)
                        <div class="mt-4 text-center">
                            <button onclick="togglePekerjaan(this)" data-expanded="false"
                                class="inline-flex items-center gap-1.5 text-[11px] font-bold text-blue-600
                                       hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-full transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" id="pekerjaanChevron"
                                     class="h-3.5 w-3.5 transition-transform duration-300"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                                Lihat {{ $totalPekerjaan - 3 }} pekerjaan lainnya
                            </button>
                        </div>
                    @endif
                </div>

                {{-- ══════════════════════════════════════════
                     BARIS 3: Sertifikasi (col-9) + Social (col-3)
                ══════════════════════════════════════════ --}}

                {{-- Pencapaian & Sertifikasi — tanpa tombol tambah/edit --}}
                <div class="col-span-12 lg:col-span-9 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <h3 class="text-slate-800 font-bold text-sm mb-6">Pencapaian & Sertifikasi</h3>
                    @if($sertifikasi->count() > 0)
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($sertifikasi->take(4) as $serti)
                                <div class="p-3 border border-slate-100 rounded-2xl">
                                    @if($serti->gambar_serti)
                                        <div class="aspect-video bg-slate-50 rounded-xl mb-3 overflow-hidden">
                                            <img src="{{ Storage::url($serti->gambar_serti) }}" alt="Sertifikat"
                                                 class="w-full h-full object-cover"
                                                 onerror="this.onerror=null;this.parentElement.classList.add('bg-gradient-to-br','from-blue-50','to-blue-100','flex','items-center','justify-center');this.remove();">
                                        </div>
                                    @else
                                        <div class="aspect-video bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl mb-3 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <h4 class="text-xs font-bold text-slate-800">{{ $serti->nama }}</h4>
                                    <p class="text-[9px] text-slate-400 font-semibold uppercase mt-1">
                                        {{ $serti->tanggal_terbit ? $serti->tanggal_terbit->format('M Y') : '-' }}
                                        {{ $serti->diterbitkan_oleh ? '• ' . $serti->diterbitkan_oleh : '' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-400 text-center py-4 italic">Belum ada sertifikasi.</p>
                    @endif
                </div>

                {{-- Social Media Card — hanya tampil link yang ada, tanpa tombol edit --}}
                @php
                    $medsosList = $alumni->mediaSosial->keyBy(fn($m) => strtolower(trim($m->nama_platform)));
                    $linkedIn  = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'linkedin'));
                    $github    = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'github'));
                    $instagram = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'instagram'));
                    $tiktok    = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'tiktok'));
                    $xTwitter  = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'twitter') || strtolower(trim($m->nama_platform)) === 'x');
                    $portfolio = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'portfolio') || str_contains(strtolower($m->nama_platform), 'website'));
                @endphp

                <div class="col-span-12 lg:col-span-3 bg-white rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col">
                    <h3 class="text-slate-800 font-bold text-sm mb-6">Social</h3>

                    <div class="grid grid-cols-2 gap-3">

                        {{-- Portfolio --}}
                        @if($portfolio)
                            <a href="{{ $portfolio->link_medsos }}" target="_blank" rel="noopener noreferrer"
                               class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4
                                      hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                                <span class="text-[10px] font-bold">Portfolio</span>
                            </a>
                        @else
                            <div class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 opacity-30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                                <span class="text-[10px] font-bold">Portfolio</span>
                            </div>
                        @endif

                        {{-- LinkedIn --}}
                        @if($linkedIn)
                            <a href="{{ $linkedIn->link_medsos }}" target="_blank" rel="noopener noreferrer"
                               class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4
                                      hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <svg class="h-5 w-5 mb-2 text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                                <span class="text-[10px] font-bold">LinkedIn</span>
                            </a>
                        @else
                            <div class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 opacity-30">
                                <svg class="h-5 w-5 mb-2 text-blue-700" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                <span class="text-[10px] font-bold">LinkedIn</span>
                            </div>
                        @endif

                        {{-- GitHub --}}
                        @if($github)
                            <a href="{{ $github->link_medsos }}" target="_blank" rel="noopener noreferrer"
                               class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4
                                      hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <svg class="h-5 w-5 mb-2 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.042-1.416-4.042-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                <span class="text-[10px] font-bold">GitHub</span>
                            </a>
                        @else
                            <div class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 opacity-30">
                                <svg class="h-5 w-5 mb-2 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.042-1.416-4.042-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                <span class="text-[10px] font-bold">GitHub</span>
                            </div>
                        @endif

                        {{-- Instagram --}}
                        @if($instagram)
                            <a href="{{ $instagram->link_medsos }}" target="_blank" rel="noopener noreferrer"
                               class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4
                                      hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <svg class="h-5 w-5 mb-2 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.849-.07c-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849s.012-3.585.07-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.337 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.351-.2 6.78-2.618 6.98-6.98.058-1.28.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.353-2.612-6.78-6.98-6.98-1.281-.058-1.69-.072-4.949-.072zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                <span class="text-[10px] font-bold">Instagram</span>
                            </a>
                        @else
                            <div class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 opacity-30">
                                <svg class="h-5 w-5 mb-2 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.849-.07c-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849s.012-3.585.07-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.337 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.351-.2 6.78-2.618 6.98-6.98.058-1.28.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.353-2.612-6.78-6.98-6.98-1.281-.058-1.69-.072-4.949-.072zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                <span class="text-[10px] font-bold">Instagram</span>
                            </div>
                        @endif

                        {{-- TikTok --}}
                        @if($tiktok)
                            <a href="{{ $tiktok->link_medsos }}" target="_blank" rel="noopener noreferrer"
                               class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4
                                      hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <svg class="h-5 w-5 mb-2 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.41-.02.16-.03.32-.03.48s.01.32.03.48c.22 1.44 1.49 2.53 2.91 2.53 1.25-.02 2.37-.8 2.82-1.94.13-.33.2-.68.22-1.03.04-3.95.02-7.91.02-11.87z"/></svg>
                                <span class="text-[10px] font-bold">TikTok</span>
                            </a>
                        @else
                            <div class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 opacity-30">
                                <svg class="h-5 w-5 mb-2 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.41-.02.16-.03.32-.03.48s.01.32.03.48c.22 1.44 1.49 2.53 2.91 2.53 1.25-.02 2.37-.8 2.82-1.94.13-.33.2-.68.22-1.03.04-3.95.02-7.91.02-11.87z"/></svg>
                                <span class="text-[10px] font-bold">TikTok</span>
                            </div>
                        @endif

                        {{-- X / Twitter --}}
                        @if($xTwitter)
                            <a href="{{ $xTwitter->link_medsos }}" target="_blank" rel="noopener noreferrer"
                               class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4
                                      hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <svg class="h-4 w-4 mb-2 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.045 4.126H5.078z"/></svg>
                                <span class="text-[10px] font-bold">X</span>
                            </a>
                        @else
                            <div class="border border-slate-100 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 opacity-30">
                                <svg class="h-4 w-4 mb-2 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.045 4.126H5.078z"/></svg>
                                <span class="text-[10px] font-bold">X</span>
                            </div>
                        @endif

                    </div>
                </div>

            </div>{{-- end grid --}}
        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 py-8 mt-10">
        <div class="max-w-[1200px] mx-auto px-10 text-center">
            <p class="text-xs text-slate-400 font-medium">
                © {{ date('Y') }} Politeknik Negeri Jember - Portal Alumni
            </p>
        </div>
    </footer>

    <script>
        function togglePekerjaan(btn) {
            const list    = document.getElementById('pekerjaanList');
            const expanded = btn.dataset.expanded === 'true';

            if (expanded) {
                list.style.maxHeight = '280px';
                list.style.overflow  = 'hidden';
                btn.dataset.expanded = 'false';
                btn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform duration-300"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                    Lihat lebih banyak`;
            } else {
                list.style.maxHeight = list.scrollHeight + 'px';
                list.style.overflow  = 'visible';
                btn.dataset.expanded = 'true';
                btn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 rotate-180 transition-transform duration-300"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
                    </svg>
                    Sembunyikan`;
            }
        }
    </script>

</body>
</html>