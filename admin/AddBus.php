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
        
        

        <div class="form-container">
    <h1>Add New Bus</h1>
    <form action="add_bus.php" method="post">

        <br>

        <label for="bus_name">Bus Name:</label>
        <div>
            <input class="text-box" type="text" id="bus_name" name="bus_name" required>
        </div>

      
        <br>
        <label for="number_plate">Number Plate (ABC123 format):</label>
        <div>
            <input class="text-box" type="text" id="number_plate" name="number_plate" pattern="[A-Za-z]{3}\d{3}" title="Please enter a valid number plate in ABC123 format" maxlength="6" required>
        </div>

        <br>
        <label for="weight">Weight:</label>
        <div>
            <input class="text-box" type="number" id="weight" name="weight" min="0" required>
        </div>

        <br>
        <label for="mileage">Mileage:</label>
        <div>
            <input class="text-box" type="number" id="mileage" name="mileage" min="0">
        </div>

        <br>
        <label for="number_of_seats">Number of Seats:</label>
        <div>
            <input class="text-box" type="number" id="number_of_seats" name="number_of_seats" max="66" min="50" required>
        </div>

        <br>
        <label for="availability">Availability:</label>
        <div>
            <select id="availability" name="availability">
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
        </div>

        <br>
        <label for="bus_type">Bus Type:</label>
        <div>
            <select id="bus_type" name="bus_type">
                <option value="Passenger Bus">Passenger Bus</option>
                <option value="Hire Bus">Hire Bus</option>
            </select>
        </div>

        <div class="button-container">
            <button id="add-bus" type="submit">Add Bus</button>
        </div>

    </form>
</div>


        



        
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>

</html>


