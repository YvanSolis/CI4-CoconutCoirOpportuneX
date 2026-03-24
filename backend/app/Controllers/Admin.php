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
        $totalStockValue = (float) ($stocksModel
            ->select('SUM(quantity * price) as value')
            ->asArray()
            ->first()['value'] ?? 0.00);

        $topSelling = $orderItemsModel
            ->select('order_items.stock_id, stocks.name as stock_name, SUM(order_items.quantity) as sold_quantity')
            ->join('stocks', 'stocks.id = order_items.stock_id')
            ->groupBy('order_items.stock_id')
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

    public function ordersHistory()
    {
        $this->checkAdminAccess();

        $ordersModel = new OrdersModel();
        $orderItemsModel = new OrderItemsModel();

        $orders = $ordersModel
            ->select('orders.*, users.first_name, users.middle_name, users.last_name, users.email')
            ->join('users', 'users.id = orders.user_id', 'left')
            ->orderBy('orders.id', 'ASC')
            ->findAll();

        $orderIds = array_map(static fn($order) => $order->id, $orders);
        $itemsByOrderId = [];

        if (!empty($orderIds)) {
            $orderItems = $orderItemsModel
                ->select('order_items.*, stocks.name as product_name')
                ->join('stocks', 'stocks.id = order_items.stock_id', 'left')
                ->whereIn('order_items.order_id', $orderIds)
                ->orderBy('order_items.id', 'ASC')
                ->findAll();

            foreach ($orderItems as $item) {
                $itemsByOrderId[$item->order_id][] = $item;
            }
        }

        foreach ($orders as $order) {
            $middle = trim((string) ($order->middle_name ?? ''));
            $middleWithSpace = $middle !== '' ? $middle . ' ' : '';

            $order->customer_name = trim(
                ($order->first_name ?? '') . ' ' .
                    $middleWithSpace .
                    ($order->last_name ?? '')
            );
            $order->items = $itemsByOrderId[$order->id] ?? [];
        }

        return view('admin/ordersHistory', [
            'adminFirstName' => session()->get('user')['first_name'] ?? 'Admin',
            'orders' => $orders,
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
