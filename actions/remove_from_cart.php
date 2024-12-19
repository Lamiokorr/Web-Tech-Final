<?php

session_start();

include_once '../config/config.php';

// Ensure user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

// Get the cart item ID to delete
$customer_id = $_SESSION['customer_id'];
$itemID = $_GET['id'];

$query = $conn->prepare("DELETE FROM cart WHERE id = ?  AND customer_id = ?");
$query->bind_param("ii", $itemID, $customer_id);

if ($query->execute()) {
    // Redirect back to the cart page with a success message
    header("Location: ../view/cart.php?message=Item removed successfully");
} else {
    // Redirect back to the cart page with an error message
    header("Location: ../view/cart.php?message=Failed to remove item");
}
?>