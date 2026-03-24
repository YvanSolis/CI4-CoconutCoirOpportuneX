<?php

namespace App\Controllers\UserCRUDtest;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UserDelete extends BaseController
{
    public function delete($id)
    {
        $model = new UsersModel();

        // Check if user exists
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/admin/accountsPage')->with('error', 'User not found.');
        }

        // Delete user
        $model->delete($id);

        return redirect()->to('/admin/accountsPage')->with('message', 'User deleted successfully.');
    }
}
