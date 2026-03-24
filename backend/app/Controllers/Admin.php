<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\StocksModel;
use CodeIgniter\Exceptions\ForbiddenException;

class Admin extends BaseController
{
    private function checkAdminAccess()
    {
        $session = session();

        if (!$session->has('user')) {
            throw ForbiddenException::forbidden('Authentication required.');
        }

        $user = $session->get('user');

        if (!isset($user['type']) || $user['type'] !== 'admin') {
            throw ForbiddenException::forbidden('Access denied: Admin only.');
        }
    }

    public function showDashboard()
    {
        $this->checkAdminAccess();

        $usersModel  = new UsersModel();
        $stocksModel = new StocksModel();

        // Count all clients
        $clientsCount = $usersModel->where('type', 'client')->countAllResults();

        // Count all books
        $booksCount = $stocksModel->countAllResults();

        // Admin name
        $session   = session();
        $firstName = $session->get('user')['first_name'] ?? 'Admin';

        return view('admin/adminDashboard', [
            'adminFirstName' => $firstName,
            'clientsCount'   => $clientsCount,
            'booksCount'     => $booksCount
            // monthlySales removed
        ]);
    }

    public function stockPage()
    {
        $this->checkAdminAccess();

        $session   = session();
        $firstName = $session->get('user')['first_name'] ?? 'Admin';

        $stocksModel = new StocksModel();
        $stocks = $stocksModel->findAll();

        return view('admin/stockPage', [
            'adminFirstName' => $firstName,
            'stocks' => $stocks
        ]);
    }

    public function accountsPage()
    {
        $this->checkAdminAccess();

        $session   = session();
        $firstName = $session->get('user')['first_name'] ?? 'Admin';

        $usersModel = new UsersModel();
        $accounts = $usersModel->findAll();

        return view('admin/accountsPage', [
            'adminFirstName' => $firstName,
            'accounts' => $accounts
        ]);
    }

    public function updateAccount($id)
    {
        $this->checkAdminAccess();

        $usersModel = new UsersModel();
        $user = $usersModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/accountsPage')->with('error', 'User not found.');
        }

        $data = [
            'first_name'  => $this->request->getPost('first_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'last_name'   => $this->request->getPost('last_name'),
            'email'       => $this->request->getPost('email'),
        ];

        if (!empty($this->request->getPost('password'))) {
            $data['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $usersModel->update($id, $data);

        return redirect()->to('/admin/accountsPage')->with('message', 'User updated.');
    }
}
