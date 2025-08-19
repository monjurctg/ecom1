<?php
// removecache.php

// ---------------------------
// Optional: simple security
// ---------------------------
$secret = 'clear'; // change this!
if (!isset($_GET['key']) || $_GET['key'] !== $secret) {
    die('❌ Unauthorized');
}

// ---------------------------
// Load Laravel
// ---------------------------
require __DIR__.'/bootstrap/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

use Illuminate\Support\Facades\Cache;

// Boot the app
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$kernel->handle($request);

// ---------------------------
// Clear All Caches
// ---------------------------
try {
    // 1️⃣ Clear default cache
    Cache::flush();

    // 2️⃣ Clear caches using tags
    if (Cache::supportsTags()) {
        Cache::tags([
            'menus',            // header + footer menus
            'mega_menus',       // mega menus
            'page_variation',   // home/category/brand/seller variation
            'categories',       // category lists
            'footer',           // footer menus
        ])->flush();
    }

    echo "✅ All caches cleared successfully!";
} catch (Exception $e) {
    echo "❌ Error clearing cache: " . $e->getMessage();
}
