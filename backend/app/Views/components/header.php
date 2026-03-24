<?php
$session = \Config\Services::session();

// Count items in cart
$cartCount = $session->has('cart') ? count($session->get('cart')) : 0;

// User data (if logged in)
$user = $session->get('user') ?? null;

// Determine home URL dynamically
$homeUrl = $user ? '/shop' : '/';
?>

<header class="top-0 z-50 sticky bg-white shadow-lg">
    <div class="flex justify-between items-center mx-auto px-6 py-4 max-w-7xl">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <img src="/assets/newlogo.png" alt="EcoCoir Creations" class="w-12 h-12">
            <h1 class="font-bold text-[#68604D] text-2xl header-title">EcoCoir Creations</h1>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8">
            <a href="/" class="font-semibold text-[#68604D] hover:text-[#8A8E75] transition">Home</a>
            <a href="/featured" class="font-semibold text-[#68604D] hover:text-[#8A8E75] transition">Featured</a>
            <a href="/shop" class="font-semibold text-[#68604D] hover:text-[#8A8E75] transition">Shop</a>
        </nav>

        <!-- Cart & Auth -->
        <div class="hidden md:flex items-center space-x-4">
            <a href="/cart" class="relative">
                <img src="/assets/black cart.png" alt="Cart" class="w-8 h-8">
                <?php if ($cartCount > 0): ?>
                    <span class="absolute -top-1 -right-1 flex justify-center items-center bg-red-500 text-white text-xs rounded-full w-5 h-5"><?= $cartCount ?></span>
                <?php endif; ?>
            </a>
            <?php if ($user): ?>
                <form action="/logout" method="post" class="inline">
                    <?= csrf_field() ?>
                    <button type="submit" class="bg-white border border-[#D5C7AD] hover:bg-[#F1EAD8] px-4 py-2 rounded-lg font-semibold text-[#68604D] transition">Logout</button>
                </form>
                <a href="/profile" class="bg-white border border-[#D5C7AD] hover:bg-[#F1EAD8] px-4 py-2 rounded-lg font-semibold text-[#68604D] transition">Profile</a>
            <?php else: ?>
                <a href="/loginPage" class="bg-[#68604D] hover:bg-[#8A8E75] px-4 py-2 rounded-lg font-semibold text-white text-sm transition">Sign In</a>
            <?php endif; ?>
        </div>

        <!-- Mobile menu toggler -->
        <button id="mobileMenuButton" class="md:hidden text-[#68604D] text-3xl">☰</button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-[#D5C7AD]">
        <a href="/" class="block px-6 py-3 border-b border-[#F2ECE0]">Home</a>
        <a href="/featured" class="block px-6 py-3 border-b border-[#F2ECE0]">Featured</a>
        <a href="/shop" class="block px-6 py-3 border-b border-[#F2ECE0]">Shop</a>
        <?php if ($user): ?>
            <a href="/profile" class="block px-6 py-3 border-t border-[#F2ECE0]">Profile</a>
            <form action="/logout" method="post" class="px-6 py-3">
                <?= csrf_field() ?>
                <button type="submit" class="w-full bg-[#68604D] text-white py-2 rounded-lg">Logout</button>
            </form>
        <?php else: ?>
            <a href="/loginPage" class="block px-6 py-3 border-t border-[#F2ECE0]">Login</a>
        <?php endif; ?>
    </div>
</header>

<script>
    const btn = document.getElementById('mobileMenuButton');
    const menu = document.getElementById('mobileMenu');
    btn.addEventListener('click', () => menu.classList.toggle('hidden'));
</script>