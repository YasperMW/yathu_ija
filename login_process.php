<?php
require_once('db_connection.php'); 

// Start a PHP session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data username reflects to an user email.
    $username = $_POST['username'];
    
    $password = $_POST['password'];


    $hashedPassword = hash('sha256', $password);


    

    $sql = "SELECT user_id, pass_word,user_type FROM users WHERE email = ?";
    

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // Bind username parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['pass_word']; 
        $user_type = $row['user_type'];


        if ( $hashedPassword ===$stored_password) {
           
            $_SESSION['user_id'] = $row['user_id']; // Store user ID in session
            $_SESSION['user_email'] = $username;


            if( $user_type === 'Admin'){
                header("Location: admin/index.php");
            }else if( $user_type === 'Customer'){
                header("Location: user/user_dashboard.php");
            }
           
            exit();
        } else {
            // Password mismatch
            $_SESSION['error_message'] = "Invalid  username or password";
            header("Location: login.php");
            exit();
        } 

    } else {
        // Username not found
        $_SESSION['error_message'] = "Invalid username or password";
        header("Location: login.php");
        exit();
    }
}

$stmt->close();
$conn->close();

