<?php
$session = session();

if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

// Use the passed in name (preferred) or fall back to profile data.
$userFirstName = $userFirstName ?? ($session->get('user')['profile']['display_name'] ?? $session->get('user')['first_name'] ?? 'Reader');
$cartItems = $session->get('cart') ?? [];

$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Cart | EcoCoir Creations</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <?= view('components/landingStyle') ?>

    <style>
        body {
            font-family: 'Roboto Slab', serif;
            background: linear-gradient(135deg, #f5f1e8 0%, #e8dcc0 100%);
        }

        .overlay {
            background: rgba(255, 255, 255, 0.75);
        }

        .header-title {
            font-family: 'Righteous', sans-serif;
        }

        .table-card {
            border: 2px solid #D5C7AD;
            border-radius: 20px;
        }

        .primary-btn {
            background-color: #8A8E75;
            color: #FFFFFF;
        }

        .primary-btn:hover,
        .btn-yellow:hover {
            background-color: #6f7358;
            color: #FFFFFF;
        }

        .btn-yellow {
            background-color: #8A8E75;
            color: #FFFFFF;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen overlay">

        <!-- HEADER -->
        <?= view('components/header.php') ?>

        <!-- Landing-style Hero (copied design) -->
        <section class="bg-[#F9F5EB] py-14">
            <div class="mx-auto px-6 max-w-7xl">
                <div class="grid md:grid-cols-2 gap-6 items-center">
                    <div>
                        <p class="mb-4 font-semibold text-[#8A8E75] text-sm uppercase tracking-wider">Your Cart</p>
                        <h1 class="mb-4 text-4xl md:text-5xl font-bold text-[#3A3B2A] header-title">Finalize your eco-friendly order</h1>
                        <p class="mb-6 text-[#5B5346] text-lg">Review cart contents, edit quantities, and proceed to checkout with confidence.</p>
                        <a href="/checkout" class="inline-block bg-[#8A8E75] hover:bg-[#6f7358] px-8 py-3 rounded-lg font-semibold text-white">Proceed to Checkout</a>
                    </div>
                    <div>
                        <img src="/assets/coco_background.png" alt="Cart hero" class="w-full rounded-3xl shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <main class="flex-grow p-10">

            <!-- Greeting -->
            <section class="py-10 text-center">
                <h2 class="drop-shadow-lg font-bold text-white text-3xl md:text-4xl header-title">
                    Hello, <?= esc($userFirstName) ?>!
                </h2>
                <p class="mt-2 text-white/90 text-lg md:text-xl">
                    Your cart items are listed below.
                </p>
            </section>

            <!-- CART BOX -->
            <div class="table-card bg-white shadow-xl mx-auto mt-6 p-8 max-w-6xl">

                <table class="min-w-full">
                    <thead class="bg-[#68604D] rounded-lg text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Image</th>
                            <th class="px-4 py-3 text-left">Product</th>
                            <th class="px-4 py-3 text-left">Price</th>
                            <th class="px-4 py-3 text-left">Quantity</th>
                            <th class="px-4 py-3 text-left">Subtotal</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($cartItems)): ?>
                            <?php foreach ($cartItems as $item): ?>
                                <tr class="border-b">
                                    <td class="px-4 py-3">
                                        <img src="<?= esc($item['image']) ?>"
                                            class="border border-[#D5C7AD] rounded-lg w-20 h-20 object-cover">
                                    </td>

                                    <td class="px-4 py-3 font-semibold"><?= esc($item['title']) ?></td>

                                    <td class="px-4 py-3">₱<?= number_format($item['price'], 2) ?></td>

                                    <td class="px-4 py-3">
                                        <form action="/cart/updateQuantity/<?= $item['id'] ?>" method="post" class="flex gap-2">
                                            <input type="number" name="quantity" min="1"
                                                value="<?= $item['quantity'] ?>"
                                                class="p-1 border border-[#8A8E75] rounded w-16 text-center">

                                            <button class="px-3 rounded btn-primary" style="background-color: #8A8E75; color: #fff;">
                                                Update
                                            </button>
                                        </form>
                                    </td>

                                    <td class="px-4 py-3 font-semibold">
                                        ₱<?= number_format($item['price'] * $item['quantity'], 2) ?>
                                    </td>

                                    <td class="px-4 py-3">
                                        <a href="/cart/remove/<?= $item['id'] ?>"
                                            class="font-bold text-red-500 hover:text-red-700">
                                            Remove
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <!-- TOTAL -->
                            <tr>
                                <td colspan="4"></td>
                                <td class="px-4 py-4 font-bold text-xl">
                                    Total: ₱<?= number_format($totalPrice, 2) ?>
                                </td>
                                <td></td>
                            </tr>

                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-gray-600 text-center">
                                    Your cart is empty.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Checkout Button -->
                <div class="flex justify-end mt-6">
                    <a href="/checkout"
                        class="shadow px-6 py-3 rounded-full font-semibold btn-yellow">
                        Proceed to Checkout
                    </a>
                </div>

            </div>
        </main>

        <!-- FOOTER -->
        <footer class="mt-auto">
            <?= view('components/footer') ?>
        </footer>

    </div>
</body>

</html>