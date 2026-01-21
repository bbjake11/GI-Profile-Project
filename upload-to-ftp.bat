@echo off
echo ========================================
echo Laravel Project FTP Upload Script
echo ========================================
echo.

REM FTP Credentials
set FTP_HOST=ftpupload.net
set FTP_USER=if0_40937623
set FTP_PASS=aRDiCEoGBLjvM
set FTP_DIR=/htdocs

echo Preparing files for upload...
echo.

REM Create a temporary script file for FTP commands
set FTP_SCRIPT=%TEMP%\ftp_upload_script.txt

echo open %FTP_HOST% > %FTP_SCRIPT%
echo %FTP_USER% >> %FTP_SCRIPT%
echo %FTP_PASS% >> %FTP_SCRIPT%
echo cd %FTP_DIR% >> %FTP_SCRIPT%
echo binary >> %FTP_SCRIPT%
echo prompt >> %FTP_SCRIPT%

REM Upload all files except excluded ones
echo Uploading files...
echo mput app\*.* >> %FTP_SCRIPT%
echo mput bootstrap\*.* >> %FTP_SCRIPT%
echo mput config\*.* >> %FTP_SCRIPT%
echo mput database\*.* >> %FTP_SCRIPT%
echo mput public\*.* >> %FTP_SCRIPT%
echo mput resources\*.* >> %FTP_SCRIPT%
echo mput routes\*.* >> %FTP_SCRIPT%
echo mput storage\*.* >> %FTP_SCRIPT%
echo mput vendor\*.* >> %FTP_SCRIPT%
echo put artisan >> %FTP_SCRIPT%
echo put composer.json >> %FTP_SCRIPT%
echo put composer.lock >> %FTP_SCRIPT%
echo put package.json >> %FTP_SCRIPT%
echo put webpack.mix.js >> %FTP_SCRIPT%
echo put server.php >> %FTP_SCRIPT%
echo put infinityfree-migrate.php >> %FTP_SCRIPT%

echo quit >> %FTP_SCRIPT%

echo.
echo Starting FTP upload...
echo This may take 20-30 minutes...
echo.

REM Run FTP with the script
ftp -s:%FTP_SCRIPT%

echo.
echo ========================================
echo Upload completed!
echo ========================================
echo.
echo Next steps:
echo 1. Create .htaccess file in /htdocs root
echo 2. Set storage/ permissions to 777
echo 3. Set bootstrap/cache/ permissions to 777
echo 4. Upload .env file
echo 5. Run migrations
echo.
pause
