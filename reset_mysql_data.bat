@echo off
echo ========================================
echo XAMPP MySQL Data Reset Script
echo ========================================
echo.
echo WARNING: This will delete ALL MySQL databases!
echo.
set /p confirm="Are you sure you want to continue? (YES to confirm): "
if /i not "%confirm%"=="YES" (
    echo Operation cancelled.
    pause
    exit /b 0
)

echo.
echo Step 1: Stopping MySQL (if running)...
taskkill /F /IM mysqld.exe 2>nul
timeout /t 2 /nobreak >nul

echo.
echo Step 2: Checking XAMPP MySQL path...
if not exist "C:\xampp\mysql\data" (
    echo ERROR: XAMPP MySQL data folder not found!
    echo Please check your XAMPP installation path.
    pause
    exit /b 1
)

echo Found XAMPP MySQL at: C:\xampp\mysql
echo.

echo Step 3: Backing up current data...
if exist "C:\xampp\mysql\data_backup" (
    echo Backup folder already exists. Skipping backup.
) else (
    echo Creating backup...
    xcopy "C:\xampp\mysql\data" "C:\xampp\mysql\data_backup" /E /I /Y >nul
    echo Backup created at: C:\xampp\mysql\data_backup
)

echo.
echo Step 4: Deleting corrupted data...
cd /d "C:\xampp\mysql\data"
del /Q /F *.* >nul 2>&1
for /d %%d in (*) do rd /s /q "%%d" >nul 2>&1
echo Data folder cleared.

echo.
echo Step 5: Restoring default MySQL files...
if not exist "C:\xampp\mysql\backup" (
    echo ERROR: Backup folder not found!
    echo Cannot restore default files.
    echo Please reinstall XAMPP MySQL component.
    pause
    exit /b 1
)

xcopy "C:\xampp\mysql\backup\*" "C:\xampp\mysql\data\" /E /I /Y >nul
echo Default MySQL files restored.

echo.
echo ========================================
echo Reset complete!
echo.
echo Next steps:
echo 1. Open XAMPP Control Panel
echo 2. Try starting MySQL
echo 3. If it starts, create your database
echo ========================================
pause
