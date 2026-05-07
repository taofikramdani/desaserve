<section class="hero">
  <div class="container">
    <h1>Login Admin Desa</h1>
    <p>Kelola permohonan dan pengaduan warga.</p>
  </div>
</section>

<div class="container">
  <div class="auth-wrapper">
    <div class="card">
      <div class="card-body">
        <form method="post" action="/admin/login">
          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" required>
          </div>
          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" required>
          </div>
          <button class="btn btn-primary btn-block">Login Admin</button>
        </form>
      </div>
    </div>
  </div>
</div>
