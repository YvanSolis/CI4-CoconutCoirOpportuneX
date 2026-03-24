<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Stock extends Entity
{
    protected $datamap = [];

    // Fields that should be automatically handled as datetime objects
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Type casting (optional)
    protected $casts   = [
        'price'    => 'float',
        'quantity' => 'int'
    ];
}
