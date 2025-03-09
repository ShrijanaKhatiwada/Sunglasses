<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/products.css">
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
        
        <div class="container">
            <h1>Products</h1>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Brand</th>
                        <th>Color</th>
                        <th>Category_id</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../connection.php';
                    $sql = "SELECT * FROM product";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['brand']?></td>
                            <td><?=$row['color']?></td>
                            <td><?=$row['category_id']?></td>
                            <td><?=$row['price']?></td>
                            <td><?=$row['quantity']?></td>
                            <td><img src="uploads/<?=$row['image']?>" alt=""></td>
                            <td>
                                <a href="update_product.php?id=<?=$row['id']?>"><button class="update">Update</button></a>
                                <a href="delete_product.php?id=<?=$row['id']?>"><button class="delete">Delete</button></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
</body>
</html>
<script>
    document.getElementById('toggle-btn').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('main-content').classList.toggle('active');
});

</script>
