

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/styles.css">
    <style> 
       
       
        .container {
         
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-details {
            margin-top: 20px;
        }
        .profile-details p {
            margin-bottom: 10px;
        }
        .profile-details strong {
            margin-right: 5px;
        }
        .profile-details a {
            color: #4CAF50;
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }
        .profile-details a:hover {
            text-decoration: underline;
        }

    

    </style>
</head>


<body>
    <div class="grid-container">
        <?php include("header_sidebar.php");?>
        <!-- Main -->
        <main class="main-container">
          

        <?php

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
        <div class="container">

        
        <h1>My Profile</h1>
        <div class="profile-details">
          
            <p><strong> Name:</strong> <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></p></p>

         
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            
        <a href="logout.php">Logout</a>
    </div>

           
            </div>
        </main>
        <!-- End Main -->
    </div>
   
  
</body>
</html>
