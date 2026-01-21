# FTP Connection Guide - InfinityFree

## ✅ Your FTP Credentials

```
FTP Host: ftpupload.net
FTP Username: if0_40937623
FTP Password: [Your InfinityFree Control Panel Password]
FTP Port: 21
```

## 🔑 Important: FTP Password

**Your FTP password is the SAME as your InfinityFree Control Panel password!**

- Use the password you use to log into: https://infinityfree.net/
- This is NOT a separate password
- If you forgot your password, reset it in the InfinityFree control panel

---

## 📁 Important Folder Information

**Your website files go in:** `/htdocs/`

This is where you'll upload all your Laravel files.

---

## 🚀 How to Connect via FileZilla

### Step 1: Download FileZilla
- Go to: https://filezilla-project.org/download.php?type=client
- Download and install FileZilla Client (free)

### Step 2: Connect

1. Open FileZilla
2. At the top, enter:
   - **Host**: `ftpupload.net`
   - **Username**: `if0_40937623`
   - **Password**: [Your InfinityFree Control Panel Password]
   - **Port**: `21`
3. Click **"Quickconnect"**

### Step 3: Navigate to Website Folder

1. In the **right panel** (Remote site), you'll see folders
2. Look for `/htdocs/` folder
3. **Double-click** to open it
4. This is where you'll upload your Laravel files

---

## 📤 Uploading Files

### What to Upload:

✅ **Upload ALL files** from your Laravel project EXCEPT:
- `node_modules/` (don't upload - too large)
- `.git/` (don't upload - not needed)
- `.env` (we'll create this on server)

### How to Upload:

1. **Left side** (Local site) = Your computer
   - Navigate to your `samurai_travel` project folder

2. **Right side** (Remote site) = Server
   - Navigate to `/htdocs/` folder

3. **Select files**:
   - Select all files/folders in your project (Ctrl+A)
   - Right-click → **Upload**
   - OR drag and drop from left to right

4. **Wait for upload**:
   - This may take 10-30 minutes
   - You'll see progress at the bottom
   - Don't close FileZilla during upload

---

## 📋 Upload Checklist

- [ ] Connected to FTP successfully
- [ ] Navigated to `/htdocs/` folder
- [ ] Selected all files (except node_modules, .git)
- [ ] Started upload
- [ ] Upload completed (check bottom panel)
- [ ] Verified files are in `/htdocs/` folder

---

## ⚠️ Troubleshooting

### "Connection Failed" or "Login Failed"
- Double-check your password (use Control Panel password)
- Make sure username is: `if0_40937623`
- Check Host is: `ftpupload.net`
- Check Port is: `21`
- Try resetting your Control Panel password if needed

### "Can't find /htdocs/ folder"
- Look for `/public_html/` instead (some accounts use this)
- Or check root folder - files might go directly there
- Contact InfinityFree support if unsure

### Upload is Very Slow
- This is normal for free hosting
- Be patient - it may take 20-30 minutes
- Don't close FileZilla during upload
- Check your internet connection

### Files Not Uploading
- Check you have write permissions
- Make sure you're in `/htdocs/` folder
- Try uploading one file at a time to test
- Check FileZilla error messages at bottom

---

## 🎯 Next Steps After Upload

Once files are uploaded:

1. ✅ Create `.htaccess` in `/htdocs/` root
2. ✅ Set file permissions (storage: 777)
3. ✅ Upload `.env` file
4. ✅ Run migrations
5. ✅ Test website

See `QUICK_DEPLOYMENT_GUIDE.md` for complete steps!

---

## 💡 Tips

- **Keep FileZilla open** during upload
- **Don't interrupt** the upload process
- **Check bottom panel** for upload progress/errors
- **Verify files** after upload completes
- **Save connection** in FileZilla for future use (File → Site Manager)

Good luck! 🚀
