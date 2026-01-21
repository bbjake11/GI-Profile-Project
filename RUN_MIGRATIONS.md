# 🗄️ How to Run Migrations on Railway

## Where to Run the Command

Run the migration command in your **terminal/command prompt** on your local computer.

---

## ✅ Step-by-Step Instructions

### Step 1: Open Terminal/Command Prompt

**Windows:**
- Press `Win + R`
- Type `cmd` or `powershell` and press Enter
- OR open Git Bash (if you have Git installed)

**Mac/Linux:**
- Open Terminal app

---

### Step 2: Navigate to Your Project Folder

```bash
cd "C:\Users\Brandon\Desktop\Samuray Travel\samurai_travel"
```

**Or if using Git Bash:**
```bash
cd "/c/Users/Brandon/Desktop/Samuray Travel/samurai_travel"
```

---

### Step 3: Install Railway CLI (If Not Already Installed)

```bash
npm install -g @railway/cli
```

**If you get an error**, you might need Node.js installed first:
- Download from: https://nodejs.org/
- Install it, then try the command again

---

### Step 4: Login to Railway

```bash
railway login
```

This will:
- Open your browser
- Ask you to authorize Railway CLI
- Link your terminal to your Railway account

---

### Step 5: Link to Your Railway Project

```bash
railway link
```

This will:
- Show a list of your Railway projects
- Ask you to select the "Samurai Travel" project
- Link your local folder to that Railway project

---

### Step 6: Run Migrations

**Now you can run the migration command:**

```bash
railway run php artisan migrate --force
```

The `--force` flag is needed because you're in production mode.

---

### Step 7: Run Seeders (Optional)

If you have database seeders:

```bash
railway run php artisan db:seed --force
```

---

## 🎯 Quick Summary

**In your terminal, run these commands in order:**

```bash
# 1. Navigate to project
cd "C:\Users\Brandon\Desktop\Samuray Travel\samurai_travel"

# 2. Install Railway CLI (first time only)
npm install -g @railway/cli

# 3. Login (first time only)
railway login

# 4. Link to project (first time only)
railway link

# 5. Run migrations
railway run php artisan migrate --force

# 6. Run seeders (optional)
railway run php artisan db:seed --force
```

---

## 🔍 What Each Command Does

- **`railway login`** - Authenticates your terminal with Railway
- **`railway link`** - Connects your local folder to a Railway project
- **`railway run`** - Runs a command inside your Railway service container
- **`php artisan migrate --force`** - Runs Laravel migrations in production mode

---

## ✅ Verification

After running migrations, you should see output like:

```
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table
...
```

If you see errors, check:
1. Database variables are set correctly in Railway
2. MySQL service is running
3. You're linked to the correct Railway project

---

## 🆘 Troubleshooting

### Error: "railway: command not found"

**Solution:** Railway CLI is not installed
```bash
npm install -g @railway/cli
```

### Error: "Not logged in"

**Solution:** Login first
```bash
railway login
```

### Error: "No project linked"

**Solution:** Link to your project
```bash
railway link
```

### Error: "Database connection failed"

**Solution:** 
1. Check environment variables in Railway Dashboard
2. Make sure MySQL service is running
3. Verify database credentials are correct

---

## 💡 Alternative: Use Railway Dashboard

**You can also run migrations through Railway Dashboard:**

1. Go to Railway Dashboard
2. Click on your Laravel service
3. Go to "Deployments" tab
4. Click on the latest deployment
5. Click "View Logs"
6. Look for migration output

**However, using CLI is easier and more reliable!**

---

## 📝 Notes

- **First time setup:** You only need to run `railway login` and `railway link` once
- **After that:** Just run `railway run php artisan migrate --force` whenever you need to migrate
- **The command runs on Railway's servers**, not your local machine
- **Make sure your database variables are set** before running migrations

---

**That's it!** Your migrations will run on Railway's servers and create all your database tables! 🚀
