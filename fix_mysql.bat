@echo off
echo ========================================
echo MySQL Troubleshooting Script
echo ========================================
echo.

echo Step 1: Checking for MySQL services...
echo.
sc query MySQL 2>nul
if %errorlevel% equ 0 (
    echo Found MySQL service!
    echo.
    set /p stop="Do you want to stop it? (Y/N): "
    if /i "%stop%"=="Y" (
        echo Stopping MySQL service...
        net stop MySQL
    )
)

sc query MySQL80 2>nul
if %errorlevel% equ 0 (
    echo Found MySQL80 service!
    echo.
    set /p stop="Do you want to stop it? (Y/N): "
    if /i "%stop%"=="Y" (
        echo Stopping MySQL80 service...
        net stop MySQL80
    )
)

sc query MySQL57 2>nul
if %errorlevel% equ 0 (
    echo Found MySQL57 service!
    echo.
    set /p stop="Do you want to stop it? (Y/N): "
    if /i "%stop%"=="Y" (
        echo Stopping MySQL57 service...
        net stop MySQL57
    )
)

echo.
echo Step 2: Checking port 3306 usage...
echo.
netstat -ano | findstr :3306
if %errorlevel% equ 0 (
    echo.
    echo WARNING: Port 3306 is in use!
    echo Check the output above for the PID.
    echo You can kill the process with: taskkill /PID [PID] /F
) else (
    echo Port 3306 appears to be free.
)

echo.
echo Step 3: Checking XAMPP MySQL path...
if exist "C:\xampp\mysql\bin\mysqld.exe" (
    echo Found XAMPP MySQL at: C:\xampp\mysql
    echo.
    echo You can try:
    echo 1. Check logs: C:\xampp\mysql\data\*.err
    echo 2. Check my.ini: C:\xampp\mysql\bin\my.ini
) else (
    echo XAMPP MySQL not found at default location.
    echo Please check your XAMPP installation path.
)

echo.
echo ========================================
echo Troubleshooting complete!
echo.
echo Next steps:
echo 1. Try starting MySQL in XAMPP Control Panel
echo 2. If it fails, check the logs mentioned above
echo 3. See FIX_MYSQL_ERROR.md for detailed solutions
echo ========================================
pause
