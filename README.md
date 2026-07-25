# InventoryHub — Sistem Manajemen Inventaris Produk

InventoryHub adalah aplikasi web sederhana untuk mengelola data inventaris produk. Aplikasi ini dibangun menggunakan CodeIgniter 4 dengan pola arsitektur Model–View–Controller atau MVC, database MySQL, dan antarmuka responsif berbasis Bootstrap 5.

Aplikasi menyediakan autentikasi pengguna, pembagian hak akses berdasarkan peran, pengelolaan data produk, unggah gambar, validasi input, serta notifikasi hasil operasi. Pengguna biasa dapat melihat katalog produk, sedangkan administrator memiliki akses penuh untuk menambah, mengubah, dan menghapus produk.

## Daftar Isi

* [Fitur Utama](#fitur-utama)
* [Hak Akses Pengguna](#hak-akses-pengguna)
* [Alur Penggunaan Aplikasi](#alur-penggunaan-aplikasi)
* [Teknologi yang Digunakan](#teknologi-yang-digunakan)
* [Arsitektur Aplikasi](#arsitektur-aplikasi)
* [Struktur Direktori Penting](#struktur-direktori-penting)
* [Daftar Route](#daftar-route)
* [Struktur Database](#struktur-database)
* [Validasi Data](#validasi-data)
* [Persyaratan Sistem](#persyaratan-sistem)
* [Instalasi dan Konfigurasi](#instalasi-dan-konfigurasi)
* [Akun Bawaan](#akun-bawaan)
* [Cara Menggunakan Aplikasi](#cara-menggunakan-aplikasi)
* [Catatan Keamanan](#catatan-keamanan)
* [Troubleshooting](#troubleshooting)
* [Pengembangan Lanjutan](#pengembangan-lanjutan)

## Fitur Utama

### 1. Halaman Utama

Halaman utama dapat diakses tanpa login dan berfungsi sebagai halaman pengenalan aplikasi. Halaman ini menjelaskan fungsi InventoryHub, menampilkan keunggulan sistem, serta menyediakan tombol menuju katalog produk dan halaman login.

### 2. Autentikasi Pengguna

Aplikasi menyediakan proses login menggunakan username dan password. Password yang tersimpan di database diproses menggunakan fungsi hashing PHP dan diverifikasi dengan `password_verify()`.

Setelah berhasil login, data berikut disimpan dalam session:

* ID pengguna
* Username
* Role pengguna
* Status login

Pengguna yang belum login akan diarahkan ke halaman login ketika mencoba membuka katalog produk.

### 3. Pembagian Hak Akses

InventoryHub menggunakan dua jenis role:

* **Admin** — memiliki akses penuh terhadap data produk.
* **User** — hanya dapat melihat daftar produk.

Pembatasan akses dilakukan menggunakan `AuthFilter` dan `AdminFilter`.

### 4. Daftar Produk

Halaman produk menampilkan data dalam bentuk tabel yang terdiri atas:

* Nomor urut
* Gambar produk
* Nama produk
* Harga dalam format rupiah
* Jumlah stok
* Tombol aksi untuk admin

Data diurutkan berdasarkan ID secara menurun sehingga produk terbaru muncul di bagian paling atas.

### 5. Tambah Produk

Administrator dapat menambahkan produk baru dengan mengisi:

* Nama produk
* Harga
* Stok
* Gambar produk opsional

Jika gambar tidak diunggah, sistem menggunakan `default.jpg` sebagai gambar bawaan.

### 6. Edit Produk

Administrator dapat memperbarui nama, harga, stok, dan gambar produk. Jika gambar baru tidak dipilih, sistem tetap menggunakan gambar lama.

Ketika gambar baru diunggah, gambar lama akan dihapus dari server selama gambar tersebut bukan `default.jpg`.

### 7. Hapus Produk

Administrator dapat menghapus produk setelah menyetujui dialog konfirmasi. Ketika produk dihapus, file gambarnya juga dihapus dari server selama bukan gambar bawaan.

### 8. Unggah dan Pratinjau Gambar

Form tambah dan edit produk mendukung unggah gambar sekaligus pratinjau sebelum data disimpan. Nama file gambar dibuat secara acak untuk mengurangi risiko benturan nama file.

Format gambar yang didukung:

* JPG
* JPEG
* PNG
* WEBP

Ukuran maksimal gambar adalah 2 MB.

### 9. Indikator Stok

Jumlah stok ditampilkan menggunakan badge visual:

* Stok kurang dari 5 unit ditampilkan sebagai kondisi stok rendah.
* Stok 5 unit atau lebih ditampilkan sebagai kondisi stok tersedia.

### 10. Notifikasi Operasi

Aplikasi menampilkan flash message setelah proses tertentu, seperti:

* Login berhasil atau gagal
* Produk berhasil ditambahkan
* Produk berhasil diperbarui
* Produk berhasil dihapus
* Data tidak ditemukan
* Akses ditolak
* Validasi input gagal

### 11. Antarmuka Responsif

Antarmuka menggunakan konsep glassmorphism dengan warna utama emerald dan teal. Tampilan dibangun menggunakan Bootstrap 5, Font Awesome, Google Fonts, dan Animate.css sehingga dapat menyesuaikan ukuran layar desktop maupun perangkat bergerak.

## Hak Akses Pengguna

| Fitur                  | Pengunjung |  User | Admin |
| ---------------------- | :--------: | :---: | :---: |
| Membuka halaman utama  |     Ya     |   Ya  |   Ya  |
| Membuka halaman login  |     Ya     |   Ya  |   Ya  |
| Melihat katalog produk |    Tidak   |   Ya  |   Ya  |
| Menambah produk        |    Tidak   | Tidak |   Ya  |
| Mengedit produk        |    Tidak   | Tidak |   Ya  |
| Menghapus produk       |    Tidak   | Tidak |   Ya  |
| Logout                 |    Tidak   |   Ya  |   Ya  |

## Alur Penggunaan Aplikasi

1. Pengunjung membuka halaman utama.
2. Pengunjung menekan tombol login.
3. Sistem memeriksa username dan password pada tabel `users`.
4. Jika data benar, sistem membuat session pengguna.
5. Pengguna diarahkan ke halaman katalog produk.
6. User biasa hanya dapat melihat data produk.
7. Admin dapat menambah, mengedit, dan menghapus produk.
8. Pengguna menekan logout untuk mengakhiri session.

## Teknologi yang Digunakan

| Komponen                | Teknologi                |
| ----------------------- | ------------------------ |
| Bahasa pemrograman      | PHP 8.2 atau lebih baru  |
| Framework backend       | CodeIgniter 4.7.4        |
| Database                | MySQL atau MariaDB       |
| Database driver         | MySQLi                   |
| Frontend                | HTML5, CSS3, JavaScript  |
| Framework CSS           | Bootstrap 5.3            |
| Ikon                    | Font Awesome 6.4         |
| Font                    | Google Fonts — Inter     |
| Animasi                 | Animate.css              |
| Dependency manager      | Composer                 |
| Web server pengembangan | CodeIgniter Spark Server |

> Antarmuka memuat Bootstrap, Font Awesome, Google Fonts, dan Animate.css melalui CDN. Koneksi internet diperlukan agar seluruh aset eksternal tampil dengan sempurna.

## Arsitektur Aplikasi

InventoryHub menggunakan pola MVC.

### Model

Model menangani komunikasi dengan database.

* `ProductModel` menggunakan tabel `products`.
* `UserModel` menggunakan tabel `users`.

### View

View menangani tampilan antarmuka.

* `Home.php` — halaman utama.
* `auth/login.php` — halaman login.
* `products/index.php` — daftar produk.
* `products/create.php` — form tambah produk.
* `products/edit.php` — form edit produk.
* `layout/template.php` — template utama, navbar, gaya, dan footer.

### Controller

Controller menerima request, menjalankan logika aplikasi, memanggil model, dan mengirim data ke view.

* `Home` — menampilkan halaman utama.
* `Auth` — menangani login dan logout.
* `Products` — menangani operasi CRUD produk.

### Filter

Filter membatasi akses terhadap route tertentu.

* `AuthFilter` memastikan pengguna sudah login.
* `AdminFilter` memastikan pengguna memiliki role `admin`.

## Struktur Direktori Penting

```text
ci4-crud/
├── app/
│   ├── Config/
│   │   ├── Database.php
│   │   ├── Filters.php
│   │   └── Routes.php
│   ├── Controllers/
│   │   ├── Auth.php
│   │   ├── Home.php
│   │   └── Products.php
│   ├── Database/
│   │   ├── Migrations/
│   │   └── Seeds/
│   │       └── UserSeeder.php
│   ├── Filters/
│   │   ├── AdminFilter.php
│   │   └── AuthFilter.php
│   ├── Models/
│   │   ├── ProductModel.php
│   │   └── UserModel.php
│   └── Views/
│       ├── auth/
│       │   └── login.php
│       ├── layout/
│       │   └── template.php
│       ├── products/
│       │   ├── create.php
│       │   ├── edit.php
│       │   └── index.php
│       └── Home.php
├── public/
│   ├── uploads/
│   │   └── products/
│   └── index.php
├── writable/
├── .env
├── composer.json
├── spark
└── README.md
```

## Daftar Route

| Method | URL                     | Controller           | Akses  | Fungsi                         |
| ------ | ----------------------- | -------------------- | ------ | ------------------------------ |
| GET    | `/`                     | `Home::index`        | Publik | Menampilkan halaman utama      |
| GET    | `/login`                | `Auth::login`        | Publik | Menampilkan form login         |
| POST   | `/login/process`        | `Auth::processLogin` | Publik | Memproses autentikasi          |
| GET    | `/logout`               | `Auth::logout`       | Login  | Menghapus session pengguna     |
| GET    | `/products`             | `Products::index`    | Login  | Menampilkan katalog produk     |
| GET    | `/products/create`      | `Products::create`   | Admin  | Menampilkan form tambah produk |
| POST   | `/products/store`       | `Products::store`    | Admin  | Menyimpan produk baru          |
| GET    | `/products/edit/{id}`   | `Products::edit`     | Admin  | Menampilkan form edit produk   |
| POST   | `/products/update/{id}` | `Products::update`   | Admin  | Memperbarui produk             |
| GET    | `/products/delete/{id}` | `Products::delete`   | Admin  | Menghapus produk               |

## Struktur Database

Aplikasi menggunakan database bernama `db_ci4_crud` pada konfigurasi bawaan `.env`.

### Tabel `users`

| Kolom      | Tipe         | Keterangan                     |
| ---------- | ------------ | ------------------------------ |
| `id`       | INT UNSIGNED | Primary key dan auto increment |
| `username` | VARCHAR(50)  | Username untuk login           |
| `password` | VARCHAR(255) | Password yang telah di-hash    |
| `role`     | ENUM         | Nilai `admin` atau `user`      |

### Tabel `products`

| Kolom         | Tipe         | Keterangan                     |
| ------------- | ------------ | ------------------------------ |
| `id`          | INT UNSIGNED | Primary key dan auto increment |
| `nama_produk` | VARCHAR(100) | Nama produk                    |
| `harga`       | INT          | Harga produk dalam rupiah      |
| `stok`        | INT          | Jumlah stok produk             |
| `gambar`      | VARCHAR(255) | Nama file gambar produk        |
| `created_at`  | DATETIME     | Waktu pembuatan data, opsional |
| `updated_at`  | DATETIME     | Waktu pembaruan data, opsional |

## Validasi Data

### Nama Produk

* Wajib diisi.
* Minimal 3 karakter.

### Harga

* Wajib diisi.
* Harus berupa angka.

### Stok

* Wajib diisi.
* Harus berupa angka.

### Gambar

* Bersifat opsional.
* Harus berupa file gambar yang valid.
* Format yang diterima: JPG, JPEG, PNG, atau WEBP.
* Ukuran maksimal 2 MB.

## Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan perangkat memiliki:

* PHP 8.2 atau lebih baru
* Composer
* MySQL atau MariaDB
* Ekstensi PHP `intl`
* Ekstensi PHP `mbstring`
* Ekstensi PHP `mysqli` atau `mysqlnd`
* Ekstensi PHP `json`
* Web browser modern

Untuk pengguna Windows, aplikasi dapat dijalankan menggunakan XAMPP, Laragon, atau instalasi PHP dan MySQL terpisah.

## Instalasi dan Konfigurasi

### 1. Siapkan Proyek

Ekstrak proyek, kemudian masuk ke direktorinya:

```bash
cd ci4-crud
```

### 2. Instal Dependency

```bash
composer install
```

Jika folder `vendor` sudah tersedia, perintah ini tetap disarankan untuk memastikan dependency sesuai dengan `composer.lock`.

### 3. Konfigurasi Environment

Pastikan file `.env` tersedia. Apabila hanya ada file `env`, salin menjadi `.env`:

```bash
cp env .env
```

Untuk Windows Command Prompt:

```bat
copy env .env
```

Atur konfigurasi utama:

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = db_ci4_crud
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Sesuaikan username, password, port, dan nama database dengan konfigurasi MySQL pada perangkat Anda.

### 4. Buat Database

Jalankan perintah SQL berikut melalui phpMyAdmin, MySQL Workbench, atau terminal MySQL:

```sql
CREATE DATABASE IF NOT EXISTS db_ci4_crud
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE db_ci4_crud;
```

### 5. Buat Tabel

Untuk instalasi bersih, tabel dapat dibuat menggunakan SQL berikut:

```sql
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);

CREATE TABLE products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    gambar VARCHAR(255) NOT NULL DEFAULT 'default.jpg',
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);
```

### 6. Tambahkan Akun Bawaan

Jalankan seeder:

```bash
php spark db:seed UserSeeder
```

Seeder akan membuat akun admin dan user untuk pengujian.

### 7. Siapkan Direktori Gambar

Pastikan direktori berikut tersedia dan dapat ditulis oleh aplikasi:

```text
public/uploads/products/
```

Untuk Linux atau macOS:

```bash
mkdir -p public/uploads/products
chmod -R 775 public/uploads/products
```

Tambahkan gambar bawaan dengan lokasi:

```text
public/uploads/products/default.jpg
```

### 8. Jalankan Aplikasi

```bash
php spark serve
```

Buka alamat berikut pada browser:

```text
http://localhost:8080
```

## Akun Bawaan

Akun berikut dibuat oleh `UserSeeder`:

| Role  | Username | Password   |
| ----- | -------- | ---------- |
| Admin | `admin`  | `admin123` |
| User  | `user`   | `user123`  |

> Akun tersebut hanya ditujukan untuk pengembangan dan demonstrasi. Ganti password sebelum aplikasi digunakan pada lingkungan produksi.

## Cara Menggunakan Aplikasi

### Login sebagai Admin

1. Buka `/login`.
2. Masukkan username `admin`.
3. Masukkan password `admin123`.
4. Setelah login, halaman katalog menampilkan tombol tambah, edit, dan hapus.

### Menambahkan Produk

1. Buka halaman produk.
2. Tekan **Tambah Produk Baru**.
3. Isi nama produk, harga, dan stok.
4. Pilih gambar jika diperlukan.
5. Tekan tombol simpan.

### Mengedit Produk

1. Buka halaman produk.
2. Tekan **Edit** pada produk yang akan diperbarui.
3. Ubah data yang diperlukan.
4. Pilih gambar baru jika ingin mengganti gambar lama.
5. Tekan tombol simpan perubahan.

### Menghapus Produk

1. Buka halaman produk.
2. Tekan **Hapus** pada produk yang dipilih.
3. Setujui dialog konfirmasi.
4. Sistem menghapus data produk dan file gambarnya.

### Login sebagai User

1. Login dengan username `user` dan password `user123`.
2. User dapat melihat seluruh data produk.
3. Tombol tambah, edit, dan hapus tidak ditampilkan.

## Catatan Keamanan

Aplikasi telah menggunakan beberapa mekanisme dasar:

* Password disimpan dalam bentuk hash.
* Autentikasi disimpan menggunakan session.
* Route produk dilindungi `AuthFilter`.
* Route pengelolaan produk dilindungi `AdminFilter`.
* Output data produk menggunakan fungsi escaping pada view.
* File gambar diperiksa berdasarkan tipe, MIME, dan ukuran.

Untuk penggunaan produksi, disarankan melakukan peningkatan berikut:

* Aktifkan perlindungan CSRF.
* Gunakan HTTPS.
* Ubah proses hapus menjadi request POST atau DELETE.
* Tambahkan validasi nilai harga dan stok agar tidak negatif.
* Tambahkan rate limiting pada halaman login.
* Gunakan konfigurasi cookie session yang aman.
* Jangan menggunakan akun dan password bawaan.
* Pindahkan konfigurasi sensitif ke environment server.
* Batasi izin tulis hanya pada direktori yang diperlukan.

## Troubleshooting

### Halaman Utama Tidak Ditemukan pada Linux

Controller memanggil view dengan nama:

```php
view('home', $data)
```

Sementara file proyek bernama `app/Views/Home.php`. Sistem operasi yang membedakan huruf besar dan kecil dapat mengalami masalah. Samakan nama file menjadi `home.php` atau ubah pemanggilan view menjadi `view('Home', $data)`.

### Tabel `products` Tidak Dibuat oleh Migration

Pada versi proyek ini, file migration produk bertimestamp masih belum memuat definisi tabel secara lengkap. Gunakan SQL pada bagian instalasi atau lengkapi file migration produk sebelum menjalankan:

```bash
php spark migrate
```

### Gambar Bawaan Tidak Muncul

Pastikan file berikut benar-benar tersedia:

```text
public/uploads/products/default.jpg
```

Perhatikan penggunaan nama folder `products` dalam bentuk jamak.

### Gambar Gagal Diunggah

Periksa hal berikut:

* File tidak lebih dari 2 MB.
* Format file didukung.
* Direktori `public/uploads/products` tersedia.
* Web server memiliki izin menulis ke direktori tersebut.
* Konfigurasi `upload_max_filesize` dan `post_max_size` pada `php.ini` mencukupi.

### Tidak Bisa Terhubung ke Database

Periksa konfigurasi `.env`:

* Host database
* Nama database
* Username
* Password
* Port
* Driver `MySQLi`

### Tampilan Tidak Sempurna

Pastikan perangkat memiliki koneksi internet karena beberapa aset frontend diambil melalui CDN.

## Pengembangan Lanjutan

Beberapa fitur yang dapat ditambahkan:

* Pencarian dan filter produk
* Pagination
* Kategori produk
* Riwayat perubahan stok
* Transaksi barang masuk dan keluar
* Dashboard statistik persediaan
* Ekspor data ke PDF atau Excel
* REST API
* Registrasi dan manajemen pengguna
* Reset password
* Audit log aktivitas admin
* Soft delete
* CSRF protection
* Unit test dan feature test
* Penyimpanan gambar pada cloud storage
* Deployment menggunakan Apache, Nginx, atau Docker

## Lisensi

Proyek ini menggunakan CodeIgniter 4 yang didistribusikan dengan lisensi MIT. Lihat file `LICENSE` untuk informasi lebih lanjut.
