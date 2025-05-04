<?php
require_once("db_connection.php");

if(isset($_GET['schedule_id'])) {
    $schedule_id = $_GET['schedule_id'];
    $sql = "SELECT route_id, bus_id FROM schedule WHERE schedule_id = $schedule_id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Return details in JSON format
        echo json_encode($row);
    } else {
        echo json_encode(array("error" => "Schedule details not found"));
    }
} else {
    echo json_encode(array("error" => "Invalid request"));
}
?>
