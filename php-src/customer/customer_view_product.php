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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>
    <link rel="stylesheet" href="../customer/css/customer_view_product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .cart-quantity {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ff4444;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            min-width: 15px;
            text-align: center;
        }

        #cart-icon {
            position: relative;
            display: inline-block;
        }

        .add-to-cart-feedback {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            display: none;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            animation: fadeInOut 2.5s ease-in-out;
        }

        .item-quantity {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            margin-left: 8px;
            font-size: 14px;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-20px); }
            15% { opacity: 1; transform: translateY(0); }
            85% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li class="logo"><a href="#"><img src="../images/sunglasses.png" alt="Sunglasses Logo"></a></li>
            <li><a href="customer_index.php">HOME</a></li>
            <li><a href="men.php">MEN</a></li>
            <li><a href="women.php">WOMEN</a></li>
            <li><a href="#">CONTACT</a></li>
            <li><a href="order.php">ORDERS</a></li>
            <li class="login"><a href="logout.php">LOGOUT</a></li>
            <li>
                <a href="customer_view_cart.php" id="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-quantity"><?php echo $totalCartItems ?: '0'; ?></span>
                </a>
            </li>
        </ul>
    </nav>

    <h1 class="H1">Home/<?php echo htmlspecialchars($category); ?></h1>

    <div class="add-to-cart-feedback" id="add-to-cart-feedback">Added to cart</div>

    <div class="container">
        <?php foreach ($productData as $product) { ?>
            <div class="item">
                <div class="image">
                    <img src="../admin/uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['brand']); ?>">
                </div>
                <div class="title">
                    <h1>Brand: <?php echo htmlspecialchars($product['brand']); ?></h1>
                    <p>Color: <?php echo htmlspecialchars($product['color']); ?></p>
                    <p>Price: Rs. <?php echo number_format($product['price'], 2); ?></p>
                    <p>Available: <?php echo htmlspecialchars($product['quantity']); ?></p>
                    <p>Description: <?php echo htmlspecialchars($product['description']); ?></p>

                    <div class="buttons">
                        <?php if ($product['quantity'] == 0) { ?>
                            <div class="out-of-stock">Out of stock!!!</div>
                        <?php } else { ?>
                            <button class="add-to-cart" 
                                    data-product-id="<?php echo $product['id']; ?>" 
                                    data-user-id="<?php echo $_SESSION['user_id']; ?>">
                                Add to Cart
                                <?php if ($currentCartQty > 0) { ?>
                                    <span class="item-quantity">(<?php echo $currentCartQty; ?>)</span>
                                <?php } ?>
                            </button>
                        <?php } ?>
                    </div>
                </div> 
            </div>
        <?php } ?>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>Sunglasses</h4>
                <p>Learn more about our company and values.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="customer_index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="customer_about.php">About</a></li>
                    <li><a href="customer_contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact Us</h4>
                <p>Email: sunglasses@gmail.com</p>
                <p>Phone: 9810103344</p>
                <p>Address: Kathmandu, Kalanki</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 ShadeParadise. All rights reserved.</p>
        </div>
    </footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartQuantityBadge = document.querySelector('.cart-quantity');
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
                    cartQuantityBadge.textContent = data.cartTotal;
                    feedbackElement.style.display = 'block';
                    setTimeout(() => feedbackElement.style.display = 'none', 2500);
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

