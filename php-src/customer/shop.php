<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop for Men and Women - Shade Paradise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white py-4 sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <a href="#" class="mr-6"><img src="../images/sunglasses.png" alt="Sunglasses Logo" class="h-10"></a>
                </div>
                <div class="flex flex-wrap justify-center items-center space-x-0 md:space-x-6">
                    <a href="customer_index.php" class="px-3 py-2 hover:text-gray-300 transition">HOME</a>
                    <a href="customer_contact.php" class="px-3 py-2 hover:text-gray-300 transition">CONTACT</a>
                    <a href="order.php" class="px-3 py-2 hover:text-gray-300 transition">ORDERS</a>
                    <a href="customer_view_cart.php" class="px-3 py-2 hover:text-gray-300 transition">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative">
        <div class="h-80 overflow-hidden">
            <img src="../images/many-glasses.jpg" alt="Sunglasses collection" class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white text-center">Discover Your Style</h1>
            </div>
        </div>
    </div>

    <!-- Shop Categories -->
    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Men's Collection -->
            <div class="relative group overflow-hidden rounded-xl shadow-lg">
                <img src="../images/ronaldo.jpg" alt="Men's Collection" class="w-full h-96 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80">
                    <div class="absolute bottom-0 left-0 p-8 w-full">
                        <h2 class="text-3xl font-bold text-white mb-2">Shop for Men</h2>
                        <p class="text-gray-200 mb-6">Discover our exclusive men's collection with the latest trends.</p>
                        <a href="men.php" class="inline-block bg-white hover:bg-gray-100 text-gray-900 font-semibold px-6 py-3 rounded-full transition duration-300 transform group-hover:translate-y-0 translate-y-2">
                            Shop Men
                        </a>
                    </div>
                </div>
            </div>

            <!-- Women's Collection -->
            <div class="relative group overflow-hidden rounded-xl shadow-lg">
                <img src="../images/glasses.jpg" alt="Women's Collection" class="w-full h-96 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80">
                    <div class="absolute bottom-0 left-0 p-8 w-full">
                        <h2 class="text-3xl font-bold text-white mb-2">Shop for Women</h2>
                        <p class="text-gray-200 mb-6">Explore our stylish women's collection with the finest selections.</p>
                        <a href="women.php" class="inline-block bg-white hover:bg-gray-100 text-gray-900 font-semibold px-6 py-3 rounded-full transition duration-300 transform group-hover:translate-y-0 translate-y-2">
                            Shop Women
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-10 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="text-xl font-bold mb-4">Sunglasses</h4>
                    <p class="text-gray-400">Learn more about our company and values.</p>
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
                <p class="text-gray-400">&copy; 2024 ShadeParadise. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
