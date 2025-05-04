<?php 
require_once("../vendor/autoload.php");
require_once("../db_connection.php");

$sql = "SELECT * FROM bus";

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
        <td>ID</td>
        <td>Bus Name</td>
        <td>Number Plate</td>
        <td>Number of Seats</td>
        <td>Weight</td>
        <td>Mirage</td>
        <td>Availability</td>
    </tr>';

    while($row = mysqli_fetch_assoc($result)) {
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
    $html = "Data not found";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = 'buses/' . time() . '.pdf'; // Save as PDF with unique timestamp
$mpdf->Output($file, 'I'); // Output PDF to browser

