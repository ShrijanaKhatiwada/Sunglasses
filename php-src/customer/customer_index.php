<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if user is logged in
if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    header('Location: ../index.php');
    exit;
}
$user_name = $_SESSION['users_name'] ?? 'Customer';
$page_title = "Welcome - Shade Paradise";
include '../includes/header.php';
?>

<!-- Hero section -->
<div class="relative h-[85vh]">
    <div class="absolute inset-0">
        <img src="../images/header.jpg" alt="" class="w-full h-full object-cover brightness-75">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-blue-900/40 to-black/20"></div>
    </div>
    
    <div class="relative z-10">
        <!-- Welcome message -->
        <div class="container mx-auto px-6 md:px-12 pt-16 md:pt-24 pb-32 md:pb-40">
            <div class="max-w-3xl mx-auto text-center">
                <p class="text-blue-300 text-lg mb-3 animate__animated animate__fadeIn">Welcome back, <?php echo htmlspecialchars($user_name); ?></p>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-playfair font-bold text-white mb-6 animate__animated animate__fadeIn">
                    Discover Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Style</span>
                </h1>
                <p class="text-xl text-gray-200 mb-8 font-montserrat animate__animated animate__fadeIn" style="animation-delay: 0.3s">
                    Shop our premium collection and elevate your look with luxury eyewear.
                </p>
                <div class="animate__animated animate__fadeIn" style="animation-delay: 0.6s">
                    <a href="shop.php" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 text-white text-center font-semibold uppercase tracking-wider inline-block">
                        Shop Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Us section -->
<div class="container mx-auto px-6 md:px-12 py-24">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="md:w-1/2 mb-12 md:mb-0 md:pr-12 slide-in-left">
            <h2 class="text-3xl md:text-4xl font-playfair font-bold mb-6">
                <span class="bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text text-transparent">
                    A few words about us
                </span>
            </h2>
            <p class="text-gray-600 mb-6 font-montserrat leading-relaxed">
                At Shade Paradise, we offer a curated selection of stylish and high-quality sunglasses 
                to suit every taste and occasion. Our premium eyewear combines fashion-forward design 
                with superior UV protection, ensuring you look fantastic while keeping your eyes safe.
            </p>
            <a href="about_us.php" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 text-white text-center font-semibold uppercase tracking-wider">
                Read More
            </a>
        </div>
        <div class="md:w-1/2 grid grid-cols-2 gap-6 slide-in-right">
            <div class="overflow-hidden rounded-lg h-72 shadow-lg about-image">
                <img src="../images/ronaldo.jpg" alt="Image 1" class="w-full h-full object-cover transform hover:scale-110 transition duration-700">
            </div>
            <div class="overflow-hidden rounded-lg h-72 shadow-lg about-image">
                <img src="../images/glasses.jpg" alt="Image 2" class="w-full h-full object-cover transform hover:scale-110 transition duration-700">
            </div>
        </div>
    </div>
</div>

<!-- Feature Banner -->
<div class="relative py-32 parallax-bg">
    <img src="../images/desktop-wallpaper-eyewear.jpg" alt="" class="w-full h-[500px] object-cover brightness-50">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-900/70 to-purple-900/60"></div>
    <div class="absolute inset-0 flex items-center">
        <div class="container mx-auto px-6 md:px-12">
            <div class="max-w-2xl feature-banner-content">
                <h2 class="text-4xl md:text-5xl font-playfair font-bold text-white mb-6">
                    Be different <br>in your own way!
                </h2>
                <p class="text-white text-lg mb-8 max-w-lg">
                    Our exclusive collection features premium designs that help you stand out and make a statement.
                </p>
                <a href="shop.php" class="px-8 py-3 bg-white text-gray-900 font-bold rounded-full hover:bg-gray-100 transition transform hover:-translate-y-1 inline-block shadow-lg">
                    Explore Collection
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Service Features -->
<div class="container mx-auto px-6 md:px-12 py-24">
    <h2 class="text-3xl md:text-4xl font-playfair font-bold text-center mb-16">
        <span class="relative">
            <span class="bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text text-transparent">
                Our Services
            </span>
            <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500"></span>
        </span>
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 feature-cards">
        <div class="bg-white p-8 rounded-xl shadow-md text-center hover-scale hover-shadow service-card">
            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500/30 to-purple-500/30 flex items-center justify-center">
                <img class="w-10 h-10 object-contain" src="../images/delivery.webp" alt="Delivery">
            </div>
            <h3 class="text-xl font-bold mb-4">Fast Delivery</h3>
            <p class="text-gray-600">
                "Enjoy fast and safe delivery with every order, ensuring your products
                arrive quickly and securely right to your doorstep."
            </p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-md text-center hover-scale hover-shadow service-card">
            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500/30 to-purple-500/30 flex items-center justify-center">
                <img class="w-10 h-10 object-contain" src="../images/shopping.jpg" alt="Shopping">
            </div>
            <h3 class="text-xl font-bold mb-4">Easy Shopping</h3>
            <p class="text-gray-600">
                "Discover the ease of online shopping with a wide selection of products available
                at your fingertips, anytime and anywhere."
            </p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-md text-center hover-scale hover-shadow service-card">
            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500/30 to-purple-500/30 flex items-center justify-center">
                <img class="w-10 h-10 object-contain" src="../images/payment.jpg" alt="Payment">
            </div>
            <h3 class="text-xl font-bold mb-4">Secure Payment</h3>
            <p class="text-gray-600">
                "Experience secure and convenient online payment options, making your transactions
                smooth and worry-free."
            </p>
        </div>
    </div>
</div>

<!-- Featured Products -->
<div class="bg-gray-50 py-24">
    <div class="container mx-auto px-6 md:px-12">
        <h2 class="text-3xl md:text-4xl font-playfair font-bold text-center mb-16">
            <span class="relative">
                <span class="bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text text-transparent">
                    Featured Products
                </span>
                <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500"></span>
            </span>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 product-cards">
            <!-- Product 1 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover-scale hover-shadow product-card">
                <div class="h-56 bg-gray-200 flex items-center justify-center relative overflow-hidden">
                    <i class="fas fa-glasses text-gray-400 text-5xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-1">Premium Aviator</h3>
                    <p class="text-gray-600 text-sm mb-3">Classic style for everyday</p>
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-blue-600">Rs. 2,500</p>
                        <a href="product_details.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover-scale hover-shadow product-card">
                <div class="h-56 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-glasses text-gray-400 text-5xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-1">Urban Wayfarer</h3>
                    <p class="text-gray-600 text-sm mb-3">Modern and stylish</p>
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-blue-600">Rs. 1,800</p>
                        <a href="product_details.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            <!-- Product 3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover-scale hover-shadow product-card">
                <div class="h-56 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-glasses text-gray-400 text-5xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-1">Sport Elite</h3>
                    <p class="text-gray-600 text-sm mb-3">Perfect for active lifestyle</p>
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-blue-600">Rs. 3,200</p>
                        <a href="product_details.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            <!-- Product 4 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover-scale hover-shadow product-card">
                <div class="h-56 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-glasses text-gray-400 text-5xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg text-gray-800 mb-1">Designer Round</h3>
                    <p class="text-gray-600 text-sm mb-3">Elegant and sophisticated</p>
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-blue-600">Rs. 2,850</p>
                        <a href="product_details.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
    // Mobile menu functionality
    const menuToggle = document.getElementById('menu-toggle');
    const closeMenu = document.getElementById('close-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    
    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('translate-x-full');
    });
    
    closeMenu.addEventListener('click', () => {
        mobileMenu.classList.add('translate-x-full');
    });

    // GSAP animations
    gsap.registerPlugin(ScrollTrigger);
    
    // About section animations
    gsap.from('.slide-in-left', {
        x: -100,
        opacity: 0,
        duration: 1,
        scrollTrigger: {
            trigger: '.slide-in-left',
            start: "top bottom-=100",
            toggleActions: "play none none none"
        }
    });
    
    gsap.from('.slide-in-right', {
        x: 100,
        opacity: 0,
        duration: 1,
        scrollTrigger: {
            trigger: '.slide-in-right',
            start: "top bottom-=100",
            toggleActions: "play none none none"
        }
    });
    
    // Feature banner parallax effect
    gsap.to(".parallax-bg", {
        backgroundPosition: "50% 30%",
        ease: "none",
        scrollTrigger: {
            trigger: ".parallax-bg",
            start: "top bottom",
            end: "bottom top",
            scrub: true
        }
    });

    // Feature banner content animation
    gsap.from(".feature-banner-content", {
        y: 50,
        opacity: 0,
        duration: 1,
        scrollTrigger: {
            trigger: ".feature-banner-content",
            start: "top bottom-=100",
            toggleActions: "play none none none"
        }
    });

    // Service cards animation
    gsap.utils.toArray('.service-card').forEach((card, i) => {
        gsap.from(card, {
            y: 50,
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

    // Product cards animation
    gsap.utils.toArray('.product-card').forEach((card, i) => {
        gsap.from(card, {
            y: 50,
            opacity: 0,
            duration: 0.8,
            scrollTrigger: {
                trigger: card,
                start: "top bottom-=100",
                toggleActions: "play none none none"
            },
            delay: i * 0.1
        });
    });

    // About images animation
    gsap.utils.toArray('.about-image').forEach((image, i) => {
        gsap.from(image, {
            y: 30,
            opacity: 0,
            duration: 0.8,
            scrollTrigger: {
                trigger: image,
                start: "top bottom-=100",
                toggleActions: "play none none none"
            },
            delay: i * 0.2 + 0.5
        });
    });
</script>
