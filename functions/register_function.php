<?php
include_once '../config/config.php';
function register($email){

global $conn;
// Prepare statement to check if the email already exists in the db
$stmt = $conn->prepare('SELECT email FROM customers WHERE email = ?');
// bind params to  statement
$stmt->bind_param('s', $email);
//execute statement
$stmt->execute();

// Fetch results to check if user is alraedy in database
$result = $stmt->get_result();

return $result;
}


function registers($fname, $lname, $phone_number, $address, $email, $hashedPassword, $created_at) {
    global $conn;

    // SQL query to insert data into customers table
    $query = 'INSERT INTO `customers` (`fname`, `lname`, `phone_number`, `address`, `email`, `password`, `date_registered`) VALUES (?, ?, ?, ?, ?, ?, ?)';
    
    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Check if prepare() failed
    if (!$stmt) {
        die('Prepare failed: ' . $conn->error); // Display error message
    }

    // Bind parameters
    $stmt->bind_param('sssssss', $fname, $lname, $phone_number, $address, $email, $hashedPassword, $created_at);

    // Execute the statement
    if (!$stmt->execute()) {
        die('Execution failed: ' . $stmt->error); // Display error message
    }

    // Close the statement
    $stmt->close();

    return true; // Return true on success
}


?>