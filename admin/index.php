<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

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
     <?php include  ("cardDisplay.php");?>
      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <h2>DASHBOARD</h2>
        </div>

        <div class="main-cards">
            <div class="card">
              <div class="card-inner">
                <h3>BUSES</h3>
                <span class="material-symbols-outlined">
                  directions_bus
                  </span>
              </div>
              <h1>
              <?php echo $total_buses; ?>
              </h1>
          </div>

          <div class="card">
              <div class="card-inner">
                <h3>DRIVERS</h3>
                <span class="material-symbols-outlined">
                  person
                  </span>
              </div>
                <h1>
                  <?php echo $total_drivers; ?>
                </h1>
          </div>

          <div class="card">
              <div class="card-inner">
                <h3>USERS</h3>
                <span class="material-symbols-outlined">
                  groups
                  </span>
              </div>
              <h1>
                <?php echo $total_users; ?>
              </h1>
          </div>

          <div class="card">
              <div class="card-inner">
                <h3>SEAT TICKETS</h3>
                <span class="material-symbols-outlined">
                  confirmation_number
                  </span>
              </div>
              <h1>
                <?php echo $total_tickets; ?>
              </h1>
            </div>
            
            <div class="card">
              <div class="card-inner">
                <h3>TICKET REVENUE</h3>
                <span class="material-symbols-outlined">
                  payments
                  </span>
              </div>
              <h1>
                K<?php echo number_format($total_revenue, 0, '.', ','); ?>
              </h1>
            </div>

            <div class="card">
              <div class="card-inner">
                <h3>HIRE REVENUE</h3>
                <span class="material-symbols-outlined">
                    attach_money
                </span>
              </div>
              <h1>
              K<?php echo number_format($total_Hrevenue, 0, '.', ','); ?>
              </h1>
            </div>

            <div class="card">
              <div class="card-inner">
                <h3>AVAIL. FUEL</h3>
                <span class="material-symbols-outlined">
                    local_gas_station
                </span>
              </div>
              <h1>
              <?php
                  echo number_format($fuel_revenue,0,'.',',');
              ?>L
              </h1>
            </div>


            <div class="card"  style="
                      background-color: maroon;"
                  >
              <div class="card-inner">
                <h3>HIRE RECIEPTS</h3>
                <span class="material-symbols-outlined">
                  confirmation_number
                  </span>
              </div>
              <h1>
                <?php echo $total_receipts; ?>
              </h1>
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