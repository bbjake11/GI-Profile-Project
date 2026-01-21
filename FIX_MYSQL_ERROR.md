# Fix MySQL "Shutdown Unexpectedly" Error in XAMPP

## Common Causes & Solutions

### Solution 1: Port 3306 is Already in Use

**Check if port is in use:**
1. Open Command Prompt as Administrator
2. Run: `netstat -ano | findstr :3306`
3. If you see output, note the PID (last number)
4. Run: `taskkill /PID [PID_NUMBER] /F` (replace [PID_NUMBER] with the actual PID)

**Or change MySQL port in XAMPP:**
1. Open `C:\xampp\mysql\bin\my.ini` (or wherever XAMPP is installed)
2. Find `port=3306` and change to `port=3307`
3. Update your `.env` file: `DB_PORT=3307`
4. Restart MySQL in XAMPP

---

### Solution 2: Another MySQL Service is Running

**Check Windows Services:**
1. Press `Win + R`, type `services.msc`, press Enter
2. Look for "MySQL" services
3. If found, right-click → Stop
4. Try starting MySQL in XAMPP again

**Or stop via command line (Run as Administrator):**
```bash
net stop MySQL
net stop MySQL80
net stop MySQL57
```

---

### Solution 3: MySQL Data Directory Corruption

**Backup and reset MySQL data:**
1. Stop MySQL in XAMPP
2. Backup: Copy `C:\xampp\mysql\data` folder to a safe location
3. Delete contents of `C:\xampp\mysql\data` (keep the folder, delete files inside)
4. Copy `C:\xampp\mysql\backup` folder contents to `C:\xampp\mysql\data`
5. Try starting MySQL again

**⚠️ WARNING: This will delete all your databases! Only do this if you don't have important data.**

---

### Solution 4: Check XAMPP MySQL Logs

**View error logs:**
1. In XAMPP Control Panel, click "Logs" button next to MySQL
2. Or check: `C:\xampp\mysql\data\*.err` files
3. Look for specific error messages
4. Common errors:
   - "Can't create/write to file" → Permission issue
   - "Table doesn't exist" → Data corruption
   - "Access denied" → Configuration issue

---

### Solution 5: Reinstall MySQL in XAMPP

**If nothing else works:**
1. Stop MySQL in XAMPP
2. Backup your databases (if any)
3. Delete `C:\xampp\mysql` folder
4. Reinstall XAMPP or just the MySQL component
5. Restore your databases

---

### Solution 6: Use Standalone MySQL Instead

**Install MySQL separately:**
1. Download MySQL from: https://dev.mysql.com/downloads/installer/
2. Install MySQL Community Server
3. During installation, set:
   - Port: 3306
   - Username: root
   - Password: (set one or leave blank)
4. Update `.env` file with correct credentials
5. Use MySQL Workbench or command line instead of XAMPP MySQL

---

## Quick Diagnostic Steps

1. **Check if MySQL is already running:**
   ```bash
   # Run in Command Prompt (as Admin)
   sc query MySQL
   sc query MySQL80
   ```

2. **Check port usage:**
   ```bash
   netstat -ano | findstr :3306
   ```

3. **Check Windows Event Viewer:**
   - Press `Win + X` → Event Viewer
   - Windows Logs → Application
   - Look for MySQL errors

4. **Check XAMPP MySQL logs:**
   - XAMPP Control Panel → MySQL → Logs button
   - Or check: `C:\xampp\mysql\data\*.err`

---

## Recommended Solution Order

1. ✅ **First**: Check if another MySQL service is running → Stop it
2. ✅ **Second**: Check if port 3306 is in use → Free it or change port
3. ✅ **Third**: Check XAMPP MySQL logs → Identify specific error
4. ✅ **Fourth**: Try resetting MySQL data directory (backup first!)
5. ✅ **Last resort**: Reinstall MySQL or use standalone MySQL

---

## After Fixing MySQL

Once MySQL starts successfully:

1. Create database:
   ```bash
   mysql -u root -e "CREATE DATABASE samurai_travel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   ```

2. Run migrations:
   ```bash
   cd samurai_travel
   php artisan migrate
   php artisan db:seed
   ```

3. Visit: http://localhost:8000/
