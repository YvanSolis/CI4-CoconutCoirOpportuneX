<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Users::index');
$routes->get('/moodboardPage', 'Users::moodboard');
$routes->get('/roadmapPage', 'Users::roadmap');

$routes->get('/loginPage', 'Auth::showLogin');
$routes->get('/signupPage', 'Auth::showSignup');

$routes->post('/loginPage', 'Auth::login');
$routes->post('/signupPage', 'Auth::signup');
$routes->post('/logout', 'Auth::logout');

// Shop Page
$routes->get('/shop', 'Stock::shop');
$routes->get('/featured', 'Users::featured');
$routes->get('/checkout', 'Users::checkout');

// ORDERS
$routes->get('/orders', 'Users::orders');

// SELLER
$routes->get('/seller/dashboard', 'Seller::dashboard');
$routes->get('/seller/inventory', 'Seller::inventory');
$routes->post('/seller/inventory/create', 'Seller::createProduct');
$routes->get('/seller/reports', 'Seller::reports');

// CART
$routes->get('/cart', 'Users::cart');
$routes->post('/cart/add', 'Cart::add');
$routes->post('/cart/updateQuantity/(:num)', 'Cart::updateQuantity/$1');
$routes->get('/cart/remove/(:num)', 'Cart::remove/$1');

// PROFILE
$routes->get('/profile', 'Users::profile');
$routes->post('/profile', 'Users::updateProfile');

// CHECKOUT
$routes->post('/checkout/placeOrder', 'Users::placeOrder');

// -----------------------
// ADMIN ROUTES
// -----------------------

$routes->get('/admin/stockPage', 'Admin::stockPage');
$routes->post('/admin/stock/toggleFeatured/(:num)', 'Admin::toggleFeatured/$1');
$routes->get('/admin/inventoryReports', 'Admin::inventoryReports');
$routes->get('/admin/accountsPage', 'Admin::accountsPage');

// ⭐Accounts Management
$routes->post('/admin/accounts/create', 'UserCRUDtest\UserCreate::createAccount');
$routes->post('/admin/accounts/update/(:num)', 'Admin::updateAccount/$1');
$routes->post('/admin/accounts/delete/(:num)', 'UserCRUDtest\UserDelete::delete/$1');

// Stocks Management
$routes->post('/admin/stocks/create', 'StockCRUDtest\StockCreate::create');
$routes->post('/admin/stocks/update/(:num)', 'StockCRUDtest\StockUpdate::update/$1');
$routes->post('/admin/stocks/delete/(:num)', 'StockCRUDtest\StockDelete::delete/$1');
