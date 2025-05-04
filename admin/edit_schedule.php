<?php
// Retrieve schedule information from the database based on the provided ID
if (isset($_POST['schedule_id'])) {
    $schedule_id = $_POST['schedule_id'];
    require_once("db_connection.php");
    $sql = "SELECT * FROM schedule WHERE schedule_id = $schedule_id";
    $result = mysqli_query($conn, $sql);
    $schedule = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Buses.css">

    <style>
        form{
        display: flex;
        align-items: center;
        flex-direction: column;
        }

      .schedule-edit{
        width: 500px;
        height: 30px;
      }

      #availability{
        width: 508px;
        height: 30px;
      }
      .button-container{
        display: flex;
        justify-content: space-around;
      }
      #add-bus{
        margin: 20px;
        height: 30px;
        width: 150px;
      }

      #bus_type{
        width: 508px;
        height: 30px;
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
       
        <h1 style="
            TEXT-ALIGN: center";>Edit Schedule</h1>
            <form action="update_schedule.php" method="POST">


            <input class="schedule-edit" name="schedule_id" value="<?php echo $schedule['schedule_id']; ?>" readonly>
                
                

                <label for="schedule_name">Schedule Name:</label>

                <div>
                    <input class="schedule-edit" type="text" id="schedule_name" name="schedule_name" value="<?php echo $schedule['schedule_name']; ?>">
                </div>
            
                <label for="date">Date:</label>
                <div>
                    <input class="schedule-edit" type="date" id="date" name="date" value="<?php echo $schedule['date']; ?>">
                </div>
                
                

                <label for="route_id">Route ID:</label>
                
                <div>
                    <input class="schedule-edit" type="number" id="route_id" name="route_id" value="<?php echo $schedule['route_id']; ?>">
                </div>
                
                
                <label for="bus_id">Bus ID:</label>

                <div>
                    <input class="schedule-edit" type="number" id="bus_id" name="bus_id" value="<?php echo $schedule['bus_id']; ?>">
                </div>
                

                <label for="driver_id">Driver ID:</label>

                <div>
                    <input class="schedule-edit" type="number" id="driver_id" name="driver_id" value="<?php echo $schedule['driver_id']; ?>">
                </div>

                <label for="time_stamp">Time Stamp:</label>
                <div>
                     <input class="schedule-edit" type="text" id="time_stamp" name="time_stamp" value="<?php echo $schedule['time_stamp']; ?>">
                </div>
            
                <br>

                <button class="schedule-edit" type="submit">Save</button>
            </form>
        

     
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>

</html>


