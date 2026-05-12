<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Program Studi - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow: hidden; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 h-screen flex flex-col">

    <div class="shrink-0 w-full">
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

                <a href="{{ route('admin.kelola_akun') }}" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="font-bold text-xs">Kelola Akun</span>
                </a>

                <a href="{{ route('admin.prodi') }}" class="flex items-center gap-3 mx-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs border-r-4 border-blue-600 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
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
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center justify-center gap-3 bg-[#D32F2F] text-white w-full py-3 rounded-xl hover:bg-red-700 transition-all shadow-md cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="font-bold text-sm">LogOut</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <main class="flex-1 px-8 py-8 overflow-y-auto no-scrollbar">

            @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-100 text-green-700 text-xs font-semibold rounded-xl px-4 py-3">
                {{ session('success') }}
            </div>
            @endif

            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-3xl font-[800] text-slate-800 mb-1 tracking-tight">Kelola Program Studi</h2>
                    <p class="text-slate-500 text-xs font-medium opacity-80">Atur daftar prodi yang tersedia pada form tambah akun alumni.</p>
                </div>
                <button onclick="toggleModal('modalTambah')" class="bg-[#0067B1] text-white px-4 py-2 rounded-xl font-bold text-xs flex items-center gap-2 hover:bg-blue-800 transition-all shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Prodi
                </button>
            </div>

            {{-- Card total --}}
            <div class="bg-white p-5 rounded-[25px] shadow-sm border border-slate-100 w-fit mb-6 pr-12 relative overflow-hidden">
                <div class="absolute left-0 top-0 w-1 h-full bg-blue-600"></div>
                <p class="text-slate-400 text-[9px] font-bold uppercase tracking-widest mb-0.5">Total Prodi</p>
                <h3 class="text-2xl font-[800] text-slate-800">{{ $prodis->count() }}</h3>
            </div>

            {{-- Tabel --}}
            <div class="bg-white rounded-[30px] shadow-sm border border-slate-100 overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-[9px] font-black uppercase tracking-wider bg-slate-50/50">
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Nama Program Studi</th>
                                <th class="px-6 py-4 text-center">Kode NIM</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($prodis as $i => $prodi)
                            <tr class="hover:bg-slate-50/50 transition-all">
                                <td class="px-6 py-4 text-xs text-slate-400">{{ $i + 1 }}</td>
                                <td class="px-6 py-4 text-xs font-bold text-slate-800">{{ $prodi->nama }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($prodi->kode_nim)
                                        <span class="bg-blue-50 text-blue-700 border border-blue-100 px-3 py-1 rounded-full text-[10px] font-black tracking-wider">
                                            {{ $prodi->kode_nim }}
                                        </span>
                                    @else
                                        <span class="text-slate-300 text-[10px]">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-1">
                                        <button onclick="openEdit({{ $prodi->id }}, '{{ addslashes($prodi->nama) }}', '{{ $prodi->kode_nim }}')"
                                            class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <form action="{{ route('admin.prodi.destroy', $prodi) }}" method="POST"
                                            onsubmit="return confirm('Hapus prodi {{ addslashes($prodi->nama) }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-400 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-400 text-xs font-medium">
                                    Belum ada prodi. Klik "Tambah Prodi" untuk menambahkan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    {{-- Modal Tambah --}}
    <div id="modalTambah" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
            <div class="p-5 pb-0 flex justify-between items-start">
                <div>
                    <h2 class="text-[#0067B1] text-lg font-bold tracking-tight">Tambah Program Studi</h2>
                    <p class="text-gray-500 text-[11px] mt-0.5">Masukkan nama program studi baru.</p>
                </div>
                <button onclick="toggleModal('modalTambah')" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="mt-3 border-gray-100">
            <form action="{{ route('admin.prodi.store') }}" method="POST">
                @csrf
                <div class="p-5">
                    @if($errors->any())
                    <div class="mb-3 bg-red-50 border border-red-100 text-red-600 text-xs font-semibold rounded-xl px-4 py-3">
                        {{ $errors->first() }}
                    </div>
                    @endif
                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Nama Prodi</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: D4 Teknik Informatika" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">

                    <div class="mt-3">
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Kode NIM</label>
                        <input type="text" name="kode_nim" value="{{ old('kode_nim') }}"
                            placeholder="Contoh: E, F, G (huruf awal NIM)"
                            maxlength="20"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all uppercase">
                        <p class="text-[10px] text-gray-400 mt-1 ml-1">Kode ini digunakan untuk mencocokkan prodi saat import Excel.</p>
                    </div>
                </div>
                <div class="bg-gray-50/80 p-4 flex justify-end gap-2 border-t border-gray-100">
                    <button type="button" onclick="toggleModal('modalTambah')" class="px-4 py-1.5 border border-gray-300 rounded-lg text-gray-600 text-xs font-bold hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-[#0067B1] text-white rounded-lg text-xs font-bold hover:bg-blue-800 shadow-md transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div id="modalEdit" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
            <div class="p-5 pb-0 flex justify-between items-start">
                <h2 class="text-[#0067B1] text-lg font-bold tracking-tight">Edit Program Studi</h2>
                <button onclick="toggleModal('modalEdit')" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <hr class="mt-3 border-gray-100">
            <form id="formEdit" method="POST">
                @csrf @method('PUT')
                <div class="p-5">
                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Nama Prodi</label>
                    <input type="text" name="nama" id="editNama" required
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all">

                    <div class="mt-3">
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Kode NIM</label>
                        <input type="text" name="kode_nim" id="editKodeNim"
                            placeholder="Contoh: E, F, G"
                            maxlength="20"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#0067B1]/20 focus:border-[#0067B1] focus:outline-none text-sm transition-all uppercase">
                        <p class="text-[10px] text-gray-400 mt-1 ml-1">Kode ini digunakan untuk mencocokkan prodi saat import Excel.</p>
                    </div>
                </div>
                <div class="bg-gray-50/80 p-4 flex justify-end gap-2 border-t border-gray-100">
                    <button type="button" onclick="toggleModal('modalEdit')" class="px-4 py-1.5 border border-gray-300 rounded-lg text-gray-600 text-xs font-bold hover:bg-white transition-all">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-[#0067B1] text-white rounded-lg text-xs font-bold hover:bg-blue-800 shadow-md transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function openEdit(id, nama, kodeNim) {
            document.getElementById('editNama').value = nama;
            document.getElementById('editKodeNim').value = kodeNim;
            document.getElementById('formEdit').action = '/admin/kelola-prodi/' + id;
            toggleModal('modalEdit');
        }

        @if($errors->any())
            document.getElementById('modalTambah').classList.remove('hidden');
        @endif
    </script>

</body>
</html>
