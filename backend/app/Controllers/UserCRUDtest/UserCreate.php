<?php

namespace App\Controllers\UserCRUDtest;

use App\Controllers\BaseController;
use App\Models\ProfilesModel;
use App\Models\UsersModel;

class UserCreate extends BaseController
{



    public function createForm()
    {
        return view('admin/forms/addUser');
    }

    public function createAccount()
    {
        $model = new UsersModel();

        // Validate passwords match
        $password = $this->request->getPost('password');
        $confirm  = $this->request->getPost('password_confirm');

        if ($password !== $confirm) {
            return redirect()->back()->with('error', 'Passwords do not match.');
        }

        // Prepare data for database
        $data = [
            'first_name'     => $this->request->getPost('first_name'),
            'middle_name'    => $this->request->getPost('middle_name'),
            'last_name'      => $this->request->getPost('last_name'),
            'email'          => $this->request->getPost('email'),
            'password_hash'  => password_hash($password, PASSWORD_DEFAULT),
            'type'           => $this->request->getPost('type'),
            'account_status' => $this->request->getPost('account_status'), // 1 = active
        ];

        // Insert into DB
        $userId = $model->insert($data);
        if ($userId) {
            // Ensure profile record exists (without avatar)
            $profileModel = new ProfilesModel();
            $profileModel->insert([
                'user_id' => $userId,
                'display_name' => trim($data['first_name'] . ' ' . $data['last_name']),
            ]);

            return redirect()->to('/admin/accountsPage')
                ->with('message', 'User added successfully.');
        }

        return redirect()->back()->with('error', 'Error adding user.');
    }
}
