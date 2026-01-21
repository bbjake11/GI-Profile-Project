<?php
/**
 * Migration script for InfinityFree
 * Upload this file to your server root and access via browser
 * DELETE THIS FILE AFTER RUNNING!
 * 
 * URL: https://your-site.infinityfree.net/infinityfree-migrate.php
 */

// Security check - remove this in production or add password protection
$allowedIPs = ['127.0.0.1', '::1']; // Add your IP for security
if (!in_array($_SERVER['REMOTE_ADDR'], $allowedIPs) && $_SERVER['REMOTE_ADDR'] !== $_SERVER['SERVER_ADDR']) {
    // Uncomment line below and set a password for security
    // if (!isset($_GET['key']) || $_GET['key'] !== 'YOUR_SECRET_KEY') {
    //     die('Access denied');
    // }
}

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<h1>Laravel Migration Script</h1>";
echo "<pre>";

try {
    echo "Running migrations...\n";
    $kernel->call('migrate', ['--force' => true]);
    echo "\n✓ Migrations completed successfully!\n";
    
    echo "\nRunning seeders...\n";
    $kernel->call('db:seed', ['--force' => true]);
    echo "\n✓ Seeders completed successfully!\n";
    
    echo "\n✓ All done! Please DELETE this file now for security.\n";
    
} catch (Exception $e) {
    echo "\n✗ Error: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "</pre>";
