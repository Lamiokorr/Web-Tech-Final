<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    die('Customer ID not set. Please log in.');
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$customer_id = $_SESSION['customer_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/customer.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 sidebar">
            <h3 class="text-center">Sip & Savor</h3>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="customer.php" class="nav-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="menu.php" class="nav-link"><i class="fas fa-bars"></i> Menu</a>
                </li>
                <li class="nav-item">
                    <a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i> Orders</a>
                </li>
                <li class="nav-item">
                    <a href="customer_profile.php" class="nav-link"><i class="fas fa-user"></i> Profile </a>
                </li>
                <li class="nav-item">
                    <a href="../actions/logout.php" class="nav-link text-info"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 col-lg-10 content">
            <h2>Welcome, <?= isset($_SESSION['fname']) ? $_SESSION['fname'] : 'Guest' ?></h2>
            <p class="text-muted">Here is an overview of your account activity.</p>

            <div class="row">
                <!-- Cards -->
                <div class="col-md-4">
                    <div class="card p-4 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="card-icon me-3">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div>
                                <h4>12</h4>
                                <p class="mb-0">Total Orders</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-4 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="card-icon me-3">
                                <i class="fas fa-coffee"></i>
                            </div>
                            <div>
                                <h4>5</h4>
                                <p class="mb-0">Pending Orders</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-4 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="card-icon me-3">
                                <i class="fas fa-star"></i>
                            </div>
                            <div>
                                <h4>4.8</h4>
                                <p class="mb-0">Average Rating</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
    <h3>Order Overview</h3>
    <div class="col-md-12">
        <canvas id="orderChart" width="400" height="200"></canvas>
    </div>
</div>
<?php
// Include database and functions
require_once '../config/config.php';
require_once '../functions/orders.php';

$id = $_SESSION['customer_id'];
$orders = customer_orders($id);

// Initialize arrays for Chart.js
 $orderDates = [];
 $orderAmounts = [];

// // Populate the data
$orderSummary = [];
 foreach ($orders as $order) {
    $date = date('Y-m-d', strtotime($order['order_date']));
    if (!isset($orderSummary[$date])) {
        $orderSummary[$date] = 0;
    }
    $orderSummary[$date] += floatval($order['total_amount']);
 }

 // Sort and prepare final arrays
   ksort($orderSummary);
   $orderDates = array_keys($orderSummary);
   $orderAmounts = array_values($orderSummary)
?>




            <!-- Order History -->
            <div class="mt-4">
                <h3>Recent Orders</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Item</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once '../config/config.php';
                        require_once '../functions/orders.php';

                        $id = $_SESSION['customer_id'];
                        $orders = customer_orders($id);

                        foreach ($orders as $order) {
                            echo "<tr>
                                <td>{$order['order_id']}</td>
                                <td>{$order['order_date']}</td>
                                <td>{$order['total_amount']}</td>
                                <td>{$order['item_name']}</td>
                                <td>{$order['order_status']}</td>
                            </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('orderChart').getContext('2d');
    var orderChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($orderDates); ?>,
            datasets: [{
                label: 'Order Amount',
                data: <?php echo json_encode($orderAmounts); ?>,
                backgroundColor: 'rgba(126, 156, 146, 0.2)', // Match sidebar color
                borderColor: '#7E9C92',
                borderWidth: 2,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Order Amount ($)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Order Date'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Order Trends'
                }
            }
        }
    });
});
</script>
</body>
</html>
