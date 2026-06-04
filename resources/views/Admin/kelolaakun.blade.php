<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Manajemen Akun Alumni - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow: hidden; }
        .custom-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        
        /* Sembunyikan scrollbar bawaan untuk kemudahan navigasi mobile */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 h-screen flex flex-col">

    <div class="shrink-0 w-full z-50">
        @include('partials.header-admin')
    </div>

    <div class="flex flex-1 overflow-hidden w-full relative">

        <!-- Backdrop Overlay untuk Mobile Sidebar -->
        <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden transition-opacity backdrop-blur-sm"></div>

        {{-- Sidebar (Responsive: Slide-in di mobile, menetap di desktop) --}}
        <aside id="sidebarAdmin" class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full lg:translate-x-0 lg:static bg-white/90 backdrop-blur-sm border-r border-slate-100 flex flex-col justify-between h-full overflow-y-auto no-scrollbar transition-transform duration-300 ease-in-out shrink-0">
            <div class="py-6 flex flex-col gap-3">
                
                <!-- Header khusus di Mobile untuk menutup sidebar -->
                <div class="flex lg:hidden justify-between items-center px-5 mb-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Menu Navigasi</span>
                    <button onclick="toggleSidebar()" class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
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

                @if(auth()->user()->role === 'SuperAdmin')
                <a href="/admin/kelola-prodi" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                    <span class="font-bold text-xs">Kelola Prodi</span>
                </a>
                @endif

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
        <main class="flex-1 px-4 md:px-8 py-6 md:py-8 overflow-y-auto custom-scroll w-full min-w-0">

            {{-- Flash message --}}
            @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-100 text-green-700 text-xs font-semibold rounded-xl px-4 py-3">
                {{ session('success') }}
            </div>
            @endif

            {{-- Header + Tombol Tambah --}}
            <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-[800] text-slate-800 mb-1 tracking-tight">Manajemen Akun</h2>
                    <p class="text-slate-500 text-xs font-medium opacity-80">Kelola data akses alumni Politeknik Negeri Jember.</p>
                </div>
                <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                    <button onclick="toggleModal('modalImport')" class="bg-emerald-600 text-white px-3 md:px-4 py-2 rounded-xl font-bold text-xs flex items-center gap-2 hover:bg-emerald-700 transition-all shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Import <span class="hidden xs:inline">Excel</span>
                    </button>
                    <button onclick="toggleModal('modalTambah')" class="bg-[#0067B1] text-white px-3 md:px-4 py-2 rounded-xl font-bold text-xs flex items-center gap-2 hover:bg-blue-800 transition-all shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Tambah <span class="hidden xs:inline">Akun</span>
                    </button>
                </div>
            </div>

            {{-- ===== TABEL AKUN ADMIN (SuperAdmin only) ===== --}}
            @if($isSuperAdmin && $adminAccounts->isNotEmpty())
            <div class="mb-6">
                <h3 class="text-sm font-extrabold text-slate-700 mb-3 flex items-center gap-2">
                    <span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider">Admin Per Prodi</span>
                    <span class="text-slate-400 font-medium text-xs">{{ $adminAccounts->count() }} akun</span>
                </h3>
                <div class="bg-white rounded-2xl md:rounded-[30px] shadow-sm border border-purple-100 overflow-hidden">
                    <div class="overflow-x-auto custom-scroll">
                        <table class="w-full text-left border-collapse min-w-[500px]">
                            <thead>
                                <tr class="text-slate-400 text-[9px] font-black uppercase tracking-wider bg-purple-50/50">
                                    <th class="px-6 py-4">Username</th>
                                    <th class="px-6 py-4">Program Studi</th>
                                    <th class="px-6 py-4">Role</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($adminAccounts as $adm)
                                <tr class="hover:bg-purple-50/30 transition-all">
                                    <td class="px-6 py-4 text-xs font-bold text-slate-700">{{ $adm->username }}</td>
                                    <td class="px-6 py-4 text-xs text-slate-500">{{ $adm->prodi ?? '—' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full text-[10px] font-black">Admin</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center items-center gap-1">
                                            <form action="{{ route('admin.kelola_akun.admin.destroy', $adm->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus akun Admin {{ addslashes($adm->username) }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-red-400 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            {{-- Card Total Alumni --}}
            <div class="bg-white p-4 md:p-5 rounded-2xl md:rounded-[25px] shadow-sm border border-slate-100 w-fit mb-6 pr-8 md:pr-12 relative overflow-hidden">
                <div class="absolute left-0 top-0 w-1 h-full bg-blue-600"></div>
                <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest mb-0.5">Total Alumni Terdaftar</p>
                <h3 class="text-xl md:text-2xl font-[800] text-slate-800">{{ $alumni->total() }}</h3>
            </div>

            {{-- Tabel Card Wrapper --}}
            <div class="bg-white rounded-2xl md:rounded-[30px] shadow-sm border border-slate-100 overflow-hidden mb-8">

                {{-- Search --}}
                <div class="p-4 md:p-5 border-b border-slate-50">
                    <form method="GET" action="{{ route('admin.kelola_akun') }}">
                        <div class="relative w-full max-w-sm">
                            <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ $search }}" placeholder="Cari NIM atau nama..."
                                class="w-full bg-slate-50 border-none rounded-full py-2 md:py-2.5 pl-10 pr-4 text-xs focus:ring-2 focus:ring-blue-500 font-medium transition-all outline-none">
                        </div>
                    </form>
                </div>

                <!-- Kontainer Scroll untuk tabel data utama -->
                <div class="overflow-x-auto custom-scroll">
                    <table class="w-full text-left border-collapse min-w-[800px]">
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
                                <!-- <td class="px-6 py-4">
                                {!! DNS1D::getBarcodeHTML($item->nim, 'C128') !!}
                                <div class="text-[10px] text-slate-500 mt-1">{{ $item->nim }}</div>
                                </td> -->
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
                                        <button onclick="openEdit('{{ $item->nim }}', '{{ addslashes($item->nama) }}', '{{ $item->tahun_lulus ? \Carbon\Carbon::parse($item->tahun_lulus)->format('Y-m-d') : '' }}', '{{ $item->jenis_kelamin }}', '{{ addslashes($item->prodi ?? '') }}', '{{ $item->angkatan ?? '' }}')"
                                            class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
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

                <div class="px-4 md:px-6 py-4 bg-slate-50/30 border-t border-slate-50 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest text-center sm:text-left">
                        Menampilkan {{ $alumni->firstItem() ?? 0 }}–{{ $alumni->lastItem() ?? 0 }} dari {{ $alumni->total() }} data
                    </p>
                    <div class="max-w-full overflow-x-auto no-scrollbar">
                        {{ $alumni->links() }}
                    </div>
                </div>
            </div>

        </main>
    </div>

    {{-- ===== MODAL IMPORT (Scrollable) ===== --}}
    <div id="modalImport" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-3 sm:p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[90vh] flex flex-col overflow-hidden">
            <div class="p-5 pb-0 flex justify-between items-start flex-shrink-0">
                <div>
                    <h2 class="text-emerald-600 text-lg font-bold tracking-tight">Import Data Alumni</h2>
                    <p class="text-gray-500 text-[11px] mt-0.5">Upload file Excel (.xlsx/.xls/.csv) dari Google Form atau format lain.</p>
                </div>
                <button type="button" onclick="toggleModal('modalImport')" class="text-gray-400 hover:text-gray-600 p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="mt-3 border-gray-100 flex-shrink-0">

            <form action="{{ route('admin.kelola_akun.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 overflow-hidden">
                @csrf
                <div class="flex-1 overflow-y-auto p-5 space-y-4 min-h-0 custom-scroll">
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-3 text-xs text-blue-700 space-y-1">
                        <p class="font-bold">Kolom yang dikenali otomatis:</p>
                        <ul class="list-disc list-inside space-y-0.5 text-blue-600 text-[11px]">
                            <li><strong>Nama - NIM</strong> atau kolom <strong>Nama</strong> + <strong>NIM</strong> terpisah</li>
                            <li><strong>Tahun Yudisium / Tahun Lulus / Wisuda</strong></li>
                            <li><strong>Alamat Tempat Tinggal Tetap / Domisili</strong></li>
                            <li><strong>No. HP / Telepon / Nomor HP</strong></li>
                            <li><strong>Email / Surel</strong></li>
                            <li><strong>Jenis Kelamin / Gender</strong></li>
                            <li><strong>Prodi / Program Studi / Jurusan</strong></li>
                            <li><strong>Status</strong> → "Sudah Bekerja" / "Belum Bekerja"</li>
                            <li><strong>Nama Perusahaan / Company / Instansi</strong></li>
                            <li><strong>Status Pekerjaan</strong> (Kontrak/Tetap/Magang)</li>
                            <li><strong>Divisi Pekerjaan / Department</strong></li>
                            <li><strong>Job Description / Deskripsi</strong></li>
                            <li><strong>Tanggal Masuk / Mulai Kerja</strong></li>
                        </ul>
                        <div class="mt-2 pt-2 border-t border-blue-100 space-y-0.5 text-[11px]">
                            <p class="font-bold text-blue-700">Otomatis:</p>
                            <p>• Angkatan dibaca dari NIM (E4121xxxx → 2021)</p>
                            <p>• Prodi dicocokkan dari kode NIM</p>
                            <p>• Password default = NIM alumni</p>
                            <p>• Lama tunggu kerja dihitung dari selisih tanggal lulus & masuk kerja</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">File Excel / CSV</label>
                        <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none text-sm transition-all">
                        <p class="text-[10px] text-gray-400 mt-1 ml-1">Format: .xlsx, .xls, .csv — Maks 10MB</p>
                    </div>
                </div>

                <div class="bg-gray-50/80 p-4 flex justify-end gap-2 border-t border-gray-100 flex-shrink-0">
                    <button type="button" onclick="toggleModal('modalImport')" class="px-4 py-1.5 border border-gray-300 rounded-lg text-gray-600 text-xs font-bold hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 shadow-md transition-all">Import</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== MODAL TAMBAH (Scrollable) ===== --}}
    <div id="modalTambah" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-3 sm:p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[90vh] flex flex-col overflow-hidden">
            <div class="p-5 flex justify-between items-start flex-shrink-0">
                <div>
                    <h2 class="text-[#0067B1] text-lg font-bold tracking-tight">Tambah Akun</h2>
                    <p class="text-gray-500 text-[11px] mt-0.5">NIM akan digunakan sebagai username login.</p>
                </div>
                <button type="button" onclick="toggleModal('modalTambah')" class="text-gray-400 hover:text-gray-600 p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="border-gray-100 flex-shrink-0">

            <form action="{{ route('admin.kelola_akun.store') }}" method="POST" class="flex flex-col flex-1 overflow-hidden">
                @csrf
                <div class="flex-1 overflow-y-auto p-5 space-y-4 min-h-0 custom-scroll">
                    @if($errors->any())
                    <div class="bg-red-50 border border-red-100 text-red-600 text-xs font-semibold rounded-xl px-4 py-3">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    @if(auth()->user()->role === 'SuperAdmin')
                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Role</label>
                        <select id="roleSelect" name="role" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all bg-white">
                            <option value="Alumni" {{ old('role', 'Alumni') === 'Alumni' ? 'selected' : '' }}>Alumni</option>
                            <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <p class="text-[10px] text-gray-400 mt-1 ml-1">Pilih Admin untuk membuat akun admin per prodi.</p>
                    </div>
                    @else
                        <input type="hidden" name="role" value="Alumni">
                    @endif

                    <div>
                        <label id="labelUsername" class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">NIM</label>
                        <input type="text" id="inputUsername" name="nim" value="{{ old('nim') }}" placeholder="Contoh: E41240742" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                    </div>

                    <div id="fieldNamaLengkap">
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap alumni" 
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                    </div>

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">
                            Password <span class="normal-case text-gray-300">(default: NIM)</span>
                        </label>
                        <div class="relative flex items-center">
                            <input type="password" id="passwordInput" name="password" placeholder="Kosongkan untuk pakai NIM"
                                class="w-full pl-3 pr-10 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">

                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer z-20" 
                                 onclick="
                                    const input = document.getElementById('passwordInput');
                                    const open = document.getElementById('eyeOpen');
                                    const close = document.getElementById('eyeClose');
                                    if (input.type === 'password') {
                                        input.type = 'text';
                                        close.classList.add('hidden');
                                        open.classList.remove('hidden');
                                    } else {
                                        input.type = 'password';
                                        close.classList.remove('hidden');
                                        open.classList.add('hidden');
                                    }
                                 ">
                                <svg id="eyeClose" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400 hover:text-[#0067B1]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400 hover:text-[#0067B1] hidden">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.483 8.651 7.21 6 12 6s8.517 2.651 9.964 5.678c.045.093.045.203 0 .297C20.517 15.349 16.79 18 12 18s-8.517-2.651-9.964-5.678Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div id="fieldAlumni" class="space-y-4">
                        <div>
                            <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Tahun Lulus</label>
                            <input type="date" name="tahun_lulus" value="{{ old('tahun_lulus') }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Angkatan</label>
                            <input type="number" name="angkatan" value="{{ old('angkatan') }}" placeholder="Contoh: 2021" min="2000" max="2099"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Jenis Kelamin</label>
                            <div class="flex gap-4 mt-1">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} class="accent-[#0067B1]">
                                    <span class="text-sm text-gray-700">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} class="accent-[#0067B1]">
                                    <span class="text-sm text-gray-700">Perempuan</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->role === 'SuperAdmin')
                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Program Studi</label>
                        <select name="prodi" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all bg-white">
                            <option value="">-- Pilih Prodi --</option>
                            @foreach($prodis as $prodi)
                            <option value="{{ $prodi }}" {{ old('prodi') == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Program Studi</label>
                        <input type="text" value="{{ auth()->user()->prodi }}" disabled class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-slate-50 text-slate-600 text-sm transition-all">
                        <input type="hidden" name="prodi" value="{{ auth()->user()->prodi }}">
                    </div>
                    @endif
                </div>

                <div class="bg-gray-50/80 p-4 flex justify-end gap-2 border-t border-gray-100 flex-shrink-0">
                    <button type="button" onclick="toggleModal('modalTambah')" class="px-4 py-1.5 border border-gray-300 rounded-lg text-gray-600 text-xs font-bold hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-[#0067B1] text-white rounded-lg text-xs font-bold hover:bg-blue-800 shadow-md transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== MODAL EDIT (Scrollable) ===== --}}
    <div id="modalEdit" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-3 sm:p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[90vh] flex flex-col overflow-hidden">
            <div class="p-5 pb-0 flex justify-between items-start flex-shrink-0">
                <div>
                    <h2 class="text-[#0067B1] text-lg font-bold tracking-tight">Edit Akun Alumni</h2>
                    <p class="text-gray-500 text-[11px] mt-0.5">Kosongkan password jika tidak ingin mengubahnya.</p>
                </div>
                <button type="button" onclick="toggleModal('modalEdit')" class="text-gray-400 hover:text-gray-600 p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="mt-3 border-gray-100 flex-shrink-0">

            <form id="formEdit" method="POST" class="flex flex-col flex-1 overflow-hidden">
                @csrf
                @method('PUT')
                <div class="flex-1 overflow-y-auto p-5 space-y-3 min-h-0 custom-scroll">
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
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Angkatan</label>
                        <input type="number" name="angkatan" id="editAngkatan" placeholder="Contoh: 2021" min="2000" max="2099"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">
                    </div>

                    @if(auth()->user()->role === 'SuperAdmin')
                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Program Studi</label>
                        <select name="prodi" id="editProdi" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all bg-white">
                            <option value="">-- Pilih Prodi --</option>
                            @foreach($prodis as $prodi)
                            <option value="{{ $prodi }}">{{ $prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Program Studi</label>
                        <input type="text" value="{{ auth()->user()->prodi }}" disabled
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-slate-50 text-slate-600 text-sm transition-all">
                        <input type="hidden" name="prodi" id="editProdi" value="{{ auth()->user()->prodi }}">
                    </div>
                    @endif

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

                <div class="bg-gray-50/80 p-4 flex justify-end gap-2 border-t border-gray-100 flex-shrink-0">
                    <button type="button" onclick="toggleModal('modalEdit')" class="px-4 py-1.5 border border-gray-300 rounded-lg text-gray-600 text-xs font-bold hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-[#0067B1] text-white rounded-lg text-xs font-bold hover:bg-blue-800 shadow-md transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== MODAL HAPUS ===== --}}
    <div id="modalHapus" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden mx-3">
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
        // Fungsi global toggle responsive sidebar admin
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebarAdmin');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        function toggleModal(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function openEdit(nim, nama, tahunLulus, jenisKelamin, prodi, angkatan) {
            document.getElementById('editNim').value = nim;
            document.getElementById('editNama').value = nama;
            document.getElementById('editTahunLulus').value = tahunLulus;
            document.getElementById('editAngkatan').value = angkatan;
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

        const roleSelect = document.getElementById('roleSelect');
        const fieldAlumni = document.getElementById('fieldAlumni');
        const fieldNamaLengkap = document.getElementById('fieldNamaLengkap');
        const labelUsername = document.getElementById('labelUsername');
        const inputUsername = document.getElementById('inputUsername');

        function toggleFieldAlumni() {
            if (!roleSelect) return;

            if (roleSelect.value === 'Admin') {
                fieldAlumni.classList.add('hidden');
                fieldNamaLengkap.classList.add('hidden');
                labelUsername.innerText = 'Username';
                inputUsername.placeholder = 'Masukkan username admin';
            } else {
                fieldAlumni.classList.remove('hidden');
                fieldNamaLengkap.classList.remove('hidden');
                labelUsername.innerText = 'NIM';
                inputUsername.placeholder = 'Contoh: E41240742';
            }
        }

        if (roleSelect) {
            roleSelect.addEventListener('change', toggleFieldAlumni);
            toggleFieldAlumni();
        }
    </script>
</body>
</html>