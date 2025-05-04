<?php
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the ticket ID and payment status are set
    if (isset($_POST["ticket_id"]) && isset($_POST["payment_status"])) {
        // Sanitize inputs to prevent SQL injection
        $ticketId = mysqli_real_escape_string($conn, $_POST["ticket_id"]);
        $paymentStatus = mysqli_real_escape_string($conn, $_POST["payment_status"]);
        
        // Update the payment status in the database
        $query = "UPDATE seat_ticket SET status = '$paymentStatus' WHERE ticket_id = '$ticketId'";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            // Payment status updated successfully
            echo "Payment status updated successfully.";
        } else {
            // Error updating payment status
            echo "Error updating payment status: " . mysqli_error($conn);
        }
    } else {
        // Invalid request
        echo "Invalid request.";
    }
} else {
    // Redirect if accessed directly
    header("Location: seat_tickets.php");
    exit();
}

