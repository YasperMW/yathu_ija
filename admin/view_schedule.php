<!DOCTYPE html>
<html lang="en">
  <head>

 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Buses.css">

    <style>
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
        
    }
    .container {
        background-color: #263043;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .header {
       
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px 5px 0 0;
    }
    .head{
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px 5px 0 0;
    }
    .content {
        padding: 20px;
    }
    .detail {
        margin-bottom: 10px;
    }
    .detail label {
        font-weight: bold;
    }
    .cards{
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        padding: 25px;
        border-radius: 5px;
    }
    </style>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <div class="grid-container">

   
    <?php include  ("header_sidebar.php");?>

      <!-- Main -->
       <main class="main-container">
       
        
        

        <div class="container">
        <div class="head">
            <h2>Schedule Details</h2>
        </div>
        <div class="content">
            <?php 
            // Include database connection
            require_once("db_connection.php");

            // Retrieve route_id and bus_id from query parameters
            $route_id = $_GET['route_id'];
            $bus_id = $_GET['bus_id'];

            // Retrieve schedule information based on route_id and bus_id
            $sql = "SELECT * FROM schedule WHERE route_id = $route_id AND bus_id = $bus_id";
            $result = mysqli_query($conn, $sql);

            // Check if there is a result
            if (mysqli_num_rows($result) > 0) {
                // Fetch the schedule details
                $schedule = mysqli_fetch_assoc($result);
            ?>
            <div class="cards">
                <div class="detail">
                    <label>Schedule ID:</label> <?php echo $schedule['schedule_id']; ?>
                </div>
                <div class="detail">
                    <label>Schedule Name:</label> <?php echo $schedule['schedule_name']; ?>
                </div>
                <div class="detail">
                    <label>Time Stamp:</label> <?php echo $schedule['time_stamp']; ?>
                </div>
                <div class="detail">
                    <label>Date of Departure:</label> <?php echo $schedule['date']; ?>
                </div>
                <div class="detail">
                    <label>Route ID:</label> <?php echo $schedule['route_id']; ?>
                </div>
                <div class="detail">
                    <label>Bus ID:</label> <?php echo $schedule['bus_id']; ?>
                </div>
                <div class="detail">
                    <label>Driver ID:</label> <?php echo $schedule['driver_id']; ?>
                </div>
            </div>
            <?php
            } else {
                echo "<p>Schedule not found.</p>";
            }
            ?>
        </div>
    </div>


        



        
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>

</html>


