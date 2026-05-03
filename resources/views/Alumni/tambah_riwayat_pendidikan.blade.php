{{-- 
  Popup Tambah & Edit Riwayat Pendidikan
  Cara pakai: tambahkan @include('alumni.tambah-riwayat-pendidikan') di halaman utama
--}}

<div id="modal-overlay" onclick="closeModal()" style="
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.45);
  z-index: 200;
"></div>

<div id="modal-tambah-pendidikan" style="
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  max-width: 480px;
  background: #ffffff;
  border-radius: 1rem;
  box-shadow: 0px 20px 60px rgba(0, 0, 0, 0.15);
  z-index: 201;
  padding: 1.75rem;
  font-family: 'Inter', sans-serif;
  max-height: 90vh;
  overflow-y: auto;
">

  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 id="modal-title" style="
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 1.125rem;
      color: #0061a4;
    ">Tambah Riwayat Pendidikan</h2>
    <button onclick="closeModal()" style="
      background: transparent;
      border: none;
      cursor: pointer;
      padding: 0.25rem;
      color: #64748b;
      font-size: 1.25rem;
      line-height: 1;
      transition: color 0.2s;
    " onmouseover="this.style.color='#191c21'" onmouseout="this.style.color='#64748b'">
      &#x2715;
    </button>
  </div>

  <form id="form-tambah-pendidikan" onsubmit="submitForm(event)">


    <input type="hidden" name="education_id" id="education_id">

    <div style="margin-bottom: 1.25rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Nama Institusi / Universitas</label>
      <input type="text" name="institution" placeholder="Contoh: Universitas Indonesia" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
    </div>

    <div style="margin-bottom: 1.25rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Jenjang Pendidikan</label>
      <input type="text" name="degree" placeholder="Contoh: S1" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
    </div>

    <div style="margin-bottom: 1.25rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Jurusan / Bidang Studi</label>
      <input type="text" name="major" placeholder="Contoh: Teknik Informatika" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
    </div>

    <div style="display: flex; gap: 1rem; margin-bottom: 1.25rem;">
      <div style="flex: 1;">
        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Tahun Mulai</label>
        <div style="position: relative;">
          <input type="number" name="start_year" placeholder="YYYY" min="1950" max="2099" required style="width: 100%; padding: 0.625rem 2.5rem 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif; -moz-appearance: textfield;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
          <svg style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); pointer-events: none;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#727784" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
        </div>
      </div>
      <div style="flex: 1;">
        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Tahun Lulus</label>
        <div style="position: relative;">
          <input type="number" name="end_year" placeholder="YYYY" min="1950" max="2099" style="width: 100%; padding: 0.625rem 2.5rem 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif; -moz-appearance: textfield;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
          <svg style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); pointer-events: none;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#727784" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
        </div>
      </div>
    </div>

    <div style="margin-bottom: 1.25rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Nilai Akhir / IPK</label>
      <input type="text" name="ipk" placeholder="Contoh: 3.85" style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
    </div>

    <div style="margin-bottom: 2rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Judul Skripsi / Tugas Akhir</label>
      <input type="text" name="thesis_label" placeholder="Masukkan judul penelitian..." style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
    </div>

    <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
      <button type="button" onclick="closeModal()" style="padding: 0.625rem 1.5rem; background-color: #d12924; color: #fff; border: none; border-radius: 0.5rem; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#d12924'">Batal</button>
      <button type="submit" style="padding: 0.625rem 1.5rem; background-color: #0061a4; color: #fff; border: none; border-radius: 0.5rem; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#004f87'" onmouseout="this.style.backgroundColor='#0061a4'">Simpan</button>
    </div>
  </form>
</div>

<script>
  // Fungsi dipanggil saat tombol "Tambah Pendidikan" diklik
  function openModal() {
    document.getElementById('modal-title').innerText = 'Tambah Riwayat Pendidikan';
    document.getElementById('form-tambah-pendidikan').reset();
    document.getElementById('education_id').value = ''; // Kosongkan ID
    
    document.getElementById('modal-overlay').style.display = 'block';
    document.getElementById('modal-tambah-pendidikan').style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  // Fungsi dipanggil saat tombol "Edit" (ikon pensil) diklik
  function editEducation(buttonElement) {
    // 1. Ambil data dari atribut 'data-edu'
    const dataString = buttonElement.getAttribute('data-edu');
    const data = JSON.parse(dataString);

    // 2. Ubah judul Modal
    document.getElementById('modal-title').innerText = 'Edit Riwayat Pendidikan';

    // 3. Isi form dengan data
    const form = document.getElementById('form-tambah-pendidikan');
    
    // Hapus string "Judul Skripsi : " jika ada di data dummy, biar rapi pas masuk inputan
    let cleanThesis = data.thesis_label ? data.thesis_label.replace('Judul Skripsi : ', '').replace('Judul Tesis : ', '') : '';

    form.education_id.value = data.id || '';
    form.institution.value = data.institution || '';
    form.degree.value = data.degree || '';
    form.major.value = data.major || ''; // Isi jika field jurusan ada di DB
    form.start_year.value = data.start_year || '';
    form.end_year.value = data.end_year || '';
    form.ipk.value = data.ipk || '';
    form.thesis_label.value = cleanThesis;

    // 4. Tampilkan modal
    document.getElementById('modal-overlay').style.display = 'block';
    document.getElementById('modal-tambah-pendidikan').style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    document.getElementById('modal-overlay').style.display = 'none';
    document.getElementById('modal-tambah-pendidikan').style.display = 'none';
    document.body.style.overflow = '';
    document.getElementById('form-tambah-pendidikan').reset();
  }

  // Tutup modal jika tekan ESC
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
  });

  function submitForm(e) {
    e.preventDefault();
    const form = document.getElementById('form-tambah-pendidikan');
    const data = {
      id:          form.education_id.value, // Jika ada isinya, berarti ini EDIT. Jika kosong, berarti TAMBAH.
      institution: form.institution.value,
      degree:      form.degree.value,
      major:       form.major.value,
      start_year:  form.start_year.value,
      end_year:    form.end_year.value,
      ipk:         form.ipk.value,
      thesis_label:form.thesis_label.value,
    };
    
    console.log('Data tersimpan:', data);
    
    // Cek action: Update atau Create
    const isEdit = data.id !== "";
    const message = isEdit ? 'Data berhasil diubah! (dummy)' : 'Data berhasil ditambahkan! (dummy)';
    
    alert(message);
    closeModal();
  }
</script>