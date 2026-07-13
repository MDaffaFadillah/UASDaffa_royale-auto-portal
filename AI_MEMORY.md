# AI Project Memory - Royale Auto Portal

## Aturan Utama (Core Rules)
1. Project ini menggunakan Laravel 12.0.
2. Frontend TIDAK menggunakan Vite/Node.js, melainkan menggunakan Tailwind CSS v3 via Play CDN.
3. Desain menggunakan tema "Luxury Dark Mode" (Eksklusif, Sinematik, Gelap).

## Daftar & Referensi Aset Video (Video Assets Memory)
Daftar file video di direktori `public/assets/videos/` (perhatikan penulisan case-sensitive):
1. **`CuliinanHead.mp4`** *(terdapat salah ketik pada kata "Culiinan")* — Menampilkan objek berwarna gelap yang menyerupai bagian interior atau detail bodi kendaraan.
2. **`Cullinan Series.mp4`** — Menampilkan sebuah objek panjang berwarna hijau muda cerah atau dalam pencahayaan hijau (SUV mewah Rolls-Royce Cullinan).
3. **`Spectre(video).mp4`** — Menampilkan permukaan melengkung berwarna emas/oranye dengan pencahayaan sinematik (Mobil listrik mewah Rolls-Royce Spectre).
4. **`SPECTRE(VIDEO2).mp4`** *(huruf kapital)* — Menampilkan patung ikonik "Spirit of Ecstasy" di kap depan Rolls-Royce *(digunakan sebagai Hero Video Background utama di Homepage)*.

## Log Perubahan (Changelog)

### 2026-07-12 - Setup Frontend Dasar & Fix Error Vite
- **Masalah:** Terjadi error "Vite manifest not found".
- **Tindakan:**
  - Menghapus semua tag `@vite` dari view.
  - Menghapus `welcome.blade.php`.
  - Membuat `layouts/app.blade.php` dengan Tailwind CDN dan `index.blade.php`.
  - Mengubah rute '/' ke `HomeController@index`.
  - Mengubah cache/session driver di `.env` menjadi `file` agar tidak bentrok dengan SQLite.
  - Melakukan `optimize:clear` dan `view:clear`.
- **Status Saat Ini:** Halaman beranda utama sudah berjalan normal menampilkan data mobil dari database dengan desain Dark Mode.

### 2026-07-12 - Implementasi Dynamic Detail Page
- **Tindakan:**
  - Menambahkan method `show($id)` di `HomeController` untuk mengambil data satu mobil berdasarkan ID.
  - Mendaftarkan route baru `GET /car/{id}` dengan nama `car.detail` di `routes/web.php`.
  - Membuat view dinamis `detail.blade.php` dengan desain eksklusif: Hero Image full-bleed, judul & tagline, deskripsi, grid Engine Specs dari JSON, galeri gambar tambahan, dan tombol CTA emas "BOOK BESPOKE EXPERIENCE".
  - Mengubah kartu mobil di `index.blade.php` dari `<div>` menjadi `<a>` yang mengarah ke `route('car.detail', $car->id)` agar clickable.
  - Menjalankan `view:clear` dan `route:clear`.
- **Status Saat Ini:** Kartu mobil di Homepage sudah interaktif dan mengarah ke halaman detail dinamis per mobil.

### 2026-07-12 - Kalibrasi Harga IDR, Fix Ekstensi Aset Gambar, dan Integrasi Video Hero Background
- **Tindakan:**
  - Memperbarui `LuxuryCarSeeder.php`: harga dikalibrasi ke skala Miliaran Rupiah (Phantom 25M, Cullinan 22M, Spectre 20M), gallery_images disesuaikan case-sensitive (Phantom +1 gambar, Cullinan +3 gambar).
  - Mengganti Hero Section di `index.blade.php` dari pattern statis menjadi HTML5 `<video>` background sinematik (autoplay, muted, loop) dari `public/assets/videos/hero-bg.mp4`.
  - Menambahkan format harga IDR `Rp {{ number_format() }}` pada kartu mobil di Homepage.
  - Membuat folder `public/assets/videos/` untuk menyimpan video hero.
  - Menjalankan `migrate:fresh --seed` untuk re-seed database dan `view:clear`.
- **Catatan:** File video `hero-bg.mp4` harus diletakkan manual oleh user di `public/assets/videos/`.
- **Status Saat Ini:** Data mobil sudah terkalibrasi harga IDR Miliaran, kartu menampilkan harga terformat, dan Hero Section siap menampilkan video sinematik.

### 2026-07-12 - Pencatatan Referensi Video Aset & Pembaruan Hero Video
- **Tindakan:**
  - Mencatat 4 file video (`CuliinanHead.mp4`, `Cullinan Series.mp4`, `Spectre(video).mp4`, `SPECTRE(VIDEO2).mp4`) ke dalam [AI_MEMORY.md](file:///d:/laragon/www/UASDaffa/AI_MEMORY.md).
  - Mengubah source video background pada [index.blade.php](file:///d:/laragon/www/UASDaffa/resources/views/index.blade.php) menjadi `SPECTRE(VIDEO2).mp4` yang menampilkan patung ikonik "Spirit of Ecstasy".
- **Status Saat Ini:** Hero background Homepage langsung memutar video sinematik Spirit of Ecstasy secara otomatis.

### 2026-07-12 - Implementasi Autentikasi VIP Lounge
- **Tindakan:** Membuat AuthController (`showLogin`, `login`, `showRegister`, `register`, `logout`), merancang view login & register bernuansa eksklusif (Luxury Dark Mode dengan input zinc-900 & fokus amber-500), menambahkan rute auth di `routes/web.php`, dan memperbarui Navbar di `layouts/app.blade.php` untuk mendeteksi status login (`@auth`/`@guest`) pengguna.
- **Status Saat Ini:** Sistem autentikasi VIP Lounge (Login, Register, Logout) sudah aktif dan terintegrasi dengan database SQLite.

### 2026-07-12 - Implementasi CRUD VIP Bookings & Profile Page
- **Tindakan:**
  - Membuat `BookingController.php` dengan metode `create`, `store`, `profile` (Read all user bookings), `edit`, `update` (Reschedule), dan `destroy` (Cancel Booking).
  - Mendaftarkan rute terlindung (`middleware('auth')`) untuk pemesanan dan profil di `routes/web.php`.
  - Menghubungkan tombol CTA *"BOOK BESPOKE EXPERIENCE"* di halaman detail ke `booking.create`.
  - Merancang view eksklusif Luxury Dark Mode untuk form booking (`booking/create.blade.php`), form reschedule (`booking/edit.blade.php`), dan halaman profil member (`profile.blade.php`) lengkap dengan status badge (`pending`, `confirmed`, `rescheduled`, `rejected`).
- **Status Saat Ini:** Fitur CRUD pemesanan sesi Bespoke & Test Drive berjalan penuh dan dilindungi autentikasi.

### 2026-07-12 - Implementasi Admin Dashboard (Executive Control Panel)
- **Tindakan:**
  - Membuat `AdminController.php` dengan pengecekan `role === 'admin'`, method `index()` untuk menampilkan seluruh antrean booking, dan `updateBooking()` untuk mengubah status & jadwal booking.
  - Mendaftarkan rute admin `/admin/dashboard` dan `/admin/booking/{id}` di `routes/web.php` dengan prefix `admin` dan middleware `auth`.
  - Merancang view `admin/dashboard.blade.php` bergaya *Executive Control Panel* (Luxury Dark Mode) lengkap dengan ringkasan statistik (Total, Pending, Confirmed), daftar booking terperinci, dan form inline untuk mengubah Status (Dropdown), Corrected Date/Time, dan Admin Notes.
  - Memperbarui Navbar di `layouts/app.blade.php`: menambahkan tombol merah **"EXECUTIVE PANEL"** yang hanya tampil jika `Auth::user()->role === 'admin'`.
- **Akun Admin:** Alexander Reeve (`admin@royaleauto.com` / `luxury123`).
- **Status Saat Ini:** Admin Dashboard aktif dan hanya bisa diakses oleh user dengan role `admin`.

### 2026-07-13 - Migrasi Database ke Neon.tech PostgreSQL & Konfigurasi Vercel
- **Tindakan:**
  - Mengubah `.env` dari SQLite ke PostgreSQL Neon.tech (DB_CONNECTION=pgsql, DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
  - Mengaktifkan ekstensi `pdo_pgsql` dan `pgsql` di `C:\xampp\php\php.ini`.
  - Membuat `NeonServiceProvider.php` yang meng-override `PostgresConnector` untuk menambahkan `options='endpoint=ep-sparkling-waterfall-atdw4mg8'` ke DSN (solusi SNI untuk libpq lama).
  - Mendaftarkan `NeonServiceProvider` di `bootstrap/providers.php`.
  - Memperbarui `config/database.php` pgsql: `sslmode` default `require`.
  - Menjalankan `php artisan migrate:fresh --seed` sukses ke database Neon.tech.
  - Membuat `vercel.json` (konfigurasi deployment Vercel) dan `api/index.php` (entry point).
- **Catatan Penting:** Database sekarang menggunakan PostgreSQL di cloud (Neon.tech), bukan lagi SQLite lokal.
- **Status Saat Ini:** Database live di Neon.tech, konfigurasi Vercel siap untuk deployment.
