<?php
// removecache.php
use Illuminate\Support\Facades\Cache;

// Optional security
$secret = 'clear'; // change this
if (!isset($_GET['key']) || $_GET['key'] !== $secret) {
    die('❌ Unauthorized');
}

// Load Composer & Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';



// Boot Laravel
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Clear all caches
try {
    // Clear default cache
    Cache::flush();

    // Clear caches using tags (if you used tags)
    if (Cache::supportsTags()) {
        Cache::tags([
            'menus',
            'mega_menus',
            'page_variation',
            'categories',
            'footer',
        ])->flush();
    }

    echo "✅ All caches cleared successfully!";
} catch (Exception $e) {
    echo "❌ Error clearing cache: " . $e->getMessage();
}
