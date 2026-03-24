<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StocksModel;

class Cart extends BaseController
{
    private function getCartKey()
    {
        $session = session();
        $user = $session->get('user');
        return $user ? "cart_" . $user['id'] : "guest_cart";
    }

    public function add()
    {
        $session = session();

        // Require login for cart operations
        if (!$session->has('user')) {
            $session->setFlashdata('error', 'Please log in before adding items to your cart.');
            return redirect()->to('/loginPage');
        }

        $stocks = new StocksModel();

        $cartKey = $this->getCartKey();

        $id       = $this->request->getPost('id');
        $title    = $this->request->getPost('title');
        $price    = $this->request->getPost('price');
        $quantity = (int)$this->request->getPost('quantity');

        $product = $stocks->find($id);

        if (!$product) {
            return redirect()->back();
        }

        if ($quantity < 1 || $quantity > $product->quantity) {
            return redirect()->back();
        }

        $cart = $session->get($cartKey) ?? [];

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;

            if ($cart[$id]['quantity'] > $product->quantity) {
                $cart[$id]['quantity'] = $product->quantity;
            }
        } else {
            $cart[$id] = [
                'id'       => $id,
                'title'    => $title,
                'price'    => $price,
                'image'    => $product->image,
                'quantity' => $quantity
            ];
        }

        // Save to correct cart
        $session->set($cartKey, $cart);
        $session->set('cart', $cart);

        return redirect()->back();
    }

    public function updateQuantity($id)
    {
        $session = session();
        $stocks = new StocksModel();

        $cartKey = $this->getCartKey();

        $cart = $session->get($cartKey) ?? [];

        if (!isset($cart[$id])) {
            return redirect()->to('/cart');
        }

        $newQty = (int)$this->request->getPost('quantity');
        $product = $stocks->find($id);

        if ($newQty < 1 || $newQty > $product->quantity) {
            return redirect()->back();
        }

        $cart[$id]['quantity'] = $newQty;

        $session->set($cartKey, $cart);
        $session->set('cart', $cart);

        return redirect()->to('/cart');
    }

    public function remove($id)
    {
        $session = session();
        $cartKey = $this->getCartKey();

        $cart = $session->get($cartKey) ?? [];

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        $session->set($cartKey, $cart);
        $session->set('cart', $cart);

        return redirect()->to('/cart');
    }
}
