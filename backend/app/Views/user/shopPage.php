<?php
$session = session();

// Use the passed in name (preferred) or fall back to profile data.
$userFirstName = $userFirstName ?? ($session->get('user')['profile']['display_name'] ?? $session->get('user')['first_name'] ?? 'Guest');

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
    <title>EcoCoir Creations – Shop</title>
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
                        <p class="mb-4 font-semibold text-[#8A8E75] text-sm uppercase tracking-wider">Shop</p>
                        <h1 class="mb-4 text-4xl md:text-5xl font-bold text-[#3A3B2A] header-title">Browse EcoCoir Products</h1>
                        <p class="mb-6 text-[#5B5346] text-lg">From planter liners to home accessories, every item is crafted for sustainability and style.</p>
                        <a href="/featured" class="inline-block bg-[#8A8E75] hover:bg-[#6f7358] px-8 py-3 rounded-lg font-semibold text-white">View Featured</a>
                    </div>
                    <div>
                        <img src="/assets/coco_background.png" alt="Shop hero" class="w-full rounded-3xl shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <main class="flex-grow">

            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 mx-auto mb-4 px-4 py-2 border border-red-300 rounded-md max-w-6xl text-red-800">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-green-100 mx-auto mb-4 px-4 py-2 border border-green-300 rounded-md max-w-6xl text-green-800">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <!-- Greeting -->
            <section class="py-16 text-center">
                <h2 class="drop-shadow-lg font-bold text-[#5B5346] text-3xl md:text-4xl header-title">
                    <?= $isLoggedIn ? "Hello, " . esc($userFirstName) . "!" : "Welcome to EcoCoir Creations!" ?>
                </h2>
                <p class="mt-2 text-[#5B5346] text-lg md:text-xl">
                    <?= $isLoggedIn ? "Browse our sustainable coconut coir products." : "Discover eco-friendly coconut coir solutions for your home and garden." ?>
                </p>
            </section>

            <!-- PRODUCTS -->
            <section class="bg-white/90 backdrop-blur-sm py-20 text-[#68604D]">
                <div class="mx-auto px-4 max-w-6xl">

                    <h3 class="mb-6 font-bold text-[#68604D] text-4xl text-center header-title">
                        EcoCoir Products
                    </h3>

                    <nav class="mb-8 text-center">
                        <a href="/shop" class="mx-2 text-[#68604D] hover:text-[#8A8E75]">All</a>
                        <a href="/shop?filter=featured" class="mx-2 text-[#68604D] hover:text-[#8A8E75]">Featured</a>
                    </nav>

                    <div class="gap-8 grid md:grid-cols-3">

                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $p): ?>
                                <div class="bg-white shadow-lg border border-[#D5C7AD] rounded-2xl overflow-hidden flex flex-col">

                                    <!-- Image Container -->
                                    <div class="p-4 bg-[#F9F5EB] flex items-center justify-center min-h-48">
                                        <img src="<?= esc($p->image) ?>"
                                            alt="<?= esc($p->name) ?>"
                                            class="w-full h-auto object-contain max-h-48">
                                    </div>

                                    <!-- Content Container -->
                                    <div class="flex-grow p-6 text-center">
                                        <h3 class="mb-3 font-bold text-[#68604D] text-lg"><?= esc($p->name) ?></h3>
                                        <p class="mb-4 text-[#5b5346] text-sm line-clamp-3"><?= esc($p->description) ?></p>
                                        <span class="block mb-6 font-bold text-[#8A8E75] text-lg">₱<?= number_format($p->price, 2) ?></span>
                                    </div>

                                    <!-- Button -->
                                    <div class="px-6 pb-6">
                                        <?php if ($isLoggedIn): ?>
                                            <button
                                                onclick="openCartModal(
                                                '<?= $p->id ?>',
                                                '<?= esc(addslashes($p->name)) ?>',
                                                '<?= $p->price ?>',
                                                '<?= $p->quantity ?>'
                                            )"
                                                class="w-full bg-[#8A8E75] hover:bg-[#68604D] px-4 py-2 rounded-lg font-semibold text-white transition">
                                                Add to Cart
                                            </button>
                                        <?php else: ?>
                                            <a href="/loginPage"
                                                class="block w-full bg-[#BEC5A4] hover:bg-[#8A8E75] px-4 py-2 rounded-lg font-semibold text-white text-center transition">
                                                Sign in to Add
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="col-span-3 text-gray-600 text-center">No products available at the moment.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </section>

            <!-- FOOTER -->
            <?= view('components/footer') ?>

        </main>
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

                <input type="hidden" name="id" id="modalBookId">
                <input type="hidden" name="title" id="modalBookName">
                <input type="hidden" name="price" id="modalBookPrice">

                <label class="block mb-1 font-semibold text-[#68604D]">Quantity</label>
                <input type="number" name="quantity" id="modalQuantity" required min="1"
                    class="mb-6 p-2 border border-[#8A8E75] rounded-lg focus:ring-[#8A8E75]/40 focus:ring-2 w-full">

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeCartModal()"
                        class="hover:bg-[#F1EAD8] px-5 py-2 border border-[#8A8E75] rounded-lg font-semibold text-[#8A8E75]">
                        Cancel
                    </button>

                    <button type="submit"
                        class="bg-[#8A8E75] hover:bg-[#BEC5A4] px-5 py-2 rounded-lg font-semibold text-white">
                        Add
                    </button>
                </div>
            </form>

        </div>
    </div>


    <script>
        function openCartModal(id, name, price, stock) {
            document.getElementById("modalBookId").value = id;
            document.getElementById("modalBookName").value = name;
            document.getElementById("modalBookPrice").value = price;

            document.getElementById("modalBookTitle").innerText = name;
            document.getElementById("modalStock").innerText = stock;

            let qty = document.getElementById("modalQuantity");
            qty.value = 1;
            qty.max = stock;

            document.getElementById("cartModal").classList.remove("hidden");
        }

        function closeCartModal() {
            document.getElementById("cartModal").classList.add("hidden");
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
                    // Reload to update cart
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error adding to cart');
                });

            return false;
        }
    </script>

    <!-- 🔥 ORDER SUCCESS MODAL -->
    <?php if (session()->getFlashdata('success')): ?>
        <div id="orderSuccessModal"
            class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">

            <div class="bg-white shadow-xl p-8 border-[#D5C7AD] border-2 rounded-2xl max-w-md text-center">

                <h2 class="mb-4 font-bold text-[#8A8E75] text-3xl">
                    Order Successful!
                </h2>

                <p class="mb-6 text-gray-700 text-lg">
                    <?= session()->getFlashdata('success') ?>
                </p>

                <button onclick="closeSuccessModal()"
                    class="bg-[#8A8E75] hover:bg-[#BEC5A4] px-6 py-3 rounded-lg font-semibold text-white">
                    Continue Shopping
                </button>

            </div>
        </div>

        <script>
            function closeSuccessModal() {
                document.getElementById("orderSuccessModal").remove();
            }
        </script>
    <?php endif; ?>

</body>

</html>