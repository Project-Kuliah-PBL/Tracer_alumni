<!DOCTYPE html>
<html lang="id" x-data="{ 
    openEditAlumni: false,
    search: '',
    alumniEdit: { id: '', name: '', nim: '', year: '', prodi: '', status: '' }
}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Biodata Alumni - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow: hidden; }
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 h-screen flex flex-col">

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

                <a href="/admin/kelola-prodi" class="flex items-center space-x-3 text-slate-500 hover:bg-slate-50 px-5 py-3 rounded-full transition-all group mx-2"> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                    <span class="font-bold text-xs">Kelola Prodi</span>
                </a>

                <a href="/admin/edit-biodata-alumni" class="flex items-center gap-3 mx-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-bold text-xs border-r-4 border-blue-600 transition-all"> 
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

        <main class="flex-1 p-8 overflow-y-auto custom-scroll bg-slate-50">
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight"> Biodata Alumni</h1>
                    <p class="text-slate-500 text-sm">Biodata Alumni Politeknik Negeri Jember.</p>
                </div>
            </div>

            <div class="bg-white rounded-[24px] p-6 shadow-sm border border-slate-100">
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
                    <form method="GET" action="{{ route('admin.editbiodata') }}" class="relative w-full max-w-sm">
                        <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau NIM..." class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-xs focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </form>
                </div>

                <div class="overflow-hidden rounded-xl border border-slate-100">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 text-[10px] uppercase tracking-widest font-black border-b border-slate-100">
                                <th class="px-6 py-4">Alumni</th>
                                <th class="px-6 py-4 text-center">Angkatan</th>
                                <th class="px-6 py-4 text-center">Program Studi</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($alumni as $item)
                            <tr class="hover:bg-slate-50/50 transition-all group text-xs">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-9 w-9 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-600 text-xs shrink-0">
                                            {{ strtoupper(substr($item->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-700">{{ $item->nama }}</p>
                                            <p class="text-[10px] text-slate-400 uppercase font-medium">{{ $item->nim }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center text-slate-500 font-semibold">
                                    {{ $item->tahun_lulus ? \Carbon\Carbon::parse($item->tahun_lulus)->format('Y') : '—' }}
                                </td>
                                <td class="px-6 py-4 text-center text-slate-500 font-semibold">{{ $item->prodi ?? '—' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.biodata', $item->nim) }}"
                                       class="inline-block px-6 py-1.5 bg-blue-50 text-blue-600 rounded-lg font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm text-xs">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-400 text-xs">Belum ada data alumni.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $alumni->links() }}
                </div>
            </div>
        </main>
    </div>

</body>
</html>