<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
unset($_SESSION['error']); 
unset($_SESSION['success']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="login-container">
        <!-- Left Section: Image -->
        <div class="login-image">
            <img src="../images/login pic.jpg" alt="Login Image">
        </div>

        <!-- Right Section: Form -->
        <div class="login-form">
        <?php if (!empty($error)): ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '<?php echo htmlspecialchars($error); ?>'
                    });
                </script>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '<?php echo htmlspecialchars($success); ?>'
                    });
                </script>
            <?php endif; ?>
            <form id="login-form" method="POST" action="../actions/login_user.php">
                <h1>Welcome Back!</h1>
                <h4>Please enter your details</h4>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email" required>
                    <div id="emailError" class="text-danger" style="display: none;"></div>
                </div>    

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <div id="passwordError" class="text-danger" style="display: none;"></div>
                </div>

                <button type="submit" class="btn btn-info">Login</button>
                
                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            let valid = true;

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const emailError = document.getElementById('emailError');
            if (!emailPattern.test(email)) {
                emailError.textContent = 'Please enter a valid email address.';
                emailError.style.display = 'block';
                valid = false;
            } else {
                emailError.style.display = 'none';
            }

            const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!]).{8,32}$/;
            const passwordError = document.getElementById('passwordError');

            if (!passwordPattern.test(password)) {
                passwordError.textContent = 'Password must contain at least 8 characters, an uppercase letter, a lowercase number, a number, and a special character.';
                passwordError.style.display = 'block';
                valid = false;
            } else {
                passwordError.style.display = 'none';
            }

            if (!valid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>