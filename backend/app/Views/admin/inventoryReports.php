<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | EcoCoir Creations</title>
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
        }

        .dashboard-header {
            background-color: #8A8E75;
            color: #fff;
        }

        .sidebar {
            background-color: #8A8E75;
            color: #fff;
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

        .primary-btn {
            background-color: #8A8E75;
            color: #FFFFFF;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            border: none;
            font-weight: 600;
        }

        .primary-btn:hover {
            background-color: #6f7358;
            color: #FFFFFF;
        }
    </style>
</head>

<body class="flex min-h-screen">
    <main class="flex-1 bg-white/90 backdrop-blur-sm">
        <header class="flex justify-between items-center shadow-md px-6 py-4 dashboard-header">
            <h1 class="text-3xl tracking-wide header-title">Dashboard Overview</h1>
            <div class="font-semibold">Welcome, <?= esc($adminFirstName ?? 'Admin') ?></div>
        </header>

        <section class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <div class="bg-white border border-[#E5E0DC] shadow rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-[#8B7E74]">Inventory Items</h3>
                    <p class="text-4xl font-bold text-[#3A3B2A]"><?= esc($inventoryCount ?? 0) ?></p>
                </div>
                <div class="bg-white border border-[#E5E0DC] shadow rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-[#8B7E74]">Low Stock Items (&lt; 10)</h3>
                    <p class="text-4xl font-bold text-[#3A3B2A]"><?= esc($lowStockCount ?? 0) ?></p>
                </div>
                <div class="bg-white border border-[#E5E0DC] shadow rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-[#8B7E74]">Total Stock Value</h3>
                    <p class="text-4xl font-bold text-[#3A3B2A]">₱<?= number_format($totalStockValue ?? 0, 2) ?></p>
                </div>
            </div>

            <div class="mt-8 bg-white border border-[#E5E0DC] shadow rounded-xl p-6">
                <h3 class="text-2xl font-bold text-[#3A3B2A] mb-4">Top Selling Products (by quantity)</h3>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-[#F5F0E6]">
                            <th class="py-2 px-3 text-left">Product Name</th>
                            <th class="py-2 px-3 text-left">Sold Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($topSelling)): ?>
                            <?php foreach ($topSelling as $item): ?>
                                <tr class="border-t">
                                    <td class="py-2 px-3"><?= esc($item->stock_name) ?></td>
                                    <td class="py-2 px-3"><?= esc($item->sold_quantity) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="py-2 px-3 text-center text-gray-600">No order data yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <aside class="flex flex-col w-64 sidebar">
        <div class="p-6 border-[#D5C7AD] border-b text-center">
            <img src="/assets/opportunex_logo.png" class="mx-auto mb-3 w-16 h-16" alt="logo">
            <h2 class="text-white text-2xl header-title">Admin Panel</h2>
        </div>
        <nav class="flex-1 space-y-2 p-4">
            <a href="/admin/inventoryReports" class="block bg-[#F1EAD8]/30 hover:bg-[#6f7358] px-4 py-3 rounded-lg hover:text-white sidebar-link">📊 Dashboard</a>
            <a href="/admin/stockPage" class="block hover:bg-[#6f7358] px-4 py-3 rounded-lg hover:text-white sidebar-link">📚 Stocks Page</a>
            <a href="/admin/accountsPage" class="block hover:bg-[#6f7358] px-4 py-3 rounded-lg hover:text-white sidebar-link">👤 Accounts Page</a>
        </nav>
        <div class="p-4 border-[#D5C7AD]/30 border-t">
            <form action="/logout" method="post">
                <?= csrf_field() ?>
                <button type="submit" class="bg-[#F1EAD8] hover:bg-[#D5C7AD] py-2 rounded-lg w-full font-semibold text-[#68604D]">Logout</button>
            </form>
        </div>
    </aside>
</body>

</html>