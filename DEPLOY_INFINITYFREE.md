# Deploy Laravel to InfinityFree - Step by Step Guide

## Prerequisites
- FTP client (FileZilla, WinSCP, or any FTP client)
- Your Laravel project ready for deployment

---

## Step 1: Prepare Your Laravel Project

### 1.1 Compile Assets
```bash
cd samurai_travel
npm run production
```

### 1.2 Optimize for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 1.3 Create .env File
Make sure your `.env` file is ready (we'll update it with InfinityFree database credentials later).

---

## Step 2: Create InfinityFree Account

1. Go to **https://www.infinityfree.net/**
2. Click **"Sign Up"** (top right)
3. Fill in:
   - Email address
   - Password
   - Username
4. Verify your email address
5. Log in to your account

---

## Step 3: Create a New Website

1. In InfinityFree control panel, click **"Create Website"**
2. Choose **"Subdomain"** (free option)
3. Enter your subdomain name (e.g., `samurai-travel`)
4. Your URL will be: `samurai-travel.infinityfree.net`
5. Click **"Create Website"**

---

## Step 4: Set Up Database

1. In InfinityFree control panel, go to **"MySQL Databases"**
2. Click **"Create New Database"**
3. Enter database name (e.g., `epiz_12345678_samurai`)
4. Enter database username (e.g., `epiz_12345678_admin`)
5. Enter database password (save this!)
6. Click **"Create Database"**
7. **IMPORTANT**: Note down these details:
   - Database Host: Usually `sqlXXX.epizy.com` (shown in database list)
   - Database Name: `epiz_12345678_samurai`
   - Database Username: `epiz_12345678_admin`
   - Database Password: (the one you created)

---

## Step 5: Get FTP Credentials

1. In InfinityFree control panel, go to **"FTP Accounts"**
2. You'll see your FTP details:
   - **FTP Server**: `ftpupload.net` (or similar)
   - **FTP Username**: Usually `epiz_XXXXXXX`
   - **FTP Password**: (shown in control panel)
   - **Port**: Usually `21`
3. Save these credentials

---

## Step 6: Prepare Files for Upload

### 6.1 Create Upload Package
You need to upload ALL files except:
- `node_modules/` (don't upload)
- `.git/` (don't upload)
- `.env` (we'll create this on server)

### 6.2 Files Structure on Server
InfinityFree uses standard shared hosting structure:
```
/public_html/          <- This is your web root (equivalent to Laravel's /public)
/htdocs/               <- Alternative name for public_html
```

**IMPORTANT**: For Laravel, you need to upload files differently:
- Upload ALL Laravel files to `/public_html/`
- Move contents of `/public/` folder to `/public_html/` (root)
- Keep Laravel structure intact

---

## Step 7: Upload Files via FTP

### 7.1 Connect via FTP
1. Open your FTP client (FileZilla recommended)
2. Enter FTP details:
   - **Host**: `ftpupload.net` (or from control panel)
   - **Username**: Your FTP username
   - **Password**: Your FTP password
   - **Port**: `21`
3. Click **"Connect"**

### 7.2 Upload Structure
Upload your files maintaining this structure:
```
/public_html/
  ├── app/
  ├── bootstrap/
  ├── config/
  ├── database/
  ├── resources/
  ├── routes/
  ├── storage/
  ├── vendor/
  ├── .env (we'll create this)
  ├── artisan
  ├── composer.json
  ├── composer.lock
  ├── index.php (from public/index.php)
  ├── .htaccess (from public/.htaccess)
  ├── css/
  ├── js/
  └── (all other public files)
```

**Note**: Upload can take 10-30 minutes depending on file size.

---

## Step 8: Configure Laravel for Shared Hosting

### 8.1 Create .htaccess in Root
Create a new `.htaccess` file in `/public_html/` root with:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### 8.2 Update public/index.php
The `public/index.php` needs to point to correct paths. Update these lines:

```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

Should become (if files are in root):
```php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
```

**OR** if you kept Laravel structure:
Keep as is, but ensure paths are correct.

---

## Step 9: Create .env File on Server

1. Via FTP, create `.env` file in `/public_html/`
2. Add this content (update with YOUR database details):

```env
APP_NAME="Samurai Travel"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://samurai-travel.infinityfree.net

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=sqlXXX.epizy.com
DB_PORT=3306
DB_DATABASE=epiz_12345678_samurai
DB_USERNAME=epiz_12345678_admin
DB_PASSWORD=your_database_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### 9.1 Generate APP_KEY
Run this locally first:
```bash
php artisan key:generate --show
```
Copy the key and paste it in `.env` as `APP_KEY=...`

---

## Step 10: Set File Permissions

Via FTP client, set permissions:
- `/storage/` folder: **755** or **777**
- `/bootstrap/cache/` folder: **755** or **777**
- All files: **644**
- All folders: **755**

**Note**: Some FTP clients allow bulk permission changes.

---

## Step 11: Run Migrations

You have two options:

### Option A: Via SSH (if available)
```bash
php artisan migrate --force
php artisan db:seed --force
```

### Option B: Via Control Panel
1. Go to InfinityFree control panel
2. Find **"Terminal"** or **"SSH"** section
3. Run commands there

### Option C: Create Migration Script
Create a PHP file `migrate.php` in root:

```php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$kernel->call('migrate', ['--force' => true]);
$kernel->call('db:seed', ['--force' => true]);
echo "Migrations completed!";
```

Access via browser: `https://samurai-travel.infinityfree.net/migrate.php`
**DELETE THIS FILE AFTER RUNNING!**

---

## Step 12: Test Your Site

1. Visit: `https://samurai-travel.infinityfree.net`
2. Check if homepage loads
3. Test login functionality
4. Check database connections

---

## Troubleshooting

### Error: "500 Internal Server Error"
- Check `.env` file exists and has correct values
- Check file permissions (storage, bootstrap/cache)
- Check error logs in `/storage/logs/laravel.log`

### Error: "Database Connection Failed"
- Verify database credentials in `.env`
- Check database host is correct
- Ensure database exists in InfinityFree control panel

### Error: "Class not found" or "Autoload error"
- Run `composer install --no-dev --optimize-autoloader` locally
- Upload `vendor/` folder again
- Check `composer.json` is uploaded

### Error: "Storage not writable"
- Set `/storage/` folder permissions to **777**
- Set `/bootstrap/cache/` permissions to **777**

### CSS/JS Not Loading
- Run `npm run production` locally
- Upload compiled files from `/public/css/` and `/public/js/`
- Check file paths in HTML

---

## Important Notes

1. **Free Tier Limitations**:
   - Account may be suspended if inactive for 30 days
   - Limited CPU and memory resources
   - May be slower than paid hosting

2. **Security**:
   - Set `APP_DEBUG=false` in production
   - Keep `.env` file secure (not publicly accessible)
   - Regularly update Laravel and dependencies

3. **Performance**:
   - Enable caching: `php artisan config:cache`
   - Optimize autoloader: `composer install --optimize-autoloader --no-dev`

4. **Backup**:
   - Regularly backup your database via phpMyAdmin
   - Keep local copy of code

---

## Quick Checklist

- [ ] Compiled assets (`npm run production`)
- [ ] Created InfinityFree account
- [ ] Created website/subdomain
- [ ] Created MySQL database
- [ ] Got FTP credentials
- [ ] Uploaded all files via FTP
- [ ] Created `.env` file with correct database credentials
- [ ] Set file permissions (storage, bootstrap/cache)
- [ ] Ran migrations
- [ ] Tested website
- [ ] Deleted migration script (if used)

---

## Need Help?

- InfinityFree Support: https://forum.infinityfree.net/
- Laravel Documentation: https://laravel.com/docs

Good luck with your deployment! 🚀
