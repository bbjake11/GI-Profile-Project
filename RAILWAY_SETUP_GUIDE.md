# 🚀 Railway Deployment Guide - Samurai Travel

## Complete Step-by-Step Guide to Deploy on Railway with MySQL

---

## ✅ Step 1: Add a New Project in Railway

**Yes, you can have multiple projects in Railway!**

1. **Go to Railway Dashboard**: https://railway.app/
2. **Click "New Project"** (top right or in the sidebar)
3. **Select "Empty Project"** (we'll add services manually)
4. **Name your project**: `Samurai Travel` (or any name you prefer)
5. **Click "Create Project"**

**✅ You now have a new project separate from your other project!**

---

## ✅ Step 2: Add MySQL Database

1. **In your new Railway project**, click **"+ New"** button
2. **Select "Database"** from the dropdown
3. **Choose "MySQL"**
4. **Railway will automatically create:**
   - Database instance
   - Database name
   - Username
   - Password
   - Host URL
   - Port

5. **⚠️ IMPORTANT: Save these credentials!**
   - Click on the **MySQL service** in your project
   - Go to the **"Variables"** tab
   - You'll see these variables:
     - `MYSQLHOST` (e.g., `containers-us-west-XXX.railway.app`)
     - `MYSQLPORT` (usually `3306`)
     - `MYSQLDATABASE` (e.g., `railway`)
     - `MYSQLUSER` (e.g., `root`)
     - `MYSQLPASSWORD` (a long random password)
   - **Copy these values** - you'll need them in Step 5!

---

## ✅ Step 3: Connect Your Code Repository

### Option A: Deploy from GitHub (Recommended)

1. **Push your code to GitHub** (if not already):
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git remote add origin https://github.com/YOUR_USERNAME/samurai-travel.git
   git push -u origin main
   ```

2. **In Railway Dashboard:**
   - Click **"+ New"** in your project
   - Select **"GitHub Repo"**
   - **Authorize Railway** to access your GitHub (if first time)
   - **Select your repository**: `samurai-travel` (or whatever you named it)
   - Click **"Deploy Now"**

3. **Railway will automatically:**
   - Detect it's a Laravel project
   - Start building your app
   - Set up the environment

### Option B: Deploy from Local Files (Using Railway CLI)

1. **Install Railway CLI:**
   ```bash
   npm install -g @railway/cli
   ```

2. **Login to Railway:**
   ```bash
   railway login
   ```
   (This will open your browser to authenticate)

3. **Navigate to your project folder:**
   ```bash
   cd "C:\Users\Brandon\Desktop\Samuray Travel\samurai_travel"
   ```

4. **Link to your Railway project:**
   ```bash
   railway link
   ```
   (Select your "Samurai Travel" project)

5. **Deploy:**
   ```bash
   railway up
   ```

---

## ✅ Step 4: Configure Build Settings

Railway should auto-detect Laravel, but let's make sure:

1. **In Railway Dashboard**, click on your **Laravel service**
2. **Go to "Settings"** tab
3. **Check "Build Command"** - should be:
   ```
   composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache
   ```
4. **Check "Start Command"** - should be:
   ```
   php artisan serve --host=0.0.0.0 --port=$PORT
   ```

**If these aren't set, Railway will use the `Procfile` or `railway.json` we created.**

---

## ✅ Step 5: Configure Environment Variables

**This is CRITICAL for connecting to MySQL!**

1. **In Railway Dashboard**, click on your **Laravel service** (not MySQL)
2. **Go to "Variables"** tab
3. **Click "Raw Editor"** (easier to paste all at once)
4. **Add these variables:**

```env
APP_NAME=Samurai Travel
APP_ENV=production
APP_KEY=base64:9IqZFzqjyZvE8I0Iz0vkAPIof7JPPNFdpqLV7AT1/es=
APP_DEBUG=false
APP_URL=https://your-app-name.up.railway.app

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```

**⚠️ IMPORTANT NOTES:**
- `DB_HOST`, `DB_PORT`, etc. use `${{MySQL.VARIABLE_NAME}}` syntax - Railway will automatically inject MySQL credentials!
- `APP_URL` - You'll get this after first deployment (something like `https://samurai-travel-production.up.railway.app`)
- **Don't forget to update `APP_URL`** after Railway gives you the URL!

5. **Click "Save"**

---

## ✅ Step 6: Get Your Railway URL

1. **After deployment completes**, Railway will generate a URL
2. **In your Laravel service**, go to **"Settings"** tab
3. **Find "Public Domain"** section
4. **Click "Generate Domain"** (if not already generated)
5. **Copy the URL** (e.g., `https://samurai-travel-production.up.railway.app`)
6. **Go back to Variables** and update `APP_URL` with this URL
7. **Redeploy** (Railway will auto-redeploy when you save variables)

---

## ✅ Step 7: Run Database Migrations

**After your first successful deployment:**

### Option A: Using Railway Dashboard

1. **Click on your Laravel service**
2. **Go to "Deployments"** tab
3. **Click on the latest deployment**
4. **Click "View Logs"**
5. **Look for any errors** - if migrations fail, you'll see them here

### Option B: Using Railway CLI (Recommended)

1. **Open terminal** in your project folder
2. **Run migrations:**
   ```bash
   railway run php artisan migrate --force
   ```
   (The `--force` flag is needed for production)

3. **Run seeders** (if you have seeders):
   ```bash
   railway run php artisan db:seed --force
   ```

4. **You should see:**
   ```
   Migration table created successfully.
   Migrating: 2014_10_12_000000_create_users_table
   Migrated:  2014_10_12_000000_create_users_table
   ... (more migrations)
   ```

---

## ✅ Step 8: Verify Everything Works

1. **Visit your Railway URL** (from Step 6)
2. **You should see your Laravel homepage!**
3. **Test these:**
   - ✅ Homepage loads
   - ✅ Navigation works
   - ✅ Database connection works (try logging in or viewing data)
   - ✅ No errors in browser console

---

## 🆘 Troubleshooting

### Error: "Database Connection Failed"

**Solution:**
1. **Check Variables** - Make sure `DB_HOST`, `DB_USERNAME`, etc. are correct
2. **Verify MySQL service is running** - Check Railway dashboard
3. **Use Railway's variable references:**
   - Instead of hardcoding: `DB_HOST=containers-us-west-XXX.railway.app`
   - Use: `DB_HOST=${{MySQL.MYSQLHOST}}`
   - This ensures Railway updates them automatically!

### Error: "500 Internal Server Error"

**Solution:**
1. **Check logs** in Railway Dashboard → Deployments → View Logs
2. **Verify `APP_KEY` is set** in Variables
3. **Check file permissions** - Railway handles this automatically, but verify:
   ```bash
   railway run php artisan storage:link
   ```

### Error: "APP_KEY not set"

**Solution:**
1. **Generate a new key:**
   ```bash
   railway run php artisan key:generate
   ```
2. **Copy the generated key** from the output
3. **Update `APP_KEY`** in Railway Variables

### CSS/JS Not Loading

**Solution:**
1. **Build assets before deploying:**
   ```bash
   npm run production
   ```
2. **Commit and push** the built files
3. **Or add to build command** in Railway:
   ```
   npm install && npm run production && composer install --no-dev --optimize-autoloader
   ```

### Migrations Not Running Automatically

**Solution:**
1. **Add to Railway build command:**
   ```
   composer install --no-dev --optimize-autoloader && php artisan migrate --force && php artisan config:cache
   ```
2. **Or run manually** using Railway CLI (Step 7)

---

## 📋 Quick Checklist

- [ ] Created new Railway project
- [ ] Added MySQL database service
- [ ] Saved MySQL credentials
- [ ] Connected GitHub repo (or deployed via CLI)
- [ ] Configured environment variables
- [ ] Updated `APP_URL` with Railway domain
- [ ] Ran database migrations
- [ ] Tested website at Railway URL
- [ ] Everything works! 🎉

---

## 💰 Railway Pricing

- **Free Tier**: $5 credit/month
- **MySQL**: Included in free tier
- **Usually enough** for small Laravel apps
- **Pay-as-you-go** after free credit

---

## 🎯 Summary

**You can have multiple projects in Railway!** Each project is completely separate.

**Steps Recap:**
1. ✅ Create new project
2. ✅ Add MySQL database
3. ✅ Deploy Laravel app (GitHub or CLI)
4. ✅ Configure environment variables
5. ✅ Get Railway URL
6. ✅ Run migrations
7. ✅ Test your live site!

**Your site will be live at:** `https://your-app-name.up.railway.app`

---

## 💡 Pro Tips

- **Use Railway's variable references** (`${{MySQL.MYSQLHOST}}`) instead of hardcoding values
- **Check logs regularly** - Railway has excellent logging
- **Enable auto-deploy** - Railway redeploys on every GitHub push
- **Monitor usage** - Check Railway dashboard for resource usage

**You're all set!** 🚀

If you encounter any issues, check the logs in Railway Dashboard → Deployments → View Logs.
