<?php 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);  

session_start();  
require_once '../config/config.php';  

// Set JSON header for consistent response
header('Content-Type: application/json');

// Input validation function
function validateInput($input, $max_length = 50) {
    $input = trim($input);
    if (empty($input)) return false;
    if (strlen($input) > $max_length) return false;
    return $input;
}

// Phone number validation
function validatePhoneNumber($phone) {
    // Basic US phone number validation (modify as needed)
    return preg_match('/^[0-9]{10}$/', preg_replace('/[^0-9]/', '', $phone));
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
        $customer_id = intval($_GET['customer_id']);
        
        $query = "SELECT `fname`, `lname`, `phone_number`, `address` FROM `customers` WHERE `customer_id` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $customer_id);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                echo json_encode(['success' => true, 'data' => $row]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No user found.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Error executing query.']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid customer ID.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate customer ID
    if (!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id'])) {
        echo json_encode(['success' => false, 'error' => 'Unauthorized access.']);
        exit;
    }

    $customer_id = intval($_SESSION['customer_id']);

    // Validate and sanitize inputs
    $fname = validateInput($_POST['fname'], 50);
    $lname = validateInput($_POST['lname'], 50);
    $phone_number = $_POST['phone_number'];
    $address = validateInput($_POST['address'], 255);
    $new_password = $_POST['new_password'] ?? null;
    $confirm_password = $_POST['confirm_password'] ?? null;

    // Comprehensive input validation
    $errors = [];
    if (!$fname) $errors[] = 'Invalid first name';
    if (!$lname) $errors[] = 'Invalid last name';
    if (!validatePhoneNumber($phone_number)) $errors[] = 'Invalid phone number';
    if (!$address) $errors[] = 'Invalid address';

    // Password validation if provided
    if ($new_password || $confirm_password) {
        if ($new_password !== $confirm_password) {
            $errors[] = 'Passwords do not match';
        }
        if (strlen($new_password) < 8) {
            $errors[] = 'Password must be at least 8 characters long';
        }
    }

    // Return errors if any
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }

    // Sanitize phone number
    $phone_number = preg_replace('/[^0-9]/', '', $phone_number);

    // Prepare password update if applicable
    $hashed_password = $new_password ? password_hash($new_password, PASSWORD_BCRYPT) : null;

    // Build and execute query
    try {
        if ($hashed_password) {
            $query = "UPDATE customers SET fname = ?, lname = ?, phone_number = ?, address = ?, password = ? WHERE customer_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssssi', $fname, $lname, $phone_number, $address, $hashed_password, $customer_id);
        } else {
            $query = "UPDATE customers SET fname = ?, lname = ?, phone_number = ?, address = ? WHERE customer_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssi', $fname, $lname, $phone_number, $address, $customer_id);
        }

        if ($stmt->execute()) {
            // Update session variables
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['address'] = $address;

            echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error updating profile: ' . $stmt->error]);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Unexpected error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}

$conn->close();
?>