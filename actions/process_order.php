<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once '../config/config.php';

// Ensure user is logged in
if (!isset($_SESSION['customer_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Fetch cart items with product details
$cart_query = $conn->prepare("
    SELECT c.id AS cart_id, p.product_id, p.product_name, p.price, c.quantity 
    FROM cart c
    JOIN products p ON c.product_name = p.product_name
    WHERE c.customer_id = ?
");
$cart_query->bind_param("i", $customer_id);
$cart_query->execute();
$cart_result = $cart_query->get_result();

// Prepare order details
$total = 0;
$order_items = [];
while ($item = $cart_result->fetch_assoc()) {
    $subtotal = $item['price'] * $item['quantity'];
    $total += $subtotal;
    $order_items[] = $item;
}

// Start a database transaction
$conn->begin_transaction();

try {
    // Insert order into Orders table
    $insert_order_query = $conn->prepare("
        INSERT INTO Orders (customer_id, total_amount, payment_status, order_status)
        VALUES (?, ?, 'Pending', 'Pending')
    ");
    $insert_order_query->bind_param("id", $customer_id, $total);
    $insert_order_query->execute();

    // Get the last inserted order ID
    $order_id = $conn->insert_id;

    // Insert each item into OrderDetails table
    $insert_details_query = $conn->prepare("
        INSERT INTO OrderDetails (order_id, product_id, quantity, unit_price)
        VALUES (?, ?, ?, ?)
    ");

    foreach ($order_items as $item) {
        $insert_details_query->bind_param(
            "iiid",
            $order_id,
            $item['product_id'],
            $item['quantity'],
            $item['price']
        );
        $insert_details_query->execute();
    }

    // Clear the cart
    $clear_cart_query = $conn->prepare("DELETE FROM cart WHERE customer_id = ?");
    $clear_cart_query->bind_param("i", $customer_id);
    $clear_cart_query->execute();

    // Commit the transaction
    $conn->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Rollback the transaction in case of error
    $conn->rollback();
    
    // Log the error
    error_log("Checkout error: " . $e->getMessage());
    
    echo json_encode(['success' => false, 'message' => 'Error processing order. Please try again.']);
}
?>
