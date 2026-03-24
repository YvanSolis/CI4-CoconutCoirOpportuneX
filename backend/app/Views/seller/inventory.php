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
    <title>Seller Inventory</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <?= view('components/header', ['showCart' => true]) ?>

    <main class="mx-auto p-8 max-w-6xl">
        <h1 class="mb-4 font-bold text-3xl">Your Inventory</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-200 mb-4 p-3 rounded text-green-800"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>

        <form action="/seller/inventory/create" method="post" class="bg-white shadow mb-6 p-4 rounded-lg">
            <?= csrf_field() ?>
            <h2 class="mb-2 font-semibold text-xl">Add New Product</h2>
            <div class="gap-3 grid grid-cols-1 md:grid-cols-2">
                <input name="name" placeholder="Product name" required class="p-2 border rounded" value="<?= esc(old('name')) ?>">
                <input name="price" placeholder="Price" required class="p-2 border rounded" value="<?= esc(old('price')) ?>">
                <input name="quantity" placeholder="Quantity" required class="p-2 border rounded" value="<?= esc(old('quantity')) ?>">
                <input name="category" placeholder="Category" class="p-2 border rounded" value="<?= esc(old('category')) ?>">
            </div>
            <textarea name="description" placeholder="Description" class="mt-3 p-2 border rounded w-full"><?= esc(old('description')) ?></textarea>
            <label class="inline-flex items-center mt-3">
                <input type="checkbox" name="is_featured" value="1" class="mr-2"> Mark as featured
            </label>
            <button class="bg-[#D5C7AD] hover:bg-[#68604D] mt-3 px-4 py-2 rounded text-white">Add Product</button>
        </form>

        <div class="bg-white shadow p-4 rounded-lg">
            <h2 class="mb-3 font-semibold text-xl">Products</h2>
            <table class="border min-w-full text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2">Name</th>
                        <th class="p-2">Qty</th>
                        <th class="p-2">Price</th>
                        <th class="p-2">Sales</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr class="border-t">
                            <td class="p-2"><?= esc($product->name) ?></td>
                            <td class="p-2"><?= esc($product->quantity) ?></td>
                            <td class="p-2">₱<?= number_format($product->price, 2) ?></td>
                            <td class="p-2"><?= esc($product->sales_count ?? 0) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>