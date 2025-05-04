<?php 
require_once("../vendor/autoload.php");
require_once("../db_connection.php");

$sql = "SELECT * FROM route";

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
        <td>Route ID</td>
        <td>Route Name</td>
        <td>Origin</td>
        <td>Destination</td>
        <td>Distance</td>
    </tr>';

    while($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
            <td>' . $row['route_id'] . '</td>
            <td>' . $row['route_name'] . '</td>
            <td>' . $row['origin'] . '</td>
            <td>' . $row['destination'] . '</td>
            <td>' . $row['distance'] . '</td>
        </tr>';
    }
    $html .= '</table>';
} else {
    $html = "Data not found";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = '../routes/' . time() . '.pdf'; // Save as PDF with unique timestamp
$mpdf->Output($file, 'I'); // Output PDF to browser
