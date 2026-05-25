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
            --color-text-light: #727784; --color-border: #e1e2ea;
            --color-bg: #f1f4f6; --color-card: #ffffff; --color-icon-bg: #e7e8f0;
            --color-badge-bg: #e7e8f0; --color-danger: #d12924;
            --font-heading: 'Plus Jakarta Sans', sans-serif; --font-body: 'Inter', sans-serif;
            --radius-md: 0.75rem; --radius-lg: 1rem;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-body); background-color: var(--color-bg); color: var(--color-secondary); line-height: 1.5; }
        
        /* Custom Scrollbar */
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

        /* Komponen Modals */
        .modal-overlay {
            position: fixed; top: 0; right: 0; bottom: 0; left: 0;
            backdrop-filter: blur(4px); z-index: 99; display: none;
            align-items: center; justify-content: center; padding: 1rem; 
        }
        .modal-overlay.active { display: flex; }
        .modal-container {
            background: white; width: 90%; max-width: 600px;
            border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
            max-height: 85vh; overflow-y: auto;
        }
        .modal-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center; }
        .modal-title { font-family: var(--font-heading); font-weight: 700; font-size: 1.25rem; color: var(--color-primary); }
        .modal-close { background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--color-muted); }

        /* Komponen Konten */
        .content-area { max-width: 75rem; display: flex; flex-direction: column; gap: 2rem; width: 100%; margin: 0 auto; }
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
        
        @media (max-width: 768px) { 
            .edu-card { flex-direction: column; gap: 1rem; } 
            .edu-header-row { flex-direction: column; } 
            .action-group { align-self: flex-start; } 
        }
    </style>
</head>
<body class="bg-[#F1F5F9] h-screen flex flex-col font-sans">
    
    <div class="shrink-0 z-50">
        @include('partials.header-admin')
    </div>

    <div class="flex flex-1 overflow-hidden w-full relative">
        
        @include('partials.sidebar-alumni', ['activeMenu' => 'profil'])
        
        <div id="sidebarOverlay" onclick="closeSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden transition-opacity duration-300"></div>

        <main class="flex-1 overflow-y-auto p-6 md:p-8 custom-scroll">
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
                                    <a href="#" class="icon-btn edit" title="Edit"
                                       onclick="openEditModal({{ $edu->id }}, '{{ addslashes($edu->nama_instansi) }}', '{{ $edu->jenjang_pendidikan }}', '{{ addslashes($edu->jurusan ?? '') }}', '{{ $edu->tahun_masuk ? $edu->tahun_masuk->format('Y-m-d') : '' }}', '{{ $edu->tahun_keluar ? $edu->tahun_keluar->format('Y-m-d') : '' }}', '{{ $edu->nilai_akhir ?? '' }}', '{{ addslashes($edu->judul_skripsi ?? '') }}', event)">
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

    <div id="tambahModal" class="modal-overlay" onclick="closeTambahModal(event)">
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

    <div id="editModal"
         style="display:none; position:fixed; inset:0; z-index:9999;
                background:rgba(0,0,0,0.45); backdrop-filter:blur(4px);
                align-items:center; justify-content:center; padding:1rem;"
         onclick="if(event.target===this) closeEditModal()">
        <div style="background:#fff; border-radius:1.5rem; box-shadow:0 20px 60px rgba(0,0,0,0.2);
                    width:100%; max-width:560px; overflow:hidden; max-height:90vh; display:flex; flex-direction:column;"
             onclick="event.stopPropagation()">
            <div style="display:flex; justify-content:space-between; align-items:center; padding:1.25rem 1.75rem; border-bottom:1px solid #f1f5f9;">
                <h3 style="font-weight:700; font-size:1.05rem; color:var(--color-primary); margin:0;">Edit Riwayat Pendidikan</h3>
                <button onclick="closeEditModal()" style="background:none; border:none; cursor:pointer; color:#94a3b8; font-size:1.4rem; line-height:1;" title="Tutup">&times;</button>
            </div>
            <form data-base-action="{{ route('alumni.pendidikan.update', '__ID__') }}" method="POST"
                  style="padding:1.5rem 1.75rem; overflow-y:auto; flex:1;">
                @csrf @method('PUT')
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Instansi <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_instansi" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Jenjang <span class="text-red-500">*</span></label>
                        <select name="jenjang_pendidikan" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500 bg-white">
                            @foreach(['SD','SMP','SMA/SMK','D1','D2','D3','D4','S1','S2','S3'] as $j)
                            <option value="{{ $j }}">{{ $j }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div style="margin-bottom:1rem;">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Jurusan / Program Studi</label>
                    <input type="text" name="jurusan" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="Contoh: Teknik Informatika">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Tahun Masuk</label>
                        <input type="date" name="tahun_masuk" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Tahun Keluar</label>
                        <input type="date" name="tahun_keluar" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500">
                    </div>
                </div>
                <div style="margin-bottom:1rem;">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nilai Akhir (IPK/Nilai)</label>
                    <input type="number" name="nilai_akhir" step="0.01" min="0" max="4" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="0.00 - 4.00">
                </div>
                <div style="margin-bottom:1.5rem;">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Judul Skripsi / Tugas Akhir</label>
                    <input type="text" name="judul_skripsi" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-blue-500" placeholder="Kosongkan jika tidak ada">
                </div>
                <div style="display:flex; gap:.75rem;">
                    <button type="button" onclick="closeEditModal()"
                            style="flex:1; padding:.75rem; background:#dc2626; color:#fff; border:none; border-radius:.75rem; font-weight:700; font-size:.875rem; cursor:pointer;"
                            onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">Batal</button>
                    <button type="submit"
                            style="flex:1; padding:.75rem; background:#0061a4; color:#fff; border:none; border-radius:.75rem; font-weight:700; font-size:.875rem; cursor:pointer;"
                            onmouseover="this.style.background='#004f87'" onmouseout="this.style.background='#0061a4'">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalHapus"
         style="display:none; position:fixed; inset:0; z-index:9999;
                background:rgba(0,0,0,0.45); backdrop-filter:blur(4px);
                align-items:center; justify-content:center; padding:1rem;"
         onclick="if(event.target===this) closeModalHapus()">
        <div style="background:#fff; border-radius:1rem; box-shadow:0 20px 60px rgba(0,0,0,0.2);
                    width:100%; max-width:380px; overflow:hidden;"
             onclick="event.stopPropagation()">
            <div style="padding:1.75rem 1.5rem 1.25rem; text-align:center;">
                <div style="width:3rem; height:3rem; background:#fee2e2; border-radius:50%;
                            display:flex; align-items:center; justify-content:center; margin:0 auto 1rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:1.5rem;height:1.5rem;color:#ef4444;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <h3 style="font-weight:700; font-size:1rem; color:#1e293b; margin-bottom:.4rem;">Hapus Riwayat Pendidikan?</h3>
                <p style="font-size:.875rem; color:#64748b;">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div style="display:flex; border-top:1px solid #f1f5f9;">
                <button onclick="closeModalHapus()"
                        style="flex:1; padding:.875rem; font-size:.875rem; font-weight:600;
                               color:#475569; background:none; border:none; cursor:pointer;"
                        onmouseover="this.style.background='#f8fafc'"
                        onmouseout="this.style.background='none'">Batal</button>
                <button onclick="submitDeleteForm()"
                        style="flex:1; padding:.875rem; font-size:.875rem; font-weight:700;
                               color:#dc2626; background:none; border:none; border-left:1px solid #f1f5f9; cursor:pointer;"
                        onmouseover="this.style.background='#fff5f5'"
                        onmouseout="this.style.background='none'">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        // === FUNGSI SIDEBAR HAMBURGER MENU ===
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebarMenu');
            const overlay = document.getElementById('sidebarOverlay');
            if (!sidebar || !overlay) return;

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            
            if (!sidebar.classList.contains('-translate-x-full')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebarMenu');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar) sidebar.classList.add('-translate-x-full');
            if (overlay) overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Script Modal Riwayat Pendidikan
        function openEditModal(id, nama_instansi, jenjang, jurusan, tahun_masuk, tahun_keluar, nilai_akhir, judul_skripsi, event) {
            event.preventDefault();
            const m = document.getElementById('editModal');
            const form = m.querySelector('form');
            form.action = form.dataset.baseAction.replace('__ID__', id);
            m.querySelector('[name="nama_instansi"]').value = nama_instansi;
            
            const selJenjang = m.querySelector('[name="jenjang_pendidikan"]');
            for (let opt of selJenjang.options) opt.selected = (opt.value === jenjang);
            
            m.querySelector('[name="jurusan"]').value = jurusan;
            m.querySelector('[name="tahun_masuk"]').value = tahun_masuk;
            m.querySelector('[name="tahun_keluar"]').value = tahun_keluar;
            m.querySelector('[name="nilai_akhir"]').value = nilai_akhir;
            m.querySelector('[name="judul_skripsi"]').value = judul_skripsi;
            
            m.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.body.style.overflow = 'auto';
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
                closeEditModal();
                closeTambahModal();
                closeModalHapus();
            }
        });

        // Script Hapus Data
        let _deleteFormTarget = null;
        function confirmHapus(form) {
            _deleteFormTarget = form;
            const m = document.getElementById('modalHapus');
            m.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        
        function closeModalHapus() {
            document.getElementById('modalHapus').style.display = 'none';
            document.body.style.overflow = 'auto';
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