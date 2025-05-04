<?php 
include 'db_connection.php'?>
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
  <style>table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color:black;
        }

        tr{
          transition-duration: .3s;
        }
        tr:hover {
            background-color: green;
            transition-duration: .3s;
        }
        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }


        

        .header {
            grid-area: header;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px 0 30px;
            box-shadow: 0 6px 7px -3px rgba(0, 0, 0, 0.35);
  
            }</style>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/seat_tickets.css">

    
  </head>
  <body>
    <div class="grid-container">

    <?php include  ("header_sidebar.php");?>

      <!-- Main -->
 
       

      <main class="main-container">
    <div class="container">
        <div class="card-header">
            <h2 class="display-6 text-center">Seat Tickets</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                        <tr class="bg-dark text-white">
                            <th>Ticket ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Amount</th>
                            <th>Bus Name</th>

                            <th>email</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Action 2</th>
                            <th>Action 3</th>
                        </tr>
                        <?php

              
                    
                           // Construct the search query using the captured data
    $sql = "SELECT st.ticket_id, 
    st.first_name, 
    st.last_name, 
    st.email, 
    st.date_of_birth, 
    st.customer_type, 
    st.payment_method, 
    st.amount, 
    rt.origin, 
    rt.destination, 
    sc.date AS schedule_date, 
    sc.time_stamp, 
    b.bus_name,
    b.bus_id, 
    st.seat_number,
    st.status
        FROM seat_ticket st
        JOIN schedule sc ON st.schedule_id = sc.schedule_id
        JOIN route rt ON st.route_id = rt.route_id
        JOIN bus b ON st.bus_id = b.bus_id
        ;
        ";
    $stmt = $conn->prepare($sql);
    
    $stmt->execute();
    $result = $stmt->get_result();

                       
                           if (($result->num_rows > 0)) {
                               while ($row = mysqli_fetch_assoc($result)) {
                                   ?>
                                   <tr>
                                       
                                       <td><?php echo $row['ticket_id'] ?></td>
                                       <td><?php echo $row['first_name'] ?></td>
                                       <td><?php echo $row['last_name'] ?></td>
                                       <td> <?php echo  $row['amount']?></td>
                                       <td> <?php echo  $row['bus_name']?></td>
                                       <td> <?php echo  $row['email']?></td>
                                       <td> <?php echo  $row['status']?></td>
                                       <td><button class="btn btn-danger" onclick="openModal(<?php echo $row['ticket_id']; ?>)">Delete</button></td>
                                       <td><button class="btn btn-primary" onclick="openUpdateModal(<?php echo $row['ticket_id']; ?>)">Update</button></td>
                                       <td><button class="btn btn-primary"><a href="view_seat_ticket.php?ticket_id=<?php 
                                        echo$row['ticket_id']?>">View More</a> </button></td>
                                      
                                   </tr>
                               <?php
                               }
                               
                           } else {
                               ?>
                               <tr>
                                   <td colspan="5">No Tickets Available.</td>
                               </tr>
                           <?php
                           }
                       
                        ?> 
                    </table>

                          </div>
    </div>
        


    <div class="PDF-download">
                <a href="PDF/SeatTicketPDF.php">
                <button class="alt-btn">Download PDF</button>

                </a>
           
            </div>

      </main>
      <!-- End Main -->

    </div>
  
<!-- Modal for updating ticket details -->
<!-- Update modal container -->
<div id="updateModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" id="closeUpdateModalBtn">&times;</span>
    <h2>Update Payment Status</h2>
    <!-- Form for updating ticket details -->
    <form id="updateTicketForm">
      <!-- Ticket ID (hidden input) -->
      <input type="hidden" id="updateTicketId">
      
      <div class="form-group">
    <label for="updateTicketPayment">Payment Status</label>
    <select id="status" class="form-control">
      <option value="paid">Paid</option>
      <option value="not paid">Not Paid</option>
      <option value="pending confirmation">Pending Confirmation</option>
    </select>
  </div>
      
      <button type="submit">Update</button>
      <button type="button" id="cancelUpdateBtn">Cancel</button>
    </form>
  </div>
</div>


<div id="popupModal" class="popup-modal">
  <div class="popup-content">
    <span class="close-popup" onclick="closePopupModal()">&times;</span>
    <p id="popupMessage"></p>
  </div>
</div>
    
    
<!-- Modal dialog for confirmation -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to cancel this ticket?</p>
        <button class="modal-confirm-button" id="confirmCancelBtn">Yes</button>
        <button class="modal-cancel-button" onclick="closeModal()">No</button>
    </div>
</div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/seat_tickets.js"></script>

    <script src="js/scripts.js"></script>


  </body>
</html>