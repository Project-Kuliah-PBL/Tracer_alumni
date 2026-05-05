{{-- resources/views/Alumni/tambah_riwayat_pendidikan.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Riwayat Pendidikan – Alumni Portal</title>
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
        textarea.form-control { resize: vertical; min-height: 100px; }
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
        @media (max-width: 768px) { .sidebar { display: none; } .main-container { margin-left: 0; padding: 1.5rem; } .form-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body class="bg-[#F1F5F9] h-screen flex flex-col">
    <div class="shrink-0">
        @include('partials.header-admin')
    </div>
    <div class="flex flex-1 overflow-hidden w-full">
        @include('partials.sidebar-alumni', ['activeMenu' => 'profil'])
        <main class="flex-1 overflow-y-auto p-8">
        <div class="back-header">
            <button class="back-btn" onclick="history.back()">
                <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <h1 style="font-family:var(--font-heading);font-weight:700;font-size:1.5rem;color:var(--color-secondary);">
                Tambah Riwayat Pendidikan
            </h1>
        </div>

        <div class="form-card">
            <form action="{{ route('alumni.pendidikan.store') }}" method="POST">
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

                <div class="form-grid">
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Nama Instansi / Sekolah <span class="required">*</span></label>
                        <input type="text" name="nama_instansi" class="form-control"
                            value="{{ old('nama_instansi') }}"
                            placeholder="Contoh: Politeknik Negeri Jember">
                        @error('nama_instansi') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Jenjang Pendidikan <span class="required">*</span></label>
                        <select name="jenjang_pendidikan" class="form-control">
                            <option value="">-- Pilih Jenjang --</option>
                            @foreach(['SD','SMP','SMA/SMK','D1','D2','D3','D4','S1','S2','S3'] as $j)
                            <option value="{{ $j }}" {{ old('jenjang_pendidikan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                        @error('jenjang_pendidikan') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Jurusan / Program Studi</label>
                        <input type="text" name="jurusan" class="form-control"
                            value="{{ old('jurusan') }}"
                            placeholder="Contoh: Teknik Informatika">
                        @error('jurusan') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Tahun Masuk</label>
                        <input type="date" name="tahun_masuk" class="form-control"
                            value="{{ old('tahun_masuk') }}">
                        @error('tahun_masuk') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Tahun Keluar <span style="color:var(--color-muted);font-weight:400;">(kosongkan jika masih aktif)</span></label>
                        <input type="date" name="tahun_keluar" class="form-control"
                            value="{{ old('tahun_keluar') }}">
                        @error('tahun_keluar') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Nilai Akhir (IPK / Rata-rata Nilai)</label>
                        <input type="number" name="nilai_akhir" class="form-control"
                            value="{{ old('nilai_akhir') }}"
                            step="0.01" min="0" max="4"
                            placeholder="Contoh: 3.75">
                        <p class="form-hint">Skala 0.00 – 4.00 untuk kuliah, atau nilai rata-rata untuk SMA/SMK.</p>
                        @error('nilai_akhir') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group" style="grid-column: span 2;">
                        <label>Judul Skripsi / Tugas Akhir</label>
                        <input type="text" name="judul_skripsi" class="form-control"
                            value="{{ old('judul_skripsi') }}"
                            placeholder="Kosongkan jika tidak ada atau belum selesai">
                        @error('judul_skripsi') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Pendidikan
                    </button>
                    <a href="{{ route('alumni.pendidikan.index') }}" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>
        </main>
    </div>

</body>
</html>
