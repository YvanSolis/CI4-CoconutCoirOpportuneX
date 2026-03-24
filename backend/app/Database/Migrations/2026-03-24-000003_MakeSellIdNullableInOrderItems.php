<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeSellIdNullableInOrderItems extends Migration
{
    public function up()
    {
        // Make seller_id nullable in order_items table
        $this->forge->modifyColumn('order_items', [
            'seller_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,  // Changed from false to true
            ],
        ]);
    }

    public function down()
    {
        // Revert to NOT NULL
        $this->forge->modifyColumn('order_items', [
            'seller_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
        ]);
    }
}
