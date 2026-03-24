<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StocksModel;

class Stock extends BaseController
{
    public function shop()
    {
        $session = session();
        $user = $session->get('user');

        $stocksModel = new StocksModel();

        $filter = $this->request->getGet('filter');
        if ($filter === 'featured') {
            $products = $stocksModel->where('is_featured', 1)->findAll();
        } elseif ($filter === 'trending') {
            $products = $stocksModel->orderBy('sales_count', 'DESC')->findAll();
        } elseif ($filter === 'best-seller') {
            $products = $stocksModel->orderBy('sales_count', 'DESC')->findAll();
        } else {
            $products = $stocksModel->findAll();
        }

        $userFirstName = $user ? ($user['profile']['display_name'] ?? $user['first_name'] ?? 'Guest') : 'Guest';
        $isLoggedIn = $session->has('user');

        return view('user/shopPage', [
            'products' => $products,
            'userFirstName' => $userFirstName,
            'isLoggedIn' => $isLoggedIn,
        ]);
    }
}
