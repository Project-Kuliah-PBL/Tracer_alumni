<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Alumni - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-custom-gradient {
            background: radial-gradient(circle at 10% 10%, #f0f7ff 0%, #ffffff 50%, #f5f3ff 100%);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

    @include('partials.header')

    <main class="w-full px-8 py-12">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-[800] text-[#1E3A8A] mb-4 tracking-tight">Temukan Koneksi Alumni</h2>
            <p class="text-slate-500 text-sm max-w-2xl mx-auto font-medium opacity-80">
                Jelajahi jaringan profesional lulusan Politeknik Negeri Jember dari berbagai angkatan dan program studi.
            </p>

            <div class="mt-10 max-w-3xl mx-auto relative">
                <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" placeholder="Cari nama, jabatan, atau perusahaan..." 
                    class="w-full bg-white border border-slate-100 py-5 pl-16 pr-8 rounded-full shadow-xl shadow-slate-200/50 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-sm font-medium">
            </div>

            <div class="flex flex-wrap justify-center gap-3 mt-6">
                <button class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-full text-xs font-bold transition-all flex items-center">
                    <span class="mr-2 opacity-60">📅</span> Tahun Lulus
                </button>
                <button class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-full text-xs font-bold transition-all flex items-center">
                    <span class="mr-2 opacity-60">🎓</span> Program Studi
                </button>
                <button class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-full text-xs font-bold transition-all flex items-center">
                    <span class="mr-2 opacity-60">📍</span> Perusahaan
                </button>
                <button class="bg-[#0067B1] text-white px-6 py-2.5 rounded-full text-xs font-bold hover:bg-blue-800 transition-all shadow-lg shadow-blue-900/20">
                    Terapkan Filter
                </button>
            </div>
        </div>

        <hr class="border-slate-200 mb-10">

        <div class="flex justify-between items-center mb-8">
            <div class="border-l-4 border-[#0067B1] pl-4">
                <h3 class="font-[800] text-slate-800 text-lg">Direktori Alumni</h3>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Menampilkan 99 hasil untuk pencarian Anda</p>
            </div>
            <div class="flex space-x-2">
                <button class="p-2 bg-slate-100 rounded-lg text-slate-400 hover:text-[#0067B1]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </button>
                <button class="p-2 text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(range(1, 6) as $index)
            <div class="bg-white rounded-[40px] p-8 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-50 group">
                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-5">
                        <div class="absolute inset-0 bg-blue-100 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <img src="https://ui-avatars.com/api/?name=Alumni+{{ $index }}&background=0D8ABC&color=fff" class="relative w-24 h-24 rounded-full border-4 border-white shadow-lg">
                    </div>
                    
                    <h4 class="font-extrabold text-slate-800 text-lg mb-1">Ahmad Ridwan</h4>
                    <p class="text-[#0067B1] font-bold text-xs mb-3">Senior Web Developer</p>
                    
                    <div class="flex items-center text-slate-400 text-[11px] font-bold uppercase tracking-wider mb-8">
                        <span class="mr-2">🎓</span> Angkatan 2021
                    </div>
                    
                    <a href="#" class="w-full py-3.5 border-2 border-slate-100 rounded-2xl text-slate-600 font-bold text-xs hover:bg-[#0067B1] hover:text-white hover:border-[#0067B1] transition-all">
                        Lihat Profil
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-16 text-center">
            <button class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-10 py-3.5 rounded-full text-xs font-black uppercase tracking-widest transition-all">
                Muat Lebih Banyak
            </button>
        </div>
    </main>

    <footer class="mt-auto py-10 bg-white border-t border-slate-100">
        <div class="w-full px-8 flex flex-col md:flex-row justify-between items-center text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            <p>© 2026 Politeknik Negeri Jember</p>
            <div class="flex space-x-8 mt-4 md:mt-0">
                <a href="#" class="hover:text-blue-500">Kebijakan Privasi</a>
                <a href="#" class="hover:text-blue-500">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-blue-500">Bantuan</a>
            </div>
        </div>
    </footer>

</body>
</html>