<?php
require_once '../connection.php';

$csql="SELECT * FROM customer ";
$cresult=mysqli_query($conn,$csql);

$psql="SELECT * FROM product ";
$presult=mysqli_query($conn,$psql);

$osql="SELECT * FROM orders";
$oresult=mysqli_query($conn,$osql);

$total_customer=mysqli_num_rows($cresult);
$total_product=mysqli_num_rows($presult);
$total_order=mysqli_num_rows($oresult);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="sidebar-menu">
           
           
            <li><a href="add_product.php">Add Products</a></li>
            <li><a href="user.php">Users</a></li>
            <li><a href="admin_order.php">Orders</a></li>
            <li><a href="products.php">Products</a></li>
            
        </ul>
    </div>
    <div class="main-content" id="main-content">
        <header>
            <button class="toggle-btn" id="toggle-btn">☰</button>
            <h1>Welcome, Admin</h1>
        </header>
        <section class="content">
            <div class="card">
                <img class="img" src="../images/user_icon.webp" alt="" class="src">
                <h3>Users</h3>
                <p>Number of Users: <?=$total_customer?></p>
                
            </div>
            
            <div class="card">
            <img class="img" src="../images/shopping.webp" alt="" class="src">
                <h3>Products</h3>
                <p>Total Products: <?=$total_product?></p>
            </div>
            <div class="card">
            <img class="img" src="../images/3d-order-online-shop-png.webp" alt="" class="src">
                <h3>Orders</h3>
                <p>Number of Orders: <?=$total_order?></p>
            </div>
        </section>
    </div>
    <script src="script.js"></script>
</body>
</html>
<script>
    document.getElementById('toggle-btn').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('main-content').classList.toggle('active');
});

</script>
