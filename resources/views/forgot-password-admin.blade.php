<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Reset Password Admin - Portal Alumni Polije</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>* { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 h-screen flex flex-col overflow-hidden">

    <div class="shrink-0 w-full z-20">
        @include('partials.header')
    </div>

    <div class="flex-1 flex items-center justify-center p-4 overflow-y-auto">
        <div class="w-full max-w-md bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-slate-100">

            {{-- Badge admin --}}
            <div class="flex justify-center mb-6">
                <span class="inline-flex items-center gap-2 bg-orange-50 text-orange-600 border border-orange-200 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                    🔑 Reset Password Admin
                </span>
            </div>

            <h2 class="text-2xl font-bold text-[#004a80] mb-2 text-center">Verifikasi Email</h2>
            <p class="text-slate-500 text-sm text-center mb-8">
                Masukkan email yang terdaftar pada akun admin
                <strong class="text-slate-700">{{ session('admin_username') }}</strong>.
                Link reset akan dikirim ke email tersebut.
            </p>

            {{-- Status sukses --}}
            @if(session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="font-bold mb-1">Email terkirim!</p>
                    <p>{{ session('status') }}</p>
                    <p class="mt-2 text-xs text-green-600">Periksa folder Inbox atau Spam di email Anda.</p>
                </div>
            </div>
            @endif

            {{-- Error --}}
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                {{ $errors->first() }}
            </div>
            @endif

            @if(!session('status'))
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                {{-- Simpan admin_username di session via hidden field --}}
                <div class="mb-6">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">
                        Email Terdaftar
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-sm"
                            placeholder="email@polije.ac.id">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#004a80] hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Kirim Link Reset
                </button>
            </form>
            @endif

            <div class="mt-6 text-center space-y-2">
                <a href="{{ route('password.request') }}" class="block text-sm text-slate-400 hover:text-blue-600 font-semibold transition-all">
                    ← Kembali
                </a>
                <a href="{{ route('login') }}" class="block text-xs text-slate-300 hover:text-slate-500 transition-all">
                    Ke halaman login
                </a>
            </div>
        </div>
    </div>

</body>
</html>