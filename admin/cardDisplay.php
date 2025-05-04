<?php

    include('db_connection.php');
    // Assuming you have already connected to your database

    // Query to get the number of buses
    $query_buses = "SELECT COUNT(*) AS total_buses FROM bus";
    $result_buses = mysqli_query($conn, $query_buses);
    $row_buses = mysqli_fetch_assoc($result_buses);
    $total_buses = $row_buses['total_buses'];

    
     // Query to get the number of drivers
     $query_drivers = "SELECT COUNT(*) AS total_drivers FROM driver";
     $result_drivers = mysqli_query($conn, $query_drivers);
     $row_drivers = mysqli_fetch_assoc($result_drivers);
     $total_drivers = $row_drivers['total_drivers'];

     // Query to get the number of users
     $query_users = "SELECT COUNT(*) AS total_users FROM users";
     $result_users = mysqli_query($conn, $query_users);
     $row_users = mysqli_fetch_assoc($result_users);
     $total_users = $row_users['total_users'];

     // Query to get the number of tickets
     $query_tickets = "SELECT COUNT(*) AS total_tickets FROM seat_ticket";
     $result_tickets = mysqli_query($conn, $query_tickets);
     $row_tickets = mysqli_fetch_assoc($result_tickets);
     $total_tickets = $row_tickets['total_tickets'];

     $query_reciepts = "SELECT COUNT(*) AS total_receipts FROM hire_receipt";
     $result_reciepts = mysqli_query($conn, $query_reciepts);
     $row_reciepts = mysqli_fetch_assoc($result_reciepts);
     $total_receipts = $row_reciepts['total_receipts'];

     // Query to get the total revenue from tickets
     $query_revenue = "SELECT SUM(amount) AS total_revenue FROM seat_ticket WHERE status='paid'";
     $result_revenue = mysqli_query($conn, $query_revenue);
     $row_revenue = mysqli_fetch_assoc($result_revenue);
     $total_revenue = $row_revenue['total_revenue'];

     $query_Hrevenue = "SELECT SUM(payable_amount) AS total_Hrevenue FROM hire_receipt WHERE receipt_status='paid'";
     $result_Hrevenue = mysqli_query($conn, $query_Hrevenue);
     $row_Hrevenue = mysqli_fetch_assoc($result_Hrevenue);
     $total_Hrevenue = $row_Hrevenue['total_Hrevenue'];

     $query_fuel_revenue = "SELECT (50000 - SUM(fuel_used)) AS fuel_revenue FROM bus";
     $result_fuel_revenue = mysqli_query($conn, $query_fuel_revenue);
     $row_fuel_revenue = mysqli_fetch_assoc($result_fuel_revenue);
     $fuel_revenue = $row_fuel_revenue['fuel_revenue'];

?>