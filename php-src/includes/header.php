<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['is_login']) && $_SESSION['is_login'] === true;
$user_name = $_SESSION['users_name'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Shade Paradise'; ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gray-100 font-montserrat overflow-x-hidden">
    <!-- Mobile Menu Toggle -->
    <div class="sm:hidden fixed bottom-4 right-4 z-50">
        <button id="mobile-menu-toggle" class="bg-blue-600 text-white p-3 rounded-full shadow-lg hover-scale">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="fixed inset-0 bg-blue-900 bg-opacity-95 z-40 transform translate-x-full transition-transform duration-300 sm:hidden">
        <div class="flex flex-col h-full justify-center items-center">
            <button id="close-menu" class="absolute top-6 right-6 text-white text-2xl">
                <i class="fas fa-times"></i>
            </button>
            <div class="flex flex-col items-center space-y-8">
                <div class="mb-8">
                    <img src="../images/sunglasses.png" alt="Shade Paradise" class="h-16 mx-auto">
                    <h2 class="text-center text-2xl font-playfair font-bold mt-4">SHADE PARADISE</h2>
                </div>
                <a href="customer_index.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">HOME</a>
                <a href="shop.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">SHOP</a>
                <a href="men.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">MEN</a>
                <a href="women.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">WOMEN</a>
                <a href="about_us.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">ABOUT</a>
                <a href="customer_contact.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">CONTACT</a>
                <?php if ($is_logged_in): ?>
                    <a href="order.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">ORDERS</a>
                    <a href="../logout.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">LOGOUT</a>
                    <a href="customer_view_cart.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">
                        <i class="fas fa-shopping-cart"></i> CART
                    </a>
                <?php else: ?>
                    <a href="../index.php" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">LOGIN</a>
                    <a href="../index.php#register" class="text-xl uppercase tracking-widest border-b border-transparent hover:border-white pb-1 transition-all">REGISTER</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="py-6 px-6 md:px-12">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="../images/sunglasses.png" alt="Shade Paradise" class="h-12 animate__animated animate__fadeIn">
                <h1 class="ml-4 text-2xl font-playfair font-bold tracking-wider text-gray-900 animate__animated animate__fadeIn">SHADE PARADISE</h1>
            </div>
            <div class="hidden md:flex space-x-6 items-center">
                <a href="customer_index.php" class="text-gray-900 hover:text-blue-600 transition navbar-item">HOME</a>
                <a href="shop.php" class="text-gray-900 hover:text-blue-600 transition navbar-item">SHOP</a>
                <a href="men.php" class="text-gray-900 hover:text-blue-600 transition navbar-item">MEN</a>
                <a href="women.php" class="text-gray-900 hover:text-blue-600 transition navbar-item">WOMEN</a>
                <a href="about_us.php" class="text-gray-900 hover:text-blue-600 transition navbar-item">ABOUT</a>
                <a href="customer_contact.php" class="text-gray-900 hover:text-blue-600 transition navbar-item">CONTACT</a>
                <?php if ($is_logged_in): ?>
                    <a href="order.php" class="text-gray-900 hover:text-blue-600 transition navbar-item">ORDERS</a>
                    <a href="../logout.php" class="text-gray-900 hover:text-blue-600 transition navbar-item">LOGOUT</a>
                    <a href="customer_view_cart.php" class="text-gray-900 hover:text-blue-600 transition navbar-item relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">0</span>
                    </a>
                <?php else: ?>
                    <a href="../index.php" class="text-gray-900 hover:text-blue-600 transition navbar-item">LOGIN</a>
                    <a href="../index.php#register" class="text-gray-900 hover:text-blue-600 transition navbar-item">REGISTER</a>
                <?php endif; ?>
            </div>
            <button id="menu-toggle" class="md:hidden text-gray-900 text-2xl">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </nav>
</body>
</html> 