<?php

$urls = [
    // Destinations
    "cairo.jpg" => "https://images.unsplash.com/photo-1600868205423-1c3906a4b162?q=80&w=800",
    "alex.jpg" => "https://images.unsplash.com/photo-1647416399478-f7ad5bd15469?q=80&w=800",
    "luxor.jpg" => "https://images.unsplash.com/photo-1574675681023-4556ca6bf414?q=80&w=800",
    "sharm.jpg" => "https://images.unsplash.com/photo-1627916560372-f155c82cc7c8?q=80&w=800",
    "hurghada.jpg" => "https://images.unsplash.com/photo-1594917631379-99fc50ad1be0?q=80&w=800",
    "aswan.jpg" => "https://images.unsplash.com/photo-1584852077983-34e872c0570b?q=80&w=800",
    "marsa_alam.jpg" => "https://images.unsplash.com/photo-1578301597818-7bc00e0b3c65?q=80&w=800",
    "dahab.jpg" => "https://images.unsplash.com/photo-1574169208507-84376144848b?w=800",
    "matruh.jpg" => "https://images.unsplash.com/photo-1610996884111-2eb2ce044cf4?q=80&w=800",
    "new_cap.jpg" => "https://images.unsplash.com/photo-1603525547614-257a02c48ac1?q=80&w=800",

    // Packages
    "nile_cruise.jpg" => "https://images.unsplash.com/photo-1608930985536-11fcec7c6999?q=80&w=800",
    "sinai_trail.jpg" => "https://images.unsplash.com/photo-1632766327361-b7d6eebe0004?q=80&w=800",

    // Deals
    "mandi.jpg" => "https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600&fit=crop",
    "hotel_nile.jpg" => "https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&fit=crop",
    "museum.jpg" => "https://images.unsplash.com/photo-1541426062085-cfebccba165f?w=800",
    "sound_light.jpg" => "https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&fit=crop",
    "diving.jpg" => "https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600&fit=crop",
    "esplanade.jpg" => "https://images.unsplash.com/photo-1533604100523-911858a74136?w=600&fit=crop"
];

$downloadDir = __DIR__ . '/public/images/home_assets';

if (!file_exists($downloadDir)) {
    mkdir($downloadDir, 0777, true);
}

foreach ($urls as $filename => $url) {
    echo "Downloading $filename...\n";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36");
    $data = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        echo "Error downloading $filename: $error\n";
    } else {
        file_put_contents("$downloadDir/$filename", $data);
        echo "Saved $filename.\n";
    }
}
echo "Done downloading all images.\n";
