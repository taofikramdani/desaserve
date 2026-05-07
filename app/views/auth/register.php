<section class="hero hero-center">
  <div class="container">
    <div class="auth-brand">
      <div class="auth-brand-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l8 4v6c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V7l8-4z" />
        </svg>
      </div>
      <div class="auth-brand-text">
        <div class="auth-brand-title">SimPeDes</div>
        <div class="auth-brand-subtitle">Sistem Pelayanan Desa</div>
      </div>
    </div>
    <h1>Registrasi </h1>
    <p>Buat akun untuk akses layanan.</p>
  </div>
</section>

<div class="container">
  <div class="auth-wrapper">
    <div class="card">
      <div class="card-body">
        <form method="post" action="/register">
          <div class="form-group">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-input" required>
          </div>
          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" required>
          </div>
          <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" required>
          </div>
          <button class="btn btn-primary btn-block">Daftar</button>
        </form>
        <div class="text-center mt-4">
          <a href="/login">Sudah punya akun? Login</a>
        </div>
      </div>
    </div>
  </div>
</div>
