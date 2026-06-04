<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Reset Password - Portal Alumni Polije</title>
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

            <div class="flex justify-center mb-6">
                <span class="inline-flex items-center gap-2 bg-green-50 text-green-600 border border-green-200 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                    ✓ Link Terverifikasi
                </span>
            </div>

            <h2 class="text-2xl font-bold text-[#004a80] mb-2 text-center">Buat Password Baru</h2>
            <p class="text-slate-500 text-sm text-center mb-8">
                Masukkan password baru yang kuat. Minimal 8 karakter.
            </p>

            {{-- Error --}}
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                {{-- Password Baru --}}
                <div class="mb-5">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">
                        Password Baru
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            placeholder="Minimal 8 karakter" required minlength="8"
                            class="w-full px-4 py-3 pr-12 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-sm">
                        <button type="button" onclick="toggle('password', 'eye1')"
                            class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                            <svg id="eye1" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-6">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Ulangi password baru" required
                            class="w-full px-4 py-3 pr-12 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-sm">
                        <button type="button" onclick="toggle('password_confirmation', 'eye2')"
                            class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                            <svg id="eye2" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#004a80] hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Password Baru
                </button>
            </form>

        </div>
    </div>

    <script>
        function toggle(fieldId, eyeId) {
            const f = document.getElementById(fieldId);
            f.type = f.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>