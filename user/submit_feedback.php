<?php
session_start();

// Include database connection
include 'db_connection.php';

$message = ''; // Initialize message variable

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $uname = $_POST['uname'];
    $content = $_POST['content'];

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO tms_feedback (f_uname, f_content, f_status) VALUES (?, ?, 'Pending')");
    $stmt->bind_param("ss", $uname, $content);

    // Execute the statement
    if ($stmt->execute()) {
        // Feedback inserted successfully
        $message = "Thank you for your feedback!";
    } else {
        // Error inserting feedback
        $message = "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
