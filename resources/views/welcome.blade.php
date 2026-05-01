<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Polije - Tracer Study</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            overflow: hidden; 
        }
    </style>
</head>
<body class="bg-slate-50 h-screen flex flex-col">

     <nav class="w-full shrink-0 bg-white shadow-sm">
        <div class="w-full px-8 py-5 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('image/PolijeLogo.png') }}" alt="Logo" class="h-10 w-auto">
                <div class="flex flex-col">
                    <h1 class="font-[700] text-base text-[#0067B1] leading-none uppercase tracking-tight">Politeknik Negeri Jember</h1>
                    <p class="text-[8px] tracking-[0.3em] font-bold text-[#0067B1] uppercase mt-1 opacity-60">Alumni Portal</p>
                </div>
            </div>

           <div class="flex items-center space-x-10">
    <a href="{{ route('cari.alumni') }}" class="text-[#0067B1] font-bold text-sm hover:opacity-70 transition-all border-b-2 border-transparent hover:border-[#0067B1] pb-1">
        Cari Alumni
    </a>
    
    <a href="{{ route('login') }}" class="bg-[#0067B1] text-white px-8 py-2.5 rounded-full font-bold text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/10">
        Login
    </a>
</div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center px-10 pb-10 overflow-hidden">
        <div class="bg-white rounded-[60px] md:rounded-[80px] shadow-2xl shadow-slate-200/50 p-12 md:p-16 lg:p-20 flex flex-col md:flex-row items-center justify-between relative overflow-hidden w-full max-w-[1360px] h-full max-h-[700px]">
            
            <div class="absolute top-0 right-0 w-80 h-80 bg-blue-50 rounded-full -mr-20 -mt-20 blur-[100px] opacity-60"></div>

            <div class="w-full md:w-[60%] z-10">
                <div class="inline-flex items-center bg-[#E8F3FF] text-[#0067B1] px-5 py-2 rounded-full text-[10px] md:text-[11px] font-extrabold tracking-widest uppercase mb-8">
                    <span class="mr-2 text-xs">✨</span> Ecosystem Alumni Masa Depan
                </div>
                
                <h2 class="text-4xl md:text-5xl lg:text-[65px] xl:text-[75px] font-extrabold text-[#1E3A8A] leading-[1.1] mb-8 tracking-tight">
                    Pantau Jejak <span class="text-[#0067B1]">Karir</span> <br> Alumni Polije.
                </h2>
                
                <p class="text-slate-500 text-base lg:text-lg leading-relaxed max-w-xl font-medium">
                    Menghubungkan ribuan profesional unggulan untuk membangun jaringan yang inklusif, inspiratif, dan memberikan dampak nyata bagi almamater.
                </p>
            </div>

            <div class="w-full md:w-[35%] flex justify-end items-center relative">
                <div class="absolute inset-0 bg-blue-400/10 blur-[120px] rounded-full scale-125"></div>
                
                <img src="{{ asset('image/PolijeLogo.png') }}"
                     alt="Logo Polije Besar" 
                     class="relative w-[85%] h-auto drop-shadow-[0_20px_50px_rgba(0,103,177,0.2)] transform hover:scale-105 transition-transform duration-700">
            </div>

        </div>
    </main>

</body>
</html>