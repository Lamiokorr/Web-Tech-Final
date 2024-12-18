<?php

session_start();

// Restrict access if not logged in as admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $admin_id = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_dashboard.css">
</head>
<body>
<div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <h3 class="text-center">Sip & Savor</h3>
                <h4 class="text-center">Admin Dashboard</h4>
                <a href="admin_dashboard.php"><i class="fas fa-chart-line"></i> Overview</a><br>
                <a href="user_management.php"><i class="fas fa-users"></i> User Management</a><br>
                <a href="product_manage.php"><i class="fas fa-box"></i> Product Management</a><br>
                <a href="order_management.php"><i class="fas fa-file-invoice"></i> Orders</a><br>
                <a href="#"><i class="fas fa-comments"></i> Feedback</a><br>
                <a href="#"><i class="fas fa-cog"></i> Settings</a>
            </nav>
            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto dashboard-content">
            <h2>Welcome, <?= isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest' ?></h2>
                <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5>Total Users</h5>
                                <h3>1,245</h3>
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5>Orders Today</h5>
                                <h3>327</h3>
                                <i class="fas fa-shopping-cart fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                <h5>Pending Issues</h5>
                                <h3>12</h3>
                                <i class="fas fa-exclamation-triangle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                
                       
                          
                                    
                    <!-- <div class="col-md-4">
                        <h4>System Notifications</h4>
                        <ul class="list-group">
                            <li class="list-group-item">New user registered: Mike Wilson</li>
                            <li class="list-group-item">Server performance is optimal</li>
                            <li class="list-group-item">3 new feedback entries</li>
                            <li class="list-group-item">Product stock running low</li>
                        </ul>
                    </div> -->
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>