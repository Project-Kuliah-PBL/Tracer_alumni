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
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs border-r-4 border-blue-600 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Manajemen Profil
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-50 font-bold text-xs transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Manajemen Akun
                </a>
            </nav>

            <!-- Logout Button at Bottom -->
            <div class="pt-6 border-t border-slate-100">
            <!-- Perubahan pada sidebar/blade kamu -->
<form action="{{ route('logout') }}" method="POST">
    @csrf <!-- JANGAN LUPA INI untuk keamanan Laravel -->
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
            <div class="grid grid-cols-12 gap-6 max-w-6xl">
<!-- Profile Header Card -->
<div class="col-span-8 bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-200">
    <div class="h-28 bg-[#005792]"></div>
    <div class="px-8 pb-8 relative">
        <div class="flex justify-between items-end -mt-12 mb-4">
            <div class="relative">
                <img src="https://ui-avatars.com/api/?name=Rizky+Ramadhan&background=E2E8F0&color=475569&size=128" alt="Profile" class="w-24 h-24 rounded-full border-4 border-white shadow-sm object-cover">
            </div>
            <button onclick="openEditModal()" class="px-6 py-1.5 border border-slate-300 rounded-full text-blue-600 font-bold text-[11px] hover:bg-slate-50 transition-all active:scale-95">
                Edit Profil
            </button>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Rizky Ramadhan</h2>
        <p class="text-slate-500 text-sm font-medium">Senior Product Designer di TechNova</p>
        <div class="flex items-center gap-4 mt-3 text-[11px] text-slate-400 font-semibold">
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                Jakarta, Indonesia
            </span>
            <span class="flex items-center gap-1 text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Lama Tunggu Kerja Pertama: 1 Bulan
            </span>
        </div>
    </div>
</div>

<!-- Main Modal Container - TIDAK SCROLL -->
<div id="editProfileModal" class="fixed inset-0 z-[999] hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

    <!-- Modal Content - flex column agar tombol tetap di bawah -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl relative overflow-hidden flex flex-col max-h-[90vh]">
            
            <!-- Header - FIXED DI ATAS -->
            <div class="flex justify-between items-center px-8 py-5 border-b border-slate-100 shrink-0">
                <h3 class="text-[#005792] font-bold text-lg">Edit Profil</h3>
                <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <!-- Form Body - SCROLL AREA (TENGAH) -->
            <div class="px-8 py-6 overflow-y-auto flex-1">
                <div class="space-y-6">
                    
                    <!-- Foto Sampul -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-600">Foto Sampul</label>
                        <div class="relative h-40 rounded-xl overflow-hidden bg-slate-100 border-2 border-dashed border-slate-300 group">
                            <img src="https://images.unsplash.com/photo-1557683316-973673baf926" class="w-full h-full object-cover opacity-50" alt="Cover Preview">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <button class="bg-white/90 px-4 py-2 rounded-full shadow-sm text-sm font-bold text-slate-700 flex items-center gap-2 hover:bg-white transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    Ganti Sampul
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Profil Section -->
                    <div class="flex items-center gap-5">
                        <div class="relative group cursor-pointer">
                            <img src="https://ui-avatars.com/api/?name=Rizky+Ramadhan&size=128" class="w-20 h-20 rounded-2xl border-2 border-slate-100 object-cover" alt="Avatar">
                            <div class="absolute inset-0 bg-black/20 rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /></svg>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-bold text-slate-700">Foto Profil</h4>
                            <p class="text-xs text-slate-400 leading-relaxed">Disarankan format JPG atau PNG dengan ukuran minimal 400x400px.</p>
                        </div>
                    </div>

                    <!-- Input Fields - SEMUA VALUE KOSONG -->
                    <div class="space-y-4">
                        <div class="space-y-1.5">
                            <label class="text-sm font-semibold text-slate-600">Nama Lengkap</label>
                            <input type="text" value="" placeholder="Masukkan nama lengkap" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-sm font-semibold text-slate-600">Jabatan / Pekerjaan Saat Ini</label>
                                <input type="text" value="" placeholder="Contoh: Senior Product Designer" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-sm font-semibold text-slate-600">Lokasi (Kota/Negara)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                                    </span>
                                    <input type="text" value="" placeholder="Contoh: Jakarta, Indonesia" class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-slate-700 font-medium">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions - FIXED DI BAWAH (TIDAK IKUT SCROLL) -->
            <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-end gap-3 shrink-0">
                <button onclick="closeEditModal()" class="px-8 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-xl font-bold text-sm transition-all shadow-lg shadow-red-100">
                    Batal
                </button>
                <button onclick="closeEditModal()" class="px-8 py-2.5 bg-[#005792] hover:bg-[#004677] text-white rounded-xl font-bold text-sm transition-all shadow-lg shadow-blue-100">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    function openEditModal() {
        document.getElementById('editProfileModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        document.getElementById('editProfileModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Tutup modal saat klik di luar area modal
    document.getElementById('editProfileModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
</script>

<!-- Kontak Card -->
<div class="col-span-4 bg-white rounded-3xl p-8 shadow-sm border border-slate-200">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-slate-800 font-bold">Kontak</h3>
        <!-- Tombol Edit -->
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
                <p class="text-xs font-semibold text-slate-700">rizky.r@example.com</p>
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
                <p class="text-xs font-semibold text-slate-700">+62 812 3456 7890</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kontak -->
<div id="modalKontak" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[99] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-[28px] shadow-2xl overflow-hidden flex flex-col transform transition-all">
        
        <!-- Header -->
        <div class="px-8 py-6 flex justify-between items-center">
            <h3 class="text-[#0067B1] font-bold text-xl">Edit Kontak</h3>
            <button type="button" onclick="closeModalKontak()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <hr class="border-slate-100">

        <!-- Form Body - INPUTAN KOSONG -->
        <form action="#" method="POST" class="p-8 space-y-6">
            
            <!-- Input Email -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-600 ml-1">Email</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#0067B1]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <input type="email" placeholder="Masukkan email baru" value="" class="w-full pl-12 pr-4 py-3.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] outline-none transition-all text-slate-700">
                </div>
            </div>

            <!-- Input Nomor Telepon -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-600 ml-1">Nomor Telepon</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-[#0067B1]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Masukkan nomor telepon baru" value="" class="w-full pl-12 pr-4 py-3.5 text-sm rounded-xl border border-slate-200 focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] outline-none transition-all text-slate-700">
                </div>
            </div>

            <!-- Footer Tombol -->
            <div class="pt-4 flex justify-center gap-4">
                <button type="button" onclick="closeModalKontak()" class="w-full max-w-[140px] py-3.5 rounded-xl bg-[#D93025] text-white font-bold text-sm hover:bg-red-700 transition-all shadow-lg shadow-red-100">
                    Batal
                </button>
                <button type="submit" class="w-full max-w-[180px] py-3.5 rounded-xl bg-[#0067B1] text-white font-bold text-sm hover:bg-[#005792] transition-all shadow-lg shadow-blue-100">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Ambil elemen modal
    const modalKontak = document.getElementById('modalKontak');
    
    // Fungsi untuk membuka modal
    function openModalKontak() {
        modalKontak.classList.remove('hidden');
        modalKontak.classList.add('flex');
    }

    // Fungsi untuk menutup modal
    function closeModalKontak() {
        modalKontak.classList.add('hidden');
        modalKontak.classList.remove('flex');
    }

    // Menutup modal saat klik area luar (overlay)
    window.addEventListener('click', (e) => {
        if (e.target == modalKontak) closeModalKontak();
    });
</script>
                <!-- Riwayat Pendidikan -->
                <div class="col-span-5 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-sm">Riwayat Pendidikan</h3>
                        <div class="flex gap-2">
                            <button class="text-slate-400 hover:text-blue-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg></button>
                            <button class="text-slate-400 hover:text-blue-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800">Bachelor of Design in Visual Communication</h4>
                                <p class="text-[11px] text-slate-400 font-medium">Universitas Indonesia</p>
                                <p class="text-[10px] text-slate-300 font-bold mt-1">2014 - 2018</p>
                                <div class="mt-2 inline-block px-2 py-0.5 bg-blue-50 text-blue-600 text-[9px] font-bold rounded-md">IPK : 3.85 / 4.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pengalaman Kerja -->
                <div class="col-span-7 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-sm">Pengalaman & Detail Pekerjaan</h3>
                        <div class="flex gap-2 text-slate-400">
                            <button class="hover:text-blue-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg></button>
                            <button class="hover:text-blue-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                                <div class="w-6 h-6 bg-slate-200 rounded-sm"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-800">Senior Product Designer</h4>
                                        <p class="text-[11px] text-slate-400 font-medium">TechNova Innovations</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[9px] font-bold text-slate-300">Januari 2021 - Sekarang</p>
                                        <span class="inline-block px-2 py-0.5 bg-blue-50 text-blue-600 text-[8px] font-bold rounded uppercase mt-1">Pekerjaan Tetap</span>
                                    </div>
                                </div>
                                <p class="text-[10px] text-slate-500 leading-relaxed mt-2">Memimpin tim frontend dalam pengembangan aplikasi web enterprise.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pencapaian & Sertifikasi -->
                <div class="col-span-9 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-sm">Pencapaian & Sertifikasi</h3>
                        <div class="flex gap-2 text-slate-400">
                            <button><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg></button>
                            <button><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-3 border border-slate-100 rounded-2xl">
                            <div class="aspect-video bg-slate-50 rounded-xl mb-3"></div>
                            <h4 class="text-xs font-bold text-slate-800">Google Professional Cloud Architect</h4>
                            <p class="text-[9px] text-slate-400 font-semibold uppercase mt-1">Jan 2023 • Google Cloud</p>
                        </div>
                        <div class="p-3 border border-slate-100 rounded-2xl">
                            <div class="aspect-video bg-slate-50 rounded-xl mb-3"></div>
                            <h4 class="text-xs font-bold text-slate-800">Advanced Interaction Design</h4>
                            <p class="text-[9px] text-slate-400 font-semibold uppercase mt-1">Nov 2022 • IxDF</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media Card -->
                <div class="col-span-3 bg-white rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-slate-800 font-bold text-sm">Social</h3>
                        <button onclick="openModal()" class="text-slate-400 hover:text-blue-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="#" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                            <span class="text-[10px] font-bold">Portfolio</span>
                        </a>
                        <a href="#" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                            <svg class="h-5 w-5 mb-2 text-blue-700" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            <span class="text-[10px] font-bold">LinkedIn</span>
                        </a>
                        <a href="#" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                            <svg class="h-5 w-5 mb-2 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.042-1.416-4.042-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            <span class="text-[10px] font-bold">GitHub</span>
                        </a>
                        <a href="#" class="border border-slate-50 bg-slate-50 rounded-xl flex flex-col items-center justify-center p-4 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                            <svg class="h-5 w-5 mb-2 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.849-.07c-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849s.012-3.585.07-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.337 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.351-.2 6.78-2.618 6.98-6.98.058-1.28.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.353-2.612-6.78-6.98-6.98-1.281-.058-1.69-.072-4.949-.072zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            <span class="text-[10px] font-bold">Instagram</span>
                        </a>
                    </div>
                </div>

            </div>
        </main>
    </div>

 <!-- MODAL EDIT MEDIA SOSIAL (Ukuran Lebih Kecil & Ramping) -->
<div id="modalSocial" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[99] hidden items-center justify-center p-4">
    <!-- max-w-sm diubah menjadi max-w-[340px] agar lebih ramping -->
    <div class="bg-white w-full max-w-[340px] rounded-2xl shadow-2xl overflow-hidden flex flex-col">
        
        <!-- Header: Padding dikurangi -->
        <div class="px-5 py-3 flex justify-between items-center border-b border-slate-100">
            <h3 class="text-[#005792] font-bold text-sm">Edit Media Sosial</h3>
            <button type="button" onclick="closeModal()" class="text-slate-400 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form: Padding p-5 dan gap diperkecil -->
       <!-- Form: Konten input diperbaiki agar kosong saat dibuka -->
<form action="#" method="POST" class="p-5 space-y-3">
    
    <!-- LinkedIn -->
    <div class="space-y-1">
        <label class="flex items-center gap-2 text-[11px] font-bold text-slate-600 uppercase tracking-tight">
            <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            LinkedIn URL
        </label>
        <!-- Value dihapus, diganti placeholder -->
        <input type="url" placeholder="https://linkedin.com/in/username" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500/20 outline-none text-slate-600">
    </div>

    <!-- GitHub -->
    <div class="space-y-1">
        <label class="flex items-center gap-2 text-[11px] font-bold text-slate-600 uppercase tracking-tight">
            <svg class="w-3.5 h-3.5 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            GitHub URL
        </label>
        <input type="url" placeholder="https://github.com/username" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500/20 outline-none text-slate-600">
    </div>

    <!-- Portfolio -->
    <div class="space-y-1">
        <label class="flex items-center gap-2 text-[11px] font-bold text-slate-600 uppercase tracking-tight">
            <svg class="w-3.5 h-3.5 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
            Portfolio URL
        </label>
        <input type="url" placeholder="https://yourwebsite.com" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500/20 outline-none text-slate-600">
    </div>

    <!-- Instagram -->
    <div class="space-y-1">
        <label class="flex items-center gap-2 text-[11px] font-bold text-slate-600 uppercase tracking-tight">
            <span class="p-0.5 bg-blue-600 rounded text-white"><svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></span>
            Instagram URL
        </label>
        <input type="url" placeholder="https://instagram.com/username" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:ring-2 focus:ring-blue-500/20 outline-none text-slate-600">
    </div>

    <!-- Info Box -->
    <div class="bg-indigo-50/50 border border-indigo-100 rounded-lg p-3">
        <p class="text-[10px] text-slate-500 leading-tight">
            Tautan ini akan ditampilkan secara publik pada profil portal alumni Anda untuk memudahkan jaringan profesional.
        </p>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-center gap-3 pt-2">
        <button type="button" onclick="closeModal()" class="flex-1 py-2 rounded-lg bg-[#d93025] text-white font-bold text-xs hover:bg-red-700 transition-all">Batal</button>
        <button type="submit" class="flex-1 py-2 rounded-lg bg-[#0063a7] text-white font-bold text-xs hover:bg-[#004a7c] transition-all">Simpan</button>
    </div>
</form>
    </div>
</div>
    <script>
        const modal = document.getElementById('modalSocial');
        function openModal() { modal.classList.remove('hidden'); modal.classList.add('flex'); }
        function closeModal() { modal.classList.add('hidden'); modal.classList.remove('flex'); }
        window.onclick = function(e) { if (e.target == modal) closeModal(); }
    </script>
</body>
</html>