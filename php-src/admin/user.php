<?php
require_once '../connection.php';

$sql = "SELECT * FROM customer";
$result = mysqli_query($conn, $sql);
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
            <li><a href="admin_order.php">Orders</a></li>
            <li><a href="products.php">Products</a></li>
        </ul>
    </div>
    <div class="main-content" id="main-content">
        <header>
            <button class="toggle-btn" id="toggle-btn">☰</button>
            <h1>Welcome, Admin</h1>
        </header>
        
        <div class="table-container">
        <h1>Users</h1>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phonenumber</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td><?= $row['phonenumber'] ?></td>
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
