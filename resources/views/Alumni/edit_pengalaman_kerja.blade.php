{{-- resources/views/Alumni/editpengalamankerja.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengalaman Kerja – Alumni Portal</title>

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
        body {
            font-family: var(--font-body);
            background-color: var(--color-bg);
            color: var(--color-secondary);
            line-height: 1.5;
        }

        /* ═══ SIDEBAR ═══ */
        .sidebar {
            position: fixed; top: var(--header-height); left: 0;
            width: var(--sidebar-width); height: calc(100vh - var(--header-height));
            background: #fff; border-right: 1px solid var(--color-border-sidebar);
            z-index: 40; display: flex; flex-direction: column;
            padding-top: 80px; overflow-y: auto;
        }
        .sidebar-header-block {
            position: absolute; top: 0; left: 0; width: 100%;
            padding: 1.5rem 1.25rem 1rem; border-bottom: 1px solid var(--color-border-sidebar);
        }
        .sidebar-portal-name {
            font-family: var(--font-heading); font-weight: 700; font-size: 1rem;
            color: var(--color-secondary); margin-bottom: .2rem;
        }
        .sidebar-portal-badge { font-size: .75rem; color: var(--color-muted); }

        .sidebar-nav { display: flex; flex-direction: column; padding: .5rem .75rem; gap: .25rem; }
        .nav-item {
            display: flex; align-items: center; gap: .75rem;
            padding: .625rem .75rem; border-radius: var(--radius-md);
            text-decoration: none; color: var(--color-text-light);
            font-size: .9rem; font-weight: 500;
            border-left: 3px solid transparent; transition: background .2s, color .2s;
        }
        .nav-item svg {
            width: 1.125rem; height: 1.125rem; flex-shrink: 0;
            stroke: var(--color-text-light); transition: stroke .2s;
        }
        .nav-item:hover, .nav-item.active { background: var(--color-primary-soft); color: var(--color-primary-btn); }
        .nav-item:hover svg, .nav-item.active svg { stroke: var(--color-primary-btn); }
        .nav-item.active { border-left-color: var(--color-primary-btn); border-radius: 0 var(--radius-md) var(--radius-md) 0; }

        .sidebar-group-label {
            font-size: .68rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .09em; color: var(--color-muted); padding: .85rem 1rem .3rem;
        }
        .sidebar-submenu { display: flex; flex-direction: column; padding: 0 .75rem; gap: .1rem; }
        .sub-item {
            position: relative; display: flex; align-items: center;
            padding: .5rem .75rem .5rem 2.25rem; border-radius: var(--radius-md);
            text-decoration: none; color: var(--color-text-light);
            font-size: .825rem; font-weight: 500; transition: background .2s, color .2s;
        }
        .sub-item::before {
            content: ''; position: absolute; left: 1.15rem; top: 50%; transform: translateY(-50%);
            width: 5px; height: 5px; border-radius: 50%; background: var(--color-text-light); transition: background .2s;
        }
        .sub-item:hover, .sub-item.active { background: var(--color-primary-soft); color: var(--color-primary-btn); }
        .sub-item:hover::before, .sub-item.active::before { background: var(--color-primary-btn); }
        .sub-item.active { font-weight: 600; }

        .sidebar-bottom { margin-top: auto; padding: 1rem .75rem 1.5rem; border-top: 1px solid var(--color-border-sidebar); }
        .logout-btn {
            display: flex; align-items: center; justify-content: center; gap: .75rem;
            width: 100%; padding: .75rem 1rem; background: var(--color-danger); color: #fff;
            border: none; border-radius: var(--radius-md); font-weight: 600; font-size: .9rem;
            cursor: pointer; transition: background .2s;
        }
        .logout-btn:hover { background: #b91c1c; }
        .logout-btn svg { width: 1.125rem; height: 1.125rem; stroke: #fff; }

        /* ═══ MAIN CONTENT ═══ */
        .page-wrapper {
            display: flex; min-height: 100vh; padding-top: var(--header-height);
        }
        .main-container {
            width: 100%; min-height: calc(100vh - var(--header-height));
            margin-left: var(--sidebar-width); padding: 1.5rem 2.8rem 4rem 2rem;
        }
        .content-area { max-width: 75rem; display: flex; flex-direction: column; gap: 2rem; }

        .header-section { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .header-left { display: flex; align-items: center; gap: 1.25rem; }
        .back-btn {
            display: flex; align-items: center; justify-content: center;
            width: 2.5rem; height: 2.5rem; border-radius: 50%; background: transparent;
            border: none; cursor: pointer; transition: background .2s; color: var(--color-secondary);
        }
        .back-btn:hover { background: var(--color-badge-bg); }
        .page-title { font-family: var(--font-heading); font-weight: 700; font-size: 1.75rem; color: var(--color-secondary); }
        .page-subtitle { font-size: 1rem; color: var(--color-text); margin-top: .25rem; }

        .add-btn {
            display: inline-flex; align-items: center; gap: .6rem;
            padding: .75rem 1.25rem; background-color: var(--color-primary-btn); color: #fff;
            border: none; border-radius: var(--radius-md); font-weight: 600; font-size: .95rem;
            cursor: pointer; transition: background .2s;
        }
        .add-btn:hover { background-color: #004f87; }
        .add-btn svg { width: 1.25rem; height: 1.25rem; }

        .experience-list { display: flex; flex-direction: column; gap: 1.5rem; }
        .exp-card {
            display: flex; gap: 1.5rem; background: var(--color-card);
            padding: 1.75rem; border: 1px solid var(--color-border);
            border-radius: var(--radius-lg); box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .exp-icon {
            width: 3.5rem; height: 3.5rem; border-radius: var(--radius-md);
            background: var(--color-icon-bg); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .exp-content { flex: 1; display: flex; flex-direction: column; gap: .75rem; }
        
        .exp-header-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; }
        .exp-role { font-family: var(--font-heading); font-weight: 700; font-size: 1.125rem; color: var(--color-secondary); margin-bottom: .25rem; }
        .exp-company { font-weight: 600; color: var(--color-primary); font-size: 1rem; }
        
        .exp-meta { display: flex; align-items: center; flex-wrap: wrap; gap: 1rem; margin-top: .5rem; }
        .meta-item { display: flex; align-items: center; gap: .4rem; font-size: .9rem; color: var(--color-text-light); }
        .meta-item svg { width: 1rem; height: 1rem; stroke: var(--color-muted); }
        .badge {
            background: var(--color-badge-bg); color: var(--color-text);
            padding: .25rem .75rem; border-radius: 999px; font-size: .75rem; font-weight: 600;
        }

        .exp-desc { font-size: .95rem; color: var(--color-text); line-height: 1.6; margin-top: .5rem; }

        .action-group { display: flex; gap: .5rem; }
        .icon-btn {
            width: 2.25rem; height: 2.25rem; border-radius: .5rem; border: none;
            background: transparent; display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: background .2s, color .2s;
        }
        .icon-btn.edit { color: var(--color-muted); }
        .icon-btn.edit:hover { background: var(--color-badge-bg); color: var(--color-secondary); }
        .icon-btn.del { color: var(--color-danger); }
        .icon-btn.del:hover { background: #fee2e2; }
        .icon-btn svg { width: 1.125rem; height: 1.125rem; }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-container { margin-left: 0; padding: 1.5rem; }
            .exp-card { flex-direction: column; gap: 1rem; }
            .exp-header-row { flex-direction: column; }
            .action-group { align-self: flex-start; }
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
            <a href="{{ route('alumni.pendidikan') }}" class="sub-item">
                Riwayat Pendidikan
            </a>
            <a href="{{ route('alumni.pengalaman-kerja') }}" class="sub-item active">
                Pengalaman Kerja
            </a>
            <a href="{{ route('alumni.pencapaian') }}" class="sub-item">
                Pencapaian &amp; Sertifikasi
            </a>
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
                        <h1 class="page-title">Pengalaman Kerja</h1>
                        <p class="page-subtitle">Kelola informasi seputar riwayat karir dan pekerjaan Anda.</p>
                    </div>
                </div>
                
                <button class="add-btn" onclick="openModalExp()">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Tambah Pengalaman
                </button>
            </div>

            <div class="experience-list">
                @if(isset($experiences) && count($experiences) > 0)
                    @foreach($experiences as $experience)
                    <article class="exp-card">
                        <div class="exp-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke="#003f87" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="exp-content">
                            <div class="exp-header-row">
                                <div>
                                    <h2 class="exp-role">{{ $experience['title'] }}</h2>
                                    <p class="exp-company">{{ $experience['company'] }}</p>
                                    
                                    <div class="exp-meta">
                                        <span class="meta-item">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{ $experience['period'] }}
                                        </span>
                                        <span class="badge">{{ $experience['status'] }}</span>
                                    </div>
                                </div>

                                <div class="action-group">
                                    <button type="button" class="icon-btn edit" data-exp="{{ json_encode($experience) }}" onclick="editExperience(this)">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.5 2.50001C18.8978 2.10219 19.4374 1.87869 20 1.87869C20.5626 1.87869 21.1022 2.10219 21.5 2.50001C21.8978 2.89784 22.1213 3.4374 22.1213 4.00001C22.1213 4.56262 21.8978 5.10219 21.5 5.50001L12 15L8 16L9 12L18.5 2.50001Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="icon-btn del" onclick="deleteExperience({{ $experience['id'] }})">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 6H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8 6V4H16V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M19 6L18.2 19.2C18.1 20.4 17.1 21.3 15.9 21.3H8.1C6.9 21.3 5.9 20.4 5.8 19.2L5 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            @if(!empty($experience['description']))
                                <p class="exp-desc">{{ $experience['description'] }}</p>
                            @endif
                        </div>
                    </article>
                    @endforeach
                @else
                    <div style="text-align:center; padding: 3rem;">
                        <p style="color: var(--color-muted);">Belum ada data pengalaman kerja. <a href="#" onclick="openModalExp()" style="color: var(--color-primary-btn);">Tambah pengalaman baru</a></p>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

@include('Alumni.tambah_pekerjaan')

<script>
    function deleteExperience(id) {
        if(confirm('Hapus pengalaman kerja ini?')) { console.log('Deleted id:', id); }
    }
    function handleLogout() {
        if(confirm('Yakin ingin keluar?')) { console.log('Logout executed'); }
    }
</script>
</body>
</html>