<?php
ob_start();
if (isset($_GET['cid'])) {
    require_once '../connection.php';
    
    $cid = (int) $_GET['cid'];

    $sql = "DELETE FROM cart WHERE cart_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $cid);  

    if ($stmt->execute()) {
        header("Location: customer_view_cart.php");
        exit; 
    } else {
        echo "Data deletion failed!";
    }
} else {
    echo "Error: No cart ID provided!";
}
ob_end_flush();
?>

