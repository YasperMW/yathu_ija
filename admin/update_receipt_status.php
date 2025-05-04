<?php
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the hire receipt ID and receipt status are set
    if (isset($_POST["hire_receipt_id"]) && isset($_POST["receipt_status"])) {
        // Sanitize inputs to prevent SQL injection
        $hireReceiptId = mysqli_real_escape_string($conn, $_POST["hire_receipt_id"]);
        $receiptStatus = mysqli_real_escape_string($conn, $_POST["receipt_status"]);
        
        // Update the receipt status in the database
        $query = "UPDATE hire_receipt SET receipt_status = '$receiptStatus' WHERE hire_receipt_id = '$hireReceiptId'";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            // Receipt status updated successfully
            echo "Receipt status updated successfully.";
        } else {
            // Error updating receipt status
            echo "Error updating receipt status: " . mysqli_error($conn);
        }
    } else {
        // Invalid request
        echo "Invalid request.";
    }
} else {
    // Redirect if accessed directly
    header("Location: hire_receipt.php");
    exit();
}
?>
