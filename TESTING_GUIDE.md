# 🧪 Testing Guide - DesignHub Marketplace

Panduan lengkap untuk testing semua fitur yang telah diimplementasikan.

## 📋 Daftar Akun Default (Seeder)

Gunakan kredensial berikut untuk testing:

### Admin Account
- **Email**: `admin@example.com`
- **Password**: `password`

### Desainer Accounts
1. **Email**: `desainer1@example.com` | **Password**: `password`
2. **Email**: `desainer2@example.com` | **Password**: `password`
3. **Email**: `desainer3@example.com` | **Password**: `password`

### User Accounts
1. **Email**: `user1@example.com` | **Password**: `password`
2. **Email**: `user2@example.com` | **Password**: `password`

---

## ✅ Test Cases

### 1️⃣ IMAGE UPLOAD FIX (Desainer)
**Status**: ✅ FIXED

**Test Steps**:
1. Login sebagai `desainer1@example.com`
2. Klik **"Tambah Jasa"** di sidebar atau navbar
3. Isi form dengan data:
   - **Judul**: Desain Logo Modern
   - **Deskripsi**: Saya akan membuat logo modern untuk brand Anda
   - **Harga**: 50000
   - **Poster**: Upload file PNG/JPG dari komputer Anda
4. Klik **"Simpan & Ajukan Persetujuan"**

**Expected Result**:
- ✅ Form berhasil submit tanpa error
- ✅ File image terdeteksi sebagai mimes:png,jpeg,jpg,gif (bukan extensions)
- ✅ Jasa muncul di list dengan status "Menunggu"
- ✅ Success message: "Jasa berhasil diajukan, menunggu persetujuan admin"

---

### 2️⃣ DESAINER SERVICE ACTIONS (Fix 404 Error)
**Status**: ✅ FIXED

**Test Steps**:
1. Login sebagai `desainer1@example.com`
2. Masuk ke **"Jasa Saya"** (Desainer Dashboard)
3. Untuk jasa yang **BELUM DISETUJUI**:
   - Klik tombol **Edit** → Edit jasa
   - Klik tombol **Hapus** → Hapus dengan confirm modal
4. Untuk jasa yang **SUDAH DISETUJUI**:
   - Klik tombol **"Update (perlu approval)"** (warna warning/kuning)
   - Edit form dengan data baru
   - Submit → Sistem akan mengirim notifikasi ke admin untuk approval

**Expected Result**:
- ✅ Tidak ada error 404
- ✅ Edit form muncul dengan data jasa terkini
- ✅ Hapus berfungsi dengan confirm modal
- ✅ Update approved jasa menampilkan pesan: "Permintaan update jasa telah dikirim ke admin"

---

### 3️⃣ USER ORDER HISTORY & CART (User Role)
**Status**: ✅ IMPLEMENTED

**Test Steps**:
1. Login sebagai `user1@example.com`
2. Di navbar/top, lihat menu **"Pesanan Saya"** (shopping cart icon)
3. Klik menu tersebut untuk melihat order history
4. Lihat list semua pesanan dengan:
   - Order ID
   - Service title & Designer name
   - Price (Rp format)
   - Order status (Menunggu/Diproses/Selesai)
   - Order date
5. Klik tombol **"Lihat Detail"** untuk melihat detail lengkap order

**Expected Result**:
- ✅ Menu "Pesanan Saya" muncul di navbar (khusus user role)
- ✅ Page menampilkan semua orders user
- ✅ Setiap order menampilkan informasi lengkap
- ✅ Modal detail muncul saat klik tombol lihat **TANPA EFEK KEDAP-KEDIP**
- ✅ Status orders ditampilkan dengan badge berwarna:
  - Yellow (⚠️) = Menunggu
  - Blue (ℹ️) = Diproses  
  - Green (✓) = Selesai
  - Red (✗) = Dibatalkan

#### 3.1️⃣ USER ORDER CANCELLATION FEATURE
**Status**: ✅ NEWLY ADDED

**Test Steps**:
1. Login sebagai `user1@example.com`
2. Pergi ke **"Pesanan Saya"** (Order History)
3. Klik icon mata pada order dengan status **"Menunggu"** atau **"Diproses"**
4. Di modal detail, lihat tombol **"Batalkan Pesanan"** (hanya muncul untuk status yang bisa dibatalkan)
5. Klik tombol **"Batalkan Pesanan"**
6. Konfirmasi pembatalan di dialog konfirmasi
7. Refresh page atau kembali ke order history

**Expected Result**:
- ✅ Tombol "Batalkan Pesanan" **HANYA** muncul untuk order status "Menunggu" atau "Diproses"
- ✅ Tombol **TIDAK** muncul untuk order status "Selesai" atau "Dibatalkan"
- ✅ Konfirmasi dialog muncul sebelum pembatalan
- ✅ Setelah konfirmasi, status order berubah menjadi "Dibatalkan"
- ✅ Success message: "Pesanan berhasil dibatalkan."
- ✅ Jika coba batalkan order "Selesai": Error message "Pesanan tidak dapat dibatalkan karena sudah dalam proses atau sudah selesai."

---

### 4️⃣ MESSAGING SYSTEM (All Roles)
**Status**: ✅ IMPLEMENTED

**Test Steps**:

#### 4.1 Access Messages
1. Login dengan role apapun (Admin/Desainer/User)
2. Di navbar, lihat menu **"Pesan"** (comment icon)
3. Klik untuk membuka messaging system

**Expected Result**:
- ✅ Menu "Pesan" muncul di navbar untuk **SEMUA 3 ROLES** (Admin/Desainer/User)

#### 4.2 View Messages List
1. Buka menu **"Pesan"**
2. Lihat list semua conversations dengan:
   - Contact name (dari/ke siapa)
   - Message preview
   - Message type badge (Update Request/Notification)
   - Time relative (2m ago, 1h ago, dll)

**Expected Result**:
- ✅ Semua pesan terlihat dengan preview
- ✅ Unread messages ditandai dengan background light
- ✅ Badge menunjukkan tipe pesan

#### 4.3 Open Conversation
1. Klik satu message dari list
2. Lihat conversation history lengkap
3. Scroll up-down untuk melihat history chat
4. Messages akan auto-marked as read

**Expected Result**:
- ✅ Conversation page membuka
- ✅ Semua messages dalam conversation terlihat
- ✅ Messages terurut dari lama ke baru
- ✅ Unread messages auto-marked as read

---

### 5️⃣ SERVICE UPDATE APPROVAL WORKFLOW (Desainer & Admin)
**Status**: ✅ IMPLEMENTED

**Test Steps**:

#### Scenario: Desainer Update Service yang Sudah Approved

**Step 1: Lihat Jasa yang Approved (Desainer)**
1. Login sebagai `desainer1@example.com`
2. Masuk ke **"Jasa Saya"**
3. Cari jasa dengan status **"Disetujui"** (badge hijau)
4. Klik tombol **"Update (perlu approval)"** (warna kuning)

**Step 2: Edit Jasa**
1. Form edit terbuka dengan data saat ini
2. Alert muncul: "Jasa ini sudah disetujui admin. Perubahan akan memerlukan persetujuan admin kembali"
3. Edit beberapa field (contoh: ubah price dari Rp 50.000 → Rp 75.000)
4. Klik **"Simpan Perubahan"**

**Expected Result**:
- ✅ Form menerima update
- ✅ Success message: "Permintaan update jasa telah dikirim ke admin. Menunggu persetujuan."
- ✅ Notification message terkirim ke admin

**Step 3: Admin Approve/Reject Update (Admin)**
1. Login sebagai `admin@example.com`
2. Masuk ke **Admin Dashboard**
3. Scroll ke bawah, lihat section **"Pending Service Updates"**
4. Lihat jasa dengan status "Update Pending"
5. Klik **"Approve Update"** atau **"Reject Update"**

**Expected Result**:
- ✅ Section "Pending Service Updates" muncul di dashboard dengan badge jumlah
- ✅ List menampilkan jasa yang pending update
- ✅ Klik Approve Update → service update_status berubah ke "update_approved"
- ✅ Klik Reject Update → modal muncul untuk input alasan reject
- ✅ Notification message dikirim ke desainer

**Step 4: Verify Update (Desainer)**
1. Login sebagai `desainer1@example.com` kembali
2. Masuk ke **"Jasa Saya"**
3. Lihat jasa tersebut → seharusnya sudah update dengan data baru
4. Masuk ke **"Pesan"** untuk lihat notifikasi approval/rejection dari admin

**Expected Result**:
- ✅ Jasa sudah ter-update dengan data baru (jika approved)
- ✅ Message dari admin terlihat di messaging system
- ✅ Status message jelas apakah approved atau rejected beserta alasan

---

## 🔧 Technical Validation

### File Changes Verified ✅

#### Controllers
- ✅ `ServiceController.php` - Fixed image validation (mimes instead of extensions)
- ✅ `AdminController.php` - Added pending updates to dashboard
- ✅ `MessageController.php` - Already implemented

#### Views
- ✅ `Desainer/service/create.blade.php` - Added enctype="multipart/form-data"
- ✅ `Desainer/service/edit.blade.php` - Added info alert untuk approved service
- ✅ `Desainer/service/index.blade.php` - Changed action button untuk approved service
- ✅ `admin/dashboard.blade.php` - Added pending updates section
- ✅ `layouts/app.blade.php` - Added messages link untuk semua roles

#### Routes
- ✅ Semua routes sudah ada di `routes/web.php`
- ✅ Message routes: GET/POST /messages, /messages/{userId}, etc
- ✅ Admin update approval: POST /admin/service/{id}/approve-update, reject-update

### Database Schema ✅
- ✅ Services table: `update_status`, `update_reason` columns
- ✅ Messages table: All required columns present
- ✅ All migrations executed successfully

---

## 🚀 Quick Test Checklist

- [ ] Image upload works for desainer (PNG/JPG/GIF)
- [ ] No 404 errors on desainer service actions (Edit/Delete)
- [ ] Approved services show "Update (perlu approval)" button
- [ ] User dapat akses "Pesanan Saya" from navbar
- [ ] All 3 roles (Admin/Desainer/User) have "Pesan" menu
- [ ] Desainer dapat update approved service dengan approval request
- [ ] Admin dashboard shows "Pending Service Updates" section
- [ ] Admin dapat approve/reject service updates
- [ ] Notification messages dikirim ke desainer setelah admin action
- [ ] All pages load without error (check browser console)

---

## 📞 Support Notes

**Server Running On**: http://127.0.0.1:8000

**If Issues Occur**:
1. Clear cache: `php artisan optimize:clear`
2. Refresh migrations: `php artisan migrate:refresh --seed`
3. Check browser console (F12) untuk JS errors
4. Check Laravel logs: `storage/logs/laravel.log`

---

**Last Updated**: January 9, 2026  
**Testing Status**: Ready for QA ✅
