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
    <title>Seller Reports</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <?= view('components/header', ['showCart' => true]) ?>

    <main class="mx-auto p-8 max-w-6xl">
        <h1 class="mb-4 font-bold text-3xl">Reports</h1>

        <section class="bg-white shadow mb-6 p-4 rounded-lg">
            <h2 class="mb-2 font-bold text-2xl">Monthly Sales</h2>
            <table class="border min-w-full text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2">Month</th>
                        <th class="p-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($monthly as $row): ?>
                        <tr class="border-t">
                            <td class="p-2"><?= esc($row->month) ?></td>
                            <td class="p-2">₱<?= number_format($row->total, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="bg-white shadow p-4 rounded-lg">
            <h2 class="mb-2 font-bold text-2xl">Inventory Summary</h2>
            <table class="border min-w-full text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2">Name</th>
                        <th class="p-2">Qty</th>
                        <th class="p-2">Sold</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventory as $product): ?>
                        <tr class="border-t">
                            <td class="p-2"><?= esc($product->name) ?></td>
                            <td class="p-2"><?= esc($product->quantity) ?></td>
                            <td class="p-2"><?= esc($product->sales_count ?? 0) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <?= view('components/footer') ?>
</body>

</html>