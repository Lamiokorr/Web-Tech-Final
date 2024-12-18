<?php
include_once '../config/config.php';

function login($email) {
    global $conn;

    // Query to fetch user data based on email
    $query = "SELECT * FROM customers WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt -> bind_param('s', $email); // Bind the email parameter to the query
    $stmt -> execute();   // Execute the query

    $results = $stmt->get_result();   // Get the result of the query

      //  Close the statement after execution
      $stmt->close();

      return $results;
}
?>
