[![Beta](https://img.shields.io/badge/-Beta-8A2BE2?style=flat)]()

# Sales Management System

A web-based sales management system for managing products, transactions, and sales reports.

## Features

- Product management (add, edit, delete)
- Sales transactions
- Daily/monthly sales reports
- Automated stock management

## Installation

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