{{-- resources/views/Alumni/modal1.blade.php --}}

<div id="modal-overlay-cert" onclick="closeModalCert()" style="
  display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.45); z-index: 200;
"></div>

<div id="modal-cert" style="
  display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
  width: 100%; max-width: 500px; background: #ffffff; border-radius: 1rem;
  box-shadow: 0px 20px 60px rgba(0, 0, 0, 0.15); z-index: 201; padding: 1.75rem;
  font-family: 'Inter', sans-serif; max-height: 90vh; overflow-y: auto;
">

  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 id="modal-title-cert" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 1.125rem; color: #0061a4;">
      Tambah Pencapaian & Sertifikasi
    </h2>
    <button onclick="closeModalCert()" style="background: transparent; border: none; cursor: pointer; padding: 0.25rem; color: #64748b; font-size: 1.25rem; line-height: 1; transition: color 0.2s;" onmouseover="this.style.color='#191c21'" onmouseout="this.style.color='#64748b'">
      &#x2715;
    </button>
  </div>

  <form id="form-cert" onsubmit="submitCertForm(event)">
  
    
    <input type="hidden" name="cert_id" id="cert_id">

    <div style="margin-bottom: 1.25rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Nama Pencapaian / Sertifikasi</label>
      <input type="text" name="title" id="cert_title" placeholder="Contoh: Google Data Analytics Certificate" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
    </div>

    <div style="margin-bottom: 1.25rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Penerbit / Institusi</label>
      <input type="text" name="provider" id="cert_provider" placeholder="Contoh: Coursera, Google, dsb." required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
    </div>

    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
      <div style="flex: 1;">
        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Tanggal Terbit</label>
        <div style="position: relative;">
            <input type="text" name="issue_date" id="cert_issue_date" placeholder="Bulan Tahun" required style="width: 100%; padding: 0.625rem 2.5rem 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
            <svg style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); pointer-events: none;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#727784" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </div>
      </div>
      <div style="flex: 1;">
        <label style="display: flex; justify-content: space-between; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">ID Kredensial <span style="color: #64748b; font-size: 0.75rem; font-weight: 400;">(Opsional)</span></label>
        <input type="text" name="credential_id" id="cert_credential_id" placeholder="ID Sertifikat" style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
      </div>
    </div>

    <div style="margin-bottom: 2rem;">
        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Unggah Bukti <span style="color: #64748b; font-size: 0.75rem; font-weight: 400;">(Opsional)</span></label>
        <label style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; padding: 1.5rem; border: 2px dashed rgba(194, 198, 212, 0.6); border-radius: 0.5rem; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9'" onmouseout="this.style.backgroundColor='transparent'">
            <svg viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 2rem; height: 2rem; margin-bottom: 0.5rem;">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <span style="font-size: 0.875rem; color: #191c21; font-weight: 500;">Seret &amp; letakkan file di sini</span>
            <span style="font-size: 0.75rem; color: #64748b; margin-top: 0.25rem;">Maksimal ukuran 5MB (.jpg, .png, .pdf)</span>
            <input type="file" name="document" style="display: none;" accept="image/*,application/pdf">
        </label>
    </div>

    <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
      <button type="button" onclick="closeModalCert()" style="padding: 0.625rem 1.5rem; background-color: #d12924; color: #fff; border: none; border-radius: 0.5rem; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#d12924'">Batal</button>
      <button type="submit" style="padding: 0.625rem 1.5rem; background-color: #0061a4; color: #fff; border: none; border-radius: 0.5rem; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#004f87'" onmouseout="this.style.backgroundColor='#0061a4'">Simpan</button>
    </div>
  </form>
</div>

<script>
  // Fungsi dipanggil saat tombol "Tambah Sertifikasi" diklik
  function openModalCert() {
    document.getElementById('modal-title-cert').innerText = 'Tambah Pencapaian & Sertifikasi';
    document.getElementById('form-cert').reset();
    document.getElementById('cert_id').value = ''; 
    
    document.getElementById('modal-overlay-cert').style.display = 'block';
    document.getElementById('modal-cert').style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  // Fungsi dipanggil saat tombol "Edit" (ikon pensil) diklik
  function editCert(buttonElement) {
    const dataString = buttonElement.getAttribute('data-cert');
    const data = JSON.parse(dataString);

    document.getElementById('modal-title-cert').innerText = 'Edit Pencapaian & Sertifikasi';

    const form = document.getElementById('form-cert');
    
    // Set value ke input form sesuai dummy data ($certifications)
    form.cert_id.value = data.id || '';
    form.cert_title.value = data.title || '';
    form.cert_provider.value = data.provider || '';
    form.cert_issue_date.value = data.issue_date || '';
    form.cert_credential_id.value = data.credential_id || '';

    // Tampilkan modal
    document.getElementById('modal-overlay-cert').style.display = 'block';
    document.getElementById('modal-cert').style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  function closeModalCert() {
    document.getElementById('modal-overlay-cert').style.display = 'none';
    document.getElementById('modal-cert').style.display = 'none';
    document.body.style.overflow = '';
    document.getElementById('form-cert').reset();
  }

  // Tutup modal jika tekan ESC
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModalCert();
  });

  function submitCertForm(e) {
    e.preventDefault();
    const form = document.getElementById('form-cert');
    
    const data = {
      id:            form.cert_id.value, 
      title:         form.cert_title.value,
      provider:      form.cert_provider.value,
      issue_date:    form.cert_issue_date.value,
      credential_id: form.cert_credential_id.value,
    };
    
    console.log('Data tersimpan:', data);
    
    const isEdit = data.id !== "";
    const message = isEdit ? 'Sertifikat berhasil diubah! (dummy)' : 'Sertifikat berhasil ditambahkan! (dummy)';
    
    alert(message);
    closeModalCert();
  }
</script>