<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        Service::create([
            'name' => 'Economy: Toyota Corolla',
            'duration_minutes' => 1440, // 1 Day
            'price' => 45.00,
            'image_path' => 'images/cars/toyota_corolla.jpg'
        ]);

        Service::create([
            'name' => 'SUV: Tesla Model Y',
            'duration_minutes' => 1440, // 1 Day
            'price' => 120.00,
            'image_path' => 'images/cars/tesla_model_y.jpg'
        ]);

        Service::create([
            'name' => 'Luxury: BMW 5 Series',
            'duration_minutes' => 1440, // 1 Day
            'price' => 250.00,
            'image_path' => 'images/cars/bmw_5_series.jpg'
        ]);
    }
}
