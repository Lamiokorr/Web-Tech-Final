<?php
// Define server details needed to connect to the database
$servername = 'localhost';  
$username = 'lamiokor.dove';         
$password = 'new_user';            
$dbname = 'webtech_fall2024_lamiokor_dove';      

// Attempt to connect to the database using mysqli
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
