<?php
$session = session();

// Total *quantity* in cart (not total items)
$cart = $session->get('cart') ?? [];
$cartCount = 0;
foreach ($cart as $c) {
    $cartCount += $c['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoCoir Creations – Featured Products</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <?= view('components/landingStyle') ?>

    <style>
        body {
            background: linear-gradient(135deg, #f5f1e8 0%, #e8dcc0 100%);
            font-family: 'Roboto Slab', serif;
        }

        .overlay {
            background: rgba(255, 255, 255, 0.75);
        }

        .header-title {
            font-family: "Righteous", sans-serif;
        }

        button:hover,
        .card-hover:hover,
        a:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgba(104, 96, 77, 0.25);
        }

        .primary-btn {
            background-color: #8A8E75;
            color: #FFFFFF;
        }

        .primary-btn:hover {
            background-color: #6f7358;
        }

        .cart-badge {
            top: -0.5rem;
            right: -0.5rem;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen overlay">

        <!-- Header -->
        <?= view('components/header.php', ['showCart' => true, 'cartCount' => $cartCount]) ?>

        <!-- Landing-style Hero (copied design) -->
        <section class="bg-[#F9F5EB] py-14">
            <div class="mx-auto px-6 max-w-7xl">
                <div class="grid md:grid-cols-2 gap-6 items-center">
                    <div>
                        <p class="mb-4 font-semibold text-[#8A8E75] text-sm uppercase tracking-wider">Featured Collection</p>
                        <h1 class="mb-4 text-4xl md:text-5xl font-bold text-[#3A3B2A] header-title">Handpicked EcoCoir Favorites</h1>
                        <p class="mb-6 text-[#5B5346] text-lg">Enjoy our sustainably sourced, high-quality coconut coir items—best sellers and customer picks in one place.</p>
                        <a href="/shop" class="inline-block bg-[#8A8E75] hover:bg-[#6f7358] px-8 py-3 rounded-lg font-semibold text-white">Shop All Products</a>
                    </div>
                    <div>
                        <img src="/assets/coco_background.png" alt="Featured hero" class="w-full rounded-3xl shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <main class="flex-grow">

            <!-- Featured Products Section -->
            <section class="py-16 text-center">
                <h2 class="drop-shadow-lg font-bold text-[#3A3B2A] text-3xl md:text-4xl header-title">
                    Featured Products
                </h2>
                <p class="mt-2 text-[#5B5346] text-lg md:text-xl">
                    Discover our handpicked selection of premium coconut coir products.
                </p>
            </section>

            <!-- Featured Products Section -->
            <section class="bg-[#F1EAD8]/90 backdrop-blur-sm py-24 text-[#514d4d]">
                <div class="mx-auto px-4 max-w-6xl">

                    <h3 class="mb-12 font-bold text-[#68604D] text-4xl text-center header-title">
                        Handpicked for You
                    </h3>

                    <?php if (!empty($featuredProducts) && !empty($featuredFallback)): ?>
                        <div class="mb-6 text-center text-sm text-[#5b5346]">
                            No official featured items yet; showing top-selling products instead.
                        </div>
                    <?php endif; ?>



                    <!-- Featured Products -->
                    <?php if (!empty($featuredProducts)): ?>
                        <h3 class="mb-8 font-bold text-[#68604D] text-3xl text-center header-title">Featured Products</h3>
                        <div class="gap-8 grid md:grid-cols-3 mb-12">
                            <?php foreach ($featuredProducts as $product): ?>
                                <div class="bg-white shadow-lg border border-[#D5C7AD] rounded-2xl overflow-hidden flex flex-col">
                                    <!-- Image Container -->
                                    <div class="p-4 bg-[#F9F5EB] flex items-center justify-center min-h-48">
                                        <img src="<?= esc($product->image) ?>" alt="<?= esc($product->name) ?>" class="w-full h-auto object-contain max-h-48">
                                    </div>

                                    <!-- Content Container -->
                                    <div class="flex-grow p-6 text-center">
                                        <h4 class="mb-3 font-bold text-[#68604D] text-lg"><?= esc($product->name) ?></h4>
                                        <p class="mb-4 text-[#5b5346] text-sm line-clamp-3"><?= esc($product->description) ?></p>
                                        <span class="block mb-6 font-bold text-[#8A8E75] text-lg">₱<?= number_format($product->price, 2) ?></span>
                                    </div>

                                    <!-- Button -->
                                    <div class="px-6 pb-6">
                                        <?php if ($isLoggedIn): ?>
                                            <button onclick="openCartModal('<?= $product->id ?>', '<?= esc(addslashes($product->name)) ?>', '<?= $product->price ?>', '<?= $product->quantity ?>')" class="w-full bg-[#8A8E75] hover:bg-[#68604D] px-4 py-2 rounded-lg font-semibold text-white transition">Add to Cart</button>
                                        <?php else: ?>
                                            <a href="/loginPage" class="block w-full bg-[#BEC5A4] hover:bg-[#8A8E75] px-4 py-2 rounded-lg font-semibold text-white text-center transition">Sign in to Add</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-[#5b5346] text-lg text-center">No featured products available at the moment.</p>
                    <?php endif; ?>



                </div>
            </section>

            <!-- CTA Section -->
            <section class="bg-white/90 backdrop-blur-sm py-32 w-full text-[#68604D] text-center">
                <?= view('components/cta', [
                    'heading' => 'Explore All Products',
                    'sub' => 'Browse our complete collection of sustainable coconut coir products.',
                    'primary' => [
                        'label' => 'View All Products',
                        'href'  => '/shop'
                    ]
                ]) ?>
            </section>

        </main>

        <!-- Footer -->
        <?= view('components/footer') ?>

    </div>

    <!-- ADD TO CART MODAL -->
    <div id="cartModal" class="hidden z-50 fixed inset-0 flex justify-center items-center bg-black/50">

        <div class="bg-white shadow-xl p-8 border border-[#D5C7AD] rounded-2xl w-full max-w-md">

            <h2 class="mb-4 font-bold text-[#8A8E75] text-3xl">
                Add to Cart
            </h2>

            <p id="modalBookTitle" class="mb-1 font-semibold text-[#68604D] text-lg"></p>
            <p class="mb-4 text-gray-600 text-sm">
                Available Stock: <span id="modalStock"></span>
            </p>

            <form action="/cart/add" method="post" class="mt-2" onsubmit="return handleAddToCart(event)">
                <?= csrf_field() ?>

                <input type="hidden" id="modalProductId" name="id">
                <input type="hidden" id="modalProductTitle" name="title">
                <input type="hidden" id="modalProductPrice" name="price">

                <label class="block mb-2 font-semibold text-[#68604D] text-sm">Quantity</label>
                <input type="number" name="quantity" min="1" id="modalQuantity" value="1"
                    class="mb-4 p-3 border border-[#8A8E75] focus:border-[#8A8E75] rounded-lg focus:ring-[#D5C7AD] w-full">

                <div class="flex gap-3">
                    <button type="button" onclick="closeCartModal()"
                        class="flex-1 bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg font-semibold text-gray-700">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#8A8E75] hover:bg-[#BEC5A4] px-4 py-2 rounded-lg font-semibold text-white">
                        Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCartModal(id, title, price, stock) {
            document.getElementById('cartModal').classList.remove('hidden');
            document.getElementById('modalBookTitle').textContent = title;
            document.getElementById('modalStock').textContent = stock;
            document.getElementById('modalProductId').value = id;
            document.getElementById('modalProductTitle').value = title;
            document.getElementById('modalProductPrice').value = price;
            document.getElementById('modalQuantity').max = stock;
        }

        function closeCartModal() {
            document.getElementById('cartModal').classList.add('hidden');
        }

        function handleAddToCart(event) {
            // Prevent default form submission from scrolling page
            event.preventDefault();

            // Submit the form via fetch to prevent page scroll
            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    closeCartModal();
                    // Optional: Show a success message or refresh cart count
                    location.reload(); // Reload to update cart
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error adding to cart');
                });

            return false;
        }

        // Close modal when clicking outside
        document.getElementById('cartModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCartModal();
            }
        });
    </script>

</body>

</html>