# 📖 STEP-BY-STEP TESTING GUIDE - All Fixes

**Tanggal**: January 9, 2026  
**Status**: Ready ✅

---

## 🎯 TEST 1: User Order Detail Modal (Image & Description Fix)

### Prerequisites:
- ✅ Login as user role
- ✅ Sudah punya order di "Pesanan Saya"

### Step-by-Step:

```
1️⃣ LOGIN SEBAGAI USER
   Email: user1@example.com
   Password: password
   ✓ Berhasil login

2️⃣ NAVIGATE KE "PESANAN SAYA"
   Lihat di navbar → "Pesanan Saya" (shopping cart icon)
   ✓ Page pesanan muncul dengan list order

3️⃣ LIHAT DAFTAR PESANAN
   Setiap order menampilkan:
   ✓ Order ID (contoh: #1, #2, #3)
   ✓ Service title (contoh: "Logo Design Modern")
   ✓ Designer name (contoh: "Ahmad Design Studio")
   ✓ Price (Rp format)
   ✓ Status badge (warna berbeda: Menunggu=kuning, Diproses=biru, Selesai=hijau)
   ✓ Order date
   ✓ Eye icon untuk lihat detail

4️⃣ KLIK ICON MATA (👁️) PADA SALAH SATU ORDER
   Contoh: Klik mata pada Order #1
   ✓ Modal dialog muncul **INSTANT** (pure custom modal, tanpa Bootstrap)

5️⃣ VERIFIKASI MODAL CONTENT
   ❌ SEBELUM FIX:
      - Gambar tidak muncul atau error
      - Deskripsi hanya text pendek
      - Layout berantakan
      - Modal berkedip saat dibuka
   
   ✅ SESUDAH FIX:
      - Gambar service MUNCUL JELAS (tidak kedap-kedip)
      - Gambar ukuran proper (max 250px height)
      - Layout 2 column:
        * LEFT: Gambar + judul + designer + harga
        * RIGHT: Deskripsi penuh + status + tanggal
      - Modal terbuka INSTANT tanpa animasi Bootstrap
      - Modal bisa ditutup dengan X, ESC, atau klik backdrop
      - Background scroll ter-block saat modal terbuka
      - Deskripsi bisa dibaca lengkap (word-wrap enabled)
      - Status badge besar & jelas (Menunggu/Diproses/Selesai)
      - Gradient header modal berwarna (ungu-pink)

6️⃣ BACA DESKRIPSI LENGKAP
   ✓ Scroll text area deskripsi jika ada
   ✓ Semua isi deskripsi visible
   ✓ Formatting preserved (enter, newlines, dll)

7️⃣ LIHAT STATUS BADGE
   Cari badge dengan teks:
   ✓ 🟡 Menunggu (yellow badge) = Order baru, menunggu desainer mulai
   ✓ 🔵 Diproses (blue badge) = Sedang dikerjakan
   ✓ 🟢 Selesai (green badge) = Sudah selesai
   ✓ 🔴 Dibatalkan (red badge) = Pesanan dibatalkan

8️⃣ CLOSE MODAL
   Click "Tutup" button atau X icon
   ✓ Modal tertutup, kembali ke order list

RESULT: ✅ TEST PASSED - Image menampilkan dengan jelas, deskripsi full text, layout rapi
```

---

## 🎯 TEST 1.1: User Order Cancellation Feature (NEW)

### Prerequisites:
- ✅ Login as user role
- ✅ Ada order dengan status "Menunggu" atau "Diproses"

### Step-by-Step:

```
1️⃣ LOGIN SEBAGAI USER
   Email: user1@example.com
   Password: password
   ✓ Berhasil login

2️⃣ NAVIGATE KE "PESANAN SAYA"
   Navbar → "Pesanan Saya" (shopping cart icon)
   ✓ Page order history muncul

3️⃣ CARI ORDER YANG BISA DIBATALKAN
   Cari order dengan status:
   ✓ 🟡 Menunggu (yellow badge) = BISA dibatalkan
   ✓ 🔵 Diproses (blue badge) = BISA dibatalkan
   ❌ 🟢 Selesai (green badge) = TIDAK bisa dibatalkan
   ❌ 🔴 Dibatalkan (red badge) = TIDAK bisa dibatalkan

4️⃣ KLIK ICON MATA (👁️) PADA ORDER "MENUNGGU"
   Contoh: Klik mata pada Order #1 status "Menunggu"
   ✓ Modal detail muncul

5️⃣ LIHAT TOMBOL "BATALKAN PESANAN"
   Di modal footer, cari tombol merah:
   ✓ ✅ TOMBOL ADA untuk status "Menunggu"/"Diproses"
   ✓ ❌ TOMBOL TIDAK ADA untuk status "Selesai"/"Dibatalkan"

6️⃣ KLIK TOMBOL "BATALKAN PESANAN"
   ✓ Dialog konfirmasi muncul: "Apakah Anda yakin ingin membatalkan pesanan ini?"

7️⃣ KONFIRMASI PEMBATALAN
   Click "OK" di dialog konfirmasi
   ✓ Modal tertutup
   ✓ Redirect kembali ke order history
   ✓ Success message: "Pesanan berhasil dibatalkan."

8️⃣ VERIFIKASI STATUS BERUBAH
   Lihat order yang dibatalkan:
   ✓ Status sekarang: 🔴 Dibatalkan (red badge)
   ✓ Tombol "Batalkan Pesanan" sekarang TIDAK muncul lagi

9️⃣ COBA BATALKAN ORDER "SELESAI" (NEGATIVE TEST)
   Klik mata pada order status "Selesai"
   ✓ Tombol "Batalkan Pesanan" TIDAK ADA di modal
   ✓ Atau jika ada, akan error: "Pesanan tidak dapat dibatalkan karena sudah dalam proses atau sudah selesai."

RESULT: ✅ TEST PASSED - Fitur pembatalan bekerja dengan benar, validasi status berfungsi
```

---

## 🎯 TEST 2: Order Status Muncul di Keranjang Order

### Prerequisites:
- ✅ Login sebagai user
- ✅ Ada beberapa jasa di halaman "Jelajah Jasa"

### Step-by-Step:

```
1️⃣ LOGIN SEBAGAI USER
   Email: user1@example.com
   Password: password

2️⃣ NAVIGATE KE "JELAJAH JASA"
   Navbar → "Jelajah Jasa" atau "Dashboard"
   ✓ Halaman service listing muncul

3️⃣ LIHAT SERVICE CARDS
   Setiap card menampilkan:
   ✓ Gambar service/poster
   ✓ Judul service
   ✓ Desainer name
   ✓ Harga (Rp format)
   ✓ Rating/Review (jika ada)
   ✓ "Lihat Detail" atau "Pesan" button

4️⃣ KLIK "LIHAT DETAIL" PADA SALAH SATU SERVICE
   ✓ Service detail page muncul dengan:
      - Gambar besar
      - Judul & deskripsi lengkap
      - Harga
      - Desainer info
      - "Pesan Jasa" button

5️⃣ KLIK "PESAN JASA" BUTTON
   ✓ Browser mungkin muncul:
      - Success notification: "Order berhasil dibuat!"
      - Atau automatic redirect ke "Pesanan Saya"

6️⃣ NAVIGATE KE "PESANAN SAYA"
   Navbar → "Pesanan Saya"
   ✓ Order list page muncul

7️⃣ VERIFIKASI ORDER BARU MUNCUL
   ✓ Order baru muncul di list PALING ATAS
   ✓ Status badge muncul: "🟡 Menunggu"
   ✓ Service info lengkap (judul, desainer, harga)
   ✓ Tanggal order hari ini

8️⃣ KLIK MATA ICON PADA ORDER BARU
   ✓ Modal muncul dengan:
      - Status: "Menunggu" (yellow badge)
      - Gambar service jelas
      - Deskripsi lengkap
      - Semua info order

RESULT: ✅ TEST PASSED - Order baru muncul dengan status "Menunggu" di keranjang
```

---

## 🎯 TEST 3: Admin Edit User (Pencil Icon)

### Prerequisites:
- ✅ Login sebagai admin
- ✅ Minimal ada 2 user di database

### Step-by-Step:

```
1️⃣ LOGIN SEBAGAI ADMIN
   Email: admin@example.com
   Password: password
   ✓ Admin dashboard muncul

2️⃣ NAVIGATE KE "KELOLA USER"
   Opsi 1: Sidebar → "Kelola User"
   Opsi 2: Top bar dropdown → "Admin" → "Kelola User"
   ✓ Users management page muncul

3️⃣ LIHAT DAFTAR USER
   Table menampilkan:
   ✓ ID | Nama | Email | Role | Bergabung | Aksi
   ✓ Setiap user punya 2 button di kolom "Aksi":
      - ✏️ Pencil icon (Edit) - warna kuning
      - 🗑️ Trash icon (Hapus) - warna merah

4️⃣ KLIK ICON PENCIL (✏️) PADA SALAH SATU USER
   ❌ SEBELUM FIX:
      - Error page atau 404
      - View tidak ditemukan
   
   ✅ SESUDAH FIX:
      - Edit user form muncul (TIDAK ERROR!)

5️⃣ VERIFIKASI EDIT FORM
   Form harus menampilkan:
   ✓ Halaman title: "Edit User"
   ✓ "Kembali" button di atas
   ✓ Card dengan header: "Data User"
   ✓ Form fields:
      * Nama Lengkap (text input) - sudah terisi data current
      * Email (email input) - sudah terisi
      * Role/Peran (dropdown) - current role selected
   ✓ Alert info menampilkan current data:
      - Email user
      - Tanggal bergabung
      - Role saat ini (badge)
   ✓ Right panel dengan penjelasan role (Admin/Desainer/User)

6️⃣ EDIT DATA USER (OPTIONAL)
   Contoh: Ubah nama dari "Ahmad" menjadi "Ahmad Rizky"
   ✓ Hapus nama yang ada
   ✓ Type nama baru: "Ahmad Rizky"
   ✓ Lihat right panel berisi penjelasan role:
      - 👨‍💼 Admin explanation
      - 🎨 Desainer explanation
      - 👤 User explanation

7️⃣ KLIK "SIMPAN PERUBAHAN" BUTTON
   ✓ Form submit
   ✓ Page redirect ke user list
   ✓ Success message muncul: "User berhasil diperbarui"
   ✓ Data user sudah terupdate di table

8️⃣ ATAU KLIK "BATAL" UNTUK CANCEL
   ✓ Kembali ke user list tanpa perubahan

RESULT: ✅ TEST PASSED - Edit user form muncul tanpa error, form berfungsi normal
```

---

## 🎯 TEST 4: Admin Create User

### Prerequisites:
- ✅ Login sebagai admin
- ✅ Di halaman "Kelola User"

### Step-by-Step:

```
1️⃣ DI HALAMAN "KELOLA USER"
   ✓ Lihat button hijau: "+ Tambah User" di atas table

2️⃣ KLIK "TAMBAH USER" BUTTON
   ✓ Create user form page muncul

3️⃣ VERIFIKASI CREATE FORM
   Form harus menampilkan:
   ✓ Halaman title: "Tambah User Baru"
   ✓ "Kembali" button
   ✓ Card dengan header: "Data User Baru"
   ✓ Form fields:
      * Nama Lengkap (text input) - placeholder "Ahmad Rizky Wijaya"
      * Email (email input) - placeholder "user@example.com"
      * Password (password input) - placeholder "Minimal 8 karakter"
      * Konfirmasi Password (password input)
      * Role/Peran (dropdown) - pilihan Admin/Desainer/User
   ✓ Info alert: "Email harus unik, password minimal 8 karakter"
   ✓ Right panel berisi penjelasan role
   ✓ Warning: "Hanya pilih Admin untuk pengguna terpercaya!"

4️⃣ ISI FORM DENGAN DATA BARU
   Contoh:
   Nama: "Budi Santoso"
   Email: "budi.santoso@example.com"
   Password: "password123"
   Konfirmasi Password: "password123"
   Role: "User"

5️⃣ KLIK "BUAT USER" BUTTON
   ✓ Form submit
   ✓ Validation berjalan:
      - Email harus unik
      - Password harus 8+ char
      - Password confirmation harus match
   ✓ Jika valid: berhasil dibuat & redirect ke user list
   ✓ Success message: "User berhasil dibuat"

6️⃣ VERIFIKASI USER BARU DI LIST
   ✓ Lihat user baru di table
   ✓ Data sesuai yang diinput:
      - ID: auto increment
      - Nama: "Budi Santoso"
      - Email: "budi.santoso@example.com"
      - Role: "User" (badge berwarna)
      - Bergabung: hari ini

7️⃣ OPTIONAL: TEST VALIDATION ERRORS
   Back ke Create form, try:
   ✓ Submit tanpa isi nama → Error muncul
   ✓ Submit dengan email invalid → Error: "Email tidak valid"
   ✓ Submit dengan password 5 char → Error: "Minimal 8 karakter"
   ✓ Password tidak match → Error: "Konfirmasi password tidak sama"

RESULT: ✅ TEST PASSED - Create user form muncul & berfungsi, user baru berhasil dibuat
```

---

## 🎯 TEST 5: Create New Message Modal (Pesan Baru)

### Prerequisites:
- ✅ Login sebagai user/desainer/admin
- ✅ Minimal ada 2+ users di database

### Step-by-Step:

```
1️⃣ LOGIN DENGAN SALAH SATU ROLE
   Opsi 1: user1@example.com / password
   Opsi 2: desainer1@example.com / password
   Opsi 3: admin@example.com / password

2️⃣ NAVIGATE KE "PESAN"
   Navbar → "Pesan" menu (comment/envelope icon)
   ✓ Messages page muncul

3️⃣ LIHAT PESAN PAGE
   ✓ Title: "Pesan & Notifikasi"
   ✓ Subtitle: "Kelola semua percakapan Anda"
   ✓ Button hijau "➕ Pesan Baru" di atas
   ✓ List pesan yang sudah ada (jika ada)
   ✓ Sidebar: "Semua Pesan"

4️⃣ KLIK "PESAN BARU" BUTTON
   ✓ Modal dialog muncul dengan:
      - Title: "📝 Pesan Baru"
      - Gradient header berwarna ungu-pink
      - X button untuk close

5️⃣ VERIFIKASI MODAL CONTENT
   Modal harus memiliki:
   ✓ Field 1: "Kirim Ke:" dropdown
      - Show semua user lain (exclude current user)
      - Format: "Nama (Role)"
      - Contoh dropdown options:
        * admin@example.com (Admin)
        * desainer1@example.com (Desainer)
        * desainer2@example.com (Desainer)
        * user1@example.com (User)
   
   ✓ Field 2: "Pesan:" textarea
      - Placeholder: "Tulis pesan Anda di sini..."
      - 6 rows height
      - Info: "Pesan akan dikirim segera"
   
   ✓ Field 3: "Tipe Pesan:" dropdown (optional)
      - Options:
        * 📝 Pesan Umum (default selected)
        * 🔄 Update Request
        * 🔔 Notifikasi
      - Info: "Tipe pesan membantu penerima memahami prioritas"
   
   ✓ Alert info: "Pesan Anda akan tersimpan & kedua pihak dapat melihat riwayat"
   
   ✓ Footer buttons:
      - "Batal" - close modal tanpa send
      - "📤 Kirim Pesan" - send message (primary color)

6️⃣ SELECT PENERIMA DARI DROPDOWN
   ✓ Click dropdown "Kirim Ke:"
   ✓ List options muncul dengan user lain
   ✓ Contoh: select "admin@example.com (Admin)"
   ✓ Dropdown value berubah

7️⃣ TYPE PESAN DI TEXTAREA
   ✓ Click textarea
   ✓ Type message: "Halo Admin, ini percakapan pertama kami"
   ✓ Text input accepted

8️⃣ SELECT TIPE PESAN (OPTIONAL)
   ✓ Default: "📝 Pesan Umum"
   ✓ Optional: ubah ke "🔄 Update Request"
   ✓ Atau "🔔 Notifikasi"

9️⃣ KLIK "KIRIM PESAN" BUTTON
   ✓ Modal processing (loading state)
   ✓ Form submit ke backend
   ✓ Backend validation:
      - to_user_id: required & exists in users table
      - message: required & string
      - type: optional, must be valid enum
   ✓ If valid:
      - Modal close
      - Success notification muncul
      - Pesan terlihat di conversation list
      - Status: unread (jika penerima belum buka)

🔟 VERIFY PESAN TERKIRIM
   ✓ Modal closed, kembali ke message list
   ✓ Conversation dengan penerima muncul di list
   ✓ Preview pesan muncul: "Halo Admin, ini percakapan..."
   ✓ Timestamp: "Just now" atau "a few seconds ago"
   ✓ Arrow indicator: "➡️ Pesan Anda ke Admin"

1️⃣1️⃣ OPTIONAL: OPEN CONVERSATION
   ✓ Click conversation item
   ✓ Conversation detail page muncul
   ✓ Message history terlihat
   ✓ Your message di list dengan time
   ✓ Click "Close" atau back arrow untuk kembali

1️⃣2️⃣ TEST DARI PENERIMA SIDE
   ✓ Logout dari current user
   ✓ Login sebagai penerima (admin)
   ✓ Go to "Pesan" menu
   ✓ Conversation dari pengirim muncul
   ✓ Preview: "⬅️ Admin menerima pesan: Halo Admin..."
   ✓ Status: unread (background light)
   ✓ Click conversation
   ✓ Message terlihat dengan sender name
   ✓ Auto-mark as read

RESULT: ✅ TEST PASSED - Modal muncul, pesan terkirim, conversation terbuat antara users
```

---

## 🎯 TEST 6: All 3 Roles Message Interaction

### Complete Conversation Flow:

```
SCENARIO: Desainer → Admin → User Communication

STEP 1: DESAINER INITIATE CHAT WITH ADMIN
┌─────────────────────────────────────────────────────────┐
│ Login: desainer1@example.com / password                 │
│ Menu: Pesan → Pesan Baru                               │
│ To: admin@example.com (Admin)                           │
│ Type: Update Request                                    │
│ Message: "Admin, saya ingin update jasa logo saya"     │
│ Send ✓                                                  │
└─────────────────────────────────────────────────────────┘

STEP 2: ADMIN RECEIVES & REPLIES
┌─────────────────────────────────────────────────────────┐
│ Login: admin@example.com / password                     │
│ Menu: Pesan                                             │
│ See conversation from desainer1@example.com             │
│ Click to open conversation                              │
│ Type reply: "Baik, silakan upload file update..."       │
│ Send ✓                                                  │
└─────────────────────────────────────────────────────────┘

STEP 3: DESAINER SEES ADMIN REPLY
┌─────────────────────────────────────────────────────────┐
│ Login: desainer1@example.com / password                 │
│ Menu: Pesan                                             │
│ Conversation with admin sudah ada                       │
│ Click to view                                           │
│ See admin reply message                                 │
│ Continue conversation...                                │
└─────────────────────────────────────────────────────────┘

RESULT: ✅ Full conversation flow working between admin & desainer
```

---

## ✅ FINAL CHECKLIST

Setelah semua test, verify:

```
✅ User Order Modal Test
  ├─ Gambar muncul jelas
  ├─ Deskripsi full text
  ├─ Layout 2 column
  └─ Status badge muncul

✅ Order Status Test
  ├─ Order baru muncul di list
  ├─ Status "Menunggu" muncul
  └─ Semua info lengkap

✅ Admin Edit User Test
  ├─ Edit form muncul tanpa error
  ├─ Form data terisi
  ├─ Bisa update & save
  └─ Data berubah di list

✅ Admin Create User Test
  ├─ Create form muncul
  ├─ All fields ada
  ├─ Validation works
  └─ User baru dibuat

✅ Message Modal Test
  ├─ Button muncul
  ├─ Modal opens
  ├─ Dropdown user populated
  ├─ Message textarea works
  ├─ Type selection works
  └─ Pesan terkirim & visible

✅ 3-Role Communication Test
  ├─ Admin ↔ Desainer chat
  ├─ Desainer ↔ User chat
  ├─ Admin ↔ User chat
  └─ All conversations working
```

---

**SELESAI! 🎉 Semua test sudah tercakup. Silakan mulai testing sekarang!**

Jika ada issue:
1. Screenshot apa yang terjadi
2. Step-by-step bagaimana reproduce
3. Browser console error (F12)
4. Report langsung ke developer

**Good Luck! 💪**
