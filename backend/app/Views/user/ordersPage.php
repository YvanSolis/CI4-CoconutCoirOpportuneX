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
        <h1 class="mb-4 font-bold text-3xl">Your Transaction History</h1>

        <?php if (empty($orders)): ?>
            <p class="bg-white shadow p-4 rounded">No transactions yet.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="bg-white shadow mb-4 p-4 rounded">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold">Order #<?= esc($order->id) ?></span>
                        <span class="text-gray-500 text-sm"><?= esc($order->status) ?> · <?= esc($order->created_at) ?></span>
                    </div>
                    <div class="mb-2 text-gray-700">Total: ₱<?= number_format($order->total_amount, 2) ?> | <?= esc($order->payment_method) ?> | <?= esc($order->delivery_method) ?></div>
                    <div class="pt-2 border-t">
                        <table class="border min-w-full text-left">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-2">Product</th>
                                    <th class="p-2">Qty</th>
                                    <th class="p-2">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order->items as $item): ?>
                                    <tr>
                                        <td class="p-2"><?= esc($item->stock_id) ?></td>
                                        <td class="p-2"><?= esc($item->quantity) ?></td>
                                        <td class="p-2">₱<?= number_format($item->subtotal, 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <?= view('components/footer') ?>
</body>

</html>