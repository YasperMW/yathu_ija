<?php 
    require_once("db_connection.php");
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $license_number = $_POST['license_number'];
    $salary = $_POST['salary'];
    $performance = $_POST['performance'];
    $driver_status = $_POST['driver_status'];

    $sql ="INSERT INTO driver (first_name, last_name, email, phone_number,date_of_birth, licence, salary ,driver_condition,perfomance)
                VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$date_of_birth', '$license_number', '$salary', '$driver_status' ,'$performance')";

    if(mysqli_query($conn, $sql)){
      header("Location: Drivers.php?success=Driver+added+successfully");
    }

    else{
        header("Location: Drivers.php?error= could+not+add+driver");
    }
    


?>