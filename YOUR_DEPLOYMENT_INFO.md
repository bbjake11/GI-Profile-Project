# Your InfinityFree Deployment Information

## ✅ Complete Credentials

### Website
- **URL**: `9qnbaco5.infinityfree.com`
- **Full URL**: `https://9qnbaco5.infinityfree.com`

### Database
- **Host**: `sql100.infinityfree.com`
- **Port**: `3306`
- **Database Name**: `if0_40937623_samurai_travel`
- **Username**: `if0_40937623`
- **Password**: `aRDiCEoGBLjvM`

### FTP
- **Host**: `ftpupload.net`
- **Username**: `if0_40937623`
- **Password**: ⚠️ **You need to provide this** (your account password or FTP password)
- **Port**: `21` (standard FTP port)

---

## 🚀 Deployment Steps

### Step 1: Prepare Project Locally

Run these commands in your project directory:

```bash
cd samurai_travel

# 1. Compile assets
npm run production

# 2. Optimize Composer
composer install --no-dev --optimize-autoloader

# 3. Generate APP_KEY
php artisan key:generate --show
# Copy the output (starts with "base64:")

# 4. Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 2: Create .env File

Create a file named `.env` in your project root with this content:

```env
APP_NAME="Samurai Travel"
APP_ENV=production
APP_KEY=base64:PASTE_YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://9qnbaco5.infinityfree.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=sql100.infinityfree.com
DB_PORT=3306
DB_DATABASE=if0_40937623_samurai_travel
DB_USERNAME=if0_40937623
DB_PASSWORD=aRDiCEoGBLjvM

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

**Important**: Replace `PASTE_YOUR_GENERATED_KEY_HERE` with the APP_KEY from Step 1.

### Step 3: Connect via FTP

1. **Download FileZilla** (if you don't have it):
   - https://filezilla-project.org/download.php?type=client

2. **Connect to FTP**:
   - **Host**: `ftpupload.net`
   - **Username**: `if0_40937623`
   - **Password**: Your FTP password (account password or separate FTP password)
   - **Port**: `21`
   - Click **"Quickconnect"**

3. **Navigate to your website folder**:
   - In the right panel (Remote site), go to `/htdocs/` or `/public_html/`
   - This is your website root

### Step 4: Upload Files

**Important File Structure for InfinityFree:**

InfinityFree uses shared hosting, so you need to upload files differently:

#### Option A: Standard Laravel Structure (Recommended)

1. Upload ALL Laravel files to `/htdocs/` (or `/public_html/`)
2. Keep the Laravel folder structure intact:
   ```
   /htdocs/
     ├── app/
     ├── bootstrap/
     ├── config/
     ├── database/
     ├── resources/
     ├── routes/
     ├── storage/
     ├── vendor/
     ├── .env
     ├── artisan
     ├── composer.json
     ├── public/
     │   ├── index.php
     │   ├── .htaccess
     │   ├── css/
     │   ├── js/
     │   └── (other public files)
     └── (other Laravel files)
   ```

3. Create `.htaccess` in `/htdocs/` root:
   ```apache
   <IfModule mod_rewrite.c>
       RewriteEngine On
       RewriteRule ^(.*)$ public/$1 [L]
   </IfModule>
   ```

#### Option B: Move Public Files to Root (Alternative)

1. Upload all Laravel files to `/htdocs/`
2. Move contents of `public/` folder to `/htdocs/` root
3. Update `public/index.php` paths:
   ```php
   require __DIR__.'/../vendor/autoload.php';
   ```
   Change to:
   ```php
   require __DIR__.'/vendor/autoload.php';
   ```

**Files to Upload:**
- ✅ All files EXCEPT:
  - `node_modules/` (don't upload)
  - `.git/` (don't upload)
  - `.env` (create on server)
  - `storage/logs/*.log` (can be empty)

**Upload Time:** This may take 10-30 minutes depending on your internet speed.

### Step 5: Set File Permissions

After uploading, set permissions via FTP:

1. **Right-click** on `storage/` folder → **File Permissions** → Set to **777**
2. **Right-click** on `bootstrap/cache/` folder → **File Permissions** → Set to **777**
3. All other files: **644**
4. All other folders: **755**

### Step 6: Create .env on Server

1. Via FTP, create a new file named `.env` in `/htdocs/` root
2. Copy the content from Step 2 above
3. Make sure APP_KEY is set correctly
4. Save the file

### Step 7: Run Migrations

1. Upload `infinityfree-migrate.php` to `/htdocs/` root
2. Visit: `https://9qnbaco5.infinityfree.com/infinityfree-migrate.php`
3. Wait for migrations to complete
4. **IMPORTANT**: Delete `infinityfree-migrate.php` after running!

### Step 8: Test Your Website

1. Visit: `https://9qnbaco5.infinityfree.com`
2. Test homepage
3. Test login functionality
4. Check if database connection works

---

## 🔧 Troubleshooting

### Error: "500 Internal Server Error"
- Check `.env` file exists and has correct values
- Check file permissions (storage, bootstrap/cache)
- Check error logs: `/storage/logs/laravel.log`

### Error: "Database Connection Failed"
- Verify database credentials in `.env`
- Check database host: `sql100.infinityfree.com`
- Ensure database exists: `if0_40937623_samurai_travel`

### Error: "Storage not writable"
- Set `/storage/` folder permissions to **777**
- Set `/bootstrap/cache/` permissions to **777**

### CSS/JS Not Loading
- Make sure you ran `npm run production`
- Check file paths in HTML
- Verify files uploaded correctly

---

## 📋 Quick Checklist

- [ ] Compiled assets (`npm run production`)
- [ ] Generated APP_KEY
- [ ] Created `.env` file with all credentials
- [ ] Connected to FTP
- [ ] Uploaded all files
- [ ] Set file permissions (storage, bootstrap/cache)
- [ ] Created `.env` on server
- [ ] Uploaded `infinityfree-migrate.php`
- [ ] Ran migrations via browser
- [ ] Deleted `infinityfree-migrate.php`
- [ ] Tested website

---

## 🎯 Next Steps

1. **Get your FTP password** (if you haven't already)
2. **Follow Step 1** - Prepare project locally
3. **Follow Step 2** - Create .env file
4. **Follow Step 3-8** - Upload and deploy

Good luck! 🚀
