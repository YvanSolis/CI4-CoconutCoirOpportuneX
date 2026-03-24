<?php
// Component: components/cards/product_card.php
// Data contract:
// $title: string
// $description: string
// $price: string|int
// $image: string|null
?>

<div class="flex flex-col bg-white shadow-lg hover:shadow-2xl p-6 border border-[#D5C7AD] rounded-2xl transition-all duration-300 card-hover">

    <!-- Image Section -->
    <div class="flex justify-center items-center bg-[#D5C7AD]/40 mb-4 rounded-xl w-full h-56 overflow-hidden">
        <?php if (!empty($image)): ?>
            <img
                src="<?php echo esc($image); ?>"
                alt="Product: <?php echo esc($title); ?>"
                class="rounded-xl w-full h-full object-cover"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <?php endif; ?>
        <div class="hidden flex justify-center items-center bg-gradient-to-br from-[#D5C7AD]/20 to-transparent rounded-xl w-full h-56 text-3xl">
            🥥
        </div>
    </div>

    <!-- Title -->
    <h4 class="mb-2 font-semibold text-[#68604D] text-2xl text-center header-title">
        <?php echo esc($title ?? ''); ?>
    </h4>

    <!-- Description -->
    <p class="flex-grow mb-4 text-[#68604D] text-center leading-relaxed">
        <?php echo esc($description ?? ''); ?>
    </p>

    <!-- Price and Button -->
    <div class="flex justify-between items-center mt-auto">
        <span class="font-bold text-[#68604D] text-xl">
            ₱<?php echo esc($price ?? ''); ?>
        </span>
        <a href="/loginPage"
            class="bg-[#D5C7AD] hover:bg-[#68604D] px-4 py-2 rounded-full focus:outline-none focus:ring-[#D5C7AD]/60 focus:ring-2 font-semibold text-[#68604D] hover:text-white text-sm transition">
            Buy Now
        </a>
    </div>
</div>