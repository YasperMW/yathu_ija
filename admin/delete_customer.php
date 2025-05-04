<?php
// Delete customer from the database
if (isset($_GET['customer_id'])) {
    require_once("db_connection.php");
    $customer_id = $_GET['customer_id'];
    $sql = "DELETE FROM customer WHERE customer_id=$customer_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: Customers.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>