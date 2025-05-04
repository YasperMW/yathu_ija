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

      .text-box{
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
      #add-schedule{
        margin: 20px;
        height: 30px;
        width: 290px;
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
        <h1>Add Schedule</h1>
        <form action="add_schedule_process.php" method="POST">

                <label for="schedule_name">Schedule Name:</label>
                <div>
                    <input  class="text-box"  type="text" id="schedule_name" name="schedule_name" required>
                </div>
                
            

                <label for="time_stamp">Time Stamp:</label>
                <div>
                    <input  class="text-box" type="text" id="time_stamp" name="time_stamp" required>
                </div>
                
                <br>

                <label for="date">Date:</label>
                <div>
                    <input  class="text-box" type="date" id="date" name="date" required>
                </div>
                
                

                <label for="route_id">Route ID:</label>
                <div>
                    <input  class="text-box" type="number" id="route_id" name="route_id" required>
                </div>
                
                <br>

                <label for="bus_id">Bus ID:</label>
                <div>
                    <input  class="text-box" type="number" id="bus_id" name="bus_id" required>
                </div>
                
            

                <label for="driver_id">Driver ID:</label>
                <div>
                     <input class="text-box" type="number" id="driver_id" name="driver_id" required>
                </div>
               
                

                <br>

                <button id="add-schedule" type="submit" class="add-btn">ADD THIS SCHEDULE TO OUR DATABASE</button>
        </form>
        

     
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>

</html>


