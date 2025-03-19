<?php
session_start();
require_once '../connection.php';

// Check if user is logged in
$isLoggedIn = isset($_SESSION['is_login']) && $_SESSION['is_login'] === true;
if (!$isLoggedIn) {
    header('Location: ../index.php');
    exit;
}
     
// Fetch data from the database for the specific dog using the ID
$sql = "SELECT * FROM product WHERE category_id = 2";

$result = mysqli_query($conn, $sql);

$productData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $productData[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women's Collection - Shade Paradise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fdf2f8',
                            100: '#fce7f3',
                            500: '#ec4899',
                            600: '#db2777',
                            700: '#be185d',
                            800: '#9d174d',
                            900: '#831843',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Mobile Menu Toggle -->
    <div class="sm:hidden fixed bottom-4 right-4 z-50">
        <button id="mobile-menu-toggle" class="bg-primary-600 text-white p-3 rounded-full shadow-lg">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Navigation Menu (Hidden by default) -->
    <div id="mobile-menu" class="fixed inset-0 bg-gray-900 bg-opacity-95 z-40 transform translate-x-full transition-transform duration-300 sm:hidden">
        <div class="flex flex-col h-full justify-center items-center">
            <button id="close-menu" class="absolute top-4 right-4 text-white text-2xl">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="flex flex-col items-center space-y-6 text-xl">
                <a href="customer_index.php" class="text-white hover:text-primary-300 transition">HOME</a>
                <a href="shop.php" class="text-white hover:text-primary-300 transition">SHOP</a>
                <a href="men.php" class="text-white hover:text-primary-300 transition">MEN</a>
                <a href="women.php" class="text-white hover:text-primary-300 transition font-bold">WOMEN</a>
                <a href="customer_contact.php" class="text-white hover:text-primary-300 transition">CONTACT</a>
                <a href="order.php" class="text-white hover:text-primary-300 transition">ORDERS</a>
                <a href="../index/index.php" class="text-white hover:text-primary-300 transition">LOGOUT</a>
                <a href="customer_view_cart.php" class="text-white hover:text-primary-300 transition flex items-center">
                    <span class="mr-2">CART</span>
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Desktop Navigation -->
    <nav class="bg-gradient-to-r from-primary-700 to-primary-900 text-white shadow-md sticky top-0 z-30">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="#" class="mr-6">
                        <img src="../images/sunglasses.png" alt="Sunglasses Logo" class="h-10">
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="customer_index.php" class="hover:text-primary-200 transition">HOME</a>
                    <a href="shop.php" class="hover:text-primary-200 transition">SHOP</a>
                    <a href="men.php" class="hover:text-primary-200 transition">MEN</a>
                    <a href="women.php" class="border-b-2 border-white hover:text-primary-200 transition font-semibold">WOMEN</a>
                    <a href="customer_contact.php" class="hover:text-primary-200 transition">CONTACT</a>
                    <a href="order.php" class="hover:text-primary-200 transition">ORDERS</a>
                    <a href="../index/index.php" class="hover:text-primary-200 transition">LOGOUT</a>
                    <a href="customer_view_cart.php" class="hover:text-primary-200 transition">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="bg-gray-100 py-6">
        <div class="container mx-auto px-4">
            <div class="flex items-center text-sm text-gray-600">
                <a href="customer_index.php" class="hover:text-primary-600">Home</a>
                <span class="mx-2">/</span>
                <span class="text-primary-800 font-semibold">Women's Collection</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mt-2">Women's Sunglasses</h1>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="container mx-auto px-4 py-12">
        <!-- Filter and Sort (Can be expanded) -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <p class="text-gray-700 mb-4 md:mb-0">Showing <?= count($productData) ?> products</p>
            <div class="flex items-center space-x-2">
                <span class="text-gray-700">Sort by:</span>
                <select class="border rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <option>Featured</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Newest</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <?php foreach ($productData as $product) { ?>
                <div class="group bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <a href="customer_view_product.php?id=<?= $product['id'] ?>" class="block relative overflow-hidden">
                        <img src="../admin/uploads/<?= $product['image'] ?>" alt="<?= $product['brand'] ?>" 
                             class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    </a>
                    <div class="p-4">
                        <a href="customer_view_product.php?id=<?= $product['id'] ?>" class="block">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-primary-600 transition"><?= $product['brand'] ?></h3>
                        </a>
                        <p class="text-primary-600 font-bold mb-3">Rs <?= number_format($product['price'], 2) ?></p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-xs text-gray-500 ml-1">(4.5)</span>
                            </div>
                            <a href="customer_view_product.php?id=<?= $product['id'] ?>" 
                                class="text-primary-600 text-sm font-semibold hover:text-primary-800 transition">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Newsletter -->
    <div class="bg-primary-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Join Our Style Community</h2>
            <p class="text-gray-600 mb-8 max-w-xl mx-auto">Sign up for our newsletter to receive exclusive offers, new product alerts, and style inspiration.</p>
            <div class="max-w-md mx-auto flex flex-col sm:flex-row">
                <input type="email" placeholder="Your email address" class="px-4 py-3 flex-grow border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary-500 mb-2 sm:mb-0">
                <button class="bg-primary-600 text-white font-bold px-6 py-3 rounded-r-lg hover:bg-primary-700 transition">
                    Subscribe
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="text-xl font-bold mb-4">Shade Paradise</h4>
                    <p class="text-gray-400">Premium eyewear for every style.</p>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="customer_index.php" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="shop.php" class="text-gray-400 hover:text-white transition">Shop</a></li>
                        <li><a href="customer_about.php" class="text-gray-400 hover:text-white transition">About</a></li>
                        <li><a href="customer_contact.php" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-4">Contact Us</h4>
                    <p class="text-gray-400">Email: sunglasses@gmail.com</p>
                    <p class="text-gray-400">Phone: 9810103344</p>
                    <p class="text-gray-400">Address: Kathmandu, Kalanki</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center">
                <p class="text-gray-400">&copy; 2024 Shade Paradise. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const closeMenu = document.getElementById('close-menu');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('translate-x-full');
        });
        
        closeMenu.addEventListener('click', () => {
            mobileMenu.classList.add('translate-x-full');
        });
    </script>
</body>
</html>
