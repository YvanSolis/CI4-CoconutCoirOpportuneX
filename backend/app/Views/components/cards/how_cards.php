<?php
// Component: components/cards/how_cards.php
// Data contract:
// $number: string
// $title: string
// $description: string
?>

<div class="flex flex-col bg-white shadow-lg hover:shadow-2xl p-6 border border-[#D5C7AD] rounded-2xl transition-all duration-300 card-hover">

    <!-- Number Circle -->
    <div class="flex justify-center items-center bg-[#8A8E75] mx-auto mb-4 rounded-full w-12 h-12 font-bold text-white text-xl">
        <?php echo esc($number ?? ''); ?>
    </div>

    <!-- Title -->
    <h4 class="mb-2 font-semibold text-[#68604D] text-2xl text-center header-title">
        <?php echo esc($title ?? ''); ?>
    </h4>

    <!-- Description -->
    <p class="flex-grow mb-4 text-[#68604D] text-center leading-relaxed">
        <?php echo esc($description ?? ''); ?>
    </p>
</div>