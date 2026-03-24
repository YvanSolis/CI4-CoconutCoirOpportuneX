<?php
$session = session();
if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <?= view('components/header', ['showCart' => true]) ?>

    <main class="mx-auto p-8 max-w-6xl">
        <!-- 🎉 SUCCESS MESSAGE -->
        <?php if (session()->has('success')): ?>
            <div class="bg-green-100 border-green-300 border mb-6 p-4 rounded-lg text-green-800">
                <strong>✓ Success!</strong> <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <h1 class="mb-6 font-bold text-3xl text-[#68604D]">Your Transaction History</h1>

        <?php if (empty($orders)): ?>
            <p class="bg-white shadow p-6 rounded-lg text-gray-600">No transactions yet. <a href="/shop" class="text-[#8A8E75] font-semibold hover:underline">Start shopping</a></p>
        <?php else: ?>
            <!-- 📦 LATEST ORDER CONFIRMATION (if coming from checkout) -->
            <?php
            $latestOrder = reset($orders);
            if ($latestOrder && session()->has('success')):
            ?>
                <section class="bg-gradient-to-r from-green-50 to-[#F1EAD8] border-2 border-green-300 shadow-lg mb-8 p-6 rounded-2xl">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-4xl">🎉</span>
                        <h2 class="font-bold text-2xl text-green-700">Order Confirmation</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Order Details -->
                        <div class="bg-white p-4 rounded-lg">
                            <p class="mb-2 text-gray-700"><span class="font-semibold">Order #:</span> <?= esc($latestOrder->id) ?></p>
                            <p class="mb-2 text-gray-700"><span class="font-semibold">Status:</span> <span class="bg-green-100 px-3 py-1 rounded-full text-green-700"><?= esc($latestOrder->status) ?></span></p>
                            <p class="mb-2 text-gray-700"><span class="font-semibold">Date:</span> <?= date('M d, Y h:i A', strtotime($latestOrder->created_at)) ?></p>
                            <p class="text-gray-700"><span class="font-semibold">Total:</span> <span class="text-2xl font-bold text-[#8A8E75]">₱<?= number_format($latestOrder->total_amount, 2) ?></span></p>
                        </div>

                        <!-- Delivery Info -->
                        <div class="bg-white p-4 rounded-lg">
                            <p class="mb-2 text-gray-700"><span class="font-semibold">Payment Method:</span> <span class="capitalize"><?= esc($latestOrder->payment_method) ?></span></p>
                            <p class="text-gray-700"><span class="font-semibold">Delivery Method:</span> <span class="capitalize"><?= esc($latestOrder->delivery_method) ?></span></p>
                            <p class="mt-4 text-sm text-gray-600">✓ Database updated | ✓ Inventory decremented | ✓ Sales tracked</p>
                        </div>
                    </div>

                    <!-- Items Ordered -->
                    <div class="mt-6 bg-white p-4 rounded-lg">
                        <h3 class="mb-4 font-semibold text-lg text-gray-800">Items Ordered:</h3>
                        <div class="space-y-2">
                            <?php foreach ($latestOrder->items as $item): ?>
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded border border-gray-200">
                                    <div>
                                        <p class="font-medium text-gray-800"><?= esc($item->product_name) ?></p>
                                        <p class="text-sm text-gray-600">Qty: <?= esc($item->quantity) ?></p>
                                    </div>
                                    <p class="font-semibold text-[#8A8E75]">₱<?= number_format($item->subtotal, 2) ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="/shop" class="inline-block bg-[#8A8E75] hover:bg-[#6d6b5b] text-white px-6 py-2 rounded-lg font-semibold transition">Continue Shopping</a>
                    </div>
                </section>
            <?php endif; ?>

            <!-- 📜 ORDER HISTORY -->
            <section class="mt-8">
                <h2 class="mb-4 font-bold text-xl text-[#68604D]">Previous Orders</h2>
                <div class="space-y-4">
                    <?php
                    $isFirst = true;
                    foreach ($orders as $order):
                        if ($isFirst) {
                            $isFirst = false;
                            continue; // Skip first (latest) as it's shown above
                        }
                    ?>
                        <div class="bg-white shadow p-6 rounded-lg border-l-4 border-[#D5C7AD]">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="font-semibold text-lg text-gray-800">Order #<?= esc($order->id) ?></h3>
                                <span class="text-gray-500 text-sm"><?= date('M d, Y', strtotime($order->created_at)) ?></span>
                            </div>
                            <div class="mb-3 text-gray-700">
                                <p><span class="font-medium">Total:</span> ₱<?= number_format($order->total_amount, 2) ?></p>
                                <p class="text-sm text-gray-600"><span class="font-medium">Status:</span> <?= esc($order->status) ?> · <?= esc($order->payment_method) ?> · <?= esc($order->delivery_method) ?></p>
                            </div>
                            <details class="text-sm">
                                <summary class="cursor-pointer font-medium text-[#8A8E75] hover:text-[#6d6b5b]">View items (<?= count($order->items) ?>)</summary>
                                <div class="mt-3 pt-3 border-t space-y-2">
                                    <?php foreach ($order->items as $item): ?>
                                        <div class="flex justify-between text-gray-700">
                                            <span><?= esc($item->product_name) ?> × <?= esc($item->quantity) ?></span>
                                            <span>₱<?= number_format($item->subtotal, 2) ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </details>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <?= view('components/footer') ?>
</body>

</html>