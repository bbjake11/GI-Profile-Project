# ✅ Quick Checklist - After Upload

## After Upload Completes:

1. **Create `.htaccess`** in `/htdocs/` root
   - Content: `RewriteRule ^(.*)$ public/$1 [L]`

2. **Set Permissions**:
   - `storage/` → 777
   - `bootstrap/cache/` → 777

3. **Upload `.env`** file to `/htdocs/`
   - Use content from `env-file-for-server.txt`

4. **Upload `infinityfree-migrate.php`** to `/htdocs/`

5. **Visit**: `https://9qnbaco5.infinityfree.com/infinityfree-migrate.php`

6. **Delete** `infinityfree-migrate.php` after migrations complete

7. **Test**: `https://9qnbaco5.infinityfree.com`

---

**See `POST_UPLOAD_STEPS.md` for detailed instructions!**
