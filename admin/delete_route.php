<?php
require_once("db_connection.php");
// Delete route from the database
if (isset($_GET['route_id'])) {
    
    $route_id = $_GET['route_id'];
    $sql = "DELETE FROM route WHERE route_id=$route_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: routes.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>