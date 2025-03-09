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
    <title>Orders</title>
    <style>
       /* Body Styling */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    overflow: auto; /* Ensure the body is scrollable */
}

/* Container Styling */
.container {
    width: 90%;
    margin: auto;
    padding: 20px;
    background-color: #f9f9f9;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: auto; /* Ensure the container is scrollable */
}

/* General Table Styling */
table {
    width: 80%;
    border-collapse: collapse;
   margin-left: 80px;
    font-size: 1em;
    font-family: 'Arial', sans-serif;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
}

/* Table Head Styling */
thead tr {
    background-color: #2076c6;
    color: #ffffff;
    text-align: left;
    font-weight: bold;
}

thead th {
    font-weight: bold;
    font-size: 1.1em;
    text-transform: uppercase;
}

/* Table Body Styling */
th, td {
    padding: 12px 10px;
    border: 1px solid #dee2e6;
    text-align: center;
}

tbody tr {
    border-bottom: 1px solid #dee2e6;
}

tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
    padding: 12px 10px;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

/* Image Styling */
td img {
    width: 50px;
    height: auto;
    border-radius: 4px;
}


 a{
   text-decoration: none;
}

.btn-back{
    position: relative;
    background-color: rgb(9, 8, 8);
    color: #f1f1f1;
    padding: 10px 15px;
    border-radius: 6px;
    top: 20px;
    left: 4px;

}
.btn-back:hover{
    background-color: #242425;
}


    </style>
</head>
<body>
    <a href="customer_index.php" class="btn-back">Back To Home</a>

    <h1 style="text-align: center;">Orders</h1>
    <div class="button-container">
        
    </div>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total (Rs)</th>
             
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the result set and display each row in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['product_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                echo "<td>" . htmlspecialchars($row['total']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
