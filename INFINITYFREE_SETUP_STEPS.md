# InfinityFree Setup - Step by Step Guide

## Step 1: Create Account

1. Go to **https://www.infinityfree.net/**
2. Click **"Sign Up"** button (top right corner)
3. Fill in the form:
   - **Email**: Your email address
   - **Password**: Create a strong password
   - **Username**: Choose a username (this will be your account name)
4. Check the terms and conditions box
5. Click **"Create Account"**
6. Check your email and click the verification link
7. Log in with your credentials

---

## Step 2: Create a Website/Subdomain

### Method 1: From Dashboard

1. After logging in, you'll see the **"Control Panel"** dashboard
2. Look for **"Create Website"** or **"Add Website"** button (usually a big green button)
3. Click it

### Method 2: From Websites Section

1. In the left sidebar, click **"Websites"** or **"My Websites"**
2. Click **"Create Website"** button

### Creating the Subdomain:

1. You'll see options:
   - **Subdomain** (Free) ← Choose this
   - **Addon Domain** (Free, but requires domain)
   - **Parked Domain** (Free, but requires domain)

2. Select **"Subdomain"**

3. Enter your subdomain name:
   - Example: `samurai-travel`
   - **Your URL will be**: `samurai-travel.infinityfree.net`
   - **Rules**: 
     - Only lowercase letters, numbers, and hyphens
     - Must start with a letter
     - No spaces or special characters

4. Click **"Create Website"** or **"Submit"**

5. Wait a few seconds for creation (usually 10-30 seconds)

6. ✅ **Success!** You'll see:
   - Your website URL: `https://samurai-travel.infinityfree.net`
   - Status: Active
   - Note: It may take 5-10 minutes to fully activate

---

## Step 3: Create MySQL Database

### Accessing Database Section:

1. In the left sidebar, click **"MySQL Databases"**
   - OR
   - Go to **"Control Panel"** → **"MySQL Databases"**

### Creating Database:

1. Scroll down to **"Create New Database"** section

2. Fill in the form:

   **Database Name:**
   - Example: `epiz_12345678_samurai`
   - **Note**: InfinityFree may auto-prefix with `epiz_XXXXXXX_`
   - You can use: `samurai_travel` or `samurai`

   **Database Username:**
   - Example: `epiz_12345678_admin`
   - **Note**: Usually auto-prefixed with your account ID
   - You can use: `admin` or `samurai_user`

   **Database Password:**
   - **IMPORTANT**: Create a STRONG password
   - Use a mix of letters, numbers, and symbols
   - **SAVE THIS PASSWORD** - you'll need it for `.env` file
   - Example: `MyStr0ng!P@ssw0rd`

3. Click **"Create Database"** button

4. ✅ **Success!** You'll see a confirmation message

### Getting Database Credentials:

After creation, you'll see a table/list with your databases. Find your newly created database and note:

1. **Database Host** (Server):
   - Usually: `sqlXXX.epizy.com` (where XXX is a number)
   - Example: `sql301.epizy.com`
   - **This is your `DB_HOST` in `.env`**

2. **Database Name**:
   - Full name including prefix
   - Example: `epiz_12345678_samurai`
   - **This is your `DB_DATABASE` in `.env`**

3. **Database Username**:
   - Full username including prefix
   - Example: `epiz_12345678_admin`
   - **This is your `DB_USERNAME` in `.env`**

4. **Database Password**:
   - The password you just created
   - **This is your `DB_PASSWORD` in `.env`**

5. **Port**:
   - Usually: `3306` (default MySQL port)
   - **This is your `DB_PORT` in `.env`**

### 📝 Save These Credentials:

Create a text file and save:
```
DB_HOST=sql301.epizy.com
DB_PORT=3306
DB_DATABASE=epiz_12345678_samurai
DB_USERNAME=epiz_12345678_admin
DB_PASSWORD=MyStr0ng!P@ssw0rd
```

**⚠️ IMPORTANT**: Keep these credentials safe! You'll need them for your `.env` file.

---

## Step 4: Get FTP Credentials

### Accessing FTP Section:

1. In the left sidebar, click **"FTP Accounts"**
   - OR
   - Go to **"Control Panel"** → **"FTP Accounts"**

### Finding FTP Details:

You'll see a section showing your FTP account details:

1. **FTP Server** (Host):
   - Usually: `ftpupload.net`
   - Sometimes: `files.000webhost.com` or similar
   - **This is your FTP Host**

2. **FTP Username**:
   - Usually starts with `epiz_` followed by numbers
   - Example: `epiz_12345678`
   - **This is your FTP Username**

3. **FTP Password**:
   - Your account password (the one you use to log in)
   - OR a separate FTP password if you set one
   - **This is your FTP Password**

4. **FTP Port**:
   - Usually: `21` (standard FTP port)
   - Sometimes: `21` for FTP or `22` for SFTP
   - **This is your FTP Port**

### Creating New FTP Account (Optional):

If you want a separate FTP account:

1. Scroll to **"Create FTP Account"** section
2. Enter:
   - **Username**: Choose a username (will be prefixed)
   - **Password**: Create a password
   - **Directory**: Leave as `/` or specify a folder
3. Click **"Create FTP Account"**

### 📝 Save These Credentials:

Create a text file and save:
```
FTP_HOST=ftpupload.net
FTP_PORT=21
FTP_USERNAME=epiz_12345678
FTP_PASSWORD=YourPasswordHere
```

---

## Step 5: Access phpMyAdmin (Optional but Useful)

### For Database Management:

1. In left sidebar, click **"phpMyAdmin"**
2. Or go to: **"Control Panel"** → **"phpMyAdmin"**
3. Click **"Open phpMyAdmin"**
4. Log in with:
   - **Username**: Your database username
   - **Password**: Your database password
5. You can:
   - View tables
   - Run SQL queries
   - Import/Export databases
   - Manage your database

---

## Visual Guide - Where to Find Everything

### Control Panel Layout:

```
┌─────────────────────────────────────┐
│  INFINITYFREE CONTROL PANEL          │
├─────────────────────────────────────┤
│                                     │
│  [Dashboard]                        │
│  [Websites] ← Create website here   │
│  [MySQL Databases] ← Create DB here │
│  [FTP Accounts] ← Get FTP info here │
│  [phpMyAdmin] ← Manage database     │
│  [File Manager] ← Upload files      │
│  [Email Accounts]                   │
│  [SSL Certificates]                  │
│                                     │
└─────────────────────────────────────┘
```

---

## Quick Checklist

After completing all steps, you should have:

- [ ] ✅ InfinityFree account created and verified
- [ ] ✅ Website/subdomain created
  - URL: `https://your-site.infinityfree.net`
- [ ] ✅ MySQL database created
  - DB_HOST: `sqlXXX.epizy.com`
  - DB_DATABASE: `epiz_XXXXXX_yourdb`
  - DB_USERNAME: `epiz_XXXXXX_user`
  - DB_PASSWORD: `your_password`
  - DB_PORT: `3306`
- [ ] ✅ FTP credentials obtained
  - FTP_HOST: `ftpupload.net`
  - FTP_USERNAME: `epiz_XXXXXX`
  - FTP_PASSWORD: `your_password`
  - FTP_PORT: `21`

---

## Common Issues & Solutions

### Issue: "Subdomain already taken"
- **Solution**: Try a different name (add numbers or different words)

### Issue: "Database creation failed"
- **Solution**: 
  - Check if you've reached database limit (free tier allows multiple)
  - Try a shorter database name
  - Wait a few minutes and try again

### Issue: "Can't find FTP section"
- **Solution**: 
  - Make sure you've created a website first
  - FTP is usually available after website creation
  - Check "Control Panel" → "FTP Accounts"

### Issue: "FTP connection failed"
- **Solution**:
  - Double-check FTP host (might be different)
  - Try port 21 or 22
  - Make sure you're using correct username (with prefix)
  - Check if your IP is blocked (contact support)

---

## Next Steps

After completing these steps:

1. ✅ You have a website URL
2. ✅ You have database credentials
3. ✅ You have FTP credentials

**Now you can:**
- Upload your Laravel files via FTP
- Create `.env` file with database credentials
- Run migrations
- Test your website

See `DEPLOY_INFINITYFREE.md` for the next steps!

---

## Need Help?

- **InfinityFree Forum**: https://forum.infinityfree.net/
- **InfinityFree Support**: Check their help section
- **Documentation**: They have detailed guides on their website

Good luck! 🚀
