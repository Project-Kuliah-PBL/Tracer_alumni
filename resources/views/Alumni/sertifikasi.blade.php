{{-- resources/views/Alumni/sertifikasi.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencapaian & Sertifikasi – Alumni Portal</title>

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
            --color-card:          #ffffff;
            --color-icon-bg:       #e7e8f0;
            --color-badge-bg:      #e7e8f0;
            --color-danger:        #d12924;
            
            --font-heading: 'Plus Jakarta Sans', sans-serif;
            --font-body:    'Inter', sans-serif;

            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            
            --sidebar-width: 256px;
            --header-height: 64px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-body); background-color: var(--color-bg); color: var(--color-secondary); line-height: 1.5; }

        /* ═══ SIDEBAR ═══ */
        .sidebar {
            position: fixed; top: var(--header-height); left: 0; width: var(--sidebar-width); height: calc(100vh - var(--header-height));
            background: #fff; border-right: 1px solid var(--color-border-sidebar); z-index: 40; display: flex; flex-direction: column;
            padding-top: 80px; overflow-y: auto;
        }
        .sidebar-header-block { position: absolute; top: 0; left: 0; width: 100%; padding: 1.5rem 1.25rem 1rem; border-bottom: 1px solid var(--color-border-sidebar); }
        .sidebar-portal-name { font-family: var(--font-heading); font-weight: 700; font-size: 1rem; color: var(--color-secondary); margin-bottom: .2rem; }
        .sidebar-portal-badge { font-size: .75rem; color: var(--color-muted); }

        .sidebar-nav { display: flex; flex-direction: column; padding: .5rem .75rem; gap: .25rem; }
        .nav-item {
            display: flex; align-items: center; gap: .75rem; padding: .625rem .75rem; border-radius: var(--radius-md);
            text-decoration: none; color: var(--color-text-light); font-size: .9rem; font-weight: 500;
            border-left: 3px solid transparent; transition: background .2s, color .2s;
        }
        .nav-item svg { width: 1.125rem; height: 1.125rem; flex-shrink: 0; stroke: var(--color-text-light); transition: stroke .2s; }
        .nav-item:hover, .nav-item.active { background: var(--color-primary-soft); color: var(--color-primary-btn); }
        .nav-item:hover svg, .nav-item.active svg { stroke: var(--color-primary-btn); }
        .nav-item.active { border-left-color: var(--color-primary-btn); border-radius: 0 var(--radius-md) var(--radius-md) 0; }

        .sidebar-group-label { font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .09em; color: var(--color-muted); padding: .85rem 1rem .3rem; }
        .sidebar-submenu { display: flex; flex-direction: column; padding: 0 .75rem; gap: .1rem; }
        .sub-item {
            position: relative; display: flex; align-items: center; padding: .5rem .75rem .5rem 2.25rem; border-radius: var(--radius-md);
            text-decoration: none; color: var(--color-text-light); font-size: .825rem; font-weight: 500; transition: background .2s, color .2s;
        }
        .sub-item::before {
            content: ''; position: absolute; left: 1.15rem; top: 50%; transform: translateY(-50%); width: 5px; height: 5px; border-radius: 50%;
            background: var(--color-text-light); transition: background .2s;
        }
        .sub-item:hover, .sub-item.active { background: var(--color-primary-soft); color: var(--color-primary-btn); }
        .sub-item:hover::before, .sub-item.active::before { background: var(--color-primary-btn); }
        .sub-item.active { font-weight: 600; }

        .sidebar-bottom { margin-top: auto; padding: 1rem .75rem 1.5rem; border-top: 1px solid var(--color-border-sidebar); }
        .logout-btn {
            display: flex; align-items: center; justify-content: center; gap: .75rem; width: 100%; padding: .75rem 1rem;
            background: var(--color-danger); color: #fff; border: none; border-radius: var(--radius-md); font-weight: 600; font-size: .9rem;
            cursor: pointer; transition: background .2s;
        }
        .logout-btn:hover { background: #b91c1c; }
        .logout-btn svg { width: 1.125rem; height: 1.125rem; stroke: #fff; }

        /* ═══ MAIN CONTENT ═══ */
        .page-wrapper { display: flex; min-height: 100vh; padding-top: var(--header-height); }
        .main-container { width: 100%; min-height: calc(100vh - var(--header-height)); margin-left: var(--sidebar-width); padding: 1.5rem 2.8rem 4rem 2rem; }
        .content-area { max-width: 75rem; display: flex; flex-direction: column; gap: 2rem; }

        .header-section { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .header-left { display: flex; align-items: center; gap: 1.25rem; }
        .back-btn {
            display: flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; border-radius: 50%;
            background: transparent; border: none; cursor: pointer; transition: background .2s; color: var(--color-secondary);
        }
        .back-btn:hover { background: var(--color-badge-bg); }
        .page-title { font-family: var(--font-heading); font-weight: 700; font-size: 1.75rem; color: var(--color-secondary); }
        .page-subtitle { font-size: 1rem; color: var(--color-text); margin-top: .25rem; }

        .add-btn {
            display: inline-flex; align-items: center; gap: .6rem; padding: .75rem 1.25rem; background-color: var(--color-primary-btn); color: #fff;
            border: none; border-radius: var(--radius-md); font-weight: 600; font-size: .95rem; cursor: pointer; transition: background .2s;
        }
        .add-btn:hover { background-color: #004f87; }
        .add-btn svg { width: 1.25rem; height: 1.25rem; }

        .cert-list { display: flex; flex-direction: column; gap: 1.5rem; }
        .cert-card {
            display: flex; gap: 1.5rem; background: var(--color-card); padding: 1.75rem; border: 1px solid var(--color-border);
            border-radius: var(--radius-lg); box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .cert-icon {
            width: 3.5rem; height: 3.5rem; border-radius: var(--radius-md); background: var(--color-icon-bg);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--color-primary-btn);
        }
        .cert-icon svg { width: 24px; height: 24px; }
        .cert-body { flex: 1; display: flex; flex-direction: column; gap: .5rem; }
        .cert-title { font-family: var(--font-heading); font-weight: 700; font-size: 1.125rem; color: var(--color-secondary); }
        .cert-issuer { font-weight: 600; color: var(--color-primary); font-size: 1rem; }
        
        .cert-meta { display: flex; align-items: center; flex-wrap: wrap; gap: 0.75rem; margin-top: .25rem; }
        .meta-item { display: flex; align-items: center; gap: .4rem; font-size: .9rem; color: var(--color-text-light); }
        .meta-item svg { width: 1rem; height: 1rem; stroke: var(--color-muted); }
        .meta-sep { color: var(--color-border); }

        .cert-actions { display: flex; gap: .5rem; align-items: flex-start; }
        .icon-btn {
            width: 2.25rem; height: 2.25rem; border-radius: .5rem; border: none; background: transparent;
            display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background .2s, color .2s;
        }
        .icon-btn.edit { color: var(--color-muted); }
        .icon-btn.edit:hover { background: var(--color-badge-bg); color: var(--color-secondary); }
        .icon-btn.del { color: var(--color-danger); }
        .icon-btn.del:hover { background: #fee2e2; }
        .icon-btn svg { width: 1.125rem; height: 1.125rem; }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-container { margin-left: 0; padding: 1.5rem; }
            .cert-card { flex-direction: column; gap: 1rem; }
            .cert-actions { align-self: flex-start; }
        }
    </style>
</head>
<body>

@include('partials.header-admin', ['showDashboardBtn' => true])

<div class="page-wrapper">

    <aside class="sidebar">
        <div class="sidebar-header-block">
            <p class="sidebar-portal-name">Alumni Portal</p>
            <p class="sidebar-portal-badge">Verified Member</p>
        </div>

        <nav class="sidebar-nav">
            <a href="#" class="nav-item">
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
            <a href="{{ route('alumni.pendidikan') }}" class="sub-item">Riwayat Pendidikan</a>
            <a href="{{ route('alumni.pengalaman-kerja') }}" class="sub-item">Pengalaman Kerja</a>
            <a href="{{ route('alumni.pencapaian') }}" class="sub-item active">Pencapaian &amp; Sertifikasi</a>
        </div>

        <nav class="sidebar-nav" style="margin-top: .5rem;">
            <a href="{{ route('alumni.manajemen_akun') }}" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Manajemen Akun
            </a>
        </nav>

        <div class="sidebar-bottom">
            <button class="logout-btn" onclick="handleLogout()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Log Out
            </button>
        </div>
    </aside>

    <main class="main-container">
        <div class="content-area">

            <div class="header-section">
                <div class="header-left">
                    <button class="back-btn" onclick="history.back()">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div>
                        <h1 class="page-title">Pencapaian & Sertifikasi</h1>
                        <p class="page-subtitle">Kelola daftar sertifikat, lisensi, atau penghargaan Anda.</p>
                    </div>
                </div>
                
                <button class="add-btn" onclick="openModalCert()">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Tambah Sertifikasi
                </button>
            </div>

            <div class="cert-list">
                <?php if (!empty($certifications)) : ?>
                    <?php foreach ($certifications as $index => $certification) : ?>
                        <article class="cert-card">
                            <span class="cert-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                                    <path d="M12 4.5L6 8v3.5c0 2.5 2.5 4.5 6 4.5s6-2 6-4.5V8l-6-3.5Z" stroke="currentColor" stroke-linejoin="round" stroke-width="2"/>
                                    <path d="M6 14.5V15.5C6 17.709 8.239 19.5 11 19.5s5-1.791 5-4V14.5" stroke="currentColor" stroke-linecap="round" stroke-width="2"/>
                                </svg>
                            </span>

                            <div class="cert-body">
                                <h2 class="cert-title"><?= htmlspecialchars($certification['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></h2>
                                <p class="cert-issuer"><?= htmlspecialchars($certification['provider'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                                <div class="cert-meta">
                                    <span class="meta-item">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                                            <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/>
                                            <path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-linecap="round" stroke-width="2"/>
                                        </svg>
                                        Diterbitkan <?= htmlspecialchars($certification['issue_date'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                    
                                    <?php if (!empty($certification['credential_id'])) : ?>
                                        <span class="meta-sep" aria-hidden="true">&bull;</span>
                                        <span class="meta-item">
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
                                                <path d="M9.5 12.5l1.5 1.5 3.5-3.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                            </svg>
                                            ID: <?= htmlspecialchars($certification['credential_id'], ENT_QUOTES, 'UTF-8') ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="cert-actions">
                                <button type="button" class="icon-btn edit" aria-label="Ubah sertifikat" data-cert="{{ json_encode($certification) }}" onclick="editCert(this)">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                                        <path d="M4 20h16" stroke="currentColor" stroke-linecap="round" stroke-width="2"/>
                                        <path d="M16.5 3.5L20.5 7.5L9 19H5V15L16.5 3.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                    </svg>
                                </button>
                                <button type="button" class="icon-btn del" aria-label="Hapus sertifikat" onclick="deleteCert({{ $certification['id'] }})">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                                        <path d="M3 6h18" stroke="currentColor" stroke-linecap="round" stroke-width="2"/>
                                        <path d="M8 6V4h8v2" stroke="currentColor" stroke-linecap="round" stroke-width="2"/>
                                        <path d="M19 6L18.2 19.2C18.1 20.4 17.1 21.3 15.9 21.3H8.1C6.9 21.3 5.9 20.4 5.8 19.2L5 6" stroke="currentColor" stroke-linecap="round" stroke-width="2"/>
                                        <path d="M10 11V17M14 11V17" stroke="currentColor" stroke-linecap="round" stroke-width="2"/>
                                    </svg>
                                </button>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div style="text-align:center; padding: 3rem;">
                        <p style="color: var(--color-muted);">Belum ada sertifikasi atau pencapaian. <a href="#" onclick="openModalCert()" style="color: var(--color-primary-btn);">Tambah sertifikat baru</a></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

@include('Alumni.tambah_pencapaian')

<script>
    function deleteCert(id) {
        if(confirm('Hapus sertifikat ini?')) { console.log('Deleted id:', id); }
    }
    function handleLogout() {
        if(confirm('Yakin ingin keluar?')) { console.log('Logout executed'); }
    }
</script>
</body>
</html>