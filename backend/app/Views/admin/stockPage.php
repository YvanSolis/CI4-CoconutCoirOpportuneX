<?php
$session = session();
$uri = service('uri');
$currentPath = $uri->getPath();
// IMPORTANT: $stocks comes from Admin::stockPage() controller
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management | EcoCoir Creations</title>
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
            transition: 0.2s ease;
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

</style>
</head>

<body class="flex min-h-screen">

    <main class="flex-1 bg-white/90 backdrop-blur-sm">

        <!-- Header -->
        <header class="flex justify-between items-center shadow-md px-6 py-4 dashboard-header">
            <h1 class="text-3xl tracking-wide header-title">Stock Management</h1>
            <div class="flex items-center space-x-4">
                <span class="font-semibold"></span>
                Welcome, <?= esc($session->get('user')['profile']['display_name'] ?? $session->get('user')['first_name'] ?? 'Admin') ?>
                </span>
            </div>
        </header>

        <!-- Stock Card -->
        <div class="bg-white shadow-xl mx-auto mt-6 p-8 border border-[#E5E0DC] rounded-2xl max-w-7xl card-hover">

            <div class="flex justify-between items-center mb-6">
                <h2 class="font-bold text-[#3A3B2A] text-4xl header-title">📦 Stock List</h2>

                <button onclick="openAddBook()"
                    class="hover:bg-[#6f7358] px-6 py-3 rounded-full font-semibold text-lg transition primary-btn">
                    ➕ Add New Book
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="border border-[#E5E0DC] rounded-xl w-full">
                    <thead class="bg-[#8A8E75] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left uppercase">ID</th>
                            <th class="px-6 py-3 text-left uppercase">Image</th>
                            <th class="px-6 py-3 text-left uppercase">Title</th>
                            <th class="px-6 py-3 text-left uppercase">Description</th>
                            <th class="px-6 py-3 text-center uppercase">Quantity</th>
                            <th class="px-6 py-3 text-center uppercase">Featured</th>
                            <th class="px-6 py-3 text-center uppercase">Price</th>
                            <th class="px-6 py-3 text-center uppercase">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#E5E0DC]">

                        <?php if (!empty($stocks)): ?>
                            <?php foreach ($stocks as $book): ?>
                                <tr class="hover:bg-[#FFF8E7] transition">

                                    <td class="px-6 py-4 text-gray-800"><?= esc($book->id) ?></td>

                                    <td class="px-6 py-4">
                                        <?php if (!empty($book->image)): ?>
                                            <img src="<?= esc($book->image) ?>" class="shadow rounded w-14 h-20 object-cover">
                                        <?php else: ?>
                                            <span class="text-gray-500 italic">No image</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-gray-900"><?= esc($book->name) ?></td>

                                    <td class="px-6 py-4 text-gray-700">
                                        <?= esc(substr($book->description, 0, 60)) ?>...
                                    </td>

                                    <td class="px-6 py-4 font-bold text-gray-800 text-center"><?= esc($book->quantity) ?></td>

                                    <td class="px-6 py-4 text-center">
                                        <?= $book->is_featured ? '<span class="text-green-600 font-semibold">Yes</span>' : '<span class="text-gray-500">No</span>' ?>
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-[#3A3B2A] text-center">
                                        ₱<?= number_format($book->price, 2) ?>
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">

                                        <!-- EDIT -->
                                        <a href="#"
                                            onclick="openEditBook(
                                                '<?= $book->id ?>',
                                                `<?= addslashes($book->name) ?>`,
                                                `<?= addslashes($book->image) ?>`,
                                                `<?= addslashes($book->description) ?>`,
                                                '<?= $book->price ?>',
                                                '<?= $book->quantity ?>',
                                                <?= $book->is_featured ? 'true' : 'false' ?>
                                            )"
                                            class="mx-2 font-semibold text-[#8A8E75] hover:text-[#6f7358]">
                                            ✏️ Edit
                                        </a>

                                        <!-- TOGGLE FEATURE -->
                                        <form action="/admin/stock/toggleFeatured/<?= $book->id ?>" method="post" class="inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="mx-2 font-semibold text-[#1F7A1F] hover:text-[#156217]">
                                                <?= $book->is_featured ? '★ Unfeature' : '☆ Feature' ?>
                                            </button>
                                        </form>

                                        <!-- DELETE -->
                                        <a href="#"
                                            onclick="openDeleteBook('<?= $book->id ?>', `<?= addslashes($book->name) ?>`)"
                                            class="mx-2 font-semibold text-red-500 hover:text-red-600">
                                            🗑️ Delete
                                        </a>

                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="py-6 text-gray-600 text-center">
                                    No stock items found.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>

    </main>

    <!-- Sidebar -->
    <aside class="flex flex-col w-64 sidebar">
        <div class="p-6 border-[#D5C7AD] border-b text-center">
            <img src="/assets/opportunex_logo.png" alt="EcoCoir Creations Logo" class="mx-auto mb-3 w-16 h-16">
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
                <button type="submit" class="bg-[#F1EAD8] hover:bg-[#D5C7AD] py-2 rounded-lg w-full font-semibold text-[#68604D] text-center transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ADD BOOK MODAL -->
    <dialog id="addBookModal" class="backdrop:bg-black/60 p-0 rounded-2xl w-[95%] max-w-lg">
        <form method="post" action="/admin/stocks/create"
            class="space-y-4 bg-white shadow-xl p-6 border border-[#D5C7AD] rounded-2xl">

            <?= csrf_field() ?>

            <h3 class="mb-4 font-bold text-[#8A8E75] text-3xl header-title">Add New Product</h3>

            <div class="gap-3 grid grid-cols-1">
                <input type="text" name="name" placeholder="Product Name" class="px-3 py-2 border border-[#D5C7AD] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2" required>
                <input type="text" name="image" placeholder="Image URL" class="px-3 py-2 border border-[#D5C7AD] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2">
                <textarea name="description" placeholder="Product Description" rows="4" class="px-3 py-2 border border-[#D5C7AD] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2" required></textarea>
                <input type="number" step="0.01" name="price" placeholder="Price" class="px-3 py-2 border border-[#D5C7AD] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2" required>
                <input type="number" name="quantity" placeholder="Stock Quantity" class="px-3 py-2 border border-[#D5C7AD] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2" required>
                <label class="inline-flex items-center mt-2">
                    <input type="checkbox" name="is_featured" value="1" class="form-checkbox h-5 w-5 text-[#8A8E75]">
                    <span class="ml-2 text-[#514d4d]">Mark as Featured</span>
                </label>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeAddBook()" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg text-gray-700">Cancel</button>
                    <button type="submit" class="primary-btn">Add Product</button>
                </div>
            </div>
        </form>
    </dialog>

    <!-- EDIT BOOK MODAL -->
    <dialog id="editBookModal" class="backdrop:bg-black/60 p-0 rounded-2xl w-[95%] max-w-lg">
        <form method="post" id="editBookForm"
            class="space-y-4 bg-white shadow-xl p-6 border border-[#D5C7AD] rounded-2xl">

            <?= csrf_field() ?>

            <h3 class="mb-4 font-bold text-[#8A8E75] text-3xl header-title">✏️ Edit Product</h3>

            <input type="hidden" name="id" id="edit_id">

            <div class="gap-3 grid grid-cols-1">
                <input type="text" id="edit_name" name="name" placeholder="Product Name" class="px-3 py-2 border border-[#D5C7AD] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2" required>
                <input type="text" id="edit_image" name="image" placeholder="Image URL" class="px-3 py-2 border border-[#D5C7AD] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2">
                <textarea id="edit_description" name="description" placeholder="Product Description" rows="4" class="px-3 py-2 border border-[#D5C7AD] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2" required></textarea>
                <input type="number" step="0.01" id="edit_price" name="price" placeholder="Price" class="px-3 py-2 border border-[#D5C7AD] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2" required>
                <input type="number" id="edit_quantity" name="quantity" placeholder="Stock Quantity" class="px-3 py-2 border border-[#D5C7AD] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2" required>
                <label class="inline-flex items-center mt-2">
                    <input type="checkbox" id="edit_is_featured" name="is_featured" value="1" class="form-checkbox h-5 w-5 text-[#8A8E75]">
                    <span class="ml-2 text-[#514d4d]">Mark as Featured</span>
                </label>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeEditBook()" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg text-gray-700">Cancel</button>
                <button type="submit" class="primary-btn">Save Changes</button>
            </div>
        </form>
    </dialog>

    <!-- DELETE BOOK MODAL -->
    <dialog id="deleteBookModal" class="backdrop:bg-black/60 p-0 rounded-2xl w-[90%] max-w-md">

        <form method="post" id="deleteBookForm"
            class="bg-white shadow-xl p-6 border border-[#D5C7AD] rounded-2xl">

            <?= csrf_field() ?>

            <h3 class="mb-4 font-bold text-[#8A8E75] text-2xl header-title">⚠️ Delete Product</h3>

            <p class="mb-6 text-gray-700">
                Are you sure you want to delete
                <strong id="delete_book_name"></strong>?
                This action cannot be undone.
            </p>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeDeleteBook()" class="bg-gray-300 px-4 py-2 rounded-lg text-gray-700">
                    Cancel
                </button>

                <button type="submit" class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg text-white">
                    Delete
                </button>
            </div>

        </form>

    </dialog>


    <!-- JS for Modals -->
    <script>
        function openAddBook() {
            document.getElementById('addBookModal').showModal();
        }

        function closeAddBook() {
            document.getElementById('addBookModal').close();
        }

        function openEditBook(id, name, image, description, price, quantity, isFeatured) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_image').value = image;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_quantity').value = quantity;
            document.getElementById('edit_is_featured').checked = Boolean(isFeatured);

            document.getElementById('editBookForm').action = `/admin/stocks/update/${id}`;

            document.getElementById('editBookModal').showModal();
        }

        function closeEditBook() {
            document.getElementById('editBookModal').close();
        }

        function openDeleteBook(id, name) {
            document.getElementById('delete_book_name').textContent = name;

            // Set form action with ID
            document.getElementById('deleteBookForm').action = `/admin/stocks/delete/${id}`;

            document.getElementById('deleteBookModal').showModal();
        }

        function closeDeleteBook() {
            document.getElementById('deleteBookModal').close();
        }
    </script>

</body>

</html>