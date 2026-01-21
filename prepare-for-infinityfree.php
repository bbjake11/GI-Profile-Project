<?php
/**
 * Script to prepare Laravel project for InfinityFree deployment
 * Run this locally before uploading files
 */

echo "Preparing Laravel project for InfinityFree deployment...\n\n";

// Check if running from correct directory
if (!file_exists('artisan')) {
    die("Error: Please run this script from the Laravel root directory!\n");
}

// Step 1: Compile assets
echo "Step 1: Compiling assets...\n";
exec('npm run production', $output, $return);
if ($return !== 0) {
    echo "Warning: npm run production failed. Make sure Node.js is installed.\n";
} else {
    echo "✓ Assets compiled successfully\n";
}

// Step 2: Optimize autoloader
echo "\nStep 2: Optimizing Composer autoloader...\n";
exec('composer install --no-dev --optimize-autoloader', $output, $return);
if ($return !== 0) {
    echo "Warning: Composer optimization failed.\n";
} else {
    echo "✓ Autoloader optimized\n";
}

// Step 3: Cache config
echo "\nStep 3: Caching configuration...\n";
exec('php artisan config:cache', $output, $return);
if ($return === 0) {
    echo "✓ Configuration cached\n";
}

// Step 4: Cache routes
echo "\nStep 4: Caching routes...\n";
exec('php artisan route:cache', $output, $return);
if ($return === 0) {
    echo "✓ Routes cached\n";
}

// Step 5: Cache views
echo "\nStep 5: Caching views...\n";
exec('php artisan view:cache', $output, $return);
if ($return === 0) {
    echo "✓ Views cached\n";
}

// Step 6: Create .htaccess for root (if needed)
echo "\nStep 6: Creating root .htaccess...\n";
$htaccessContent = <<<'HTACCESS'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
HTACCESS;

if (!file_exists('.htaccess') || !strpos(file_get_contents('.htaccess'), 'public/$1')) {
    file_put_contents('.htaccess', $htaccessContent);
    echo "✓ Root .htaccess created\n";
} else {
    echo "✓ Root .htaccess already exists\n";
}

// Step 7: Create deployment checklist
echo "\nStep 7: Creating deployment checklist...\n";
$checklist = <<<'CHECKLIST'
DEPLOYMENT CHECKLIST FOR INFINITYFREE
=====================================

BEFORE UPLOADING:
[ ] Run: npm run production
[ ] Run: composer install --no-dev --optimize-autoloader
[ ] Run: php artisan config:cache
[ ] Run: php artisan route:cache
[ ] Run: php artisan view:cache

FILES TO UPLOAD:
[ ] All files EXCEPT:
    - node_modules/
    - .git/
    - .env (create on server)
    - storage/logs/*.log (can be empty)

ON SERVER:
[ ] Create .env file with database credentials
[ ] Set permissions: storage/ (777), bootstrap/cache/ (777)
[ ] Run migrations (via SSH or migration script)
[ ] Test website

IMPORTANT:
- Upload ALL Laravel files to /public_html/
- Move public/* files to /public_html/ root
- Keep Laravel folder structure intact
CHECKLIST;

file_put_contents('DEPLOYMENT_CHECKLIST.txt', $checklist);
echo "✓ Deployment checklist created (DEPLOYMENT_CHECKLIST.txt)\n";

echo "\n✓ Preparation complete!\n";
echo "\nNext steps:\n";
echo "1. Review DEPLOY_INFINITYFREE.md for detailed instructions\n";
echo "2. Upload files via FTP to InfinityFree\n";
echo "3. Create .env file on server with database credentials\n";
echo "4. Set file permissions\n";
echo "5. Run migrations\n";
echo "\n";
