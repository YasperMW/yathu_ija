<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Success</title>
    <?php session_start();
    include "head.php";

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if not logged in
        header("Location: ../login.php");
        exit();
    }
    ?>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .receipt {
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 20px;
            width: 400px;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .receipt h2 {
            text-align: center;
            color: #333;
        }
        .receipt p {
            margin: 10px 0;
            color: #666;
        }
        .receipt p strong {
            color: #333;
        }
    </style>
</head>
<body>
    <?php include("user_dashboard_navbar.php"); ?>

<br><br>

    <h1 class="mt-4 mb-3">Booking
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="user_dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Booking Successful</li>
    </ol>

    <div class="receipt">

        <h2>Booking Receipt</h2>
        <?php

// Connect to your database
require_once('db_connection.php');

if (isset($_SESSION['ticket_id'])) {
    $ticketId = $_SESSION['ticket_id'];

    $sql = "SELECT st.ticket_id, 
                st.first_name, 
                st.last_name, 
                st.email,
                st.status, 
                st.date_of_birth, 
                st.customer_type, 
                st.payment_method, 
                st.amount,
                st.gender,
                st.original_amount,    
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
            WHERE st.ticket_id = ?;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ticketId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        
            <p><strong>Ticket ID:</strong> <?php echo $row['ticket_id']; ?></p>
            <p><strong>Passenger Name:</strong> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Date OF Birth:</strong> <?php echo $row['date_of_birth']; ?></p>
            <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
            <p><strong>Customer Type:</strong> <?php echo $row['customer_type']; ?></p>

            <p><strong>Origin:</strong> <?php echo $row['origin']; ?></p>
            <p><strong>Destination:</strong> <?php echo $row['destination']; ?></p>
            <p><strong>Date of Departure:</strong> <?php echo $row['schedule_date']; ?></p>
            <p><strong>Departure Time:</strong> <?php echo $row['time_stamp']; ?></p>
            <p><strong>Bus Name:</strong> <?php echo $row['bus_name']; ?></p>
            <p><strong>Seat Number:</strong> <?php echo $row['seat_number']; ?></p>

            <p><strong>Payment Method:</strong> <?php echo $row['payment_method']; ?></p>
            <p><strong>Original Amount:</strong> <?php echo $row['original_amount']; ?></p>
            <p><strong>Discount Applied:</strong> <?php echo ( ($row['original_amount'] - $row['amount'] )/ $row['original_amount']*100); ?>%</p> <!-- Display the actual discount applied -->
            <p><strong>Amount After Discount:</strong> <?php echo $row['amount']; ?></p> <!-- Display the final amount after discount -->
            <p><strong>Ticket Status:</strong> <?php echo $row['status']; ?></p>
        <?php
    } else {
        echo "<p>No ticket found with the provided Ticket ID.</p>";
    }
} else {
    echo "<p>Ticket ID not provided.</p>";
}
  ?>
  
    

</div>
<br><br><br>

    <?php include 'footer.php'; ?>
</body>
</html>
