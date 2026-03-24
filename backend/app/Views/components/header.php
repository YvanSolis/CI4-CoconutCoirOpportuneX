<?php
$session = \Config\Services::session();

// Count items in cart
$cartCount = $session->has('cart') ? count($session->get('cart')) : 0;

// User data (if logged in)
$user = $session->get('user') ?? null;

// Determine home URL dynamically
$homeUrl = $user ? '/shop' : '/';
?>

<header class="top-0 z-50 sticky bg-[#68604D] shadow-lg text-white">
    <div class="flex justify-between items-center mx-auto px-4 py-6 max-w-7xl">

        <!-- Brand -->
        <div class="flex items-center space-x-3">
            <img src="<?= esc($logo ?? '/assets/eco_white_logo.png') ?>"
                alt="<?= esc($brandTitle ?? 'EcoCoir Creations') ?>"
                class="w-12 h-12">
            <h1 class="font-bold text-3xl md:text-4xl tracking-wider" style="font-family: 'Righteous', sans-serif;">
                <?= esc($brandTitle ?? 'EcoCoir Creations') ?>
            </h1>
        </div>

        <!-- Desktop Nav + Logout + Cart -->
        <div class="hidden md:flex items-center space-x-4">
            <a href="/" class="bg-[#D5C7AD] hover:bg-[#BEC5A4] shadow-lg px-6 py-3 rounded-full text-[#68604D] btn-main">
                Home
            </a>
            <a href="/featured" class="bg-white hover:bg-[#F1EAD8] shadow-lg px-6 py-3 rounded-full text-[#68604D] btn-main">
                Featured
            </a>
            <a href="/shop" class="bg-white hover:bg-[#F1EAD8] shadow-lg px-6 py-3 rounded-full text-[#68604D] btn-main">
                Shop
            </a>

            <?php if ($user): ?>
                <?php if (in_array($user['type'], ['seller', 'buyer-seller', 'admin'])): ?>
                    <a href="/seller/dashboard" class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#68604D]">
                        Seller Dashboard
                    </a>
                <?php endif; ?>

                <a href="/cart" class="relative flex items-center ml-4">
                    <img src="/assets/cart_icon.png" alt="Cart" class="w-10 h-10">
                    <?php if ($cartCount > 0): ?>
                        <span class="-top-2 -right-2 absolute flex justify-center items-center bg-red-500 rounded-full w-5 h-5 text-white text-xs">
                            <?= $cartCount ?>
                        </span>
                    <?php endif; ?>
                </a>

                <form action="/logout" method="post" class="ml-4">
                    <button type="submit" class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#68604D]">
                        Logout
                    </button>
                </form>

                <a href="/profile" class="relative flex items-center hover:bg-white/20 ml-4 px-3 py-2 rounded-full transition" title="Change profile">
                    <?php if (!empty($user['avatar_url'])): ?>
                        <img src="<?= esc($user['avatar_url']) ?>" alt="Avatar" class="border-2 border-white rounded-full w-10 h-10 object-cover">
                    <?php else: ?>
                        <span class="flex justify-center items-center bg-white/20 rounded-full w-10 h-10 font-semibold text-white text-sm">?</span>
                    <?php endif; ?>
                </a>
            <?php else: ?>
                <a href="/loginPage" class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#68604D]">
                    Login
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobileMenuButton" class="md:hidden text-white text-3xl">☰</button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-[#8A8E75]">
        <a href="/" class="block hover:bg-[#D5C7AD]/20 px-6 py-3 text-white">Home</a>
        <a href="/featured" class="block hover:bg-[#D5C7AD]/20 px-6 py-3 text-white">Featured</a>
        <a href="/shop" class="block hover:bg-[#D5C7AD]/20 px-6 py-3 text-white">Shop</a>
        <?php if ($user): ?>
            <?php if (in_array($user['type'], ['seller', 'buyer-seller', 'admin'])): ?>
                <a href="/seller/dashboard" class="block hover:bg-[#D5C7AD]/20 px-6 py-3 text-white">Seller Dashboard</a>
            <?php endif; ?>
            <a href="/profile" class="block hover:bg-[#D5C7AD]/20 px-6 py-3 text-white">
                Profile
            </a>
            <a href="/cart" class="block hover:bg-[#D5C7AD]/20 px-6 py-3 text-white">
                Cart (<?= $cartCount ?>)
            </a>
            <form action="/logout" method="post" class="px-6 py-3 text-right">
                <button type="submit" class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#68604D]">
                    Logout
                </button>
            </form>
        <?php else: ?>
            <a href="/loginPage" class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#68604D]">Login</a>
        <?php endif; ?>
    </div>

    <script>
        const btn = document.getElementById('mobileMenuButton');
        const menu = document.getElementById('mobileMenu');
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    </script>
</header>