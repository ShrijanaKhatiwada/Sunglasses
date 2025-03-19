<?php
session_start();
$isLoggedIn = isset($_SESSION['is_login']) && $_SESSION['is_login'] === true;
$user_name = $_SESSION['users_name'] ?? 'Customer';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Shade Paradise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">
    <!-- Mobile Menu Toggle -->
    <div class="sm:hidden fixed bottom-4 right-4 z-50">
        <button id="mobile-menu-toggle" class="bg-blue-600 text-white p-3 rounded-full shadow-lg">
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
                <a href="<?= $isLoggedIn ? 'customer_index.php' : '../index.php' ?>" class="text-white hover:text-blue-300 transition">HOME</a>
                <a href="shop.php" class="text-white hover:text-blue-300 transition">SHOP</a>
                <a href="customer_contact.php" class="text-white hover:text-blue-300 transition">CONTACT</a>
                <?php if ($isLoggedIn): ?>
                    <a href="order.php" class="text-white hover:text-blue-300 transition">ORDERS</a>
                    <a href="../index/index.php" class="text-white hover:text-blue-300 transition">LOGOUT</a>
                    <a href="customer_view_cart.php" class="text-white hover:text-blue-300 transition flex items-center">
                        <span class="mr-2">CART</span>
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                <?php else: ?>
                    <a href="customer_login.php" class="text-white hover:text-blue-300 transition">LOGIN</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Desktop Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-md hidden sm:block">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="#" class="mr-6">
                        <img src="../images/sunglasses.png" alt="Sunglasses Logo" class="h-10">
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="<?= $isLoggedIn ? 'customer_index.php' : '../index.php' ?>" class="hover:text-blue-200 transition">HOME</a>
                    <a href="shop.php" class="hover:text-blue-200 transition">SHOP</a>
                    <a href="customer_about.php" class="border-b-2 border-white hover:text-blue-200 transition">ABOUT</a>
                    <a href="customer_contact.php" class="hover:text-blue-200 transition">CONTACT</a>
                    <?php if ($isLoggedIn): ?>
                        <a href="order.php" class="hover:text-blue-200 transition">ORDERS</a>
                        <a href="../index/index.php" class="hover:text-blue-200 transition">LOGOUT</a>
                        <a href="customer_view_cart.php" class="hover:text-blue-200 transition">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    <?php else: ?>
                        <a href="customer_login.php" class="hover:text-blue-200 transition">LOGIN</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Banner -->
    <div class="relative bg-gradient-to-r from-blue-800 to-indigo-900 py-20 text-center text-white">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-2">Our Story</h1>
            <div class="w-12 h-1 bg-white mx-auto mb-6"></div>
            <p class="text-lg max-w-2xl mx-auto">Discover the vision and values behind Shade Paradise</p>
        </div>
    </div>

    <!-- About Content -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden md:flex">
            <div class="md:flex-1 p-8 md:p-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Welcome to Shade Paradise</h2>
                
                <div class="prose prose-lg text-gray-600">
                    <p class="mb-4">
                        At Shade Paradise, we're passionate about eyewear that combines style, quality, and protection.
                        Founded with a mission to provide premium sunglasses at accessible prices, we've carefully curated
                        collections that cater to diverse tastes and occasions.
                    </p>
                    
                    <p class="mb-4">
                        Our sunglasses aren't just accessories; they're statements. Each pair is selected for its 
                        exceptional craftsmanship, UV protection capabilities, and fashion-forward design. Whether you're
                        looking for classic styles or the latest trends, we have something for everyone.
                    </p>
                    
                    <p class="mb-6">
                        We believe that quality eyewear should be accessible to all, which is why we work directly with 
                        manufacturers to bring you exceptional value without compromising on quality. Every pair meets 
                        our rigorous standards for durability, comfort, and style.
                    </p>
                    
                    <div class="mt-8 text-center">
                        <a href="shop.php" class="inline-block bg-blue-600 text-white font-bold px-8 py-3 rounded-full hover:bg-blue-700 transition transform hover:-translate-y-1">
                            Explore Our Collection
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Our Values</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-gem text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Quality</h3>
                    <p class="text-gray-600">We never compromise on materials, design, or construction, ensuring every pair exceeds expectations.</p>
                </div>
                
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-leaf text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Sustainability</h3>
                    <p class="text-gray-600">We're committed to reducing our environmental impact through responsible sourcing and packaging.</p>
                </div>
                
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Customer Focus</h3>
                    <p class="text-gray-600">Your satisfaction is our priority, from product selection to after-sales service.</p>
                </div>
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
                        <li><a href="<?= $isLoggedIn ? 'customer_index.php' : '../index.php' ?>" class="text-gray-400 hover:text-white transition">Home</a></li>
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
