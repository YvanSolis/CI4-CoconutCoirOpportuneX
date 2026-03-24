<?php
// Required: $accounts is now coming from the controller
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Accounts | Achlys' Bookstore Admin</title>
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
            font-weight: 400;
        }

        .dashboard-header {
            background-color: #E15A37;
            color: #fff;
        }

        .sidebar {
            background-color: #E15A37;
            color: #fff;
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: #ED865A;
            color: #fff;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(225, 90, 55, 0.3);
        }

        .accent-yellow {
            background-color: #FCE77C;
        }
    </style>
</head>

<body class="flex min-h-screen">

    <main class="flex-1 bg-white/90 backdrop-blur-sm">

        <!-- HEADER -->
        <header class="flex justify-between items-center shadow-md px-6 py-4 dashboard-header">
            <h1 class="text-3xl tracking-wide header-title">Manage Accounts</h1>

            <div class="flex items-center space-x-4">
                <span class="font-semibold">Welcome, <?= esc($adminFirstName ?? 'Admin') ?></span>
            </div>
        </header>


        <!-- MAIN CONTENT -->
        <div class="bg-white shadow-xl mx-auto mt-6 p-8 border border-[#FCE77C] rounded-2xl max-w-7xl card-hover">

            <div class="flex justify-between items-center mb-8">
                <h2 class="font-bold text-[#E15A37] text-4xl header-title">👥 Accounts</h2>

                <a onclick="openAddModal()"
                    class="hover:bg-[#ED865A] px-6 py-3 rounded-full font-semibold text-lg transition accent-yellow cursor-pointer">
                    ➕ Add New User
                </a>
            </div>

            <!-- ACCOUNTS TABLE -->
            <div class="overflow-x-auto">
                <table class="bg-white border border-[#FCE77C] rounded-xl min-w-full overflow-hidden">
                    <thead class="bg-[#E15A37] text-white">
                        <tr>
                            <th class="px-6 py-3">User ID</th>
                            <th class="px-6 py-3">Full Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3 text-center">Role</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#FCE77C]">

                        <?php foreach ($accounts as $user): ?>
                            <tr class="hover:bg-[#FFF8E7] transition">
                                <td class="px-6 py-4">USR-<?= esc($user->id) ?></td>

                                <td class="px-6 py-4 font-semibold">
                                    <?= esc(trim($user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name)) ?>
                                </td>

                                <td class="px-6 py-4"><?= esc($user->email) ?></td>

                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        <?= $user->type === 'admin'
                                            ? 'bg-[#E15A37] text-white'
                                            : 'bg-[#FCE77C] text-gray-800' ?>">
                                        <?= ucfirst($user->type) ?>
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        <?= $user->account_status == 1
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-red-100 text-red-700' ?>">
                                        <?= $user->account_status == 1 ? 'Active' : 'Suspended' ?>
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <a href="#" onclick='openEditModal(<?= json_encode($user) ?>)'
                                        class="mx-2 text-[#E15A37]">✏️ Edit</a>

                                    <a href="#" onclick='openDeleteModal(<?= json_encode($user) ?>)'
                                        class="mx-2 font-semibold text-red-500 hover:text-red-600">
                                        🗑️ Delete
                                    </a>

                                </td>

                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        </div>

    </main>


    <!-- SIDEBAR -->
    <aside class="flex flex-col w-64 sidebar">
        <div class="p-6 border-[#FCE77C] border-b text-center">
            <img src="/assets/coircircle_logo.png" class="mx-auto mb-3 w-16">
            <h2 class="text-white text-2xl header-title">Admin Panel</h2>
        </div>

        <nav class="flex-1 space-y-2 p-4">
            <a href="/admin/adminDashboard" class="block px-4 py-3 rounded-lg sidebar-link">📊 Dashboard</a>
            <a href="/admin/stockPage" class="block px-4 py-3 rounded-lg sidebar-link">📚 Stocks Page</a>
            <a href="/admin/accountsPage" class="block bg-[#ED865A]/30 px-4 py-3 rounded-lg sidebar-link">👤 Accounts Page</a>
        </nav>

        <!-- LOGOUT BUTTON EXACTLY LIKE DASHBOARD -->
        <div class="p-4 border-[#FCE77C]/30 border-t">
            <form action="/logout" method="post">
                <?= csrf_field() ?>
                <button type="submit"
                    class="bg-[#FCE77C] hover:bg-[#ED865A] py-2 rounded-lg w-full font-semibold text-[#514D4D] text-center transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>


    <!-- ADD USER MODAL -->
    <dialog id="addAccountModal" class="backdrop:bg-black/60 p-0 rounded-2xl w-[95%] max-w-lg">
        <form method="post" action="/admin/accounts/create"
            class="space-y-4 bg-white shadow-xl p-6 border border-[#FCE77C] rounded-2xl">
            <?= csrf_field() ?>

            <h3 class="mb-4 font-bold text-[#E15A37] text-3xl header-title">Add New Account</h3>

            <div class="gap-3 grid grid-cols-1">
                <input type="text" name="first_name" placeholder="First Name" class="px-3 py-2 border border-[#FCE77C] rounded-lg" required>
                <input type="text" name="middle_name" placeholder="Middle Name" class="px-3 py-2 border border-[#FCE77C] rounded-lg">
                <input type="text" name="last_name" placeholder="Last Name" class="px-3 py-2 border border-[#FCE77C] rounded-lg" required>
                <input type="email" name="email" placeholder="Email" class="px-3 py-2 border border-[#FCE77C] rounded-lg" required>
                <input type="password" name="password" placeholder="Password" class="px-3 py-2 border border-[#FCE77C] rounded-lg" required>
                <input type="password" name="password_confirm" placeholder="Confirm Password" class="px-3 py-2 border border-[#FCE77C] rounded-lg" required>

                <select name="type" class="px-3 py-2 border border-[#FCE77C] rounded-lg" required>
                    <option value="client">Client</option>
                    <option value="admin">Admin</option>
                </select>

                <input type="hidden" name="account_status" value="1">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeAddModal()" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg text-gray-700">
                    Cancel
                </button>
                <button type="submit" class="bg-[#E15A37] hover:bg-[#ED865A] px-6 py-2 rounded-lg text-white">
                    Create
                </button>
            </div>
        </form>
    </dialog>


    <!-- EDIT USER MODAL -->
    <dialog id="editUserModal" class="backdrop:bg-black/60 p-0 rounded-2xl w-[95%] max-w-lg">
        <form method="post" id="editUserForm"
            class="space-y-4 bg-white shadow-xl p-6 border border-[#FCE77C] rounded-2xl">
            <?= csrf_field() ?>

            <h3 class="mb-4 font-bold text-[#E15A37] text-3xl header-title">✏️ Edit User</h3>

            <input type="hidden" name="id" id="edit_id">

            <div class="gap-3 grid grid-cols-1">
                <input type="text" id="edit_first_name" name="first_name" class="px-3 py-2 border border-[#FCE77C] rounded-lg" required>
                <input type="text" id="edit_middle_name" name="middle_name" class="px-3 py-2 border border-[#FCE77C] rounded-lg">
                <input type="text" id="edit_last_name" name="last_name" class="px-3 py-2 border border-[#FCE77C] rounded-lg" required>
                <input type="email" id="edit_email" name="email" class="px-3 py-2 border border-[#FCE77C] rounded-lg" required>
                <input type="password" id="edit_password" name="password" placeholder="New Password (optional)" class="px-3 py-2 border border-[#FCE77C] rounded-lg">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeEditModal()" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg text-gray-700">
                    Cancel
                </button>
                <button type="submit" class="bg-[#E15A37] hover:bg-[#ED865A] px-6 py-2 rounded-lg text-white">
                    Save Changes
                </button>
            </div>
        </form>
    </dialog>

    <!-- DELETE CONFIRM MODAL -->
    <dialog id="deleteUserModal" class="backdrop:bg-black/60 p-0 rounded-2xl w-[90%] max-w-md">

        <form method="post" id="deleteUserForm" class="bg-white shadow-xl p-6 border border-[#FCE77C] rounded-2xl">
            <?= csrf_field() ?>

            <h3 class="mb-4 font-bold text-[#E15A37] text-2xl header-title">⚠️ Delete User</h3>

            <p class="mb-6 text-gray-700">
                Are you sure you want to delete
                <strong id="delete_user_name"></strong>?
                This action cannot be undone.
            </p>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()" class="bg-gray-300 px-4 py-2 rounded-lg text-gray-700">
                    Cancel
                </button>

                <button type="submit" class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg text-white">
                    Delete
                </button>
            </div>
        </form>

    </dialog>

    <script>
        function openAddModal() {
            document.getElementById('addAccountModal').showModal();
        }

        function closeAddModal() {
            document.getElementById('addAccountModal').close();
        }

        const editModal = document.getElementById('editUserModal');

        function openEditModal(user) {
            document.getElementById("edit_id").value = user.id;
            document.getElementById("edit_first_name").value = user.first_name;
            document.getElementById("edit_middle_name").value = user.middle_name;
            document.getElementById("edit_last_name").value = user.last_name;
            document.getElementById("edit_email").value = user.email;

            document.getElementById("editUserForm").action = "/admin/accounts/update/" + user.id;

            editModal.showModal();
        }

        function closeEditModal() {
            editModal.close();
        }

        const deleteModal = document.getElementById("deleteUserModal");
        const deleteForm = document.getElementById("deleteUserForm");

        function openDeleteModal(user) {
            document.getElementById("delete_user_name").textContent =
                user.first_name + " " + user.last_name;

            deleteForm.action = "/admin/accounts/delete/" + user.id;

            deleteModal.showModal();
        }

        function closeDeleteModal() {
            deleteModal.close();
        }
    </script>

</body>

</html>