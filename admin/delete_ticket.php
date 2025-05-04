<?php
// Check if the ticket_id parameter is provided
if(isset($_POST['ticket_id'])) {
    // Connect to your database
    require_once('db_connection.php');
    
    // Prepare and execute the SQL query to delete the ticket with the provided ticket_id
    $ticket_id = $_POST['ticket_id'];
    $sql = "DELETE FROM seat_ticket WHERE ticket_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ticket_id);
    if ($stmt->execute()) {
        // Ticket successfully deleted
        echo "Ticket successfully cancelled.";
    } else {
        // Error occurred while deleting the ticket
        echo "Error: Unable to cancel the ticket.";
    }
    
    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // If ticket_id parameter is not provided, display an error message
    echo "Error: Ticket ID not provided.";
}

