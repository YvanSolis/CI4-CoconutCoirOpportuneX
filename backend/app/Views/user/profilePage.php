<?php
$session = session();

if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

$user = $session->get('user');

$errors = $session->getFlashdata('errors') ?? [];
$success = $session->getFlashdata('success') ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | EcoCoir Creations</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <?= view('components/landingStyle') ?>

    <style>
        body {
            background: url('/assets/background.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto Slab', serif;
        }

        .overlay {
            background: linear-gradient(rgba(44, 41, 41, 0.6), rgba(225, 90, 55, 0.4));
        }

        .header-title {
            font-family: "Righteous", sans-serif;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen overlay">

        <?= view('components/header', ['brandTitle' => 'Profile']) ?>

        <!-- Landing-style Hero (copied design) -->
        <section class="bg-[#F9F5EB] py-14">
            <div class="mx-auto px-6 max-w-7xl">
                <div class="grid md:grid-cols-2 gap-6 items-center">
                    <div>
                        <p class="mb-4 font-semibold text-[#8A8E75] text-sm uppercase tracking-wider">Profile</p>
                        <h1 class="mb-4 text-4xl md:text-5xl font-bold text-[#3A3B2A] header-title">Manage Your Account</h1>
                        <p class="mb-6 text-[#5B5346] text-lg">Update your preferences, avatar, and account details in a clean, consistent style.</p>
                        <a href="/shop" class="inline-block bg-[#8A8E75] hover:bg-[#6f7358] px-8 py-3 rounded-lg font-semibold text-white">Browse Products</a>
                    </div>
                    <div>
                        <img src="/assets/coco_background.png" alt="Profile hero" class="w-full rounded-3xl shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <main class="flex-grow px-4 py-16">
            <div class="bg-white/90 shadow-xl backdrop-blur-sm mx-auto p-10 rounded-3xl max-w-3xl">
                <h1 class="mb-4 font-bold text-[#68604D] text-3xl header-title">Your Profile</h1>

                <?php if ($success): ?>
                    <div class="bg-green-100 mb-6 p-4 rounded-lg text-green-700">
                        <?= esc($success) ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($errors)): ?>
                    <div class="bg-red-100 mb-6 p-4 rounded-lg text-red-700">
                        <ul class="pl-5 list-disc">
                            <?php foreach ($errors as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="flex md:flex-row flex-col gap-8">
                    <div class="flex-shrink-0">
                        <?php if (!empty($user['avatar_url'])): ?>
                            <img src="<?= esc($user['avatar_url']) ?>" alt="Avatar" class="border-[#68604D] border-4 rounded-full w-40 h-40 object-cover">
                        <?php else: ?>
                            <div class="flex justify-center items-center bg-[#D5C7AD] rounded-full w-40 h-40 font-bold text-[#68604D] text-5xl">
                                <?= esc(substr($user['profile']['display_name'] ?? ($user['first_name'] ?? ''), 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <form action="/profile" method="post" enctype="multipart/form-data" class="flex-1 space-y-6">
                        <?= csrf_field() ?>

                        <div>
                            <label class="block mb-2 font-semibold text-[#68604D] text-sm">Display Name</label>
                            <input type="text" name="display_name" required
                                value="<?= esc($user['profile']['display_name'] ?? ($user['first_name'] . ' ' . $user['last_name'])) ?>"
                                class="px-4 py-3 border border-gray-300 focus:border-[#68604D] rounded-xl focus:ring-[#D5C7AD]/60 focus:ring-4 w-full">
                        </div>

                        <div>
                            <label class="block mb-2 font-semibold text-[#68604D] text-sm">Profile Photo</label>
                            <input type="file" name="avatar" accept="image/*"
                                class="px-4 py-3 border border-gray-300 focus:border-[#68604D] rounded-xl focus:ring-[#D5C7AD]/60 focus:ring-4 w-full">
                            <p class="mt-2 text-gray-600 text-xs">Leave blank to keep current photo. Max 2MB.</p>
                        </div>

                        <button type="submit"
                            class="bg-[#D5C7AD] hover:bg-[#68604D] py-4 rounded-full w-full font-semibold text-[#68604D] hover:text-white text-lg transition">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </main>

        <?= view('components/footer') ?>
    </div>
</body>

</html>