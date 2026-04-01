<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Destination;
use App\Models\Tour;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // إضافة مستخدم تجريبي
        User::create([
            'name' => 'dina Admin',
            'email' => 'admin@kemat.com',
            'password' => Hash::make('password123'),
        ]);
        $this->call([
            DestinationSeeder::class,
            TourSeeder::class,
            ActivitySeeder::class,
            ProductSeeder::class,
            HomepageSeeder::class,
            HotelSeeder::class,
        ]);
    }
}
