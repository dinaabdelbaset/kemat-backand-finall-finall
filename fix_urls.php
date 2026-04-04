<?php

$dir = __DIR__ . '/app/Http/Controllers';
$files = glob($dir . '/*.php');

foreach ($files as $file) {
    if (strpos(basename($file), 'Controller') === false) continue;
    
    $content = file_get_contents($file);
    if (strpos($content, "'http://localhost:8000") !== false) {
        // Replace 'http://localhost:8000/something' with url('/something')
        // Using regex to handle it dynamically
        $updated = preg_replace("/'http:\/\/localhost:8000([^']*)'/", "url('$1')", $content);
        file_put_contents($file, $updated);
        echo "Updated $file\n";
    }
}

// Truncate tables to force reseeding
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

Schema::disableForeignKeyConstraints();
DB::table('safaris')->truncate();
DB::table('restaurants')->truncate();
DB::table('museums')->truncate();
DB::table('events')->truncate();
DB::table('blogs')->truncate();
DB::table('deals')->truncate();
Schema::enableForeignKeyConstraints();

echo "Tables truncated. Ready for dynamic re-seeding with url()!\n";
