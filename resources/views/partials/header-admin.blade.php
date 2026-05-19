<nav class="sticky top-0 w-full shrink-0 bg-white shadow-sm border-b border-slate-100 z-50">
    <div class="w-full px-4 md:px-6 lg:px-8 py-2 md:py-3 flex items-center justify-between">
        
        <div class="flex items-center space-x-2 md:space-x-3">
            <a href="/" class="flex items-center space-x-2 md:space-x-3">
                <img src="{{ asset('image/PolijeLogo.png') }}" alt="Logo" class="h-8 md:h-10 w-auto">
                <div class="flex flex-col">
                    <h1 class="font-[700] text-sm md:text-base text-[#0067B1] leading-none uppercase tracking-tight">Politeknik Negeri Jember</h1>
                    <p class="text-[7px] md:text-[8px] tracking-[0.3em] font-bold text-[#0067B1] uppercase mt-0.5 md:mt-1 opacity-60">Alumni Portal</p>
                </div>
            </a>
        </div>

        <div class="block lg:hidden">
            <button onclick="toggleSidebar()" class="p-2 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 shadow-sm active:scale-95 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

    </div>
</nav>