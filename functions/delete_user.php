<?php

include_once '../config/config.php';
// Delete Operation 
if(isset($_GET['id'])){
    // $data = json_decode(file_get_contents('php://input'), true);
    $customer_id = $_GET['id'];

    if(empty($customer_id)){
        die('Customer Not Found');
    }

    $query = 'DELETE FROM customers WHERE customer_id =?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $customer_id);
    
    if ($stmt->execute()){
        echo '<script>alert("Customer Deleted!.");</script>';
        
    }else{
        echo '<script>alert("Failed to Delete Customer.");</script>';

    }
    header('Location: ../view/user_management.php');
$stmt->close();


}
$conn->close();

?>