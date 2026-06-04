<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Lupa Password - Portal Alumni Polije</title>
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

            <h2 class="text-2xl font-bold text-[#004a80] mb-2 text-center">Lupa Password?</h2>
            <p class="text-slate-500 text-sm text-center mb-8">
                Masukkan username Anda. Sistem akan menentukan cara reset yang sesuai.
            </p>

            {{-- Status sukses (Alumni) --}}
            @if(session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('status') }}
            </div>
            @endif

            {{-- Error --}}
            @if($errors->has('username'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                {{ $errors->first('username') }}
            </div>
            @endif

            <form action="{{ route('password.check') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">
                        Username / NIM
                    </label>
                    <input type="text" name="username" value="{{ old('username') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-sm"
                        placeholder="Masukkan username anda...">
                </div>

                <button type="submit"
                    class="w-full bg-[#004a80] hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5">
                    Lanjutkan
                </button>
            </form>

            {{-- Info alur --}}
            <div class="mt-6 bg-slate-50 rounded-xl p-4 space-y-2">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Cara Reset Berdasarkan Akun</p>
                <div class="flex items-start gap-2">
                    <span class="text-blue-500 text-xs mt-0.5">🎓</span>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        <strong class="text-slate-700">Alumni:</strong> Password akan direset menjadi NIM Anda secara otomatis.
                    </p>
                </div>
                <div class="flex items-start gap-2">
                    <span class="text-orange-500 text-xs mt-0.5">🔑</span>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        <strong class="text-slate-700">Admin:</strong> Link reset akan dikirim ke email yang terdaftar.
                    </p>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm text-slate-400 hover:text-blue-600 font-semibold transition-all">
                    ← Kembali ke Login
                </a>
            </div>
        </div>
    </div>

</body>
</html>