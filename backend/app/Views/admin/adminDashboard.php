<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Fennekin Folios</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto Slab', serif;
            background-color: #f9f8f6;
        }

        .header-title {
            font-family: "Righteous", sans-serif;
        }

        .dashboard-header {
            background-color: #E15A37;
            color: #fff;
        }

        .sidebar {
            background-color: #E15A37;
            color: #fff;
        }

        .sidebar-link:hover {
            background-color: #ED865A;
            color: #fff;
        }
    </style>
</head>

<body class="flex min-h-screen">

    <main class="flex-1 bg-white/90 backdrop-blur-sm">

        <!-- Header -->
        <header class="flex justify-between items-center shadow-md px-6 py-4 dashboard-header">
            <h1 class="text-3xl tracking-wide header-title">Dashboard Overview</h1>

            <div class="flex items-center space-x-4">
                <span class="font-semibold">
                    Welcome, <?= esc($adminFirstName ?? 'Admin') ?>
                </span>
            </div>
        </header>

        <!-- Dashboard Cards (Now Connected to Database) -->
        <?= view('components/cards/dashboard_cards', [
            'totalBooks'      => $booksCount,
            'registeredUsers' => $clientsCount,
        ]) ?>

    </main>

    <!-- Sidebar -->
    <aside class="flex flex-col w-64 sidebar">
        <div class="p-6 border-[#FCE77C] border-b text-center">
            <img src="/assets/coircircle_logo.png" class="mx-auto mb-3 w-16 h-16">
            <h2 class="text-white text-2xl header-title">Admin Panel</h2>
        </div>

        <nav class="flex-1 space-y-2 p-4">
            <a href="/admin/adminDashboard" class="block bg-[#ED865A]/30 px-4 py-3 rounded-lg sidebar-link">📊 Dashboard</a>
            <a href="/admin/stockPage" class="block px-4 py-3 rounded-lg sidebar-link">📚 Stocks Page</a>
            <a href="/admin/accountsPage" class="block px-4 py-3 rounded-lg sidebar-link">👤 Accounts Page</a>
        </nav>

        <div class="p-4 border-[#FCE77C]/30 border-t">
            <form action="/logout" method="post">
                <?= csrf_field() ?>
                <button type="submit"
                    class="bg-[#FCE77C] hover:bg-[#ED865A] py-2 rounded-lg w-full font-semibold text-[#514D4D]">
                    Logout
                </button>
            </form>
        </div>
    </aside>

</body>

</html>