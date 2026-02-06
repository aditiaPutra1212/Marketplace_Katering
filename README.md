# Marketplace Katering

Marketplace Katering adalah platform web berbasis Laravel 11 yang menghubungkan penyedia jasa boga (Merchant) dengan pelanggan dari kalangan kantor atau instansi (Customer). Platform ini memudahkan proses pemesanan katering harian atau acara khusus dengan sistem yang terintegrasi.

## Fitur Utama

- **Sistem Pengguna Ganda**:
  - **Merchant (Katering)**: Mengelola dashboard, daftar menu (tambah/edit/hapus), serta menerima dan memantau pesanan.
  - **Customer (Kantor/Instansi)**: Melihat daftar katering, profil merchant, melakukan pemesanan (dengan tanggal pengiriman & alamat spesifik), serta melihat riwayat pesanan.
- **Manajemen Pesanan**: Sistem status pesanan yang dinamis (Pending -> Accepted -> Completed) dan fitur pembatalan pesanan untuk pelanggan.
- **Profil Merchant Publik**: Halaman khusus untuk setiap merchant yang menampilkan detail kontak (terhubung ke WhatsApp) dan seluruh menu yang ditawarkan.
- **Halaman Statis Terintegrasi**: Halaman "Tentang Kami" dan "Kontak Kami" untuk meningkatkan profesionalisme platform.
- **Tampilan Premium**: Desain modern menggunakan Bootstrap 5 dengan animasi halus dan navigasi yang responsif.

## Teknologi

- **Backend**: Laravel 11 (PHP 8.2+)
- **Database**: MySQL
- **Frontend**: Blade Templating + Bootstrap 5 + Bootstrap Icons
- **Styling**: CSS Vanilla dengan desain responsif

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Web Server (Apache/Nginx atau `php artisan serve`)

## Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal Anda:

1. **Clone Repositori**:
   ```bash
   git clone [url-repositori-anda]
   cd Marketplace_Katering
   ```

2. **Instal Dependensi**:
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**:
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` dan sesuaikan pengaturan database Anda:
   ```env
   DB_DATABASE=db_marketplace_katering
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Jalankan Migrasi Database**:
   Pastikan Anda sudah membuat database kosong bernama `db_marketplace_katering` di MySQL/phpMyAdmin Anda.
   ```bash
   php artisan migrate
   ```

6. **Storage Link**:
   Gunakan perintah ini agar foto menu yang diunggah merchant dapat diakses secara publik:
   ```bash
   php artisan storage:link
   ```

7. **Jalankan Server**:
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui browser di alamat: `http://127.0.0.1:8000`

## Akun Demo (Opsional)

Setelah menjalankan migrasi, Anda dapat mendaftarkan akun baru melalui halaman **Daftar**:
- Pilih **Role: Merchant** untuk mencoba sisi penyedia katering.
- Pilih **Role: Kantor (Customer)** untuk mencoba sisi pemesan.

## Lisensi

Proyek ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).
