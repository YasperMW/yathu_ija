<?php    // Start a PHP session
session_start();

if (!isset($_SESSION['user_email'])){
    header('location: ../login.php');
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <?php include 'head.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        #container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.6;
        }
        strong {
            font-weight: bold;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .logout-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php include 'user_dashboard_navbar.php'; ?>

<br><br><br>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="user_dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item active">My Profile</li>
    </ol>

<div class="container" id="container">
    <?php
    // Include the database connection file
    require_once('db_connection.php');

 
    

    // Retrieve user details from the database based on user ID
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, display profile details
        $row = $result->fetch_assoc();
        echo "<h1>User Profile</h1>";
        echo "<p><strong>Name:</strong> " . $row['first_name'] . " " . $row['last_name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
        // Add other profile details as needed
    } else {
        // User not found
        echo "<p>User not found.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
    <div class="logout-link">
        <p><a href="logout.php">Logout</a></p>
    </div>
</div>
<br><br><br><br>
<?php include 'footer.php'; ?>
</body>
</html>
