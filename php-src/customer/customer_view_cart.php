<?php
ob_start();
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['invalid'] = ['value' => '❗Please login First', 'timestamp' => time()];
    header('Location: customer_login.php');
    exit;
}

// Generate order number
$sql = "SELECT MAX(order_id) AS last_order_id FROM orders";
$result = $conn->query($sql);
$orderno = ($result && $row = $result->fetch_assoc()) ? $row['last_order_id'] + 1 : 1;

// Single query to fetch all cart data
$sql = "SELECT 
            cart.cart_id,
            cart.quantity as cqty,
            cart.product_id as pid,
            cart.customer_id as cid,
            product.image,
            product.price,
            product.brand 
        FROM cart 
        JOIN product ON product.id = cart.product_id 
        WHERE cart.customer_id = " . $_SESSION['user_id'];

$cartresult = mysqli_query($conn, $sql);

if (!$cartresult) {
    die("Query failed: " . mysqli_error($conn));
}

// Initialize variables
$productData = [];
$subtotal = 0;
$tax = 0;
$shipping = 0;

// Calculate totals
while ($row = mysqli_fetch_assoc($cartresult)) {
    $productData[] = $row;
    $itemTotal = $row['price'] * $row['cqty'];
    $subtotal += $itemTotal;
}

// Calculate tax and final total
$tax = $subtotal * 0.1; // 10% tax
$total = $subtotal + $tax + $shipping;

// Generate eSewa signature
function generateRandomString($length = 4): string
{
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$t_uuid = "TXN-" . generateRandomString();
$message = "total_amount=$total,transaction_uuid=$t_uuid,product_code=EPAYTEST";
$secretKey = "8gBm/:&EnhH.1/q";
$sig = hash_hmac('sha256', $message, $secretKey, true);

$conn->close();
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Shade Paradise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
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
        <button id="mobile-menu-toggle" class="bg-brand-600 text-white p-3 rounded-full shadow-lg">
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
                <a href="customer_index.php" class="text-white hover:text-brand-300 transition">HOME</a>
                <a href="shop.php" class="text-white hover:text-brand-300 transition">SHOP</a>
                <a href="men.php" class="text-white hover:text-brand-300 transition">MEN</a>
                <a href="women.php" class="text-white hover:text-brand-300 transition">WOMEN</a>
                <a href="customer_contact.php" class="text-white hover:text-brand-300 transition">CONTACT</a>
                <a href="order.php" class="text-white hover:text-brand-300 transition">ORDERS</a>
                <a href="../index/index.php" class="text-white hover:text-brand-300 transition">LOGOUT</a>
                <a href="customer_view_cart.php" class="text-white hover:text-brand-300 transition font-bold flex items-center">
                    <span class="mr-2">CART</span>
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Desktop Navigation -->
    <nav class="bg-gradient-to-r from-brand-700 to-brand-900 text-white shadow-md sticky top-0 z-30">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="#" class="mr-6">
                        <img src="../images/sunglasses.png" alt="Sunglasses Logo" class="h-10">
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="customer_index.php" class="hover:text-brand-200 transition">HOME</a>
                    <a href="shop.php" class="hover:text-brand-200 transition">SHOP</a>
                    <a href="men.php" class="hover:text-brand-200 transition">MEN</a>
                    <a href="women.php" class="hover:text-brand-200 transition">WOMEN</a>
                    <a href="customer_contact.php" class="hover:text-brand-200 transition">CONTACT</a>
                    <a href="order.php" class="hover:text-brand-200 transition">ORDERS</a>
                    <a href="../index/index.php" class="hover:text-brand-200 transition">LOGOUT</a>
                    <a href="customer_view_cart.php" class="border-b-2 border-white hover:text-brand-200 transition">
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
                <a href="customer_index.php" class="hover:text-brand-600">Home</a>
                <span class="mx-2">/</span>
                <span class="text-brand-800 font-semibold">Shopping Cart</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mt-2">Your Shopping Cart</h1>
        </div>
    </div>

    <!-- Cart Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <?php if (empty($productData)): ?>
                    <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                        <i class="fas fa-shopping-cart text-gray-300 text-5xl mb-4"></i>
                        <h2 class="text-2xl font-bold text-gray-700 mb-2">Your cart is empty</h2>
                        <p class="text-gray-600 mb-6">Looks like you haven't added any items to your cart yet.</p>
                        <a href="shop.php" class="inline-block bg-brand-600 text-white font-bold px-6 py-3 rounded-lg hover:bg-brand-700 transition">
                            Start Shopping
                        </a>
                    </div>
                <?php else: ?>
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 border-b">
                                    <tr>
                                        <th class="py-4 px-6 text-left text-sm font-medium text-gray-500">Product</th>
                                        <th class="py-4 px-6 text-left text-sm font-medium text-gray-500">Quantity</th>
                                        <th class="py-4 px-6 text-left text-sm font-medium text-gray-500">Price</th>
                                        <th class="py-4 px-6 text-left text-sm font-medium text-gray-500">Total</th>
                                        <th class="py-4 px-6 text-left text-sm font-medium text-gray-500">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php foreach ($productData as $product): 
                                        $itemTotal = $product['price'] * $product['cqty'];
                                    ?>
                                        <tr>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center">
                                                    <img src="../admin/uploads/<?= $product['image'] ?>" alt="<?= $product['brand'] ?>" class="w-16 h-16 object-cover rounded mr-4">
                                                    <div>
                                                        <p class="font-medium text-gray-800"><?= $product['brand'] ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-gray-700"><?= $product['cqty'] ?></td>
                                            <td class="py-4 px-6 text-gray-700">Rs <?= number_format($product['price'], 2) ?></td>
                                            <td class="py-4 px-6 font-medium text-gray-900">Rs <?= number_format($itemTotal, 2) ?></td>
                                            <td class="py-4 px-6">
                                                <a href="./cart_item_delete.php?cid=<?= $product['cart_id'] ?>" class="text-red-500 hover:text-red-700 transition">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between pb-4 border-b">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">Rs <?= number_format($subtotal, 2) ?></span>
                        </div>
                        <div class="flex justify-between pb-4 border-b">
                            <span class="text-gray-600">Tax (10%)</span>
                            <span class="font-medium">Rs <?= number_format($tax, 2) ?></span>
                        </div>
                        <div class="flex justify-between pb-4 border-b">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium">Free</span>
                        </div>
                        <div class="flex justify-between pt-2">
                            <span class="text-lg font-bold text-gray-800">Total</span>
                            <span class="text-lg font-bold text-brand-600">Rs <?= number_format($total, 2) ?></span>
                        </div>
                    </div>
                    
                    <?php if (!empty($productData)): ?>
                        <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" class="mt-6">
                            <input type="hidden" name="amount" value="<?php echo $subtotal; ?>">
                            <input type="hidden" name="tax_amount" value="<?php echo $tax; ?>">
                            <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
                            <input type="hidden" name="transaction_uuid" value="<?php echo $t_uuid; ?>">
                            <input type="hidden" name="product_code" value="EPAYTEST">
                            <input type="hidden" name="product_service_charge" value="0">
                            <input type="hidden" name="product_delivery_charge" value="<?php echo $shipping; ?>">
                            <input type="hidden" name="success_url" value="http://localhost/sunglass_ecommerce/customer/checkout2.php">
                            <input type="hidden" name="failure_url" value="http://localhost/sunglass_ecommerce/customer/status_fail.php">
                            <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
                            <input type="hidden" name="signature" value="<?php echo base64_encode($sig); ?>">
                            
                            <button type="submit" class="w-full bg-brand-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-brand-700 transition focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                                Proceed to Checkout
                            </button>
                        </form>
                        
                        <div class="mt-6 flex justify-center space-x-4">
                            <div class="text-gray-500 text-sm text-center">
                                <i class="fas fa-lock text-gray-400 text-lg mb-1"></i>
                                <p>Secure Payment</p>
                            </div>
                            <div class="text-gray-500 text-sm text-center">
                                <i class="fas fa-truck text-gray-400 text-lg mb-1"></i>
                                <p>Free Shipping</p>
                            </div>
                            <div class="text-gray-500 text-sm text-center">
                                <i class="fas fa-exchange-alt text-gray-400 text-lg mb-1"></i>
                                <p>Easy Returns</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Need Help?</h3>
                    <p class="text-gray-600 mb-4">Our customer service team is available to assist you with any questions or concerns.</p>
                    <div class="flex items-center text-brand-600">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span>+977 9810103344</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Continue Shopping -->
    <div class="bg-gray-100 py-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <a href="shop.php" class="flex items-center text-brand-600 hover:text-brand-700 transition mb-4 md:mb-0">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Continue Shopping</span>
                </a>
                
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-500 hover:text-gray-700 transition">
                        <i class="fab fa-cc-visa text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 transition">
                        <i class="fab fa-cc-mastercard text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 transition">
                        <i class="fab fa-cc-paypal text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 transition">
                        <i class="fab fa-cc-amex text-2xl"></i>
                    </a>
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