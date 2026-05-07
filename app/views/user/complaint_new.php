<div class="container mt-4">
  <div class="auth-wrapper">
    <div class="card">
      <div class="card-header">Form Pengaduan</div>
      <div class="card-body">
        <form method="post" action="/complaints/new" enctype="multipart/form-data">
          <div class="form-group">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-input" required>
          </div>
          <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-textarea" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label class="form-label">Upload Foto Bukti</label>
            <input type="file" name="photo" class="form-input">
          </div>
          <button class="btn btn-primary btn-block">Kirim Pengaduan</button>
        </form>
      </div>
    </div>
  </div>
</div>
