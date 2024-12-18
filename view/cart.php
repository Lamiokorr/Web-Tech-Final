<?php

session_start();
 include_once '../config/config.php';

 // Ensure user is logged in
if (!isset($_SESSION['customer_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

 // Fetch cart items for the user
$query = $conn->prepare("SELECT  id, product_name, price, quantity FROM cart WHERE customer_id = ?");
$query->bind_param("i", $customer_id);
$query->execute();
$result = $query->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Cart Page</title>
    <?php
// session_start();

// Display success message
if (isset($_SESSION['success'])) {
    echo "<div style='color: green;'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']); // Clear the message
}

// Display error message
if (isset($_SESSION['error'])) {
    echo "<div style='color: red;'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']); // Clear the message
}
?>
    <link rel="stylesheet" href="../css/cart.css">
</head>
<body>
<div class="container my-5">
        <h1 class="text-center">My Cart</h1>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    $count = 1;
                    while ($row = $result->fetch_assoc()): 
                        $subtotal = $row['price'] * $row['quantity'];
                        $total += $subtotal;
                    ?>
                     <form >
                     <tr>
                            <td><?= $count++; ?></td>
                            <td><?= htmlspecialchars($row['product_name']); ?></td>
                            <td>$<?= number_format($row['price'], 2); ?></td>
                           
                               <td> <input type="number" value="<?= $row['quantity']; ?>" 
                               min="1" 
                               id="quantity_<?= $row['id']; ?>" 
            onchange="updateCartLink(<?= $row['id']; ?>)"
            ></td>
                            
                        
                            <td>$<?= number_format($subtotal, 2); ?></td>
                            <td>
                                <a 
                                id="update_link_<?= $row['id']; ?>"
                                href="../actions/update_cart_quantity.php?id=<?= $row['id']; ?>&quantity=<?= $row['quantity']; ?>" 
                                class="btn btn-success btn-sm">Update</a> 
                                <a href="../actions/remove_from_cart.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                        </form>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total:</strong></td>
                        <td colspan="2">$<?= number_format($total, 2); ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">Your cart is empty!</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="menu.php" class="btn btn-primary">Continue Shopping</a>
            <a href="../actions/checkout.php" class="btn btn-success">Checkout</a>
            </div>
        </div>

        <script>
    function updateCartLink(id) {
        // Get the new quantity value
        const quantity = document.getElementById('quantity_' + id).value;
        
        // Update the href of the "Update" link
        const updateLink = document.getElementById('update_link_' + id);
        updateLink.href = `../actions/update_cart_quantity.php?id=${id}&quantity=${quantity}`;
    }
</script>
    </body>
    </html>

