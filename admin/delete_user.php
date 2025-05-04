<?php
// Delete customer from the database
if (isset($_GET['user_id'])) {
    require_once("db_connection.php");
    $user_id = $_GET['user_id'];
    $sql = "DELETE FROM users WHERE user_id=$user_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
