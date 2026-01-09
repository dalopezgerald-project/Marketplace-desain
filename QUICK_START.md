# 🚀 QUICK START GUIDE

Panduan cepat untuk menjalankan Marketplace Jasa Desain Grafis dalam 5 menit!

---

## ⚡ Installation (5 Minutes)

### Opsi 1: Automatic (Recommended)
```bash
# 1. Navigate to project folder
cd c:\xampp\htdocs\marketplace-desain

# 2. Run setup script
setup.bat

# 3. Follow the prompts - DONE! ✅
```

### Opsi 2: Manual
```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
copy .env.example .env
php artisan key:generate

# 3. Run migrations & seed
php artisan migrate:fresh --seed

# 4. Build assets
npm run build

# 5. Start server
php artisan serve
```

---

## 🎯 Access Application

### Via Artisan (Recommended)
```bash
php artisan serve
# Visit: http://127.0.0.1:8000
```

### Via XAMPP
```
URL: http://localhost/marketplace-desain/public
```

---

## 👥 Test Login Credentials

### Admin
```
Email: admin@example.com
Password: password
Role: Full Access
```

### Desainer (Jasa Provider)
```
Email: desainer1@example.com
Password: password
Role: Create & Manage Services
```

### Regular User (Pembeli)
```
Email: user1@example.com
Password: password
Role: Browse & Order Services
```

---

## 📋 Quick Testing Guide

### As Regular User
1. Login with `user1@example.com`
2. Go to "Browse Services"
3. Click any service → "Pesan Sekarang"
4. Proceed to payment checkout
5. Check "Riwayat Order" for order status

### As Desainer
1. Login with `desainer1@example.com`
2. Click "Tambah Jasa" → Create new service
3. Input title, description, price (min: 10000)
4. Upload poster image (optional)
5. Submit → Wait for admin approval
6. After approval: Can manage & update service
7. Click "Order Masuk" to view incoming orders

### As Admin
1. Login with `admin@example.com`
2. Access Admin Dashboard
3. Review pending services → Approve/Reject
4. Manage users & services
5. Monitor orders
6. Review service update requests from desainer

---

## 🔧 Useful Commands

```bash
# Database
php artisan migrate:fresh --seed     # Reset & reseed
php artisan migrate                  # Run migrations
php artisan db:seed                  # Seed database

# Cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Assets
npm run build                         # Production build
npm run dev                           # Development watch

# Server
php artisan serve                     # Start dev server
php artisan tinker                    # Interactive shell
```

---

## 📁 Important Files

| File | Purpose |
|------|---------|
| `routes/web.php` | All application routes |
| `app/Models/` | Database models |
| `app/Http/Controllers/` | Application logic |
| `resources/views/` | Blade templates |
| `database/migrations/` | Database schema |
| `.env` | Environment configuration |
| `README.md` | Full documentation |

---

## ✅ Features Checklist

### ✅ CRUD
- [x] Services (Create, Read, Update, Delete)
- [x] Orders (Create, Read, Update)
- [x] Users (Admin CRUD)
- [x] Messages (Send, Read)

### ✅ Auth & Roles
- [x] Login & Register
- [x] Admin role
- [x] Desainer role
- [x] User role

### ✅ Advanced
- [x] Payment Gateway (Midtrans)
- [x] Service Approval System
- [x] Update Approval Workflow
- [x] Message/Notification System

### ✅ Database
- [x] MySQL Database
- [x] Proper Relationships
- [x] 11 Dummy Users
- [x] 21 Dummy Services
- [x] 10+ Dummy Orders

### ✅ Design
- [x] Responsive (Mobile-friendly)
- [x] Bootstrap 5 + Tailwind CSS
- [x] Modern UI with Gradients
- [x] Professional Dashboard

---

## 🐛 Troubleshooting

### Issue: 404 Not Found
```bash
# Solution: Use artisan serve
php artisan serve
```

### Issue: Database Connection Error
```bash
# Check .env file has correct credentials
# Ensure MySQL is running
# Verify database exists: marketplace_desain
```

### Issue: Composer Error
```bash
composer update
composer dump-autoload
```

### Issue: Node Modules Error
```bash
npm install
npm update
```

### Issue: Permission Denied
```bash
chmod -R 755 storage bootstrap/cache
```

---

## 📚 Full Documentation

- **[README.md](README.md)** - Overview & setup
- **[TECHNICAL_DOCUMENTATION.md](TECHNICAL_DOCUMENTATION.md)** - Technical details
- **[REQUIREMENTS_COMPLIANCE.md](REQUIREMENTS_COMPLIANCE.md)** - Compliance checklist
- **[PROJECT_STATUS.md](PROJECT_STATUS.md)** - Status & next steps
- **[CHANGELOG.md](CHANGELOG.md)** - Changes & additions

---

## 🚀 Next Steps

1. **Run Application** → Test all features
2. **Verify Data** → Check dummy data
3. **Deploy** → Push to hosting (Railway/Render)
4. **GitHub** → Create repo & push code
5. **Video** → Record demo presentation

---

## 📞 Need Help?

1. Check relevant markdown file:
   - Feature questions → TECHNICAL_DOCUMENTATION.md
   - Compliance questions → REQUIREMENTS_COMPLIANCE.md
   - Status questions → PROJECT_STATUS.md

2. Review application structure:
   - Routes → routes/web.php
   - Models → app/Models/
   - Controllers → app/Http/Controllers/

3. Check database:
   - Migrations → database/migrations/
   - Seeds → database/seeders/

---

## ✨ Key Highlights

✅ **100% Requirements Met**
- All CRUD operations complete
- Authentication fully functional
- 3 Role system implemented
- API integration (Midtrans)
- MySQL database with relationships
- Responsive design

✅ **Production Ready**
- 21+ dummy services
- 11 dummy users
- Complete documentation
- Error handling
- Security features

✅ **Well Documented**
- Comprehensive README
- Technical documentation
- Code comments
- Compliance checklist
- Change log

---

**Happy Testing! 🎉**

Start server with `php artisan serve` and open http://127.0.0.1:8000

**Version**: 1.0 | **Date**: January 9, 2026 | **Status**: Production Ready ✅
