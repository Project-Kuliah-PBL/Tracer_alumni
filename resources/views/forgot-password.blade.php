<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-slate-100">
        <h2 class="text-2xl font-bold text-[#004a80] mb-2 text-center">Lupa Password?</h2>
        <p class="text-slate-500 text-sm text-center mb-8">Masukkan username Anda untuk meriset password.</p>

        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('username'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                {{ $errors->first('username') }}
            </div>
        @endif
<form action="{{ route('password.reset') }}" method="POST">
    @csrf
    <div class="mb-6">
        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Username</label>
        <input type="text" name="username" required
            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none" 
            placeholder="Masukkan username anda...">
    </div>

    <button type="submit" class="w-full bg-[#004a80] hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all transform hover:-translate-y-1">
        Riset Password
    </button>
</form>
        <div class="mt-8 text-center">
            <a href="/login" class="text-sm text-slate-400 hover:text-blue-600 font-semibold transition-all">
                Kembali ke Login
            </a>
        </div>
    </div>

</body>
</html>