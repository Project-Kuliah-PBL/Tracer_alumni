<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun Alumni - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow: hidden; }
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-slate-50 h-screen flex flex-col">

    <div class="shrink-0">
        @include('partials.header-admin')
    </div>

    <div class="flex flex-1 overflow-hidden w-full">

        {{-- Sidebar --}}
 <aside class="w-64 shrink-0 bg-white/90 backdrop-blur-sm border-r border-slate-100 flex flex-col justify-between h-full overflow-y-auto no-scrollbar">
            <div class="py-6 flex flex-col gap-3">
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group mx-2"> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="font-bold text-xs">Dashboard</span>
                </a>

                <a href="{{ route('admin.kelola_akun') }}" class="flex items-center gap-3 mx-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs border-r-4 border-blue-600 transition-all">  
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

               <a href="/admin/edit-biodata" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group mx-2">
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

        {{-- Main Content --}}
        <main class="flex-1 px-8 py-8 overflow-y-auto custom-scroll">

            {{-- Flash message --}}
            @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-100 text-green-700 text-xs font-semibold rounded-xl px-4 py-3">
                {{ session('success') }}
            </div>
            @endif

            {{-- Header + Tombol Tambah --}}
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-3xl font-[800] text-slate-800 mb-1 tracking-tight">Manajemen Akun</h2>
                    <p class="text-slate-500 text-xs font-medium opacity-80">Kelola data akses alumni Politeknik Negeri Jember.</p>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="toggleModal('modalImport')" class="bg-emerald-600 text-white px-4 py-2 rounded-xl font-bold text-xs flex items-center gap-2 hover:bg-emerald-700 transition-all shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Import Excel
                    </button>
                    <button onclick="toggleModal('modalTambah')" class="bg-[#0067B1] text-white px-4 py-2 rounded-xl font-bold text-xs flex items-center gap-2 hover:bg-blue-800 transition-all shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Tambah Akun
                    </button>
                </div>
            </div>

            {{-- Card Total --}}
            <div class="bg-white p-5 rounded-[25px] shadow-sm border border-slate-100 w-fit mb-6 pr-12 relative overflow-hidden">
                <div class="absolute left-0 top-0 w-1 h-full bg-blue-600"></div>
                <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest mb-0.5">Total Terdaftar</p>
                <h3 class="text-2xl font-[800] text-slate-800">{{ $alumni->total() }}</h3>
            </div>

            {{-- Tabel --}}
            <div class="bg-white rounded-[30px] shadow-sm border border-slate-100 overflow-hidden mb-8">

                {{-- Search --}}
                <div class="p-5 border-b border-slate-50">
                    <form method="GET" action="{{ route('admin.kelola_akun') }}">
                        <div class="relative max-w-sm">
                            <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ $search }}" placeholder="Cari NIM atau nama..."
                                class="w-full bg-slate-50 border-none rounded-full py-2.5 pl-10 pr-4 text-xs focus:ring-2 focus:ring-blue-500 font-medium transition-all outline-none">
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-[9px] font-black uppercase tracking-wider bg-slate-50/50">
                                <th class="px-6 py-4">NIM</th>
                                <th class="px-6 py-4">Nama Lengkap</th>
                                <th class="px-6 py-4">Prodi</th>
                                <th class="px-6 py-4">Tahun Lulus</th>
                                <th class="px-6 py-4">Jenis Kelamin</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($alumni as $item)
                            <tr class="hover:bg-slate-50/50 transition-all">
                                <td class="px-6 py-4 text-xs font-bold text-slate-700">{{ $item->nim }}</td>
                                <td class="px-6 py-4 text-xs font-extrabold text-slate-800">{{ $item->nama }}</td>
                                <td class="px-6 py-4 text-xs text-slate-500">{{ $item->prodi ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    @if($item->tahun_lulus)
                                        <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full text-[10px] font-black">
                                            {{ \Carbon\Carbon::parse($item->tahun_lulus)->format('d M Y') }}
                                        </span>
                                    @else
                                        <span class="text-slate-300 text-[10px]">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->jenis_kelamin === 'Laki-laki')
                                        <span class="bg-sky-50 text-sky-600 px-2 py-0.5 rounded-full text-[10px] font-black">Laki-laki</span>
                                    @elseif($item->jenis_kelamin === 'Perempuan')
                                        <span class="bg-pink-50 text-pink-500 px-2 py-0.5 rounded-full text-[10px] font-black">Perempuan</span>
                                    @else
                                        <span class="text-slate-300 text-[10px]">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full text-[10px] font-black">Alumni</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-1">
                                        {{-- Tombol Edit --}}
                                        <button onclick="openEdit('{{ $item->nim }}', '{{ addslashes($item->nama) }}', '{{ $item->tahun_lulus ? \Carbon\Carbon::parse($item->tahun_lulus)->format('Y-m-d') : '' }}', '{{ $item->jenis_kelamin }}', '{{ addslashes($item->prodi ?? '') }}')"
                                            class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        {{-- Tombol Hapus --}}
                                        <button onclick="openDelete('{{ $item->nim }}', '{{ addslashes($item->nama) }}')"
                                            class="p-1.5 text-red-400 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-400 text-xs font-medium">
                                    Belum ada data alumni.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-slate-50/30 border-t border-slate-50 flex items-center justify-between">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                        Menampilkan {{ $alumni->firstItem() ?? 0 }}–{{ $alumni->lastItem() ?? 0 }} dari {{ $alumni->total() }} data
                    </p>
                    {{ $alumni->links() }}
                </div>
            </div>

        </main>
    </div>

    {{-- ===== MODAL IMPORT ===== --}}
    <div id="modalImport" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="p-5 pb-0 flex justify-between items-start">
                <div>
                    <h2 class="text-emerald-600 text-lg font-bold tracking-tight">Import Data Alumni</h2>
                    <p class="text-gray-500 text-[11px] mt-0.5">Upload file Excel (.xlsx/.xls/.csv) dari Google Form atau format lain.</p>
                </div>
                <button onclick="toggleModal('modalImport')" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="mt-3 border-gray-100">

            <form action="{{ route('admin.kelola_akun.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-5 space-y-4">

                    {{-- Info --}}
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-3 text-xs text-blue-700 space-y-1">
                        <p class="font-bold">Kolom yang dikenali otomatis:</p>
                        <ul class="list-disc list-inside space-y-0.5 text-blue-600">
                            <li><strong>Nama - NIM</strong> atau kolom <strong>Nama</strong> + <strong>NIM</strong> terpisah</li>
                            <li><strong>Tahun Yudisium / Tahun Lulus / Wisuda</strong> → tanggal lulus (d/m/Y)</li>
                            <li><strong>Alamat Tempat Tinggal Tetap / Alamat / Domisili</strong></li>
                            <li><strong>No. HP / Telepon / Nomor HP</strong></li>
                            <li><strong>Email / Surel</strong></li>
                            <li><strong>Jenis Kelamin / Gender</strong> (L/P/Laki-laki/Perempuan)</li>
                            <li><strong>Prodi / Program Studi / Jurusan</strong></li>
                            <li><strong>Status</strong> → "Sudah Bekerja" / "Belum Bekerja"</li>
                            <li><strong>Nama Perusahaan / Company / Instansi</strong></li>
                            <li><strong>Status Pekerjaan</strong> (Kontrak/Tetap/Magang/dll)</li>
                            <li><strong>Divisi Pekerjaan / Divisi / Department</strong></li>
                            <li><strong>Job Description / Deskripsi</strong></li>
                            <li><strong>Tanggal Masuk / Mulai Kerja</strong> → untuk hitung lama tunggu</li>
                        </ul>
                        <div class="mt-2 pt-2 border-t border-blue-100 space-y-0.5">
                            <p class="font-bold text-blue-700">Otomatis:</p>
                            <p>• Angkatan dibaca dari NIM (E4121xxxx → 2021)</p>
                            <p>• Prodi dicocokkan dari kode NIM (atur di Kelola Prodi)</p>
                            <p>• Password default = NIM alumni</p>
                            <p>• Lama tunggu kerja dihitung dari selisih tanggal lulus & tanggal masuk kerja pertama</p>
                        </div>
                    </div>

                    {{-- Upload --}}
                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">File Excel / CSV</label>
                        <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-sm transition-all">
                        <p class="text-[10px] text-gray-400 mt-1 ml-1">Format: .xlsx, .xls, .csv — Maks 10MB</p>
                    </div>
                </div>

                <div class="bg-gray-50/80 p-4 flex justify-end gap-2 border-t border-gray-100">
                    <button type="button" onclick="toggleModal('modalImport')" class="px-4 py-1.5 border border-gray-300 rounded-lg text-gray-600 text-xs font-bold hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 shadow-md transition-all">Import</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== MODAL TAMBAH ===== --}}
    <div id="modalTambah" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="p-5 pb-0 flex justify-between items-start">
                <div>
                    <h2 class="text-[#0067B1] text-lg font-bold tracking-tight">Tambah Akun Alumni</h2>
                    <p class="text-gray-500 text-[11px] mt-0.5">NIM akan digunakan sebagai username login.</p>
                </div>
                <button onclick="toggleModal('modalTambah')" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="mt-3 border-gray-100">

            <form action="{{ route('admin.kelola_akun.store') }}" method="POST">
                @csrf
                <div class="p-5 space-y-3">

                    @if($errors->any())
                    <div class="bg-red-50 border border-red-100 text-red-600 text-xs font-semibold rounded-xl px-4 py-3">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Contoh: E41240742" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap alumni" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Password <span class="normal-case text-gray-300">(default: NIM)</span></label>
                        <input type="password" name="password" placeholder="Kosongkan untuk pakai NIM sebagai password"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Tahun Lulus</label>
                        <input type="date" name="tahun_lulus" value="{{ old('tahun_lulus') }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Program Studi</label>
                        <select name="prodi" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all bg-white">
                            <option value="">-- Pilih Prodi --</option>
                            @foreach($prodis as $prodi)
                            <option value="{{ $prodi }}" {{ old('prodi') == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Jenis Kelamin</label>
                        <div class="flex gap-4 mt-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}
                                    class="accent-[#0067B1]">
                                <span class="text-sm text-gray-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}
                                    class="accent-[#0067B1]">
                                <span class="text-sm text-gray-700">Perempuan</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50/80 p-4 flex justify-end gap-2 border-t border-gray-100">
                    <button type="button" onclick="toggleModal('modalTambah')" class="px-4 py-1.5 border border-gray-300 rounded-lg text-gray-600 text-xs font-bold hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-[#0067B1] text-white rounded-lg text-xs font-bold hover:bg-blue-800 shadow-md transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== MODAL EDIT ===== --}}
    <div id="modalEdit" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="p-5 pb-0 flex justify-between items-start">
                <div>
                    <h2 class="text-[#0067B1] text-lg font-bold tracking-tight">Edit Akun Alumni</h2>
                    <p class="text-gray-500 text-[11px] mt-0.5">Kosongkan password jika tidak ingin mengubahnya.</p>
                </div>
                <button onclick="toggleModal('modalEdit')" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="mt-3 border-gray-100">

            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                <div class="p-5 space-y-3">
                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">NIM</label>
                        <input type="text" id="editNim" disabled
                            class="w-full px-3 py-2 border border-gray-100 rounded-lg bg-slate-50 text-sm text-slate-400 font-bold">
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Nama Lengkap</label>
                        <input type="text" name="nama" id="editNama" placeholder="Nama lengkap alumni" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Password Baru <span class="normal-case text-gray-300">(opsional)</span></label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Tahun Lulus</label>
                        <input type="date" name="tahun_lulus" id="editTahunLulus"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Program Studi</label>
                        <select name="prodi" id="editProdi" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all bg-white">
                            <option value="">-- Pilih Prodi --</option>
                            @foreach($prodis as $prodi)
                            <option value="{{ $prodi }}">{{ $prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Jenis Kelamin</label>
                        <div class="flex gap-4 mt-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="jenis_kelamin" id="editJKL" value="Laki-laki" class="accent-[#0067B1]">
                                <span class="text-sm text-gray-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="jenis_kelamin" id="editJKP" value="Perempuan" class="accent-[#0067B1]">
                                <span class="text-sm text-gray-700">Perempuan</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50/80 p-4 flex justify-end gap-2 border-t border-gray-100">
                    <button type="button" onclick="toggleModal('modalEdit')" class="px-4 py-1.5 border border-gray-300 rounded-lg text-gray-600 text-xs font-bold hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-[#0067B1] text-white rounded-lg text-xs font-bold hover:bg-blue-800 shadow-md transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== MODAL HAPUS ===== --}}
    <div id="modalHapus" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
            <div class="p-6 text-center">
                <div class="bg-red-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-slate-800 font-bold text-base mb-1">Hapus Akun Alumni</h3>
                <p class="text-slate-500 text-xs mb-1">Akun <span id="hapusNama" class="font-bold text-slate-700"></span></p>
                <p class="text-slate-400 text-xs">Tindakan ini tidak dapat dibatalkan.</p>
            </div>

            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="px-6 pb-6 flex gap-2 justify-center">
                    <button type="button" onclick="toggleModal('modalHapus')" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-600 text-xs font-bold hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-red-500 text-white rounded-lg text-xs font-bold hover:bg-red-600 shadow-md transition-all">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function openEdit(nim, nama, tahunLulus, jenisKelamin, prodi) {
            document.getElementById('editNim').value = nim;
            document.getElementById('editNama').value = nama;
            document.getElementById('editTahunLulus').value = tahunLulus;
            document.getElementById('editJKL').checked = (jenisKelamin === 'Laki-laki');
            document.getElementById('editJKP').checked = (jenisKelamin === 'Perempuan');
            document.getElementById('editProdi').value = prodi;
            document.getElementById('formEdit').action = '/admin/kelola-akun/' + nim;
            toggleModal('modalEdit');
        }

        function openDelete(nim, nama) {
            document.getElementById('hapusNama').textContent = nama + ' (' + nim + ')';
            document.getElementById('formHapus').action = '/admin/kelola-akun/' + nim;
            toggleModal('modalHapus');
        }

        // Buka modal tambah otomatis jika ada error validasi
        @if($errors->any())
            document.getElementById('modalTambah').classList.remove('hidden');
        @endif
    </script>

</body>
</html>
