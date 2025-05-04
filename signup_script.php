<?php
include_once("db_connection.php");



// Get form data 
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dateOfBirth =$_POST['date_of_birth'];
$password = $_POST['password'];
$gender= $_POST['gender'];
$user_type= $_POST['User_type'];


//hashing the password
$hashedPassword = hash('sha256', $password);




// Check if email already exists
$stmt = $conn->prepare("SELECT email FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Email already exists, redirect with error message
    header("Location: signup.php?error=Email+already+exists");
    exit();
}

$stmt->close();

// Insert customer data into database using prepared statement
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number, date_of_birth,gender,user_type, pass_word) VALUES (?, ?, ?, ?, ?,?,?,?)");
$stmt->bind_param("ssssssss", $first_name, $last_name, $email, $phone, $dateOfBirth, $gender ,$user_type,$hashedPassword );

if ($stmt->execute()) {
    // Registration successful, redirect with success message
    header("Location: signup.php?success=Registration+Successful");
} else {
    // Registration failed, redirect with error message
    header("Location: signup.php?error=Registration+Failed");
}

$stmt->close();
$conn->close();

