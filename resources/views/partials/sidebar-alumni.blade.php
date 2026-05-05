<aside class="w-64 shrink-0 bg-white border-r border-slate-200 p-6 flex flex-col">
    <div class="mb-8">
        <h2 class="text-slate-800 font-bold text-sm">Alumni Portal</h2>
        <p class="text-slate-400 text-[10px] font-medium">Verified Member</p>
    </div>

    <nav class="space-y-2 flex-1">
        <a href="{{ route('alumni.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-xs transition-all
                {{ ($activeMenu ?? '') === 'profil' ? 'bg-blue-50 text-blue-600 border-r-4 border-blue-600' : 'text-slate-400 hover:bg-slate-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Manajemen Profil
        </a>
        <a href="{{ route('alumni.manajemen_akun') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-xs transition-all
                {{ ($activeMenu ?? '') === 'akun' ? 'bg-blue-50 text-blue-600 border-r-4 border-blue-600' : 'text-slate-400 hover:bg-slate-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Manajemen Akun
        </a>
    </nav>

    <div class="pt-6 border-t border-slate-100">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center justify-start gap-3 bg-[#D32F2F] text-white w-full px-4 py-3 rounded-lg hover:bg-red-700 transition-all shadow-md shadow-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="font-bold text-xs uppercase tracking-wider">Log Out</span>
            </button>
        </form>
    </div>
</aside>
