<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEcommerceFieldsToUsersAndStocks extends Migration
{
    public function up()
    {
        $userFields = [];

        if (!$this->db->fieldExists('address', 'users')) {
            $userFields['address'] = [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ];
        }

        if (!$this->db->fieldExists('mobile', 'users')) {
            $userFields['mobile'] = [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ];
        }

        if (!$this->db->fieldExists('type', 'users')) {
            $userFields['type'] = [
                'type' => 'ENUM',
                'constraint' => ['client', 'seller', 'admin', 'buyer-seller'],
                'default' => 'client',
                'null' => false,
            ];
        }

        if (!empty($userFields)) {
            $this->forge->addColumn('users', $userFields);
        }

        $stockFields = [];

        if (!$this->db->fieldExists('seller_id', 'stocks')) {
            $stockFields['seller_id'] = [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ];
        }

        if (!$this->db->fieldExists('category', 'stocks')) {
            $stockFields['category'] = [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ];
        }

        if (!$this->db->fieldExists('is_featured', 'stocks')) {
            $stockFields['is_featured'] = [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
            ];
        }

        if (!$this->db->fieldExists('sales_count', 'stocks')) {
            $stockFields['sales_count'] = [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 0,
                'null' => false,
            ];
        }

        if (!empty($stockFields)) {
            $this->forge->addColumn('stocks', $stockFields);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['address', 'mobile']);
        $this->forge->dropColumn('stocks', ['seller_id', 'category', 'is_featured', 'sales_count']);
    }
}
