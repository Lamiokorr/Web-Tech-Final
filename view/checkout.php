<?php
session_start();
include_once '../config/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: ../view/login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Fetch customer details
$customer_query = $conn->prepare("SELECT fname, lname, phone_number, address, email FROM customers WHERE customer_id = ?");
$customer_query->bind_param("i", $customer_id);
$customer_query->execute();
$customer_result = $customer_query->get_result();
$customer = $customer_result->fetch_assoc();

// Fetch cart items with product details
$cart_query = $conn->prepare("
    SELECT c.id AS cart_id, p.product_id, p.product_name, p.price, c.quantity 
    FROM cart c
    JOIN products p ON c.product_name = p.product_name
    WHERE c.customer_id = ?"
);
$cart_query->bind_param("i", $customer_id);
$cart_query->execute();
$cart_result = $cart_query->get_result();

// Calculate total
$total = 0;
$order_items = [];
while ($item = $cart_result->fetch_assoc()) {
    $subtotal = $item['price'] * $item['quantity'];
    $total += $subtotal;
    $order_items[] = $item;
}

$cart_query->execute();
$cart_query->bind_result($cart_id, $product_id, $product_name, $price, $quantity);

$order_items = [];
while ($cart_query->fetch()) {
    $order_items[] = [
        'cart_id' => $cart_id,
        'product_id' => $product_id,
        'product_name' => $product_name,
        'price' => $price,
        'quantity' => $quantity,
    ];
}



// var_dump($order_items);
// exit();

// Start a database transaction
// $conn->begin_transaction();

// try {
//     // Insert order
//     $insert_order_query = $conn->prepare("
//         INSERT INTO Orders (
//             customer_id, 
//             total_amount, 
//             payment_status, 
//             order_status
//         ) VALUES (?, ?, 'Pending', 'Pending')
//     ");
//     $insert_order_query->bind_param("id", $customer_id, $total);
//     $insert_order_query->execute();
    
//     // Get the last inserted order ID
//     $order_id = $conn->insert_id;

//     // Insert order details
//     $insert_details_query = $conn->prepare("
//         INSERT INTO OrderDetails (
//             order_id, 
//             product_id, 
//             quantity, 
//             unit_price
//         ) VALUES (?, ?, ?, ?)
//     ");

//     // Insert each item into OrderDetails
//     foreach ($order_items as $item) {
//         $insert_details_query->bind_param(
//             "iiid", 
//              $order_id, 
//             $item['product_name'], 
//             $item['quantity'], 
//             $item['price'],
//         );
//         $insert_details_query->execute();
//     }

//     // Clear the cart
//     $clear_cart_query = $conn->prepare("DELETE FROM cart WHERE customer_id = ?");
//     $clear_cart_query->bind_param("i", $customer_id);
//     $clear_cart_query->execute();

    // Commit the transaction
//     $conn->commit();

// } catch (Exception $e) {
//     // Rollback the transaction in case of error
//     $conn->rollback();
    
//     // Log the error
//     error_log("Checkout error: " . $e->getMessage());
    

//     header("Location: error.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt - Sip & Savor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/checkout.css">
</head>
<body>
    <div class="container">
        <div class="receipt">
            <div class="receipt-header">
                <h2>Sip & Savor</h2>
                <p>Order Receipt</p>
                <!-- <Order Number: <?php echo htmlspecialchars($order_id); ?> -->
                <p>Date: <?php echo date('Y-m-d H:i:s'); ?></p>
            </div>

            <div class="receipt-details">
            <p><strong>Customer Name:</strong> <?php $fullName = trim($customer['fname'] . ' ' . $customer['lname']);
    echo htmlspecialchars($fullName ?: 'N/A'); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($customer['email']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($customer['address']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer['phone_number']); ?></p>
        </div>

            <table class="receipt-items">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>GHS <?php echo number_format($item['price'], 2); ?></td>
                        <td>GHS <?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="receipt-total">
                <h4>Total: GHS <?php echo number_format($total, 2); ?></h4>
                <p>Payment Status: Pending</p>
                <p>Order Status: Pending</p>
            </div>

            <div class="text-center no-print mt-3">
                <button id="confirmPurchaseBtn"class="btn btn-secondary">Confirm Purchase</button>
                <button onclick="window.print()" class="btn btn-primary">Print Receipt</button>
                <a href="../view/menu.php" class="btn btn-secondary">Continue Shopping</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
document.getElementById('confirmPurchaseBtn').addEventListener('click', function () {
    Swal.fire({
        title: 'Confirm Purchase',
        text: 'Are you sure you want to confirm the purchase?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, confirm it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('process_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ customer_id: <?php echo json_encode($customer_id); ?> })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Order confirmed successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '../view/customer.php';
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error confirming order: ' + data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Unexpected Error',
                    text: 'An unexpected error occurred.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
    });
});
</script>

</body>
</html>
