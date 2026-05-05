{{-- resources/views/Alumni/manajemen-akun.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun – Alumni Portal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --color-primary:       #003f87;
            --color-primary-soft:  #eff6ff;
            --color-primary-btn:   #0061a4;
            --color-secondary:     #191c21;
            --color-muted:         #64748b;
            --color-text:          #424752;
            --color-text-light:    #727784;
            --color-border:        #e1e2ea;
            --color-border-sidebar:#E2E8F0;
            --color-bg:            #f1f4f6;
            --color-surface:       #ffffff;
            --color-surface-icon:  #e7e8f0;
            --color-danger:        #d12924;
            --color-success:       #16a34a;
            --color-success-soft:  #dcfce7;
            --color-warning:       #d97706;

            --font-heading: 'Plus Jakarta Sans', sans-serif;
            --font-body:    'Inter', sans-serif;

            --radius-sm:  0.5rem;
            --radius-md:  0.75rem;
            --radius-lg:  1rem;
            --radius-xl:  1.25rem;
            --radius-full:9999px;

            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.07);

            --sidebar-width:  256px;
            --header-height:  64px;
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: var(--font-body);
            background-color: var(--color-bg);
            color: var(--color-text);
            line-height: 1.5;
        }

        /* ═══ HEADER ═══ */
        .site-header {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: var(--header-height);
            background: #fff;
            border-bottom: 1px solid var(--color-border);
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            z-index: 50;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }

        .brand { display:flex; align-items:center; gap:.75rem; text-decoration:none; }
        .brand-logo {
            width: 2.5rem; height: 2.5rem;
            border-radius: 50%;
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            background: var(--color-primary-soft);
        }
        .brand-logo svg { width: 1.6rem; height: 1.6rem; }
        .brand-text h1 {
            font-family:var(--font-heading); font-weight:700; font-size:.9375rem;
            color:#0067B1; line-height:1; text-transform:uppercase; letter-spacing:.02em;
        }
        .brand-text p {
            font-size:.5rem; letter-spacing:.3em; font-weight:700;
            color:#0067B1; text-transform:uppercase; margin-top:.25rem; opacity:.6;
        }

        .btn-dashboard {
            display:inline-flex; align-items:center; gap:.4rem;
            text-decoration:none; color:var(--color-primary);
            font-family:var(--font-body); font-size:.875rem; font-weight:600;
            padding:.45rem 1rem;
            border:1.5px solid var(--color-primary); border-radius:var(--radius-md);
            background:transparent; white-space:nowrap;
            transition:background .2s, color .2s;
        }
        .btn-dashboard svg { stroke:var(--color-primary); flex-shrink:0; transition:stroke .2s; }
        .btn-dashboard:hover { background:var(--color-primary); color:#fff; }
        .btn-dashboard:hover svg { stroke:#fff; }

        /* ═══ SIDEBAR ═══ */
        .sidebar {
            position:fixed; top:var(--header-height); left:0;
            width:var(--sidebar-width);
            height:calc(100vh - var(--header-height));
            background:#fff; border-right:1px solid var(--color-border-sidebar);
            z-index:40; display:flex; flex-direction:column;
            padding-top:80px; overflow-y:auto;
        }

        .sidebar-header-block {
            position:absolute; top:0; left:0; width:100%;
            padding:1.5rem 1.25rem 1rem;
            border-bottom:1px solid var(--color-border-sidebar);
        }

        .sidebar-portal-name {
            font-family:var(--font-heading); font-weight:700; font-size:1rem;
            color:var(--color-secondary); margin-bottom:.2rem;
        }
        .sidebar-portal-badge { font-size:.75rem; color:var(--color-muted); }

        .sidebar-nav { display:flex; flex-direction:column; padding:.5rem .75rem; gap:.25rem; }

        .nav-item {
            display:flex; align-items:center; gap:.75rem;
            padding:.625rem .75rem; border-radius:var(--radius-md);
            text-decoration:none; color:var(--color-text-light);
            font-size:.9rem; font-weight:500;
            border-left:3px solid transparent;
            transition:background .2s, color .2s;
        }
        .nav-item svg {
            width:1.125rem; height:1.125rem; flex-shrink:0;
            stroke:var(--color-text-light); transition:stroke .2s;
        }
        .nav-item:hover { background:var(--color-primary-soft); color:var(--color-primary); }
        .nav-item:hover svg { stroke:var(--color-primary); }
        .nav-item.active {
            background:var(--color-primary-soft); color:var(--color-primary);
            border-left-color:var(--color-primary);
            border-radius:0 var(--radius-md) var(--radius-md) 0;
        }
        .nav-item.active svg { stroke:var(--color-primary); }

        .sidebar-group-label {
            font-size:.68rem; font-weight:700; text-transform:uppercase;
            letter-spacing:.09em; color:var(--color-muted);
            padding:.85rem 1rem .3rem;
        }

        .sidebar-submenu { display:flex; flex-direction:column; padding:0 .75rem; gap:.1rem; }

        .sub-item {
            position:relative; display:flex; align-items:center;
            padding:.5rem .75rem .5rem 2.25rem; border-radius:var(--radius-md);
            text-decoration:none; color:var(--color-text-light);
            font-size:.825rem; font-weight:500;
            transition:background .2s, color .2s;
        }
        .sub-item::before {
            content:''; position:absolute;
            left:1.15rem; top:50%; transform:translateY(-50%);
            width:5px; height:5px; border-radius:50%;
            background:var(--color-text-light); transition:background .2s;
        }
        .sub-item:hover { background:var(--color-primary-soft); color:var(--color-primary); }
        .sub-item:hover::before { background:var(--color-primary); }
        .sub-item.active { background:var(--color-primary-soft); color:var(--color-primary); font-weight:600; }
        .sub-item.active::before { background:var(--color-primary); }

        .sidebar-bottom {
            margin-top:auto; padding:1rem .75rem 1.5rem;
            border-top:1px solid var(--color-border-sidebar);
        }

        .logout-btn {
            display:flex; align-items:center; justify-content:center; gap:.75rem;
            width:100%; padding:.75rem 1rem;
            background:var(--color-danger); color:#fff;
            border:none; border-radius:var(--radius-md);
            font-family:var(--font-body); font-weight:600; font-size:.9rem;
            cursor:pointer; transition:background .2s;
        }
        .logout-btn:hover { background:#b91c1c; }
        .logout-btn svg { width:1.125rem; height:1.125rem; stroke:#fff; }

        /* ═══ LAYOUT ═══ */
        .page-wrapper { display:flex; min-height:100vh; padding-top:var(--header-height); }

        .main-area {
            flex:1; margin-left:var(--sidebar-width);
            padding:1.5rem 2.8rem 4rem 2rem;
            display:flex; flex-direction:column; gap:2rem;
            max-width:calc(100% - var(--sidebar-width));
        }

        /* ═══ PAGE TOP ═══ */
        .page-top { display:flex; flex-direction:column; gap:.3rem; }
        .page-title {
            font-family:var(--font-heading); font-size:1.75rem;
            font-weight:700; color:var(--color-secondary);
        }
        .page-subtitle { font-size:.9375rem; color:var(--color-text); }

        /* ═══ CONTENT GRID ═══ */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 1.5rem;
            align-items: start;
        }

        /* ═══ CARD ═══ */
        .card {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--color-border);
        }
        .card-header h2 {
            font-family: var(--font-heading);
            font-size: 1.0625rem;
            font-weight: 700;
            color: var(--color-secondary);
            margin-bottom: .2rem;
        }
        .card-header p {
            font-size: .85rem;
            color: var(--color-muted);
        }

        .card-body { padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem; }

        /* ═══ FORM ═══ */
        .form-group { display: flex; flex-direction: column; gap: .5rem; }

        .form-label {
            font-size: .875rem;
            font-weight: 600;
            color: var(--color-secondary);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: .875rem;
            display: flex;
            align-items: center;
            pointer-events: none;
        }
        .input-icon svg {
            width: 1rem; height: 1rem;
            stroke: var(--color-muted);
            stroke-width: 1.75;
            fill: none;
        }

        .form-input {
            width: 100%;
            padding: .75rem 2.75rem .75rem 2.75rem;
            border: 1.5px solid var(--color-border);
            border-radius: var(--radius-md);
            font-family: var(--font-body);
            font-size: .9375rem;
            color: var(--color-text);
            background: var(--color-surface);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .form-input::placeholder { color: #adb5c5; }
        .form-input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(0, 63, 135, .1);
        }

        .toggle-password {
            position: absolute;
            right: .875rem;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            color: var(--color-muted);
            transition: color .2s;
        }
        .toggle-password:hover { color: var(--color-primary); }
        .toggle-password svg { width: 1rem; height: 1rem; stroke-width: 1.75; fill: none; }

        /* ═══ STRENGTH BAR ═══ */
        .strength-wrapper {
            display: flex;
            flex-direction: column;
            gap: .4rem;
        }
        .strength-bar-track {
            height: 5px;
            background: var(--color-border);
            border-radius: var(--radius-full);
            overflow: hidden;
        }
        .strength-bar-fill {
            height: 100%;
            border-radius: var(--radius-full);
            width: 45%;
            background: #f59e0b;
            transition: width .4s ease, background .4s ease;
        }
        .strength-label {
            display: flex;
            justify-content: flex-end;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: #f59e0b;
        }

        /* ═══ FORM ACTIONS ═══ */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: .75rem;
            padding-top: .5rem;
        }

        .btn-cancel {
            padding: .7rem 1.4rem;
            border: 1.5px solid var(--color-border);
            border-radius: var(--radius-md);
            background: transparent;
            font-family: var(--font-body);
            font-size: .9375rem;
            font-weight: 600;
            color: var(--color-text);
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }
        .btn-cancel:hover { background: var(--color-bg); border-color: #c5cad6; }

        .btn-save {
            padding: .7rem 1.5rem;
            border: none;
            border-radius: var(--radius-md);
            background: var(--color-primary-btn);
            font-family: var(--font-body);
            font-size: .9375rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            transition: background .2s;
        }
        .btn-save:hover { background: #004f87; }

        /* ═══ TIPS CARD ═══ */
        .tips-card {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .tips-header {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: 1.125rem 1.25rem;
            border-bottom: 1px solid var(--color-border);
        }
        .tips-icon {
            width: 2.25rem; height: 2.25rem;
            background: var(--color-primary-soft);
            border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .tips-icon svg {
            width: 1.1rem; height: 1.1rem;
            stroke: var(--color-primary); stroke-width: 1.75; fill: none;
        }
        .tips-header h3 {
            font-family: var(--font-heading);
            font-size: .9375rem;
            font-weight: 700;
            color: var(--color-secondary);
        }

        .tips-body {
            padding: 1.125rem 1.25rem;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }
        .tips-body p {
            font-size: .825rem;
            color: var(--color-muted);
            margin-bottom: .5rem;
            line-height: 1.6;
        }

        .tip-item {
            display: flex;
            align-items: flex-start;
            gap: .6rem;
            font-size: .825rem;
            color: var(--color-text);
            line-height: 1.5;
        }
        .tip-item-icon {
            width: 1.1rem; height: 1.1rem;
            flex-shrink: 0;
            margin-top: .1rem;
        }
        .tip-item-icon.ok { color: var(--color-success); }
        .tip-item-icon.no { color: var(--color-danger); }
        .tip-item-icon svg { width: 100%; height: 100%; stroke-width: 2; fill: none; stroke: currentColor; }

        /* ═══ RESPONSIVE ═══ */
        @media(max-width:1024px){
            .content-grid { grid-template-columns: 1fr; }
        }
        @media(max-width:768px){
            .sidebar{display:none;}
            .main-area{margin-left:0;padding:1.25rem;max-width:100%;}
        }
    </style>
</head>
<body>
    @include('partials.header-admin', ['showDashboardBtn' => true])



<div class="page-wrapper">

    <!-- ═══ SIDEBAR ═══ -->
    <aside class="sidebar">
        <div class="sidebar-header-block">
            <p class="sidebar-portal-name">Alumni Portal</p>
            <p class="sidebar-portal-badge">Verified Member</p>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('alumni.dashboard') }}" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Manajemen Profil
            </a>
        </nav>

        <div class="sidebar-submenu">
            <a href="{{ route('alumni.pendidikan.index') }}" class="sub-item">
                Riwayat Pendidikan
            </a>
            <a href="{{ route('alumni.pekerjaan.index') }}" class="sub-item">
                Pengalaman Kerja
            </a>
            <a href="{{ route('alumni.sertifikasi.index') }}" class="sub-item">
                Pencapaian &amp; Sertifikasi
            </a>
        </div>

        <nav class="sidebar-nav" style="margin-top:.5rem;">
            <a href="{{ route('alumni.manajemen_akun') }}" class="nav-item active">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Manajemen Akun
            </a>
        </nav>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
            <button type="submit" class="logout-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Log Out
            </button>
            </form>
        </div>
    </aside>

    <!-- ═══ MAIN ═══ -->
    <main class="main-area">

        <div class="page-top">
            <h1 class="page-title">Manajemen Akun</h1>
            <p class="page-subtitle">Kelola pengaturan keamanan dan preferensi akun Alumni Anda.</p>
        </div>

        @if(session('success'))
        <div style="padding:.75rem 1rem;background:#dcfce7;border:1px solid #86efac;border-radius:.75rem;color:#166534;font-size:.9rem;font-weight:500;margin-bottom:1rem;">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="padding:.75rem 1rem;background:#fee2e2;border:1px solid #fca5a5;border-radius:.75rem;color:#991b1b;font-size:.9rem;font-weight:500;margin-bottom:1rem;">
            {{ session('error') }}
        </div>
        @endif

        <div class="content-grid">

            <!-- Ubah Password -->
            <div class="card">
                <div class="card-header">
                    <h2>Ubah Password</h2>
                    <p>Pastikan password Anda kuat dan unik untuk menjaga keamanan akun.</p>
                </div>
                <div class="card-body">
                <form id="passwordForm" action="{{ route('alumni.manajemen_akun.update') }}" method="POST">
                @csrf @method('PUT')

                    <!-- Password Saat Ini -->
                    <div class="form-group">
                        <label class="form-label" for="currentPassword">Password Saat Ini</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke="currentColor" stroke-linecap="round"/>
                                </svg>
                            </span>
                            <input
                                id="currentPassword"
                                type="password"
                                name="current_password"
                                class="form-input {{ $errors->has('current_password') ? 'border-red-400 bg-red-50' : '' }}"
                                placeholder="Masukkan password saat ini"
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword('currentPassword', this)" aria-label="Tampilkan password">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="eye-icon">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z" stroke="currentColor"/>
                                    <circle cx="12" cy="12" r="3" stroke="currentColor"/>
                                </svg>
                            </button>
                        </div>
                        @error('current_password')
                            <p style="font-size:.78rem;color:#dc2626;margin-top:.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Baru -->
                    <div class="form-group">
                        <label class="form-label" for="newPassword">Password Baru</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="9" stroke="currentColor"/>
                                    <path d="M12 8v4l3 3" stroke="currentColor" stroke-linecap="round"/>
                                </svg>
                            </span>
                            <input
                                id="newPassword"
                                type="password"
                                name="password"
                                class="form-input {{ $errors->has('password') ? 'border-red-400 bg-red-50' : '' }}"
                                placeholder="Masukkan password baru"
                                oninput="checkStrength(this.value)"
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword('newPassword', this)" aria-label="Tampilkan password">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="eye-icon">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z" stroke="currentColor"/>
                                    <circle cx="12" cy="12" r="3" stroke="currentColor"/>
                                </svg>
                            </button>
                        </div>
                        <!-- Strength bar -->
                        <div class="strength-wrapper" id="strengthWrapper" style="display:none;">
                            <div class="strength-bar-track">
                                <div class="strength-bar-fill" id="strengthBar"></div>
                            </div>
                            <div class="strength-label" id="strengthLabel">SEDANG</div>
                        </div>
                        @error('password')
                            <p style="font-size:.78rem;color:#dc2626;margin-top:.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label class="form-label" for="confirmPassword">Konfirmasi Password Baru</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke="currentColor" stroke-linecap="round"/>
                                    <path d="M22 4L12 14.01l-3-3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <input
                                id="confirmPassword"
                                type="password"
                                name="password_confirmation"
                                class="form-input {{ $errors->has('password_confirmation') ? 'border-red-400 bg-red-50' : '' }}"
                                placeholder="Ulangi password baru"
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword('confirmPassword', this)" aria-label="Tampilkan password">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="eye-icon">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z" stroke="currentColor"/>
                                    <circle cx="12" cy="12" r="3" stroke="currentColor"/>
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p style="font-size:.78rem;color:#dc2626;margin-top:.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel" onclick="document.getElementById('passwordForm').reset();">Batal</button>
                        <button type="submit" class="btn-save">Simpan Perubahan</button>
                    </div>
                </form>
                </div>
            </div>

            <!-- Tips Keamanan -->
            <div class="tips-card">
                <div class="tips-header">
                    <div class="tips-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3L4 7v5c0 4.418 3.358 8.547 8 9.93C16.642 20.547 20 16.418 20 12V7l-8-4Z"
                                  stroke="currentColor" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3>Tips Keamanan</h3>
                </div>
                <div class="tips-body">
                    <p>Untuk menjaga akun Anda tetap aman, buat password yang kuat dan tidak mudah ditebak.</p>

                    <div class="tip-item">
                        <span class="tip-item-icon ok">
                            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke-linecap="round"/><path d="M22 4L12 14.01l-3-3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        Min. 8 karakter (lebih panjang lebih baik)
                    </div>
                    <div class="tip-item">
                        <span class="tip-item-icon ok">
                            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke-linecap="round"/><path d="M22 4L12 14.01l-3-3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        Gunakan kombinasi huruf besar &amp; kecil
                    </div>
                    <div class="tip-item">
                        <span class="tip-item-icon ok">
                            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke-linecap="round"/><path d="M22 4L12 14.01l-3-3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        Sertakan minimal satu angka (0–9)
                    </div>
                    <div class="tip-item">
                        <span class="tip-item-icon ok">
                            <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke-linecap="round"/><path d="M22 4L12 14.01l-3-3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        Gunakan simbol khusus (!@#$%^&amp;*)
                    </div>
                    <div class="tip-item">
                        <span class="tip-item-icon no">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6" stroke-linecap="round"/></svg>
                        </span>
                        Hindari menggunakan informasi pribadi seperti nama atau tanggal lahir
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        btn.querySelector('svg').style.opacity = isPassword ? '.5' : '1';
    }

    function checkStrength(val) {
        const wrapper = document.getElementById('strengthWrapper');
        const bar     = document.getElementById('strengthBar');
        const label   = document.getElementById('strengthLabel');

        if (!val) { wrapper.style.display = 'none'; return; }
        wrapper.style.display = 'flex';

        let score = 0;
        if (val.length >= 8)            score++;
        if (/[A-Z]/.test(val))          score++;
        if (/[0-9]/.test(val))          score++;
        if (/[^A-Za-z0-9]/.test(val))   score++;

        const levels = [
            { pct: '20%', color: '#ef4444', text: 'LEMAH'   },
            { pct: '45%', color: '#f59e0b', text: 'SEDANG'  },
            { pct: '70%', color: '#3b82f6', text: 'KUAT'    },
            { pct: '100%',color: '#16a34a', text: 'SANGAT KUAT' },
        ];
        const lvl = levels[Math.min(score - 1, 3)] || levels[0];
        bar.style.width     = lvl.pct;
        bar.style.background = lvl.color;
        label.textContent   = lvl.text;
        label.style.color   = lvl.color;
    }
</script>
</body>
</html>