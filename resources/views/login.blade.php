<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-custom-gradient {
            background: radial-gradient(circle at 10% 10%, #f0f7ff 0%, #ffffff 50%, #f5f3ff 100%);
        }
    </style>
</head>
<body class="bg-custom-gradient min-h-screen flex flex-col">

    @include('partials.header')

    <main class="flex-grow flex items-center justify-center px-8 py-12">
        <div class="w-full max-w-6xl flex flex-col md:flex-row items-center justify-between gap-12">

            {{-- Kiri: Teks Hero --}}
            <div class="w-full md:w-1/2">
                <div class="inline-flex items-center bg-white/80 text-[#0067B1] px-4 py-1.5 rounded-full text-[9px] font-black tracking-widest uppercase mb-6 border border-blue-100/50 shadow-sm">
                    <span class="mr-2 text-blue-500 font-bold text-xs">✪</span> Ecosystem Alumni Masa Depan
                </div>

                <h2 class="text-5xl lg:text-[68px] font-[800] text-[#1E3A8A] leading-[1.1] mb-6 tracking-tighter">
                    Pantau Jejak <span class="text-[#0067B1]">Karir</span> <br> Alumni Polije.
                </h2>

                <p class="text-slate-500 text-base md:text-lg leading-relaxed max-w-md font-medium opacity-80">
                    Menghubungkan ribuan profesional unggulan untuk membangun jaringan yang inklusif, inspiratif, dan memberikan dampak nyata bagi almamater.
                </p>
            </div>

            {{-- Kanan: Form Login --}}
            <div class="w-full md:w-[420px] shrink-0">
                <div class="bg-white rounded-[45px] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.08)] p-10 border border-slate-100 relative">

                    <img src="{{ asset('image/PolijeLogo.png') }}" class="absolute top-10 right-[-15px] h-24 opacity-[0.03] rotate-12 pointer-events-none">

                    <div class="relative z-10">
                        <h3 class="text-xl font-[800] text-[#1E3A8A] mb-1.5 tracking-tight">Portal Tracking Alumni</h3>
                        <p class="text-slate-400 text-xs mb-8 font-medium">Masuk untuk mengakses dashboard karir Anda.</p>

                        <form action="{{ route('login') }}" method="POST" class="space-y-5">
                            @csrf

                            {{-- Error message --}}
                            @if ($errors->any())
                            <div class="bg-red-50 border border-red-100 text-red-600 text-xs font-semibold rounded-xl px-4 py-3">
                                {{ $errors->first() }}
                            </div>
                            @endif

                            {{-- Username --}}
                            <div>
                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.1em] mb-2.5 ml-1">Username</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-5 flex items-center text-slate-400 opacity-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username"
                                        required
                                        class="w-full bg-slate-50 border-none rounded-xl py-3.5 pl-14 pr-6 text-sm font-medium focus:ring-2 focus:ring-[#0067B1]/10 transition-all outline-none">
                                </div>
                               
                            </div>

                          {{-- Password --}}
<div class="space-y-2">
    <div class="flex justify-between items-center px-1">
        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.1em]">
            Password
        </label>
        <a href="#" class="text-[9px] font-bold text-[#0067B1] hover:text-blue-700 transition-colors uppercase tracking-wider">
            Lupa Password?
        </a>
    </div>
    <div class="relative group">
        <span class="absolute inset-y-0 left-5 flex items-center text-slate-400 opacity-50 group-focus-within:text-[#0067B1] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </span>
        <input type="password" name="password" placeholder="Masukkan password"
            required
            class="w-full bg-slate-50 border-none rounded-xl py-3.5 pl-14 pr-6 text-sm font-medium focus:ring-2 focus:ring-[#0067B1]/10 transition-all outline-none">
    </div>
</div>

                            <button type="submit"
                                class="w-full bg-[#0067B1] text-white py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-blue-900/10 hover:bg-blue-800 transition-all flex items-center justify-center mt-3">
                                Masuk
                            </button>
                        </form>

                        <div class="mt-10 flex items-center justify-center space-x-5 text-[8px] font-black text-slate-300 uppercase tracking-widest">
                            <a href="#" class="hover:text-blue-500 transition-colors">Help Center</a>
                            <span class="opacity-30">•</span>
                            <a href="#" class="hover:text-blue-500 transition-colors">Privacy Policy</a>
                            <span class="opacity-30">•</span>
                            <a href="#" class="hover:text-blue-500 transition-colors">Terms</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
