<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UsersModel;
use App\Models\ProfilesModel;

class ProfilesSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UsersModel();
        $profileModel = new ProfilesModel();

        $users = $userModel->findAll();

        foreach ($users as $user) {
            $existing = $profileModel->where('user_id', $user->id)->first();
            if ($existing) {
                continue;
            }

            $profileModel->insert([
                'user_id' => $user->id,
                'display_name' => trim($user->first_name . ' ' . $user->last_name),
                'bio' => null,
            ]);
        }
    }
}
