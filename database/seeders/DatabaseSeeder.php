<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User (Only if not exists)
        User::firstOrCreate(
            ['email' => 'admin@laptop.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '09171234567',
                'address' => 'Admin Office, Makati City'
            ]
        );

        // 2. Create Customer User (Only if not exists)
        User::firstOrCreate(
            ['email' => 'customer@laptop.com'],
            [
                'name' => 'Juan Dela Cruz',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'phone' => '09181234567',
                'address' => '123 Rizal Street, Quezon City'
            ]
        );

        // 3. Create Laptop Products (Prices in PHP)
        $products = [
            [
                'name' => 'Dell XPS 13',
                'description' => 'Ultra-portable laptop with stunning InfinityEdge display and powerful performance.',
                'price' => 74990.00, // Was 1299.99
                'stock' => 15,
                'brand' => 'Dell',
                'processor' => 'Intel Core i7-1355U',
                'ram' => '16GB DDR5',
                'storage' => '512GB SSD',
                'display' => '13.4" FHD+',
                'image' => null
            ],
            [
                'name' => 'MacBook Pro 14',
                'description' => 'Apple M3 Pro chip delivers exceptional performance for creative professionals.',
                'price' => 116990.00, // Was 1999.99
                'stock' => 10,
                'brand' => 'Apple',
                'processor' => 'Apple M3 Pro',
                'ram' => '18GB Unified Memory',
                'storage' => '512GB SSD',
                'display' => '14.2" Liquid Retina XDR',
                'image' => null
            ],
            [
                'name' => 'HP Spectre x360',
                'description' => 'Convertible laptop with premium design and long battery life.',
                'price' => 89995.00, // Was 1449.99
                'stock' => 12,
                'brand' => 'HP',
                'processor' => 'Intel Core i7-1355U',
                'ram' => '16GB LPDDR5',
                'storage' => '1TB SSD',
                'display' => '13.5" OLED 3K2K',
                'image' => null
            ],
            [
                'name' => 'Lenovo ThinkPad X1 Carbon',
                'description' => 'Business laptop with legendary keyboard and robust security features.',
                'price' => 98500.00, // Was 1599.99
                'stock' => 20,
                'brand' => 'Lenovo',
                'processor' => 'Intel Core i7-1365U',
                'ram' => '32GB LPDDR5',
                'storage' => '1TB SSD',
                'display' => '14" WUXGA IPS',
                'image' => null
            ],
            [
                'name' => 'ASUS ROG Zephyrus G14',
                'description' => 'Gaming laptop with AMD Ryzen power and compact design.',
                'price' => 109995.00, // Was 1799.99
                'stock' => 8,
                'brand' => 'ASUS',
                'processor' => 'AMD Ryzen 9 7940HS',
                'ram' => '16GB DDR5',
                'storage' => '1TB SSD',
                'display' => '14" QHD 165Hz',
                'image' => null
            ],
            [
                'name' => 'Microsoft Surface Laptop 5',
                'description' => 'Sleek design meets powerful performance in this premium laptop.',
                'price' => 72450.00, // Was 1299.99
                'stock' => 14,
                'brand' => 'Microsoft',
                'processor' => 'Intel Core i7-1255U',
                'ram' => '16GB LPDDR5x',
                'storage' => '512GB SSD',
                'display' => '13.5" PixelSense',
                'image' => null
            ],
            [
                'name' => 'Acer Swift 3',
                'description' => 'Affordable laptop with excellent performance and portability.',
                'price' => 38999.00, // Was 749.99
                'stock' => 25,
                'brand' => 'Acer',
                'processor' => 'AMD Ryzen 7 5825U',
                'ram' => '16GB LPDDR4X',
                'storage' => '512GB SSD',
                'display' => '14" FHD IPS',
                'image' => null
            ],
            [
                'name' => 'Razer Blade 15',
                'description' => 'Premium gaming laptop with RGB lighting and powerful graphics.',
                'price' => 154999.00, // Was 2499.99
                'stock' => 6,
                'brand' => 'Razer',
                'processor' => 'Intel Core i7-13800H',
                'ram' => '32GB DDR5',
                'storage' => '1TB SSD',
                'display' => '15.6" QHD 240Hz',
                'image' => null
            ],
            [
                'name' => 'LG Gram 17',
                'description' => 'Ultra-lightweight 17-inch laptop with all-day battery life.',
                'price' => 99990.00, // Was 1699.99
                'stock' => 9,
                'brand' => 'LG',
                'processor' => 'Intel Core i7-1360P',
                'ram' => '16GB LPDDR5',
                'storage' => '1TB SSD',
                'display' => '17" WQXGA IPS',
                'image' => null
            ],
            [
                'name' => 'MSI Prestige 14 Evo',
                'description' => 'Business laptop certified by Intel Evo platform for premium experience.',
                'price' => 79995.00, // Was 1399.99
                'stock' => 11,
                'brand' => 'MSI',
                'processor' => 'Intel Core i7-1360P',
                'ram' => '16GB LPDDR5',
                'storage' => '512GB SSD',
                'display' => '14" FHD+',
                'image' => null
            ]
        ];

        foreach ($products as $product) {
            // CHANGED TO updateOrCreate
            // This ensures that if the product exists, the price gets UPDATED.
            Product::updateOrCreate(
                ['name' => $product['name']], 
                $product
            );
        }
    }
}