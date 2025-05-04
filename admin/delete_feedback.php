<?php
require_once("db_connection.php");

if(isset($_GET['feedback_id'])) {
    $feedback_id = $_GET['feedback_id'];
    $delete_sql = "DELETE FROM tms_feedback WHERE f_id = $feedback_id";
    if (mysqli_query($conn, $delete_sql)) {
        header("Location: routes.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
