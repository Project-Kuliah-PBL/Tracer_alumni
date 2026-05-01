<nav class="w-full shrink-0 bg-white shadow-sm sticky top-0 z-50">
    <div class="w-full px-8 py-5 flex items-center justify-between">

        <!-- Bagian Kiri: Logo dan Identitas -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('image/PolijeLogo.png') }}" alt="Logo" class="h-10 w-auto">
            <div class="flex flex-col">
                <h1 class="font-[700] text-base text-[#0067B1] leading-none uppercase tracking-tight">Politeknik Negeri Jember</h1>
                <p class="text-[8px] tracking-[0.3em] font-bold text-[#0067B1] uppercase mt-1 opacity-60">Alumni Portal</p>
            </div>
        </div>

        <!-- Bagian Kanan: Info User + Logout -->
        <div class="flex items-center gap-4">
            <div class="flex flex-col items-end">
                <span class="text-xs font-bold text-slate-700">{{ Auth::user()->username }}</span>
                <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">{{ Auth::user()->role }}</span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-full text-xs font-bold transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

    </div>
</nav>
