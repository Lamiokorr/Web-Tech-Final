<?php
include '../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../css/register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <form id="register-form" method="POST" action="../actions/register_user.php">
        <h1>Create an account</h1>

        <div class="form-row">
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" placeholder="First Name" required>
            </div>

            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" placeholder="Last Name" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{10}" placeholder="Number should be 10 digits" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="Address" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
            </div>
        </div>

        <button type="submit" class="btn btn-info">Create Account</button>

        <p>Already have an account?
            <a href="login.php" style="text-decoration: none;">Sign In</a>
        </p>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('register-form').addEventListener('submit', function(event) {
            let valid = true;

            // Get form values
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Email validation regex
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            // Email validation
            if (!emailPattern.test(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address.',
                });
                valid = false;
                event.preventDefault();
            }

            // Password validation regex (8 characters long or more and at least one uppercase, three numbers, and one special character)
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            
            // Password validation
            if (!passwordPattern.test(password)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Weak Password',
                    text: 'Password must contain at least 8 characters, an uppercase letter, 3 numbers, and a special character.',
                });
                valid = false;
                event.preventDefault();
            }

            // Confirm password validation
            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Passwords do not match!',
                });
                valid = false;
                event.preventDefault();
            }
        });
    </script>
</body>
</html>