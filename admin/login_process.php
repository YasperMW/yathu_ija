<?php
require_once('db_connection.php'); // Include connection class

// Start a PHP session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    
    $password = $_POST['password'];

    
        $sql = "SELECT admin_id, pass_word FROM admins WHERE email = ?";
    

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // Bind username parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['pass_word']; 

       
        if ($password ===$stored_password) {
            // Login successful!
            $_SESSION['user_id'] = $row['admin_id']; // Store user ID in session
           
            
        $_SESSION['user_email'] = $username;

            // Redirect to user dashboard or admin panel based on login type
            
                header("Location: index.php");
            
             
            exit();
        } else {
            // Password mismatch
            $_SESSION['error_message'] = "Invalid password";
            header("Location: login.php");
            exit();
        }
    } else {
        // Username not found
        $_SESSION['error_message'] = "Invalid username";
        header("Location: login.php");
        exit();
    }
}

$stmt->close();
$conn->close();

