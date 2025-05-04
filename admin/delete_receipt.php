<?php
// Check if the ticket_id parameter is provided
if(isset($_POST['hire_receipt_id'])) {
    // Connect to your database
    require_once('db_connection.php');
    
    // Prepare and execute the SQL query to delete the ticket with the provided ticket_id
    $hire_receipt_id = $_POST['hire_receipt_id'];
    $sql = "DELETE FROM hire_receipt WHERE hire_receipt_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $hire_receipt_id);
    if ($stmt->execute()) {
        // Ticket successfully deleted
        echo "Receipt successfully cancelled.";
    } else {
        // Error occurred while deleting the ticket
        echo "Error: Unable to cancel the Receipt.";
    }
    
    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // If ticket_id parameter is not provided, display an error message
    echo "Error: Receipt ID not provided.";
}

