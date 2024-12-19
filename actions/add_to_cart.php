<?php

session_start();
include_once '../config/config.php';

// Ensure user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

// Get data from POST request
$product_name = $_POST['product_name'];
$price = $_POST['price'];

$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : 0;

if (!$customer_id) {
    echo json_encode(['status' => 'error', 'message' => 'Please log in to add items to cart']);
    exit;
}

try{
// Check if the product is already in the cart
$query = $conn->prepare("SELECT id, quantity FROM cart WHERE customer_id = ? AND product_name = ?");
$query->bind_param("is", $customer_id, $product_name);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    // Update quantity if the product exists in the cart
    $row = $result->fetch_assoc();
    $new_quantity = $row['quantity'] + 1;
    $update_query = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    $update_query->bind_param("ii", $new_quantity, $row['id']);
    $update_query->execute();
} else {
     // Insert new product into the cart
     $insert_query = $conn->prepare("INSERT INTO cart (customer_id, product_name, price, quantity) VALUES (?, ?, ?, 1)");
     $insert_query->bind_param("isd", $customer_id, $product_name, $price);
     $insert_query->execute();
 }
 
 echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
}
 ?>

