<!-- Mobile Navigation Menu (Hidden by default) -->
<div id="mobile-menu" class="fixed inset-0 bg-gray-900 bg-opacity-95 z-40 transform translate-x-full transition-transform duration-300 sm:hidden">
    <div class="flex flex-col h-full justify-center items-center">
        <button id="close-menu" class="absolute top-4 right-4 text-white text-2xl">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="flex flex-col items-center space-y-6 text-xl">
            <a href="customer_index.php" class="text-white hover:text-primary-300 transition">HOME</a>
            <a href="shop.php" class="text-white hover:text-primary-300 transition">SHOP</a>
            <a href="men.php" class="text-white hover:text-primary-300 transition font-bold">MEN</a>
            <a href="women.php" class="text-white hover:text-primary-300 transition">WOMEN</a>
            <a href="customer_contact.php" class="text-white hover:text-primary-300 transition">CONTACT</a>
            <a href="order.php" class="text-white hover:text-primary-300 transition">ORDERS</a>
            <a href="../logout.php" class="text-white hover:text-primary-300 transition">LOGOUT</a>
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
                <a href="men.php" class="border-b-2 border-white hover:text-primary-200 transition font-semibold">MEN</a>
                <a href="women.php" class="hover:text-primary-200 transition">WOMEN</a>
                <a href="customer_contact.php" class="hover:text-primary-200 transition">CONTACT</a>
                <a href="order.php" class="hover:text-primary-200 transition">ORDERS</a>
                <a href="../logout.php" class="hover:text-primary-200 transition">LOGOUT</a>
                <a href="customer_view_cart.php" class="hover:text-primary-200 transition">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </div>
</nav> 