<section class="hero">
  <div class="container">
    <h1>Dashboard Admin</h1>
    <p>Monitoring layanan masyarakat secara digital.</p>
  </div>
</section>

<div class="container">
  <div class="card">
    <div class="card-header">Pengajuan Surat</div>
    <div class="card-body">
      <div class="table-wrapper">
        <table class="table">
          <thead>
            <tr>
              <th>Warga</th>
              <th>Jenis</th>
              <th>Status</th>
              <th>Dokumen</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($requests)): ?>
              <tr><td colspan="5">Belum ada pengajuan.</td></tr>
            <?php else: ?>
              <?php foreach ($requests as $req): ?>
                <tr>
                  <td><?= htmlspecialchars($req['user_name']) ?></td>
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
                      <a target="_blank" href="<?= htmlspecialchars($req['document_url']) ?>">Lihat</a>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </td>
                  <td>
                    <form method="post" action="/admin/requests/update" class="flex gap-2">
                      <input type="hidden" name="id" value="<?= (int) $req['id'] ?>">
                      <select name="status" class="form-select">
                        <option <?= $req['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option <?= $req['status'] === 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                        <option <?= $req['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                        <option <?= $req['status'] === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                      </select>
                      <button class="btn btn-primary btn-sm">Update</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-header">Pengaduan Masyarakat</div>
    <div class="card-body">
      <div class="table-wrapper">
        <table class="table">
          <thead>
            <tr>
              <th>Warga</th>
              <th>Judul</th>
              <th>Status</th>
              <th>Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($complaints)): ?>
              <tr><td colspan="5">Belum ada pengaduan.</td></tr>
            <?php else: ?>
              <?php foreach ($complaints as $comp): ?>
                <tr>
                  <td><?= htmlspecialchars($comp['user_name']) ?></td>
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
                      <a target="_blank" href="<?= htmlspecialchars($comp['photo_url']) ?>">Lihat</a>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </td>
                  <td>
                    <form method="post" action="/admin/complaints/update" class="flex gap-2">
                      <input type="hidden" name="id" value="<?= (int) $comp['id'] ?>">
                      <select name="status" class="form-select">
                        <option <?= $comp['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option <?= $comp['status'] === 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                        <option <?= $comp['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                        <option <?= $comp['status'] === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                      </select>
                      <button class="btn btn-primary btn-sm">Update</button>
                    </form>
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
