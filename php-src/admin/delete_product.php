<?php
ob_start(); 

require_once '../connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteCartSql = "DELETE FROM cart WHERE product_id = $id";
    $deleteCartResult = mysqli_query($conn, $deleteCartSql);

    if (!$deleteCartResult) {
        echo "Failed to remove related cart items. Please try again.";
        exit;
    }

    $sql = "DELETE FROM product WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['success_message'] = "Product deleted successfully!";
        header('Location: products.php');
        exit;
    } else {
        echo "Failed to delete product. Please try again.";
    }
} else {
    echo "Error: Product ID not specified.";
}

ob_end_flush(); 
?>

