<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@laptop.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '1234567890',
            'address' => 'Admin Office, Tech City'
        ]);

        // Create Customer User
        User::create([
            'name' => 'John Doe',
            'email' => 'customer@laptop.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'phone' => '0987654321',
            'address' => '123 Customer Street, Tech City'
        ]);

        // Create 10 Laptop Products
        $products = [
            [
                'name' => 'Dell XPS 13',
                'description' => 'Ultra-portable laptop with stunning InfinityEdge display and powerful performance.',
                'price' => 1299.99,
                'stock' => 15,
                'brand' => 'Dell',
                'processor' => 'Intel Core i7-1355U',
                'ram' => '16GB DDR5',
                'storage' => '512GB SSD',
                'display' => '13.4" FHD+'
            ],
            [
                'name' => 'MacBook Pro 14',
                'description' => 'Apple M3 Pro chip delivers exceptional performance for creative professionals.',
                'price' => 1999.99,
                'stock' => 10,
                'brand' => 'Apple',
                'processor' => 'Apple M3 Pro',
                'ram' => '18GB Unified Memory',
                'storage' => '512GB SSD',
                'display' => '14.2" Liquid Retina XDR'
            ],
            [
                'name' => 'HP Spectre x360',
                'description' => 'Convertible laptop with premium design and long battery life.',
                'price' => 1449.99,
                'stock' => 12,
                'brand' => 'HP',
                'processor' => 'Intel Core i7-1355U',
                'ram' => '16GB LPDDR5',
                'storage' => '1TB SSD',
                'display' => '13.5" OLED 3K2K'
            ],
            [
                'name' => 'Lenovo ThinkPad X1 Carbon',
                'description' => 'Business laptop with legendary keyboard and robust security features.',
                'price' => 1599.99,
                'stock' => 20,
                'brand' => 'Lenovo',
                'processor' => 'Intel Core i7-1365U',
                'ram' => '32GB LPDDR5',
                'storage' => '1TB SSD',
                'display' => '14" WUXGA IPS'
            ],
            [
                'name' => 'ASUS ROG Zephyrus G14',
                'description' => 'Gaming laptop with AMD Ryzen power and compact design.',
                'price' => 1799.99,
                'stock' => 8,
                'brand' => 'ASUS',
                'processor' => 'AMD Ryzen 9 7940HS',
                'ram' => '16GB DDR5',
                'storage' => '1TB SSD',
                'display' => '14" QHD 165Hz'
            ],
            [
                'name' => 'Microsoft Surface Laptop 5',
                'description' => 'Sleek design meets powerful performance in this premium laptop.',
                'price' => 1299.99,
                'stock' => 14,
                'brand' => 'Microsoft',
                'processor' => 'Intel Core i7-1255U',
                'ram' => '16GB LPDDR5x',
                'storage' => '512GB SSD',
                'display' => '13.5" PixelSense'
            ],
            [
                'name' => 'Acer Swift 3',
                'description' => 'Affordable laptop with excellent performance and portability.',
                'price' => 749.99,
                'stock' => 25,
                'brand' => 'Acer',
                'processor' => 'AMD Ryzen 7 5825U',
                'ram' => '16GB LPDDR4X',
                'storage' => '512GB SSD',
                'display' => '14" FHD IPS'
            ],
            [
                'name' => 'Razer Blade 15',
                'description' => 'Premium gaming laptop with RGB lighting and powerful graphics.',
                'price' => 2499.99,
                'stock' => 6,
                'brand' => 'Razer',
                'processor' => 'Intel Core i7-13800H',
                'ram' => '32GB DDR5',
                'storage' => '1TB SSD',
                'display' => '15.6" QHD 240Hz'
            ],
            [
                'name' => 'LG Gram 17',
                'description' => 'Ultra-lightweight 17-inch laptop with all-day battery life.',
                'price' => 1699.99,
                'stock' => 9,
                'brand' => 'LG',
                'processor' => 'Intel Core i7-1360P',
                'ram' => '16GB LPDDR5',
                'storage' => '1TB SSD',
                'display' => '17" WQXGA IPS'
            ],
            [
                'name' => 'MSI Prestige 14 Evo',
                'description' => 'Business laptop certified by Intel Evo platform for premium experience.',
                'price' => 1399.99,
                'stock' => 11,
                'brand' => 'MSI',
                'processor' => 'Intel Core i7-1360P',
                'ram' => '16GB LPDDR5',
                'storage' => '512GB SSD',
                'display' => '14" FHD+'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}