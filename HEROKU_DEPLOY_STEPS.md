# 🚀 Panduan Deploy ke Heroku - Step by Step

## 📋 Daftar Isi
1. [Persiapan](#-persiapan)
2. [Install Heroku CLI](#-install-heroku-cli)
3. [Setup Akun Heroku](#-setup-akun-heroku)
4. [Persiapan Proyek](#-persiapan-proyek)
5. [Deploy Aplikasi](#-deploy-aplikasi)
6. [Setup Database](#-setup-database)
7. [Konfigurasi Environment](#-konfigurasi-environment)
8. [Testing & Verifikasi](#-testing--verifikasi)
9. [Troubleshooting](#-troubleshooting)

---

## 🔧 Persiapan

### Yang Anda Butuhkan:
- ✅ Akun GitHub (untuk push code)
- ✅ Akun Heroku (gratis)
- ✅ Heroku CLI terinstall
- ✅ Proyek Laravel sudah siap

### Estimasi Waktu: 30-45 menit

---

## 📥 Install Heroku CLI

### Windows:
1. Download dari: https://devcenter.heroku.com/articles/heroku-cli
2. Install executable file
3. Buka Command Prompt dan ketik: `heroku --version`

### macOS:
```bash
brew tap heroku/brew && brew install heroku
```

### Linux:
```bash
curl https://cli-assets.heroku.com/install.sh | sh
```

### Verifikasi Install:
```bash
heroku --version
# Output: heroku/8.x.x win32-x64 node-v16.x.x
```

---

## 👤 Setup Akun Heroku

### 1. Buat Akun Heroku
1. Kunjungi: https://www.heroku.com/
2. Klik "Sign Up" (gratis)
3. Verifikasi email Anda

### 2. Login ke Heroku CLI
```bash
heroku login
```
- Browser akan terbuka otomatis
- Login dengan akun Heroku Anda
- Kembali ke terminal

### 3. Verifikasi Login
```bash
heroku auth:whoami
# Output: nama-akun-anda@email.com
```

---

## 📦 Persiapan Proyek

### 1. Pastikan Git Repository
```bash
git status
# Jika belum ada repo:
git init
git add .
git commit -m "Initial commit for Heroku deployment"
```

### 2. Build Assets untuk Production
```bash
npm run build
git add .
git commit -m "Build assets for production"
```

### 3. Pastikan File yang Dibutuhkan Ada
- ✅ `Procfile` (sudah dibuat)
- ✅ `composer.json` (sudah diupdate)
- ✅ `.env.example` (template environment)

---

## 🚀 Deploy Aplikasi

### Langkah 1: Buat Aplikasi Heroku
```bash
heroku create nama-app-anda
# Contoh: heroku create designhub-marketplace
```

**Output:**
```
Creating designhub-marketplace... done
https://designhub-marketplace.herokuapp.com/ deployed to Heroku
```

### Langkah 2: Push ke Heroku
```bash
git push heroku main
```

**Proses ini akan:**
- Upload code ke Heroku
- Install dependencies PHP (composer install)
- Install dependencies Node.js (npm install)
- Build aplikasi
- Jalankan post-install scripts (migrasi database)

**Output yang Diharapkan:**
```
remote: Compressing source files... done.
remote: Building source:
remote:
remote: -----> PHP app detected
remote: -----> Installing dependencies...
remote: -----> Running 'composer install'...
remote: -----> Running 'npm install'...
remote: -----> Building assets...
remote: -----> Launching...
remote:        Released v1
remote:        https://designhub-marketplace.herokuapp.com/ deployed to Heroku
```

---

## 🗄️ Setup Database

### Langkah 1: Tambah MySQL Addon
```bash
heroku addons:create heroku:mysql
```

**Output:**
```
Creating heroku:mysql on designhub-marketplace... free
Created mysql-xxx-xxx as DATABASE_URL
```

### Langkah 2: Lihat Kredensial Database
```bash
heroku config
```

**Output:**
```
DATABASE_URL: mysql://username:password@host:port/database
```

---

## ⚙️ Konfigurasi Environment

### Langkah 1: Set Environment Variables
```bash
# Generate APP_KEY
heroku config:set APP_KEY=$(php artisan key:generate --show)

# Set production environment
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false

# Set app URL
heroku config:set APP_URL=https://nama-app-anda.herokuapp.com
```

### Langkah 2: Jalankan Migrations & Seed
```bash
heroku run php artisan migrate:fresh --seed
```

**Output:**
```
Running php artisan migrate:fresh --seed on designhub-marketplace... done
```

### Langkah 3: Verifikasi Database
```bash
heroku run php artisan tinker --execute="echo 'Database connected: ' . DB::connection()->getPdo() ? 'YES' : 'NO';"
```

---

## 🧪 Testing & Verifikasi

### Langkah 1: Buka Aplikasi
Kunjungi: `https://nama-app-anda.herokuapp.com`

### Langkah 2: Test Fitur Utama
- ✅ Homepage dimuat
- ✅ Registrasi berhasil
- ✅ Login berhasil
- ✅ Browse jasa
- ✅ Panel admin dapat diakses

### Langkah 3: Test Kredensial
```
Admin: admin@example.com / password
Desainer: desainer1@example.com / password
User: user1@example.com / password
```

### Langkah 4: Periksa SSL
- Lock icon hijau di browser
- URL dimulai dengan `https://`

---

## 🔍 Troubleshooting

### Masalah: Aplikasi Tidak Dimuat
```bash
heroku logs --tail
```
Cari error messages di log.

### Masalah: Database Connection Error
```bash
heroku config
# Pastikan DATABASE_URL ada
```

### Masalah: Assets Tidak Dimuat
```bash
npm run build
git add .
git commit -m "Rebuild assets"
git push heroku main
```

### Masalah: Migration Gagal
```bash
heroku run php artisan migrate:reset
heroku run php artisan migrate
heroku run php artisan db:seed
```

### Masalah: PHP Version
```bash
heroku run php --version
# Pastikan PHP 8.2+
```

---

## 📊 Monitoring & Maintenance

### Lihat Logs Real-time
```bash
heroku logs --tail --app nama-app-anda
```

### Restart Aplikasi
```bash
heroku restart
```

### Update Aplikasi
```bash
git add .
git commit -m "Update aplikasi"
git push heroku main
```

### Backup Database (Opsional)
```bash
heroku pg:backups:capture
```

---

## 💰 Biaya & Limits

### Heroku Free Tier:
- ✅ 550 jam/bulan (gratis)
- ✅ 1GB RAM
- ✅ Database 5MB (gratis)
- ❌ Sleep setelah 30 menit tidak aktif

### Upgrade ke Hobby Plan ($7/bulan):
- ✅ 24/7 uptime
- ✅ Database 10GB
- ✅ Custom domain

---

## 🎯 Checklist Final

- [ ] Heroku CLI terinstall
- [ ] Akun Heroku aktif
- [ ] Aplikasi berhasil di-deploy
- [ ] Database ter-setup
- [ ] Environment variables dikonfigurasi
- [ ] Migrations & seed berhasil
- [ ] Aplikasi dapat diakses via HTTPS
- [ ] Semua fitur berfungsi normal
- [ ] SSL certificate aktif

---

## 🎉 Selamat!

Aplikasi DesignHub Anda sekarang sudah live dan dapat diakses oleh semua orang di:
**https://nama-app-anda.herokuapp.com**

## 📞 Butuh Bantuan?

Jika ada masalah, kirim screenshot error atau output command yang bermasalah.

**Happy Deploying! 🚀**
