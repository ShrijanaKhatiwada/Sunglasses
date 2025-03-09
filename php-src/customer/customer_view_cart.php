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
    <title>Product View</title>
    <link rel="stylesheet" href="css/customer_view_cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            width: 60%;
            margin-left: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .checkout-summary {
            width: 25%;
            padding: 20px;
            background: #f7f7f7;
            border: 1px solid #ddd;
            position: absolute;
            top: 100px;
            right: 20px;
            text-align: center;
            border-radius: 8px;
        }

        .checkout-summary h2 {
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        .checkout-summary p {
            margin: 10px 0;
            font-size: 1em;
        }

        .checkout-summary .btn-checkout {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .checkout-summary .btn-checkout:hover {
            background: #0056b3;
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
            <li><a href="customer_contact.php">CONTACT</a></li>
            <li><a href="order.php">ORDERS</a></li>
        </ul>
    </nav>

    <h1>Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productData as $product) {
                $itemTotal = $product['price'] * $product['cqty'];
                ?>
                <tr>
                    <td><?= $product['brand'] ?></td>
                    <td><img src="../images/<?= $product['image'] ?>" alt="Product Image" style="width: 80px;"></td>
                    <td><?= $product['cqty'] ?></td>
                    <td>Rs <?= number_format($product['price'], 2) ?></td>
                    <td>Rs <?= number_format($itemTotal, 2) ?></td>
                    <td>
                        <a href="./cart_item_delete.php?cid=<?= $product['cart_id'] ?>" class="del">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="checkout-summary">
        <h1>Order Summary</h1>
        <hr>
        <p><strong>Subtotal:</strong> Rs <?= number_format($subtotal, 2) ?></p>
        <hr>
        <p><strong>Tax (10%):</strong> Rs <?= number_format($tax, 2) ?></p>
        <hr>
        <p><strong>Total:</strong> Rs <?= number_format($total, 2) ?></p>
        <hr>
        <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
            <input type="hidden" name="amount" value="<?php echo $subtotal; ?>">
            <input type="hidden" name="tax_amount" value="<?php echo $tax; ?>">
            <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
            <input type="hidden" name="transaction_uuid" value="<?php echo $t_uuid; ?>">
            <input type="hidden" name="product_code" value="EPAYTEST">
            <input type="hidden" name="product_service_charge" value="0">
            <input type="hidden" name="product_delivery_charge" value="<?php echo $shipping; ?>">
            <input type="hidden" name="success_url" value="http://localhost/sunglass_ecommerce/customer/checkout2.php">
            <input type="hidden" name="failure_url"
                value="http://localhost/sunglass_ecommerce/customer/status_fail.php">
            <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
            <input type="hidden" name="signature" value="<?php echo base64_encode($sig); ?>">
            <button>Proceed to Checkout</button>
        </form>
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact Us</h4>
                <p>Email: info@sunglasses.com</p>
                <p>Phone: +977 1-1234567</p>
            </div>
        </div>
    </footer>
</body>

</html>