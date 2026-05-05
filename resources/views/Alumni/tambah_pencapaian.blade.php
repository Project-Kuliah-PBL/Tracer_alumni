{{-- resources/views/Alumni/tambah_pencapaian.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sertifikasi – Alumni Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-primary: #003f87; --color-primary-soft: #eff6ff; --color-primary-btn: #0061a4;
            --color-secondary: #191c21; --color-muted: #64748b; --color-text: #424752;
            --color-text-light: #727784; --color-border: #e1e2ea; --color-border-sidebar: #E2E8F0;
            --color-bg: #f1f4f6; --color-card: #ffffff; --color-danger: #d12924;
            --font-heading: 'Plus Jakarta Sans', sans-serif; --font-body: 'Inter', sans-serif;
            --radius-md: 0.75rem; --radius-lg: 1rem; --sidebar-width: 256px; --header-height: 64px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-body); background-color: var(--color-bg); color: var(--color-secondary); line-height: 1.5; }
        .sidebar { position: fixed; top: var(--header-height); left: 0; width: var(--sidebar-width); height: calc(100vh - var(--header-height)); background: #fff; border-right: 1px solid var(--color-border-sidebar); z-index: 40; display: flex; flex-direction: column; padding-top: 80px; overflow-y: auto; }
        .sidebar-header-block { position: absolute; top: 0; left: 0; width: 100%; padding: 1.5rem 1.25rem 1rem; border-bottom: 1px solid var(--color-border-sidebar); }
        .sidebar-portal-name { font-family: var(--font-heading); font-weight: 700; font-size: 1rem; color: var(--color-secondary); margin-bottom: .2rem; }
        .sidebar-portal-badge { font-size: .75rem; color: var(--color-muted); }
        .sidebar-nav { display: flex; flex-direction: column; padding: .5rem .75rem; gap: .25rem; }
        .nav-item { display: flex; align-items: center; gap: .75rem; padding: .625rem .75rem; border-radius: var(--radius-md); text-decoration: none; color: var(--color-text-light); font-size: .9rem; font-weight: 500; border-left: 3px solid transparent; transition: background .2s, color .2s; }
        .nav-item svg { width: 1.125rem; height: 1.125rem; flex-shrink: 0; stroke: var(--color-text-light); transition: stroke .2s; }
        .nav-item:hover, .nav-item.active { background: var(--color-primary-soft); color: var(--color-primary-btn); }
        .nav-item:hover svg, .nav-item.active svg { stroke: var(--color-primary-btn); }
        .nav-item.active { border-left-color: var(--color-primary-btn); border-radius: 0 var(--radius-md) var(--radius-md) 0; }
        .sidebar-submenu { display: flex; flex-direction: column; padding: 0 .75rem; gap: .1rem; }
        .sub-item { position: relative; display: flex; align-items: center; padding: .5rem .75rem .5rem 2.25rem; border-radius: var(--radius-md); text-decoration: none; color: var(--color-text-light); font-size: .825rem; font-weight: 500; transition: background .2s, color .2s; }
        .sub-item::before { content: ''; position: absolute; left: 1.15rem; top: 50%; transform: translateY(-50%); width: 5px; height: 5px; border-radius: 50%; background: var(--color-text-light); transition: background .2s; }
        .sub-item:hover, .sub-item.active { background: var(--color-primary-soft); color: var(--color-primary-btn); }
        .sub-item:hover::before, .sub-item.active::before { background: var(--color-primary-btn); }
        .sub-item.active { font-weight: 600; }
        .sidebar-bottom { margin-top: auto; padding: 1rem .75rem 1.5rem; border-top: 1px solid var(--color-border-sidebar); }
        .logout-btn { display: flex; align-items: center; justify-content: center; gap: .75rem; width: 100%; padding: .75rem 1rem; background: var(--color-danger); color: #fff; border: none; border-radius: var(--radius-md); font-weight: 600; font-size: .9rem; cursor: pointer; transition: background .2s; }
        .logout-btn:hover { background: #b91c1c; }
        .logout-btn svg { width: 1.125rem; height: 1.125rem; stroke: #fff; }
        .page-wrapper { display: flex; min-height: 100vh; padding-top: var(--header-height); }
        .main-container { width: 100%; min-height: calc(100vh - var(--header-height)); margin-left: var(--sidebar-width); padding: 1.5rem 2.8rem 4rem 2rem; }
        .form-card { background: var(--color-card); border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: 2rem; max-width: 700px; }
        label { display: block; font-weight: 600; font-size: .875rem; color: var(--color-text); margin-bottom: .5rem; }
        .form-control { width: 100%; padding: .75rem 1rem; border: 1px solid var(--color-border); border-radius: var(--radius-md); font-family: var(--font-body); font-size: .9rem; color: var(--color-secondary); outline: none; transition: border-color .2s, box-shadow .2s; background: #fff; }
        .form-control:focus { border-color: var(--color-primary-btn); box-shadow: 0 0 0 3px rgba(0,97,164,.1); }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-hint { font-size: .8rem; color: var(--color-muted); margin-top: .35rem; }
        .required { color: var(--color-danger); }
        .error-msg { font-size: .8rem; color: var(--color-danger); margin-top: .35rem; }
        .btn-group { display: flex; gap: 1rem; margin-top: 2rem; }
        .btn-primary { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.5rem; background: var(--color-primary-btn); color: #fff; border: none; border-radius: var(--radius-md); font-weight: 600; font-size: .95rem; cursor: pointer; transition: background .2s; }
        .btn-primary:hover { background: #004f87; }
        .btn-cancel { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.5rem; background: transparent; color: var(--color-muted); border: 1.5px solid var(--color-border); border-radius: var(--radius-md); font-weight: 600; font-size: .95rem; cursor: pointer; text-decoration: none; transition: background .2s, color .2s; }
        .btn-cancel:hover { background: var(--color-bg); color: var(--color-secondary); }
        .back-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
        .back-btn { display: flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; border-radius: 50%; background: transparent; border: none; cursor: pointer; transition: background .2s; color: var(--color-secondary); }
        .back-btn:hover { background: #e7e8f0; }
        .image-preview-box { width: 100%; aspect-ratio: 16/9; background: var(--color-primary-soft); border: 2px dashed #93c5fd; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; overflow: hidden; margin-top: .5rem; }
        .image-preview-box img { width: 100%; height: 100%; object-fit: cover; }
        @media (max-width: 768px) { .sidebar { display: none; } .main-container { margin-left: 0; padding: 1.5rem; } .form-grid { grid-template-columns: 1fr; } }
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
            <a href="{{ route('alumni.dashboard') }}" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                </svg>
                Manajemen Profil
            </a>
        </nav>
        <div class="sidebar-submenu">
            <a href="{{ route('alumni.pendidikan.index') }}" class="sub-item">Riwayat Pendidikan</a>
            <a href="{{ route('alumni.pekerjaan.index') }}" class="sub-item">Pengalaman Kerja</a>
            <a href="{{ route('alumni.sertifikasi.index') }}" class="sub-item active">Pencapaian &amp; Sertifikasi</a>
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

    <main class="main-container">
        <div class="back-header">
            <button class="back-btn" onclick="history.back()">
                <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <h1 style="font-family:var(--font-heading);font-weight:700;font-size:1.5rem;color:var(--color-secondary);">
                Tambah Sertifikasi
            </h1>
        </div>

        <div class="form-card">
            <form action="{{ route('alumni.sertifikasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                <div style="padding:.75rem 1rem;background:#fee2e2;border:1px solid #fca5a5;border-radius:var(--radius-md);margin-bottom:1.5rem;">
                    <ul style="margin:0;padding:0 0 0 1rem;font-size:.875rem;color:#991b1b;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="form-group">
                    <label>Nama Sertifikasi <span class="required">*</span></label>
                    <input type="text" name="nama" class="form-control"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Google Professional Cloud Architect">
                    @error('nama') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Diterbitkan Oleh</label>
                        <input type="text" name="diterbitkan_oleh" class="form-control"
                            value="{{ old('diterbitkan_oleh') }}"
                            placeholder="Contoh: Google, Microsoft, Coursera">
                        @error('diterbitkan_oleh') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Terbit</label>
                        <input type="date" name="tanggal_terbit" class="form-control"
                            value="{{ old('tanggal_terbit') }}">
                        @error('tanggal_terbit') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>ID Kredensial</label>
                    <input type="text" name="id_kredensial" class="form-control"
                        value="{{ old('id_kredensial') }}"
                        placeholder="Kosongkan jika tidak ada ID kredensial">
                    <p class="form-hint">Nomor unik sertifikasi yang diberikan oleh penerbit.</p>
                    @error('id_kredensial') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label>Gambar Sertifikat</label>
                    <input type="file" name="gambar_serti" class="form-control"
                        accept="image/jpg,image/jpeg,image/png,image/webp"
                        style="padding:.5rem;"
                        onchange="previewImage(this)">
                    <p class="form-hint">Format JPG, PNG, WEBP. Maks 2MB.</p>
                    <div class="image-preview-box" id="imagePreviewBox" style="display:none;">
                        <img id="imagePreview" src="" alt="Preview">
                    </div>
                    @error('gambar_serti') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Sertifikasi
                    </button>
                    <a href="{{ route('alumni.sertifikasi.index') }}" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
function previewImage(input) {
    const box = document.getElementById('imagePreviewBox');
    const img = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            box.style.display = 'flex';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        box.style.display = 'none';
    }
}
</script>
</body>
</html>
