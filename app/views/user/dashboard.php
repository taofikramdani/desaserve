<?php
use App\Helpers\Auth;

$previewImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$hasImagePreview = function (?string $url) use ($previewImageExtensions): bool {
  if (!$url) {
    return false;
  }
  $path = parse_url($url, PHP_URL_PATH) ?: '';
  $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
  return in_array($ext, $previewImageExtensions, true);
};

$formatLabel = function (?string $url): string {
  if (!$url) {
    return '';
  }
  $path = parse_url($url, PHP_URL_PATH) ?: '';
  $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
  return $ext ? ' (' . strtoupper($ext) . ')' : '';
};
?>
<section class="hero">
  <div class="container">
    <h1>Dashboard Warga</h1>
    <p>Selamat datang, <?= htmlspecialchars(Auth::user()['name'] ?? '') ?>.</p>
  </div>
</section>

<div class="container">
  <div class="grid grid-cols-2">
    <div class="card">
      <div class="card-header">Pengajuan Surat</div>
      <div class="card-body">
        <a class="btn btn-outline mb-4" href="/requests/new" style="display:inline-block;">Ajukan Surat Baru</a>
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Jenis</th>
                <th>Status</th>
                <th>Dokumen</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($requests)): ?>
                <tr><td colspan="3">Belum ada pengajuan.</td></tr>
              <?php else: ?>
                <?php foreach ($requests as $req): ?>
                  <tr>
                    <td><?= htmlspecialchars($req['request_type']) ?></td>
                    <td>
                      <?php
                        $badgeClass = 'badge-gray';
                        if ($req['status'] === 'Selesai') $badgeClass = 'badge-success';
                        elseif ($req['status'] === 'Diproses') $badgeClass = 'badge-warning';
                        elseif ($req['status'] === 'Ditolak') $badgeClass = 'badge-danger';
                      ?>
                      <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($req['status']) ?></span>
                    </td>
                    <td>
                      <?php if ($req['document_url']): ?>
                        <?php if ($hasImagePreview($req['document_url'])): ?>
                          <a class="file-preview" target="_blank" href="<?= htmlspecialchars($req['document_url']) ?>">
                            <img src="<?= htmlspecialchars($req['document_url']) ?>" alt="Dokumen">
                            <span class="file-preview-label">Preview</span>
                          </a>
                        <?php else: ?>
                          <a class="file-chip" target="_blank" href="<?= htmlspecialchars($req['document_url']) ?>">Lihat<?= htmlspecialchars($formatLabel($req['document_url'])) ?></a>
                        <?php endif; ?>
                      <?php else: ?>
                        -
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">Pengaduan Masyarakat</div>
      <div class="card-body">
        <a class="btn btn-outline mb-4" href="/complaints/new" style="display:inline-block;">Kirim Pengaduan</a>
        <div class="table-wrapper">
          <table class="table">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Foto</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($complaints)): ?>
                <tr><td colspan="3">Belum ada pengaduan.</td></tr>
              <?php else: ?>
                <?php foreach ($complaints as $comp): ?>
                  <tr>
                    <td><?= htmlspecialchars($comp['title']) ?></td>
                    <td>
                      <?php
                        $badgeClass = 'badge-gray';
                        if ($comp['status'] === 'Selesai') $badgeClass = 'badge-success';
                        elseif ($comp['status'] === 'Diproses') $badgeClass = 'badge-warning';
                        elseif ($comp['status'] === 'Ditolak') $badgeClass = 'badge-danger';
                      ?>
                      <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($comp['status']) ?></span>
                    </td>
                    <td>
                      <?php if ($comp['photo_url']): ?>
                        <?php if ($hasImagePreview($comp['photo_url'])): ?>
                          <a class="file-preview" target="_blank" href="<?= htmlspecialchars($comp['photo_url']) ?>">
                            <img src="<?= htmlspecialchars($comp['photo_url']) ?>" alt="Foto bukti">
                            <span class="file-preview-label">Preview</span>
                          </a>
                        <?php else: ?>
                          <a class="file-chip" target="_blank" href="<?= htmlspecialchars($comp['photo_url']) ?>">Lihat<?= htmlspecialchars($formatLabel($comp['photo_url'])) ?></a>
                        <?php endif; ?>
                      <?php else: ?>
                        -
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
