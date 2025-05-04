<!DOCTYPE html>
<html lang="en">
  <head>

  <?php

    include("add_bus.php");
  ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Buses.css">

    <style>
        .form-container{
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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />'
    '
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          <span class="material-icons-outlined">search</span>
        </div>
        <div class="header-right">
          <span class="material-icons-outlined">account_circle</span>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">shopping_cart</span> STORE
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="index.php" >
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="Buses.php" >
              <span class="material-symbols-outlined">
                directions_bus
                </span> Buses
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="Drivers.php" >
              <span class="material-symbols-outlined">
                person
                </span> Drivers
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="customers.php" >
              <span class="material-icons-outlined">groups</span> Customers
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" >
              <span class="material-icons-outlined">fact_check</span> Inventory
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" >
              <span class="material-icons-outlined">poll</span> Reports
            </a>
          </li>

        </li>
        <li class="sidebar-list-item">
          <a href="seat tickets.html" >
            <span class="material-symbols-outlined">
              confirmation_number
              </span> Seat Tickets
          </a>
        </li>

        <li class="sidebar-list-item">
          <a href="hire tickets.html" >
            <span class="material-symbols-outlined">
              local_activity
              </span> Hire Tickets
          </a>
        </li>

        <li class="sidebar-list-item">
          <a href="Bus Schedule.html" >
            <span class="material-symbols-outlined">
              calendar_month
              </span> Bus Schedule
          </a>
        </li>
        
        <li class="sidebar-list-item">
          <a href="Maintenance.html" >
            <span class="material-symbols-outlined">
              calendar_month
              </span> Maintenance Schedule
          </a>
        </li>
          
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
       <main class="main-container">
        <h1>Buses</h1>
        <h1>Edit Driver</h1>
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
                     <input  type="text" id="time_stamp" name="time_stamp" value="<?php echo $schedule['time_stamp']; ?>">
                </div>
            

                <button type="submit">Save</button>
            </form>
        

     
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>

</html>


