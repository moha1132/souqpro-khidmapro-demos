<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Invoice;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $pro = User::updateOrCreate([
            'email' => 'pro@example.com',
        ], [
            'name' => 'Pro User',
            'password' => Hash::make('password'),
            'role' => 'pro',
        ]);

        $s1 = Service::updateOrCreate([
            'slug' => 'consultation-60',
        ], [
            'user_id' => $pro->id,
            'title' => 'استشارة 60 دقيقة',
            'description' => 'جلسة استشارية عبر الإنترنت',
            'duration_minutes' => 60,
            'price' => 100,
            'deposit_amount' => 20,
            'is_active' => true,
        ]);

        $booking = Booking::updateOrCreate([
            'service_id' => $s1->id,
            'client_name' => 'عميل تجريبي',
            'starts_at' => now()->addDay()->setTime(10, 0),
            'ends_at' => now()->addDay()->setTime(11, 0),
        ], [
            'status' => 'confirmed',
        ]);

        Invoice::updateOrCreate([
            'booking_id' => $booking->id,
            'number' => 'INV-DEMO-001',
        ], [
            'subtotal' => 100,
            'discount' => 0,
            'tax' => 0,
            'total' => 100,
            'currency' => 'USD',
            'status' => 'unpaid',
            'issued_at' => now(),
        ]);
    }
}
