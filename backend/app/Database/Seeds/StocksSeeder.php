<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StocksSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $stocks = [
            [
                'name'        => 'Coconot Coir Doormat',
                'description' => 'A durable and eco-friendly doormat made from natural coconut coir fibers. Perfect for absorbing moisture and dirt at your entrance while adding a rustic charm to your home.',
                'price'       => 299.00,
                'quantity'    => 15,
                'image'       => '/assets/Doormat.png',
                'is_featured' => 0,
                'sales_count' => 25,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Coir Fiber',
                'description' => 'High-quality raw coconut coir fiber, ideal for gardening, horticulture, and various crafting projects. Naturally biodegradable and sustainable.',
                'price'       => 149.00,
                'quantity'    => 10,
                'image'       => '/assets/Coir Fiber.png',
                'is_featured' => 0,
                'sales_count' => 18,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Coir Heat Insulation',
                'description' => 'Effective thermal insulation material made from compressed coconut coir. Excellent for soundproofing and temperature regulation in homes and buildings.',
                'price'       => 15.00,
                'quantity'    => 8,
                'image'       => '/assets/CoirHeatInsulation.png',
                'is_featured' => 0,
                'sales_count' => 30,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Coir Basket',
                'description' => 'Handwoven basket crafted from durable coconut coir fibers. Perfect for storage, laundry, or as a decorative piece in your home. Eco-friendly and long-lasting.',
                'price'       => 199.00,
                'quantity'    => 15,
                'image'       => '/assets/CoirBasket.png',
                'is_featured' => 1,
                'sales_count' => 25,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Coir Slippers',
                'description' => 'Comfortable and stylish slippers made from soft coconut coir material. Ideal for indoor use, providing warmth and support while being environmentally sustainable.',
                'price'       => 349.00,
                'quantity'    => 10,
                'image'       => '/assets/CoirSlippers.png',
                'is_featured' => 1,
                'sales_count' => 18,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Coir Pillow',
                'description' => 'Supportive pillow filled with natural coconut coir fibers. Hypoallergenic, moisture-wicking, and perfect for a good night\'s sleep. Eco-conscious bedding choice.',
                'price'       => 249.00,
                'quantity'    => 8,
                'image'       => '/assets/CoirPillow.png',
                'is_featured' => 0,
                'sales_count' => 30,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Coir Cup Holder',
                'description' => 'Compact and practical cup holder made from woven coconut coir. Keeps your drinks secure and adds a natural touch to your desk or table.',
                'price'       => 49.00,
                'quantity'    => 8,
                'image'       => '/assets/CoirCupHolder.png',
                'is_featured' => 0,
                'sales_count' => 30,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        $this->db->table('stocks')->insertBatch($stocks);
    }
}
