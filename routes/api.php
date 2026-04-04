<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\TransportationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MuseumController;
use App\Http\Controllers\SafariController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PaymentController;

Route::get('/home', [HomeController::class, 'index']);

// مسارات الفنادق
Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/hotels/{id}', [HotelController::class, 'show']);
Route::get('/hotels/{id}/rooms', [HotelController::class, 'rooms']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/social-login', [AuthController::class, 'socialLogin']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/profile/update', [AuthController::class, 'updateProfile']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);

    // مسارات الطلبات للمتجر
    Route::get('/orders/my-orders', [OrderController::class, 'userOrders']);
    Route::post('/orders', [OrderController::class, 'store']);

    // مسارات إضافة التقييمات
    Route::post('/reviews/{item_type}/{item_id}', [ReviewController::class, 'store']);
});

// مسارات الوجهات السياحية (فنادق، مطاعم، متاحف...)
Route::get('/destinations', [DestinationController::class, 'index']);
Route::get('/destinations/{id}', [DestinationController::class, 'show']);
Route::post('/destinations', [DestinationController::class, 'store']); // يستحسن لاحقاً حمايتها بحساب المدير

// مسارات الرحلات والباقات
Route::get('/tours', [TourController::class, 'index']);
Route::get('/tours/{id}', [TourController::class, 'show']);
Route::post('/tours', [TourController::class, 'store']);

// مسارات الأنشطة (Popular Things To Do)
Route::get('/activities', [ActivityController::class, 'index']);
Route::get('/activities/{id}', [ActivityController::class, 'show']);

// مسارات متجر الهدايا والمنتجات (E-Commerce)
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// مسارات استرجاع التقييمات للجمهور
Route::get('/reviews', [ReviewController::class, 'allReviews']);
Route::get('/reviews/{item_type}/{item_id}', [ReviewController::class, 'index']);

// مسار الشات بوت (Gemini RAG)
Route::post('/chat', [ChatbotController::class, 'ask']);

// ===== مسارات المدونة والمقالات (Blogs / Travel Guides) =====
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);

// ===== مسارات العروض والصفقات (Deals) =====
Route::get('/deals', [DealController::class, 'index']);
Route::get('/deals/{id}', [DealController::class, 'show']);

// ===== مسارات البحث (Global Search) =====
Route::get('/search', [SearchController::class, 'search']);

// ===== مسارات المطاعم (Restaurants) =====
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);

// ===== مسارات الأحداث والفعاليات (Events) =====
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'show']);

// ===== مسارات المتاحف والمعالم (Museums & Landmarks) =====
Route::get('/museums', [MuseumController::class, 'index']);
Route::get('/museums/{id}', [MuseumController::class, 'show']);

// ===== مسارات السفاري والصحراء (Safaris) =====
Route::get('/safaris', [SafariController::class, 'index']);
Route::get('/safaris/{id}', [SafariController::class, 'show']);

// ===== مسارات المواصلات (Transportation) =====
Route::get('/transportation', [TransportationController::class, 'index']);
Route::get('/transportation/{id}', [TransportationController::class, 'show']);

// ===== مسارات المحتوى الثابت (CMS Content & FAQs) =====
Route::get('/content/pages/{slug}', [ContentController::class, 'getPage']);
Route::get('/content/faqs', [ContentController::class, 'getFaqs']);
Route::get('/content/hero-slides', [ContentController::class, 'getHeroSlides']);
Route::get('/content/nav-items', [ContentController::class, 'getNavItems']);
Route::get('/content/why-choose-us', [ContentController::class, 'getWhyChooseUs']);
Route::get('/content/footer', [ContentController::class, 'getFooterData']);
Route::get('/content/attractions', [ContentController::class, 'getAttractions']);
Route::get('/content/attractions/{slug}', [ContentController::class, 'getAttraction']);

// ===== مسارات الدعم والتواصل (Support & Newsletter) =====
Route::post('/support/contact', [SupportController::class, 'contact']);
Route::post('/newsletter/subscribe', [SupportController::class, 'subscribe']);

// ===== مسارات الدفع (Payments) =====
Route::post('/payment/process', [PaymentController::class, 'process']);
Route::get('/payment/status/{transactionId}', [PaymentController::class, 'status']);

// ===== مسارات محمية (Wishlist & Notifications) - تحتاج تسجيل دخول =====
Route::middleware('auth:sanctum')->group(function () {
    // المفضلة (Wishlist)
    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::post('/wishlist', [WishlistController::class, 'store']);
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy']);

    // الإشعارات (Notifications)
    Route::get('/user/notifications', [NotificationController::class, 'index']);
    Route::put('/user/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::put('/user/notifications/read-all', [NotificationController::class, 'markAllAsRead']);
});

// ===== One-time image setup route =====
// ===== Run migrations from browser =====
Route::get('/run-migrate', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $output = \Illuminate\Support\Facades\Artisan::output();
        
        $tables = \Illuminate\Support\Facades\DB::select("SHOW TABLES");
        
        return response()->json([
            'status' => 'done', 
            'output' => $output,
            'tables' => $tables,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/setup-images', function () {
    $brain = 'C:/Users/Technologist/.gemini/antigravity/brain/c2d84a60-43f5-453b-b555-f79cac85e55b';
    $frontendPublic = base_path('../booking-app-main/public');

    $copies = [
        // Era images for TextRevealSection (Egypt Through Time)
        'images/era-pharaonic.png'   => $brain . '/pharaonic_egypt_pyramids_1775066991910.png',
        'images/era-greco-roman.png' => $brain . '/greco_roman_alexandria_1775067015936.png',
        'images/era-coptic.png'      => $brain . '/coptic_egypt_church_1775067032759.png',
        'images/era-islamic.png'     => $brain . '/islamic_egypt_cairo_1775066959857.png',
        'images/era-modern.png'      => $brain . '/modern_egypt_capital_1775066974390.png',
        // Deal cards
        'nile_cruise_deal.png'       => $brain . '/nile_dinner_cruise_elegant_1775055707136.png',
        'pyramids_vip_deal.png'      => $brain . '/pyramids_day_tour_1775063545520.png',
        'aswan_nubian_market.png'    => $brain . '/aswan_nubian_market_1775063685904.png',
        'luxor_souk.png'             => $brain . '/luxor_souk_1775063700541.png',
        // Popular Tours section images
        'images/tour-pyramids.png'       => $brain . '/pyramids_cairo_tour_1775071147110.png',
        'images/tour-nile-cruise.png'    => $brain . '/nile_dinner_cruise_tour_1775071112255.png',
        'images/tour-red-sea.png'        => $brain . '/red_sea_snorkeling_tour_1775071131863.png',
        'images/tour-desert-safari.png'  => $brain . '/desert_safari_atv_tour_1775071172281.png',
        'images/tour-cairo-food.png'     => $brain . '/cairo_food_tour_street_1775071188045.png',
        'images/tour-museum.png'         => $brain . '/egyptian_museum_guided_1775071206904.png',
    ];

    @mkdir($frontendPublic . '/images', 0755, true);

    $results = [];
    foreach ($copies as $dest => $src) {
        if (!file_exists($src)) {
            $results[$dest] = '❌ source not found';
            continue;
        }
        $destPath = $frontendPublic . '/' . $dest;
        $ok = @copy($src, $destPath);
        $results[$dest] = $ok ? '✅ copied' : '❌ failed';
    }

    // ====== AI HOTELS FIX ======
    $newBrain = 'C:/Users/Technologist/.gemini/antigravity/brain/66fb5c08-f331-460b-90d0-ebc614abb105';
    $hotelCopies = [
        'hotels/pyramids.png'         => $newBrain . '/hotel_pyramids_view_1775156544799.png',
        'hotels/nile.png'             => $newBrain . '/hotel_nile_view_1775156561628.png',
        'hotels/redsea.png'           => $newBrain . '/hotel_redsea_view_1775156584896.png',
        'hotels/luxor.png'            => $newBrain . '/hotel_luxor_view_1775156603507.png',
        'hotels/siwa.png'             => $newBrain . '/hotel_siwa_eco_1775166696672.png',
        'hotels/aswan.png'            => $newBrain . '/hotel_nubian_aswan_1775166712736.png',
        'hotels/alex.png'             => $newBrain . '/hotel_alexandria_palace_1775166728597.png',
        'hotels/cairo_boutique.png'   => $newBrain . '/hotel_cairo_boutique_1775166750685.png',
        'hotels/matrouh.png'          => $newBrain . '/hotel_marsa_matrouh_1775166768535.png',
        'hotels/desert.png'           => $newBrain . '/hotel_white_desert_1775166783315.png',
        'hotels/luxor_sunset.png'     => $newBrain . '/hotel_luxor_sunset_1775166904450.png',
        'hotels/sharm_bungalows.png'  => $newBrain . '/hotel_sharm_bungalows_1775166920544.png',
        'hotels/cairo_heritage.png'   => $newBrain . '/hotel_cairo_heritage_1775166934715.png',
        'hotels/aswan_cruise.png'     => $newBrain . '/hotel_aswan_cruise_1775166953308.png',
        'hotels/marsa_lodge.png'      => $newBrain . '/hotel_marsa_alam_lodge_1775166968209.png',
        'hotels/north_coast.png'      => $newBrain . '/hotel_north_coast_1775166984251.png'
    ];

    @mkdir($frontendPublic . '/hotels', 0755, true);
    foreach ($hotelCopies as $dest => $src) {
        if (file_exists($src)) {
            @copy($src, $frontendPublic . '/' . $dest);
            $results[$dest] = '✅ AI copied';
        }
    }

    // Update ALL Hotels in DB to use completely diverse AI images!
    \App\Models\Hotel::chunk(100, function ($hotels) {
        $cairoArray     = ['/hotels/pyramids.png', '/hotels/nile.png', '/hotels/cairo_boutique.png', '/hotels/cairo_heritage.png'];
        $coastArray     = ['/hotels/redsea.png', '/hotels/matrouh.png', '/hotels/alex.png', '/hotels/sharm_bungalows.png', '/hotels/marsa_lodge.png', '/hotels/north_coast.png'];
        $saharaArray    = ['/hotels/siwa.png', '/hotels/desert.png'];
        $upperArray     = ['/hotels/luxor.png', '/hotels/aswan.png', '/hotels/luxor_sunset.png', '/hotels/aswan_cruise.png'];
        
        $counters = ['cairo' => 0, 'coast' => 0, 'sahara' => 0, 'upper' => 0];

        foreach ($hotels as $hotel) {
            $loc = strtolower($hotel->location);
            $imagePath = '/hotels/nile.png'; 
            
            if (str_contains($loc, 'cairo') || str_contains($loc, 'giza')) {
                $imagePath = $cairoArray[$counters['cairo']++ % count($cairoArray)];
            } elseif (str_contains($loc, 'sharm') || str_contains($loc, 'hurghada') || str_contains($loc, 'sea') || str_contains($loc, 'matrouh') || str_contains($loc, 'alexandria') || str_contains($loc, 'said')) {
                $imagePath = $coastArray[$counters['coast']++ % count($coastArray)];
            } elseif (str_contains($loc, 'luxor') || str_contains($loc, 'aswan')) {
                $imagePath = $upperArray[$counters['upper']++ % count($upperArray)];
            } elseif (str_contains($loc, 'fayoum') || str_contains($loc, 'siwa')) {
                $imagePath = $saharaArray[$counters['sahara']++ % count($saharaArray)];
            } else {
                $all = array_merge($cairoArray, $coastArray, $saharaArray, $upperArray);
                $imagePath = $all[array_rand($all)];
            }
            
            // Generate diverse gallery from all available images randomly so detail pages look huge
            $galleryPool = array_merge($cairoArray, $coastArray, $saharaArray, $upperArray);
            shuffle($galleryPool);
            
            $hotel->update([
                'image' => $imagePath,
                'gallery' => [
                    $imagePath,
                    $galleryPool[0],
                    $galleryPool[1],
                    $galleryPool[2]
                ]
            ]);
        }
    });

    return response()->json(['status' => 'done', 'results' => $results, 'db_updated' => true]);
});

// ====== AI IMAGES PROXY ROUTE ======
Route::get('/kamet-images/{name}', function ($name) {
    $brain = 'C:/Users/Technologist/.gemini/antigravity/brain/66fb5c08-f331-460b-90d0-ebc614abb105/';
    $map = [
        'pyramids' => 'event_pyramids_light_show_1775182379397.png',
        'dervishes' => 'event_whirling_dervishes_1775182399411.png',
        'opera' => 'event_opera_aida_1775182414340.png',
        'jazz' => 'event_cairo_jazz_1775182429105.png',
        'edm' => 'event_red_sea_edm_1775182448774.png',
        'book' => 'event_book_fair_1775182462625.png',
        'hero' => 'event_hero_banner_1775182476585.png',
        // Museums & Temples
        'lm_gem' => 'landmark_gem_1775215583436.png',
        'lm_nmec' => 'landmark_nmec_1775215601100.png',
        'lm_karnak' => 'landmark_karnak_1775215616996.png',
        'lm_luxor_museum' => 'landmark_luxor_museum_1775215631124.png',
        'lm_abu_simbel' => 'landmark_abu_simbel_1775215644446.png',
        'lm_philae' => 'landmark_philae_1775215667181.png',
        'lm_graeco_roman' => 'landmark_graeco_roman_1775215682490.png',
        'lm_qaitbay' => 'landmark_qaitbay_1775215696511.png',
        'lm_hurghada_museum' => 'landmark_hurghada_museum_1775215710824.png',
        'lm_sharm' => 'landmark_sharm_1775215753098.png',
        'lm_hero' => 'landmark_museums_hero_1775215725809.png',
        // Bazaars
        'baz_cairo' => 'bazaar_cairo_1775219962844.png',
        'baz_aswan' => 'bazaar_aswan_1775219976751.png',
        'baz_luxor' => 'bazaar_luxor_1775219992038.png',
        'baz_sharm' => 'bazaar_sharm_1775220006973.png',
        'baz_alexandria' => 'bazaar_alexandria_1775220029745.png',
        'baz_siwa' => 'bazaar_siwa_1775220046473.png',
        'baz_hurghada' => 'bazaar_hurghada_1775220061416.png',
        'baz_dahab' => 'bazaar_dahab_1775220078315.png',
        // Destinations
        'dest_cairo' => 'dest_cairo_1775223865548.png',
        'dest_luxor' => 'dest_luxor_1775223881542.png',
        'dest_aswan' => 'dest_aswan_1775223897924.png',
        'dest_sharm' => 'dest_sharm_1775223914300.png',
        'dest_hurghada' => 'dest_hurghada_1775223938243.png',
        'dest_alexandria' => 'dest_alexandria_1775223954054.png',
        'dest_marsa_alam' => 'dest_marsa_alam_1775223972577.png',
        'dest_dahab' => 'dest_dahab_1775223990256.png',
        // Fallbacks for ExplorePage
        'food_1' => 'food_koshary_1775171500798.png',
        'food_2' => 'food_fatta_1775168550864.png',
        'safari_1' => 'desert_safari_atv_tour_1775071172281.png',
        'safari_2' => 'red_sea_snorkeling_tour_1775071131863.png',
        'hotel_fallback' => 'hotel_cairo_boutique_1775166750685.png',
        // Shop products
        'shop_papyrus' => 'shop_papyrus_1775236738734.png',
        'shop_nefertiti' => 'shop_nefertiti_1775236758817.png',
        'shop_tut_mask' => 'shop_tut_mask_1775236775264.png',
        'shop_cartouche' => 'shop_cartouche_1775236789704.png',
        'shop_scarf' => 'shop_scarf_1775236808882.png',
        'shop_nubian_basket' => 'shop_nubian_basket_1775236828632.png',
        'shop_anubis' => 'shop_anubis_1775236842955.png',
        'shop_spice_box' => 'shop_spice_box_1775236859610.png',
        // Nile Cruise Deal
        'deal_nile_deck' => 'nile_dinner_deck_1775240334351.png',
        'deal_nile_buffet' => 'nile_dinner_buffet_1775240349844.png',
        'deal_nile_show' => 'nile_dinner_show_1775240365654.png',
        // Safari Deal
        'deal_safari_bashing' => 'safari_dune_bashing_1775240536827.png',
        'deal_safari_camp' => 'safari_bedouin_camp_1775240555857.png',
        'deal_safari_lake' => 'safari_salt_lake_1775240569448.png',
        // Diving Deal
        'deal_dive_coral' => 'dive_coral_1775240720787.png',
        'deal_dive_scuba' => 'dive_scuba_1775240735742.png',
        'deal_dive_boat' => 'dive_boat_1775240749855.png',
        // Pyramids Deal
        'deal_pyramids_sunset' => 'pyramids_vip_sunset_1775240772568.png',
        'deal_pyramids_sphinx' => 'pyramids_sphinx_1775240790054.png',
        'deal_pyramids_gold' => 'pyramids_museum_gold_1775240805561.png',
    ];
    $oldBrain = 'C:/Users/Technologist/.gemini/antigravity/brain/c2d84a60-43f5-453b-b555-f79cac85e55b/';
    if (isset($map[$name])) {
        if (file_exists($brain . $map[$name])) {
            return response()->file($brain . $map[$name]);
        } elseif (file_exists($oldBrain . $map[$name])) {
            return response()->file($oldBrain . $map[$name]);
        }
    }
    return response('Not found', 404);
});
