
# 📚 JellyBook.IO - Sistem Manajemen Perpustakaan

JellyBook.IO adalah aplikasi web yang dibangun dengan framework Laravel untuk mengelola perpustakaan digital. Aplikasi ini menyediakan platform yang efisien untuk manajemen koleksi buku, pencatatan peminjaman, serta interaksi pengguna melalui sistem rating dan rekomendasi.

Proyek ini memiliki implementasi hak akses yang jelas antara **Admin** sebagai pengelola sistem dan **User** sebagai peminjam.

-----

## ✨ Fitur Utama

Aplikasi ini dilengkapi dengan berbagai fitur untuk memenuhi kebutuhan admin dan pengguna biasa:

#### Fitur Umum (Untuk Semua Pengguna)

  * **Dashboard Utama:** Menampilkan ringkasan statistik seperti total buku, total rating, dan daftar buku dengan rating tertinggi.
  * **Jelajah Buku:** Pengguna dapat melihat seluruh koleksi buku yang tersedia dan melakukan filter berdasarkan kategori.
  * **Form Peminjaman:** Antarmuka untuk mengajukan peminjaman buku dengan data yang tervalidasi.
  * **Riwayat Peminjaman:** Melihat daftar semua transaksi peminjaman yang pernah terjadi.
  * **Otentikasi Lengkap:** Sistem login, registrasi, dan lupa password yang aman menggunakan Laravel Breeze.
  * **Manajemen Profil:** Pengguna dapat mengubah informasi profil dan password mereka.

#### Fitur Khusus Admin

  * **Manajemen Penuh (CRUD):** Admin memiliki hak akses penuh untuk Menambah, Membaca, Mengubah, dan Menghapus (CRUD) data untuk:
      * **Buku**
      * **Kategori**
      * **Staf / Pengguna**
  * **Cetak Laporan PDF:** Admin dapat mencetak riwayat peminjaman dan struk peminjaman individual dalam format PDF, didukung oleh `barryvdh/laravel-dompdf`.
  * **Pemisahan Hak Akses:** Antarmuka dan akses fitur secara otomatis disesuaikan berdasarkan peran pengguna.

-----

## 💻 Tumpukan Teknologi (Tech Stack)

  * **Framework:** Laravel 10
  * **Bahasa:** PHP 8.1+
  * **Database:** MySQL
  * **Frontend:**
      * Blade Templating Engine
      * Vite
      * Tailwind CSS
  * **Pustaka Utama:**
      * **Laravel Breeze:** Untuk sistem otentikasi.
      * **barryvdh/laravel-dompdf:** Untuk generate PDF.
      * **Select2:** Untuk input dropdown yang interaktif.

-----

## 🚀 Panduan Instalasi Lokal

Untuk menjalankan proyek ini di lingkungan lokal Anda, ikuti langkah-langkah berikut:

1.  **Clone Repositori**

    ```bash
    git clone https://github.com/nama-anda/nama-repositori.git
    cd nama-repositori
    ```

2.  **Instal Dependensi**
    Pastikan Anda memiliki [Composer](https://getcomposer.org/) terinstal.

    ```bash
    composer install
    ```

    Instal juga dependensi frontend.

    ```bash
    npm install
    ```

3.  **Konfigurasi Lingkungan**

      * Salin file `.env.example` menjadi `.env`.
        ```bash
        cp .env.example .env
        ```
      * Buka file `.env` dan atur koneksi database Anda (DB\_DATABASE, DB\_USERNAME, DB\_PASSWORD).
      * Generate kunci aplikasi.
        ```bash
        php artisan key:generate
        ```

4.  **Migrasi & Seeding Database**
    Jalankan migrasi untuk membuat semua tabel di database. `--seed` akan menjalankan seeder untuk membuat data awal (jika ada).

    ```bash
    php artisan migrate --seed
    ```

5.  **Jalankan Server Pengembangan**

      * Jalankan server Vite untuk kompilasi aset frontend.
        ```bash
        npm run dev
        ```
      * Di terminal lain, jalankan server Laravel.
        ```bash
        php artisan serve
        ```

6.  **Akses Aplikasi**
    Buka browser Anda dan kunjungi `http://localhost:8000`.

-----

## 🔑 Implementasi Hak Akses (Role-Based Access Control)

Sistem pemisahan hak akses di aplikasi ini dibangun di atas 4 pilar utama:

1.  **Database (`role`):** Tabel `users` memiliki kolom `role` yang menentukan peran pengguna ('admin' atau 'user'). Model `User` juga memiliki fungsi helper `isAdmin()` untuk pengecekan yang mudah.

2.  **Middleware (`CheckRole.php`):** Sebuah middleware kustom dibuat untuk menjadi "penjaga gerbang". Middleware ini diterapkan pada rute-rute admin dan akan menolak akses jika pengguna yang mencoba masuk bukan seorang admin.

3.  **Routing (`routes/web.php`):** File rute secara eksplisit memisahkan rute menjadi dua grup utama:

      * Satu grup untuk semua pengguna yang sudah login (`middleware(['auth'])`).
      * Satu grup khusus untuk admin dengan prefix `/admin` dan dilindungi oleh middleware `role:admin`.

4.  **Tampilan (Blade Views):** Di dalam file-file Blade, direktif `@if (auth()->user()->isAdmin())` digunakan untuk menyembunyikan atau menampilkan elemen UI (seperti menu navigasi dan tombol aksi) berdasarkan peran pengguna.

-----

## 👤 Akun Default

Untuk mencoba fitur admin, Anda bisa menggunakan akun berikut (jika Anda menjalankan seeder) atau membuatnya secara manual di database:

  * **Email:** `admin@example.com`
  * **Password:** `password`

-----

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE.md).
