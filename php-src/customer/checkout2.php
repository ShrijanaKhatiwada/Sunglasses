<?php
require_once '../connection.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];

// Initialize message
$message = "";

if (isset($_GET['id'])) {
    // When an individual product is ordered
    $id = $_GET['id'];

    $psql = "SELECT * FROM product WHERE id = ?";
    $stmt = mysqli_prepare($conn, $psql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $pres = mysqli_stmt_get_result($stmt);

    if (!$pres) {
        die("Product query failed: " . mysqli_error($conn));
    }

    $pdata = mysqli_fetch_assoc($pres);

    $pid = $pdata['id'];
    $pname = $pdata['brand'];
    $quantity = 1;
    $total = $pdata['price'];

    $sql = "INSERT INTO orders (customer_id, product_id, product_name, total, quantity) 
            VALUES ('$user_id', '$pid', '$pname', '$total', '$quantity')";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        // Decrease product quantity
        $update_sql = "UPDATE product SET stock_quantity = stock_quantity - $quantity WHERE id = $pid";
        $update_res = mysqli_query($conn, $update_sql);

        if (!$update_res) {
            die("Failed to update product quantity: " . mysqli_error($conn));
        }

        $_SESSION['success'] = "✅ Ordered successfully.";
    } else {
        die("Order insertion failed: " . mysqli_error($conn));
    }
} else {
    // When ordering all items from the cart
    $sql = "SELECT cart.quantity as cqty, product.id as pid, product.brand as pname, product.price as price 
            FROM cart
            JOIN product ON cart.product_id = product.id
            WHERE cart.customer_id = $user_id";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        die("Cart query failed: " . mysqli_error($conn));
    }

    while ($data = mysqli_fetch_assoc($res)) {
        $pid = $data['pid'];
        $pname = $data['pname'];
        $quantity = $data['cqty'];
        $total = $data['price'] * $quantity;

        $isql = "INSERT INTO orders (customer_id, product_id, product_name, total, quantity) 
                 VALUES ('$user_id', '$pid', '$pname', '$total', '$quantity')";
        $ires = mysqli_query($conn, $isql);

        if ($ires) {
            // Decrease product quantity
            $update_sql = "UPDATE product SET quantity = quantity - $quantity WHERE id = $pid";
            $update_res = mysqli_query($conn, $update_sql);

            if (!$update_res) {
                die("Failed to update product quantity for product $pid: " . mysqli_error($conn));
            }
        } else {
            die("Order insertion failed for product $pid: " . mysqli_error($conn));
        }
    }

    $_SESSION['success'] = "✅ All items ordered successfully.";
}

// Clear the cart after order
$clear_cart_sql = "DELETE FROM cart WHERE customer_id = $user_id";
$clear_res = mysqli_query($conn, $clear_cart_sql);
if (!$clear_res) {
    die("Failed to clear cart: " . mysqli_error($conn));
}

// Retrieve success message
if (isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    unset($_SESSION['success']); // Clear success message after showing
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status - Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: rgb(25, 25, 25);
            color: white;
        }

        .message-box {
            width: 350px;
            margin: 50px auto;
            color: aliceblue;
            background-color: #363636;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        ._success i {
            font-size: 55px;
            color: #28a745;
        }

        ._success h2 {
            margin-bottom: 12px;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="message-box _success">
        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
        <h2><?php echo $message; ?></h2>
        <p>Thank you for your order. Redirecting to the homepage...</p>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = "customer_index.php";
        }, 5000);
    </script>
</body>

</html>
