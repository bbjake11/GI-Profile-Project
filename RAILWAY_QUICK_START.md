# 🚀 Railway Quick Start - Samurai Travel

## Quick Reference Card

### 1️⃣ Create New Project
- Go to https://railway.app/
- Click "New Project" → "Empty Project"
- Name: "Samurai Travel"

### 2️⃣ Add MySQL Database
- Click "+ New" → "Database" → "MySQL"
- Save credentials from Variables tab

### 3️⃣ Deploy Code
**Option A (GitHub):**
- Push code to GitHub
- Railway → "+ New" → "GitHub Repo" → Select repo

**Option B (CLI):**
```bash
npm install -g @railway/cli
railway login
cd samurai_travel
railway link
railway up
```

### 4️⃣ Set Environment Variables
In Laravel service → Variables → Add:

**Option A - Variable References (Recommended):**
```env
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

**Option B - Actual Values:**
```env
DB_CONNECTION=mysql
DB_HOST=mysql.railway.internal
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=chqEdPaqukCxLRskoGsFcrztBPbtvZLd
```

**Plus these required variables:**
```env
APP_NAME=Samurai Travel
APP_ENV=production
APP_KEY=base64:9IqZFzqjyZvE8I0Iz0vkAPIof7JPPNFdpqLV7AT1/es=
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app
```

### 5️⃣ Get Your URL
- Laravel service → Settings → Generate Domain
- Copy URL and update `APP_URL` in Variables

### 6️⃣ Run Migrations
```bash
railway run php artisan migrate --force
railway run php artisan db:seed --force
```

### 7️⃣ Test Your Site
Visit your Railway URL!

---

## 🔑 Key Points

✅ **Multiple Projects**: Yes, you can have multiple projects in Railway  
✅ **MySQL**: Free tier includes MySQL  
✅ **Auto-Deploy**: Railway redeploys on every GitHub push  
✅ **Variables**: Use `${{MySQL.VARIABLE}}` for database credentials  

---

## 📚 Full Guide
See `RAILWAY_SETUP_GUIDE.md` for detailed instructions.
