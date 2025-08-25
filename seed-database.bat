@echo off
echo ========================================
echo   Laravel Database Reset Tool
echo ========================================
echo.

echo [1] Quick Test Data (2 customers, 5 repairs)
echo [2] Essential Data (5 customers, 20 repairs) 
echo [3] Full Database Seed (Admin + Essential Data)
echo [4] Fresh Migration + Full Seed
echo [5] Exit
echo.

set /p choice="Choose an option (1-5): "

if %choice%==1 (
    echo.
    echo Running Quick Test Seeder...
    php artisan db:seed --class=QuickTestSeeder
) else if %choice%==2 (
    echo.
    echo Running Essential Data Seeder...
    php artisan db:seed --class=EssentialDataSeeder
) else if %choice%==3 (
    echo.
    echo Running Full Database Seeder...
    php artisan db:seed
) else if %choice%==4 (
    echo.
    echo Fresh Migration + Seeding...
    php artisan migrate:fresh --seed
) else if %choice%==5 (
    echo.
    echo Goodbye!
    exit
) else (
    echo.
    echo Invalid option!
)

echo.
echo Done! Press any key to exit...
pause > nul
