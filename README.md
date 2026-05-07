# DesaServe (SimPeDes)

Aplikasi pelayanan publik desa/kelurahan berbasis web sederhana untuk pengajuan surat dan pengaduan masyarakat.

## Fitur
- Login/Register masyarakat
- Pengajuan surat (domisili, usaha, pengantar lain)
- Tracking status pengajuan (Pending, Diproses, Selesai, Ditolak)
- Pengaduan masyarakat dengan upload foto
- Upload dokumen pendukung ke S3
- Dashboard admin untuk verifikasi dan update status

## Stack
- Frontend: HTML + Bootstrap + Vanilla JS
- Backend: PHP Native
- DB: MySQL/MariaDB
- Storage: AWS S3
- Web Server: Apache
- Container: Docker

## Struktur Proyek (ringkas)
```
app/
  controllers/
  core/
  helpers/
  models/
  services/
  views/
config/
public/
sql/
.github/workflows/
```

## Menjalankan Lokal (Docker)
1. Salin env:
   - `cp .env.example .env`
2. Jalankan container:
   - `docker compose up --build`
3. Buka aplikasi:
   - `http://localhost:8080`

## Setup Database
- Jalankan schema:
  - `sql/schema.sql`
- Buat admin:
  1. Generate hash:
     - `php -r "echo password_hash('admin123', PASSWORD_BCRYPT);"`
  2. Insert:
     - `INSERT INTO users (name, email, password_hash, role) VALUES ('Admin Desa', 'admin@desaserve.id', '<HASH>', 'admin');`

## Konfigurasi S3
- Isi `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_REGION`, `AWS_S3_BUCKET`
- Opsional: `S3_PUBLIC_BASE_URL` atau `CLOUDFRONT_MEDIA_BASE_URL` untuk URL publik

## CloudFront (Static Assets)
- Atur `ASSET_BASE_URL` ke domain CloudFront jika ingin assets statis diambil dari CDN
  - Contoh: `ASSET_BASE_URL=https://dxxxxxxxx.cloudfront.net`

## Deploy ECS (Ringkas)
- Build image lewat GitHub Actions (lihat workflow)
- Push ke ECR
- Buat task definition + service ECS (Fargate) dengan port 80
- Set env vars dari `.env`

## CI/CD (GitHub Actions)
Workflow ada di `.github/workflows/ci-ecr.yml` untuk build dan push image ke ECR.
