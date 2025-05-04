<?php
// Assuming you have already established a database connection
require_once('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve origin and destination from the form
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];

    // Prepare and execute the SQL query with prepared statements
    $query = "SELECT distance FROM route 
    WHERE origin = '$origin' OR origin = '$destination'  AND destination = '$destination' OR destination = '$origin'  ";
    $result = mysqli_query($conn, $query);
    // Check if the query was successful
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch the distance from the result
            $row = mysqli_fetch_assoc($result);
            $distance = $row['distance'];

            // Calculate payable amount based on distance (assuming a base price per kilometer)
            $basePricePerKm = 600.00; // Example base price per kilometer
            $payableAmount = $distance * $basePricePerKm;

            // Send the payable amount back to the client
            echo $payableAmount;
        } else {
            // Handle the case where no rows were returned
            echo "Error: No distance found for the specified origin and destination.";
        }
    } else {
        // Handle the case where the query fails
        echo "Error: Unable to fetch distance from the database: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_stmt_close($statement);
    mysqli_close($conn);
}

