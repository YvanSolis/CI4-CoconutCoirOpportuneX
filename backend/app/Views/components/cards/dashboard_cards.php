<?php
// Component: components/cards/dashboard_cards.php
?>

<style>
    .card-hover {
        transition: all 0.25s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }
</style>

<section class="p-8 flex justify-center">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl w-full">

        <!-- Total Books -->
        <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl card-hover">
            <h3 class="mb-2 text-[#8B7E74] text-xl header-title">📘 Total Books</h3>
            <p class="font-bold text-gray-800 text-3xl">
                <?= esc($totalBooks ?? 0) ?>
            </p>
        </div>

        <!-- Registered Users -->
        <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl card-hover">
            <h3 class="mb-2 text-[#8B7E74] text-xl header-title">👥 Registered Users</h3>
            <p class="font-bold text-gray-800 text-3xl">
                <?= esc($registeredUsers ?? 0) ?>
            </p>
        </div>

    </div>
</section>