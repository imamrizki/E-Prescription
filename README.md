# E-Prescriptions

## Tech

- [Laravel 8](https://laravel.com/docs/8.x)
- MYSQL 5.7
- jQuery

## Installation

Download project
```sh
git clone https://github.com/imamrizki/E-Prescription.git
cd E-Prescriptions
```

Jalankan perintah dibawah pada terminal

```sh
composer install
```

```sh
buat file .env di dalam project E-Prescriptions lalu paste semua isi file .env.example
```
Lalu jalankan perintah dibawah
```sh
php artisan key:generate
```

```sh
sesuaikan nama database lokal pada variable DB_DATABASE
```

Migrasi dan seeder

```sh
php artisan migrate --seed
```

## Jalankan Project
Jalankan perintah dibawah
```sh
php artisan serve
```
Lalu akses di browser
```sh
127.0.0.1:8000 / localhost:8000
```
