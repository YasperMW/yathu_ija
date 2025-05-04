<?php 
require_once("../vendor/autoload.php");
require_once("../db_connection.php");

$sql ="SELECT * FROM seat_ticket st
JOIN schedule sc ON st.schedule_id = sc.schedule_id
JOIN route rt ON st.route_id = rt.route_id
JOIN bus b ON st.bus_id = b.bus_id
;
";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    $html = '
    <style>
    .table {
        width: 100%;
        border: 1px solid;
    }
    .th, td, tr {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    </style>
    <table class="table">';
    $html .= '<tr>
        <td>Ticket ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Payment Method</td>
        <td>Amount</td>
        <td>Origin</td>
        <td>Destination</td>
        <td>Bus Name</td>
        <td>Bus ID</td>
        <td>Seat Number</td>
        <td>Email</td>
        <td>Proof of Payment</td>
        <td>Card Number</td>
        <td>Expiry Date</td>
        <td>CCV</td>
        <td>Status</td>
        <td>Departure Time</td>
        <td>Customer Type</td>
    </tr>';

    while($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
            <td>' . $row['ticket_id'] . '</td>
            <td>' . $row['first_name'] . '</td>
            <td>' . $row['last_name'] . '</td>
            <td>' . $row['payment_method'] . '</td>
            <td>' . $row['amount'] . '</td>
            <td>' . $row['origin'] . '</td>
            <td>' . $row['destination'] . '</td>
            <td>' . $row['bus_name'] . '</td>
            <td>' . $row['bus_id'] . '</td>
            <td>' . $row['seat_number'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['proof_of_payment'] . '</td>
            <td>' . $row['card_number'] . '</td>
            <td>' . $row['expiry_date'] . '</td>
            <td>' . $row['ccv'] . '</td>
            <td>' . $row['status'] . '</td>
            <td>' . $row['time_stamp'] . '</td>
            <td>' . $row['customer_type'] . '</td>
        </tr>';
    }
    $html .= '</table>';
} else {
    $html = "Data not found";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = 'seat_tickets/' . time() . '.pdf'; // Save as PDF with unique timestamp
$mpdf->Output($file, 'I'); // Output PDF to browser

