<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EcoCoir Creations – Mood Board</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@400;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: "Roboto Slab", serif;
        }

        .header-title,
        h1,
        h2,
        h3,
        h4,
        .heading {
            font-family: "Righteous", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        button,
        a.btn-main {
            transition: all 0.3s ease;
        }

        button:hover,
        a.btn-main:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(225, 90, 55, 0.3);
        }
    </style>
</head>

<body class="flex flex-col bg-gradient-to-br from-[#D5C7AD]/60 to-[#ffffff] min-h-screen text-[#68604D]">

    <!-- HEADER -->
    <?= view('components/header.php') ?>

    <!-- Page content container -->
    <div class="flex-grow mx-auto px-4 md:px-20 py-10 w-full max-w-[1400px]">
        <!-- Hero Section -->
        <section class="relative bg-[#D5C7AD] mb-16 p-12 md:p-16 rounded-2xl overflow-hidden text-[#68604D]">
            <div class="absolute inset-0 bg-gradient-to-r from-[#D5C7AD]/30 to-[#8A8E75]/20"></div>
            <div class="z-10 relative mx-auto max-w-4xl text-center">
                <h1 class="mb-6 font-['Righteous'] text-4xl md:text-6xl leading-tight">EcoCoir Creations Moodboard</h1>
                <p class="font-light text-xl md:text-2xl">Visual identity guide for EcoCoir Creations – Authentic sustainable vibes in natural tones.</p>
            </div>
        </section>

        <!-- Dual columns -->
        <div class="gap-12 grid grid-cols-1 lg:grid-cols-2 mb-16">
            <!-- Color System -->
            <section class="order-2 lg:order-1 bg-white/80 shadow-md backdrop-blur-sm p-8 rounded-2xl">
                <h2 class="mb-6 font-['Righteous'] text-[#68604D] text-2xl md:text-3xl text-center">Color System</h2>
                <p class="mb-8 text-[#68604D] text-lg text-center">Three main color themes with three vibrance levels each.</p>

                <div class="justify-items-center gap-6 grid grid-cols-1 md:grid-cols-3">

                    <!-- Sage Green (Accent) -->
                    <div class="flex flex-col items-center gap-4 text-center">
                        <div class="flex flex-row flex-wrap justify-center items-center gap-2">
                            <div class="bg-[#8A8E75] shadow-md rounded-lg w-32 md:w-40 h-12 md:h-16"></div>
                            <div class="bg-[#8A8E75]/80 shadow-md rounded-lg w-32 md:w-40 h-12 md:h-16"></div>
                            <div class="bg-[#8A8E75]/60 shadow-md rounded-lg w-32 md:w-40 h-12 md:h-16"></div>
                        </div>
                        <p class="mt-2 text-[#68604D] text-sm md:text-base">#8A8E75 — 80% — 60%</p>
                        <p class="font-semibold text-[#68604D] text-lg">Sage Accent</p>
                    </div>

                    <!-- Soft Beige → FFFEE0 -->
                    <div class="flex flex-col items-center gap-4 text-center">
                        <div class="flex flex-row flex-wrap justify-center items-center gap-2">
                            <div class="bg-[#D5C7AD] shadow-md border border-[#D5C7AD] rounded-lg w-32 md:w-40 h-12 md:h-16"></div>
                            <div class="bg-[#D5C7AD]/80 shadow-md border border-[#D5C7AD] rounded-lg w-32 md:w-40 h-12 md:h-16"></div>
                            <div class="bg-[#D5C7AD]/60 shadow-md border border-[#D5C7AD] rounded-lg w-32 md:w-40 h-12 md:h-16"></div>
                        </div>
                        <p class="mt-2 text-[#68604D] text-sm md:text-base">#D5C7AD — 80% — 60%</p>
                        <p class="font-semibold text-[#68604D] text-lg">Parchment Light</p>
                    </div>

                    <!-- Charcoal Gray → Clean neutrals -->
                    <div class="flex flex-col items-center gap-4 text-center">
                        <div class="flex flex-row flex-wrap justify-center items-center gap-2">
                            <div class="bg-[#ffffff] shadow-md rounded-lg w-32 md:w-40 h-12 md:h-16"></div>
                            <div class="bg-[#D5C7AD]/40 shadow-md rounded-lg w-32 md:w-40 h-12 md:h-16"></div>
                            <div class="bg-[#D5C7AD]/20 shadow-md rounded-lg w-32 md:w-40 h-12 md:h-16"></div>
                        </div>
                        <p class="mt-2 text-[#68604D] text-sm md:text-base">#ffffff — 40% — 20%</p>
                        <p class="font-semibold text-[#68604D] text-lg">Neutral Whites</p>
                    </div>
                </div>
            </section>

            <!-- Typography -->
            <section class="order-1 lg:order-2 bg-white/80 shadow-md backdrop-blur-sm p-8 rounded-2xl">
                <h2 class="mb-6 font-['Righteous'] text-[#68604D] text-2xl md:text-3xl text-center">Typography</h2>
                <div class="space-y-8">
                    <div class="bg-gradient-to-br from-white to-[#D5C7AD]/60 p-6 border border-[#D5C7AD] rounded-xl text-center">
                        <h3 class="mb-3 font-['Righteous'] text-[#68604D] text-2xl md:text-3xl">Heading Font</h3>
                        <p class="font-['Righteous'] text-[#68604D] text-lg">Righteous – Bold, evocative, and perfect for titles.</p>
                    </div>

                    <div class="bg-gradient-to-br from-white to-[#D5C7AD]/60 p-6 border border-[#D5C7AD] rounded-xl">
                        <h3 class="mb-3 font-['Righteous'] text-[#68604D] text-xl md:text-2xl">Body Font</h3>
                        <p class="text-[#68604D] text-base leading-relaxed">Roboto Slab – Serif elegance for immersive reading.</p>
                    </div>
                </div>
            </section>
        </div>

        <!-- Buttons -->
        <section class="bg-white/80 shadow-md backdrop-blur-sm mb-16 p-8 rounded-2xl">
            <h2 class="mb-8 font-['Righteous'] text-[#68604D] text-2xl md:text-3xl text-center">Interactive Elements: Buttons</h2>

            <div class="space-y-8 mx-auto max-w-5xl">
                <div class="text-center">
                    <h3 class="mb-6 font-semibold text-[#68604D] text-lg">Light Mode</h3>
                    <div class="flex flex-wrap justify-center items-center gap-6">
                        <?= view('components/buttons/primary_button', ['label' => 'Primary', 'href' => '#']) ?>
                        <?= view('components/buttons/second_button', ['label' => 'Secondary', 'href' => '#']) ?>
                        <?= view('components/buttons/border_button', ['label' => 'Border', 'href' => '#']) ?>
                        <?= view('components/buttons/primary_button', ['label' => 'Disabled', 'href' => '#', 'disable' => true]) ?>
                    </div>
                </div>

                <div class="bg-[#D5C7AD] p-8 rounded-xl text-[#68604D] text-center">
                    <h3 class="mb-6 font-semibold text-white text-lg">Dark Mode</h3>
                    <div class="flex flex-wrap justify-center items-center gap-6">
                        <?= view('components/buttons/primary_button', ['label' => 'Primary', 'href' => '#', 'dark' => true, 'disable' => false]) ?>
                        <?= view('components/buttons/second_button', ['label' => 'Secondary', 'href' => '#', 'dark' => true]) ?>
                        <?= view('components/buttons/border_button', ['label' => 'Border', 'href' => '#', 'dark' => true]) ?>
                        <?= view('components/buttons/primary_button', ['label' => 'Disabled', 'href' => '#', 'disable' => true]) ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cards -->
        <section class="mb-16">
            <div class="bg-white/80 shadow-md backdrop-blur-sm p-8 md:p-12 rounded-2xl text-center">
                <h2 class="mb-8 font-['Righteous'] text-[#68604D] text-3xl md:text-4xl">Card Samples</h2>
                <p class="mx-auto mb-12 max-w-3xl text-[#68604D] text-lg">Modular components for showcasing products, stats, and testimonials.</p>

                <div class="gap-8 md:gap-12 grid grid-cols-1 md:grid-cols-3">
                    <?= view('components/cards/sample_cards', [
                        "content" => '
                            <h3 class="mb-2 font-bold text-[#8A8E75] text-4xl">1,254</h3>
                            <p class="mb-4 text-[#8A8E75]">Products Sold This Month</p>
                            <p class="text-[#8A8E75]/70 text-sm">A milestone in our literary journey.</p>
                        ',
                        "link" => "#"
                    ]) ?>

                    <?= view('components/cards/sample_cards', [
                        "content" => '
                            <h3 class="mb-2 font-semibold text-[#68604D] text-2xl">Premium Collection</h3>
                            <p class="mb-4 text-[#8A8E75]">Limited edition hand-picked products for collectors.</p>
                            <p class="text-[#8A8E75]/70 text-sm">Discover rare gems today.</p>
                        ',
                        "link" => "#"
                    ]) ?>

                    <?= view('components/cards/sample_cards', [
                        "content" => '
                            <blockquote class="mb-2 font-medium text-[#8A8E75] italic">“A cozy place for every product lover.”</blockquote>
                            <p class="mb-4 text-[#8A8E75]/70">— Loyal Customer</p>
                            <p class="text-[#8A8E75]/60 text-sm">Join our community of readers.</p>
                        ',
                        "link" => "#"
                    ]) ?>
                </div>
            </div>
        </section>

        <!-- Logos -->
        <section class="bg-white/80 shadow-md backdrop-blur-sm p-8 md:p-12 rounded-2xl text-center">
            <h2 class="mb-8 font-['Righteous'] text-[#68604D] text-2xl md:text-3xl">Brand Logos</h2>
            <p class="mx-auto mb-12 max-w-2xl text-[#8A8E75] text-lg">Versatile logo variations for digital and print use.</p>

            <div class="flex flex-wrap justify-center items-center gap-12">
                <div class="bg-white shadow-lg p-8 border border-[#D5C7AD] rounded-2xl w-48 md:w-56 text-center">
                    <img src="/assets/coircircle_logo.png" alt="EcoCoir Circle Logo"
                        class="mx-auto mb-4 w-20 md:w-24 h-20 md:h-24 object-contain">
                    <p class="font-medium text-[#68604D] text-base">Main — Circle</p>
                    <p class="text-[#8A8E75] text-sm">For favicons and social icons</p>
                </div>

                <div class="bg-white shadow-lg p-8 border border-[#D5C7AD] rounded-2xl w-48 md:w-56 text-center">
                    <img src="/assets/fenesquare_logo.png" alt="EcoCoir Square Logo"
                        class="mx-auto mb-4 w-20 md:w-24 h-20 md:h-24 object-contain">
                    <p class="font-medium text-[#68604D] text-base">Main — Square</p>
                    <p class="text-[#8A8E75] text-sm">For headers and print materials</p>
                </div>
            </div>
        </section>
    </div>

    <!-- FOOTER -->
    <?= view('components/footer.php') ?>

</body>

</html>