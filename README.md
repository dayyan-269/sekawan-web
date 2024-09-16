# Spesifikasi
* PHP: 8.0.2
* Laravel: 9.19
* Database: MariaDB 11.1.2
* Data Model: [GDrive](https://drive.google.com/file/d/1tTb7pc5sBm3vm5Hh0Vy6CADqCEL_tH-8/view?usp=sharing).
* Activity Diagram: [GDrive](https://drive.google.com/file/d/1-KODmmauQR_36_1e5z8xN_08xugZMN9c/view?usp=sharing).

# Instalasi
* Jalankan `git clone https://github.com/dayyan-269/sekawan-web.git` di CLI.
* Jalankan `composer install` di CLI.
* Copy .env.example to .env
* Jalankan `php artisan key:generate`.
* Buat database kemudian pastikan konfigurasi di .env telah tepat.
* Jalankan `php artisan migrate --seed`, atau anda juga dapat langsung melakukan import dari file .sql di folder db-dump.
* Jalankan `php artisan serve`.
* Kemudian buka url http://localhost:8000 atau http://127.0.0.1:8000.

# Akun Pengguna
* Admin: admin@email.com | password123
* Supervisor: supervisor@email.com | password123
* Supervisor 2: supervisor2@email.com | password123
