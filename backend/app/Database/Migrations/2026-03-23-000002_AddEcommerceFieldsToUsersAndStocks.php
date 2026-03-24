<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEcommerceFieldsToUsersAndStocks extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'mobile' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['client', 'seller', 'admin', 'buyer-seller'],
                'default' => 'client',
                'null' => false,
            ],
        ]);

        $this->forge->addColumn('stocks', [
            'seller_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'is_featured' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
            ],
            'sales_count' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 0,
                'null' => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['address', 'mobile']);
        $this->forge->dropColumn('stocks', ['seller_id', 'category', 'is_featured', 'sales_count']);
    }
}
