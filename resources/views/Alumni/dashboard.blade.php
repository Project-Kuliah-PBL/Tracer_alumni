<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Alumni - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#F1F5F9] h-screen flex flex-col">

    <!-- Header -->
    <div class="shrink-0">
        @include('partials.header-admin')
    </div>

    <div class="flex flex-1 overflow-hidden w-full">
        @include('partials.sidebar-alumni', ['activeMenu' => 'profil'])

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-8 custom-scroll">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-semibold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-12 gap-6 w-full">

                <!-- Profile Header Card -->
                <div class="col-span-8 bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-200">
                    <!-- Foto Sampul -->
                    <div class="h-28 overflow-hidden relative">
                        @if($alumni->foto_sampul)
                            <img src="{{ Storage::url($alumni->foto_sampul) }}" alt="Foto Sampul" class="w-full h-full object-cover">
                        @else
                            {{-- Default sampul: gradien + pola gelombang SVG --}}
                            <div class="w-full h-full bg-gradient-to-r from-[#004a80] via-[#005792] to-[#0072b8] relative overflow-hidden">
                                <svg class="absolute inset-0 w-full h-full opacity-10" preserveAspectRatio="none" viewBox="0 0 800 112" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 50 Q200 0 400 50 Q600 100 800 50 L800 112 L0 112 Z" fill="white"/>
                                    <path d="M0 70 Q200 20 400 70 Q600 120 800 70 L800 112 L0 112 Z" fill="white" opacity="0.5"/>
                                </svg>
                                <div class="absolute top-3 left-6 flex items-center gap-2 opacity-30">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                    <span class="text-white text-xs font-bold tracking-widest uppercase">Politeknik Negeri Jember</span>
                                </div>
                                {{-- Lingkaran dekoratif --}}
                                <div class="absolute -top-6 -right-6 w-32 h-32 rounded-full bg-white opacity-5"></div>
                                <div class="absolute -bottom-8 right-24 w-24 h-24 rounded-full bg-white opacity-5"></div>
                            </div>
                        @endif
                    </div>
                    <div class="px-8 pb-8 relative">
                        <div class="flex justify-between items-end -mt-12 mb-4">
                            <div class="relative">
                                @if($alumni->foto_profile)
                                    <img src="{{ Storage::url($alumni->foto_profile) }}" alt="Foto Profil"
                                        class="w-24 h-24 rounded-full border-4 border-white shadow-sm object-cover"
                                        onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'">
                                @else
                                    {{-- Default avatar: inisial nama dengan warna brand --}}
                                    <div class="w-24 h-24 rounded-full border-4 border-white shadow-sm bg-[#005792] flex items-center justify-center">
                                        <span class="text-white text-2xl font-bold select-none">
                                            {{ strtoupper(substr($alumni->nama, 0, 1)) }}{{ strtoupper(substr(strstr($alumni->nama, ' ') ?: '', 1, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <button onclick="openEditModal()" class="px-6 py-1.5 border border-slate-300 rounded-full text-blue-600 font-bold text-[11px] hover:bg-slate-50 transition-all active:scale-95">
                                Edit Profil
                            </button>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800">{{ $alumni->nama }}</h2>
                        @php
                            // jabatan_sekarang auto-diupdate oleh PekerjaanController::syncAlumniFromPekerjaan
                            // Jika belum ada di DB, coba ambil langsung dari relasi pekerjaan aktif
                            $jabatanTampil = $alumni->jabatan_sekarang;
                            if (!$jabatanTampil) {
                                $pekerjaanAktif = $alumni->pekerjaan->whereNull('tahun_selesai')->sortByDesc('tahun_masuk')->first()
                                               ?? $alumni->pekerjaan->sortByDesc('tahun_masuk')->first();
                                if ($pekerjaanAktif) {
                                    $bagian = array_filter([$pekerjaanAktif->jobdesk, $pekerjaanAktif->nama_perusahaan]);
                                    $jabatanTampil = implode(' – ', $bagian);
                                }
                            }
                        @endphp
                        <p class="text-slate-500 text-sm font-medium">{{ $jabatanTampil ?? 'Belum diisi' }}</p>
                        <div class="flex items-center gap-4 mt-3 text-[11px] text-slate-400 font-semibold flex-wrap">
                            @if($alumni->alamat)
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                                {{ $alumni->alamat }}
                            </span>
                            @endif
                            @if($alumni->lama_tunggu_kerja)
                            <span class="flex items-center gap-1 text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Lama Tunggu Kerja: {{ $alumni->lama_tunggu_kerja }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Profil -->
                <div id="editProfileModal" class="fixed inset-0 z-[999] hidden">
                    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
                    <div class="flex items-center justify-center min-h-screen p-4">
                        <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl relative overflow-hidden flex flex-col max-h-[90vh]">
                            <div class="flex justify-between items-center px-8 py-5 border-b border-slate-100 shrink-0">
                                <h3 class="text-[#005792] font-bold text-lg">Edit Profil</h3>
                                <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>

                            <form action="{{ route('alumni.profil.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 overflow-hidden">
                                @csrf
                                @method('PUT')

                                <div class="px-8 py-6 overflow-y-auto flex-1">
                                    <div class="space-y-6">

                                        <!-- Foto Sampul -->
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-slate-600">Foto Sampul</label>
                                            <div class="relative h-40 rounded-xl overflow-hidden bg-slate-100 border-2 border-dashed border-slate-300 group">
                                                @if($alumni->foto_sampul)
                                                    <img src="{{ Storage::url($alumni->foto_sampul) }}" id="coverPreview" class="w-full h-full object-cover" alt="Cover Preview">
                                                @else
                                                    {{-- Default sampul preview --}}
                                                    <div id="coverPreview" class="w-full h-full bg-gradient-to-r from-[#004a80] via-[#005792] to-[#0072b8] relative overflow-hidden">
                                                        <svg class="absolute inset-0 w-full h-full opacity-10" preserveAspectRatio="none" viewBox="0 0 800 160" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M0 70 Q200 10 400 70 Q600 130 800 70 L800 160 L0 160 Z" fill="white"/>
                                                        </svg>
                                                        <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white opacity-5"></div>
                                                    </div>
                                                @endif
                                                <label for="foto_sampul" class="absolute inset-0 flex items-center justify-center cursor-pointer">
                                                    <span class="bg-white/90 px-4 py-2 rounded-full shadow-sm text-sm font-bold text-slate-700 flex items-center gap-2 hover:bg-white transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                        Ganti Sampul
                                                    </span>
                                                </label>
                                                <input type="file" id="foto_sampul" name="foto_sampul" accept="image/*" class="hidden" onchange="previewCover(this)">
                                            </div>
                                        </div>

                                        <!-- Foto Profil -->
                                        <div class="flex items-center gap-5">
                                            <label for="foto_profile" class="relative group cursor-pointer">
                                                @if($alumni->foto_profile)
                                                    <img src="{{ Storage::url($alumni->foto_profile) }}" id="avatarPreview" class="w-20 h-20 rounded-2xl border-2 border-slate-100 object-cover" alt="Avatar"
                                                        onerror="this.onerror=null;this.outerHTML='<div id=\'avatarPreview\' class=\'w-20 h-20 rounded-2xl border-2 border-slate-100 bg-[#005792] flex items-center justify-center\'><span class=\'text-white text-xl font-bold\'>{{ strtoupper(substr($alumni->nama,0,1)) }}</span></div>'">
                                                @else
                                                    <div id="avatarPreview" class="w-20 h-20 rounded-2xl border-2 border-slate-100 bg-[#005792] flex items-center justify-center">
                                                        <span class="text-white text-xl font-bold select-none">
                                                            {{ strtoupper(substr($alumni->nama, 0, 1)) }}{{ strtoupper(substr(strstr($alumni->nama, ' ') ?: '', 1, 1)) }}
                                                        </span>
                                                    </div>
                                                @endif
                                                <div class="absolute inset-0 bg-black/20 rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /></svg>
                                                </div>
                                                <input type="file" id="foto_profile" name="foto_profile" accept="image/*" class="hidden" onchange="previewAvatar(this)">
                                            </label>
                                            <div class="space-y-1">
                                                <h4 class="text-sm font-bold text-slate-700">Foto Profil</h4>
                                                <p class="text-xs text-slate-400 leading-relaxed">Disarankan format JPG atau PNG dengan ukuran minimal 400x400px.</p>
                                            </div>
                                        </div>

                                        <!-- Input Fields -->
                                        <div class="space-y-4">
                                            <div class="space-y-1.5">
                                                <label class="text-sm font-semibold text-slate-600">Nama Lengkap <span class="text-red-500">*</span></label>
                                                <input type="text" name="nama" value="{{ old('nama', $alumni->nama) }}" placeholder="Masukkan nama lengkap" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                                            </div>

                                            <div class="grid grid-cols-2 gap-4">
                                                <div class="space-y-1.5">
    <label class="text-sm font-semibold text-slate-600">Status Pekerjaan</label>
    <div class="flex gap-4">
        
        <!-- Tombol Belum Bekerja -->
        <label class="flex-1 cursor-pointer group">
            <input type="radio" name="status_pekerjaan" value="belum" class="peer hidden" {{ old('status_pekerjaan') == 'belum' ? 'checked' : '' }}>
            <div class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl border-2 border-slate-100 transition-all text-slate-500 
                        peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-600">
                
                <!-- Lingkaran Indicator -->
                <div class="w-5 h-5 rounded-full border-2 border-slate-200 flex items-center justify-center transition-all 
                            peer-checked:border-blue-500 group-hover:border-blue-300">
                    <div class="w-2.5 h-2.5 rounded-full bg-blue-500 scale-0 peer-checked:scale-100 transition-transform"></div>
                </div>
                
                <span class="text-sm font-bold">Belum Bekerja</span>
            </div>
        </label>

        <!-- Tombol Sudah Bekerja -->
        <label class="flex-1 cursor-pointer group">
            <input type="radio" name="status_pekerjaan" value="sudah" class="peer hidden" {{ old('status_pekerjaan', $alumni->jabatan_sekarang ? 'sudah' : '') == 'sudah' ? 'checked' : '' }}>
            <div class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl border-2 border-slate-100 transition-all text-slate-500 
                        peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-600">
                
                <!-- Lingkaran Indicator -->
                <div class="w-5 h-5 rounded-full border-2 border-slate-200 flex items-center justify-center transition-all 
                            peer-checked:border-blue-500 group-hover:border-blue-300">
                    <div class="w-2.5 h-2.5 rounded-full bg-blue-500 scale-0 peer-checked:scale-100 transition-transform"></div>
                </div>
                
                <span class="text-sm font-bold">Sudah Bekerja</span>
            </div>
        </label>

    </div>
</div>
                                                <div class="space-y-1.5">
                                                    <label class="text-sm font-semibold text-slate-600">Alamat</label>
                                                    <input type="text" name="alamat" value="{{ old('alamat', $alumni->alamat) }}" placeholder="Contoh: Jember, Jawa Timur" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-2 gap-4">
                                                <div class="space-y-1.5">
                                                    <label class="text-sm font-semibold text-slate-600">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium bg-white">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Laki-laki" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                        <option value="Perempuan" {{ old('jenis_kelamin', $alumni->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-end gap-3 shrink-0">
                                    <button type="button" onclick="closeEditModal()" class="px-8 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold text-sm transition-all shadow-lg shadow-red-100">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-8 py-2.5 bg-[#005792] hover:bg-[#004677] text-white rounded-xl font-bold text-sm transition-all shadow-lg shadow-blue-100">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

      <!-- Kontak Card -->
<div class="col-span-4 bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-slate-800 font-bold">Kontak</h3>
        <button onclick="openModalKontak()" class="text-slate-400 hover:text-slate-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
        </button>
    </div>
    
    <div class="space-y-4">
        <!-- Email Item -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-[9px] font-bold text-slate-400 uppercase">Email</p>
                <p class="text-xs font-semibold text-slate-700">{{ $alumni->email ?? '-' }}</p>
            </div>
        </div>

        <!-- Telepon Item -->
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
    </div>
</div>

             <!-- Modal Edit Kontak -->
<div id="modalKontak" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[99] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-[28px] shadow-2xl overflow-hidden flex flex-col transform transition-all">
        <div class="px-8 py-6 flex justify-between items-center">
            <h3 class="text-[#0067B1] font-bold text-xl">Edit Kontak</h3>
            <button type="button" onclick="closeModalKontak()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <hr class="border-slate-100">
        
        <form action="{{ route('alumni.profil.update') }}" method="POST" class="p-8 space-y-6">
    @csrf
    @method('PUT')
    <input type="hidden" name="_update_kontak" value="1">
    <input type="hidden" name="nama" value="{{ $alumni->nama }}">
    <div class="space-y-3">
        <div class="flex justify-between items-center">
            <label class="block text-sm font-semibold text-slate-600 ml-1">Email</label>
            
           <!-- Checklist Visibilitas -->
<label class="flex items-center gap-2 cursor-pointer group">
    <!-- Input asli disembunyikan -->
    <input type="checkbox" name="show_email" value="1" class="peer hidden" {{ old('show_email', $alumni->show_email ?? false) ? 'checked' : '' }}>
    
    <!-- Box Custom -->
    <div class="w-5 h-5 border-2 border-slate-200 rounded-md flex items-center justify-center peer-checked:bg-[#0067B1] peer-checked:border-[#0067B1] transition-colors">
        <!-- Ikon Centang: Hidden secara default, Block saat peer-checked -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-white hidden peer-checked:block" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </div>
    
    <span class="text-[10px] font-bold text-slate-400 peer-checked:text-[#0067B1] uppercase tracking-wider">Tampilkan</span>
</label>
        </div>
        <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#0067B1]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </span>
            <input type="email" name="email" value="{{ old('email', $alumni->email) }}" placeholder="Masukkan email" class="w-full pl-12 pr-4 py-3.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] outline-none transition-all text-slate-700">
        </div>
    </div>

    <!-- Input Nomor Telepon -->
    <div class="space-y-3">
        <div class="flex justify-between items-center">
            <label class="block text-sm font-semibold text-slate-600 ml-1">Nomor Telepon</label>
            
          <!-- Checklist Visibilitas -->
<label class="flex items-center gap-2 cursor-pointer group">
    <!-- Input asli disembunyikan -->
    <input type="checkbox" name="show_telepon" value="1" class="peer hidden" {{ old('show_telepon', $alumni->show_telepon ?? false) ? 'checked' : '' }}>
    
    <!-- Box Custom -->
    <div class="w-5 h-5 border-2 border-slate-200 rounded-md flex items-center justify-center peer-checked:bg-[#0067B1] peer-checked:border-[#0067B1] transition-colors">
        <!-- Ikon Centang: Hidden secara default, Block saat peer-checked -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-white hidden peer-checked:block" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </div>
    
    <span class="text-[10px] font-bold text-slate-400 peer-checked:text-[#0067B1] uppercase tracking-wider">Tampilkan</span>
</label>
        </div>
        <div class="relative group">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#0067B1]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
            </span>
            <input type="text" name="no_telepon" value="{{ old('no_telepon', $alumni->no_telepon) }}" placeholder="Masukkan nomor telepon" class="w-full pl-12 pr-4 py-3.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] outline-none transition-all text-slate-700">
        </div>
    </div>

    <div class="pt-4 flex justify-center gap-4">
        <button type="button" onclick="closeModalKontak()" class="w-full max-w-[140px] py-3.5 rounded-xl bg-[#D93025] text-white font-bold text-sm hover:bg-red-700 transition-all">
            Batal
        </button>
        <button type="submit" class="w-full max-w-[180px] py-3.5 rounded-xl bg-[#0067B1] text-white font-bold text-sm hover:bg-[#005792] transition-all">
            Simpan Perubahan
        </button>
    </div>
</form>
    </div>
</div>
                <!-- Riwayat Pendidikan -->
                <div class="col-span-5 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-sm">Riwayat Pendidikan</h3>
                        <div class="flex gap-2">
                            <button onclick="openModalTambahPendidikan()" class="text-slate-400 hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            </button>
                            <a href="{{ route('alumni.pendidikan.index') }}" class="text-slate-400 hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </a>
                        </div>
                    </div>
                    <div class="space-y-6">
                        @forelse($alumni->riwayatPendidikan->take(3) as $pendidikan)
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800">{{ $pendidikan->jenjang_pendidikan }} - {{ $pendidikan->jurusan ?? '-' }}</h4>
                                <p class="text-[11px] text-slate-400 font-medium">{{ $pendidikan->nama_instansi }}</p>
                                <p class="text-[10px] text-slate-300 font-bold mt-1">
                                    {{ $pendidikan->tahun_masuk ? $pendidikan->tahun_masuk->format('Y') : '-' }} -
                                    {{ $pendidikan->tahun_keluar ? $pendidikan->tahun_keluar->format('Y') : 'Sekarang' }}
                                </p>
                                @if($pendidikan->nilai_akhir)
                                <div class="mt-2 inline-block px-2 py-0.5 bg-blue-50 text-blue-600 text-[9px] font-bold rounded-md">IPK: {{ number_format($pendidikan->nilai_akhir, 2) }} / 4.00</div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p class="text-xs text-slate-400 text-center py-4">Belum ada riwayat pendidikan. <a href="{{ route('alumni.pendidikan.create') }}" class="text-blue-500">Tambah</a></p>
                        @endforelse
                    </div>
                </div>

                <!-- Pengalaman Kerja -->
                <div class="col-span-7 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-sm">Pengalaman & Detail Pekerjaan</h3>
                        <div class="flex gap-2 text-slate-400">
                            <button onclick="openModalTambahPekerjaan()" class="hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            </button>
                            <a href="{{ route('alumni.pekerjaan.index') }}" class="hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </a>
                        </div>
                    </div>
                    @php $totalPekerjaan = $alumni->pekerjaan->count(); @endphp
                    <div id="pekerjaanList" class="space-y-6 overflow-hidden transition-all duration-300" style="{{ $totalPekerjaan > 3 ? 'max-height: 280px;' : '' }}">
                        @forelse($alumni->pekerjaan as $pekerjaan)
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 overflow-hidden">
                                @if($pekerjaan->logo_perusahaan)
                                    <img src="{{ Storage::url($pekerjaan->logo_perusahaan) }}" alt="Logo" class="w-full h-full object-cover"
                                        onerror="this.onerror=null;this.style.display='none';this.parentElement.innerHTML='<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'h-5 w-5 text-slate-400\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z\' /></svg>'">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-800">{{ $pekerjaan->jobdesk ?? 'Posisi tidak diisi' }}</h4>
                                        <p class="text-[11px] text-slate-400 font-medium">{{ $pekerjaan->nama_perusahaan }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[9px] font-bold text-slate-300">
                                            {{ $pekerjaan->tahun_masuk ? $pekerjaan->tahun_masuk->format('M Y') : '-' }} -
                                            {{ $pekerjaan->tahun_selesai ? $pekerjaan->tahun_selesai->format('M Y') : 'Sekarang' }}
                                        </p>
                                        <span class="inline-block px-2 py-0.5 bg-blue-50 text-blue-600 text-[8px] font-bold rounded uppercase mt-1">{{ $pekerjaan->status_pekerjaan }}</span>
                                    </div>
                                </div>
                                @if($pekerjaan->deskripsi)
                                    <p class="text-[10px] text-slate-500 leading-relaxed mt-2">{{ Str::limit($pekerjaan->deskripsi, 100) }}</p>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p class="text-xs text-slate-400 text-center py-4">Belum ada pengalaman kerja. <a href="{{ route('alumni.pekerjaan.create') }}" class="text-blue-500">Tambah</a></p>
                        @endforelse
                    </div>
                    @if($totalPekerjaan > 3)
                    <div class="mt-4 text-center">
                        <button onclick="togglePekerjaan(this)" data-expanded="false"
                            class="inline-flex items-center gap-1.5 text-[11px] font-bold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-full transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" id="pekerjaanChevron" class="h-3.5 w-3.5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                            Lihat {{ $totalPekerjaan - 3 }} pekerjaan lainnya
                        </button>
                    </div>
                    @endif
                </div>

                <!-- Pencapaian & Sertifikasi -->
                <div class="col-span-9 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-sm">Pencapaian & Sertifikasi</h3>
                        <div class="flex gap-2 text-slate-400">
                            <button onclick="openModalTambahSertifikasi()" class="hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            </button>
                            <a href="{{ route('alumni.sertifikasi.index') }}" class="hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </a>
                        </div>
                    </div>
                    @if($alumni->sertifikasi->count() > 0)
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($alumni->sertifikasi->take(4) as $serti)
                        <div class="p-3 border border-slate-100 rounded-2xl">
                            @if($serti->gambar_serti)
                                <div class="aspect-video bg-slate-50 rounded-xl mb-3 overflow-hidden">
                                    <img src="{{ Storage::url($serti->gambar_serti) }}" alt="Sertifikat" class="w-full h-full object-cover"
                                        onerror="this.onerror=null;this.parentElement.classList.add('bg-gradient-to-br','from-blue-50','to-blue-100','flex','items-center','justify-center');this.outerHTML='<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'h-8 w-8 text-blue-300\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z\' /></svg>'">
                                </div>
                            @else
                                <div class="aspect-video bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl mb-3 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
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
                    <p class="text-xs text-slate-400 text-center py-4">Belum ada sertifikasi. <a href="{{ route('alumni.sertifikasi.create') }}" class="text-blue-500">Tambah</a></p>
                    @endif
                </div>
<!-- Social Media Card -->
                @php
                    $medsosList = $alumni->mediaSosial->keyBy(fn($m) => strtolower(trim($m->nama_platform)));
                    
                    $linkedIn   = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'linkedin'));
                    $github     = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'github'));
                    $instagram  = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'instagram'));
                    $tiktok     = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'tiktok'));
                    $xTwitter   = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'twitter') || strtolower(trim($m->nama_platform)) === 'x');
                    $portfolio  = $medsosList->first(fn($m) => str_contains(strtolower($m->nama_platform), 'portfolio') || str_contains(strtolower($m->nama_platform), 'website'));
                @endphp

                <div class="col-span-3 bg-white rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-sm">Social</h3>
                        <button onclick="openModal()" class="text-slate-400 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        {{-- Portfolio --}}
                        @if($portfolio)
                            <a href="{{ $portfolio->link_medsos }}" target="_blank" rel="noopener noreferrer" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                        @else
                            <button onclick="openModal()" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group opacity-40 hover:opacity-100">
                        @endif
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                                <span class="text-[10px] font-bold">Portfolio</span>
                        @if($portfolio) </a> @else </button> @endif

                        {{-- LinkedIn --}}
                        @if($linkedIn)
                            <a href="{{ $linkedIn->link_medsos }}" target="_blank" rel="noopener noreferrer" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                        @else
                            <button onclick="openModal()" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group opacity-40 hover:opacity-100">
                        @endif
                                <svg class="h-5 w-5 mb-2 text-blue-700" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                <span class="text-[10px] font-bold">LinkedIn</span>
                        @if($linkedIn) </a> @else </button> @endif

                        {{-- GitHub --}}
                        @if($github)
                            <a href="{{ $github->link_medsos }}" target="_blank" rel="noopener noreferrer" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                        @else
                            <button onclick="openModal()" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group opacity-40 hover:opacity-100">
                        @endif
                                <svg class="h-5 w-5 mb-2 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.042-1.416-4.042-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                <span class="text-[10px] font-bold">GitHub</span>
                        @if($github) </a> @else </button> @endif

                        {{-- Instagram --}}
                        @if($instagram)
                            <a href="{{ $instagram->link_medsos }}" target="_blank" rel="noopener noreferrer" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                        @else
                            <button onclick="openModal()" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group opacity-40 hover:opacity-100">
                        @endif
                                <svg class="h-5 w-5 mb-2 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.849-.07c-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849s.012-3.585.07-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.337 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.351-.2 6.78-2.618 6.98-6.98.058-1.28.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.353-2.612-6.78-6.98-6.98-1.281-.058-1.69-.072-4.949-.072zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                <span class="text-[10px] font-bold">Instagram</span>
                        @if($instagram) </a> @else </button> @endif

                        {{-- TikTok --}}
                        @if($tiktok)
                            <a href="{{ $tiktok->link_medsos }}" target="_blank" rel="noopener noreferrer" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                        @else
                            <button onclick="openModal()" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group opacity-40 hover:opacity-100">
                        @endif
                                <svg class="h-5 w-5 mb-2 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.41-.02.16-.03.32-.03.48s.01.32.03.48c.22 1.44 1.49 2.53 2.91 2.53 1.25-.02 2.37-.8 2.82-1.94.13-.33.2-.68.22-1.03.04-3.95.02-7.91.02-11.87z"/></svg>
                                <span class="text-[10px] font-bold">TikTok</span>
                        @if($tiktok) </a> @else </button> @endif

                        {{-- X (Twitter) --}}
                        @if($xTwitter)
                            <a href="{{ $xTwitter->link_medsos }}" target="_blank" rel="noopener noreferrer" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                        @else
                            <button onclick="openModal()" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group opacity-40 hover:opacity-100">
                        @endif
                                <svg class="h-4 w-4 mb-2 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.045 4.126H5.078z"/></svg>
                                <span class="text-[10px] font-bold">X</span>
                        @if($xTwitter) </a> @else </button> @endif
                    </div>
                </div>
<!-- Modal Edit Media Sosial -->
<div id="modalSocial" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[99] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-[400px] rounded-2xl shadow-2xl overflow-hidden flex flex-col">
        
        <!-- Header -->
        <div class="px-5 py-4 flex justify-between items-center border-b border-slate-100">
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-4 bg-[#0063a7] rounded-full"></div>
                <h3 class="text-[#005792] font-bold text-sm">Edit Media Sosial</h3>
            </div>
            <button type="button" onclick="closeModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('alumni.medsos.bulk') }}" method="POST" class="p-5">
            @csrf
            @method('PUT')

            {{-- Ambil data existing per platform --}}
            @php
                $msLinkedIn  = $alumni->mediaSosial->first(fn($m) => str_contains(strtolower($m->nama_platform), 'linkedin'));
                $msGithub    = $alumni->mediaSosial->first(fn($m) => str_contains(strtolower($m->nama_platform), 'github'));
                $msPortfolio = $alumni->mediaSosial->first(fn($m) => str_contains(strtolower($m->nama_platform), 'portfolio') || str_contains(strtolower($m->nama_platform), 'website'));
                $msInstagram = $alumni->mediaSosial->first(fn($m) => str_contains(strtolower($m->nama_platform), 'instagram'));
                $msTiktok    = $alumni->mediaSosial->first(fn($m) => str_contains(strtolower($m->nama_platform), 'tiktok'));
                $msX         = $alumni->mediaSosial->first(fn($m) => str_contains(strtolower($m->nama_platform), 'twitter') || strtolower(trim($m->nama_platform)) === 'x');
            @endphp

            <div class="grid grid-cols-1 gap-4 max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                {{-- LinkedIn --}}
                <div class="space-y-1.5">
                    <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        LinkedIn
                    </label>
                    <input type="hidden" name="platforms[linkedin][id]" value="{{ $msLinkedIn->id ?? '' }}">
                    <input type="url" name="platforms[linkedin][link]" value="{{ $msLinkedIn->link_medsos ?? '' }}" placeholder="https://linkedin.com/in/..." class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:border-[#0063a7] focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                </div>

                {{-- GitHub --}}
                <div class="space-y-1.5">
                    <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        GitHub
                    </label>
                    <input type="hidden" name="platforms[github][id]" value="{{ $msGithub->id ?? '' }}">
                    <input type="url" name="platforms[github][link]" value="{{ $msGithub->link_medsos ?? '' }}" placeholder="https://github.com/..." class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:border-[#0063a7] focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    {{-- Instagram --}}
                    <div class="space-y-1.5">
                        <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-wider">
                            <span class="p-0.5 bg-gradient-to-br from-pink-500 to-orange-400 rounded text-white flex items-center">
                                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </span>
                            Instagram
                        </label>
                        <input type="hidden" name="platforms[instagram][id]" value="{{ $msInstagram->id ?? '' }}">
                        <input type="url" name="platforms[instagram][link]" value="{{ $msInstagram->link_medsos ?? '' }}" placeholder="@username" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:border-[#0063a7] outline-none">
                    </div>

                    {{-- TikTok --}}
                    <div class="space-y-1.5">
                        <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-wider">
                            <svg class="w-3.5 h-3.5 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.41-.02.16-.03.32-.03.48s.01.32.03.48c.22 1.44 1.49 2.53 2.91 2.53 1.25-.02 2.37-.8 2.82-1.94.13-.33.2-.68.22-1.03.04-3.95.02-7.91.02-11.87z"/></svg>
                            TikTok
                        </label>
                        <input type="hidden" name="platforms[tiktok][id]" value="{{ $msTiktok->id ?? '' }}">
                        <input type="url" name="platforms[tiktok][link]" value="{{ $msTiktok->link_medsos ?? '' }}" placeholder="@username" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:border-[#0063a7] outline-none">
                    </div>
                </div>

                {{-- X (Twitter) --}}
                <div class="space-y-1.5">
                    <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.045 4.126H5.078z"/></svg>
                        X / Twitter
                    </label>
                    <input type="hidden" name="platforms[x][id]" value="{{ $msX->id ?? '' }}">
                    <input type="url" name="platforms[x][link]" value="{{ $msX->link_medsos ?? '' }}" placeholder="https://x.com/..." class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:border-[#0063a7] outline-none transition-all">
                </div>

                {{-- Portfolio --}}
                <div class="space-y-1.5 pb-2">
                    <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        Portfolio / Website
                    </label>
                    <input type="hidden" name="platforms[portfolio][id]" value="{{ $msPortfolio->id ?? '' }}">
                    <input type="url" name="platforms[portfolio][link]" value="{{ $msPortfolio->link_medsos ?? '' }}" placeholder="https://..." class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:border-[#0063a7] outline-none">
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-4 bg-blue-50 border border-blue-100 rounded-xl p-3 flex gap-3">
                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <p class="text-[10px] text-blue-700 leading-tight">
                    Tautan akan ditampilkan secara publik untuk memudahkan rekruter atau rekan alumni menghubungi Anda.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mt-5">
                <button type="button" onclick="closeModal()" class="flex-1 py-2.5 rounded-xl bg-slate-100 text-slate-600 font-bold text-xs hover:bg-slate-200 transition-all">Batal</button>
                <button type="submit" class="flex-[2] py-2.5 rounded-xl bg-[#0063a7] text-white font-bold text-xs shadow-lg shadow-blue-900/20 hover:bg-[#004a7c] transition-all">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
</style>

    <script>
        // Toggle Show More Pekerjaan
        function togglePekerjaan(btn) {
            const list = document.getElementById('pekerjaanList');
            const chevron = document.getElementById('pekerjaanChevron');
            const expanded = btn.dataset.expanded === 'true';
            if (expanded) {
                list.style.maxHeight = '280px';
                list.style.overflow = 'hidden';
                btn.dataset.expanded = 'false';
                chevron.style.transform = 'rotate(0deg)';
                const totalHidden = btn.textContent.trim().match(/\d+/);
                btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" id="pekerjaanChevron" class="h-3.5 w-3.5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg> Lihat ${totalHidden ? totalHidden[0] : 'lebih banyak'} pekerjaan lainnya`;
            } else {
                list.style.maxHeight = list.scrollHeight + 'px';
                list.style.overflow = 'visible';
                btn.dataset.expanded = 'true';
                btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" id="pekerjaanChevron" class="h-3.5 w-3.5 transition-transform duration-300 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" /></svg> Sembunyikan`;
            }
        }

        // Edit Profil Modal
        function openEditModal() {
            document.getElementById('editProfileModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeEditModal() {
            document.getElementById('editProfileModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        document.getElementById('editProfileModal').addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });

        // Kontak Modal
        const modalKontak = document.getElementById('modalKontak');
        function openModalKontak() { modalKontak.classList.remove('hidden'); modalKontak.classList.add('flex'); }
        function closeModalKontak() { modalKontak.classList.add('hidden'); modalKontak.classList.remove('flex'); }
        window.addEventListener('click', (e) => { if (e.target == modalKontak) closeModalKontak(); });

        // Social Modal
        const modal = document.getElementById('modalSocial');
        function openModal() { modal.classList.remove('hidden'); modal.classList.add('flex'); }
        function closeModal() { modal.classList.add('hidden'); modal.classList.remove('flex'); }
        window.onclick = function(e) { if (e.target == modal) closeModal(); }

        // Preview foto
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    const el = document.getElementById('avatarPreview');
                    if (el.tagName === 'IMG') {
                        el.src = e.target.result;
                    } else {
                        el.outerHTML = `<img id="avatarPreview" src="${e.target.result}" class="w-20 h-20 rounded-2xl border-2 border-slate-100 object-cover" alt="Avatar">`;
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function previewCover(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    const el = document.getElementById('coverPreview');
                    if (el && el.tagName === 'IMG') {
                        el.src = e.target.result;
                    } else {
                        // Ganti div default menjadi img preview
                        const parent = el.parentNode;
                        const img = document.createElement('img');
                        img.id = 'coverPreview';
                        img.src = e.target.result;
                        img.className = 'w-full h-full object-cover';
                        img.alt = 'Cover Preview';
                        parent.replaceChild(img, el);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

{{-- Toast Popup Notifikasi Berhasil --}}
@if(session('success_popup'))
<div id="toastSuccess" class="fixed top-6 right-6 z-[9999] flex items-center gap-3 bg-white border border-green-200 shadow-xl rounded-2xl px-5 py-4 min-w-[280px] max-w-sm animate-slide-in">
    <div class="w-9 h-9 bg-green-100 rounded-full flex items-center justify-center shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
        </svg>
    </div>
    <div class="flex-1">
        <p class="text-sm font-bold text-slate-800">Berhasil!</p>
        <p class="text-xs text-slate-500 mt-0.5">{{ session('success_popup') }}</p>
    </div>
    <button onclick="document.getElementById('toastSuccess').remove()" class="text-slate-300 hover:text-slate-500 transition-colors ml-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
<style>
@keyframes slideIn {
    from { transform: translateX(120%); opacity: 0; }
    to   { transform: translateX(0);    opacity: 1; }
}
.animate-slide-in { animation: slideIn 0.4s cubic-bezier(0.16,1,0.3,1) forwards; }
</style>
<script>
    // Auto-dismiss setelah 4 detik
    setTimeout(() => {
        const toast = document.getElementById('toastSuccess');
        if (toast) {
            toast.style.transition = 'opacity 0.4s, transform 0.4s';
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(120%)';
            setTimeout(() => toast.remove(), 400);
        }
    }, 4000);
</script>
@endif
{{-- ===================== MODAL TAMBAH RIWAYAT PENDIDIKAN ===================== --}}
<div id="modalTambahPendidikan" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[999] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="flex justify-between items-center px-8 py-5 border-b border-slate-100 shrink-0">
            <h3 class="text-[#005792] font-bold text-lg">Tambah Riwayat Pendidikan</h3>
            <button onclick="closeModalTambahPendidikan()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <form action="{{ route('alumni.pendidikan.store') }}" method="POST" class="flex flex-col flex-1 overflow-hidden">
            @csrf
            <div class="px-8 py-6 overflow-y-auto flex-1 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Nama Instansi / Sekolah <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_instansi" value="{{ old('nama_instansi') }}" placeholder="Contoh: Politeknik Negeri Jember" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Jenjang Pendidikan <span class="text-red-500">*</span></label>
                        <select name="jenjang_pendidikan" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium bg-white">
                            <option value="">-- Pilih Jenjang --</option>
                            @foreach(['SD','SMP','SMA/SMK','D1','D2','D3','D4','S1','S2','S3'] as $j)
                            <option value="{{ $j }}" {{ old('jenjang_pendidikan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Jurusan / Program Studi</label>
                        <input type="text" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: Teknik Informatika" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Tahun Masuk</label>
                        <input type="date" name="tahun_masuk" value="{{ old('tahun_masuk') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Tahun Keluar <span class="text-slate-400 font-normal text-xs">(kosongkan jika masih aktif)</span></label>
                        <input type="date" name="tahun_keluar" value="{{ old('tahun_keluar') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Nilai Akhir (IPK)</label>
                        <input type="number" name="nilai_akhir" value="{{ old('nilai_akhir') }}" step="0.01" min="0" max="4" placeholder="Contoh: 3.75" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                        <p class="text-xs text-slate-400 mt-1">Skala 0.00 – 4.00</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Judul Skripsi / Tugas Akhir</label>
                        <input type="text" name="judul_skripsi" value="{{ old('judul_skripsi') }}" placeholder="Kosongkan jika belum ada" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                </div>
            </div>
            <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 shrink-0">
                <button type="button" onclick="closeModalTambahPendidikan()" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold text-sm transition-all">Batal</button>
                <button type="submit" class="px-6 py-2.5 bg-[#005792] hover:bg-[#004677] text-white rounded-xl font-bold text-sm transition-all">Simpan Pendidikan</button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== MODAL TAMBAH PENGALAMAN KERJA ===================== --}}
<div id="modalTambahPekerjaan" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[999] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="flex justify-between items-center px-8 py-5 border-b border-slate-100 shrink-0">
            <h3 class="text-[#005792] font-bold text-lg">Tambah Pengalaman Kerja</h3>
            <button onclick="closeModalTambahPekerjaan()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <form action="{{ route('alumni.pekerjaan.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 overflow-hidden">
            @csrf
            <div class="px-8 py-6 overflow-y-auto flex-1 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Nama Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" placeholder="Contoh: PT Telkom Indonesia" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Status Pekerjaan <span class="text-red-500">*</span></label>
                        <select name="status_pekerjaan" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium bg-white">
                            <option value="">-- Pilih Status --</option>
                            @foreach(['Pekerjaan Tetap','Kontrak','Freelance','Magang','Part Time','Wirausaha'] as $status)
                            <option value="{{ $status }}" {{ old('status_pekerjaan') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Posisi / Jobdesk</label>
                    <input type="text" name="jobdesk" placeholder="Contoh: Software Engineer, Data Analyst" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Divisi / Departemen</label>
                        <input type="text" name="divisi" placeholder="Contoh: Engineering, Marketing" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Lokasi (Kota)</label>
                        <input type="text" name="lokasi" placeholder="Contoh: Surabaya, Jakarta" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Tanggal Mulai</label>
                        <input type="date" name="tahun_masuk" value="{{ old('tahun_masuk') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Tanggal Selesai <span class="text-slate-400 font-normal text-xs">(kosongkan jika masih aktif)</span></label>
                        <input type="date" name="tahun_selesai" value="{{ old('tahun_selesai') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Deskripsi Pekerjaan</label>
                    <textarea name="deskripsi" rows="3" placeholder="Jelaskan tanggung jawab dan pencapaian Anda..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium resize-none">{{ old('deskripsi') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Logo Perusahaan</label>
                    <input type="file" name="logo_perusahaan" accept="image/jpg,image/jpeg,image/png,image/webp" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none text-slate-700 text-sm">
                    <p class="text-xs text-slate-400 mt-1">Format JPG, PNG, WEBP. Maks 1MB.</p>
                </div>
            </div>
            <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 shrink-0">
                <button type="button" onclick="closeModalTambahPekerjaan()" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold text-sm transition-all">Batal</button>
                <button type="submit" class="px-6 py-2.5 bg-[#005792] hover:bg-[#004677] text-white rounded-xl font-bold text-sm transition-all">Simpan Pengalaman</button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== MODAL TAMBAH SERTIFIKASI ===================== --}}
<div id="modalTambahSertifikasi" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[999] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-xl rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="flex justify-between items-center px-8 py-5 border-b border-slate-100 shrink-0">
            <h3 class="text-[#005792] font-bold text-lg">Tambah Sertifikasi</h3>
            <button onclick="closeModalTambahSertifikasi()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <form action="{{ route('alumni.sertifikasi.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 overflow-hidden">
            @csrf
            <div class="px-8 py-6 overflow-y-auto flex-1 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Nama Sertifikasi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Google Professional Cloud Architect" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Diterbitkan Oleh</label>
                        <input type="text" name="diterbitkan_oleh" value="{{ old('diterbitkan_oleh') }}" placeholder="Contoh: Google, Microsoft" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5">Tanggal Terbit</label>
                        <input type="date" name="tanggal_terbit" value="{{ old('tanggal_terbit') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">ID Kredensial</label>
                    <input type="text" name="id_kredensial" value="{{ old('id_kredensial') }}" placeholder="Kosongkan jika tidak ada" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                    <p class="text-xs text-slate-400 mt-1">Nomor unik sertifikasi dari penerbit.</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1.5">Gambar Sertifikat</label>
                    <input type="file" name="gambar_serti" accept="image/jpg,image/jpeg,image/png,image/webp" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none text-slate-700 text-sm" onchange="previewSertifikat(this)">
                    <p class="text-xs text-slate-400 mt-1">Format JPG, PNG, WEBP. Maks 2MB.</p>
                    <div id="sertifikatPreviewBox" class="hidden mt-3 aspect-video rounded-xl overflow-hidden border border-slate-200 bg-slate-50">
                        <img id="sertifikatPreviewImg" src="" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
            <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 shrink-0">
                <button type="button" onclick="closeModalTambahSertifikasi()" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold text-sm transition-all">Batal</button>
                <button type="submit" class="px-6 py-2.5 bg-[#005792] hover:bg-[#004677] text-white rounded-xl font-bold text-sm transition-all">Simpan Sertifikasi</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModalTambahPendidikan() {
        const m = document.getElementById('modalTambahPendidikan');
        m.classList.remove('hidden'); m.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeModalTambahPendidikan() {
        const m = document.getElementById('modalTambahPendidikan');
        m.classList.add('hidden'); m.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
    document.getElementById('modalTambahPendidikan').addEventListener('click', function(e) { if (e.target === this) closeModalTambahPendidikan(); });

    function openModalTambahPekerjaan() {
        const m = document.getElementById('modalTambahPekerjaan');
        m.classList.remove('hidden'); m.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeModalTambahPekerjaan() {
        const m = document.getElementById('modalTambahPekerjaan');
        m.classList.add('hidden'); m.classList.remove('flex');
        document.body.style.overflow = 'auto';
        // Reset semua input dalam form agar tidak ada isian lama saat dibuka lagi
        const form = m.querySelector('form');
        if (form) form.reset();
    }
    document.getElementById('modalTambahPekerjaan').addEventListener('click', function(e) { if (e.target === this) closeModalTambahPekerjaan(); });

    function openModalTambahSertifikasi() {
        const m = document.getElementById('modalTambahSertifikasi');
        m.classList.remove('hidden'); m.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeModalTambahSertifikasi() {
        const m = document.getElementById('modalTambahSertifikasi');
        m.classList.add('hidden'); m.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
    document.getElementById('modalTambahSertifikasi').addEventListener('click', function(e) { if (e.target === this) closeModalTambahSertifikasi(); });

    function previewSertifikat(input) {
        const box = document.getElementById('sertifikatPreviewBox');
        const img = document.getElementById('sertifikatPreviewImg');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { img.src = e.target.result; box.classList.remove('hidden'); };
            reader.readAsDataURL(input.files[0]);
        } else {
            box.classList.add('hidden');
        }
    }
</script>
</body>
</html>