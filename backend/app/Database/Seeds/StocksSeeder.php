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
                'is_featured' => 1,
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
                'is_featured' => 1,
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
                'description' => 'It has excellent moisture retention and airflow, making it perfect for both indoor and outdoor use.',
                'price'       => 150.00,
                'quantity'    => 15,
                'image'       => '/assets/CoirBasket.png',
                'is_featured' => 1,
                'sales_count' => 25,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Coir Slippers',
                'description' => 'Lightweight and breathable slippers made from natural coconut fibers, designed for comfort and durability. These slippers are eco-friendly, providing a soft yet firm feel for everyday indoor use.',
                'price'       => 250.00,
                'quantity'    => 10,
                'image'       => '/assets/CoirSlippers.png',
                'is_featured' => 1,
                'sales_count' => 18,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Coir Pillow',
                'description' => 'A firm and supportive pillow filled with coconut fiber, offering good airflow and natural cooling. It is ideal for back support, seating, or sleeping, and is resistant to dust and moisture buildup.',
                'price'       => 350.00,
                'quantity'    => 8,
                'image'       => '/assets/CoirPillow.png',
                'is_featured' => 0,
                'sales_count' => 30,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Coir Cup Holder',
                'description' => 'A sturdy and eco-friendly cup holder made from coir or natural fibers, designed to securely hold beverages while reducing spills.',
                'price'       => 100.00,
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
