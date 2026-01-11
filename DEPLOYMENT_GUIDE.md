# 🚀 Panduan Deployment - Marketplace DesignHub

## Ringkasan
Panduan ini akan membantu Anda melakukan deployment marketplace DesignHub agar dapat diakses oleh semua orang secara publik.

## Opsi Deployment

### Opsi 1: Heroku (Direkomendasikan - Gratis & Mudah)
Heroku menyediakan hosting gratis untuk aplikasi kecil dengan SSL otomatis.

### Opsi 2: DigitalOcean App Platform
Layanan berbayar dengan performa lebih baik.

### Opsi 3: Railway
Platform hosting modern dengan free tier.

---

## 🚀 Deploy ke Heroku

### Prasyarat
- Heroku CLI terinstall
- Repository Git
- Akun Heroku

### Langkah 1: Persiapan Deployment

#### 1.1 Update composer.json untuk Heroku
```json
{
    "scripts": {
        "post-install-cmd": [
            "php artisan migrate --force",
            "php artisan db:seed --force"
        ]
    }
}
```

#### 1.2 Buat Procfile
```
web: vendor/bin/heroku-php-apache2 public/
```

#### 1.3 Update .env untuk production
```
APP_NAME=DesignHub
APP_ENV=production
APP_KEY=base64:your-key-here
APP_DEBUG=false
APP_URL=https://your-app-name.herokuapp.com

DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password

# Tambahkan konfigurasi production lainnya...
```

### Langkah 2: Deploy

#### 2.1 Buat Aplikasi Heroku
```bash
heroku create your-app-name
```

#### 2.2 Tambah Database
```bash
heroku addons:create heroku:mysql
```

#### 2.3 Push ke Heroku
```bash
git push heroku main
```

#### 2.4 Jalankan Migrations
```bash
heroku run php artisan migrate:fresh --seed
```

#### 2.5 Set Environment Variables
```bash
heroku config:set APP_KEY=$(php artisan key:generate --show)
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
```

### Langkah 3: Akses Aplikasi Anda
Aplikasi Anda akan tersedia di: `https://your-app-name.herokuapp.com`

---

## 🔧 Konfigurasi Manual

### Setup Database
1. Buat database MySQL di penyedia hosting
2. Update .env dengan kredensial database production
3. Jalankan migrations: `php artisan migrate:fresh --seed`

### Konfigurasi Environment
```env
APP_NAME=DesignHub
APP_ENV=production
APP_KEY=base64:generated-key
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=your-host
DB_DATABASE=your-db
DB_USERNAME=your-user
DB_PASSWORD=your-pass

# Mail (opsional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-app-password

# Payment (Midtrans)
MIDTRANS_SERVER_KEY=your-server-key
MIDTRANS_CLIENT_KEY=your-client-key
MIDTRANS_MERCHANT_ID=your-merchant-id
```

### Sertifikat SSL
- Heroku: SSL Otomatis
- Hosting lain: Gunakan Let's Encrypt atau SSL dari penyedia

---

## 🧪 Testing Deployment

### Checklist
- [ ] Homepage dimuat
- [ ] Registrasi berfungsi
- [ ] Login berfungsi
- [ ] Jasa ditampilkan
- [ ] Pesanan dapat ditempatkan
- [ ] Panel admin dapat diakses
- [ ] HTTPS aktif
- [ ] Tidak ada peringatan mixed content

### Kredensial Test
```
Admin: admin@example.com / password
Desainer: desainer1@example.com / password
User: user1@example.com / password
```

---

## 🔍 Troubleshooting

### Masalah Umum

**Aplikasi tidak dimuat:**
```bash
heroku logs --tail
```

**Error koneksi database:**
- Periksa kredensial database di config Heroku
- Pastikan database dapat diakses

**Assets tidak dimuat:**
```bash
npm run build
git add .
git commit -m "Build assets"
git push heroku main
```

**Error migration:**
```bash
heroku run php artisan migrate:reset
heroku run php artisan migrate
heroku run php artisan db:seed
```

---

## 📊 Optimasi Performa

### Untuk Production
1. Aktifkan caching: `php artisan config:cache`
2. Aktifkan route caching: `php artisan route:cache`
3. Aktifkan view caching: `php artisan view:cache`
4. Setup CDN untuk assets (opsional)

### Monitoring
- Periksa metrics Heroku
- Monitor performa database
- Setup error logging

---

## 💰 Estimasi Biaya

### Heroku (Free Tier)
- App: Gratis
- Database: $5-10/bulan
- Domain: $12/tahun (opsional)

### Total: ~$17/tahun untuk setup basic

---

## 🎯 Langkah Selanjutnya

1. Pilih platform hosting
2. Setup database production
3. Konfigurasi environment variables
4. Deploy aplikasi
5. Test semua fitur
6. Setup custom domain (opsional)
7. Aktifkan monitoring

---

**Butuh Bantuan?** Periksa logs dan dokumentasi untuk troubleshooting.
