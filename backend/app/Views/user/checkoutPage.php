<?php
$session = session();

// Redirect if not logged in
if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

// Use the passed in name (preferred) or fall back to profile data.
$userFirstName = $userFirstName ?? ($session->get('user')['profile']['display_name'] ?? $session->get('user')['first_name'] ?? 'Reader');

// Get cart items
$cart = $session->get('cart') ?? [];
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | EcoCoir Creations</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Roboto Slab', serif;
            background: url('/assets/background.png') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            background: linear-gradient(rgba(138, 142, 117, 0.7), rgba(182, 197, 164, 0.45));
        }

        .header-title {
            font-family: "Righteous", sans-serif;
        }

        button:hover,
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(138, 142, 117, 0.35);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">

    <div class="flex flex-col min-h-screen overlay">

        <!-- Header -->
        <?= view('components/header.php', ['showCart' => true]) ?>

        <!-- Main Content -->
        <main class="flex-grow">

            <!-- Greeting -->
            <section class="py-16 text-center">
                <h2 class="drop-shadow-lg font-bold text-white text-3xl md:text-4xl header-title">
                    Checkout, <?= esc($userFirstName) ?>!
                </h2>
                <p class="mt-2 text-white/90 text-lg md:text-xl">
                    Review your order and place your purchase.
                </p>
            </section>

            <!-- Cart Summary -->
            <div class="bg-white shadow-xl mx-auto mt-6 p-8 border border-[#D5C7AD] rounded-2xl max-w-6xl">

                <h3 class="mb-8 font-bold text-[#68604D] text-4xl text-center header-title">
                    Your Cart Summary
                </h3>

                <?php if (!empty($cart)): ?>
                    <div class="overflow-x-auto">
                        <table class="bg-white border border-[#D5C7AD] rounded-xl min-w-full">
                            <thead class="bg-[#68604D] text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left">Product</th>
                                    <th class="px-6 py-3 text-center">Quantity</th>
                                    <th class="px-6 py-3 text-center">Price</th>
                                    <th class="px-6 py-3 text-center">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#D5C7AD]">
                                <?php foreach ($cart as $item): ?>
                                    <tr class="hover:bg-[#FFF8E7] transition">
                                        <td class="px-6 py-4 font-semibold"><?= esc($item['title']) ?></td>
                                        <td class="px-6 py-4 text-center"><?= esc($item['quantity']) ?></td>
                                        <td class="px-6 py-4 text-center">₱<?= number_format($item['price'], 2) ?></td>
                                        <td class="px-6 py-4 text-center">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Total -->
                    <div class="mt-8 font-bold text-[#68604D] text-3xl text-right">
                        Total: ₱<?= number_format($total, 2) ?>
                    </div>

                    <form action="/checkout/placeOrder" method="post">
                        <?= csrf_field() ?>

                        <!-- Checkout options -->
                        <div class="gap-6 grid grid-cols-1 md:grid-cols-2 mt-8">
                            <div>
                                <label class="font-semibold text-[#68604D]">Payment Method</label>
                                <select name="payment_method" required
                                    class="p-3 border rounded-lg w-full">
                                    <option value="cash">Cash on delivery</option>
                                    <option value="card">Credit/Debit Card</option>
                                    <option value="gcash">GCash</option>
                                    <option value="paymaya">PayMaya</option>
                                </select>
                            </div>
                            <div>
                                <label class="font-semibold text-[#68604D]">Delivery Method</label>
                                <select name="delivery_method" required
                                    class="p-3 border rounded-lg w-full">
                                    <option value="pickup">Pickup</option>
                                    <option value="delivery">Delivery</option>
                                </select>
                            </div>
                        </div>

                        <?php if (session()->getFlashdata('checkout_errors')): ?>
                            <div class="mt-4 text-red-600">
                                <?= implode('<br>', session()->getFlashdata('checkout_errors')) ?>
                            </div>
                        <?php endif; ?>

                        <!-- PLACE ORDER BUTTON -->
                        <div class="mt-10 text-right">
                            <button type="submit"
                                class="bg-[#D5C7AD] hover:bg-[#68604D] shadow-lg px-8 py-4 rounded-lg font-bold text-[#68604D] hover:text-white text-xl transition">
                                Place Order
                            </button>
                        </div>
                    </form>

                <?php else: ?>
                    <p class="mt-12 text-gray-600 text-xl text-center">Your cart is empty.</p>
                <?php endif; ?>

            </div>

        </main>


        <!-- Footer -->
        <footer class="mt-auto">
            <?= view('components/footer') ?>
        </footer>

    </div>
</body>

</html>