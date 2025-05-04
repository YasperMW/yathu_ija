<?php 
require_once("../vendor/autoload.php");
require_once("../db_connection.php");

$sql ="SELECT * FROM hire_receipt hr
JOIN bus b ON hr.bus_id = b.bus_id
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
        <td>Receipt ID</td>
        <td>Bus ID</td>
        <td>Bus Name</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Email</td>
        <td>Specified Distance</td>
        <td>Payable Amount</td>
        <td>Payment Method</td>
        <td>Gender</td>
        <td>Date of Birth</td>
        <td>Receipt Status</td>
        <td>Credit Card Number</td>
        <td>Expiry Date</td>
        <td>CCV</td>
        <td>Proof of Payment</td>
    </tr>';

    while($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
            <td>' . $row['hire_receipt_id'] . '</td>
            <td>' . $row['bus_id'] . '</td>
            <td>' . $row['bus_name'] . '</td>
            <td>' . $row['first_name'] . '</td>
            <td>' . $row['last_name'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['specified_distance'] . '</td>
            <td>' . $row['payable_amount'] . '</td>
            <td>' . $row['payment_method'] . '</td>
            <td>' . $row['gender'] . '</td>
            <td>' . $row['date_of_birth'] . '</td>
            <td>' . $row['receipt_status'] . '</td>
            <td>' . $row['credit_card_number'] . '</td>
            <td>' . $row['expiry_date'] . '</td>
            <td>' . $row['CCV'] . '</td>
            <td>' . $row['proof_of_payment'] . '</td>
        </tr>';
    }
    $html .= '</table>';
} else {
    $html = "Data not found";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = 'hire_receipts/' . time() . '.pdf'; // Save as PDF with unique timestamp
$mpdf->Output($file, 'I'); // Output PDF to browser
