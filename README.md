[![Beta](https://img.shields.io/badge/-Beta-8A2BE2?style=flat)]()

# Sales Management System

Sistem manajemen penjualan berbasis web.

## Fitur

- Manajemen produk
- Transaksi penjualan
- Laporan penjualan harian/bulanan
- Manajemen stok otomatis

## Cara Instalasi

`ash
git clone https://github.com/RifkyA911/Sales-Management.git
cd Sales-Management
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
`

## Tech Stack

- Backend: Laravel
- Database: MySQL
- Frontend: Blade + Bootstrap