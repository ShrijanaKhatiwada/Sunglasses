<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


require_once "../connection.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['invalid'] = ['value' => '❗Please login First', 'timestamp' => time()];
    header('Location: customer_login.php');
    exit;
}

$sql = "SELECT * FROM product WHERE id= $id ";
$result = mysqli_query($conn, $sql);
// Initialize totals
$subtotal = 0;
$tax = 0;
$shipping = 0;
$total = 0;

// Loop through cart items
while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="list_item">
        <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image">
        <h3><?php echo htmlspecialchars($row['brand']); ?></h3>
        <p>Quantity: 1 </p>
        
        <?php
        // Calculate subtotal for each product
        $product_subtotal = $row['price'];
        $product_tax = $product_subtotal * 0.1; // Assuming tax is 10%
        
        // Accumulate totals
        $subtotal += $product_subtotal;
        $tax += $product_tax;
    ?>
    </div>
    <?php
}

// Add shipping cost (you can adjust this as per your logic)
$shipping = 0; // Example: Rs. 0 for free shipping

// Total calculation
$total = $subtotal + $tax + $shipping;

// Generate eSewa signature
function generateRandomString($length = 4): string {
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Checkout</title>
    
   
    <style>
      .container1 {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background-color: #f8f9fa;
    font-family: 'Roboto', sans-serif;
}

.cont-right {
    position: relative;
    bottom:300px;
    left:400px;
    width: 360px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: left;
}

.cont-right h2 {
    font-size: 22px;
    color: #333333;
    font-weight: 600;
    margin-bottom: 15px;
    border-bottom: 1px solid #eaeaea;
    padding-bottom: 10px;
}

.cont-right h3 {
    font-size: 16px;
    color: #555555;
    margin: 12px 0;
    display: flex;
    justify-content: space-between;
    font-weight: 500;
}

.cont-right h3 span {
    color: #000000;
    font-weight: bold;
}

.cont-right hr {
    border: none;
    height: 1px;
    background-color: #eaeaea;
    margin: 15px 0;
}

form {
    margin-top: 20px;
}

button {
    
    width: 100%;
    padding: 12px 0;
    background-color: #007bff;
    color: #ffffff;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

button:hover {
    background-color: #0056b3;
}




    </style>
</head>
<body>
<div class="container1">
    <div class="cont-right">
        <h2>Order Summary</h2>
        <h3>Subtotal: <span>Rs. <?php echo number_format($subtotal, 2); ?></span></h3>
        <h3>Tax (10%): <span>Rs. <?php echo number_format($tax, 2); ?></span></h3>
        <h3>Shipping: <span>Rs. <?php echo number_format($shipping, 2); ?></span></h3>
        <hr>
        <h3>Total: <span>Rs. <?php echo number_format($total, 2); ?></span></h3>

        <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
            <input type="hidden" name="amount" value="<?php echo $subtotal; ?>">
            <input type="hidden" name="tax_amount" value="<?php echo $tax; ?>">
            <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
            <input type="hidden" name="transaction_uuid" value="<?php echo $t_uuid; ?>">
            <input type="hidden" name="product_code" value="EPAYTEST">
            <input type="hidden" name="product_service_charge" value="0">
            <input type="hidden" name="product_delivery_charge" value="<?php echo $shipping; ?>">
            <input type="hidden" name="success_url" value="http://localhost/sunglass_ecommerce/customer/checkout3.php">
            <input type="hidden" name="failure_url" value="http://localhost/sunglass_ecommerce/customer/status_fail.php">
            <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
            <input type="hidden" name="signature" value="<?php echo base64_encode($sig); ?>">
            <button>Proceed to Checkout</button>
        </form>
    </div>
</div>
</body>
</html>
