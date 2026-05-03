<nav class="fixed top-0 left-0 right-0 w-full shrink-0 bg-white shadow-sm border-b border-slate-100 z-50">
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

 @if($showDashboardBtn ?? false)
            <div>
                <a href="{{ route('alumni.dashboard') }}" class="group flex items-center gap-2 text-[#003f87] text-sm font-semibold border-[1.5px] border-[#003f87] px-4 py-2 rounded-xl hover:bg-[#003f87] hover:text-white transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" class="stroke-[#003f87] group-hover:stroke-white transition-colors duration-200" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    <span class="hidden md:inline">Kembali ke Dashboard</span>
                </a>
            </div>
        @endif

    </div>
</nav>