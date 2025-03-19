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
    <title>Contact Us - Shade Paradise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans min-h-screen">
    <!-- Mobile Menu Toggle -->
    <div class="sm:hidden fixed bottom-4 right-4 z-50">
        <button id="mobile-menu-toggle" class="bg-blue-600 text-white p-3 rounded-full shadow-lg">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="fixed inset-0 bg-gray-900 bg-opacity-95 z-40 transform translate-x-full transition-transform duration-300 sm:hidden">
        <div class="flex flex-col h-full justify-center items-center">
            <button id="close-menu" class="absolute top-4 right-4 text-white text-2xl">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="flex flex-col items-center space-y-6 text-xl">
                <a href="<?= $isLoggedIn ? 'customer_index.php' : '../index.php' ?>" class="text-white hover:text-blue-300 transition">HOME</a>
                <a href="shop.php" class="text-white hover:text-blue-300 transition">SHOP</a>
                <a href="men.php" class="text-white hover:text-blue-300 transition">MEN</a>
                <a href="women.php" class="text-white hover:text-blue-300 transition">WOMEN</a>
                <a href="customer_about.php" class="text-white hover:text-blue-300 transition">ABOUT</a>
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
                        <img src="../images/sunglasses.png" alt="Shade Paradise" class="h-10">
                    </a>
                    <span class="text-xl font-bold">Shade Paradise</span>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="<?= $isLoggedIn ? 'customer_index.php' : '../index.php' ?>" class="hover:text-blue-200 transition">HOME</a>
                    <a href="shop.php" class="hover:text-blue-200 transition">SHOP</a>
                    <a href="men.php" class="hover:text-blue-200 transition">MEN</a>
                    <a href="women.php" class="hover:text-blue-200 transition">WOMEN</a>
                    <a href="about_us.php" class="hover:text-blue-200 transition">ABOUT</a>
                    <a href="customer_contact.php" class="border-b-2 border-white hover:text-blue-200 transition">CONTACT</a>
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
    <div class="bg-gradient-to-r from-blue-600 to-indigo-800 py-12 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-2">Contact Us</h1>
            <div class="w-16 h-1 bg-white mx-auto mb-4"></div>
            <p class="text-lg max-w-2xl mx-auto">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>
    </div>

    <!-- Contact Form & Info -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden md:flex">
            <!-- Left side (form) -->
            <div class="md:w-2/3 p-8 md:p-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Send us a message</h2>
                
                <form id="contactForm" action="submit_contact.php" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" id="name" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>
                    
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <input type="text" id="address" name="address" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" id="phone" name="phone" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold py-3 px-6 rounded-md hover:from-blue-700 hover:to-blue-900 transition transform hover:-translate-y-1 shadow-md">
                        Send Message
                    </button>
                </form>
            </div>
            
            <!-- Right side (contact info) -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 md:w-1/3 p-8 md:p-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Contact Information</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-map-marker-alt text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Address</h3>
                            <p class="text-gray-600 mt-1">Kathmandu, Kalanki</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-phone text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Phone</h3>
                            <p class="text-gray-600 mt-1">9863588150</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <i class="fas fa-envelope text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Email</h3>
                            <p class="text-gray-600 mt-1">shrijanakhatiwada88@gmail.com</p>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="bg-pink-600 text-white p-2 rounded-full hover:bg-pink-700 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="bg-blue-400 text-white p-2 rounded-full hover:bg-blue-500 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 bg-gray-100 border-b">
                <h2 class="text-2xl font-bold text-gray-800">Find Us</h2>
            </div>
            <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                <!-- Replace with actual map integration if needed -->
                <div class="flex items-center justify-center h-64 bg-gray-200">
                    <p class="text-gray-500">Map location will be displayed here</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-10 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="text-xl font-bold mb-4">Shade Paradise</h4>
                    <p class="text-gray-400">Premium eyewear for every style and occasion.</p>
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
                    <p class="text-gray-400">Email: shrijanakhatiwada88@gmail.com</p>
                    <p class="text-gray-400">Phone: 9863588150</p>
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

        // Form submission handling
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('contactForm');
            
            contactForm.addEventListener('submit', function(event) {
                event.preventDefault();
                
                alert('Thank you for contacting us. We will get back to you soon!');
                
                contactForm.reset();
                
                setTimeout(() => {
                    window.location.href = 'customer_index.php';
                }, 1000);
            });
        });
    </script>
</body>
</html>
