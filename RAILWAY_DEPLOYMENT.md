# 🚀 Deploy to Railway - Complete Guide

## ✅ Railway Has MySQL!

**Railway offers:**
- ✅ **MySQL** (free tier available)
- ✅ **PostgreSQL** (free tier available)
- ✅ **$5 free credit/month** (usually enough for small projects)

---

## 🚀 Step 1: Create Railway Account

1. **Go to:** https://railway.app/
2. **Sign up** (free, can use GitHub account)
3. **Verify email**

---

## 🚀 Step 2: Create New Project

1. **Click "New Project"**
2. **Select "Deploy from GitHub repo"** (if you have GitHub)
   - OR **"Empty Project"** (upload files manually)

---

## 🚀 Step 3: Add MySQL Database

1. **In your Railway project**, click **"+ New"**
2. **Select "Database"**
3. **Choose "MySQL"**
4. **Railway will create:**
   - Database name
   - Username
   - Password
   - Host
   - Port

5. **Save these credentials!** You'll need them for `.env`

---

## 🚀 Step 4: Deploy Laravel App

### Option A: Deploy from GitHub (Recommended)

1. **Push your code to GitHub** (if not already)
2. **In Railway**, click "New" → "GitHub Repo"
3. **Select your repository**
4. **Railway will detect Laravel**

### Option B: Deploy from Local Files

1. **Install Railway CLI:**
   ```bash
   npm install -g @railway/cli
   ```

2. **Login:**
   ```bash
   railway login
   ```

3. **Initialize:**
   ```bash
   railway init
   ```

4. **Deploy:**
   ```bash
   railway up
   ```

---

## 🚀 Step 5: Configure Environment Variables

**In Railway Dashboard:**

1. **Go to your Laravel service**
2. **Click "Variables" tab**
3. **Add these variables:**

```env
APP_NAME=Samurai Travel
APP_ENV=production
APP_KEY=base64:9IqZFzqjyZvE8I0Iz0vkAPIof7JPPNFdpqLV7AT1/es=
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app

DB_CONNECTION=mysql
DB_HOST=containers-us-west-XXX.railway.app
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=your_password_here

# Get these from Railway MySQL service!
```

**Important:** Get database credentials from Railway MySQL service!

---

## 🚀 Step 6: Update Database Credentials

**In Railway:**

1. **Click on MySQL service**
2. **Go to "Variables" tab**
3. **You'll see:**
   - `MYSQLHOST`
   - `MYSQLPORT`
   - `MYSQLDATABASE`
   - `MYSQLUSER`
   - `MYSQLPASSWORD`

4. **Copy these to your Laravel service variables**

---

## 🚀 Step 7: Run Migrations

**In Railway:**

1. **Go to your Laravel service**
2. **Click "Deployments"**
3. **Click on latest deployment**
4. **Click "View Logs"**
5. **Or use Railway CLI:**

```bash
railway run php artisan migrate --force
railway run php artisan db:seed --force
```

---

## 🚀 Step 8: Build Configuration

**Railway needs to know how to build Laravel:**

**Create `railway.json` in project root:**

```json
{
  "$schema": "https://railway.app/railway.schema.json",
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "startCommand": "php artisan serve --host=0.0.0.0 --port=$PORT",
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

**OR create `Procfile`:**

```
web: php artisan serve --host=0.0.0.0 --port=$PORT
```

---

## 📋 Railway Advantages:

- ✅ **Easier deployment** (GitHub integration)
- ✅ **Better performance** (not shared hosting)
- ✅ **Free MySQL included**
- ✅ **Automatic SSL**
- ✅ **Better error logs**
- ✅ **Easier to debug**

---

## 💰 Railway Pricing:

- **Free tier:** $5 credit/month
- **Usually enough** for small Laravel apps
- **MySQL included** in free tier

---

## 🎯 Quick Comparison:

| Feature | InfinityFree | Railway |
|---------|-------------|---------|
| MySQL | ✅ Free | ✅ Free |
| Performance | ⚠️ Shared | ✅ Better |
| Ease of Use | ⚠️ Complex | ✅ Easy |
| GitHub Deploy | ❌ No | ✅ Yes |
| SSL | ✅ Free | ✅ Free |
| Cost | ✅ Free | ✅ $5/month credit |

---

## 🚀 Recommendation:

**Railway is MUCH easier!** Especially for Laravel:
- Automatic detection
- Better error handling
- Easier database setup
- GitHub integration

**Want me to help you deploy to Railway?** 🚀
