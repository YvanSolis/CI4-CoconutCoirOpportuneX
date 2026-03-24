<?php

namespace App\Controllers\UserCRUDtest;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UserUpdate extends BaseController
{
    /**
     * Show Edit Form
     */
    public function edit($id)
    {
        $model = new UsersModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/admin/accountsPage')->with('error', 'User not found.');
        }

        return $this->response->setJSON($user);
    }

    /**
     * Process Update
     */
    public function update($id)
    {
        $model = new UsersModel();
        $user = $model->find($id);

        if (!$user) {
            return redirect()->to('/admin/accountsPage')->with('error', 'User not found.');
        }

        $data = [
            'first_name'  => $this->request->getPost('first_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'last_name'   => $this->request->getPost('last_name'),
            'email'       => $this->request->getPost('email'),
        ];

        // Only update password if provided
        if ($this->request->getPost('password') !== '') {
            $data['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $model->update($id, $data);

        return redirect()->to('/admin/accountsPage')->with('message', 'User updated successfully.');
    }
}
