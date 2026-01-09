@echo off
echo ========================================
echo   MARKETPLACE DESAIN - SETUP SCRIPT
echo ========================================
echo.

echo [1/6] Installing PHP dependencies...
composer install --no-interaction
echo.

echo [2/6] Installing Node.js dependencies...
npm install
echo.

echo [3/6] Setting up environment...
if not exist .env (
    copy .env.example .env
    echo .env file created. Please update database credentials.
) else (
    echo .env file already exists.
)
echo.

echo [4/6] Generating application key...
php artisan key:generate
echo.

echo [5/6] Running database migrations and seeding...
php artisan migrate:fresh --seed --force
echo.

echo [6/6] Building frontend assets...
npm run build
echo.

echo ========================================
echo   SETUP COMPLETE!
echo ========================================
echo.
echo Access the application:
echo - Via PHP: php artisan serve (http://127.0.0.1:8000)
echo - Via XAMPP: http://localhost/marketplace-desain/public
echo.
echo Test Credentials:
echo - Admin: admin@example.com / password
echo - Desainer: desainer1@example.com / password
echo - User: user1@example.com / password
echo.
pause
)
php artisan key:generate
echo.

echo [4/6] Setting up database...
php artisan migrate --force
echo.

echo [5/6] Building assets...
npm run build
echo.

echo [6/6] Clearing cache...
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo.

echo ========================================
echo   SETUP COMPLETED SUCCESSFULLY!
echo ========================================
echo.
echo Cara menjalankan aplikasi:
echo 1. Via Laravel Dev Server: php artisan serve
echo 2. Via XAMPP: http://localhost/marketplace-desain/public/
echo.
echo Test users tersedia di README.md
echo.
pause