<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Alumni - Portal Alumni Polije</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-[#F1F5F9] min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="w-full bg-white shadow-sm">
        <div class="max-w-[1300px] mx-auto px-10 py-4 flex items-center justify-between">

            <div class="flex items-center gap-3">
                <img src="{{ asset('image/PolijeLogo.png') }}" class="h-10">

                <div>
                    <h1 class="font-extrabold text-[#0067B1] text-lg leading-none">
                        Politeknik Negeri Jember
                    </h1>
                    <p class="text-[10px] tracking-widest text-[#0067B1] font-bold opacity-60">
                        ALUMNI PORTAL
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <a href="/cari-alumni" class="text-[#0067B1] font-semibold border-b-2 border-[#0067B1] pb-1">
                    Cari Alumni
                </a>

                <a href="{{ route('login') }}"
                   class="bg-[#0067B1] text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-800">
                    Login
                </a>
            </div>

        </div>
    </nav>

    <main class="flex-1 py-10">
        <div class="max-w-[1200px] mx-auto space-y-8">

            <!-- ROW 1 -->
            <div class="grid grid-cols-12 gap-6">

                <!-- Profile -->
                <div class="col-span-8 bg-white rounded-3xl shadow-sm overflow-hidden">

                    <div class="h-36 bg-[#0F5C8E]"></div>

                    <div class="px-8 pb-6 relative">
                        <div class="-mt-12 mb-3">
                            <img
                                src="{{ $alumni->foto_profile ?? 'https://ui-avatars.com/api/?name=Rizky Ramadhan' }}"
                                class="w-24 h-24 rounded-full border-4 border-white shadow object-cover"
                            >
                        </div>

                        <h2 class="text-2xl font-bold text-slate-800">
                            {{ $alumni->nama ?? 'Rizky Ramadhan' }}
                        </h2>

                        <p class="text-slate-500 text-sm mt-1">
                            {{ $alumni->jabatan_sekarang ?? 'Senior Product Designer' }} di TechNova
                        </p>

                        <p class="text-slate-400 text-sm mt-2">
                            📍 {{ $alumni->alamat ?? 'Jakarta, Indonesia' }}
                        </p>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="col-span-4 bg-white rounded-3xl p-6 shadow-sm">
                    <h3 class="font-bold text-lg mb-6 text-slate-800">Kontak</h3>

                    <div class="space-y-5">

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                ✉️
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Email</p>
                                <p class="text-sm font-semibold">
                                    {{ $alumni->email ?? 'rizky.r@example.com' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                📞
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Telepon</p>
                                <p class="text-sm font-semibold">
                                    {{ $alumni->no_telepon ?? '+62 812 3456 7890' }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- ROW 2 -->
            <div class="grid grid-cols-12 gap-6">

                <!-- Pendidikan -->
                <div class="col-span-4 bg-white rounded-3xl p-6 shadow-sm">
                    <h3 class="font-bold text-lg mb-6">Riwayat Pendidikan</h3>

                    <div class="space-y-6">
                        <div>
                            <p class="font-semibold text-sm">Bachelor of Design</p>
                            <p class="text-sm text-slate-500">Universitas Indonesia</p>
                            <p class="text-xs text-slate-400">2014 - 2018</p>

                            <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-md mt-2 inline-block">
                                IPK : 3.85 / 4.00
                            </span>
                        </div>

                        <div>
                            <p class="font-semibold text-sm">Bachelor of Design</p>
                            <p class="text-sm text-slate-500">Universitas Indonesia</p>
                            <p class="text-xs text-slate-400">2014 - 2018</p>

                            <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-md mt-2 inline-block">
                                NILAI : 3.85 / 4.00
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Pengalaman -->
                <div class="col-span-8 bg-white rounded-3xl p-6 shadow-sm">
                    <h3 class="font-bold text-lg mb-6">Pengalaman & Detail Pekerjaan</h3>

                    <div class="space-y-6">

                        <div class="flex justify-between">
                            <div>
                                <p class="font-semibold">Senior Product Designer</p>
                                <p class="text-sm text-slate-500">TechNova</p>
                                <p class="text-sm text-slate-500 mt-2">
                                    Memimpin tim frontend dalam pengembangan aplikasi web enterprise.
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-xs text-slate-400">Januari 2021 - Sekarang</p>
                                <span class="text-[10px] bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                                    PEKERJAAN TETAP
                                </span>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div>
                                <p class="font-semibold">UI/UX Designer</p>
                                <p class="text-sm text-slate-500">CreativeStudio</p>
                            </div>

                            <div class="text-right">
                                <p class="text-xs text-slate-400">2018 - 2020</p>
                                <span class="text-[10px] bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                                    MAGANG
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- ROW 3 -->
            <div class="grid grid-cols-12 gap-6">

                <!-- Sertifikat -->
                <div class="col-span-8 bg-white rounded-3xl p-6 shadow-sm">
                    <h3 class="font-bold text-lg mb-6">Pencapaian & Sertifikasi</h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="border rounded-xl p-4">
                            <div class="h-32 bg-slate-200 rounded-lg mb-3"></div>
                            <p class="font-semibold text-sm">Google Cloud Architect</p>
                        </div>

                        <div class="border rounded-xl p-4">
                            <div class="h-32 bg-slate-200 rounded-lg mb-3"></div>
                            <p class="font-semibold text-sm">Interaction Design</p>
                        </div>
                    </div>
                </div>
<!-- Social Card -->
<div class="col-span-4 bg-[#F1F5F9] rounded-[28px] p-6 border border-slate-200">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-slate-700">Social</h3>

    
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-2 gap-5">

        <!-- Portfolio -->
        <div class="social-box">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
            </svg>
            <span>Portfolio</span>
        </div>

        <!-- LinkedIn -->
        <div class="social-box">
            <svg class="h-5 w-5 mb-2 text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
            </svg>
            <span>LinkedIn</span>
        </div>

        <!-- GitHub -->
        <div class="social-box">
            <svg class="h-5 w-5 mb-2 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.042-1.416-4.042-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
          <span class="text-[10px] font-bold">GitHub</span>
        </div>

        <!-- Instagram -->
        <div class="social-box">
            <svg class="h-5 w-5 mb-2 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849s-.011 3.585-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.849-.07c-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849s.012-3.585.07-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.337 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.351-.2 6.78-2.618 6.98-6.98.058-1.28.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.353-2.612-6.78-6.98-6.98-1.281-.058-1.69-.072-4.949-.072zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            <span>Instagram</span>
        </div>

        <!-- TikTok -->
        <div class="social-box">
              <svg class="h-5 w-5 mb-2 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.44 1.43-1.58 2.41-.02.16-.03.32-.03.48s.01.32.03.48c.22 1.44 1.49 2.53 2.91 2.53 1.25-.02 2.37-.8 2.82-1.94.13-.33.2-.68.22-1.03.04-3.95.02-7.91.02-11.87z"/></svg>
            <span>TikTok</span>
        </div>

        <!-- X -->
        <div class="social-box">
                <svg class="h-4 w-4 mb-2 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.045 4.126H5.078z"/></svg>
                              
            <span>X</span>
        </div>

    </div>
</div>

<style>
.social-box {
    background: #E2E8F0;
    border-radius: 20px;
    height: 95px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    font-size: 13px;
    font-weight: 600;
    color: #475569;

    transition: all 0.2s ease;
}

.social-box:hover {
    background: #CBD5F5;
    transform: scale(1.03);
}
</style>
                </div>

            </div>

        </div>
    </main>

</body>
</html>