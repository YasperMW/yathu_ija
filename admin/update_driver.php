<?php
// Update driver information in the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("db_connection.php");
    $driver_id = $_POST['driver_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $license_number = $_POST['licence'];
    $salary = $_POST['salary'];
    $perfomance = $_POST['perfomance'];
    $driver_status = $_POST['status'];

    // Repeat this for other fields
    $sql = "UPDATE driver
            SET first_name='$first_name',
                last_name='$last_name',
                phone_number='$phone_number',
                email='$email',
                date_of_birth='$date_of_birth',
                licence='$license_number',
                salary='$salary',
                perfomance='$perfomance',
                driver_condition='$driver_status'

            WHERE driver_id=$driver_id";
    // Repeat this for other fields
    if (mysqli_query($conn, $sql)) {
        header("Location: Drivers.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>