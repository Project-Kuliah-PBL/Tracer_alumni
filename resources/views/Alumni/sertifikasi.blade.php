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
            --color-primary: #003f87; --color-primary-soft: #eff6ff; --color-primary-btn: #0061a4;
            --color-secondary: #191c21; --color-muted: #64748b; --color-text: #424752;
            --color-text-light: #727784; --color-border: #e1e2ea; --color-border-sidebar: #E2E8F0;
            --color-bg: #f1f4f6; --color-card: #ffffff; --color-icon-bg: #e7e8f0;
            --color-badge-bg: #e7e8f0; --color-danger: #d12924;
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
        .content-area { max-width: 75rem; display: flex; flex-direction: column; gap: 2rem; }
        .header-section { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .header-left { display: flex; align-items: center; gap: 1.25rem; }
        .back-btn { display: flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; border-radius: 50%; background: transparent; border: none; cursor: pointer; transition: background .2s; color: var(--color-secondary); }
        .back-btn:hover { background: var(--color-badge-bg); }
        .page-title { font-family: var(--font-heading); font-weight: 700; font-size: 1.75rem; color: var(--color-secondary); }
        .page-subtitle { font-size: 1rem; color: var(--color-text); margin-top: .25rem; }
        .add-btn { display: inline-flex; align-items: center; gap: .6rem; padding: .75rem 1.25rem; background-color: var(--color-primary-btn); color: #fff; border: none; border-radius: var(--radius-md); font-weight: 600; font-size: .95rem; cursor: pointer; transition: background .2s; text-decoration: none; }
        .add-btn:hover { background-color: #004f87; }
        .add-btn svg { width: 1.25rem; height: 1.25rem; }
        .cert-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
        .cert-card { background: var(--color-card); border: 1px solid var(--color-border); border-radius: var(--radius-lg); overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.02); transition: box-shadow .2s; }
        .cert-card:hover { box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
        .cert-image { width: 100%; aspect-ratio: 16/9; background: linear-gradient(135deg, #eff6ff, #dbeafe); display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .cert-image img { width: 100%; height: 100%; object-fit: cover; }
        .cert-body { padding: 1.25rem; }
        .cert-name { font-family: var(--font-heading); font-weight: 700; font-size: 1rem; color: var(--color-secondary); margin-bottom: .5rem; line-height: 1.3; }
        .cert-issuer { font-size: .875rem; color: var(--color-primary); font-weight: 600; }
        .cert-date { font-size: .8rem; color: var(--color-muted); margin-top: .35rem; }
        .cert-credential { font-size: .75rem; color: var(--color-text-light); margin-top: .25rem; font-family: monospace; background: var(--color-icon-bg); padding: .15rem .5rem; border-radius: .3rem; display: inline-block; }
        .cert-actions { display: flex; justify-content: flex-end; gap: .5rem; padding: .75rem 1.25rem; border-top: 1px solid var(--color-border); }
        .icon-btn { width: 2.25rem; height: 2.25rem; border-radius: .5rem; border: none; background: transparent; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background .2s, color .2s; }
        .icon-btn.edit { color: var(--color-muted); }
        .icon-btn.edit:hover { background: var(--color-badge-bg); color: var(--color-secondary); }
        .icon-btn.del { color: var(--color-danger); }
        .icon-btn.del:hover { background: #fee2e2; }
        .icon-btn svg { width: 1.125rem; height: 1.125rem; }
        .empty-state { text-align: center; padding: 4rem 2rem; background: var(--color-card); border: 1px solid var(--color-border); border-radius: var(--radius-lg); }
        @media (max-width: 768px) { .sidebar { display: none; } .main-container { margin-left: 0; padding: 1.5rem; } .cert-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body class="bg-[#F1F5F9] h-screen flex flex-col">
    <div class="shrink-0">
        @include('partials.header-admin')
    </div>
    <div class="flex flex-1 overflow-hidden w-full">
        @include('partials.sidebar-alumni', ['activeMenu' => 'profil'])
        <main class="flex-1 overflow-y-auto p-8">
        <div class="content-area">

            @if(session('success'))
            <div style="padding:.75rem 1rem;background:#dcfce7;border:1px solid #86efac;border-radius:var(--radius-md);color:#166534;font-size:.9rem;font-weight:500;">
                {{ session('success') }}
            </div>
            @endif

            <div class="header-section">
                <div class="header-left">
                    <button class="back-btn" onclick="history.back()">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <div>
                        <h1 class="page-title">Pencapaian & Sertifikasi</h1>
                        <p class="page-subtitle">Kelola sertifikasi dan pencapaian profesional Anda.</p>
                    </div>
                </div>
                <a href="{{ route('alumni.sertifikasi.create') }}" class="add-btn">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Tambah Sertifikasi
                </a>
            </div>

            @if($certifications->count() > 0)
            <div class="cert-grid">
                @foreach($certifications as $cert)
                <div class="cert-card">
                    <div class="cert-image">
                        @if($cert->gambar_serti)
                            <img src="{{ Storage::url($cert->gambar_serti) }}" alt="{{ $cert->nama }}"
                                onerror="this.onerror=null;this.style.display='none';this.parentElement.innerHTML='<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'48\' height=\'48\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'#93c5fd\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z\'/></svg>'">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#93c5fd">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        @endif
                    </div>

                    <div class="cert-body">
                        <h3 class="cert-name">{{ $cert->nama }}</h3>
                        @if($cert->diterbitkan_oleh)
                            <p class="cert-issuer">{{ $cert->diterbitkan_oleh }}</p>
                        @endif
                        @if($cert->tanggal_terbit)
                            <p class="cert-date">Diterbitkan: {{ $cert->tanggal_terbit->format('d M Y') }}</p>
                        @endif
                        @if($cert->id_kredensial)
                            <span class="cert-credential">ID: {{ $cert->id_kredensial }}</span>
                        @endif
                    </div>

                    <div class="cert-actions">
                        {{-- Tombol Edit --}}
                        <button type="button" class="icon-btn edit" title="Edit"
                            onclick="openEditModal({{ $cert->id }})">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.5 2.5C18.8978 2.10218 19.4374 1.87868 20 1.87868C20.5626 1.87868 21.1022 2.10218 21.5 2.5C21.8978 2.89782 22.1213 3.43739 22.1213 4C22.1213 4.56261 21.8978 5.10218 21.5 5.5L12 15L8 16L9 12L18.5 2.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        {{-- Tombol Hapus --}}
                        <form action="{{ route('alumni.sertifikasi.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Hapus sertifikasi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="icon-btn del" title="Hapus">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M3 6H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8 6V4H16V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19 6L18.2 19.2C18.1 20.4 17.1 21.3 15.9 21.3H8.1C6.9 21.3 5.9 20.4 5.8 19.2L5 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 11V17M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Modal Edit untuk tiap sertifikat --}}
                <div id="editModal-{{ $cert->id }}" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[99] hidden items-center justify-center p-4">
                    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden">
                        <div class="flex justify-between items-center px-6 py-4 border-b">
                            <h3 style="font-family:var(--font-heading);font-weight:700;color:var(--color-primary);">Edit Sertifikasi</h3>
                            <button onclick="closeEditModal({{ $cert->id }})" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <form action="{{ route('alumni.sertifikasi.update', $cert->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                            @csrf @method('PUT')

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Sertifikasi <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" value="{{ $cert->nama }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" required>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1">Diterbitkan Oleh</label>
                                    <input type="text" name="diterbitkan_oleh" value="{{ $cert->diterbitkan_oleh }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="Contoh: Google, Microsoft">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal Terbit</label>
                                    <input type="date" name="tanggal_terbit" value="{{ $cert->tanggal_terbit ? $cert->tanggal_terbit->format('Y-m-d') : '' }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">ID Kredensial</label>
                                <input type="text" name="id_kredensial" value="{{ $cert->id_kredensial }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="Kosongkan jika tidak ada">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Gambar Sertifikat</label>
                                @if($cert->gambar_serti)
                                <p style="font-size:.8rem;color:var(--color-muted);margin-bottom:.35rem;">Ada gambar tersimpan. Unggah baru untuk mengganti.</p>
                                @endif
                                <input type="file" name="gambar_serti" accept="image/jpg,image/jpeg,image/png,image/webp" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200">
                                <p style="font-size:.75rem;color:var(--color-muted);margin-top:.25rem;">Format JPG, PNG, WEBP. Maks 2MB.</p>
                            </div>

                            <div class="flex gap-3 pt-2">
                                <button type="button" onclick="closeEditModal({{ $cert->id }})" class="flex-1 py-2.5 rounded-lg bg-red-600 text-white font-bold text-sm hover:bg-red-700 transition-all">Batal</button>
                                <button type="submit" class="flex-1 py-2.5 rounded-lg bg-[#0061a4] text-white font-bold text-sm hover:bg-[#004f87] transition-all">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" style="margin:0 auto;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                <p style="color:var(--color-muted);margin-top:.75rem;">Belum ada sertifikasi. <a href="{{ route('alumni.sertifikasi.create') }}" style="color:var(--color-primary-btn);">Tambah sertifikasi baru</a></p>
            </div>
            @endif

        </div>
        </main>
    </div>

<script>
function openEditModal(id) {
    document.getElementById('editModal-' + id).classList.remove('hidden');
    document.getElementById('editModal-' + id).classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeEditModal(id) {
    document.getElementById('editModal-' + id).classList.add('hidden');
    document.getElementById('editModal-' + id).classList.remove('flex');
    document.body.style.overflow = 'auto';
}
</script>
</body>
</html>