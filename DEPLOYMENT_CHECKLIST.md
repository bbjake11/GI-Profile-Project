# Deployment Checklist - InfinityFree

## ✅ Completed Steps

- [x] Database created: `if0_40937623_samurai_travel`
- [x] Database credentials saved:
  - Host: `sql100.infinityfree.com`
  - Port: `3306`
  - Username: `if0_40937623`
  - Password: `aRDiCEoGBLjvM`
  - Database: `if0_40937623_samurai_travel`

## 📋 Remaining Steps

### Step 1: Get Website URL
- [ ] Go to InfinityFree Control Panel → **Websites**
- [ ] Find your website/subdomain
- [ ] Note the URL (e.g., `samurai-travel.infinityfree.net`)
- [ ] **Share it with me** or update `.env.infinityfree` file

### Step 2: Get FTP Credentials
- [ ] Go to InfinityFree Control Panel → **FTP Accounts**
- [ ] Note these details:
  - FTP Host (Server): Usually `ftpupload.net`
  - FTP Username: Usually starts with `if0_` or `epiz_`
  - FTP Password: Your FTP password
  - FTP Port: Usually `21`
- [ ] **Share them with me**

### Step 3: Prepare Project Locally
- [ ] Run: `php prepare-for-infinityfree.php`
- [ ] Run: `php create-env-for-infinityfree.php`
- [ ] Update `.env.infinityfree` with your website URL
- [ ] Generate APP_KEY: `php artisan key:generate --show`
- [ ] Copy APP_KEY to `.env.infinityfree`

### Step 4: Upload Files via FTP
- [ ] Connect to FTP using FileZilla or similar
- [ ] Upload ALL files to `/public_html/`
- [ ] Move contents of `public/` folder to root
- [ ] Upload `.env.infinityfree` as `.env` to server root

### Step 5: Set File Permissions
- [ ] Set `storage/` folder to **777**
- [ ] Set `bootstrap/cache/` folder to **777**
- [ ] Set all files to **644**
- [ ] Set all folders to **755**

### Step 6: Run Migrations
- [ ] Upload `infinityfree-migrate.php` to server
- [ ] Visit: `https://your-site.infinityfree.net/infinityfree-migrate.php`
- [ ] Wait for migrations to complete
- [ ] **DELETE** `infinityfree-migrate.php` after running

### Step 7: Test Website
- [ ] Visit your website URL
- [ ] Test homepage loads
- [ ] Test login functionality
- [ ] Check database connection works

---

## 📝 Current Status

**Database:** ✅ Ready (`if0_40937623_samurai_travel`)  
**Website URL:** ⏳ Waiting  
**FTP Credentials:** ⏳ Waiting  
**Files Prepared:** ⏳ Pending  
**Uploaded:** ⏳ Pending  
**Migrations:** ⏳ Pending  

---

## 🚀 Next Actions

1. **Get Website URL** from Control Panel → Websites
2. **Get FTP Credentials** from Control Panel → FTP Accounts
3. Share both with me, and I'll help you complete the deployment!

---

## 📄 Files Ready

- ✅ `.env.infinityfree` - Environment file template (update APP_URL and APP_KEY)
- ✅ `infinityfree-migrate.php` - Migration script (upload to server)
- ✅ `prepare-for-infinityfree.php` - Preparation script (run locally)
- ✅ `create-env-for-infinityfree.php` - .env generator (run locally)
