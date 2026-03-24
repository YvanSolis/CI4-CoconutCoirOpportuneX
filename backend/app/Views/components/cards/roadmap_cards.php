<?php
// Component: components/cards/roadmap_cards.php
// Data contract:
// $title: string
// $description: string
// $status: string
// $priority: string
// $statusClass: string
?>

<div class="bg-white/90 backdrop-blur-sm border border-white/20 shadow-lg hover:shadow-2xl rounded-2xl p-7 transition-all duration-300 hover:-translate-y-1">
    <div class="flex justify-between items-start">
        <h2 class="font-semibold text-xl text-[#3c2f2f]"><?php echo esc($title ?? ''); ?></h2>
        <span class="status px-3 py-1 rounded-full text-white text-xs font-semibold <?php echo esc($statusClass ?? ''); ?>">
            <?php echo esc($status ?? ''); ?>
        </span>
    </div>
    <p class="mt-2 text-sm text-[#3c2f2f]">
        <?php echo esc($description ?? ''); ?>
    </p>
    <p class="mt-3 font-medium text-[#8B7E74] text-xs">
        Priority: <?php echo esc($priority ?? ''); ?>
    </p>
</div>