<?php


include '../functions/register_function.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Use isset to check if the fields exist before trimming
    $fname = isset($_POST['fname']) ? trim($_POST['fname']) : '';
    $lname = isset($_POST['lname']) ? trim($_POST['lname']) : '';
    $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';
    $created_at = date('Y-m-d H:i:s');
}

// Validate inputs (you can add more thorough validation)
if (empty($fname) || empty($lname) || empty($phone_number)|| empty($address)||empty($email) || empty($password) || empty($confirmPassword)) {
    $_SESSION['error'] = 'Please fill in all required fields';
    header('Location: ../view/register.php');
    exit();
}


// Check if passwords match
if ($confirmPassword != $password) {
    die('Passwords do not match');
}

$result = register($email);

if ($result->num_rows > 0) {
    echo '<script>alert("User already registered")</script>';
    echo '<script>window.location.href="../view/register.php";</script>';
} else {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Call registers function
    $register_success = registers($fname, $lname, $phone_number, $address, $email, $hashedPassword, $created_at);

    // Redirect based on success
    if ($register_success) {
        header('Location: ../view/login.php');
    } else {
        header('Location: ../view/register.php');
    }
}
?>
