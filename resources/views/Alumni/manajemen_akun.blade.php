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
            position: fixed;
            top: var(--header-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            background: #fff;
            border-right: 1px solid var(--color-border-sidebar);
            z-index: 40;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 0.75rem 1rem;
            overflow-y: auto;
        }

        .sidebar-nav {
            display:flex;
            flex-direction:column;
            gap:.5rem;
            padding:0;
            margin:0;
            list-style:none;
        }

        .sidebar-nav-item {
            display:flex;
            align-items:center;
            gap:.75rem;
            padding:.75rem 1rem;
            border-radius:var(--radius-md);
            text-decoration:none;
            color:var(--color-text-light);
            font-size:.9rem;
            font-weight:600;
            transition:background .2s, color .2s;
        }

        .sidebar-nav-item:hover {
            background:var(--color-primary-soft);
            color:var(--color-primary);
        }

        .sidebar-nav-item svg {
            width:1.1rem;
            height:1.1rem;
            flex-shrink:0;
            stroke:currentColor;
        }

        .sidebar-nav-item[style*="border-r-4"] {
            border-right-color: var(--color-primary) !important;
        }

        .sidebar-group-label {
            font-size:.68rem; font-weight:700; text-transform:uppercase;
            letter-spacing:.09em; color:var(--color-muted);
            padding:.85rem 1rem .3rem;
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
            position: relative;
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 1.25rem 2rem 4rem 1.5rem;
            display: flex; flex-direction: column; gap: 1rem;
        }

        /* ═══ PAGE TOP ═══ */
        .page-top { display:flex; flex-direction:column; gap:.4rem; margin-bottom:1rem; }
        .page-title {
            font-family:var(--font-heading);
            font-size:2.25rem;
            font-weight:800;
            color:var(--color-secondary);
            letter-spacing:-.02em;
            line-height:1.05;
        }
        .page-subtitle {
            font-size:1rem;
            color:var(--color-text);
            max-width: 720px;
        }

        /* ═══ CONTENT GRID ═══ */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 1.25rem;
            align-items: start;
        }

        /* ═══ CARD ═══ */
        .card {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem 1rem;
            border-bottom: 1px solid var(--color-border);
        }
        .card-header h2 {
            font-family: var(--font-heading);
            font-size: 1rem;
            font-weight: 700;
            color: var(--color-secondary);
            margin-bottom: .2rem;
        }
        .card-header p {
            font-size: .8125rem;
            color: var(--color-muted);
        }

        .card-body { padding: 1.5rem; display: flex; flex-direction: column; gap: 1.125rem; }

        /* ═══ FORM ═══ */
        .form-group { display: flex; flex-direction: column; gap: .4rem; }

        .form-label {
            font-size: .8125rem;
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
            stroke: #b0b8c9;
            stroke-width: 1.75;
            fill: none;
        }

        .form-input {
            width: 100%;
            padding: .7rem 2.75rem .7rem 2.75rem;
            border: 1.5px solid var(--color-border);
            border-radius: var(--radius-sm);
            font-family: var(--font-body);
            font-size: .9rem;
            color: var(--color-text);
            background: var(--color-surface);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .form-input::placeholder { color: #b8bfcc; font-size: .875rem; }
        .form-input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(0, 63, 135, .08);
        }

        .form-input.is-error {
            border-color: var(--color-danger);
            box-shadow: 0 0 0 3px rgba(209, 41, 36, .1);
        }
        .form-input.is-error:focus {
            border-color: var(--color-danger);
            box-shadow: 0 0 0 3px rgba(209, 41, 36, .15);
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
            color: #b0b8c9;
            transition: color .2s;
        }
        .toggle-password:hover { color: var(--color-primary); }
        .toggle-password svg { width: 1rem; height: 1rem; stroke-width: 1.75; fill: none; stroke: currentColor; }

        /* ═══ STRENGTH BAR — inline below the password field ═══ */
        .strength-wrapper {
            display: none;
            align-items: center;
            gap: .5rem;
            margin-top: .3rem;
        }
        .strength-bar-track {
            flex: 1;
            height: 4px;
            background: var(--color-border);
            border-radius: var(--radius-full);
            overflow: hidden;
        }
        .strength-bar-fill {
            height: 100%;
            border-radius: var(--radius-full);
            width: 0%;
            background: #f59e0b;
            transition: width .4s ease, background .4s ease;
        }
        .strength-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: #f59e0b;
            white-space: nowrap;
            min-width: 72px;
            text-align: right;
        }

        /* ═══ FORM ACTIONS ═══ */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: .75rem;
            padding-top: .75rem;
            border-top: 1px solid var(--color-border);
            margin-top: .25rem;
        }

        .btn-cancel {
            padding: .625rem 1.25rem;
            border: 1.5px solid var(--color-border);
            border-radius: var(--radius-sm);
            background: transparent;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 600;
            color: var(--color-text);
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }
        .btn-cancel:hover { background: var(--color-bg); border-color: #c5cad6; }

        .btn-save {
            padding: .625rem 1.375rem;
            border: none;
            border-radius: var(--radius-sm);
            background: var(--color-primary-btn);
            font-family: var(--font-body);
            font-size: .875rem;
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
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .tips-header {
            display: flex;
            align-items: center;
            gap: .625rem;
            padding: 1rem 1.125rem;
            border-bottom: 1px solid var(--color-border);
            background: var(--color-primary-soft);
        }
        .tips-icon {
            width: 2rem; height: 2rem;
            background: var(--color-primary);
            border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .tips-icon svg {
            width: 1rem; height: 1rem;
            stroke: #fff; stroke-width: 1.75; fill: none;
        }
        .tips-header h3 {
            font-family: var(--font-heading);
            font-size: .9375rem;
            font-weight: 700;
            color: var(--color-primary);
        }

        .tips-body {
            padding: 1rem 1.125rem;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        /* Highlighted intro paragraph */
        .tips-intro {
            font-size: .8125rem;
            color: var(--color-primary);
            background: #dbeafe;
            border-left: 3px solid var(--color-primary);
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            padding: .6rem .75rem;
            line-height: 1.55;
            margin-bottom: .25rem;
        }

        .tip-item {
            display: flex;
            align-items: flex-start;
            gap: .55rem;
            font-size: .8rem;
            color: var(--color-text);
            line-height: 1.5;
            padding: .15rem 0;
        }
        .tip-item-icon {
            width: 1rem; height: 1rem;
            flex-shrink: 0;
            margin-top: .15rem;
        }
        /* All check icons blue to match reference */
        .tip-item-icon.ok { color: var(--color-primary-btn); }
        .tip-item-icon.no { color: var(--color-muted); }
        .tip-item-icon svg { width: 100%; height: 100%; stroke-width: 2.5; fill: none; stroke: currentColor; }

        /* ═══ RESPONSIVE ═══ */
        @media(max-width:1024px){
            .content-grid { grid-template-columns: 1fr; }
        }
        @media(max-width:768px){
            .sidebar{display:none;}
            .main-area{margin-left:0;width:100%;padding:1.25rem;}
        }
    </style>
</head>
<body>
    @include('partials.header-admin')
    @include('partials.sidebar-alumni', ['activeMenu' => 'akun'])

    <!-- ═══ MAIN ═══ -->
    <main class="main-area">

        <!-- Success Alert -->
        @if (session('success'))
            <div id="successAlert" style="padding: 1rem 1.125rem; background: #f0fdf4; border: 1px solid #86efac; border-radius: 0.75rem; display: flex; align-items: flex-start; gap: 0.75rem;">
                <svg style="width: 1.25rem; height: 1.25rem; color: #16a34a; flex-shrink: 0; margin-top: 0.125rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <path d="M22 4L12 14.01l-3-3"/>
                </svg>
                <div>
                    <div style="font-weight: 600; color: #166534; font-size: 0.9375rem;">Sukses</div>
                    <div style="font-size: 0.875rem; color: #15803d; margin-top: 0.25rem;">{{ session('success') }}</div>
                </div>
                <button onclick="document.getElementById('successAlert').remove()" style="position: absolute; right: 1.5rem; background: none; border: none; color: #16a34a; cursor: pointer; padding: 0; font-size: 1.25rem; line-height: 1;">
                    ×
                </button>
            </div>
        @endif

        <div class="page-top">
            <h1 class="page-title">Manajemen Akun</h1>
            <p class="page-subtitle">Kelola pengaturan keamanan dan preferensi akun Alumni Anda.</p>
        </div>

        <div class="content-grid">

            <!-- Ubah Password -->
            <div class="card">
                <div class="card-header">
                    <h2>Ubah Password</h2>
                    <p>Pastikan password Anda kuat dan unik untuk menjaga keamanan akun.</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('alumni.manajemen_akun.update') }}" method="POST" id="passwordForm">
                        @csrf
                        @method('PUT')

                        <!-- Error Alert -->
                        @if ($errors->any())
                            <div style="padding: 0.875rem 1rem; background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.75rem; margin-bottom: 1rem;">
                                <div style="font-weight: 600; color: #991b1b; font-size: 0.875rem; margin-bottom: 0.5rem;">
                                    <svg style="display: inline; width: 1rem; height: 1rem; stroke: currentColor; margin-right: 0.5rem; vertical-align: middle;" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke-width="2" fill="none"/>
                                        <path d="M12 7v5M12 16h.01" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    Terjadi kesalahan
                                </div>
                                <ul style="margin: 0; padding-left: 1.5rem; font-size: 0.8125rem; color: #7f1d1d;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Password Saat Ini -->
                        <div class="form-group">
                            <label class="form-label" for="current_password">Password Saat Ini</label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor"/>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke="currentColor" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <input
                                    id="current_password"
                                    name="current_password"
                                    type="password"
                                    class="form-input @error('current_password') is-error @enderror"
                                    placeholder="Masukkan password saat ini"
                                    required
                                >
                                <button type="button" class="toggle-password" onclick="togglePassword('current_password', this)" aria-label="Tampilkan password">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="eye-icon">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z" stroke="currentColor"/>
                                        <circle cx="12" cy="12" r="3" stroke="currentColor"/>
                                    </svg>
                                </button>
                            </div>
                            @error('current_password')
                                <span style="font-size: 0.8125rem; color: #dc2626; margin-top: -0.25rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Baru -->
                        <div class="form-group">
                            <label class="form-label" for="password">Password Baru</label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="9" stroke="currentColor"/>
                                        <path d="M12 8v4l3 3" stroke="currentColor" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="form-input @error('password') is-error @enderror"
                                    placeholder="Masukkan password baru"
                                    oninput="checkStrength(this.value)"
                                    required
                                >
                                <button type="button" class="toggle-password" onclick="togglePassword('password', this)" aria-label="Tampilkan password">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="eye-icon">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z" stroke="currentColor"/>
                                        <circle cx="12" cy="12" r="3" stroke="currentColor"/>
                                    </svg>
                                </button>
                            </div>
                            <!-- Strength bar — inline row -->
                            <div class="strength-wrapper" id="strengthWrapper">
                                <div class="strength-bar-track">
                                    <div class="strength-bar-fill" id="strengthBar"></div>
                                </div>
                                <div class="strength-label" id="strengthLabel">SEDANG</div>
                            </div>
                            @error('password')
                                <span style="font-size: 0.8125rem; color: #dc2626; margin-top: -0.25rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke="currentColor" stroke-linecap="round"/>
                                        <path d="M22 4L12 14.01l-3-3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    class="form-input @error('password_confirmation') is-error @enderror"
                                    placeholder="Ulangi password baru"
                                    required
                                >
                                <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan password">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="eye-icon">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z" stroke="currentColor"/>
                                        <circle cx="12" cy="12" r="3" stroke="currentColor"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <span style="font-size: 0.8125rem; color: #dc2626; margin-top: -0.25rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="reset" class="btn-cancel">Batal</button>
                            <button type="submit" class="btn-save">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tips Keamanan -->
            <div class="tips-card">
                <div class="tips-header">
                    <div class="tips-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
  <path d="M8 20C5.68333 19.4167 3.77083 18.0875 2.2625 16.0125C0.754167 13.9375 0 11.6333 0 9.1V3L8 0L16 3V9.1C16 9.26667 15.9958 9.43333 15.9875 9.6C15.9792 9.76667 15.9667 9.93333 15.95 10.1C15.8 10.0667 15.6458 10.0417 15.4875 10.025C15.3292 10.0083 15.1667 10 15 10C13.6167 10 12.4375 10.4833 11.4625 11.45C10.4875 12.4167 10 13.6 10 15V19.25C9.68333 19.4167 9.35833 19.5625 9.025 19.6875C8.69167 19.8125 8.35 19.9167 8 20ZM12.85 20C12.6167 20 12.4167 19.9167 12.25 19.75C12.0833 19.5833 12 19.3833 12 19.15V15.85C12 15.6167 12.0833 15.4167 12.25 15.25C12.4167 15.0833 12.6167 15 12.85 15H13V14C13 13.45 13.1958 12.9792 13.5875 12.5875C13.9792 12.1958 14.45 12 15 12C15.55 12 16.0208 12.1958 16.4125 12.5875C16.8042 12.9792 17 13.45 17 14V15H17.15C17.3833 15 17.5833 15.0833 17.75 15.25C17.9167 15.4167 18 15.6167 18 15.85V19.15C18 19.3833 17.9167 19.5833 17.75 19.75C17.5833 19.9167 17.3833 20 17.15 20H12.85ZM14 15H16V14C16 13.7167 15.9042 13.4792 15.7125 13.2875C15.5208 13.0958 15.2833 13 15 13C14.7167 13 14.4792 13.0958 14.2875 13.2875C14.0958 13.4792 14 13.7167 14 14V15Z" fill="#D1E3FF"/>
</svg>
                    </div>
                    <h3>Tips Keamanan</h3>
                </div>
                <div class="tips-body">
                    <p class="tips-intro">Untuk menjaga akun Anda tetap aman, buat password yang kuat dan tidak mudah ditebak.</p>

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

    function handleLogout() {
        if (confirm('Yakin ingin keluar?')) {
            window.location.href = '{{ route("logout") }}';
        }
    }
</script>
</body>
</html>