<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: customer_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: customer_index.php");
    exit();
}

$productId = $_GET['id'];
require_once '../connection.php';

// Fetch product data
$sql = "SELECT * FROM product WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $productId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$productData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $category = ($row['category_id'] == 1) ? 'Men' : 'Women';
    $productData[] = $row;
}

// Get current cart quantity
$cartSql = "SELECT quantity FROM cart WHERE product_id = ? AND customer_id = ?";
$stmt = mysqli_prepare($conn, $cartSql);
mysqli_stmt_bind_param($stmt, "ii", $productId, $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$cartResult = mysqli_stmt_get_result($stmt);
$currentCartQty = ($cartResult && $row = mysqli_fetch_assoc($cartResult)) ? $row['quantity'] : 0;

// Get total cart items
$totalCartSql = "SELECT SUM(quantity) as total FROM cart WHERE customer_id = ?";
$stmt = mysqli_prepare($conn, $totalCartSql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$totalCartResult = mysqli_stmt_get_result($stmt);
$totalCartItems = ($totalCartResult && $row = mysqli_fetch_assoc($totalCartResult)) ? $row['total'] : 0;

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Shade Paradise</title>
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
                <a href="customer_index.php" class="text-white hover:text-blue-300 transition">HOME</a>
                <a href="shop.php" class="text-white hover:text-blue-300 transition">SHOP</a>
                <a href="men.php" class="text-white hover:text-blue-300 transition">MEN</a>
                <a href="women.php" class="text-white hover:text-blue-300 transition">WOMEN</a>
                <a href="about_us.php" class="text-white hover:text-blue-300 transition">ABOUT</a>
                <a href="customer_contact.php" class="text-white hover:text-blue-300 transition">CONTACT</a>
                <a href="order.php" class="text-white hover:text-blue-300 transition">ORDERS</a>
                <a href="logout.php" class="text-white hover:text-blue-300 transition">LOGOUT</a>
                <a href="customer_view_cart.php" class="text-white hover:text-blue-300 transition flex items-center">
                    <span class="mr-2">CART</span>
                    <i class="fas fa-shopping-cart"></i>
                    <span class="ml-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                        <?php echo $totalCartItems ?: '0'; ?>
                    </span>
                </a>
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
                    <a href="customer_index.php" class="hover:text-blue-200 transition">HOME</a>
                    <a href="shop.php" class="hover:text-blue-200 transition">SHOP</a>
                    <a href="men.php" class="hover:text-blue-200 transition">MEN</a>
                    <a href="women.php" class="hover:text-blue-200 transition">WOMEN</a>
                    <a href="about_us.php" class="hover:text-blue-200 transition">ABOUT</a>
                    <a href="customer_contact.php" class="hover:text-blue-200 transition">CONTACT</a>
                    <a href="order.php" class="hover:text-blue-200 transition">ORDERS</a>
                    <a href="logout.php" class="hover:text-blue-200 transition">LOGOUT</a>
                    <a href="customer_view_cart.php" class="hover:text-blue-200 transition relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                            <?php echo $totalCartItems ?: '0'; ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-3">
        <div class="container mx-auto px-4">
            <div class="flex items-center text-sm text-gray-600">
                <a href="customer_index.php" class="hover:text-blue-600 transition">Home</a>
                <span class="mx-2">/</span>
                <a href="<?php echo strtolower($category); ?>.php" class="hover:text-blue-600 transition"><?php echo htmlspecialchars($category); ?></a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">Product Details</span>
            </div>
        </div>
    </div>

    <!-- Feedback Notification (hidden by default) -->
    <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg z-50 transform transition-all duration-300 opacity-0 translate-y-[-20px] hidden" id="add-to-cart-feedback">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>Added to cart</span>
        </div>
    </div>

    <!-- Product Detail Container -->
    <div class="container mx-auto px-4 py-12">
        <?php foreach ($productData as $product) { ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden md:flex">
                <!-- Product Image -->
                <div class="md:w-1/2 p-8 flex items-center justify-center bg-gray-50">
                    <img src="../admin/uploads/<?php echo htmlspecialchars($product['image']); ?>" 
                         alt="<?php echo htmlspecialchars($product['brand']); ?>" 
                         class="max-w-full max-h-[400px] object-contain rounded-lg shadow-md">
                </div>
                
                <!-- Product Details -->
                <div class="md:w-1/2 p-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        <?php echo htmlspecialchars($product['brand']); ?>
                    </h1>
                    
                    <div class="mb-6">
                        <div class="flex items-center text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="text-gray-600 text-sm ml-2">(4.5/5)</span>
                        </div>
                        
                        <div class="text-2xl font-bold text-blue-600 mb-4">
                            Rs. <?php echo number_format($product['price'], 2); ?>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-600 mb-1">
                            <span class="w-24 font-medium">Color:</span>
                            <span><?php echo htmlspecialchars($product['color']); ?></span>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-600 mb-1">
                            <span class="w-24 font-medium">Category:</span>
                            <span><?php echo htmlspecialchars($category); ?></span>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-600 mb-1">
                            <span class="w-24 font-medium">In Stock:</span>
                            <span class="<?php echo $product['quantity'] > 0 ? 'text-green-600' : 'text-red-600'; ?> font-medium">
                                <?php echo $product['quantity'] > 0 ? htmlspecialchars($product['quantity']) . ' units' : 'Out of stock'; ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Description</h3>
                        <p class="text-gray-600 mb-4">
                            <?php echo htmlspecialchars($product['description']); ?>
                        </p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <?php if ($product['quantity'] == 0) { ?>
                            <button class="w-full bg-gray-300 text-gray-700 py-3 px-6 rounded-md font-bold cursor-not-allowed" disabled>
                                Out of Stock
                            </button>
                        <?php } else { ?>
                            <button class="add-to-cart w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-md font-bold transition transform hover:-translate-y-1 shadow-md flex items-center justify-center"
                                    data-product-id="<?php echo $product['id']; ?>" 
                                    data-user-id="<?php echo $_SESSION['user_id']; ?>">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Add to Cart
                                <?php if ($currentCartQty > 0) { ?>
                                    <span class="ml-2 bg-white text-blue-600 rounded-full px-2 py-0.5 text-xs font-bold">
                                        <?php echo $currentCartQty; ?> in cart
                                    </span>
                                <?php } ?>
                            </button>
                        <?php } ?>
                        
                        <a href="<?php echo strtolower($category); ?>.php" class="block text-center w-full bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 px-6 rounded-md font-bold transition">
                            Back to <?php echo $category; ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Similar Products Section (Optional) -->
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">You Might Also Like</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <!-- This would be populated with similar products -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-glasses text-gray-400 text-4xl"></i>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800">Similar Product</h3>
                    <p class="text-gray-600 text-sm">Category</p>
                    <p class="text-blue-600 font-bold mt-2">Rs. 2,500</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-glasses text-gray-400 text-4xl"></i>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800">Similar Product</h3>
                    <p class="text-gray-600 text-sm">Category</p>
                    <p class="text-blue-600 font-bold mt-2">Rs. 2,500</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-glasses text-gray-400 text-4xl"></i>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800">Similar Product</h3>
                    <p class="text-gray-600 text-sm">Category</p>
                    <p class="text-blue-600 font-bold mt-2">Rs. 2,500</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-glasses text-gray-400 text-4xl"></i>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800">Similar Product</h3>
                    <p class="text-gray-600 text-sm">Category</p>
                    <p class="text-blue-600 font-bold mt-2">Rs. 2,500</p>
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
                        <li><a href="customer_index.php" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="shop.php" class="text-gray-400 hover:text-white transition">Shop</a></li>
                        <li><a href="about_us.php" class="text-gray-400 hover:text-white transition">About</a></li>
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

        // Add to cart functionality
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            const cartQuantityBadges = document.querySelectorAll('.fa-shopping-cart + span');
            const feedbackElement = document.getElementById('add-to-cart-feedback');

            addToCartButtons.forEach(function(button) {
                button.addEventListener('click', async function(event) {
                    event.preventDefault();

                    const productId = this.getAttribute('data-product-id');
                    const userId = this.getAttribute('data-user-id');
                    
                    try {
                        const response = await fetch('add_to_cart.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `product_id=${productId}&customer_id=${userId}`
                        });

                        const data = await response.json();

                        if (response.ok && data.status === 'success') {
                            // Update all cart quantity badges
                            cartQuantityBadges.forEach(badge => {
                                badge.textContent = data.cartTotal;
                            });
                            
                            // Show feedback notification
                            feedbackElement.classList.remove('hidden');
                            feedbackElement.classList.remove('opacity-0', 'translate-y-[-20px]');
                            feedbackElement.classList.add('opacity-100', 'translate-y-0');
                            
                            // Hide after 2.5 seconds
                            setTimeout(() => {
                                feedbackElement.classList.remove('opacity-100', 'translate-y-0');
                                feedbackElement.classList.add('opacity-0', 'translate-y-[-20px]');
                                setTimeout(() => {
                                    feedbackElement.classList.add('hidden');
                                }, 300);
                            }, 2500);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>

