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

    <div class="flex flex-1 overflow-hidden max-w-[1440px] mx-auto w-full">
        <!-- Sidebar -->
        <aside class="w-64 shrink-0 bg-white border-r border-slate-200 p-6 flex flex-col">
            <div class="mb-8">
                <h2 class="text-slate-800 font-bold text-sm">Alumni Portal</h2>
                <p class="text-slate-400 text-[10px] font-medium">Verified Member</p>
            </div>

            <nav class="space-y-2 flex-1">
                <a href="{{ route('alumni.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs border-r-4 border-blue-600 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Manajemen Profil
                </a>
                <a href="{{ route('alumni.manajemen_akun') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-50 font-bold text-xs transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Manajemen Akun
                </a>
            </nav>

            <!-- Logout Button at Bottom -->
            <div class="pt-6 border-t border-slate-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center justify-start gap-3 bg-[#D32F2F] text-white w-full px-4 py-3 rounded-lg hover:bg-red-700 transition-all shadow-md shadow-red-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="font-bold text-xs uppercase tracking-wider">Log Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-8 custom-scroll">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-12 gap-6 max-w-6xl">

                <!-- Profile Header Card -->
                <div class="col-span-8 bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-200">
                    <!-- Foto Sampul -->
                    <div class="h-28 bg-[#005792] overflow-hidden">
                        @if($alumni->foto_sampul)
                            <img src="{{ Storage::url($alumni->foto_sampul) }}" alt="Foto Sampul" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="px-8 pb-8 relative">
                        <div class="flex justify-between items-end -mt-12 mb-4">
                            <div class="relative">
                                @if($alumni->foto_profile)
                                    <img src="{{ Storage::url($alumni->foto_profile) }}" alt="Foto Profil" class="w-24 h-24 rounded-full border-4 border-white shadow-sm object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->nama) }}&background=E2E8F0&color=475569&size=128" alt="Foto Profil" class="w-24 h-24 rounded-full border-4 border-white shadow-sm object-cover">
                                @endif
                            </div>
                            <button onclick="openEditModal()" class="px-6 py-1.5 border border-slate-300 rounded-full text-blue-600 font-bold text-[11px] hover:bg-slate-50 transition-all active:scale-95">
                                Edit Profil
                            </button>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800">{{ $alumni->nama }}</h2>
                        <p class="text-slate-500 text-sm font-medium">{{ $alumni->jabatan_sekarang ?? 'Belum diisi' }}</p>
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
                                                    <div id="coverPreview" class="w-full h-full bg-gradient-to-r from-blue-500 to-blue-700"></div>
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
                                                    <img src="{{ Storage::url($alumni->foto_profile) }}" id="avatarPreview" class="w-20 h-20 rounded-2xl border-2 border-slate-100 object-cover" alt="Avatar">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->nama) }}&size=128" id="avatarPreview" class="w-20 h-20 rounded-2xl border-2 border-slate-100 object-cover" alt="Avatar">
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
                                                    <label class="text-sm font-semibold text-slate-600">Jabatan / Pekerjaan Saat Ini</label>
                                                    <input type="text" name="jabatan_sekarang" value="{{ old('jabatan_sekarang', $alumni->jabatan_sekarang) }}" placeholder="Contoh: Senior Product Designer" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
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
                                                <div class="space-y-1.5">
                                                    <label class="text-sm font-semibold text-slate-600">Lama Tunggu Kerja Pertama</label>
                                                    <input type="text" name="lama_tunggu_kerja" value="{{ old('lama_tunggu_kerja', $alumni->lama_tunggu_kerja) }}" placeholder="Contoh: 3 Bulan" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
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
                            {{-- Kirim field nama agar validasi tidak gagal --}}
                            <input type="hidden" name="nama" value="{{ $alumni->nama }}">

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-600 ml-1">Email</label>
                                <div class="relative group">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#0067B1]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <input type="email" name="email" value="{{ old('email', $alumni->email) }}" placeholder="Masukkan email" class="w-full pl-12 pr-4 py-3.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] outline-none transition-all text-slate-700">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-600 ml-1">Nomor Telepon</label>
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
                            <a href="{{ route('alumni.pendidikan.create') }}" class="text-slate-400 hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            </a>
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
                            <a href="{{ route('alumni.pekerjaan.create') }}" class="hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            </a>
                            <a href="{{ route('alumni.pekerjaan.index') }}" class="hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </a>
                        </div>
                    </div>
                    <div class="space-y-6">
                        @forelse($alumni->pekerjaan->take(3) as $pekerjaan)
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 overflow-hidden">
                                @if($pekerjaan->logo_perusahaan)
                                    <img src="{{ Storage::url($pekerjaan->logo_perusahaan) }}" alt="Logo" class="w-full h-full object-cover">
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
                </div>

                <!-- Pencapaian & Sertifikasi -->
                <div class="col-span-9 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-sm">Pencapaian & Sertifikasi</h3>
                        <div class="flex gap-2 text-slate-400">
                            <a href="{{ route('alumni.sertifikasi.create') }}" class="hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            </a>
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
                                    <img src="{{ Storage::url($serti->gambar_serti) }}" alt="Sertifikat" class="w-full h-full object-cover">
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
                <div class="col-span-3 bg-white rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-sm">Social</h3>
                        <button onclick="openModal()" class="text-slate-400 hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </button>
                    </div>
                    @if($alumni->mediaSosial->count() > 0)
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($alumni->mediaSosial as $medsos)
                        <a href="{{ $medsos->link_medsos }}" target="_blank" rel="noopener noreferrer" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                            <span class="text-[10px] font-bold text-center truncate w-full text-center">{{ $medsos->nama_platform }}</span>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <div class="flex-1 flex flex-col items-center justify-center text-center">
                        <p class="text-xs text-slate-400">Belum ada media sosial.</p>
                        <button onclick="openModal()" class="mt-2 text-xs text-blue-500 font-semibold">+ Tambah</button>
                    </div>
                    @endif
                </div>

            </div>
        </main>
    </div>

    <!-- Modal Edit Media Sosial -->
    <div id="modalSocial" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[99] hidden items-center justify-center p-4">
        <div class="bg-white w-full max-w-[400px] rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="px-5 py-4 flex justify-between items-center border-b border-slate-100">
                <h3 class="text-[#005792] font-bold text-sm">Kelola Media Sosial</h3>
                <button type="button" onclick="closeModal()" class="text-slate-400 hover:text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-5 overflow-y-auto space-y-3">
                {{-- Daftar medsos yang sudah ada --}}
                @foreach($alumni->mediaSosial as $medsos)
                <div class="flex items-center gap-2 bg-slate-50 rounded-lg p-2">
                    <span class="text-xs font-bold text-slate-600 flex-1">{{ $medsos->nama_platform }}</span>
                    <span class="text-[10px] text-slate-400 truncate max-w-[120px]">{{ $medsos->link_medsos }}</span>
                    <form action="{{ route('alumni.medsos.destroy', $medsos->id) }}" method="POST" onsubmit="return confirm('Hapus media sosial ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-600 ml-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </form>
                </div>
                @endforeach

                {{-- Form tambah baru --}}
                <form action="{{ route('alumni.medsos.store') }}" method="POST" class="space-y-3 pt-2 border-t border-slate-100">
                    @csrf
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-tight">Tambah Media Sosial</p>
                    <div class="space-y-1">
                        <label class="text-[11px] font-bold text-slate-600 uppercase">Nama Platform</label>
                        <input type="text" name="nama_platform" placeholder="Contoh: LinkedIn, GitHub, Instagram" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500/20 outline-none text-slate-600">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[11px] font-bold text-slate-600 uppercase">Link URL</label>
                        <input type="url" name="link_medsos" placeholder="https://..." class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500/20 outline-none text-slate-600">
                    </div>
                    <div class="flex justify-center gap-3 pt-1">
                        <button type="button" onclick="closeModal()" class="flex-1 py-2 rounded-lg bg-[#d93025] text-white font-bold text-xs hover:bg-red-700 transition-all">Tutup</button>
                        <button type="submit" class="flex-1 py-2 rounded-lg bg-[#0063a7] text-white font-bold text-xs hover:bg-[#004a7c] transition-all">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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
                reader.onload = e => document.getElementById('avatarPreview').src = e.target.result;
                reader.readAsDataURL(input.files[0]);
            }
        }
        function previewCover(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    const el = document.getElementById('coverPreview');
                    if (el.tagName === 'IMG') el.src = e.target.result;
                    else { el.outerHTML = `<img id="coverPreview" src="${e.target.result}" class="w-full h-full object-cover" alt="Cover Preview">`; }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
