<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Restrict access if not logged in as admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../view/admin_login.php");
    exit();
}

require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the order ID and new status from the form
    $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : null;
    $order_status = isset($_POST['order_status']) ? $_POST['order_status'] : null;

    if ($order_id && $order_status) {
        // Update the order status in the database
        $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $order_status, $order_id);

        if ($stmt->execute()) {
            // Redirect back with success message
            $_SESSION['success_message'] = "Order status updated successfully.";
            header("Location: ../view/order_management.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Failed to update order status.";
            header("Location: ../view/order_management.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Invalid input.";
        header("Location: ../view/order_management.php");
        exit();
    }
} else {
    // Restrict direct access
    header("Location: ../view/order_management.php");
    exit();
}
?>
