<?php
// Page: components/buttons/primary_button
?>

<?php if ($disable ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block bg-[#c0c0c0] opacity-50 px-5 py-2 rounded-md font-semibold text-[#68604D] text-sm transition-transform duration-200 cursor-not-allowed">
        <?= esc($label ?? 'Primary') ?>
    </a>

<?php elseif ($dark ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block bg-[#D5C7AD] hover:bg-[#BEC5A4] px-5 py-2 rounded-md font-semibold text-[#68604D] text-sm transition-transform duration-200">
        <?= esc($label ?? 'Primary') ?>
    </a>

<?php else: ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block bg-[#8A8E75] hover:bg-[#BEC5A4] px-5 py-2 rounded-md font-semibold text-white text-sm transition-transform duration-200">
        <?= esc($label ?? 'Primary') ?>
    </a>
<?php endif; ?>