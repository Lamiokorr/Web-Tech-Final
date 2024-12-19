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

 require_once '../functions/customers_functions.php';

$admin_id = $_SESSION['admin_id'];

$success_message = "";
$error_message = "";

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/user_management.css">
</head>
<body>
<div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <nav class="col-md-2 sidebar">
                <h3 class="text-center">Sip & Savor</h3>
                <h4 class="text-center" style="text-decoration: underline;">Admin Dashboard</h4>
                <!-- <a href="admin_dashboard.php"><i class="fas fa-chart-line"></i> Overview</a> -->
                <a href="user_management.php" class="active"><i class="fas fa-users"></i> User Management</a>
                <a href="order_management.php"><i class="fas fa-file-invoice"></i> Orders</a>
                <a href="../actions/logout.php" class="nav-link text-light"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="my-4">Customers Management</h2>

                            <div class="table-container">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Registration Date</th>
                                            <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                            $customers = all_customers();

                                foreach ($customers as $customer) {
                            echo "<tr>
                                <td>{$customer['customer_id']}</td>
                                <td>{$customer['fname']} {$customer['lname']}</td>
                                <td>{$customer['email']}</td>
                                <td>{$customer['date_registered']}</td>
                               <td> <a href='../functions/delete_user.php?id={$customer['customer_id']}'class='btn btn-sm btn-delete' 
                                                       onclick='return confirm(\"Are you sure you want to delete this user?\");'>
                                                        <i class='fas fa-trash'></i> Delete
                                                        </a>
                                                        </td>
                                                    </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  
        </body>                
</html>