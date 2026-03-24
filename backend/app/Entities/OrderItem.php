<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class OrderItem extends Entity
{
    protected $datamap = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'order_id' => 'int',
        'stock_id' => 'int',
        'seller_id' => 'int',
        'quantity' => 'int',
        'unit_price' => 'float',
        'subtotal' => 'float',
    ];
}
