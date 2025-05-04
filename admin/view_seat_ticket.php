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
            <h2>Ticket Details</h2>
        </div>
        <div class="content">
            <?php 
            // Include database connection
            require_once("db_connection.php");

           
            $ticket_id = $_GET['ticket_id'];
          

           
            $sql ="SELECT * FROM seat_ticket st
                JOIN schedule sc ON st.schedule_id = sc.schedule_id
                JOIN route rt ON st.route_id = rt.route_id
                JOIN bus b ON st.bus_id = b.bus_id
                WHERE st.ticket_id=?;
                ";
           $stmt = $conn->prepare($sql);
           $stmt->bind_param("s", $ticket_id);
           $stmt->execute();
           $result = $stmt->get_result();

            // Check if there is a result
            if ($result->num_rows > 0) {
                // Fetch the ticket details
                $ticket= mysqli_fetch_assoc($result);
            ?>
            <div class="cards">
                <div class="detail">
                    <label>Ticket ID:</label> <?php echo $ticket['ticket_id']; ?>
                </div>
                <div class="detail">
                    <label> Name:</label> <?php echo $ticket['first_name']; ?>
                </div>
                <div class="detail">
                    <label>Date Of Birth:</label> <?php echo $ticket['date_of_birth']; ?>
                </div>
                <div class="detail">
                    <label> Gender:</label> <?php echo $ticket['gender']; ?>
                </div>
                <div class="detail">
                    <label> Email:</label> <?php echo $ticket['email']; ?>
                </div>
                <div class="detail">
                    <label> Customer Type:</label> <?php echo $ticket['customer_type']; ?>
                </div>
                <div class="detail">
                    <label> Date Of Departure:</label> <?php echo $ticket['booking_date']; ?>
                </div>
                <div class="detail">
                    <label> Departure Time:</label> <?php echo $ticket['time_stamp']; ?>
                </div>
                <div class="detail">
                    <label> Bus Name</label> <?php echo $ticket['bus_name']; ?>
                </div>

                <div class="detail">
                    <label>Seat number:</label> <?php echo $ticket['seat_number']; ?>
                </div>
                <div class="detail">
                    <label>Origin:</label> <?php echo $ticket['origin']; ?>
                </div>
                <div class="detail">
                    <label>Destination:</label> <?php echo $ticket['destination']; ?>
                </div>
                <div class="detail">
                    <label> Original Amount:</label> <?php echo $ticket['original_amount']; ?>
                </div>
                <div class="detail">
                    <label> Payable Amount:</label> <?php echo $ticket['amount']; ?>
                </div>
                <div class="detail">
                    <label>Ticket Status:</label> <?php echo $ticket['status']; ?>
                </div>
                <div class="detail">
                    <img src="../user/<?php echo $ticket['proof_of_payment']?>" width="400px" alt="Proof Of payment">

                    
                </div>
            </div>
            <?php
            } else {
                echo "<p>ticket not found.</p>";
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


