<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Dashboard Alumni</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 h-screen flex flex-col">

    <div class="flex flex-1 overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 shrink-0 px-6 py-8 flex flex-col bg-white border-r border-slate-100 shadow-sm">

            <h1 class="text-lg font-bold text-slate-800 mb-8">Dashboard Alumni</h1>

            {{-- mt-auto mendorong logout ke bawah sidebar --}}
            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2.5 rounded-full text-xs font-bold transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 px-8 py-8">
            <h1 class="text-2xl font-bold text-slate-800">Dashboard Alumni</h1>
        </main>

    </div>

    <script>
        history.replaceState(null, '', window.location.href);
    </script>
</body>
</html>
