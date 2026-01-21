# 📤 Upload Instructions - Step by Step

## ✅ Current Status
- ✅ FTP Connected
- ✅ In `/htdocs` folder (correct location!)

---

## STEP 1: Prepare Files Locally (Do This First!)

Before uploading, prepare your files on your computer:

### Open Terminal/Command Prompt:

1. Navigate to your project folder:
```bash
cd "C:\Users\Brandon\Desktop\Samuray Travel\samurai_travel"
```

2. Compile CSS/JS assets:
```bash
npm run production
```

3. Optimize Composer (remove dev dependencies):
```bash
composer install --no-dev --optimize-autoloader
```

4. Cache Laravel files:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**Wait for all commands to complete!**

---

## STEP 2: Upload Files via FileZilla

### In FileZilla:

1. **Left Side (Local Site)**:
   - Navigate to: `C:\Users\Brandon\Desktop\Samuray Travel\samurai_travel`
   - You should see folders like: `app`, `bootstrap`, `config`, `public`, `resources`, etc.

2. **Right Side (Remote Site)**:
   - Make sure you're in `/htdocs` folder ✅ (you already are!)

3. **Select Files to Upload**:
   - In the LEFT panel, select ALL files and folders
   - **EXCEPT** these (don't upload):
     - `node_modules/` folder (too large, not needed)
     - `.git/` folder (not needed on server)
     - `.env` file (we'll create this separately)

4. **Upload**:
   - Right-click on selected files → **Upload**
   - OR drag and drop from left to right
   - **This will take 10-30 minutes** - be patient!

5. **Wait for Upload to Complete**:
   - Watch the bottom panel for progress
   - Wait until "Queue: empty" appears
   - Don't close FileZilla during upload!

---

## STEP 3: Create Root .htaccess File

After files are uploaded:

1. **In FileZilla (Right Side)**:
   - Right-click in `/htdocs` folder
   - Select **"Create new file"**
   - Name it: `.htaccess`

2. **Edit the file**:
   - Right-click `.htaccess` → **View/Edit**
   - Add this content:
   ```apache
   <IfModule mod_rewrite.c>
       RewriteEngine On
       RewriteRule ^(.*)$ public/$1 [L]
   </IfModule>
   ```
   - Save and close

---

## STEP 4: Set File Permissions

After uploading, set permissions:

1. **Find `storage/` folder** in `/htdocs` (right side)
2. **Right-click** → **File Permissions**
3. Set to: **777** (check all boxes)
4. Click **OK**

5. **Find `bootstrap/cache/` folder**
6. **Right-click** → **File Permissions**
7. Set to: **777**
8. Click **OK**

---

## STEP 5: Upload .env File

1. **Find `env-file-for-server.txt`** in your project folder (left side)
2. **Rename it** to `.env` (remove `.txt` extension)
3. **Upload** `.env` file to `/htdocs` folder (right side)

**OR** create it directly on server:
1. Right-click in `/htdocs` → **Create new file**
2. Name: `.env`
3. Right-click → **View/Edit**
4. Copy content from `env-file-for-server.txt`
5. Paste and save

---

## STEP 6: Upload Migration Script

1. **Find `infinityfree-migrate.php`** in your project folder
2. **Upload** it to `/htdocs` folder
3. **Keep it there** - we'll use it next!

---

## STEP 7: Run Migrations

1. **Open your browser**
2. **Visit**: `https://9qnbaco5.infinityfree.com/infinityfree-migrate.php`
3. **Wait** for migrations to complete
4. **You should see**: "Migrations completed successfully!"
5. **IMPORTANT**: Delete `infinityfree-migrate.php` from server after running!

---

## STEP 8: Test Your Website

Visit: `https://9qnbaco5.infinityfree.com`

✅ Your website should be live!

---

## 📋 Quick Checklist

- [ ] Prepared files locally (npm run production, composer install)
- [ ] Uploaded all files to `/htdocs`
- [ ] Created root `.htaccess` file
- [ ] Set `storage/` permissions to 777
- [ ] Set `bootstrap/cache/` permissions to 777
- [ ] Uploaded `.env` file
- [ ] Uploaded `infinityfree-migrate.php`
- [ ] Ran migrations via browser
- [ ] Deleted `infinityfree-migrate.php`
- [ ] Tested website

---

## ⚠️ Important Notes

1. **Upload Time**: First upload may take 20-30 minutes
2. **Don't Close FileZilla**: Keep it open during upload
3. **Check Progress**: Watch bottom panel for upload status
4. **File Permissions**: Must set storage and bootstrap/cache to 777
5. **Delete Migration Script**: Remove `infinityfree-migrate.php` after use!

---

## 🆘 If Something Goes Wrong

### Files Not Uploading:
- Check you're in `/htdocs` folder
- Verify connection is still active
- Try uploading one folder at a time

### Permission Errors:
- Make sure `storage/` and `bootstrap/cache/` are set to 777
- Try setting parent folders to 755

### Website Shows Error:
- Check `.env` file exists and has correct values
- Verify file permissions
- Check error log: `/htdocs/storage/logs/laravel.log`

Good luck! 🚀
