<?php

include_once '../config/config.php';
include '../functions/login_function.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session to store user information once logged in
session_start();

// Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
     // Retrieve and trim form data
     $email = trim($_POST['email']);
     $user_password = trim($_POST['password']);

     // Check if fields are empty
     if (empty($email) || empty($user_password)) {
        $_SESSION['error'] = 'Do not leave fields empty';
        header('Location: ../view/login.php');
        exit();
    }

    $results = login($email);
    
    // Check if a matching user is found
    if($results->num_rows > 0){
      
        // Fetch the user data from the result set
        $row = $results -> fetch_assoc();
        $customer_id = $row['customer_id'];
        $fname = $row['fname'];
        $password = $row['password'];

         //verify the password entered by the user matches the hashed password in the database
        if (password_verify($user_password, $password)){
            // Store user information in session variables for later access
            $_SESSION['customer_id'] = $customer_id;
            $_SESSION['fname'] = $fname;
            $_SESSION['email'] = $email;

             // Redirect to customer dashboard
             header('Location: ../view/customer.php');
             exit(); // End script after redirect
         } else {
             // Store error message in session
             $_SESSION['error'] = 'Incorrect password. Please try again.';
             header('Location: ../view/login.php');
             exit();
         }
     } else {
         // Store error message in session
         $_SESSION['error'] = 'User not registered';
         header('Location: ../view/register.php');
         exit();
     }
}
?>