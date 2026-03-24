<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\StocksModel;
use App\Models\OrdersModel;
use App\Models\OrderItemsModel;
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

        // Sales summary
        $ordersModel = new OrdersModel();

        $today = date('Y-m-d');
        $monthStart = date('Y-m-01');

        $todaySales = (float) ($ordersModel
            ->where('status', 'completed')
            ->where('DATE(created_at)', $today)
            ->selectSum('total_amount', 'sum')
            ->asArray()
            ->first()['sum'] ?? 0.00);

        $monthlySales = (float) ($ordersModel
            ->where('status', 'completed')
            ->where('DATE(created_at) >=', $monthStart)
            ->where('DATE(created_at) <=', $today)
            ->selectSum('total_amount', 'sum')
            ->asArray()
            ->first()['sum'] ?? 0.00);

        // Admin name
        $session   = session();
        $firstName = $session->get('user')['first_name'] ?? 'Admin';

        return view('admin/adminDashboard', [
            'adminFirstName' => $firstName,
            'clientsCount'   => $clientsCount,
            'booksCount'     => $booksCount,
            'todaySales'     => $todaySales,
            'monthlySales'   => $monthlySales,
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

    public function toggleFeatured($id)
    {
        $this->checkAdminAccess();

        $stocksModel = new StocksModel();
        $stock = $stocksModel->find($id);

        if (!$stock) {
            return redirect()->to('/admin/stockPage')->with('error', 'Stock item not found.');
        }

        $stocksModel->update($id, [
            'is_featured' => $stock->is_featured ? 0 : 1,
        ]);

        return redirect()->to('/admin/stockPage')->with('message', 'Featured status updated.');
    }

    public function inventoryReports()
    {
        $this->checkAdminAccess();

        $stocksModel = new StocksModel();
        $ordersModel = new OrdersModel();
        $orderItemsModel = new OrderItemsModel();

        $inventoryCount = $stocksModel->countAllResults();
        $lowStockCount = $stocksModel->where('quantity <', 10)->countAllResults();
        $totalStockValue = (float) ($stocksModel->selectSum('quantity * price', 'value')->asArray()->first()['value'] ?? 0.00);

        $topSelling = $orderItemsModel
            ->select('stock_id, SUM(quantity) as sold_quantity')
            ->groupBy('stock_id')
            ->orderBy('sold_quantity', 'DESC')
            ->limit(10)
            ->findAll();

        return view('admin/inventoryReports', [
            'adminFirstName' => session()->get('user')['first_name'] ?? 'Admin',
            'inventoryCount' => $inventoryCount,
            'lowStockCount'  => $lowStockCount,
            'totalStockValue' => $totalStockValue,
            'topSelling'     => $topSelling,
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
