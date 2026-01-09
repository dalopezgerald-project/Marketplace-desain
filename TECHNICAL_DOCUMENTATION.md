# DOKUMENTASI TEKNIS - MARKETPLACE JASA DESAIN GRAFIS (DesignHub)

## 📋 Daftar Isi
1. [Arsitektur Sistem](#arsitektur-sistem)
2. [Database Schema](#database-schema)
3. [API Integration](#api-integration)
4. [Features & Modules](#features--modules)
5. [Installation Guide](#installation-guide)
6. [API Documentation](#api-documentation)
7. [Testing](#testing)

---

## 🏗️ Arsitektur Sistem

### Technology Stack
- **Backend Framework**: Laravel 12
- **Frontend**: Blade Template + Bootstrap 5 + Tailwind CSS
- **Database**: MySQL
- **Asset Compiler**: Vite
- **Authentication**: Laravel Auth
- **Payment Gateway**: Midtrans API Integration

### Folder Structure
```
marketplace-desain/
├── app/
│   ├── Http/Controllers/     # Application Controllers
│   ├── Models/               # Eloquent Models
│   ├── Notifications/        # Notification Classes
│   └── Providers/           # Service Providers
├── database/
│   ├── migrations/          # Database Migrations
│   └── seeders/            # Database Seeders
├── resources/
│   ├── css/                # CSS Files
│   ├── js/                 # JavaScript Files
│   └── views/              # Blade Templates
├── routes/
│   └── web.php            # Web Routes
└── storage/               # File Storage
```

---

## 🗄️ Database Schema

### Tables

#### 1. **users**
```sql
- id (PK)
- name (string)
- email (string, unique)
- email_verified_at (timestamp)
- password (string)
- role (enum: 'admin', 'desainer', 'user')
- remember_token (string)
- timestamps
```

#### 2. **services**
```sql
- id (PK)
- designer_id (FK -> users.id)
- title (string)
- description (text)
- price (integer)
- image (string, nullable)
- status (enum: 'pending', 'approved', 'rejected')
- update_status (enum: 'none', 'pending_update', 'update_approved', 'update_rejected')
- update_reason (text, nullable)
- timestamps
```

#### 3. **orders**
```sql
- id (PK)
- user_id (FK -> users.id)
- service_id (FK -> services.id)
- status (enum: 'menunggu', 'diproses', 'selesai', 'dibatalkan')
- payment_method (string, nullable: 'transfer', 'card', 'ewallet')
- payment_status (string: 'unpaid', 'pending', 'paid', 'failed')
- transaction_id (string, unique, nullable)
- timestamps
```

#### 4. **messages**
```sql
- id (PK)
- from_user_id (FK -> users.id)
- to_user_id (FK -> users.id)
- service_id (FK -> services.id, nullable)
- message (text)
- type (enum: 'general', 'update_request', 'notification')
- read (boolean)
- timestamps
```

#### 5. **categories** (Reserved for future use)
```sql
- id (PK)
- name (string)
- description (text)
- timestamps
```

### Relationships
```
User
├── services (hasMany)
├── orders (hasMany)
├── sentMessages (hasMany) -> messages.from_user_id
└── receivedMessages (hasMany) -> messages.to_user_id

Service
├── designer (belongsTo User)
├── orders (hasMany)
├── category (belongsTo Category)
└── messages (hasMany)

Order
├── user (belongsTo User)
├── service (belongsTo Service)
└── messages (hasMany)

Message
├── fromUser (belongsTo User)
├── toUser (belongsTo User)
└── service (belongsTo Service)
```

---

## 🔗 API Integration

### Midtrans Payment Gateway Integration

#### Configuration
- **API Endpoint**: `https://app.midtrans.com/snap/snap.js`
- **Documentation**: https://docs.midtrans.com/

#### Implementation Details
**File**: `app/Http/Controllers/Payment/PaymentController.php`

**Methods**:
1. **checkout($orderId)** - Display checkout form
2. **process(Request, $orderId)** - Process payment request
3. **verify(Request)** - Verify payment callback from Midtrans
4. **createMidtransTransaction()** - Create transaction in Midtrans

#### Example Usage
```php
// Checkout page
GET /payment/checkout/{order}

// Process payment
POST /payment/process/{order}
Parameters:
  - payment_method: 'transfer' | 'card' | 'ewallet'

// Webhook verification (from Midtrans)
POST /payment/verify
```

#### API Response Example
```json
{
  "transaction_id": "TRX-1704816000-5",
  "status": "pending",
  "amount": 50000,
  "payment_method": "transfer",
  "snap_url": "https://app.midtrans.com/snap/snap.js"
}
```

---

## 📦 Features & Modules

### 1. Authentication & Authorization
- **Login/Register**: Standard Laravel Auth
- **Roles**: Admin, Desainer, User
- **Middleware**: `auth`, role-based access control

### 2. CRUD Operations

#### Services (Jasa)
- **Create**: Desainer can create new services
- **Read**: Public listing for approved services
- **Update**: With approval system for approved services
- **Delete**: Only by desainer (before approval)

#### Orders (Pesanan)
- **Create**: User can place order on approved service
- **Read**: User can view own orders, Desainer can view incoming orders
- **Update**: Status updates (menunggu → diproses → selesai)
- **Delete**: Not allowed

#### Users (Admin Panel)
- **Create**: Admin creates new users
- **Read**: Admin can view all users
- **Update**: Admin can update user details and role
- **Delete**: Admin can delete users

### 3. Notification System

#### Message Types
1. **General**: Regular chat messages
2. **Update Request**: Service update request notification
3. **Notification**: System notifications

#### Message Flow
```
Desainer Update Approved Service
    ↓
Sends update request to Admin
    ↓
Admin reviews and approves/rejects
    ↓
Desainer receives notification
```

### 4. Payment System
- **Methods**: Bank Transfer, Credit Card, E-Wallet
- **Integration**: Midtrans
- **Status Tracking**: unpaid → pending → paid/failed

### 5. Service Update Approval
- Approved services can be updated but require admin approval
- Creates update request notification
- Admin can approve or reject with reason
- Desainer notified of approval/rejection

---

## 🚀 Installation Guide

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL 5.7+
- XAMPP (for development)

### Steps

1. **Clone Repository**
```bash
git clone <repository-url>
cd marketplace-desain
```

2. **Install PHP Dependencies**
```bash
composer install
```

3. **Install Node Dependencies**
```bash
npm install
```

4. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Database Configuration** (in .env)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marketplace_desain
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run Migrations & Seeding**
```bash
php artisan migrate:fresh --seed
```

7. **Build Assets**
```bash
npm run build
```

8. **Start Development Server**
```bash
php artisan serve
# or use XAMPP and access: http://localhost/marketplace-desain/public
```

### Dummy Credentials
```
Admin:
  Email: admin@example.com
  Password: password

Desainer 1:
  Email: desainer1@example.com
  Password: password

User 1:
  Email: user1@example.com
  Password: password
```

---

## 📡 API Documentation

### Authentication
All endpoints require authentication except `/` and `/login`

### Public Routes
```
GET /                                    - Homepage
GET/POST /register                       - Register
GET/POST /login                          - Login
```

### User Routes (Authenticated)
```
GET  /services                           - Browse approved services
GET  /service/{id}                       - View service detail
POST /service/{id}/order                 - Place order
GET  /order-history                      - View user's orders
```

### Desainer Routes (Authenticated)
```
GET    /desainer/services                - List user's services
GET    /desainer/services/create         - Create service form
POST   /desainer/services                - Store new service
GET    /desainer/services/{id}/edit      - Edit service form
PUT    /desainer/services/{id}           - Update service
DELETE /desainer/services/{id}           - Delete service
GET    /desainer/orders                  - View incoming orders
POST   /order/{id}/status/{status}       - Update order status
```

### Admin Routes (Authenticated)
```
GET    /admin/dashboard                  - Admin dashboard
GET    /admin/services                   - Manage services
POST   /admin/service/{id}/approve       - Approve service
POST   /admin/service/{id}/reject        - Reject service
POST   /admin/service/{id}/approve-update   - Approve update
POST   /admin/service/{id}/reject-update    - Reject update
GET    /admin/users                      - Manage users
POST   /admin/users                      - Create user
PUT    /admin/users/{id}                 - Update user
DELETE /admin/users/{id}                 - Delete user
GET    /admin/orders                     - Manage orders
```

### Message Routes (Authenticated)
```
GET  /messages                           - View all messages
GET  /messages/{userId}                  - View conversation
POST /messages                           - Send message
POST /messages/{message}/read            - Mark as read
GET  /messages/unread/count              - Get unread count
```

### Payment Routes (Authenticated)
```
GET  /payment/checkout/{order}           - Checkout page
POST /payment/process/{order}            - Process payment
POST /payment/verify                     - Payment verification
```

---

## 🧪 Testing

### Unit Tests
```bash
php artisan test
```

### Manual Testing Checklist

#### Authentication
- [ ] Register new user
- [ ] Login with correct credentials
- [ ] Login fails with wrong credentials
- [ ] Logout clears session

#### CRUD - Services
- [ ] Desainer can create service
- [ ] Service status: pending → approved
- [ ] Desainer can edit pending service
- [ ] Approved service requires update approval
- [ ] Admin can approve/reject service
- [ ] Service deleted when rejected

#### CRUD - Orders
- [ ] User can place order
- [ ] Desainer can view incoming orders
- [ ] Order status updates correctly
- [ ] User can see order history

#### CRUD - Users (Admin)
- [ ] Admin create new user
- [ ] Admin update user role
- [ ] Admin delete user

#### Messages & Notifications
- [ ] Send message to user
- [ ] Receive notification for service update
- [ ] Mark message as read
- [ ] View conversation history

#### Payment
- [ ] Display checkout page
- [ ] Process payment (simulated)
- [ ] Display success page
- [ ] Order status updates to 'diproses'

---

## 📊 Dummy Data Summary

### Created During Seeding
- **Users**: 11 (1 admin, 5 desainer, 5 regular user)
- **Services**: 21 (17 approved, 1 pending, 3 others)
- **Orders**: 10
- **Messages**: 0 (can be created through app)

---

## 🔒 Security Features

1. **Authentication**: Laravel Auth with password hashing
2. **Authorization**: Role-based middleware
3. **CSRF Protection**: Token validation on forms
4. **SQL Injection**: Eloquent ORM prevents SQL injection
5. **XSS Protection**: Blade template escaping
6. **Payment Security**: Transaction ID validation

---

## 📈 Performance Optimization

1. **Database**: Indexed foreign keys and status columns
2. **Caching**: Laravel cache for frequent queries
3. **Asset Compression**: Vite asset bundling
4. **Pagination**: Implement for large datasets

---

## 🐛 Troubleshooting

### Common Issues

**Migration Error**
```bash
# Clear all and restart
php artisan migrate:refresh --seed
```

**Composer/NPM Issues**
```bash
composer update
npm update
```

**File Permission Error**
```bash
chmod -R 777 storage bootstrap/cache
```

**Database Connection Error**
- Check .env DB_* settings
- Ensure MySQL is running
- Verify database exists

---

## 📝 License
This project is open source and available for educational purposes.

---

**Last Updated**: January 9, 2026  
**Version**: 1.0  
**Author**: Development Team
