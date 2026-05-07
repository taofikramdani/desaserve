<?php

use App\Helpers\Auth;
use App\Helpers\Flash;
use function App\Helpers\asset_url;

$flash = Flash::get();
$authUser = Auth::user();
$content = $content ?? '';
$hideSidebar = $hideSidebar ?? false;
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars(getenv('APP_NAME') ?: 'SimPeDes') ?></title>
  <link href="<?= asset_url('css/style.css') ?>" rel="stylesheet">
</head>
<body>
<div class="app-container<?= $hideSidebar ? ' no-sidebar' : '' ?>">
  
  <?php if (!$hideSidebar): ?>
    <!-- Mobile Header (Hidden on Desktop) -->
    <div class="mobile-header">
      <a class="brand" href="/">
        <span class="brand-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l8 4v6c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V7l8-4z" />
          </svg>
        </span>
        <span class="brand-text">
          <span class="brand-title">SimPeDes</span>
          <span class="brand-subtitle">Sistem Pelayanan Desa</span>
        </span>
      </a>
      <button id="menu-btn" class="menu-btn" aria-label="Open menu">
        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>

    <aside class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <a class="brand" href="/">
          <span class="brand-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l8 4v6c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V7l8-4z" />
            </svg>
          </span>
          <span class="brand-text">
            <span class="brand-title">SimPeDes</span>
            <span class="brand-subtitle">Sistem Pelayanan Desa</span>
          </span>
        </a>
        <button id="close-btn" class="close-btn" aria-label="Close menu">
          <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      
      <div class="sidebar-body">
        <ul class="nav-links">
          <?php if ($authUser && Auth::isAdmin()): ?>
            <li>
              <a class="nav-link" href="/admin">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10h14V10" />
                </svg>
                Dashboard Admin
              </a>
            </li>
            <li>
              <a class="nav-link" href="/logout">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l5-5-5-5M21 12H9M12 19H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h7" />
                </svg>
                Logout
              </a>
            </li>
          <?php elseif ($authUser): ?>
            <li>
              <a class="nav-link" href="/dashboard">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10h14V10" />
                </svg>
                Dashboard
              </a>
            </li>
            <li>
              <a class="nav-link" href="/requests/new">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2H6a2 2 0 0 0-2 2v16l4-4h10a2 2 0 0 0 2-2V8z" />
                </svg>
                Ajukan Surat
              </a>
            </li>
            <li>
              <a class="nav-link" href="/complaints/new">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M9 8h6M5 4h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H7l-4 4V6a2 2 0 0 1 2-2z" />
                </svg>
                Pengaduan
              </a>
            </li>
            <li>
              <a class="nav-link" href="/logout">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l5-5-5-5M21 12H9M12 19H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h7" />
                </svg>
                Logout
              </a>
            </li>
          <?php else: ?>
            <li>
              <a class="nav-link" href="/login">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l5-5-5-5M21 12H9M12 19H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h7" />
                </svg>
                Login
              </a>
            </li>
            <li>
              <a class="nav-link" href="/register">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M12 7a4 4 0 1 0-8 0 4 4 0 0 0 8 0zM20 8v6M23 11h-6" />
                </svg>
                Register
              </a>
            </li>
            <li>
              <a class="nav-link" href="/admin/login">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l8 4v6c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V7l8-4z" />
                </svg>
                Admin
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </aside>
  <?php endif; ?>

  <main class="main-content">
    <?php if ($flash): ?>
      <div class="container pb-0" style="padding-bottom: 0;">
        <div class="alert alert-<?= htmlspecialchars($flash['type'] === 'danger' ? 'error' : $flash['type']) ?>">
          <?= htmlspecialchars($flash['message']) ?>
        </div>
      </div>
    <?php endif; ?>

    <?= $content ?>
  </main>
</div>

<script src="<?= asset_url('js/app.js') ?>"></script>
<?php if (!$hideSidebar): ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.getElementById('sidebar');
      const menuBtn = document.getElementById('menu-btn');
      const closeBtn = document.getElementById('close-btn');

      if (menuBtn && closeBtn && sidebar) {
        menuBtn.addEventListener('click', () => {
          sidebar.classList.add('active');
        });
        closeBtn.addEventListener('click', () => {
          sidebar.classList.remove('active');
        });
      }
    });
  </script>
<?php endif; ?>
</body>
</html>
