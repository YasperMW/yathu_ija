<?php 
require_once("../vendor/autoload.php");
require_once("../db_connection.php");

$sql = "SELECT bus_id, bus_name, number_plate, number_of_seats, weight, mileage, availability FROM bus WHERE mileage > 3000";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
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
        <td>Bus ID</td>
        <td>Bus Name</td>
        <td>Number Plate</td>
        <td>Number of Seats</td>
        <td>Weight</td>
        <td>Mileage</td>
        <td>Availability</td>
    </tr>';

    while($row = $result->fetch_assoc()) {
        $html .= '<tr>
            <td>' . $row['bus_id'] . '</td>
            <td>' . $row['bus_name'] . '</td>
            <td>' . $row['number_plate'] . '</td>
            <td>' . $row['number_of_seats'] . '</td>
            <td>' . $row['weight'] . '</td>
            <td>' . $row['mileage'] . '</td>
            <td>' . $row['availability'] . '</td>
        </tr>';
    }
    $html .= '</table>';
} else {
    $html = "No bus records found with mirage greater than 1000";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = '../maintenance+_buses/' . time() . '.pdf'; // Save as PDF with unique timestamp
$mpdf->Output($file, 'I'); // Output PDF to browser
