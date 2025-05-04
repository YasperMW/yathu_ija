<?php session_start();





// Check if the user is logged in
if(!isset($_SESSION['user_email'])) {
   

    // Redirect user to login page if not logged in
    header("location: ../index.php");
    exit();


}
 ?>
 <!-- Header -->
 <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        
        <div class="header-right">
          <a href="admin_profile"><span class="material-icons-outlined">account_circle</span></a>
            
         
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
          <a href="index.php" >
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          
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
            <a href="users.php" >
              <span class="material-icons-outlined">groups</span> Users
            </a>
          </li>
         
        <li class="sidebar-list-item">
          <a href="seat tickets.php" >
            <span class="material-symbols-outlined">
              confirmation_number
              </span> Seat Tickets
          </a>
        </li>

        <li class="sidebar-list-item">
          <a href="hire tickets.php" >
            <span class="material-symbols-outlined">
              local_activity
              </span> Hire Tickets
          </a>
        </li>

        <li class="sidebar-list-item">
          <a href="routes.php" >
            <span class="material-symbols-outlined">
              local_activity
              </span> Routes
          </a>
        </li>
        <li class="sidebar-list-item">
          <a href="Bus Schedule.php" >
            <span class="material-symbols-outlined">
              calendar_month
              </span> Bus Schedule
          </a>
        </li>
        
        <li class="sidebar-list-item">
          <a href="Maintenance.php" >
            <span class="material-symbols-outlined">
              calendar_month
              </span> Maintenance Schedule
          </a>
        </li>
        <li class="sidebar-list-item">
            <a href="feedbacks.php" >
              <span class="material-icons-outlined">poll</span> Feedbacks
            </a>
          </li>

          <li class="sidebar-list-item">
          <a href="logout.php">
          <span class="material-symbols-outlined">
          logout
          </span>Logout</a>
            </a>
          </li>

        </ul>
      </aside>
      <!-- End Sidebar -->
