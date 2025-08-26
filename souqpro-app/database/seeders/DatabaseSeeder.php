<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
        ]);

        Product::updateOrCreate([
            'slug' => 'demo-product-1',
        ], [
            'user_id' => $admin->id,
            'name' => 'منتج تجريبي 1',
            'description' => 'وصف مختصر للمنتج التجريبي',
            'price' => 49.99,
            'sale_price' => 39.99,
            'stock' => 25,
            'is_active' => true,
        ]);

        Product::updateOrCreate([
            'slug' => 'demo-product-2',
        ], [
            'user_id' => $admin->id,
            'name' => 'منتج تجريبي 2',
            'description' => 'وصف آخر للمنتج التجريبي',
            'price' => 79.00,
            'stock' => 12,
            'is_active' => true,
        ]);
    }
}
