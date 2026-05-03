<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Riwayat Pendidikan</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      /* Warna Utama */
      --color-primary:       #0061a4;
      --color-primary-soft:  #eff6ff;
      --color-primary-dark:  #1d4ed8;
      --color-primary-light: #003f87;
      
      /* Warna Netral & Teks */
      --color-secondary:     #191c21;
      --color-bg-page:       #f1f4f6;
      --color-bg-white:      #ffffff;
      --color-bg-card:       #ffffff;
      --color-bg-icon:       #e7e8f0;
      --color-bg-badge:      #e7e8f0;
      --color-border-card:   #e1e2ea;
      --color-border-sidebar:#E2E8F0;
      --color-text-secondary:#191c21;
      --color-text-muted:    #64748b;
      --color-text-gray:     #424752;
      --color-text-light:    #727784;
      --color-text-medium:   #43474a;
      
      /* Status Colors */
      --color-error:         #d12924;
      --color-danger:        #d12924;

      /* Typography */
      --font-heading: 'Plus Jakarta Sans', sans-serif;
      --font-body: 'Inter', sans-serif;
      
      /* Spacing */
      --spacing-xs: 0.5rem;
      --spacing-sm: 1rem;
      --spacing-md: 1.5rem;
      --spacing-lg: 2rem;
      --spacing-xl: 2.5rem;
      --spacing-2xl: 3.2rem;
      
      /* Radius & Shadows */
      --radius-sm: 0.5rem;
      --radius-md: 0.75rem;
      --radius-lg: 1rem;
      --radius-full: 9999px;
      --shadow-sm: 0px 1px 1px rgba(0,0,0,0.05);
      --shadow-md: 0px 4px 6px rgba(0,0,0,0.05);
      
      /* Layout Dimensions */
      --sidebar-width: 256px;
      --header-height: 64px;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
    html { font-size: 16px; }
    body {
      font-family: var(--font-body);
      background-color: var(--color-bg-page);
      color: var(--color-text-secondary);
      line-height: 1.5;
    }

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
    .sidebar-portal-badge { font-size:.75rem; color:var(--color-text-muted); }

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
    .nav-item:hover, .nav-item.active {
        background:var(--color-primary-soft); color:var(--color-primary);
    }
    .nav-item:hover svg, .nav-item.active svg { stroke:var(--color-primary); }
    .nav-item.active {
        border-left-color:var(--color-primary);
        border-radius:0 var(--radius-md) var(--radius-md) 0;
    }

    .sidebar-group-label {
        font-size:.68rem; font-weight:700; text-transform:uppercase;
        letter-spacing:.09em; color:var(--color-text-muted);
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

    /* ═══ LAYOUT & MAIN CONTENT ═══ */
    .page-wrapper {
      display: flex;
      min-height: 100vh;
      padding-top: var(--header-height);
    }

    .edit-riwayat-pendidikan {
      display: flex;
      width: 100%;
      min-height: calc(100vh - var(--header-height));
      padding: 1.5rem 2.8rem 4rem 2rem;
      margin-left: var(--sidebar-width);
    }

    .main-content {
      display: flex;
      flex-direction: column;
      gap: var(--spacing-lg);
      width: 100%;
      max-width: 75rem;
    }

    .page-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
    }

    .header-left {
      display: flex;
      gap: var(--spacing-md);
      align-items: center;
    }

    .back-button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.5rem;
      border-radius: var(--radius-full);
      border: none;
      background-color: transparent;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .back-button:hover { background-color: var(--color-bg-badge); }

    .header-title {
      font-family: var(--font-heading);
      font-weight: 700;
      font-size: 1.75rem;
      color: var(--color-text-secondary);
    }

    .header-subtitle {
      font-size: 1rem;
      color: #424752;
      margin-top: 0.25rem;
    }

    .add-education-button {
      display: inline-flex;
      gap: 0.5rem;
      align-items: center;
      padding: 0.75rem var(--spacing-md);
      background-color: var(--color-primary);
      color: #fff;
      border: none;
      border-radius: var(--radius-md);
      font-family: var(--font-body);
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .add-education-button:hover { background-color: #004f87; }

    .education-list {
      display: grid;
      gap: var(--spacing-md);
      width: 100%;
    }

    .education-card {
      display: flex;
      gap: var(--spacing-md);
      align-items: flex-start;
      padding: var(--spacing-xl);
      background-color: var(--color-bg-card);
      border: 1px solid var(--color-border-card);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-md);
      transition: box-shadow 0.2s ease;
    }

    .education-card:hover { box-shadow: 0px 6px 12px rgba(0,0,0,0.08); }

    .education-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 4rem;
      height: 4rem;
      background-color: var(--color-bg-icon);
      border-radius: var(--radius-md);
      flex-shrink: 0;
    }

    .education-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: var(--spacing-md);
    }

    .education-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

    .education-degree {
      font-family: var(--font-heading);
      font-weight: 600;
      font-size: 1.125rem;
      color: var(--color-text-secondary);
      margin-bottom: 0.25rem;
    }

    .education-institution {
      font-size: 1rem;
      color: var(--color-primary-light);
      margin-bottom: 0.5rem;
    }

    .education-thesis-label {
      font-size: 1rem;
      color: var(--color-text-medium);
    }

    .education-period {
      display: flex;
      gap: 0.5rem;
      align-items: center;
      margin-top: 0.25rem;
    }

    .education-period-text {
      font-size: 1rem;
      color: var(--color-text-light);
    }

    .education-actions { display: flex; gap: 0.5rem; }

    .action-button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.5rem;
      background-color: transparent;
      border: none;
      border-radius: var(--radius-md);
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .action-button:hover { background-color: var(--color-bg-badge); }
    .action-button.delete:hover { background-color: rgba(209,41,36,0.1); }

    .education-ipk {
      display: inline-flex;
      align-items: center;
      padding: 0.25rem 0.75rem;
      background-color: var(--color-bg-badge);
      border-radius: var(--radius-full);
      align-self: flex-start;
    }

    .education-ipk-text {
      font-weight: 500;
      font-size: 0.75rem;
      color: var(--color-text-gray);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
      .sidebar { display: none; }
      .edit-riwayat-pendidikan { margin-left: 0; padding: 1.25rem; }
      .page-header { flex-direction: column; align-items: flex-start; gap: var(--spacing-md); }
      .add-education-button { width: 100%; justify-content: center; }
      .education-card { flex-direction: column; }
      .education-header { flex-direction: column; gap: var(--spacing-md); }
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
            <a href="{{ route('alumni.pendidikan') }}" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Manajemen Profil
            </a>
        </nav>

        <p class="sidebar-group-label">Profil Saya</p>
        <div class="sidebar-submenu">
            <a href="{{ route('alumni.pendidikan') }}" class="sub-item active">
                Riwayat Pendidikan
            </a>
            <a href="{{ route('alumni.pengalaman-kerja') }}" class="sub-item">
                Pengalaman Kerja
            </a>
            <a href="{{ route('alumni.pencapaian') }}" class="sub-item">
                Pencapaian &amp; Sertifikasi
            </a>
        </div>

        <nav class="sidebar-nav" style="margin-top:.5rem;">
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

    <div class="edit-riwayat-pendidikan">
      <main class="main-content">

        <header class="page-header">
          <div class="header-left">
            <button class="back-button" type="button" aria-label="Go back" onclick="history.back()">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
              </svg>
            </button>
            <div>
              <h1 class="header-title">Riwayat Pendidikan</h1>
              <p class="header-subtitle">Kelola latar belakang akademik dan pencapaian pendidikan Anda.</p>
            </div>
          </div>
          
          <button class="add-education-button" type="button" onclick="openModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            <span>Tambah Pendidikan</span>
          </button>
        </header>

        <section class="education-list" aria-label="Education records">
          @forelse($educations as $education)
            <article class="education-card">
              <div class="education-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#0061a4" stroke-width="2">
                  <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                  <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
              </div>
              <div class="education-content">
                <div class="education-header">
                  <div>
                    <h2 class="education-degree">{{ $education['degree'] ?? 'Degree Title' }}</h2>
                    <p class="education-institution">{{ $education['institution'] ?? 'Institution Name' }}</p>
                    <p class="education-thesis-label">{{ $education['thesis_label'] ?? 'Judul Skripsi :' }}</p>
                    <div class="education-period">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 24 24" fill="none" stroke="#727784" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                      </svg>
                      <span class="education-period-text">
                        {{ $education['start_year'] ?? '2020' }} - {{ $education['end_year'] ?? '2022' }}
                      </span>
                    </div>
                  </div>
                  <div class="education-actions">
                    <button class="action-button edit" type="button" aria-label="Edit" data-edu="{{ json_encode($education) }}" onclick="editEducation(this)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                      </svg>
                    </button>
                    <button class="action-button delete" type="button" aria-label="Delete" onclick="deleteEducation({{ $education['id'] ?? 0 }})">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d12924" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                        <path d="M10 11v6M14 11v6"/>
                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="education-ipk">
                  <span class="education-ipk-text">IPK: {{ $education['ipk'] ?? '0.00' }}/4.00</span>
                </div>
              </div>
            </article>
          @empty
            <div style="text-align:center; padding: var(--spacing-2xl);">
              <p style="color: var(--color-text-muted);">
                Belum ada data pendidikan. <a href="#" style="color: var(--color-primary);">Tambah pendidikan baru</a>
              </p>
            </div>
          @endempty
        </section>

      </main>
    </div>

</div>

@include('Alumni.tambah_riwayat_pendidikan')

<script>
  // Fungsi editEducation sudah dihapus dari sini karena sekarang ada di dalam file 'tambahriwayatpendidikan.blade.php'
  
  function deleteEducation(id) {
    if (confirm('Hapus data pendidikan ini?')) { 
      console.log('Delete:', id); 
      // Contoh jika ingin disambung ke backend:
      // window.location.href = '/pendidikan/hapus/' + id;
    }
  }

  function handleLogout() {
    if (confirm('Yakin ingin keluar?')) { 
        console.log('Logout'); 
        // window.location.href = '{{ route("logout") }}'; 
    }
  }
</script>
</body>
</html>