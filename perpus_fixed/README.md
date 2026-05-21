# 📚 Perpustakaan Digital — Laravel + Docker

## Tech Stack
- **PHP 8.2** + **Laravel 11**
- **MySQL 8.0**
- **Nginx** (webserver)
- **phpMyAdmin** (database GUI)
- **Docker Compose**

---

## 🚀 Cara Menjalankan (Pertama Kali)

### 1. Clone / copy project ini, lalu masuk foldernya
```bash
cd perpustakaan
```

### 2. Copy file .env
```bash
cp .env.example .env
```

### 3. Build & jalankan Docker
```bash
docker-compose up -d --build
```
*Tunggu 2-3 menit untuk download image pertama kali.*

### 4. Install dependencies PHP
```bash
docker-compose exec app composer install
```

### 5. Generate app key
```bash
docker-compose exec app php artisan key:generate
```

### 6. Buat symlink storage
```bash
docker-compose exec app php artisan storage:link
```

### 7. Jalankan migrasi + seeder
```bash
docker-compose exec app php artisan migrate --seed
```

---

## 🌐 Akses Aplikasi

| URL | Keterangan |
|-----|-----------|
| http://localhost:8080 | Aplikasi Perpustakaan |
| http://localhost:8081 | phpMyAdmin |

## 🔑 Akun Demo

| Role | Email | Password |
|------|-------|---------|
| Admin | admin@perpus.com | password |
| Petugas | petugas@perpus.com | password |
| User | budi@example.com | password |

---

## 🔄 Perintah Sehari-hari

```bash
# Nyalain
docker-compose up -d

# Matikan
docker-compose down

# Lihat log
docker-compose logs -f app

# Masuk ke container
docker-compose exec app bash

# Artisan command
docker-compose exec app php artisan migrate
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
```

---

## 📁 Struktur Fitur

### Admin / Petugas
- ✅ Dashboard dengan grafik & statistik
- ✅ CRUD Buku (dengan upload cover)
- ✅ CRUD Kategori
- ✅ Manajemen User & Petugas
- ✅ Approve/Tolak Peminjaman
- ✅ Approve/Tolak Pengembalian
- ✅ Kelola Ulasan
- ✅ Generate Laporan (PDF)

### User
- ✅ Register dengan validasi kota
- ✅ Dashboard + search buku
- ✅ Browse buku dengan filter kategori
- ✅ Detail buku + form pinjam (popup)
- ✅ Profil + riwayat pinjam
- ✅ Ajukan pengembalian
- ✅ Beri ulasan setelah dikembalikan
- ✅ Koleksi pribadi
- ✅ Cetak bukti pinjam & bukti kembali

---

## 🔧 Troubleshooting

```bash
# Permission error storage
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage

# Reset database
docker-compose exec app php artisan migrate:fresh --seed

# Container tidak mau start
docker-compose down -v
docker-compose up -d --build
```

## Setup Tambahan (Wajib)

```bash
# Jalankan setelah composer install
php artisan storage:link
php artisan migrate --seed
composer require barryvdh/laravel-dompdf
```

## Akun Default Seeder

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@perpus.com | password |
| Petugas | petugas@perpus.com | password |
| User | budi@example.com | password |
