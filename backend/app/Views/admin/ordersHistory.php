<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History | EcoCoir Creations</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto Slab', serif;
            background: linear-gradient(135deg, #f5f1e8 0%, #e8dcc0 100%);
            color: #514d4d;
        }

        .header-title {
            font-family: "Righteous", sans-serif;
            font-weight: 400;
        }

        .dashboard-header {
            background-color: #8A8E75;
            color: #fff;
        }

        .sidebar {
            background-color: #8A8E75;
            color: #fff;
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: #6f7358;
            color: #fff;
        }

        .card-hover {
            transition: all 0.25s ease;
            border-radius: 1.25rem;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(104, 96, 77, 0.25);
        }
    </style>
</head>

<body class="flex min-h-screen">

    <main class="flex-1 bg-white/90 backdrop-blur-sm">
        <header class="flex justify-between items-center shadow-md px-6 py-4 dashboard-header">
            <h1 class="text-3xl tracking-wide header-title">Order History</h1>
            <div class="font-semibold">Welcome, <?= esc($adminFirstName ?? 'Admin') ?></div>
        </header>

        <section class="mx-auto mt-6 p-8 border border-[#D5C7AD] bg-white shadow-xl rounded-2xl max-w-7xl card-hover">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-bold text-[#8A8E75] text-4xl header-title">Customer Purchase Records</h2>
                <div class="text-right">
                    <p class="text-gray-700 font-semibold">Total Orders</p>
                    <p class="text-3xl font-bold text-[#3A3B2A]"><?= count($orders ?? []) ?></p>
                </div>
            </div>

            <?php if (empty($orders)): ?>
                <div class="bg-[#F5F0E6] p-6 rounded-xl text-center text-gray-700">
                    No purchase records found yet.
                </div>
            <?php else: ?>
                <div class="space-y-5">
                    <?php foreach ($orders as $index => $order): ?>
                        <article class="border border-[#E5E0DC] bg-white rounded-xl overflow-hidden">
                            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 p-5 bg-[#F8F4EB]">
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500">Order</p>
                                    <p class="font-bold text-[#3A3B2A]">#<?= esc((string) ($index + 1)) ?></p>
                                    <p class="text-xs text-gray-500">Order ID: <?= esc($order->id) ?></p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500">Customer</p>
                                    <p class="font-semibold text-gray-800"><?= esc($order->customer_name ?: 'Unknown Customer') ?></p>
                                    <p class="text-sm text-gray-600"><?= esc($order->email ?? '-') ?></p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500">Date</p>
                                    <p class="font-semibold text-gray-800"><?= esc(date('M d, Y h:i A', strtotime($order->created_at))) ?></p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500">Payment / Delivery</p>
                                    <p class="font-semibold text-gray-800"><?= esc(ucfirst($order->payment_method)) ?> / <?= esc(ucfirst($order->delivery_method)) ?></p>
                                    <p class="text-sm text-gray-600">Status: <?= esc(ucfirst($order->status)) ?></p>
                                </div>
                                <div class="md:text-right">
                                    <p class="text-xs uppercase tracking-wide text-gray-500">Total</p>
                                    <p class="font-bold text-2xl text-[#8A8E75]">PHP <?= number_format($order->total_amount, 2) ?></p>
                                </div>
                            </div>

                            <div class="p-5">
                                <h3 class="font-semibold text-lg text-[#3A3B2A] mb-3">Purchased Items</h3>

                                <?php if (empty($order->items)): ?>
                                    <p class="text-gray-600">No item-level data found for this order.</p>
                                <?php else: ?>
                                    <div class="overflow-x-auto">
                                        <table class="w-full border border-[#E5E0DC] rounded-lg overflow-hidden">
                                            <thead class="bg-[#8A8E75] text-white">
                                                <tr>
                                                    <th class="px-4 py-2 text-left">Product</th>
                                                    <th class="px-4 py-2 text-center">Qty</th>
                                                    <th class="px-4 py-2 text-right">Unit Price</th>
                                                    <th class="px-4 py-2 text-right">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-[#E5E0DC]">
                                                <?php foreach ($order->items as $item): ?>
                                                    <tr class="hover:bg-[#FFF8E7] transition">
                                                        <td class="px-4 py-3 text-gray-800"><?= esc($item->product_name ?? 'Unknown Product') ?></td>
                                                        <td class="px-4 py-3 text-center font-semibold text-gray-700"><?= esc($item->quantity) ?></td>
                                                        <td class="px-4 py-3 text-right text-gray-700">PHP <?= number_format((float) $item->unit_price, 2) ?></td>
                                                        <td class="px-4 py-3 text-right font-semibold text-[#3A3B2A]">PHP <?= number_format((float) $item->subtotal, 2) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <aside class="flex flex-col w-64 sidebar">
        <div class="p-6 border-[#D5C7AD] border-b text-center">
            <img src="/assets/opportunex_logo.png" class="mx-auto mb-3 w-16 h-16" alt="logo">
            <h2 class="text-white text-2xl header-title">Admin Panel</h2>
        </div>

        <nav class="flex-1 space-y-2 p-4">
            <a href="/admin/inventoryReports" class="block px-4 py-3 rounded-lg sidebar-link">Dashboard</a>
            <a href="/admin/stockPage" class="block px-4 py-3 rounded-lg sidebar-link">Stocks Page</a>
            <a href="/admin/ordersHistory" class="block bg-[#F1EAD8]/30 px-4 py-3 rounded-lg sidebar-link">Order History</a>
            <a href="/admin/accountsPage" class="block px-4 py-3 rounded-lg sidebar-link">Accounts Page</a>
        </nav>

        <div class="p-4 border-[#D5C7AD]/30 border-t">
            <form action="/logout" method="post">
                <?= csrf_field() ?>
                <button type="submit" class="bg-[#F1EAD8] hover:bg-[#D5C7AD] py-2 rounded-lg w-full font-semibold text-[#68604D] text-center transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>
</body>

</html>