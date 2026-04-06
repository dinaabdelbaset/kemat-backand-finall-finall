<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

echo "Starting Image Migration...\n";

// 1. Create transport directory and copy the AI generated images
$transportDir = __DIR__.'/public/images/transport';
if (!is_dir($transportDir)) {
    mkdir($transportDir, 0755, true);
}

$aiImages = [
    'bus' => 'C:\\Users\\Technologist\\.gemini\\antigravity\\brain\\5eb38633-e730-423c-9a49-2fa803feb37e\\luxury_tourist_bus_1775498730279.png',
    'van' => 'C:\\Users\\Technologist\\.gemini\\antigravity\\brain\\5eb38633-e730-423c-9a49-2fa803feb37e\\luxury_tourist_van_1775498759877.png',
    'car' => 'C:\\Users\\Technologist\\.gemini\\antigravity\\brain\\5eb38633-e730-423c-9a49-2fa803feb37e\\premium_tourist_car_1775498781544.png'
];

foreach ($aiImages as $type => $path) {
    if (file_exists($path)) {
        copy($path, "$transportDir/$type.png");
        echo "Copied $type.png\n";
    }
}

// Update Transportation Data
DB::table('transportations')->where('type', 'Bus')->update(['image' => '/images/transport/bus.png']);
DB::table('transportations')->where('type', 'Van')->update(['image' => '/images/transport/van.png']);
DB::table('transportations')->where('type', 'Car')->update(['image' => '/images/transport/car.png']);
DB::table('transportations')->where('type', 'Flight')->update(['image' => '/images/transport/car.png']); // fallback
echo "Updated Transportations DB\n";

// 2. Map Hotels to Front-end stored hotel images
$hotelsSourceDir = 'E:\\مشروع ahmed\\booking-app-main (10)\\booking-app-main\\public\\hotels-live';
$hotelsDestDir = __DIR__.'/public/images/hotels';
if (!is_dir($hotelsDestDir)) {
    mkdir($hotelsDestDir, 0755, true);
}

if (is_dir($hotelsSourceDir)) {
    $files = scandir($hotelsSourceDir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            copy("$hotelsSourceDir/$file", "$hotelsDestDir/$file");
        }
    }
    echo "Copied Hotel images\n";
}

// Assign some images sequentially to hotels or based on name
$hotels = DB::table('hotels')->get();
$hotelFiles = ['cairo_boutique.png', 'cairo_heritage.png', 'aswan.png', 'luxor.png', 'pyramids.png', 'alex.png', 'siwa.png', 'redsea.png'];
foreach ($hotels as $index => $hotel) {
    $fileName = $hotelFiles[$index % count($hotelFiles)];
    DB::table('hotels')
        ->where('id', $hotel->id)
        ->update([
            'image' => "/images/hotels/$fileName",
            'cover_image' => "/images/hotels/$fileName",
            'image_url' => "/images/hotels/$fileName"
        ]);
}
echo "Updated Hotels DB\n";

// 3. Map Safaris
$safariSourceDir = 'E:\\مشروع ahmed\\booking-app-main (10)\\booking-app-main\\public\\images';
$safarisDestDir = __DIR__.'/public/images/tours';
if (!is_dir($safarisDestDir)) {
    mkdir($safarisDestDir, 0755, true);
}

$safariFilesMapping = ['tour-desert-safari.png', 'siwa-safari.png', 'tour-red-sea.png', 'saint-catherine.png', 'aswan-nubian-market.png'];
foreach ($safariFilesMapping as $file) {
    if (file_exists("$safariSourceDir/$file")) {
        copy("$safariSourceDir/$file", "$safarisDestDir/$file");
    }
}

$safaris = DB::table('safaris')->get();
foreach ($safaris as $index => $safari) {
     $fileName = $safariFilesMapping[$index % count($safariFilesMapping)];
     DB::table('safaris')
        ->where('id', $safari->id)
        ->update([
            'image' => "/images/tours/$fileName",
            'cover_image' => "/images/tours/$fileName",
            'image_url' => "/images/tours/$fileName"
        ]);
}
echo "Updated Safaris DB\n";

echo "Done! All images migrated and Database updated successfully.\n";
