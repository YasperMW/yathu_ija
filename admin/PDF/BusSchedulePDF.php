<?php 
require_once("../vendor/autoload.php");
require_once("../db_connection.php");

$sql = "SELECT * FROM schedule";

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
        <td>Schedule ID</td>
        <td>Schedule Name</td>
        <td>Timestamp</td>
        <td>Date</td>
        <td>Route ID</td>
        <td>Bus ID</td>
        <td>Driver ID</td>
    </tr>';

    while($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
            <td>' . $row['schedule_id'] . '</td>
            <td>' . $row['schedule_name'] . '</td>
            <td>' . $row['time_stamp'] . '</td>
            <td>' . $row['date'] . '</td>
            <td>' . $row['route_id'] . '</td>
            <td>' . $row['bus_id'] . '</td>
            <td>' . $row['driver_id'] . '</td>
        </tr>';
    }
    $html .= '</table>';
} else {
    $html = "Data not found";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = '../schedules/' . time() . '.pdf'; // Save as PDF with unique timestamp
$mpdf->Output($file, 'I'); // Output PDF to browser
