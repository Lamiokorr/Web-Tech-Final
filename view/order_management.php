<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Restrict access if not logged in as admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

require_once '../functions/orders.php';

$admin_id = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/order_management.css">
</head>
<body>
<div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <nav class="col-md-2 sidebar">
                <h3 class="text-center">Sip & Savor</h3>
                <h4 class="text-center">Admin Dashboard</h4>
                <a href="admin_dashboard.php"><i class="fas fa-chart-line"></i> Overview</a>
                <a href="user_management.php"><i class="fas fa-users"></i> User Management</a>
                <a href="product_manage.php"><i class="fas fa-box"></i> Product Management</a>
                <a href="order_management.php" class="active"><i class="fas fa-file-invoice"></i> Orders</a>
                <a href="#"><i class="fas fa-comments"></i> Feedback</a>
                <a href="#"><i class="fas fa-cog"></i> Settings</a>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 main-content">
                <div class="orders-container">
                    <div class="row mb-4">
                        <div class="col">
                        <h2 class="mb-0">Orders Management</h2>
                        <p class="text-muted">Manage and track all customer orders</p>
                        </div>
                    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-hover table-orders">
                <thead>
                  <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $orders = all_orders();

        foreach ($orders as $order) {
                echo "<tr>
                      <td>{$order['order_id']}</td>
                       <td>{$order['fname']} {$order['lname']}</td>
                        <td>{$order['order_date']}</td>
                        <td>
                            <form method='POST' action='../actions/update_order_status.php'>
                                <input type='hidden' name='order_id' value='{$order['order_id']}' />
                                <select name='order_status' class='form-select'>
                                    <option value='Pending' " . ($order['order_status'] === 'Pending' ? 'selected' : '') . ">Pending</option>
                                    <option value='Processing' " . ($order['order_status'] === 'Processing' ? 'selected' : '') . ">Processing</option>
                                    <option value='Completed' " . ($order['order_status'] === 'Completed' ? 'selected' : '') . ">Completed</option>
                                    <option value='Cancelled' " . ($order['order_status'] === 'Cancelled' ? 'selected' : '') . ">Cancelled</option>
                                </select>
                                 <button type='submit' class='btn btn-sm update-btn mt-1'>Update</button>
                            </form>
                        </td>
                            <td>GHS {$order['total_amount']}</td>
                            </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>