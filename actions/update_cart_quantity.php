<?php

session_start();
include_once '../config/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}
// Get the cart item ID to update
$id = $_GET['id'];
$quantity = (int)$_GET['quantity'];



    // Updates quantity in cart
    $query = $conn->prepare("UPDATE cart SET quantity = ? where id = ? AND customer_id = ?");
    $query->bind_param("iii", $quantity, $id, $_SESSION['customer_id']);

    if ($query->execute()) {
        $_SESSION['success'] = "Cart updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update the cart.";
    }

    header("Location: ../view/cart.php");
        exit();

 ?>