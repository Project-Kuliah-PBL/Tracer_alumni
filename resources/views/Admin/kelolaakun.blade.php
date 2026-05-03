<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun Alumni - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            /* Body tetap h-screen agar layout flexbox bekerja sempurna */
            overflow: hidden; 
        }
        /* Custom scrollbar agar tetap terlihat minimalis */
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-slate-50 h-screen flex flex-col">

    <!-- Header (Tetap di Atas) -->
    <div class="shrink-0">
        @include('partials.header-admin')
    </div>

    <!-- Container Utama -->
    <div class="flex flex-1 overflow-hidden w-full">
        
        <!-- Sidebar: Fixed (Tidak Ikut Scroll) -->
             <aside class="w-64 shrink-0 bg-white/90 backdrop-blur-sm border-r border-slate-100 flex flex-col justify-between h-full overflow-y-auto no-scrollbar">
            <div class="py-6 flex flex-col gap-3">
           <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span class="font-bold text-xs group-hover:text-blue-600">Dashboard</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs border-r-4 border-blue-600 transition-all"> 
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="font-bold text-xs">Kelola Akun</span>
            </a>
            </div>
<!-- Tombol KELUAR SISTEM -->
<div class="px-4 pb-6">
    <form action="{{ route('logout') }}" method="POST" class="w-full">
        @csrf
        <button type="submit" class="flex items-center justify-center gap-3 bg-[#D32F2F] text-white w-full py-3 rounded-xl hover:bg-red-700 transition-all shadow-md group cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:scale-105" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="font-bold text-sm tracking-wide">LogOut</span>
        </button>
    </form>
</div>
        </aside>

      

        <!-- Main Content: Scrollable Area -->
        <main class="flex-1 px-8 py-8 overflow-y-auto custom-scroll">
            
            <div class="flex justify-between items-start mb-6">
                <header>
                    <h2 class="text-3xl font-[800] text-slate-800 mb-1 tracking-tight">Manajemen Akun</h2>
                    <p class="text-slate-500 text-xs font-medium opacity-80">
                        Kelola data akses alumni Politeknik Negeri Jember.
                    </p>
                </header>

        <!-- Tombol Tambah Akun - ukuran lebih kecil -->
<button onclick="toggleModal()" class="bg-[#0067B1] text-white px-4 py-2 rounded-xl font-bold text-xs flex items-center gap-2 hover:bg-blue-800 transition-all shadow-md">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
    </svg>
    Tambah Akun
</button>

<!-- Overlay Modal -->
<div id="modalTambah" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <!-- Konten Modal - ukuran lebih kecil -->
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
        
        <!-- Header - Padding lebih kecil -->
        <div class="p-5 pb-0 flex justify-between items-start">
            <div>
                <h2 class="text-[#0067B1] text-lg font-bold tracking-tight">Tambah Akun Baru</h2>
                <p class="text-gray-500 text-[11px] mt-0.5">Lengkapi formulir untuk mendaftarkan akun alumni.</p>
            </div>
            <button onclick="toggleModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <hr class="mt-3 border-gray-100">

        <!-- Form Body - Spacing lebih rapat -->
        <div class="p-5 space-y-3">
            <!-- Username -->
            <div>
                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Username</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs group-focus-within:text-[#0067B1]"></span>
                    <input type="text" placeholder="isi dengan NIM" class="w-full pl-8 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm placeholder-gray-300 transition-all">
                </div>
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Nama Lengkap</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 group-focus-within:text-[#0067B1]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <input type="text" placeholder="isi nama lengkap" class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm placeholder-gray-300 transition-all">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Password</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 group-focus-within:text-[#0067B1]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <input type="password" placeholder="Min. 8 karakter" class="w-full pl-9 pr-9 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm placeholder-gray-300 transition-all">
                </div>
            </div>

            <!-- Jurusan & Tahun -->
            <div class="flex gap-3">
                <div class="flex-[2]">
                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Jurusan</label>
                    <div class="relative">
                        <select class="w-full pl-3 pr-7 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none appearance-none bg-white text-xs text-gray-700 transition-all cursor-pointer">
                            <option>Pilih Jurusan</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-2 flex items-center pointer-events-none text-gray-400">
                            <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Tahun</label>
                    <input type="number" placeholder="Tahun" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm text-gray-700 transition-all">
                </div>
            </div>
        </div>

        <!-- Footer - Tombol lebih kecil -->
        <div class="bg-gray-50/80 p-4 flex justify-end gap-2 border-t border-gray-100">
            <button onclick="toggleModal()" class="px-4 py-1.5 border border-gray-300 rounded-lg text-gray-600 text-xs font-bold hover:bg-white transition-all">Batal</button>
            <button class="px-4 py-1.5 bg-[#0067B1] text-white rounded-lg text-xs font-bold hover:bg-blue-800 shadow-md transition-all">Simpan</button>
        </div>
    </div>
</div>

<script>
    function toggleModal() {
        const modal = document.getElementById('modalTambah');
        modal.classList.toggle('hidden');
    }
</script>
            </div>

            <!-- Card Ringkasan: Ukuran Kecil -->
            <div class="bg-white p-5 rounded-[25px] shadow-sm border border-slate-100 w-fit mb-6 pr-12 relative overflow-hidden">
                <div class="absolute left-0 top-0 w-1 h-full bg-blue-600"></div>
                <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest mb-0.5">Total Terdaftar</p>
                <h3 class="text-2xl font-[800] text-slate-800">1,248</h3>
            </div>

            <!-- Table Container -->
            <div class="bg-white rounded-[30px] shadow-sm border border-slate-100 overflow-hidden mb-8">
                <!-- Search Bar -->
                <div class="p-5 border-b border-slate-50">
                    <div class="relative max-w-sm">
                        <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" placeholder="Cari alumni..." class="w-full bg-slate-50 border-none rounded-full py-2.5 pl-10 pr-4 text-xs focus:ring-2 focus:ring-blue-500 font-medium transition-all">
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-[9px] font-black uppercase tracking-wider">
                                <th class="px-6 py-4">Username</th>
                                <th class="px-6 py-4">Nama Lengkap</th>
                                <th class="px-6 py-4">Password</th>
                                <th class="px-6 py-4">Jurusan</th>
                                <th class="px-6 py-4">Tahun</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @php
                                // Contoh Data (Ganti dengan data asli dari database)
                                $alumni = [
                                    ['user' => 'E41240742', 'nama' => 'Andi Budiman', 'pass' => 'polije2023!', 'prodi' => 'Teknologi Informasi', 'tahun' => '2023'],
                                    ['user' => 'E4124076', 'nama' => 'Siti Aminah', 'pass' => 'rahasiabanget', 'prodi' => 'Produksi Pertanian', 'tahun' => '2021'],
                                    ['user' => 'E41240789', 'nama' => 'Rizky Perdana', 'pass' => 'rizky12345', 'prodi' => 'Teknik', 'tahun' => '2022'],
                                    ['user' => 'E41240900', 'nama' => 'Niken, S. Pd.', 'pass' => 'niken2026', 'prodi' => 'Pendidikan', 'tahun' => '2024'],
                                ];
                            @endphp

                            @foreach($alumni as $item)
                            <tr class="hover:bg-slate-50/50 transition-all group">
                                <td class="px-6 py-4 text-xs font-bold text-slate-700">{{ $item['user'] }}</td>
                                <td class="px-6 py-4 text-xs font-extrabold text-slate-800">{{ $item['nama'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-slate-100 text-slate-400 px-2 py-1 rounded-md text-[10px] font-mono">{{ $item['pass'] }}</span>
                                </td>
                                <td class="px-6 py-4 text-[11px] font-medium text-slate-500">{{ $item['prodi'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full text-[10px] font-black">{{ $item['tahun'] }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-1">
                                        <button class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
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

                <!-- Footer Tabel -->
                <div class="px-6 py-4 bg-slate-50/30 border-t border-slate-50">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Menampilkan {{ count($alumni) }} dari 1,248 data alumni</p>
                </div>
            </div>

            <!-- Spacing tambahan di bawah agar tidak mentok saat di scroll -->
            <div class="h-10"></div>
        </main>
    </div>

</body>
</html>