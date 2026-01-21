# 🔐 Railway Environment Variables - Complete List

## Your MySQL Database Credentials

Based on your Railway MySQL service, here are your database variables:

```
MYSQLHOST=mysql.railway.internal
MYSQLPORT=3306
MYSQLDATABASE=railway
MYSQLUSER=root
MYSQLPASSWORD=chqEdPaqukCxLRskoGsFcrztBPbtvZLd
```

---

## Complete Environment Variables for Laravel Service

Copy and paste this into Railway → Laravel Service → Variables → Raw Editor:

### Using Variable References (Recommended)

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

### Using Actual Values (Alternative)

```env
APP_NAME=Samurai Travel
APP_ENV=production
APP_KEY=base64:9IqZFzqjyZvE8I0Iz0vkAPIof7JPPNFdpqLV7AT1/es=
APP_DEBUG=false
APP_URL=https://your-app-name.up.railway.app

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=mysql.railway.internal
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=chqEdPaqukCxLRskoGsFcrztBPbtvZLd

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

---

## 📝 Important Notes

1. **Variable References vs Actual Values:**
   - **Variable References** (`${{MySQL.MYSQLHOST}}`) automatically update if Railway changes your database credentials
   - **Actual Values** are static - you'll need to update them manually if credentials change
   - **Recommendation**: Use Variable References (Option A)

2. **APP_URL:**
   - Replace `https://your-app-name.up.railway.app` with your actual Railway URL
   - You'll get this URL after Railway generates a domain for your service
   - Go to: Laravel Service → Settings → Generate Domain

3. **APP_KEY:**
   - The key shown is from your existing setup
   - If you need to generate a new one:
     ```bash
     railway run php artisan key:generate
     ```

4. **Database Connection:**
   - Your MySQL service uses internal Railway networking: `mysql.railway.internal`
   - This is correct for services within the same Railway project
   - Port `3306` is the standard MySQL port

---

## 🚀 Quick Setup Steps

1. **Go to Railway Dashboard**
2. **Click on your Laravel service** (not MySQL)
3. **Go to "Variables" tab**
4. **Click "Raw Editor"**
5. **Paste one of the configurations above**
6. **Update `APP_URL`** with your Railway domain
7. **Click "Save"**
8. **Railway will automatically redeploy** with new variables

---

## ✅ Verification

After setting variables, verify the connection:

```bash
railway run php artisan migrate:status
```

If you see your migrations listed, the database connection is working! ✅
