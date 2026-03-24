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
                'name'        => 'Tales of Japan',
                'description' => 'A collection of magical folklore stories from Japan.',
                'price'       => 499.00,
                'quantity'    => 15,
                'image'       => 'https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1538457160i/41188320.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Japanese Yokai',
                'description' => 'Guide to monsters, demons and magical creatures.',
                'price'       => 149.00,
                'quantity'    => 10,
                'image'       => 'https://unsw-prod.s3.amazonaws.com/media/images/9784805318911_i0UR1OC.original.jpg',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Supernatural Tales from Japan',
                'description' => 'Collection of eerie ghost stories and yokai legends.',
                'price'       => 179.00,
                'quantity'    => 8,
                'image'       => 'https://cdn11.bigcommerce.com/s-q39b4/images/stencil/2000x2000/products/9578/239719/9784805318539__58590.1709233075.jpg?c=2',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        $this->db->table('stocks')->insertBatch($stocks);
    }
}
