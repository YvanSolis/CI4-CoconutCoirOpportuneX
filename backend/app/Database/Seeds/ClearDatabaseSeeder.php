<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearDatabaseSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Order matters: child tables first, then parents
        // List down your tables here
        $tablesInOrder = ['requests', 'stocks', 'users'];

        $db->disableForeignKeyChecks();

        try {
            foreach ($tablesInOrder as $table) {
                if (method_exists($db, 'tableExists') && $db->tableExists($table)) {
                    $db->table($table)->truncate();
                }
            }
        } finally {
            $db->enableForeignKeyChecks();
        }
    }
}
