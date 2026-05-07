<div class="container mt-4">
  <div class="auth-wrapper">
    <div class="card">
      <div class="card-header">Form Pengajuan Surat</div>
      <div class="card-body">
        <form method="post" action="/requests/new" enctype="multipart/form-data">
          <div class="form-group">
            <label class="form-label">Jenis Surat</label>
            <select name="request_type" class="form-select" required>
              <option value="">Pilih jenis surat</option>
              <option value="Surat Domisili">Surat Domisili</option>
              <option value="Surat Usaha">Surat Usaha</option>
              <option value="Surat Pengantar Lainnya">Surat Pengantar Lainnya</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Keterangan</label>
            <textarea name="description" class="form-textarea" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label class="form-label">Upload Dokumen (KTP/KK)</label>
            <input type="file" name="document" class="form-input">
          </div>
          <button class="btn btn-primary btn-block">Kirim Pengajuan</button>
        </form>
      </div>
    </div>
  </div>
</div>
