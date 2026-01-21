# Database Setup Instructions

## Step-by-Step Guide to Fix MySQL Connection Error

### Step 1: Start MySQL Service

**Option A: Using XAMPP**
1. Open XAMPP Control Panel
2. Click "Start" next to MySQL
3. Wait until it shows "Running" (green)

**Option B: Using Windows Services**
1. Press `Win + R`, type `services.msc`, press Enter
2. Find "MySQL" or "MySQL80" or "MySQL57"
3. Right-click → "Start"

**Option C: Using Command Line (Run as Administrator)**
```bash
net start MySQL
# OR
net start MySQL80
```

### Step 2: Create the Database

**Option A: Using phpMyAdmin**
1. Open http://localhost/phpmyadmin
2. Click "New" in left sidebar
3. Database name: `samurai_travel`
4. Collation: `utf8mb4_unicode_ci`
5. Click "Create"

**Option B: Using MySQL Command Line**
```bash
mysql -u root -e "CREATE DATABASE samurai_travel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

**Option C: Using the SQL file**
```bash
mysql -u root < create_database.sql
```

### Step 3: Run Migrations and Seeders

Once MySQL is running and database is created:

```bash
cd samurai_travel
php artisan migrate
php artisan db:seed
```

### Step 4: Verify Setup

Visit http://localhost:8000/ - the error should be gone!

---

## Troubleshooting

**If MySQL still won't start:**
- Check if port 3306 is already in use
- Verify MySQL is installed correctly
- Check Windows Event Viewer for MySQL errors

**If you get "Access denied" error:**
- Check your `.env` file - make sure `DB_USERNAME` and `DB_PASSWORD` match your MySQL credentials
- Default XAMPP MySQL: username `root`, password is empty (blank)

**If database already exists error:**
- The database might already exist - that's okay, just proceed to migrations
