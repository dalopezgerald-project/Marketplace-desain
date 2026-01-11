# Marketplace Jasa Desain Grafis 

Proyek Laravel untuk marketplace jasa desain grafis dengan sistem role-based (Admin, Desainer, User).

## 🚀 Fitur Utama

### 👨‍💼 **Admin Dashboard**
- Kelola pengguna (CRUD)
- Kelola layanan/jasa (CRUD)
- Approve/Reject layanan desainer
- Kelola pesanan
- Statistik dashboard

### 🎨 **Desainer Dashboard**
- Buat dan kelola layanan/jasa
- Lihat pesanan yang masuk
- Update status pesanan
- Statistik personal

### 👤 **User Dashboard**
- Browse layanan/jasa
- Pesan layanan
- Lihat status pesanan

## 🛠️ Teknologi

- **Framework:** Laravel 12
- **Frontend:** Bootstrap 5 + Tailwind CSS
- **Database:** MySQL
- **Asset Compiler:** Vite
- **Authentication:** Laravel Sanctum

## 📋 Persyaratan Sistem

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL
- XAMPP (untuk development)

## ⚡ Instalasi & Setup

### 1. Clone Repository
```bash
git clone <repository-url>
cd marketplace-desain
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
```bash
# Create database di MySQL/XAMPP
# Update .env file dengan database credentials

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

### 5. Build Assets
```bash
# Build untuk production
npm run build

# Atau untuk development
npm run dev
```

## 🎯 Cara Menjalankan

### Development Server (Recommended)
```bash
php artisan serve --host=127.0.0.1 --port=8000
```
Akses: `http://127.0.0.1:8000`

### Via XAMPP
Pastikan Apache & MySQL running, lalu akses:
`http://localhost/marketplace-desain/public/`

## 👥 Test Users

| Email | Password | Role |
|-------|----------|------|
| admin@example.com | password | Admin |
| desainer1@example.com | password | Desainer |
| desainer2@example.com | password | Desainer |
| user@example.com | password | User |
| admin@test.com | password | Admin |
| desainer@test.com | password | Desainer |
| user@test.com | password | User |

## 📁 Struktur Proyek

```
marketplace-desain/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/
│   │   ├── Desainer/
│   │   └── User/
│   ├── Models/
│   └── Notifications/
├── resources/views/
│   ├── admin/
│   ├── desainer/
│   ├── user/
│   └── layouts/
├── routes/
│   └── web.php
├── database/
│   ├── migrations/
│   └── seeders/
└── public/
    └── build/
```

## 🔧 Commands Yang Berguna

```bash
# Clear cache
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate

# Create seeder
php artisan make:seeder UserSeeder

# Build assets
npm run build
npm run dev
```

## 🌐 Routes

### Public Routes
- `/` - Homepage
- `/login` - Login page
- `/register` - Register page
- `/services` - Browse services

### Protected Routes (Auth Required)
- `/dashboard` - Smart redirect based on role
- `/admin/*` - Admin routes
- `/desainer/*` - Desainer routes

## 📊 Database Schema

### Users Table
- id, name, email, password, role, email_verified_at, timestamps

### Categories Table
- id, name, description, timestamps

### Services Table
- id, title, description, price, category_id, user_id, status, timestamps

### Orders Table
- id, service_id, user_id, status, notes, timestamps

### Notifications Table
- id, type, notifiable_type, notifiable_id, data, read_at, timestamps

## 🔒 Security Features

- Role-based access control
- CSRF protection
- Password hashing
- Email verification (optional)
- Secure file uploads (future)

## 🎨 UI Features

- Responsive design (Bootstrap 5)
- Modern gradient themes
- Interactive components
- Professional dashboard layouts
- Toast notifications

## 📝 Development Notes

- Gunakan `php artisan make:*` untuk generate code
- Ikuti PSR-4 autoloading standards
- Gunakan Eloquent relationships
- Implement proper validation
- Test all features thoroughly

## 🐛 Troubleshooting

### Common Issues:

1. **404 Error**: Pastikan akses via `/public/` atau gunakan `php artisan serve`
2. **Permission Error**: `chmod -R 755 storage/ bootstrap/cache/`
3. **Database Error**: Cek .env database configuration
4. **Asset Error**: Run `npm run build`

### Debug Commands:
```bash
# Check routes
php artisan route:list

# Check config
php artisan config:list

# Clear all cache
php artisan optimize:clear
```

## 📞 Support

Untuk pertanyaan atau issues, silakan buat issue di repository atau hubungi developer.

---

**Happy Coding! 🎉**

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
#
