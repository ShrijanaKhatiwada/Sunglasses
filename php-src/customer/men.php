<?php
ob_start();
session_start();
require_once '../connection.php';

// Fetch data from the database for the specific dog using the ID
$sql = "SELECT * FROM product WHERE category_id = 1";

$result = mysqli_query($conn, $sql);

$productData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $productData[] = $row;
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../customer/css/men.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <nav>
        <ul>

            <li class="logo"><a href="#"><img src="../images/sunglasses.png" alt="Sunglasses Logo"></a></li>
            <li><a href="customer_index.php">HOME</a></li>
            <li><a href="men.php">MEN</a></li>
            <li><a href="women.php">WOMEN</a></li>
            <li><a href="customer_contact.php">CONTACT </a></li>
            <li><a href="order.php">ORDERS </a></li>
            <!-- <li class="login"><a href="#">LOGOUT</a></li> -->
            <li class="cart"><a href="customer_view_cart.php"><i class="fas fa-shopping-cart"></i></a></li>
        </ul>
    </nav>
    <h1 class="H1">Home/Men</h1>

    <div class="container">

        <?php foreach ($productData as $product) { ?>
            <div class="item">
                <div class="image">
                    <a href="customer_view_product.php?id=<?= $product['id'] ?>">
                        <img src="../admin/uploads/<?= $product['image'] ?>" alt="<?= $product['brand'] ?>"></a>
                </div>
                <div class="title">
                    <h1>Brand:<?= $product['brand'] ?></h1>
                    <p>Price: <?= $product['price'] ?></p>

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
                <p>Address: Kathmandu,Kalanki</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 ShadeParadise. All rights reserved.</p>
        </div>
    </footer>








</body>

</html>