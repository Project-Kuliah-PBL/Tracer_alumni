{{-- resources/views/Alumni/pop_up1.blade.php --}}

<div id="modal-overlay-exp" onclick="closeModalExp()" style="
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.45);
  z-index: 200;
"></div>

<div id="modal-pengalaman" style="
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  max-width: 500px;
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
    <h2 id="modal-title-exp" style="
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 1.125rem;
      color: #0061a4;
    ">Tambah Pengalaman Kerja</h2>
    <button onclick="closeModalExp()" style="
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

  <form id="form-pengalaman" onsubmit="submitExpForm(event)">

    
    <input type="hidden" name="exp_id" id="exp_id">

    <div style="margin-bottom: 1.25rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Nama Perusahaan</label>
      <input type="text" name="company_name" id="company_name" placeholder="Contoh: PT Teknologi Indonesia" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
    </div>

    <div style="margin-bottom: 1.25rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Posisi / Jabatan</label>
      <input type="text" name="job_title" id="job_title" placeholder="Contoh: Software Engineer" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
    </div>

    <div style="margin-bottom: 1.25rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Jenis Pekerjaan</label>
      <select name="employment_type" id="employment_type" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; background: #fff; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
        <option value="" disabled selected>Pilih jenis pekerjaan...</option>
        <option value="Full-time">Full-time</option>
        <option value="Part-time">Part-time</option>
        <option value="Internship">Internship (Magang)</option>
        <option value="Freelance">Freelance</option>
        <option value="Kontrak">Kontrak</option>
      </select>
    </div>

    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
      <div style="flex: 1;">
        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Tanggal Mulai</label>
        <input type="text" name="start_date" id="start_date" placeholder="Bulan Tahun (e.g. Jan 2022)" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
      </div>
      <div style="flex: 1;">
        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Tanggal Selesai</label>
        <input type="text" name="end_date" id="end_date" placeholder="e.g. Des 2023 / Sekarang" style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'">
      </div>
    </div>

    <div style="margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
        <input type="checkbox" name="currently_working" id="currently_working" style="width: 1rem; height: 1rem; cursor: pointer;">
        <label for="currently_working" style="font-size: 0.875rem; color: #191c21; cursor: pointer;">Saya saat ini masih bekerja di sini</label>
    </div>

    <div style="margin-bottom: 2rem;">
      <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #191c21; margin-bottom: 0.5rem;">Deskripsi (Opsional)</label>
      <textarea name="description" id="description" rows="3" placeholder="Ceritakan peran, tanggung jawab, dan pencapaian Anda..." style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.9rem; color: #191c21; outline: none; transition: border-color 0.2s; font-family: 'Inter', sans-serif; resize: vertical;" onfocus="this.style.borderColor='#0061a4'" onblur="this.style.borderColor='#e2e8f0'"></textarea>
    </div>

    <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
      <button type="button" onclick="closeModalExp()" style="padding: 0.625rem 1.5rem; background-color: #d12924; color: #fff; border: none; border-radius: 0.5rem; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#d12924'">Batal</button>
      <button type="submit" style="padding: 0.625rem 1.5rem; background-color: #0061a4; color: #fff; border: none; border-radius: 0.5rem; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#004f87'" onmouseout="this.style.backgroundColor='#0061a4'">Simpan</button>
    </div>
  </form>
</div>

<script>
  // Fungsi dipanggil saat tombol "Tambah Pengalaman" diklik
  function openModalExp() {
    document.getElementById('modal-title-exp').innerText = 'Tambah Pengalaman Kerja';
    document.getElementById('form-pengalaman').reset();
    document.getElementById('exp_id').value = ''; 
    
    document.getElementById('modal-overlay-exp').style.display = 'block';
    document.getElementById('modal-pengalaman').style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  // Fungsi dipanggil saat tombol "Edit" (ikon pensil) diklik
  function editExperience(buttonElement) {
    const dataString = buttonElement.getAttribute('data-exp');
    const data = JSON.parse(dataString);

    document.getElementById('modal-title-exp').innerText = 'Edit Pengalaman Kerja';

    const form = document.getElementById('form-pengalaman');
    
    // Pemisahan string period "Jan 2022 - Sekarang" ke Start Date dan End Date
    let start = ""; let end = "";
    if(data.period) {
        const splitDate = data.period.split(' - ');
        start = splitDate[0] || '';
        end = splitDate[1] || '';
    }

    // Set value ke input form
    form.exp_id.value = data.id || '';
    form.company_name.value = data.company || '';
    form.job_title.value = data.title || '';
    
    // Auto-select jenis pekerjaan
    if(data.status) {
        let statusMap = { 'Full-time': 'Full-time', 'Internship': 'Internship', 'Part-time': 'Part-time' };
        form.employment_type.value = statusMap[data.status] || "";
    }

    form.start_date.value = start;
    form.end_date.value = end;
    
    // Checkbox aktif jika end date berbunyi 'Sekarang'
    form.currently_working.checked = (end.toLowerCase() === 'sekarang');

    form.description.value = data.description || '';

    // Tampilkan modal
    document.getElementById('modal-overlay-exp').style.display = 'block';
    document.getElementById('modal-pengalaman').style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  function closeModalExp() {
    document.getElementById('modal-overlay-exp').style.display = 'none';
    document.getElementById('modal-pengalaman').style.display = 'none';
    document.body.style.overflow = '';
    document.getElementById('form-pengalaman').reset();
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModalExp();
  });

  function submitExpForm(e) {
    e.preventDefault();
    const form = document.getElementById('form-pengalaman');
    
    const data = {
      id:                form.exp_id.value, 
      company_name:      form.company_name.value,
      job_title:         form.job_title.value,
      employment_type:   form.employment_type.value,
      start_date:        form.start_date.value,
      end_date:          form.end_date.value,
      currently_working: form.currently_working.checked,
      description:       form.description.value,
    };
    
    console.log('Data tersimpan:', data);
    
    const isEdit = data.id !== "";
    const message = isEdit ? 'Data Pengalaman berhasil diubah! (dummy)' : 'Data Pengalaman berhasil ditambahkan! (dummy)';
    
    alert(message);
    closeModalExp();
  }
</script>