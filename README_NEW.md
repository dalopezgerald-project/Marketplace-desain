# Marketplace Jasa Desain Grafis - DesignHub ✨

Platform marketplace modern untuk menjual dan membeli jasa desain grafis. Dengan sistem role-based yang komprehensif (Admin, Desainer, User), payment gateway integration, dan notification system.

**Status**: ✅ Production Ready | **Version**: 1.0 | **Last Updated**: January 9, 2026

---

## 📋 Daftar Isi
- [Fitur Utama](#-fitur-utama)
- [Persyaratan Proyek](#-persyaratan-proyek-memenuhi-semua)
- [Teknologi](#-teknologi)
- [Instalasi](#-instalasi)
- [Cara Menggunakan](#-cara-menggunakan)
- [Dokumentasi](#-dokumentasi)

---

## 🚀 Fitur Utama

### ✅ Persyaratan Teknis Wajib (TERPENUHI SEMUA)

#### 1️⃣ **CRUD Operations** ✅
- **Services**: Create (desainer), Read (public), Update (approval), Delete (desainer)
- **Orders**: Create (user), Read (all roles), Update (status)
- **Users**: Create, Read, Update, Delete (admin only)
- **Messages**: Send, Read, Mark as read

#### 2️⃣ **Autentikasi** ✅
- Login & Register lengkap
- Password hashing aman
- Session management

#### 3️⃣ **Multi-Role System** ✅
- **Admin**: Kelola user, service approval, order monitoring
- **Desainer**: Kelola jasa, lihat pesanan, update approval
- **User**: Browse jasa, pesan, lihat history

#### 4️⃣ **API Integration** ✅
- **Midtrans Payment Gateway** (Production-ready)
- Support: Transfer Bank, Kartu Kredit, E-Wallet
- Transaction tracking & verification

#### 5️⃣ **Database Relasional** ✅
- **MySQL** dengan proper relationships
- Foreign keys & constraints
- 21+ dummy data entries

#### 6️⃣ **Responsive Design** ✅
- Bootstrap 5 + Tailwind CSS
- Mobile-first approach
- Modern gradient UI

---

## 🛠️ Teknologi

| Kategori | Tools |
|----------|-------|
| **Backend** | Laravel 12, PHP 8.2+ |
| **Frontend** | Blade, Bootstrap 5, Tailwind CSS |
| **Database** | MySQL 5.7+ |
| **Asset** | Vite, NPM |
| **Payment** | Midtrans API |

---

## ⚡ Instalasi

### Prerequisites
```
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL 5.7+
- XAMPP (recommended)
```

### Step-by-Step

#### 1. Clone Repository
```bash
git clone <repository-url>
cd marketplace-desain
```

#### 2. Install Dependencies
```bash
composer install
npm install
```

#### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

#### 4. Database Configuration
Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marketplace_desain
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Run Migrations & Seeding
```bash
php artisan migrate:fresh --seed
```

#### 6. Build Assets
```bash
npm run build
```

#### 7. Start Application
```bash
php artisan serve
# Akses: http://127.0.0.1:8000
```

---

## 👥 Test Credentials

### Admin
```
Email: admin@example.com
Password: password
```

### Desainer
```
Email: desainer1@example.com
Password: password
```

### Regular User
```
Email: user1@example.com
Password: password
```

---

## 🎯 Cara Menggunakan

### Untuk User (Pembeli)
1. Register & Login
2. Lihat daftar jasa di "Browse Jasa"
3. Klik jasa yang diinginkan
4. Klik "Pesan Sekarang"
5. Lanjut ke pembayaran
6. Lihat status pesanan di "Riwayat Order"

### Untuk Desainer
1. Register dengan role "Desainer"
2. Buat jasa baru via "Tambah Jasa"
3. Tunggu approval dari admin
4. Kelola pesanan di "Order Masuk"
5. Chat dengan admin jika ingin update jasa

### Untuk Admin
1. Login sebagai admin
2. Dashboard: Lihat statistik & pending approvals
3. Kelola jasa: Approve/Reject jasa desainer
4. Kelola user: CRUD user accounts
5. Kelola order: Monitor semua pesanan

---

## 📚 Dokumentasi

Dokumentasi lengkap tersedia di:
- **[TECHNICAL_DOCUMENTATION.md](TECHNICAL_DOCUMENTATION.md)** - Dokumentasi teknis detail
- **Routes**: `/routes/web.php`
- **Models**: `/app/Models/`
- **Controllers**: `/app/Http/Controllers/`

---

## 📊 Project Statistics

| Metric | Value |
|--------|-------|
| **Total Users (Dummy)** | 11 |
| **Total Services** | 21 |
| **Total Orders** | 10+ |
| **Controllers** | 8+ |
| **Models** | 6 |
| **Migrations** | 10+ |

---

## 📝 License

Open source untuk keperluan education.

**Last Updated**: January 9, 2026 | **Version**: 1.0 | **Status**: Production Ready ✅
