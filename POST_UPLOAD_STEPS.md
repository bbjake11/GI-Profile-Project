# 📋 Post-Upload Steps - Execute After Upload Completes

## ✅ Step 1: Verify Upload Completed

In FileZilla:
- Check bottom panel shows "Queue: empty"
- Verify these folders exist in `/htdocs/`:
  - ✅ `app/`
  - ✅ `public/`
  - ✅ `storage/`
  - ✅ `vendor/`
  - ✅ `bootstrap/`

---

## ✅ Step 2: Create Root .htaccess File

**Purpose**: Routes all requests to Laravel's `public/` folder

### In FileZilla (Right Side - `/htdocs`):

1. **Right-click** in `/htdocs` folder (empty space)
2. Select **"Create new file"**
3. Name it: `.htaccess` (with the dot at the beginning)
4. **Right-click** `.htaccess` → **View/Edit**
5. **Paste this content**:
   ```apache
   <IfModule mod_rewrite.c>
       RewriteEngine On
       RewriteRule ^(.*)$ public/$1 [L]
   </IfModule>
   ```
6. **Save** and close
7. FileZilla will ask to upload - click **Yes**

---

## ✅ Step 3: Set File Permissions

**Purpose**: Laravel needs write access to storage and cache folders

### In FileZilla (Right Side):

1. **Find `storage/` folder** in `/htdocs/`
2. **Right-click** `storage/` → **File Permissions**
3. Set to: **777**
   - Check all boxes: Read, Write, Execute (for Owner, Group, Public)
   - Or enter: `777` in numeric value
4. Check **"Recurse into subdirectories"**
5. Click **OK**

6. **Find `bootstrap/cache/` folder**
7. **Right-click** `bootstrap/cache/` → **File Permissions**
8. Set to: **777**
9. Check **"Recurse into subdirectories"**
10. Click **OK**

---

## ✅ Step 4: Upload .env File

**Purpose**: Contains database credentials and app configuration

### Option A: Upload Existing File

1. **Left side**: Find `env-file-for-server.txt` in your project folder
2. **Rename it** locally to `.env` (remove `.txt` extension)
3. **Upload** `.env` file to `/htdocs/` root

### Option B: Create on Server

1. **Right side**: Right-click in `/htdocs/` → **Create new file**
2. Name: `.env`
3. **Right-click** `.env` → **View/Edit**
4. **Copy content** from `env-file-for-server.txt`:
   ```
   APP_NAME="Samurai Travel"
   APP_ENV=production
   APP_KEY=base64:9IqZFzqjyZvE8I0Iz0vkAPIof7JPPNFdpqLV7AT1/es=
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
5. **Paste** and **Save**
6. FileZilla will ask to upload - click **Yes**

---

## ✅ Step 5: Upload Migration Script

**Purpose**: Run database migrations and seeders

1. **Left side**: Find `infinityfree-migrate.php` in your project folder
2. **Upload** it to `/htdocs/` root (right side)
3. **Keep it there** - we'll use it next!

---

## ✅ Step 6: Run Migrations

**Purpose**: Create database tables and populate initial data

1. **Open your web browser**
2. **Visit**: `https://9qnbaco5.infinityfree.com/infinityfree-migrate.php`
3. **Wait** for the page to load (may take 30-60 seconds)
4. **You should see**:
   ```
   Laravel Migration Script
   
   Running migrations...
   ✓ Migrations completed successfully!
   
   Running seeders...
   ✓ Seeders completed successfully!
   
   ✓ All done! Please DELETE this file now for security.
   ```

5. **If you see errors**: Note them down and let me know

---

## ✅ Step 7: Delete Migration Script (IMPORTANT!)

**Purpose**: Security - remove the migration script after use

1. **In FileZilla** (right side - `/htdocs`)
2. **Find** `infinityfree-migrate.php`
3. **Right-click** → **Delete**
4. **Confirm deletion**

**⚠️ IMPORTANT**: Always delete this file after running migrations for security!

---

## ✅ Step 8: Test Your Website

1. **Open browser**
2. **Visit**: `https://9qnbaco5.infinityfree.com`
3. **You should see**: Your Laravel homepage!

### Test These:
- ✅ Homepage loads
- ✅ Navigation works
- ✅ Try logging in (if you have test users)
- ✅ Check if database connection works

---

## 🆘 Troubleshooting

### Error: "500 Internal Server Error"
**Solution**:
1. Check `.env` file exists in `/htdocs/`
2. Verify file permissions (`storage/` and `bootstrap/cache/` are 777)
3. Check error log: `/htdocs/storage/logs/laravel.log`

### Error: "Database Connection Failed"
**Solution**:
1. Verify `.env` file has correct database credentials
2. Check database exists in InfinityFree control panel
3. Verify database host: `sql100.infinityfree.com`

### Error: "Storage not writable"
**Solution**:
1. Set `storage/` folder permissions to **777**
2. Set `bootstrap/cache/` folder permissions to **777**
3. Make sure you checked "Recurse into subdirectories"

### CSS/JS Not Loading
**Solution**:
1. Verify `public/css/` and `public/js/` folders exist
2. Check files were uploaded correctly
3. Clear browser cache (Ctrl+F5)

### Migration Script Shows Errors
**Solution**:
1. Check `.env` file has correct database credentials
2. Verify database exists and is accessible
3. Check file permissions
4. Share the error message with me

---

## 📋 Quick Checklist

After upload completes:

- [ ] Verified files uploaded successfully
- [ ] Created `.htaccess` in `/htdocs/` root
- [ ] Set `storage/` permissions to 777
- [ ] Set `bootstrap/cache/` permissions to 777
- [ ] Uploaded `.env` file to `/htdocs/`
- [ ] Uploaded `infinityfree-migrate.php` to `/htdocs/`
- [ ] Visited `https://9qnbaco5.infinityfree.com/infinityfree-migrate.php`
- [ ] Migrations completed successfully
- [ ] Deleted `infinityfree-migrate.php`
- [ ] Tested website at `https://9qnbaco5.infinityfree.com`

---

## 🎯 Summary

**After upload completes, do these 8 steps:**
1. Verify upload ✅
2. Create root `.htaccess` ✅
3. Set permissions (storage, bootstrap/cache) ✅
4. Upload `.env` file ✅
5. Upload migration script ✅
6. Run migrations via browser ✅
7. Delete migration script ✅
8. Test website ✅

**Estimated time**: 10-15 minutes

---

## 💡 Pro Tips

- **Keep FileZilla open** during all steps
- **Don't rush** - take your time with each step
- **If something fails**, check the error message and let me know
- **Save this guide** - you can refer to it anytime

**You're almost there!** 🚀

Once upload completes, follow these steps and let me know if you encounter any issues!
