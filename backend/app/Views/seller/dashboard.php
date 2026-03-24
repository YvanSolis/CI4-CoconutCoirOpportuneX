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
    <title>Seller Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <?= view('components/header', ['showCart' => true]) ?>

    <main class="mx-auto p-8 max-w-6xl">
        <h1 class="mb-4 font-bold text-3xl">Hello, <?= esc($sellerName) ?></h1>

        <div class="gap-4 grid grid-cols-1 md:grid-cols-3 mb-6">
            <div class="bg-white shadow p-4 rounded-lg">
                <h3 class="font-semibold text-xl">Total products</h3>
                <p class="font-bold text-3xl"><?= count($sellerProducts) ?></p>
            </div>
            <div class="bg-white shadow p-4 rounded-lg">
                <h3 class="font-semibold text-xl">Sales today</h3>
                <p class="font-bold text-3xl">₱<?= number_format($todaySales, 2) ?></p>
            </div>
            <div class="bg-white shadow p-4 rounded-lg">
                <h3 class="font-semibold text-xl">All-time sales</h3>
                <p class="font-bold text-3xl">₱<?= number_format($totalSales, 2) ?></p>
            </div>
        </div>

        <div class="bg-white shadow p-4 rounded-lg">
            <h2 class="mb-4 font-bold text-2xl">Recent products</h2>
            <ul class="space-y-3">
                <?php foreach ($sellerProducts as $product): ?>
                    <li class="p-3 border rounded">
                        <div class="flex justify-between">
                            <span class="font-semibold"><?= esc($product->name) ?></span>
                            <span class="text-gray-600">Qty <?= esc($product->quantity) ?></span>
                        </div>
                        <div class="text-gray-600">₱<?= number_format($product->price, 2) ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>