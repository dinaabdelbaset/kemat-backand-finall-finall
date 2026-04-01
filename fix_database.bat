@echo off
echo ===================================
echo    Fixing homepage database...
echo ===================================
cd /d "E:\مشروع ahmed\booking-app-main (10)\my-kamet"
echo.
echo Step 1: Running migrations...
php artisan migrate --force
echo.
echo Step 2: Seeding homepage data...
php artisan db:seed --class=HomepageSeeder
echo.
echo Step 3: Checking data count...
php artisan tinker --execute="echo 'Destinations: '.App\Models\Destination::count();"
echo.
echo ===================================
echo    Done! Refresh your browser.
echo ===================================
pause
