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
  


    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/seat_tickets.css">
   <style>
   table {
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


        
       
            </style>

    
  </head>
  <body>
    <div class="grid-container">

    <?php include  ("header_sidebar.php");?>

      <!-- Main -->
  
      <main class="main-container">
      <div class="container">
            <div class="card-header">
                <h2 class="display-6 text-center">Hire Receipts</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr class="bg-dark text-white">
                        <th>Receipt ID</th>
                        
                        <th>Bus Name</th>
                       
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Specified Distance</th>
                        <th>Payable Amount</th>
                        <th>Hire Status</th>
                        <th>Action</th>
                        <th>Action 2</th>
                        <th>Action 3</th>
                    </tr>
                    <?php
                    // Construct the query to fetch data from hire_receipt table
                    $query = "SELECT hr.hire_receipt_id, 
                    hr.hire_receipt_id,
                    hr.first_name,
                    hr.last_name,
                    hr.email,
                    hr.specified_distance, 
                    hr.payable_amount,
                    b.bus_name,
                    b.bus_id, 
                  
                    hr.receipt_status
                        FROM hire_receipt hr
                        JOIN bus b ON hr.bus_id = b.bus_id
                        ;
                        ";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['hire_receipt_id'] ?></td>
                                <td><?php echo $row['bus_name'] ?></td>
                                
                                <td><?php echo $row['first_name'] ?></td>
                                <td><?php echo $row['last_name'] ?></td>
                                <td><?php echo $row['specified_distance'] ?></td>
                                <td><?php echo $row['payable_amount'] ?></td>
                                <td><?php echo $row['receipt_status'] ?></td>
                                <td><button class="btn btn-primary"><a href="view_hire_receipt.php?hire_receipt_id=<?php 
                                        echo$row['hire_receipt_id']?>">View More</a> </button></td>
                                <td><button class="btn btn-primary"><a href="view_hire_receipt.php?hire_receipt_id=<?php 
                                        echo$row['hire_receipt_id']?>">View More</a> </button></td>
                                <td><button class="btn btn-danger" onclick="openDeleteModal(<?php echo $row['hire_receipt_id']; ?>)">Delete</button></td>
                                 
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="9">No Hire Receipts Available.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        
    <div class="PDF-download">
                <a href="PDF/HireTicketPDF.php">
                <button class="alt-btn">Download PDF</button>

                </a>
           
            </div>

    

      </main>
      <!-- End Main -->

    </div>
  

  </div>
</div>

<!-- Modal for updating ticket details -->
<!-- Update modal container -->
<div id="updateModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" id="closeUpdateModalBtn">&times;</span>
    <h2>Update Payment Status</h2>
    <!-- Form for updating receipt details -->
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
      <button type="button" id="cancelUpdateBtn" onclick="closeUpdateModal()">Cancel</button>
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
        <button class="modal-confirm-button" id="confirmDeleteBtn">Yes</button>
        <button class="modal-cancel-button" onclick="closeModal()">No</button>
    </div>
</div>



    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/hire_receipt.js"></script>
</script>
    <script src="js/scripts.js"></script>

<script>// Function to close the update modal
function closeUpdateModal() {
    // Get the update modal element
    var updateModal = document.getElementById("updateModal");
    
    // Close the update modal
    updateModal.style.display = "none";
  }</script>
  </body>
</html>