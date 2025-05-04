<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
require_once("db_connection.php");

// Get the user ID of the logged-in user
$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if there is a result
if ($result->num_rows > 0) {
    // Fetch the user details
    $user = $result->fetch_assoc();
} else {
    // User not found, handle error
    echo "Error: User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>My Profile</h1>
        <div class="profile-details">
            <p><strong>User ID:</strong> <?php echo $user['user_id']; ?></p>
            <p><strong>First Name:</strong> <?php echo $user['first_name']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $user['last_name']; ?></p>
            <p><strong>User Type:</strong> <?php echo $user['user_type']; ?></p>
            <p><strong>Phone Number:</strong> <?php echo $user['phone_number']; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo $user['date_of_birth']; ?></p>
            <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <!-- You can add more user details here as needed -->
        </div>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
