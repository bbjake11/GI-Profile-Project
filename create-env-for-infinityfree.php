<?php
/**
 * Script to create .env file for InfinityFree deployment
 * Run this locally, then upload the .env file to your server
 */

echo "Creating .env file for InfinityFree...\n\n";

// Database credentials (from InfinityFree)
$dbHost = 'sql100.infinityfree.com';
$dbPort = '3306';
$dbUsername = 'if0_40937623';
$dbPassword = 'aRDiCEoGBLjvM';
$dbName = 'if0_40937623_samurai_travel'; // ✅ Database created!

// Website URL (UPDATE THIS)
$appUrl = 'https://your-site.infinityfree.net'; // UPDATE THIS with your actual URL

// Generate APP_KEY if not exists
$appKey = '';
if (file_exists('.env')) {
    $envContent = file_get_contents('.env');
    if (preg_match('/APP_KEY=(.+)/', $envContent, $matches)) {
        $appKey = trim($matches[1]);
    }
}

if (empty($appKey)) {
    echo "Generating APP_KEY...\n";
    exec('php artisan key:generate --show', $output, $return);
    if ($return === 0 && !empty($output)) {
        $appKey = trim(end($output));
        // Extract just the key part if it includes "base64:"
        if (strpos($appKey, 'base64:') === 0) {
            $appKey = $appKey;
        } else {
            // If it's just the key, add base64: prefix
            $appKey = 'base64:' . $appKey;
        }
    } else {
        echo "Warning: Could not generate APP_KEY. You'll need to run: php artisan key:generate\n";
        $appKey = 'base64:YOUR_APP_KEY_HERE';
    }
} else {
    echo "Using existing APP_KEY from .env\n";
}

// Create .env content
$envContent = <<<ENV
APP_NAME="Samurai Travel"
APP_ENV=production
APP_KEY={$appKey}
APP_DEBUG=false
APP_URL={$appUrl}

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST={$dbHost}
DB_PORT={$dbPort}
DB_DATABASE={$dbName}
DB_USERNAME={$dbUsername}
DB_PASSWORD={$dbPassword}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="\${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="\${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="\${PUSHER_APP_CLUSTER}"
ENV;

// Save to .env.infinityfree file
file_put_contents('.env.infinityfree', $envContent);

echo "✓ .env file created: .env.infinityfree\n";
echo "\n⚠️  IMPORTANT:\n";
echo "1. Update DB_DATABASE with your actual database name\n";
echo "2. Update APP_URL with your actual website URL\n";
echo "3. Review the file before uploading\n";
echo "4. Upload this file as '.env' to your server\n";
echo "\nCurrent settings:\n";
echo "  DB_DATABASE: {$dbName}\n";
echo "  APP_URL: {$appUrl}\n";
echo "\n";
