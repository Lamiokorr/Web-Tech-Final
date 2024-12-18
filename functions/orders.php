<?php
include_once '../config/config.php';


function all_orders(){
    global $conn;

    $query =  "
    SELECT o.order_id, c.fname, c.lname, o.order_date, o.total_amount, o.order_status
      FROM Orders o
      JOIN  Customers c ON c.customer_id = o.customer_id
       ORDER BY  o.order_date
    ";
    $stmt = $conn->query($query);
    
    $orders = array();
    while ($row = $stmt->fetch_assoc()) {
        $orders[] = $row;
    }

    $stmt->close();

    return $orders; 
}


function customer_orders($customer_id){
    global $conn;

    $query= "
    SELECT o.order_id, o.order_date, o.total_amount, p.product_name AS item_name, o.order_status
      FROM Orders o
      JOIN  OrderDetails od ON o.order_id = od.order_id
      JOIN  Products p ON od.product_id = p.product_id
      WHERE o.customer_id = ?
       ORDER BY  o.order_date DESC
    ";
try{
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customer_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

     // Return the orders array
     return $orders;
    } catch (Exception $e){
    error_log("Error fetching customer orders:" . $e->getMessage());
    return [];
}
   }
?>