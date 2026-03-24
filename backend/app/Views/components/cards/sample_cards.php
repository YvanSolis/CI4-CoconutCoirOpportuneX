<div class="flex flex-col bg-white shadow-lg hover:shadow-2xl p-8 border border-[#D5C7AD]/50 rounded-2xl transition-all duration-300 card-hover">
    <div class="flex-grow text-center">
        <?php echo $content ?? ''; ?>
    </div>

    <?php if (!empty($link)): ?>
        <a href="<?php echo esc($link); ?>"
            class="inline-block bg-[#8A8E75] hover:bg-[#BEC5A4] mt-4 px-4 py-2 rounded-full font-semibold text-white text-sm transition">
            Read more
        </a>
    <?php endif; ?>
</div>