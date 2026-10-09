<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel products (dan tabel yang mereferensikannya) lalu reset ID ke 1
        DB::statement('TRUNCATE TABLE products RESTART IDENTITY CASCADE');

        $products = [
            ['name' => 'Smartphone Nova X5 128GB', 'description' => 'Smartphone 5G dengan layar AMOLED 6,5 inci, RAM 8GB, dan baterai 5000 mAh.', 'price' => 3499000, 'stock' => 40],
            ['name' => 'Smartphone Nova Lite 64GB', 'description' => 'Smartphone 4G entry level dengan layar 6,1 inci dan kamera ganda 13 MP.', 'price' => 1599000, 'stock' => 60],
            ['name' => 'Tablet Pad Pro 11 inci', 'description' => 'Tablet layar 11 inci dengan stylus, cocok untuk belajar dan bekerja.', 'price' => 4799000, 'stock' => 25],
            ['name' => 'Smartwatch Pulse S2', 'description' => 'Jam pintar dengan sensor detak jantung, GPS, dan daya tahan baterai 7 hari.', 'price' => 1299000, 'stock' => 35],
            ['name' => 'Earbuds Wireless AirBeat', 'description' => 'Earbuds Bluetooth 5.3 dengan noise cancelling dan casing pengisi daya.', 'price' => 449000, 'stock' => 80],
            ['name' => 'Headphone Over-Ear StudioMax', 'description' => 'Headphone nirkabel dengan bass kuat dan daya tahan baterai hingga 30 jam.', 'price' => 899000, 'stock' => 30],
            ['name' => 'Power Bank 20.000 mAh Fast Charge', 'description' => 'Power bank kapasitas besar dengan output 22,5W dan dua port USB.', 'price' => 349000, 'stock' => 100],
            ['name' => 'Charger Fast Charging 65W GaN', 'description' => 'Charger ringkas 65W dengan teknologi GaN, mendukung laptop dan smartphone.', 'price' => 259000, 'stock' => 90],
            ['name' => 'Kabel USB-C to USB-C 1 Meter', 'description' => 'Kabel data dan charging dengan lapisan nylon braided yang tahan lama.', 'price' => 69000, 'stock' => 200],
            ['name' => 'Router WiFi 6 Dual Band AX1800', 'description' => 'Router WiFi 6 dengan jangkauan luas dan dukungan hingga 50 perangkat.', 'price' => 799000, 'stock' => 45],
            ['name' => 'Modem 4G LTE Portable MiFi', 'description' => 'Modem WiFi portabel 4G LTE dengan baterai 3000 mAh, menampung 10 pengguna.', 'price' => 549000, 'stock' => 50],
            ['name' => 'WiFi Extender Repeater 300Mbps', 'description' => 'Penguat sinyal WiFi untuk menjangkau area rumah yang sulit tersambung.', 'price' => 189000, 'stock' => 70],
            ['name' => 'Kabel LAN Cat6 10 Meter', 'description' => 'Kabel jaringan Cat6 berkecepatan hingga 1 Gbps, siap pakai.', 'price' => 85000, 'stock' => 150],
            ['name' => 'Kamera CCTV WiFi Indoor 2MP', 'description' => 'Kamera pengawas dengan night vision, deteksi gerak, dan akses lewat aplikasi.', 'price' => 299000, 'stock' => 55],
            ['name' => 'Smart Plug WiFi 16A', 'description' => 'Stop kontak pintar yang bisa dikontrol lewat aplikasi dan jadwal otomatis.', 'price' => 119000, 'stock' => 120],
            ['name' => 'Speaker Bluetooth Portable BoomGo', 'description' => 'Speaker tahan air IPX6 dengan suara stereo dan baterai 12 jam.', 'price' => 399000, 'stock' => 65],
            ['name' => 'Keyboard Mechanical Wireless K75', 'description' => 'Keyboard mekanikal 75% dengan koneksi Bluetooth dan USB, switch blue.', 'price' => 679000, 'stock' => 30],
            ['name' => 'Mouse Wireless Ergonomic M300', 'description' => 'Mouse nirkabel ergonomis dengan sensor 1600 DPI dan baterai tahan 12 bulan.', 'price' => 149000, 'stock' => 110],
            ['name' => 'SSD Eksternal 500GB USB 3.2', 'description' => 'SSD portabel dengan kecepatan baca hingga 1000 MB/s dalam bodi aluminium.', 'price' => 849000, 'stock' => 40],
            ['name' => 'Flashdisk 64GB USB 3.0', 'description' => 'Flashdisk berkecepatan tinggi dengan casing logam yang kokoh.', 'price' => 79000, 'stock' => 180],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}