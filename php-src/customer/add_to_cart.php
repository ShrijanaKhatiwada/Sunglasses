<?php
require_once '../connection.php';
session_start();
header('Content-Type: application/json');

if (!empty($_POST)) {
    try {
        $productId = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
        $customer_id = filter_var($_POST['customer_id'], FILTER_VALIDATE_INT);
        
        if (!$productId || !$customer_id) {
            throw new Exception('Invalid input parameters');
        }

        $productSql = "SELECT quantity FROM product WHERE id = ?";
        $stmt = mysqli_prepare($conn, $productSql);
        mysqli_stmt_bind_param($stmt, "i", $productId);
        mysqli_stmt_execute($stmt);
        $qtyResult = mysqli_stmt_get_result($stmt);
        
        $qtyData = mysqli_fetch_assoc($qtyResult);
        if (!$qtyData || $qtyData['quantity'] <= 0) {
            throw new Exception('Product is out of stock');
        }

        $checkCartSql = "SELECT quantity FROM cart WHERE product_id = ? AND customer_id = ?";
        $stmt = mysqli_prepare($conn, $checkCartSql);
        mysqli_stmt_bind_param($stmt, "ii", $productId, $customer_id);
        mysqli_stmt_execute($stmt);
        $checkResult = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($checkResult) > 0) {
            $cartData = mysqli_fetch_assoc($checkResult);
            $newQuantity = $cartData['quantity'] + 1;
            
            if ($newQuantity > $qtyData['quantity']) {
                throw new Exception('Requested quantity exceeds available stock');
            }

            $updateSql = "UPDATE cart SET quantity = ? WHERE product_id = ? AND customer_id = ?";
            $stmt = mysqli_prepare($conn, $updateSql);
            mysqli_stmt_bind_param($stmt, "iii", $newQuantity, $productId, $customer_id);
            mysqli_stmt_execute($stmt);
        } else {
            $insertSql = "INSERT INTO cart (product_id, customer_id, quantity) VALUES (?, ?, 1)";
            $stmt = mysqli_prepare($conn, $insertSql);
            mysqli_stmt_bind_param($stmt, "ii", $productId, $customer_id);
            mysqli_stmt_execute($stmt);
        }

        $totalSql = "SELECT SUM(quantity) as total FROM cart WHERE customer_id = ?";
        $stmt = mysqli_prepare($conn, $totalSql);
        mysqli_stmt_bind_param($stmt, "i", $customer_id);
        mysqli_stmt_execute($stmt);
        $totalResult = mysqli_stmt_get_result($stmt);
        $totalCart = ($totalResult && $row = mysqli_fetch_assoc($totalResult)) ? $row['total'] : 0;

        echo json_encode(['status' => 'success', 'cartTotal' => $totalCart]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit;
    }
}
?>

