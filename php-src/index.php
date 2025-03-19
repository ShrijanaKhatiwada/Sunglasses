<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['is_login']) && $_SESSION['is_login'] === true;

// Redirect to appropriate page based on login status
if ($isLoggedIn) {
    header("Location: customer/customer_index.php");
    exit();
}

// Database connection
include 'connection.php';

// Debug database connection
echo "<p style='display:none;'>Connection variables: Host: $host, User: $username, DB: $database</p>";
if (isset($conn->connect_error)) {
    echo "<p style='display:none;'>Connection error: " . $conn->connect_error . "</p>";
}

// Fetch products with column check
$sql = "SHOW COLUMNS FROM product";
$columnResult = mysqli_query($conn, $sql);
$columns = [];
if ($columnResult) {
    while ($row = mysqli_fetch_assoc($columnResult)) {
        $columns[] = $row['Field'];
    }
    echo "<p style='display:none;'>Columns in product table: " . implode(", ", $columns) . "</p>";
}

// Now get the products with proper column names
$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
$products = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    echo "<p style='display:none;'>Found " . count($products) . " products</p>";
    if (count($products) > 0) {
        echo "<p style='display:none;'>First product keys: " . implode(", ", array_keys($products[0])) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shade Paradise | Premium Eyewear</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <style>
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
        .font-montserrat {
            font-family: 'Montserrat', sans-serif;
        }
        .slide-in-left {
            animation: slide-in-left 0.8s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }
        .slide-in-right {
            animation: slide-in-right 0.8s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }
        @keyframes slide-in-left {
            0% {
                transform: translateX(-100px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slide-in-right {
            0% {
                transform: translateX(100px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, 15px); }
            100% { transform: translate(0, 0px); }
        }
        .bg-blur {
            backdrop-filter: blur(8px);
        }
        .text-shadow {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }
        .custom-cursor {
            cursor: none;
        }
        #cursor {
            position: fixed;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: white;
            transition: 0.1s;
            transform: translate(-50%, -50%);
            pointer-events: none;
            mix-blend-mode: difference;
            z-index: 9999;
        }
        #cursor-border {
            position: fixed;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transform: translate(-50%, -50%);
            transition: 0.15s;
            pointer-events: none;
            z-index: 9998;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
        }
    </style>
</head>
<body class="bg-black text-white font-montserrat custom-cursor overflow-x-hidden">
    <div id="cursor"></div>
    <div id="cursor-border"></div>

    <!-- Parallax Background -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900/70 to-black/70 z-10"></div>
        <video autoplay muted loop class="absolute w-full h-full object-cover opacity-40">
            <source src="videos/sunglasses-bg.mp4" type="video/mp4">
            <!-- Fallback image if video doesn't load -->
            <img src="images/header.jpg" alt="Luxury Eyewear" class="absolute w-full h-full object-cover">
        </video>
    </div>

    <!-- Header -->
    <header class="pt-6 px-6 md:px-12 relative z-20">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="images/sunglasses.png" alt="Shade Paradise" class="h-12 animate__animated animate__fadeIn">
                <h1 class="ml-4 text-2xl font-playfair font-bold tracking-wider animate__animated animate__fadeIn">SHADE PARADISE</h1>
            </div>
            <div class="flex space-x-6 items-center">
                <a href="customer/customer_login.php" class="hidden md:block px-6 py-2 border border-white/30 rounded-full hover:bg-white hover:text-black transition-all duration-300 text-sm uppercase tracking-wider">Login</a>
                <a href="customer/customer_register.php" class="hidden md:block px-6 py-2 bg-white text-black rounded-full hover:bg-opacity-80 transition-all duration-300 text-sm uppercase tracking-wider">Register</a>
                <button id="menu-toggle" class="md:hidden text-2xl">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-95 z-40 transform translate-y-full transition-transform duration-500 flex flex-col justify-center items-center">
        <button id="close-menu" class="absolute top-6 right-6 text-2xl">
            <i class="fa fa-times"></i>
        </button>
        <div class="flex flex-col items-center space-y-8">
            <div class="mb-8">
                <img src="images/sunglasses.png" alt="Shade Paradise" class="h-16 mx-auto">
                <h2 class="text-center text-2xl font-playfair font-bold mt-4">SHADE PARADISE</h2>
            </div>
            <a href="customer/customer_login.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">Login</a>
            <a href="customer/customer_register.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">Register</a>
        </div>
    </div>

    <!-- Main Hero Section -->
    <main class="relative z-10 min-h-[90vh] flex items-center">
        <div class="container mx-auto px-6 md:px-12 py-20 flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-12 md:mb-0">
                <h1 class="text-4xl md:text-5xl lg:text-7xl font-playfair font-bold mb-6 leading-tight slide-in-left">
                    Elevate Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Vision</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-lg slide-in-left" style="animation-delay: 0.3s">
                    Discover our premium collection of luxury eyewear that defines style and protects with purpose.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 slide-in-left" style="animation-delay: 0.6s">
                    <a href="customer/customer_login.php" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 text-center font-semibold uppercase tracking-wider">
                        Sign In
                    </a>
                    <a href="customer/customer_register.php" class="px-8 py-3 border border-white/30 rounded-full hover:bg-white hover:text-black transition-all duration-300 text-center font-semibold uppercase tracking-wider">
                        Register
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center relative slide-in-right">
                <div class="w-64 h-64 rounded-full bg-gradient-to-tr from-blue-500/20 to-purple-500/20 absolute blur-3xl"></div>
                <img src="images/hero-glasses.png" alt="Premium Sunglasses" class="relative z-10 max-w-[80%] floating">
            </div>
        </div>
    </main>

    <!-- Featured Collections (Visual Only) -->
    <section class="py-20 relative z-10">
        <div class="container mx-auto px-6 md:px-12">
            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-center mb-16 animate__animated animate__fadeIn">
                <span class="relative">
                    Featured Collections
                    <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                </span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass-card p-6 transform transition-all duration-300 hover:scale-105 collection-card">
                    <div class="h-64 overflow-hidden rounded-lg mb-6">
                        <img src="images/men-category.jpg" alt="Men's Collection" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-playfair font-bold mb-2">Men's Collection</h3>
                    <p class="text-gray-400 mb-4">Bold designs for the modern gentleman.</p>
                    <a href="customer/customer_login.php" class="text-sm uppercase tracking-wider text-blue-400 hover:text-blue-300 transition-colors flex items-center">
                        <span>Discover</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                <div class="glass-card p-6 transform transition-all duration-300 hover:scale-105 collection-card">
                    <div class="h-64 overflow-hidden rounded-lg mb-6">
                        <img src="images/women-category.jpg" alt="Women's Collection" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-playfair font-bold mb-2">Women's Collection</h3>
                    <p class="text-gray-400 mb-4">Elegant frames for the fashionable woman.</p>
                    <a href="customer/customer_login.php" class="text-sm uppercase tracking-wider text-blue-400 hover:text-blue-300 transition-colors flex items-center">
                        <span>Discover</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                <div class="glass-card p-6 transform transition-all duration-300 hover:scale-105 collection-card">
                    <div class="h-64 overflow-hidden rounded-lg mb-6">
                        <img src="images/glasses.jpg" alt="Premium Selection" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-playfair font-bold mb-2">Premium Selection</h3>
                    <p class="text-gray-400 mb-4">Luxury eyewear for the discerning customer.</p>
                    <a href="customer/customer_login.php" class="text-sm uppercase tracking-wider text-blue-400 hover:text-blue-300 transition-colors flex items-center">
                        <span>Discover</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Features -->
    <section class="py-20 relative z-10 overflow-hidden">
        <div class="container mx-auto px-6 md:px-12">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-playfair font-bold mb-6 animate__animated animate__fadeIn">Why Choose Shade Paradise</h2>
                <p class="text-gray-400 max-w-2xl mx-auto animate__animated animate__fadeIn">Exceptional quality and design for those who appreciate the finer things in life.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 feature-cards">
                <div class="text-center feature-card">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500/30 to-purple-500/30 flex items-center justify-center">
                        <i class="fas fa-certificate text-3xl text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Premium Quality</h3>
                    <p class="text-gray-400">Crafted from high-quality materials ensuring durability and comfort for everyday wear.</p>
                </div>
                <div class="text-center feature-card">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500/30 to-purple-500/30 flex items-center justify-center">
                        <i class="fas fa-shield-alt text-3xl text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">UV Protection</h3>
                    <p class="text-gray-400">100% UV protection, keeping your eyes safe while you enjoy the sun in style.</p>
                </div>
                <div class="text-center feature-card">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500/30 to-purple-500/30 flex items-center justify-center">
                        <i class="fas fa-star text-3xl text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Unique Designs</h3>
                    <p class="text-gray-400">Bold and elegant collections designed to make you stand out from the crowd.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials with parallax effect -->
    <section class="py-20 relative z-10">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
        <div class="container mx-auto px-6 md:px-12 relative z-10">
            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-center mb-16 animate__animated animate__fadeIn">What Our Customers Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 testimonial-cards">
                <div class="glass-card p-8 testimonial-card">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center text-lg font-bold mr-4">S</div>
                        <div>
                            <h4 class="font-bold">Sarah K.</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic text-gray-300">"The quality of these sunglasses is exceptional. I've received so many compliments!"</p>
                </div>
                <div class="glass-card p-8 testimonial-card">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center text-lg font-bold mr-4">M</div>
                        <div>
                            <h4 class="font-bold">Michael T.</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic text-gray-300">"Perfect fit and amazing design. These are now my go-to sunglasses for all occasions."</p>
                </div>
                <div class="glass-card p-8 testimonial-card">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center text-lg font-bold mr-4">L</div>
                        <div>
                            <h4 class="font-bold">Lisa J.</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic text-gray-300">"The customer service was outstanding, and my sunglasses arrived earlier than expected!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 relative z-10">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h2 class="text-3xl md:text-4xl font-playfair font-bold mb-6 animate__animated animate__fadeIn">Join Our Community</h2>
            <p class="text-gray-300 max-w-2xl mx-auto mb-10 animate__animated animate__fadeIn">
                Create an account today to explore our exclusive collections and enjoy personalized recommendations.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6 animate__animated animate__fadeIn">
                <a href="customer/customer_login.php" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 text-center font-semibold uppercase tracking-wider">
                    Sign In
                </a>
                <a href="customer/customer_register.php" class="px-8 py-3 border border-white/30 rounded-full hover:bg-white hover:text-black transition-all duration-300 text-center font-semibold uppercase tracking-wider">
                    Register
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-20 relative z-10">
        <div class="container mx-auto px-6 md:px-12">
            <h2 class="text-3xl md:text-4xl font-playfair font-bold text-center mb-16 animate__animated animate__fadeIn">
                <span class="relative">
                    Our Premium Collection
                    <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500"></span>
                </span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 product-cards">
                <?php if (count($products) > 0) : ?>
                    <?php foreach ($products as $product) : ?>
                        <a href="customer/customer_login.php" class="block glass-card overflow-hidden transform transition-all duration-300 hover:scale-105 product-card">
                            <div class="h-56 overflow-hidden">
                                <?php if (isset($product['image']) && !empty($product['image'])) : ?>
                                    <img src="<?php echo 'admin/uploads/' . $product['image']; ?>" alt="<?php echo isset($product['brand']) ? htmlspecialchars($product['brand']) : 'Sunglasses'; ?>" class="w-full h-full object-cover">
                                <?php else : ?>
                                    <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                        <i class="fas fa-glasses text-4xl text-gray-600"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-playfair font-bold mb-1"><?php echo isset($product['brand']) ? htmlspecialchars($product['brand']) : 'Premium Sunglasses'; ?></h3>
                                <p class="text-gray-400 text-sm mb-2"><?php echo isset($product['color']) ? htmlspecialchars($product['color']) : 'Classic Style'; ?></p>
                                <div class="flex items-center justify-between">
                                    <p class="font-bold text-blue-400">Rs. <?php echo isset($product['price']) ? number_format($product['price']) : '2,500'; ?></p>
                                    <span class="text-sm uppercase tracking-wider text-white/80 hover:text-white transition-colors flex items-center">
                                        View Details <i class="fas fa-arrow-right ml-2"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <!-- Fallback if no products in database -->
                    <?php for ($i = 1; $i <= 8; $i++) : ?>
                        <a href="customer/customer_login.php" class="block glass-card overflow-hidden transform transition-all duration-300 hover:scale-105 product-card">
                            <div class="h-56 overflow-hidden bg-gray-800 flex items-center justify-center">
                                <i class="fas fa-glasses text-4xl text-gray-600"></i>
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-playfair font-bold mb-1">Premium Sunglasses</h3>
                                <p class="text-gray-400 text-sm mb-2">Classic Style</p>
                                <div class="flex items-center justify-between">
                                    <p class="font-bold text-blue-400">Rs. 2,500</p>
                                    <span class="text-sm uppercase tracking-wider text-white/80 hover:text-white transition-colors flex items-center">
                                        View Details <i class="fas fa-arrow-right ml-2"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 relative z-10 border-t border-white/10">
        <div class="container mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <div class="flex items-center mb-6">
                        <img src="images/sunglasses.png" alt="Shade Paradise" class="h-10 mr-3">
                        <h3 class="text-xl font-playfair font-bold">SHADE PARADISE</h3>
                    </div>
                    <p class="text-gray-400 mb-6">Premium eyewear that combines style, comfort, and protection.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-black transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-black transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-black transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="customer/customer_login.php" class="text-gray-400 hover:text-white transition-colors">Login</a></li>
                        <li><a href="customer/customer_register.php" class="text-gray-400 hover:text-white transition-colors">Register</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-6">Contact Us</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-blue-400"></i>
                            <span>shrijanakhatiwada88@gmail.com</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3 text-blue-400"></i>
                            <span>9863588150</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-400"></i>
                            <span>Kathmandu, Kalanki</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-white/10 text-center">
                <p class="text-gray-500">&copy; 2024 Shade Paradise. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Custom cursor
        const cursor = document.getElementById('cursor');
        const cursorBorder = document.getElementById('cursor-border');
        const links = document.querySelectorAll('a, button');

        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
            cursorBorder.style.left = e.clientX + 'px';
            cursorBorder.style.top = e.clientY + 'px';
        });

        links.forEach(link => {
            link.addEventListener('mouseenter', () => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1.5)';
                cursorBorder.style.transform = 'translate(-50%, -50%) scale(1.5)';
                cursorBorder.style.borderColor = 'rgba(255, 255, 255, 0.8)';
            });
            
            link.addEventListener('mouseleave', () => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1)';
                cursorBorder.style.transform = 'translate(-50%, -50%) scale(1)';
                cursorBorder.style.borderColor = 'rgba(255, 255, 255, 0.5)';
            });
        });

        // Mobile menu functionality
        const menuToggle = document.getElementById('menu-toggle');
        const closeMenu = document.getElementById('close-menu');
        const mobileMenu = document.getElementById('mobile-menu');
        
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('translate-y-full');
        });
        
        closeMenu.addEventListener('click', () => {
            mobileMenu.classList.add('translate-y-full');
        });

        // GSAP animations
        gsap.registerPlugin(ScrollTrigger);
        
        // Animate collections on scroll
        gsap.utils.toArray('.collection-card').forEach((card, i) => {
            gsap.from(card, {
                y: 100,
                opacity: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: card,
                    start: "top bottom-=100",
                    toggleActions: "play none none none"
                },
                delay: i * 0.2
            });
        });

        // Animate features on scroll
        gsap.utils.toArray('.feature-card').forEach((card, i) => {
            gsap.from(card, {
                y: 80,
                opacity: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: card,
                    start: "top bottom-=100",
                    toggleActions: "play none none none"
                },
                delay: i * 0.2
            });
        });

        // Animate testimonials on scroll
        gsap.utils.toArray('.testimonial-card').forEach((card, i) => {
            gsap.from(card, {
                x: i % 2 === 0 ? -100 : 100,
                opacity: 0,
                duration: 0.8,
                scrollTrigger: {
                    trigger: card,
                    start: "top bottom-=100",
                    toggleActions: "play none none none"
                },
                delay: i * 0.2
            });
        });

        // Parallax effect on scroll
        gsap.to(".parallax-bg", {
            backgroundPosition: "50% 100%",
            ease: "none",
            scrollTrigger: {
                trigger: ".parallax-bg",
                start: "top bottom",
                end: "bottom top",
                scrub: true
            }
        });
    </script>
</body>
</html>
