<?php 
    require_once("db_connection.php");
    $schedule_name = $_POST['schedule_name'];
    $time_stamp = $_POST['time_stamp'];
    $date = $_POST['date'];
    $route_id = $_POST['route_id'];
    $bus_id = $_POST['bus_id'];
    $driver_id = $_POST['driver_id'];
    
    $sql ="INSERT INTO schedule (schedule_name, time_stamp, date, route_id, bus_id, driver_id)
                VALUES ('$schedule_name', '$time_stamp', '$date', '$route_id', '$bus_id', '$driver_id')";

    if(mysqli_query($conn, $sql)){
        header("Location:Bus Schedule.php");
        echo "Saved successfully";
    }

    else{
        
        echo "Save unsuccessful" .mysqli_error($conn);
        header("Location: Bus Schedule.php");
    }
    


?>