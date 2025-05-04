<?php
require_once("../admin/vendor/autoload.php");
require_once("../db_connection.php");

// Check if the ticket ID is provided in the URL
if(isset($_GET['ticket_id'])) {
    // Retrieve the ticket ID from the URL
    $ticketId = $_GET['ticket_id'];

    // Retrieve ticket details from the database for the given ticket ID
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
       WHERE st.ticket_id = $ticketId ;
       ";

$result = mysqli_query($conn, $sql);
    if ($result->num_rows == 1) {
        // Ticket found, generate PDF
        $row = $result->fetch_assoc();

        // Create HTML content for the ticket
        $html = '
            <div class="receipt"> <!-- Start ticket container -->
                <p><strong>Ticket ID:</strong> ' . $row['ticket_id'] . '</p>
                <p><strong>Passenger Name:</strong> ' . $row['first_name'] . ' ' . $row['last_name'] . '</p>
                <p><strong>Email:</strong> ' . $row['email'] . '</p>
                <p><strong>Payment Method:</strong> ' . $row['payment_method'] . '</p>
                <p><strong>Amount:</strong> ' . $row['amount'] . '</p>
                <p><strong>Origin:</strong> ' . $row['origin'] . '</p>
                <p><strong>Destination:</strong> ' . $row['destination'] . '</p>
                <p><strong>Departure Time:</strong> ' . $row['time_stamp'] . '</p>
                <p><strong>Bus Name:</strong> ' . $row['bus_name'] . '</p>
                
                <p><strong>Seat Number:</strong> ' . $row['seat_number'] . '</p>
                <p><strong>Payment Status:</strong> ' . $row['status'] . '</p>
            </div>';

        // Generate PDF
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('ticket_' . $ticketId . '.pdf', 'I'); // Output PDF as download with filename

        exit; // Stop further execution
    }
}


