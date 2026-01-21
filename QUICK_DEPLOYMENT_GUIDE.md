# 🚀 Quick Deployment Guide - InfinityFree

## ✅ All Credentials Ready!

- **Website**: `https://9qnbaco5.infinityfree.com`
- **Database**: `if0_40937623_samurai_travel`
- **APP_KEY**: Generated ✅
- **.env File**: Ready ✅

---

## 📝 Step-by-Step Instructions

### STEP 1: Prepare Files Locally (5 minutes)

Open terminal in your project folder and run:

```bash
cd samurai_travel

# Compile CSS/JS
npm run production

# Optimize Composer
composer install --no-dev --optimize-autoloader

# Cache Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

### STEP 2: FTP Password

**Your FTP password is your InfinityFree Control Panel password!**

- Use the **same password** you use to log into InfinityFree control panel
- This is the password you use when logging in at infinityfree.net
- No separate FTP password needed

---

### STEP 3: Connect via FTP

1. **Download FileZilla** (free): https://filezilla-project.org/

2. **Connect**:
   ```
   Host: ftpupload.net
   Username: if0_40937623
   Password: aRDiCEoGBLjvM
   Port: 21
   ```
   
   ✅ **Password confirmed!**

3. Click **"Quickconnect"**

4. Navigate to `/htdocs/` or `/public_html/` folder (this is your website root)

---

### STEP 4: Upload Files

**What to upload:**
- ✅ Upload ALL files EXCEPT:
  - `node_modules/` (skip)
  - `.git/` (skip)
  - `.env` (we'll create this on server)

**How to upload:**
1. In FileZilla, left side = your computer, right side = server
2. Navigate to your project folder on left
3. Navigate to `/htdocs/` on right
4. Select all files/folders (Ctrl+A)
5. Right-click → Upload
6. Wait 10-30 minutes for upload to complete

**File Structure on Server:**
```
/htdocs/
  ├── app/
  ├── bootstrap/
  ├── config/
  ├── database/
  ├── public/
  ├── resources/
  ├── routes/
  ├── storage/
  ├── vendor/
  ├── artisan
  ├── composer.json
  └── (all other files)
```

---

### STEP 5: Create Root .htaccess

After uploading, create `.htaccess` file in `/htdocs/` root:

1. Right-click in `/htdocs/` → **Create new file**
2. Name it: `.htaccess`
3. Add this content:
   ```apache
   <IfModule mod_rewrite.c>
       RewriteEngine On
       RewriteRule ^(.*)$ public/$1 [L]
   </IfModule>
   ```
4. Save

---

### STEP 6: Set File Permissions

Right-click on these folders → **File Permissions**:

- `storage/` → **777**
- `bootstrap/cache/` → **777**
- All other files → **644**
- All other folders → **755**

---

### STEP 7: Upload .env File

1. Copy the file `.env.infinityfree.ready`
2. Rename it to `.env`
3. Upload to `/htdocs/` root

**OR** create it directly on server:
1. Right-click in `/htdocs/` → **Create new file**
2. Name it: `.env`
3. Copy content from `.env.infinityfree.ready` file
4. Paste and save

---

### STEP 8: Run Migrations

1. Upload `infinityfree-migrate.php` to `/htdocs/` root
2. Open browser: `https://9qnbaco5.infinityfree.com/infinityfree-migrate.php`
3. Wait for "Migrations completed successfully!"
4. **DELETE** `infinityfree-migrate.php` immediately!

---

### STEP 9: Test Your Website

Visit: `https://9qnbaco5.infinityfree.com`

✅ Should see your homepage!

---

## 🎯 Quick Checklist

- [ ] Ran `npm run production`
- [ ] Ran `composer install --no-dev --optimize-autoloader`
- [ ] Connected to FTP
- [ ] Uploaded all files to `/htdocs/`
- [ ] Created root `.htaccess` file
- [ ] Set permissions (storage: 777, bootstrap/cache: 777)
- [ ] Uploaded `.env` file
- [ ] Uploaded `infinityfree-migrate.php`
- [ ] Ran migrations via browser
- [ ] Deleted `infinityfree-migrate.php`
- [ ] Tested website

---

## ⚠️ Common Issues

### "500 Error"
- Check `.env` file exists
- Check file permissions
- Check error log: `/storage/logs/laravel.log`

### "Database Error"
- Verify database credentials in `.env`
- Check database exists in phpMyAdmin

### "CSS/JS Not Loading"
- Make sure you ran `npm run production`
- Check file paths

---

## 📞 Need Help?

If you get stuck:
1. Check error logs: `/storage/logs/laravel.log`
2. Verify all credentials in `.env`
3. Check file permissions
4. Make sure migrations ran successfully

**You're almost there!** 🚀
