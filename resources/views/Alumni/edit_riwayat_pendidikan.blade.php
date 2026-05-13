{{-- resources/views/Alumni/edit_riwayat_pendidikan.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pendidikan – Alumni Portal</title>
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
        .modal-overlay {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            backdrop-filter: blur(4px);
            z-index: 99;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem; 
        }
        .modal-overlay.active {
            display: flex;
        }
        
        .modal-container {
            background: white;
            width: 90%;
            max-width: 600px;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
            max-height: 85vh;
            overflow-y: auto;
        }
        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--color-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-title {
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--color-primary);
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--color-muted);
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
        .edu-list { display: flex; flex-direction: column; gap: 1.5rem; }
        .edu-card { display: flex; gap: 1.5rem; background: var(--color-card); padding: 1.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-lg); box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
        .edu-icon { width: 3.5rem; height: 3.5rem; border-radius: var(--radius-md); background: #eff6ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .edu-content { flex: 1; display: flex; flex-direction: column; gap: .75rem; }
        .edu-header-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; }
        .edu-degree { font-family: var(--font-heading); font-weight: 700; font-size: 1.125rem; color: var(--color-secondary); margin-bottom: .25rem; }
        .edu-school { font-weight: 600; color: var(--color-primary); font-size: 1rem; }
        .edu-meta { display: flex; align-items: center; flex-wrap: wrap; gap: 1rem; margin-top: .5rem; }
        .meta-item { display: flex; align-items: center; gap: .4rem; font-size: .9rem; color: var(--color-text-light); }
        .meta-item svg { width: 1rem; height: 1rem; stroke: var(--color-muted); }
        .badge-ipk { background: #eff6ff; color: var(--color-primary-btn); padding: .25rem .75rem; border-radius: 999px; font-size: .75rem; font-weight: 600; }
        .action-group { display: flex; gap: .5rem; }
        .icon-btn { width: 2.25rem; height: 2.25rem; border-radius: .5rem; border: none; background: transparent; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background .2s, color .2s; }
        .icon-btn.edit { color: var(--color-muted); }
        .icon-btn.edit:hover { background: var(--color-badge-bg); color: var(--color-secondary); }
        .icon-btn.del { color: var(--color-danger); }
        .icon-btn.del:hover { background: #fee2e2; }
        .icon-btn svg { width: 1.125rem; height: 1.125rem; }
        .empty-state { text-align: center; padding: 4rem 2rem; background: var(--color-card); border: 1px solid var(--color-border); border-radius: var(--radius-lg); }
        .skripsi-text { font-size: .875rem; color: var(--color-text); font-style: italic; margin-top: .5rem; padding-top: .5rem; border-top: 1px dashed var(--color-border); }
        @media (max-width: 768px) { .sidebar { display: none; } .main-container { margin-left: 0; padding: 1.5rem; } }
    </style>
</head>
<body class="bg-[#F1F5F9] h-screen flex flex-col">
    <div class="shrink-0">
        @include('partials.header-admin')
    </div>
    <div class="flex flex-1 overflow-hidden w-full">
        @include('partials.sidebar-alumni', ['activeMenu' => 'profil'])
        <main class="flex-1 overflow-y-auto pl-72 pr-8 pt-8 pb-16">
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
                        <h1 class="page-title">Riwayat Pendidikan</h1>
                        <p class="page-subtitle">Kelola informasi seputar latar belakang pendidikan Anda.</p>
                    </div>
                </div>
                <button type="button" class="add-btn" onclick="openTambahModal()">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Tambah Pendidikan
                </button>
            </div>

            <div class="edu-list">
                @forelse($educations as $edu)
                <article class="edu-card">
                    <div class="edu-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" stroke="#003f87" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" stroke="#003f87" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="edu-content">
                        <div class="edu-header-row">
                            <div>
                                <h2 class="edu-degree">{{ $edu->jenjang_pendidikan }} - {{ $edu->jurusan ?? 'Jurusan tidak diisi' }}</h2>
                                <p class="edu-school">{{ $edu->nama_instansi }}</p>
                                <div class="edu-meta">
                                    <span class="meta-item">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                            <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                        {{ $edu->tahun_masuk ? $edu->tahun_masuk->format('Y') : '-' }}
                                        &ndash;
                                        {{ $edu->tahun_keluar ? $edu->tahun_keluar->format('Y') : 'Sekarang' }}
                                    </span>
                                    @if($edu->nilai_akhir)
                                    <span class="badge-ipk">IPK: {{ number_format($edu->nilai_akhir, 2) }} / 4.00</span>
                                    @endif
                                </div>
                                @if($edu->judul_skripsi)
                                <p class="skripsi-text">📄 {{ $edu->judul_skripsi }}</p>
                                @endif
                            </div>
                            <div class="action-group">
                                <a href="{{ route('alumni.pendidikan.index') }}?edit={{ $edu->id }}" class="icon-btn edit" title="Edit" onclick="openEditModal({{ $edu->id }}, event)">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M18.5 2.5C18.8978 2.10218 19.4374 1.87868 20 1.87868C20.5626 1.87868 21.1022 2.10218 21.5 2.5C21.8978 2.89782 22.1213 3.43739 22.1213 4C22.1213 4.56261 21.8978 5.10218 21.5 5.5L12 15L8 16L9 12L18.5 2.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <form action="{{ route('alumni.pendidikan.destroy', $edu->id) }}" method="POST" onsubmit="return false" data-delete-form>
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
                    </div>
                </article>

                {{-- Modal Edit inline untuk setiap record --}}
                <div id="editModal-{{ $edu->id }}" style="display:none;position:relative;min-height:540px;background:rgba(0,0,0,0.45);border-radius:1rem;align-items:center;justify-content:center;padding:1rem;">
                    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden">
                        <div class="flex justify-between items-center px-6 py-4 border-b">
                            <h3 style="font-family:var(--font-heading);font-weight:700;color:var(--color-primary);">Edit Riwayat Pendidikan</h3>
                            button class="modal-close" onclick="closeEditModal()"></button>
                        </div>
                        <form action="{{ route('alumni.pendidikan.update', $edu->id) }}" method="POST" class="p-6 space-y-4">
                            @csrf @method('PUT')
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Instansi <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_instansi" value="{{ $edu->nama_instansi }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1">Jenjang <span class="text-red-500">*</span></label>
                                    <select name="jenjang_pendidikan" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500 bg-white">
                                        @foreach(['SD','SMP','SMA/SMK','D1','D2','D3','D4','S1','S2','S3'] as $j)
                                        <option value="{{ $j }}" {{ $edu->jenjang_pendidikan == $j ? 'selected' : '' }}>{{ $j }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Jurusan / Program Studi</label>
                                <input type="text" name="jurusan" value="{{ $edu->jurusan }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="Contoh: Teknik Informatika">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1">Tahun Masuk</label>
                                    <input type="date" name="tahun_masuk" value="{{ $edu->tahun_masuk ? $edu->tahun_masuk->format('Y-m-d') : '' }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1">Tahun Keluar</label>
                                    <input type="date" name="tahun_keluar" value="{{ $edu->tahun_keluar ? $edu->tahun_keluar->format('Y-m-d') : '' }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nilai Akhir (IPK/Nilai)</label>
                                    <input type="number" name="nilai_akhir" value="{{ $edu->nilai_akhir }}" step="0.01" min="0" max="4" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="0.00 - 4.00">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Judul Skripsi / Tugas Akhir</label>
                                <input type="text" name="judul_skripsi" value="{{ $edu->judul_skripsi }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="Kosongkan jika tidak ada">
                            </div>
                            <div class="flex gap-3 pt-2">
                                <button type="button" onclick="closeEditModal({{ $edu->id }})" class="flex-1 py-2.5 rounded-lg bg-red-600 text-white font-bold text-sm hover:bg-red-700 transition-all">Batal</button>
                                <button type="submit" class="flex-1 py-2.5 rounded-lg bg-[#0061a4] text-white font-bold text-sm hover:bg-[#004f87] transition-all">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" style="margin:0 auto;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                    <p style="color:var(--color-muted);margin-top:.75rem;">Belum ada riwayat pendidikan. <a href="#" onclick="openTambahModal();return false;" style="color:var(--color-primary-btn);">Tambah sekarang</a></p>
                </div>
                @endforelse
            </div>
        </div>
        </main>
    </div>

<script>
function openEditModal(id, event) {
    event.preventDefault();
    document.getElementById('editModal-' + id).style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
        function closeEditModal(event) {
            if (event && event.target !== event.currentTarget && event.target !== document.getElementById('editModal')) return;
            document.getElementById('editModal').classList.remove('active');
            document.body.style.overflow = '';
            // Reset file input agar tidak carry-over ke edit berikutnya
            document.getElementById('edit_logo_input').value = '';
        }

function openTambahModal() {
    document.getElementById('tambahModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeTambahModal() {
    document.getElementById('tambahModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('[id^="editModal-"]').forEach(m => m.style.display = 'none');
        closeTambahModal();
        document.body.style.overflow = 'auto';
    }
});
</script>

<!-- Modal Tambah Riwayat Pendidikan -->
<div id="tambahModal" class="modal-overlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[99] hidden items-center justify-center p-4" onclick="closeTambahModal(event)">
        <div class="modal-container" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title">Tambah riwayat pendidikan </h2>
                <button class="modal-close" onclick="closeTambahModal()">&times;</button>
            </div>
        <form action="{{ route('alumni.pendidikan.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Instansi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_instansi" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="Contoh: Politeknik Negeri Jember" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Jenjang <span class="text-red-500">*</span></label>
                    <select name="jenjang_pendidikan" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500 bg-white" required>
                        <option value="">-- Pilih Jenjang --</option>
                        @foreach(['SD','SMP','SMA/SMK','D1','D2','D3','D4','S1','S2','S3'] as $j)
                        <option value="{{ $j }}">{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Jurusan / Program Studi</label>
                <input type="text" name="jurusan" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="Contoh: Teknik Informatika">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Tahun Masuk</label>
                    <input type="date" name="tahun_masuk" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Tahun Keluar</label>
                    <input type="date" name="tahun_keluar" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nilai Akhir (IPK)</label>
                    <input type="number" name="nilai_akhir" step="0.01" min="0" max="4" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="0.00 - 4.00">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Judul Skripsi / TA</label>
                    <input type="text" name="judul_skripsi" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="Kosongkan jika tidak ada">
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeTambahModal()" class="flex-1 py-2.5 rounded-lg bg-red-600 text-white font-bold text-sm hover:bg-red-700 transition-all">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-lg bg-[#0061a4] text-white font-bold text-sm hover:bg-[#004f87] transition-all">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modalHapusWrapper" style="display:none;position:relative;min-height:240px;background:rgba(0,0,0,0.5);border-radius:1rem;align-items:center;justify-content:center;">
<div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden">
        <div class="p-6">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <h3 class="text-center font-bold text-slate-800 text-base mb-1">Hapus Riwayat Pendidikan?</h3>
            <p class="text-center text-slate-500 text-sm">Data yang dihapus tidak dapat dikembalikan.</p>
        </div>
        <div class="flex border-t border-slate-100">
            <button onclick="closeModalHapus()" class="flex-1 py-3.5 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition-colors">Batal</button>
            <button onclick="submitDeleteForm()" class="flex-1 py-3.5 text-red-600 font-bold text-sm hover:bg-red-50 transition-colors border-l border-slate-100">Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    let _deleteFormTarget = null;
    function confirmHapus(form) {
        _deleteFormTarget = form;
        document.getElementById('modalHapusWrapper').style.display = 'flex';
    }
    function closeModalHapus() {
        document.getElementById('modalHapusWrapper').style.display = 'none';
        _deleteFormTarget = null;
    }
    function submitDeleteForm() {
        if (_deleteFormTarget) _deleteFormTarget.submit();
    }
    document.querySelectorAll('[data-delete-form]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            confirmHapus(this);
        });
    });
</script>

</body>
</html>