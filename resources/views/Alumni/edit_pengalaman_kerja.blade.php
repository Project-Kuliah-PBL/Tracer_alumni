{{-- resources/views/Alumni/edit_pengalaman_kerja.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengalaman Kerja – Alumni Portal</title>

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
            --color-bg:            #f1f4f6;
            --color-card:          #ffffff;
            --color-icon-bg:       #e7e8f0;
            --color-badge-bg:      #e7e8f0;
            --color-danger:        #d12924;
            --font-heading: 'Plus Jakarta Sans', sans-serif;
            --font-body:    'Inter', sans-serif;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-body); background-color: var(--color-bg); color: var(--color-secondary); line-height: 1.5; }

        /* Custom Scrollbar */
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

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

        .experience-list { display: flex; flex-direction: column; gap: 1.5rem; }
        .exp-card { display: flex; gap: 1.5rem; background: var(--color-card); padding: 1.75rem; border: 1px solid var(--color-border); border-radius: var(--radius-lg); box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
        .exp-icon { width: 3.5rem; height: 3.5rem; border-radius: var(--radius-md); background: var(--color-icon-bg); display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
        .exp-content { flex: 1; display: flex; flex-direction: column; gap: .75rem; }
        .exp-header-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; }
        .exp-role { font-family: var(--font-heading); font-weight: 700; font-size: 1.125rem; color: var(--color-secondary); margin-bottom: .25rem; }
        .exp-company { font-weight: 600; color: var(--color-primary); font-size: 1rem; }
        .exp-meta { display: flex; align-items: center; flex-wrap: wrap; gap: 1rem; margin-top: .5rem; }
        .meta-item { display: flex; align-items: center; gap: .4rem; font-size: .9rem; color: var(--color-text-light); }
        .meta-item svg { width: 1rem; height: 1rem; stroke: var(--color-muted); }
        .badge { background: var(--color-badge-bg); color: var(--color-text); padding: .25rem .75rem; border-radius: 999px; font-size: .75rem; font-weight: 600; }
        .exp-desc { font-size: .95rem; color: var(--color-text); line-height: 1.6; margin-top: .5rem; }
        .action-group { display: flex; gap: .5rem; }
        .icon-btn { width: 2.25rem; height: 2.25rem; border-radius: .5rem; border: none; background: transparent; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background .2s, color .2s; text-decoration: none; }
        .icon-btn.edit { color: var(--color-muted); }
        .icon-btn.edit:hover { background: var(--color-badge-bg); color: var(--color-secondary); }
        .icon-btn.del { color: var(--color-danger); }
        .icon-btn.del:hover { background: #fee2e2; }
        .icon-btn svg { width: 1.125rem; height: 1.125rem; }
        .empty-state { text-align: center; padding: 4rem 2rem; background: var(--color-card); border: 1px solid var(--color-border); border-radius: var(--radius-lg); }
        .empty-state p { color: var(--color-muted); margin-top: .75rem; }

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
        .modal-body { padding: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem; color: var(--color-secondary); }
        .form-input, .form-select, .form-textarea { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid var(--color-border); border-radius: 0.5rem; font-size: 0.875rem; }
        .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: var(--color-primary-btn); ring: 2px solid var(--color-primary-soft); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .checkbox-label { display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; cursor: pointer; }
        .modal-footer { padding: 1rem 1.5rem; border-top: 1px solid var(--color-border); display: flex; justify-content: flex-end; gap: 0.75rem; }
        .btn-cancel { padding: 0.5rem 1rem; background: #ef4444; color: white; border: none; border-radius: 0.5rem; cursor: pointer; }
        .btn-submit { padding: 0.5rem 1rem; background: var(--color-primary-btn); color: white; border: none; border-radius: 0.5rem; cursor: pointer; }

        @media (max-width: 768px) {
            .exp-card { flex-direction: column; gap: 1rem; }
            .exp-header-row { flex-direction: column; }
            .action-group { align-self: flex-start; }
            .form-row { grid-template-columns: 1fr; }
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
                <div style="padding:.75rem 1rem; background:#dcfce7; border:1px solid #86efac; border-radius:var(--radius-md); color:#166534; font-size:.9rem; font-weight:500;">
                    {{ session('success') }}
                </div>
                @endif

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
                    <button type="button" class="add-btn" onclick="openTambahModal()">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Tambah Pengalaman
                    </button>
                </div>

                <div class="experience-list">
                    @forelse($experiences as $exp)
                    <article class="exp-card">
                        <div class="exp-icon">
                            @if($exp->logo_perusahaan)
                                <img src="{{ Storage::url($exp->logo_perusahaan) }}" alt="{{ $exp->nama_perusahaan }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke="#003f87" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            @endif
                        </div>

                        <div class="exp-content">
                            <div class="exp-header-row">
                                <div>
                                    <h2 class="exp-role">{{ $exp->jobdesk ?? 'Posisi tidak diisi' }}</h2>
                                    <p class="exp-company">{{ $exp->nama_perusahaan }}</p>
                                    <div class="exp-meta">
                                        <span class="meta-item">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            {{ $exp->tahun_masuk ? \Carbon\Carbon::parse($exp->tahun_masuk)->format('M Y') : '-' }}
                                            &ndash;
                                            {{ $exp->tahun_selesai ? \Carbon\Carbon::parse($exp->tahun_selesai)->format('M Y') : 'Sekarang' }}
                                        </span>
                                        <span class="badge">{{ $exp->status_pekerjaan }}</span>
                                    </div>
                                </div>

                                <div class="action-group">
                                    <button type="button" class="icon-btn edit" title="Edit" onclick="openEditModal({{ $exp->id }})">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.5 2.50001C18.8978 2.10219 19.4374 1.87869 20 1.87869C20.5626 1.87869 21.1022 2.10219 21.5 2.50001C21.8978 2.89784 22.1213 3.4374 22.1213 4.00001C22.1213 4.56262 21.8978 5.10219 21.5 5.50001L12 15L8 16L9 12L18.5 2.50001Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                    <form action="{{ route('alumni.pekerjaan.destroy', $exp->id) }}" method="POST" onsubmit="return false" data-delete-form>
                                        @csrf @method('DELETE')
                                        <button type="submit" class="icon-btn del" title="Hapus">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 6H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8 6V4H16V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M19 6L18.2 19.2C18.1 20.4 17.1 21.3 15.9 21.3H8.1C6.9 21.3 5.9 20.4 5.8 19.2L5 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @if($exp->deskripsi)
                                <p class="exp-desc">{{ $exp->deskripsi }}</p>
                            @endif
                        </div>
                    </article>
                    @empty
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" style="margin:0 auto;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p>Belum ada data pengalaman kerja. <a href="#" onclick="openTambahModal();return false;" style="color:var(--color-primary-btn);">Tambah pengalaman baru</a></p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    {{-- Modal Edit --}}
    <div id="editModal" class="modal-overlay" onclick="closeEditModal(event)">
        <div class="modal-container" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title">Edit Pengalaman Kerja</h2>
                <button class="modal-close" onclick="closeEditModal()">x</button>
            </div>
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_perusahaan" id="edit_nama_perusahaan" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Posisi / Jobdesk</label>
                        <input type="text" name="jobdesk" id="edit_jobdesk" class="form-input" placeholder="Contoh: Software Engineer">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Divisi / Departemen</label>
                            <input type="text" name="divisi" id="edit_divisi" class="form-input" placeholder="Contoh: Engineering, Marketing">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lokasi (Kota)</label>
                            <input type="text" name="lokasi" id="edit_lokasi" class="form-input" placeholder="Contoh: Surabaya, Jakarta">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status Pekerjaan <span class="text-red-500">*</span></label>
                        <select name="status_pekerjaan" id="edit_status_pekerjaan" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Pekerjaan Tetap">Pekerjaan Tetap</option>
                            <option value="Kontrak">Kontrak</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Magang">Magang</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Wirausaha">Wirausaha</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tahun_masuk" id="edit_tahun_masuk" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tahun_selesai" id="edit_tahun_selesai" class="form-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="edit_masih_bekerja" onchange="toggleSelesaiEdit()">
                            Saya masih bekerja di sini
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="form-textarea" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Logo Perusahaan (Opsional, maks. 1MB)</label>
                        <div id="edit_logo_preview_wrap" class="hidden mb-2 flex items-center gap-3">
                            <img id="edit_logo_preview_img" src="" alt="Logo saat ini"
                                 class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                            <span class="text-xs text-slate-400">Logo saat ini. Upload baru untuk mengganti.</span>
                        </div>
                        <input type="file" name="logo_perusahaan" id="edit_logo_input" accept="image/*" class="form-input"
                               onchange="previewNewLogo(this)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Tambah Pengalaman Kerja --}}
    <div id="tambahModal" class="modal-overlay" onclick="closeTambahModal(event)">
        <div class="modal-container" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title">Tambah Pengalaman Kerja</h2>
                <button class="modal-close" onclick="closeTambahModal()">&times;</button>
            </div>
            <form action="{{ route('alumni.pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_perusahaan" class="form-input" required placeholder="Contoh: PT Telkom Indonesia">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Posisi / Jobdesk</label>
                        <input type="text" name="jobdesk" class="form-input" placeholder="Contoh: Software Engineer">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Divisi / Departemen</label>
                            <input type="text" name="divisi" class="form-input" placeholder="Contoh: Engineering, Marketing">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lokasi (Kota)</label>
                            <input type="text" name="lokasi" class="form-input" placeholder="Contoh: Surabaya, Jakarta">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status Pekerjaan <span class="text-red-500">*</span></label>
                        <select name="status_pekerjaan" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Pekerjaan Tetap">Pekerjaan Tetap</option>
                            <option value="Kontrak">Kontrak</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Magang">Magang</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Wirausaha">Wirausaha</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tahun_masuk" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tahun_selesai" id="tambah_tahun_selesai" class="form-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="tambah_masih_bekerja" onchange="toggleSelesaiTambah()">
                            Saya masih bekerja di sini
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi Pekerjaan</label>
                        <textarea name="deskripsi" class="form-textarea" rows="3" placeholder="Jelaskan tanggung jawab dan pencapaian Anda..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Logo Perusahaan <span style="color:var(--color-muted);font-weight:400;">(Opsional, maks. 1MB)</span></label>
                        <input type="file" name="logo_perusahaan" accept="image/*" class="form-input">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeTambahModal()">Batal</button>
                    <button type="submit" class="btn-submit">Tambah Pengalaman</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalHapus"
         style="display:none; position:fixed; inset:0; z-index:9999;
                background:rgba(0,0,0,0.45); backdrop-filter:blur(4px);
                align-items:center; justify-content:center; padding:1rem;">
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
                <h3 style="font-weight:700; font-size:1rem; color:#1e293b; margin-bottom:.4rem;">Hapus Pengalaman Kerja?</h3>
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

        // Data pekerjaan dari server (dikirim via JavaScript)
        let pekerjaanData = @json($experiences);

        function toDateInput(val) {
            if (!val) return '';
            return String(val).substring(0, 10);
        }

        function openEditModal(id) {
            const pekerjaan = pekerjaanData.find(p => p.id === id);
            if (!pekerjaan) return;

            document.getElementById('editForm').action = `/alumni/pekerjaan/${id}`;
            document.getElementById('edit_nama_perusahaan').value = pekerjaan.nama_perusahaan || '';
            document.getElementById('edit_jobdesk').value         = pekerjaan.jobdesk || '';
            document.getElementById('edit_divisi').value          = pekerjaan.divisi  || '';
            document.getElementById('edit_lokasi').value          = pekerjaan.lokasi  || '';
            document.getElementById('edit_deskripsi').value       = pekerjaan.deskripsi || '';

            const selectStatus = document.getElementById('edit_status_pekerjaan');
            selectStatus.value = pekerjaan.status_pekerjaan || '';

            document.getElementById('edit_tahun_masuk').value   = toDateInput(pekerjaan.tahun_masuk);
            document.getElementById('edit_tahun_selesai').value = toDateInput(pekerjaan.tahun_selesai);

            const masihBekerja = !pekerjaan.tahun_selesai;
            document.getElementById('edit_masih_bekerja').checked      = masihBekerja;
            document.getElementById('edit_tahun_selesai').disabled     = masihBekerja;

            const logoPreviewWrap = document.getElementById('edit_logo_preview_wrap');
            const logoPreviewImg  = document.getElementById('edit_logo_preview_img');
            if (pekerjaan.logo_perusahaan) {
                logoPreviewImg.src = `/storage/${pekerjaan.logo_perusahaan}`;
                logoPreviewWrap.classList.remove('hidden');
            } else {
                logoPreviewWrap.classList.add('hidden');
            }

            document.getElementById('editModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function previewNewLogo(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    const img  = document.getElementById('edit_logo_preview_img');
                    const wrap = document.getElementById('edit_logo_preview_wrap');
                    img.src = e.target.result;
                    wrap.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function closeEditModal(event) {
            if (event && event.target !== event.currentTarget && event.target !== document.getElementById('editModal')) return;
            document.getElementById('editModal').classList.remove('active');
            document.body.style.overflow = '';
            document.getElementById('edit_logo_input').value = '';
        }

        function toggleSelesaiEdit() {
            const masihBekerja = document.getElementById('edit_masih_bekerja').checked;
            const selesaiInput = document.getElementById('edit_tahun_selesai');
            selesaiInput.disabled = masihBekerja;
            if (masihBekerja) {
                selesaiInput.value = '';
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
                closeTambahModal();
                closeModalHapus();
            }
        });

        function openTambahModal() {
            document.getElementById('tambahModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        function closeTambahModal(event) {
            if (event && event.target !== event.currentTarget && event.target !== document.getElementById('tambahModal')) return;
            document.getElementById('tambahModal').classList.remove('active');
            document.body.style.overflow = '';
        }
        function toggleSelesaiTambah() {
            const masih = document.getElementById('tambah_masih_bekerja').checked;
            const selesai = document.getElementById('tambah_tahun_selesai');
            selesai.disabled = masih;
            if (masih) selesai.value = '';
        }

        // Hapus Logic
        let _deleteFormTarget = null;
        function confirmHapus(form) {
            _deleteFormTarget = form;
            const m = document.getElementById('modalHapus');
            m.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeModalHapus() {
            const m = document.getElementById('modalHapus');
            m.style.display = 'none';
            document.body.style.overflow = '';
            _deleteFormTarget = null;
        }
        function submitDeleteForm() {
            if (_deleteFormTarget) _deleteFormTarget.submit();
        }

        document.getElementById('modalHapus').addEventListener('click', function(e) {
            if (e.target === this) closeModalHapus();
        });

        document.querySelectorAll('[data-delete-form]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                confirmHapus(this);
            });
        });
    </script>
</body>
</html>