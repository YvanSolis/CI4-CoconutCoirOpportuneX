<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EcoCoir Creations - Sustainable Coconut Coir Products</title>
    <link rel="shortcut icon" type="image/png" href="/assets/coir_icon.ico" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f5f1e8 0%, #e8dcc0 100%);
            font-family: 'Roboto Slab', serif;
        }

        .header-title {
            font-family: "Righteous", sans-serif;
            font-weight: 400;
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(104, 96, 77, 0.2);
        }

        .hero-bg {
            background: linear-gradient(135deg, rgba(104, 96, 77, 0.9) 0%, rgba(139, 115, 85, 0.8) 100%),
                url('/assets/coco_background.png') no-repeat center center;
            background-size: cover;
        }

        .category-card {
            background: linear-gradient(135deg, #68604D 0%, #8B7355 100%);
        }

        .category-card:hover {
            background: linear-gradient(135deg, #8B7355 0%, #68604D 100%);
        }
    </style>
</head>

<?php
$session = session();
$isLoggedIn = $session->has('user');
$cartCount = $session->has('cart') ? count($session->get('cart')) : 0;
?>

<body class="text-[#514d4d]">

    <!-- Header -->
    <header class="top-0 z-50 sticky bg-white shadow-lg">
        <div class="flex justify-between items-center mx-auto px-6 py-4 max-w-7xl">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="/assets/opportunex_logo.png" alt="EcoCoir Creations" class="w-12 h-12">
                <h1 class="font-bold text-[#68604D] text-2xl header-title">EcoCoir Creations</h1>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="/" class="font-semibold text-[#68604D] hover:text-[#8A8E75] transition">Home</a>
                <a href="/featured" class="font-semibold text-[#68604D] hover:text-[#8A8E75] transition">Featured</a>
                <a href="/shop" class="font-semibold text-[#68604D] hover:text-[#8A8E75] transition">Shop</a>
            </nav>

            <!-- Cart & Auth -->
            <div class="flex items-center space-x-4">
                <a href="/cart" class="relative">
                    <img src="/assets/black cart.png" alt="Cart" class="w-8 h-8">
                    <?php if ($cartCount > 0): ?>
                        <span class="absolute -top-1 -right-1 flex justify-center items-center bg-red-500 text-white text-xs rounded-full w-5 h-5"><?= $cartCount ?></span>
                    <?php endif; ?>
                </a>
                <?php if ($isLoggedIn): ?>
                    <form action="/logout" method="post" class="inline">
                        <?= csrf_field() ?>
                        <button type="submit" class="bg-white border border-[#D5C7AD] hover:bg-[#F1EAD8] px-4 py-2 rounded-lg font-semibold text-[#68604D] transition">Logout</button>
                    </form>
                    <a href="/profile" class="bg-white border border-[#D5C7AD] hover:bg-[#F1EAD8] px-4 py-2 rounded-lg font-semibold text-[#68604D] transition">Profile</a>
                <?php else: ?>
                    <a href="/loginPage" class="bg-[#68604D] hover:bg-[#8A8E75] px-4 py-2 rounded-lg font-semibold text-white text-sm transition">
                        Sign In
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 mx-auto mb-6 px-6 py-3 border border-red-300 rounded-md max-w-7xl text-red-800">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 mx-auto mb-6 px-6 py-3 border border-green-300 rounded-md max-w-7xl text-green-800">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <!-- Hero Section with Super Crema style layout -->
        <section class="bg-[#F9F5EB] py-14">
            <div class="mx-auto px-6 max-w-7xl">
                <div class="gap-6 grid">
                    <!-- Hero image block - full width -->
                    <div class="bg-white shadow-lg rounded-3xl overflow-hidden">
                        <img src="/assets/coco_background.png" alt="EcoCoir Storefront" class="w-full h-96 object-cover">
                        <div class="p-10">
                            <p class="mb-4 font-semibold text-[#8A8E75] text-sm uppercase tracking-widest">Sustainable Selection</p>
                            <h1 class="mb-4 font-bold text-[#3A3B2A] text-4xl md:text-5xl">EcoCoir Creations</h1>
                            <p class="mb-6 text-[#5B5346] text-lg">30% off on select coconut coir essentials. Natural, compostable, and perfect for your home or garden.</p>
                            <a href="/shop" class="inline-block bg-[#8A8E75] hover:bg-[#6f7358] px-8 py-3 rounded-lg font-semibold text-white">Start Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Story + Coconut Coir Explained -->
        <section class="bg-[#F9F7EE] py-20">
            <div class="mx-auto px-6 max-w-7xl">
                <h2 class="mb-6 font-bold text-[#68604D] text-4xl text-center header-title">Our Story: Roots in Coconut Coir</h2>
                <div class="items-center gap-10 grid lg:grid-cols-2">
                    <div>
                        <p class="mb-4 text-[#5b5346] text-lg">
                            EcoCoir Creations started as a family mission to reduce coconut waste and repurpose it as practical lifestyle products.
                            We transformed a small backyard project into a trusted source for gardeners, crafters, and sustainable homeowners.
                        </p>
                        <p class="mb-4 text-[#5b5346] text-lg">
                            Since then, we have expanded responsibly while maintaining ecological impact, community benefit, and product quality.
                        </p>
                        <p class="mb-4 text-[#5b5346] text-lg">
                            Coconut coir is lightweight, porous, and biodegradable, used in gardening, packaging, and home comforts while replacing plastics.
                        </p>
                        <a href="/featured" class="inline-block bg-[#8A8E75] hover:bg-[#6f7358] px-8 py-3 rounded-lg font-semibold text-white">Explore Featured Collection</a>
                    </div>
                    <div class="gap-4 grid">
                        <div class="bg-white shadow-sm p-6 border border-[#dcd3c0] rounded-2xl">
                            <h3 class="mb-2 font-semibold text-[#68604D] text-xl">What is Coconut Coir?</h3>
                            <p class="text-[#5b5346] text-sm">A natural fiber from coconut husks, excellent for moisture control, soil aeration, and zero-waste products.</p>
                        </div>
                        <div class="bg-white shadow-sm p-6 border border-[#dcd3c0] rounded-2xl">
                            <h3 class="mb-2 font-semibold text-[#68604D] text-xl">Why it matters</h3>
                            <p class="text-[#5b5346] text-sm">Eco-friendly, renewable, and compostable—coir turns agricultural byproduct into valuable eco goods.</p>
                        </div>
                        <div class="bg-white shadow-sm p-6 border border-[#dcd3c0] rounded-2xl">
                            <h3 class="mb-2 font-semibold text-[#68604D] text-xl">Our Promise</h3>
                            <p class="text-[#5b5346] text-sm">Quality, transparency, and community support, with returns to farmers and zero harmful chemicals.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="bg-white py-20">
            <div class="mx-auto px-6 max-w-7xl">
                <h2 class="mb-12 font-bold text-[#68604D] text-4xl text-center header-title">
                    Why Choose EcoCoir?
                </h2>
                <div class="gap-8 grid md:grid-cols-3 text-center">
                    <div class="p-6">
                        <div class="mb-4 text-6xl">🌱</div>
                        <h3 class="mb-3 font-semibold text-[#68604D] text-xl">100% Natural</h3>
                        <p class="text-[#5b5346]">Made from renewable coconut husk fibers, completely biodegradable and eco-friendly.</p>
                    </div>
                    <div class="p-6">
                        <div class="mb-4 text-6xl">♻️</div>
                        <h3 class="mb-3 font-semibold text-[#68604D] text-xl">Sustainable</h3>
                        <p class="text-[#5b5346]">Reduces waste by transforming agricultural byproducts into useful, long-lasting products.</p>
                    </div>
                    <div class="p-6">
                        <div class="mb-4 text-6xl">🏠</div>
                        <h3 class="mb-3 font-semibold text-[#68604D] text-xl">Versatile</h3>
                        <p class="text-[#5b5346]">Perfect for gardening, home decor, crafts, and more. Durable and naturally water-retentive.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Customer Testimonials/Trust -->
        <section class="bg-[#68604D] py-20 text-white">
            <div class="mx-auto px-6 max-w-7xl text-center">
                <h2 class="mb-12 font-bold text-4xl header-title">What Our Customers Say</h2>
                <div class="gap-8 grid md:grid-cols-2">
                    <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl">
                        <div class="mb-4 text-4xl">⭐⭐⭐⭐⭐</div>
                        <p class="mb-4 italic">"Amazing quality coconut coir products! My plants have never been healthier. Highly recommend for any gardener."</p>
                        <p class="font-semibold">- Maria S., Home Gardener</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl">
                        <div class="mb-4 text-4xl">⭐⭐⭐⭐⭐</div>
                        <p class="mb-4 italic">"EcoCoir's commitment to sustainability is evident in every product. Love supporting this mission!"</p>
                        <p class="font-semibold">- John D., Eco-conscious Consumer</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="bg-[#D5C7AD] py-20">
            <div class="mx-auto px-6 max-w-4xl text-center">
                <h2 class="mb-6 font-bold text-[#68604D] text-4xl header-title">
                    Ready to Make a Difference?
                </h2>
                <p class="mb-8 text-[#5b5346] text-xl">
                    Join thousands of customers choosing sustainable living with our coconut coir products.
                </p>
                <div class="flex sm:flex-row flex-col justify-center gap-4">
                    <a href="/featured" class="bg-[#68604D] hover:bg-[#8A8E75] px-8 py-4 rounded-full font-semibold text-white text-lg transition">
                        Start Shopping Now
                    </a>
                    <a href="#contact" class="hover:bg-[#68604D] px-8 py-4 border-[#68604D] border-2 rounded-full font-semibold text-[#68604D] hover:text-white text-lg transition">
                        Contact Us
                    </a>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="bg-white py-20">
            <div class="mx-auto px-6 max-w-4xl text-center">
                <h2 class="mb-8 font-bold text-[#68604D] text-4xl header-title">Get in Touch</h2>
                <div class="flex justify-center items-center mb-6">
                    <div class="bg-[#68604D] p-4 rounded-full">
                        <span class="text-3xl">📧</span>
                    </div>
                </div>
                <p class="mb-6 text-[#5b5346] text-xl">
                    Have questions about our products or need help choosing the right coconut coir solution?
                </p>
                <p class="text-[#68604D] text-lg">
                    <strong>Email:</strong> hello@ecocoir.com<br>
                    <strong>Phone:</strong> (555) 123-COIR<br>
                    <strong>Hours:</strong> Mon-Fri 9AM-6PM PST
                </p>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-[#68604D] py-12 text-white">
        <div class="mx-auto px-6 max-w-7xl">
            <div class="gap-8 grid md:grid-cols-4 md:text-left text-center">
                <div>
                    <h3 class="mb-4 font-bold text-xl header-title">EcoCoir Creations</h3>
                    <p class="text-white/80">Sustainable coconut coir products for a better planet.</p>
                </div>
                <div>
                    <h4 class="mb-4 font-semibold">Quick Links</h4>
                    <ul class="space-y-2 text-white/80">
                        <li><a href="/featured" class="hover:text-white transition">Featured Products</a></li>
                        <li><a href="/shop" class="hover:text-white transition">All Products</a></li>
                        <li><a href="#about" class="hover:text-white transition">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 font-semibold">Support</h4>
                    <ul class="space-y-2 text-white/80">
                        <li><a href="#contact" class="hover:text-white transition">Contact</a></li>
                        <li><a href="/loginPage" class="hover:text-white transition">My Account</a></li>
                        <li><a href="/orders" class="hover:text-white transition">Order History</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 font-semibold">Follow Us</h4>
                    <div class="flex justify-center md:justify-start space-x-4">
                        <span class="text-2xl">🌿</span>
                        <span class="text-2xl">🌴</span>
                        <span class="text-2xl">♻️</span>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-white/20 border-t text-white/60 text-center">
                <p>&copy; 2026 EcoCoir Creations. All rights reserved. Made with ❤️ for our planet.</p>
            </div>
        </div>
    </footer>

    <!-- Add to Cart Modal -->
    <div id="cartModal" class="hidden z-50 fixed inset-0 justify-center items-center bg-black/50">
        <div class="bg-white mx-4 p-8 rounded-2xl w-full max-w-md">
            <h3 class="mb-4 font-bold text-[#68604D] text-2xl">Add to Cart</h3>
            <p id="modalTitle" class="mb-2 font-semibold text-lg"></p>
            <p class="mb-4 text-gray-600">Available: <span id="modalStock"></span></p>

            <form action="/cart/add" method="post">
                <?= csrf_field() ?>
                <input type="hidden" id="modalProductId" name="id">
                <input type="hidden" id="modalProductTitle" name="title">
                <input type="hidden" id="modalProductPrice" name="price">

                <label class="block mb-2 font-semibold text-[#68604D]">Quantity</label>
                <input type="number" name="quantity" min="1" value="1" id="modalQuantity"
                    class="mb-6 p-3 border border-gray-300 rounded-lg w-full">

                <div class="flex gap-3">
                    <button type="button" onclick="closeCartModal()"
                        class="flex-1 bg-gray-300 hover:bg-gray-400 px-4 py-3 rounded-lg font-semibold">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 bg-[#68604D] hover:bg-[#8A8E75] px-4 py-3 rounded-lg font-semibold text-white">
                        Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addToCart(id, title, price, stock) {
            document.getElementById('cartModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalStock').textContent = stock;
            document.getElementById('modalProductId').value = id;
            document.getElementById('modalProductTitle').value = title;
            document.getElementById('modalProductPrice').value = price;
            document.getElementById('modalQuantity').max = stock;
        }

        function closeCartModal() {
            document.getElementById('cartModal').classList.add('hidden');
        }

        // Close modal on outside click
        document.getElementById('cartModal').addEventListener('click', function(e) {
            if (e.target === this) closeCartModal();
        });
    </script>

</body>

</html>