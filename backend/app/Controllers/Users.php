<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StocksModel;

class Users extends BaseController
{
    public function index()
    {
        $session = session();
        $stocksModel = new StocksModel();

        // Get featured products for storefront
        $featuredProducts = $stocksModel->where('is_featured', 1)->findAll();

        // Get trending products (by sales count)
        $trendingProducts = $stocksModel->orderBy('sales_count', 'DESC')->limit(4)->findAll();

        // Get best sellers
        $bestSellers = $stocksModel->orderBy('sales_count', 'DESC')->limit(4)->findAll();

        // Get some random products for variety
        $allProducts = $stocksModel->findAll();
        shuffle($allProducts);
        $randomProducts = array_slice($allProducts, 0, 6);

        $isLoggedIn = $session->has('user');

        return view('user/landingPage', [
            'featuredProducts' => $featuredProducts,
            'trendingProducts' => $trendingProducts,
            'bestSellers' => $bestSellers,
            'randomProducts' => $randomProducts,
            'isLoggedIn' => $isLoggedIn,
        ]);
    }

    public function featured()
    {
        $session = session();
        $stocksModel = new StocksModel();

        // Get featured products
        $featuredProducts = $stocksModel->where('is_featured', 1)->findAll();

        // Fallback: if no featured products yet, show top 6 best sellers
        if (empty($featuredProducts)) {
            $featuredProducts = $stocksModel->orderBy('sales_count', 'DESC')->limit(6)->findAll();
            $featuredFallback = true;
        } else {
            $featuredFallback = false;
        }

        // Get trending products (by sales count)
        $trendingProducts = $stocksModel->orderBy('sales_count', 'DESC')->limit(6)->findAll();

        // Get best sellers (same as trending for now)
        $bestSellers = $stocksModel->orderBy('sales_count', 'DESC')->limit(6)->findAll();

        $isLoggedIn = $session->has('user');

        return view('user/featuredPage', [
            'featuredProducts' => $featuredProducts,
            'trendingProducts' => $trendingProducts,
            'bestSellers' => $bestSellers,
            'featuredFallback' => $featuredFallback ?? false,
            'isLoggedIn' => $isLoggedIn,
        ]);
    }

    public function login()
    {
        return view('user/loginPage');
    }

    public function signup()
    {
        return view('user/signupPage');
    }

    public function moodboard()
    {
        return view('user/moodboardPage');
    }

    public function roadmap()
    {
        return view('user/roadmapPage');
    }

    private function getCart()
    {
        $session = session();

        if (!$session->has('user')) {
            return [];
        }

        $userId = $session->get('user')['id'];
        $cartKey = "cart_$userId";

        $cart = $session->get($cartKey) ?? [];

        // Sync with session "cart"
        $session->set('cart', $cart);

        return $cart;
    }

    public function cart()
    {
        $session = session();
        if (!$session->has('user')) return redirect()->to('/loginPage');

        $cartItems = $this->getCart();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $user = $session->get('user');
        $userFirstName = $user['profile']['display_name'] ?? $user['first_name'] ?? 'Reader';

        return view('user/cartPage', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'userFirstName' => $userFirstName
        ]);
    }

    public function checkout()
    {
        $session = session();
        if (!$session->has('user')) return redirect()->to('/loginPage');

        $cartItems = $this->getCart();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $user = $session->get('user');
        $userFirstName = $user['profile']['display_name'] ?? $user['first_name'] ?? 'Reader';

        return view('user/checkoutPage', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'userFirstName' => $userFirstName
        ]);
    }

    public function profile()
    {
        $session = session();
        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        return view('user/profilePage');
    }

    public function orders()
    {
        $session = session();
        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        $userId = $session->get('user')['id'];

        $ordersModel = new \App\Models\OrdersModel();
        $orderItemsModel = new \App\Models\OrderItemsModel();

        $orders = $ordersModel->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();

        foreach ($orders as $order) {
            $order->items = $orderItemsModel->where('order_id', $order->id)->findAll();
        }

        return view('user/ordersPage', [
            'orders' => $orders,
        ]);
    }

    public function updateProfile()
    {
        $session = session();
        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        $user = $session->get('user');
        $userId = $user['id'];

        $request = service('request');
        $validation = \Config\Services::validation();

        $validation->setRule('display_name', 'Display Name', 'required|min_length[2]|max_length[150]');
        $validation->setRule('avatar', 'Profile picture', 'permit_empty|is_image[avatar]|max_size[avatar,2048]|ext_in[avatar,png,jpg,jpeg]');

        $post = $request->getPost();

        if (!$validation->withRequest($request)->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        $profileModel = new \App\Models\ProfilesModel();
        $profile = $profileModel->where('user_id', $userId)->first();

        $avatarUrl = $profile?->avatar_url;
        $avatarFile = $request->getFile('avatar');

        if ($avatarFile && $avatarFile->isValid() && !$avatarFile->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/profiles/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Remove previous avatar file if it exists
            if (!empty($avatarUrl)) {
                $existingFile = FCPATH . ltrim($avatarUrl, '/');
                if (is_file($existingFile)) {
                    @unlink($existingFile);
                }
            }

            $newName = $avatarFile->getRandomName();
            $avatarFile->move($uploadPath, $newName);
            $avatarUrl = '/uploads/profiles/' . $newName;
        }

        $profileData = [
            'display_name' => $post['display_name'],
            'avatar_url' => $avatarUrl,
        ];

        if ($profile) {
            $profileModel->update($profile->id, $profileData);
        } else {
            $profileData['user_id'] = $userId;
            $profileModel->insert($profileData);
        }

        // Keep session in sync
        $user['avatar_url'] = $avatarUrl;
        $user['profile']['display_name'] = $post['display_name'];
        $session->set('user', $user);

        $session->setFlashdata('success', 'Profile updated successfully.');
        return redirect()->to('/profile');
    }

    /**
     * PLACE ORDER — deduct stock + clear cart
     */
    public function placeOrder()
    {
        $session = session();

        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        $userId = $session->get('user')['id'];
        $cartKey = "cart_$userId";

        $cart = $this->getCart();

        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        }

        $request = service('request');
        $validation = \Config\Services::validation();
        $validation->setRule('payment_method', 'Payment method', 'required|in_list[cash,card,gcash,paymaya]');
        $validation->setRule('delivery_method', 'Delivery method', 'required|in_list[pickup,delivery]');

        if (!$validation->withRequest($request)->run($request->getPost())) {
            $session->setFlashdata('checkout_errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        $payments = $request->getPost('payment_method');
        $delivery = $request->getPost('delivery_method');

        $stocksModel = new StocksModel();
        $ordersModel = new \App\Models\OrdersModel();
        $orderItemsModel = new \App\Models\OrderItemsModel();

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $orderId = $ordersModel->insert([
            'user_id' => $userId,
            'status' => 'completed',
            'payment_method' => $payments,
            'delivery_method' => $delivery,
            'total_amount' => $totalAmount,
        ]);

        foreach ($cart as $item) {
            $product = $stocksModel->find($item['id']);

            if (!$product) {
                continue;
            }

            $quantity = min($item['quantity'], $product->quantity);
            $subtotal = $item['price'] * $quantity;

            $orderItemsModel->insert([
                'order_id' => $orderId,
                'stock_id' => $item['id'],
                'seller_id' => $product->seller_id ?? null,
                'quantity' => $quantity,
                'unit_price' => $item['price'],
                'subtotal' => $subtotal,
            ]);

            $newQuantity = max(0, $product->quantity - $quantity);
            $stocksModel->update($item['id'], [
                'quantity' => $newQuantity,
                'sales_count' => ($product->sales_count ?? 0) + $quantity,
            ]);
        }

        // 🔥 Clear only THIS user's cart
        $session->remove($cartKey);
        $session->remove('cart');

        return redirect()->to('/shop')->with('success', 'Order placed!');
    }
}
