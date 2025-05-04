<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input and convert to uppercase
function sanitizeAndUppercase($input) {
    // Convert to uppercase and sanitize input
    return strtoupper(trim($input));
}

// Check if all required fields are set and not empty
if(isset($_POST['bus_name'], $_POST['number_plate'], $_POST['weight'], $_POST['availability'], $_POST['bus_type'], $_POST['number_of_seats']) 
    && !empty($_POST['bus_name']) && !empty($_POST['number_plate']) && !empty($_POST['weight']) && !empty($_POST['availability']) && !empty($_POST['bus_type']) && !empty($_POST['number_of_seats'])) {
    
    // Assign values to variables and sanitize input
    $bus_name = sanitizeAndUppercase($_POST['bus_name']);
    $number_plate = sanitizeAndUppercase($_POST['number_plate']);
    $weight = $_POST['weight'] >= 0 ? $_POST['weight'] : 0; // Ensure weight is non-negative
    $mileage = isset($_POST['mileage']) ? $_POST['mileage'] : null;
    $availability = sanitizeAndUppercase($_POST['availability']);
    $bus_type = sanitizeAndUppercase($_POST['bus_type']);
    $number_of_seats = $_POST['number_of_seats']; 

    // Prepare SQL statement
    $sql = "INSERT INTO bus (bus_name, bus_type, number_plate, number_of_seats, weight, mileage, availability)
            VALUES ('$bus_name', '$bus_type', '$number_plate', '$number_of_seats', '$weight', '$mileage', '$availability')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the Buses.php page
        header("Location: Buses.php");
        exit(); // Ensure script stops execution after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "One or more required fields are not set or empty.";
}

$conn->close();
?>
