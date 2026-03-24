<?php
// Component: components/cards/recentact_card.php
// Data contract:
// $activities: array of associative arrays with keys: 'user', 'action', 'date'
?>

<section class="p-8">
    <h2 class="mb-4 text-[#8B7E74] text-2xl header-title">Recent Activity</h2>

    <div class="bg-white shadow-md border border-[#E5E0DC] rounded-xl overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-[#A99D92]/20">
                <tr>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Action</th>
                    <th class="px-6 py-3">Date</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[#E5E0DC]">

                <?php if (isset($activities) && !empty($activities) && is_array($activities)): ?>

                    <?php foreach ($activities as $activity): ?>
                        <tr>
                            <td class="px-6 py-4"><?php echo esc($activity['user'] ?? ''); ?></td>
                            <td class="px-6 py-4"><?php echo esc($activity['action'] ?? ''); ?></td>
                            <td class="px-6 py-4"><?php echo esc($activity['date'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="3" class="px-6 py-4 text-gray-500 text-center italic">
                            No recent activity available.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>
    </div>
</section>