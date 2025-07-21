@echo off
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload
pause
