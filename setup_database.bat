@echo off
echo ========================================
echo Samurai Travel - Database Setup
echo ========================================
echo.

echo Step 1: Testing MySQL connection...
php artisan tinker --execute="try { DB::connection()->getPdo(); echo 'MySQL connection successful!'; } catch(Exception $e) { echo 'MySQL connection failed. Please start MySQL service first.'; exit(1); }"

if %errorlevel% neq 0 (
    echo.
    echo ERROR: MySQL is not running!
    echo Please start MySQL service first:
    echo - XAMPP: Open XAMPP Control Panel and start MySQL
    echo - Or run: net start MySQL
    pause
    exit /b 1
)

echo.
echo Step 2: Creating database (if it doesn't exist)...
mysql -u root -e "CREATE DATABASE IF NOT EXISTS samurai_travel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>nul
if %errorlevel% neq 0 (
    echo Warning: Could not create database via command line.
    echo Please create it manually in phpMyAdmin: http://localhost/phpmyadmin
    echo Database name: samurai_travel
    pause
)

echo.
echo Step 3: Running migrations...
php artisan migrate

echo.
echo Step 4: Seeding database...
php artisan db:seed

echo.
echo ========================================
echo Setup complete!
echo Visit: http://localhost:8000/
echo ========================================
pause
