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

// ===== One-time image setup route =====
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

    return response()->json(['status' => 'done', 'results' => $results]);
});
