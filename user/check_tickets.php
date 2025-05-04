<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Tickets</title>
   <?php
    session_start(); 
    
    if (!isset($_SESSION['user_email'])){
        header('location: ../login.php');
    }
    ?>
 <link rel="stylesheet" href="check_tickets.css">
 <style>
#myModal{
    align-items: center;
    justify-content: center;
}

.modal-content1{
   
    width: 50%;
    background-color: grey;
}

.modal-content p {
   margin-bottom: 10px;
}
.modal-confirm-button,
.modal-cancel-button {
width: 45%; 
box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

.modal-content button {
margin-top: 10px; 
}
.modal-confirm-button {
   background-color: #f44336;
   color: white;
   border: none;
   cursor: pointer;
   padding: 10px 20px;
   border-radius: 5px;
   margin-right: 10px;
}
.modal-confirm-button:hover {
   background-color: #da190b;
}
.modal-cancel-button {
   background-color: #ddd;
   color: #333;
   border: none;
   cursor: pointer;
   padding: 10px 20px;
   border-radius: 5px;
}
.modal-cancel-button:hover {
   background-color: #bbb;
}

 </style>
   
</head>
<body>
<?php include 'user_dashboard_navbar.php'; ?>

<br><br>
<h1 class="mt-4 mb-3">Tickets</h1>

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="user_dashboard.php">Home</a>
    </li>
    <li class="breadcrumb-item active">My Tickets</li>
</ol>


<?php
// Connect to your database
require_once('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    // Redirect or handle the case where the user is not logged in
    echo "<p>User not logged in.</p>";
} else {
    // Retrieve user's email from session
    $user_email = $_SESSION['user_email'];

    // Retrieve tickets from the database based on the user's email
    $sql = "SELECT st.ticket_id, 
    st.first_name, 
    st.last_name, 
    st.email, 
    st.date_of_birth,
    st.gender,
    st.status, 
    st.customer_type, 
    st.payment_method,
    st.original_amount, 
    st.amount, 
    rt.origin, 
    rt.destination, 
    sc.date AS schedule_date, 
    sc.time_stamp, 
    b.bus_name, 
    st.seat_number
        FROM seat_ticket st
        JOIN schedule sc ON st.schedule_id = sc.schedule_id
        JOIN route rt ON st.route_id = rt.route_id
        JOIN bus b ON st.bus_id = b.bus_id
        WHERE st.email = ?;
        ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Tickets found, display them
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="receipt"> <!-- Start ticket container -->
            <p><strong>Ticket ID:</strong> <?php echo $row['ticket_id']; ?></p>
            <p><strong>Passenger Name:</strong> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Date OF Birth:</strong> <?php echo $row['date_of_birth']; ?></p>
            <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
            <p><strong>Customer Type:</strong> <?php echo $row['customer_type']; ?></p>
            <p><strong>Origin:</strong> <?php echo $row['origin']; ?></p>
            <p><strong>Destination:</strong> <?php echo $row['destination']; ?></p>
            <p><strong>Date:</strong> <?php echo $row['schedule_date']; ?></p>
            <p><strong>Departure Time:</strong> <?php echo $row['time_stamp']; ?></p>
            <p><strong>Bus Name:</strong> <?php echo $row['bus_name']; ?></p>
            <p><strong>Seat Number:</strong> <?php echo $row['seat_number']; ?></p>
            <p><strong>Payment Method:</strong> <?php echo $row['payment_method']; ?></p>
            <p><strong>Original Amount:</strong> <?php echo $row['original_amount']; ?></p>
            <p><strong>Discount Applied:</strong> <?php echo ( ($row['original_amount'] - $row['amount'] )/ $row['original_amount']*100); ?>%</p> <!-- Display the actual discount applied -->
            <p><strong>Amount After Discount:</strong> <?php echo $row['amount']; ?></p> <!-- Display the final amount after discount -->
            <p><strong>Payable Amount:</strong> <?php echo $row['amount']; ?></p>
            <p><strong>Ticket Status:</strong> <?php echo $row['status']; ?></p>


                <button  class="cancel-button" onclick="downloadSeatTicket(<?php echo $row['ticket_id']; ?>)">Download Ticket</button>
                <!-- Add cancel button with onclick event to open the confirmation modal -->
                <button class="cancel-button" onclick="openModal(<?php echo $row['ticket_id']; ?>)">Cancel Ticket</button>
            </div> 
            <?php
        }
    } else {
        // No tickets found for the user
        echo "<p>No tickets available.</p>";
    }

   // Retrieve details from the database based on the ticket ID
   $sql = "SELECT DISTINCT 
   b.bus_id, b.bus_name, b.number_plate, b.number_of_seats,
   h.hire_receipt_id, h.first_name, h.last_name, h.email,h.payment_method,h.payable_amount,
   h.receipt_status ,specified_distance
   FROM hire_receipt h
   JOIN bus b ON b.bus_id = h.bus_id
   WHERE h.email= ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

 if ($result->num_rows > 0)  {
        echo "<h2>Hire Receipts</h2>";
        // Display hire receipts
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="receipt"> <!-- Start receipt container -->
                <p><strong>Receipt ID:</strong> <?php echo $row['hire_receipt_id']; ?></p>
                <p><strong>Name:</strong> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <p><strong>Bus Name:</strong> <?php echo $row['bus_name']; ?></p>
                <p><strong>Capacity:</strong> <?php echo $row['number_of_seats']; ?></p>
                <p><strong>Specified Distance:</strong> <?php echo $row['specified_distance']; ?></p>
                <p><strong>Payable Amount:</strong> <?php echo $row['payable_amount']; ?></p>
                <p><strong>Payment Method:</strong> <?php echo $row['payment_method']; ?></p>
                <p><strong>Hiring Status:</strong> <?php echo $row['receipt_status']; ?></p>
                <!-- Add other fields as desired -->

                <button  class="cancel-button" onclick="downloadReceipt(<?php echo $row['hire_receipt_id']; ?>)">Download Ticket</button>
                <!-- Add cancel button with onclick event to open the confirmation modal -->
                <button class="cancel-button" onclick="openModal(<?php echo $row['hire_receipt_id']; ?>)">Cancel Ticket</button>
            </div>  
            <?php
        }
    } else {
        echo "<p>No hire receipts available.</p>";
    }

    $stmt->close();
}
?>


<!-- Modal dialog for confirmation -->
<div>
<div id="myModal" class="modal" >
    <div class="modal-content1" id="modal-size" >
       
      
    <div>
    <p>Are you sure you want to cancel this ticket?</p>
    </div>
    <div> 
        <button class="modal-confirm-button" id="confirmCancelBtn">Yes</button>
        <button class="modal-cancel-button" onclick="closeModal()">No</button>
    </div>
       
       
    </div>
</div>
</div>
<script >
       // Get the modal
       var modal = document.getElementById("myModal");

function openModal(ticketId) {
  
modal.style.display = "flex";
// Set the ticket ID as a data attribute of the confirmation button
document.getElementById('confirmCancelBtn').setAttribute('data-ticket-id', ticketId);
  // Disable scrolling on the body
  document.body.style.overflow = 'hidden';
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Function to close the modal
function closeModal() {
    modal.style.display = "none";
    document.body.style.overflow = 'auto';
}

// Function to cancel the ticket
document.getElementById('confirmCancelBtn').addEventListener('click', function() {
    var ticketId = this.getAttribute('data-ticket-id');
    // Send an AJAX request to delete the ticket from the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cancel_seat_ticket.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Reload the page after successful cancellation
            window.location.reload();
        }
    };
    xhr.send("ticket_id=" + ticketId);
    // Close the modal
    modal.style.display = "none";
});


// Function to cancel the Hire_ticket
document.getElementById('confirmCancelBtn').addEventListener('click', function() {
    var ticketId = this.getAttribute('data-ticket-id');
    // Send an AJAX request to delete the ticket from the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cancel_Hire_ticket.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Reload the page after successful cancellation
            window.location.reload();
        }
    };
    xhr.send("ticket_id=" + ticketId);
    // Close the modal
    modal.style.display = "none";
});
function downloadReceipt(hire_receipt_id){
    window.location.href='download_receipt.php?hire_receipt_id=' +hire_receipt_id;
} 

    function downloadSeatTicket(ticketId) {
        // Redirect to a PHP script that generates and downloads the ticket PDF
        window.location.href = 'download_ticket.php?ticket_id=' + ticketId;
    }
</script>


<?php include 'footer.php'; ?>
</body>
</html>
