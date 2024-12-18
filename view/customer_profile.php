<?php
require_once '../config/config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];  // Retrieve the logged-in user's ID

// Fetch user details from the database
$query = "SELECT fname, lname, phone_number, address, email FROM customers WHERE customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Store fetched data in session variables
    $_SESSION['fname'] = $row['fname'];
    $_SESSION['lname'] = $row['lname'];
    $_SESSION['phone_number'] = $row['phone_number'];
    $_SESSION['address'] = $row['address'];
    $_SESSION['email'] = $row['email'];
} else {
    echo "Error fetching user data.";
    exit();
}

$stmt->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/customer_profile.css">
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
                        <a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i> Orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="customer_profile.php" class="nav-link"><i class="fas fa-user"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="#settings" class="nav-link"><i class="fas fa-cog"></i> Settings</a>
                    </li>
                    <li class="nav-item">
                        <a href="../actions/logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container-fluid mt-4">
                    <div class="row">
                        <div class="col-12">
                            <!-- Personal Information Card -->
                            <div class="card">
                                <div class="card-header bg-dark text-white">Personal Information</div>
                                <div class="card-body">
                                    <form id="profileForm">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="fname" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="fname" name="fname" 
                                                value="<?= htmlspecialchars(isset($_SESSION['fname']) ? $_SESSION['fname'] : '') ?>" 
                                                required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="lname" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lname" name="lname" 
                                                value="<?= htmlspecialchars(isset($_SESSION['lname']) ? $_SESSION['lname'] : '') ?>" 
                                                required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone_number" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" 
                                                value="<?= htmlspecialchars(isset($_SESSION['phone_number']) ? $_SESSION['phone_number'] : '') ?>" 
                                                required>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" 
                                                value="<?= htmlspecialchars(isset($_SESSION['email']) ? $_SESSION['email'] : '') ?>" 
                                                readonly>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="2"><?= 
                                                htmlspecialchars(isset($_SESSION['address']) ? $_SESSION['address'] : '') 
                                            ?></textarea>
                                        </div>
                                        
                                        <button type="button" class="btn btn-secondary" onclick="saveProfile()">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QjSQM+kIrIQJ+T9h5UOkpLBQDl5J39dIPmUVDfiDhvto5spB1PfPynHxW6Azwy2m" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileForm = document.getElementById('profileForm');
    
    // Function to save profile
    window.saveProfile = function() {
        // Get form values
        const fname = document.getElementById('fname').value.trim();
        const lname = document.getElementById('lname').value.trim();
        const phone_number = document.getElementById('phone_number').value.trim();
        const address = document.getElementById('address').value.trim();

        // Basic form validation
        if (!fname || !lname || !phone_number || !address) {
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete Form',
                text: 'Please fill out all fields',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Prepare form data
        const formData = new FormData();
        formData.append('fname', fname);
        formData.append('lname', lname);
        formData.append('phone_number', phone_number);
        formData.append('address', address);

        // Send data to server
        fetch('../actions/update_profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Success message
                Swal.fire({
                    icon: 'success',
                    title: 'Profile Updated',
                    text: data.message || 'Your profile has been successfully updated!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload();  // Reloads the page
                });
            } else {
                // Error message
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: data.message || 'Unable to update profile. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Network Error',
                text: 'An unexpected error occurred. Please try again later.',
                confirmButtonText: 'OK'
            });
        });
    };
});
    </script>
</body>
</html>