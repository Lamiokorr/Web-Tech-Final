<?php 
include_once '../config/config.php';

function all_customers(){
    global $conn;

    $query = 'SELECT * FROM customers';
    $stmt = $conn->query($query);
    
    $customers = array();
    while ($row = $stmt->fetch_assoc()) {
        $customers[] = $row;
    }

    $stmt->close();

    return $customers; 
}

?>