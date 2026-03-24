<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StocksModel;
use App\Models\OrdersModel;
use App\Models\OrderItemsModel;
use CodeIgniter\Exceptions\ForbiddenException;

class Seller extends BaseController
{
    private function checkSellerAccess()
    {
        $session = session();
        if (!$session->has('user')) {
            throw ForbiddenException::forbidden('Authentication required.');
        }

        $user = $session->get('user');
        if (!in_array($user['type'], ['seller', 'buyer-seller', 'admin'])) {
            throw ForbiddenException::forbidden('Access denied: Seller only.');
        }

        return $user;
    }

    public function dashboard()
    {
        $user = $this->checkSellerAccess();

        $stocksModel = new StocksModel();
        $sellerProducts = $stocksModel->where('seller_id', $user['id'])->findAll();

        $ordersModel = new OrdersModel();
        $orderItemsModel = new OrderItemsModel();

        $sellerSales = $orderItemsModel
            ->select('SUM(subtotal) as total_sales')
            ->where('seller_id', $user['id'])
            ->first();

        $todaySales = $orderItemsModel
            ->select('SUM(subtotal) as today_sales')
            ->where('seller_id', $user['id'])
            ->where('DATE(created_at)', date('Y-m-d'))
            ->first();

        return view('seller/dashboard', [
            'sellerProducts' => $sellerProducts,
            'totalSales' => $sellerSales->total_sales ?? 0,
            'todaySales' => $todaySales->today_sales ?? 0,
            'sellerName' => $user['profile']['display_name'] ?? $user['first_name'],
        ]);
    }

    public function inventory()
    {
        $user = $this->checkSellerAccess();

        $stocksModel = new StocksModel();
        $products = $stocksModel->where('seller_id', $user['id'])->findAll();

        return view('seller/inventory', ['products' => $products]);
    }

    public function createProduct()
    {
        $user = $this->checkSellerAccess();
        $request = service('request');

        $validation = \Config\Services::validation();
        $validation->setRule('name', 'Name', 'required|min_length[2]');
        $validation->setRule('price', 'Price', 'required|decimal');
        $validation->setRule('quantity', 'Quantity', 'required|integer');

        if (!$validation->withRequest($request)->run($request->getPost())) {
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        $stockData = [
            'name' => $request->getPost('name'),
            'description' => $request->getPost('description'),
            'price' => $request->getPost('price'),
            'quantity' => $request->getPost('quantity'),
            'category' => $request->getPost('category'),
            'seller_id' => $user['id'],
            'is_featured' => $request->getPost('is_featured') ? 1 : 0,
            'sales_count' => 0,
        ];

        $stocksModel = new StocksModel();
        $stocksModel->insert($stockData);

        return redirect()->to('/seller/inventory')->with('success', 'Product added successfully.');
    }

    public function reports()
    {
        $user = $this->checkSellerAccess();

        $orderItemsModel = new OrderItemsModel();

        $monthly = $orderItemsModel
            ->select('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(subtotal) as total')
            ->where('seller_id', $user['id'])
            ->groupBy('month')
            ->orderBy('month', 'DESC')
            ->findAll();

        $inventoryModel = new StocksModel();
        $inventory = $inventoryModel->where('seller_id', $user['id'])->findAll();

        return view('seller/reports', [
            'monthly' => $monthly,
            'inventory' => $inventory,
        ]);
    }
}
