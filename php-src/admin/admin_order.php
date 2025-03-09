<?php
require_once "../connection.php";

// Query to fetch the required columns from the `orders` table
$sql = "SELECT order_id, customer_id, product_id, product_name, quantity, total FROM orders";
$result = mysqli_query($conn, $sql);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Admin Dashboard</title>
</head>
<body>
  
<div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="sidebar-menu">
        <li><a href="admin_dashboard.php"> Dashboard</a></li>
        <li><a href="add_product.php">Add Products</a></li>
            <li><a href="user.php">Users</a></li>
            <li><a href="#">Orders</a></li>
            <li><a href="products.php">Products</a></li>
        </ul>
    </div>
    <div class="main-content" id="main-content">
        <header>
            <button class="toggle-btn" id="toggle-btn">☰</button>
            <h1>Welcome, Admin</h1>
        </header>
        
        <div class="table-container">
        <h1>Orders</h1>
            <table>
                <thead>
                    <tr>
                        <th> Order Id</th>
                        <th>Product Id</th>
                        <th>Customer Id</th>
                        <th>Product name</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                        <tr>
                        <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['total']); ?></td>
                        </tr>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('active');
        });
    </script>
</body>
</html>
