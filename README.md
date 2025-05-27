# MIBD-TUBES
Tugas Besar MIBD Michael Philippe Purnama - Joseph Davin - Felix Natanael
# MIBD Tubes PHP

Proyek ini adalah aplikasi Youtube sederhana yang dibangun dengan PHP dan Microsoft SQL Server. Proyek ini merupakan bagian dari Tugas Besar Mata Kuliah Manajemen Informasi dan Basis Data.

Catatan 
Aktifkan ekstensi SQLSRV di PHP:
Buka file php.ini di direktori XAMPP, misalnya C:\xampp\php\php.ini.
Cari dan hapus tanda semicolon (;) di baris berikut:
extension=php_sqlsrv.dll //sesuaikan dengan perangkat anda
extension=php_pdo_sqlsrv.dll //sesuaikan dengan perangkat anda
Simpan dan restart Apache di XAMPP.
Jika belum punya driver:
Download Microsoft Drivers for PHP for SQL Server 
https://learn.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver17
Pilih versi sesuai PHP dan sistem kamu, lalu salin .dll ke folder ext.

Cara Menjalankan Project
1. Download & Extract
Download repository ini dan extract folder-nya ke direktori:
"C:\xampp\htdocs\MIBDTubesPHP"
2. Connect ke SQL Server
Pastikan kamu memiliki SQL Server yang aktif di perangkat kamu.
3. Import Database
Jalankan query dari file `LoginDatabaseSQL.sql` menggunakan SQL Server Management Studio (SSMS) atau tools lain untuk membuat database dan tabel yang dibutuhkan.
4. Ubah Koneksi di `testsql.php`
Buka file `testsql.php`, lalu sesuaikan bagian berikut dengan server SQL kamu:
```php
$serverName = "localhost\\SQLEXPRESS"; // Ganti sesuai server pada device anda
$connectionOptions = [
    "Database" => "Tubes", // Nama database
    "TrustServerCertificate" => true
];
```
5. Jalankan Apache
Buka XAMPP dan aktifkan service Apache.
6. Akses Aplikasi
Buka browser dan kunjungi:
http://localhost/MIBDTubesPHP/Register.php

