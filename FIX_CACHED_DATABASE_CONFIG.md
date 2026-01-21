# 🔧 Fix Cached Database Config - Still Using samurai_travel

## Problem

Laravel is still trying to connect to `samurai_travel` database even though you've set `DB_DATABASE=${{MySQL.MYSQLDATABASE}}` in Railway.

**This happens because:**
1. Laravel has cached config with old database name
2. Environment variables aren't being read correctly
3. Variable references might not be resolving

---

## ✅ Step-by-Step Fix

### Step 1: Clear All Laravel Caches

**Run these commands in your terminal:**

```bash
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan route:clear
railway run php artisan view:clear
```

**This clears all cached config that might have the old database name.**

---

### Step 2: Verify Environment Variables Are Set

**Check what Railway actually sees:**

```bash
railway run php artisan tinker --execute="echo 'DB_HOST: ' . env('DB_HOST') . PHP_EOL; echo 'DB_DATABASE: ' . env('DB_DATABASE') . PHP_EOL; echo 'DB_USERNAME: ' . env('DB_USERNAME') . PHP_EOL;"
```

**Expected output:**
```
DB_HOST: mysql.railway.internal
DB_DATABASE: railway
DB_USERNAME: root
```

**If you see `samurai_travel` or empty values**, the variables aren't set correctly in Railway.

---

### Step 3: Check Railway Variables Are Resolving

**In Railway Dashboard:**

1. **Go to Laravel Service → Variables**
2. **Check if `DB_DATABASE` shows actual value:**
   - ✅ **Good**: Shows `railway` (actual value)
   - ❌ **Bad**: Shows `${{MySQL.MYSQLDATABASE}}` (literal text)

**If it shows literal text**, variable references aren't working. Use actual values instead.

---

### Step 4: Fix Variables in Railway (If Needed)

**If variable references aren't working, use actual values:**

**In Railway Dashboard → Laravel Service → Variables → Raw Editor:**

```env
DB_CONNECTION=mysql
DB_HOST=mysql.railway.internal
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=chqEdPaqukCxLRskoGsFcrztBPbtvZLd
```

**Replace the variable references with actual values above.**

---

### Step 5: Verify MySQL Service Name

**Important:** The variable reference format depends on your MySQL service name.

**In Railway Dashboard:**

1. **Check your MySQL service name** (e.g., "MySQL", "mysql", "Database")
2. **If it's not exactly "MySQL"**, update variable references:
   - If service is named "mysql": `${{mysql.MYSQLHOST}}`
   - If service is named "Database": `${{Database.MYSQLHOST}}`
   - Use the exact service name (case-sensitive)

---

### Step 6: Force Railway to Redeploy

**After fixing variables:**

1. **Go to Railway Dashboard → Laravel Service**
2. **Click "Deployments" tab**
3. **Click "Redeploy"** (or wait for auto-redeploy)
4. **Wait for deployment to complete**

---

### Step 7: Clear Cache Again After Redeploy

**After Railway redeploys, clear cache again:**

```bash
railway run php artisan config:clear
railway run php artisan cache:clear
```

---

### Step 8: Test Database Connection

**Test if database connection works:**

```bash
railway run php artisan db:show
```

**Or:**

```bash
railway run php artisan migrate:status
```

**If it works**, you'll see database info or migration status.  
**If it still fails**, continue to Step 9.

---

### Step 9: Check What Database Laravel Is Trying to Use

**Debug command:**

```bash
railway run php artisan tinker --execute="echo 'Database: ' . config('database.connections.mysql.database') . PHP_EOL; echo 'Host: ' . config('database.connections.mysql.host') . PHP_EOL;"
```

**This shows what Laravel's config actually has.**

**If it shows `samurai_travel`**, the config cache wasn't cleared or variables aren't being read.

---

### Step 10: Nuclear Option - Rebuild Config

**If nothing works, rebuild everything:**

```bash
# Clear everything
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan route:clear
railway run php artisan view:clear

# Rebuild config
railway run php artisan config:cache

# Check what it cached
railway run php artisan tinker --execute="echo config('database.connections.mysql.database');"
```

**If it still shows `samurai_travel`**, the environment variables aren't being read at all.

---

## 🔍 Troubleshooting

### Issue: Variable References Show as Literal Text

**Solution:** Use actual values instead of `${{MySQL.XXX}}`

---

### Issue: Config Still Shows samurai_travel After Clearing

**Solution:** 
1. Make sure variables are set correctly in Railway
2. Wait for Railway to redeploy
3. Clear cache again after redeploy

---

### Issue: MySQL Service Name Doesn't Match

**Solution:** 
- Check your MySQL service name in Railway
- Use exact name in variable references: `${{YourServiceName.MYSQLHOST}}`

---

## ✅ Quick Fix Script

**Copy and paste this entire block:**

```bash
# Clear all caches
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan route:clear
railway run php artisan view:clear

# Check what database Laravel sees
railway run php artisan tinker --execute="echo 'Database: ' . env('DB_DATABASE') . PHP_EOL; echo 'Host: ' . env('DB_HOST') . PHP_EOL;"

# Try migrations
railway run php artisan migrate --force
```

---

## 🎯 Most Likely Solution

**The issue is probably:**

1. **Config cache has old database name** → Clear cache (Step 1)
2. **Variable references not resolving** → Use actual values (Step 4)
3. **Railway hasn't redeployed** → Force redeploy (Step 6)

**Try Steps 1, 4, and 6 first - that usually fixes it!**

---

**After fixing, your migrations should work!** 🚀
