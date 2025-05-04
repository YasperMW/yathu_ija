<?php 
require_once("../vendor/autoload.php");
require_once("../db_connection.php");

$sql = "SELECT * FROM driver";

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
        <td>First Name</td>
        <td>Last Name</td>
        <td>Phone Number</td>
        <td>Email</td>
        <td>Date of Birth</td>
        <td>Licence</td>
        <td>Certification</td>
        <td>Performance</td>
        <td>Salary</td>
        <td>Driver Condition</td>
    </tr>';

    while($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
            <td>' . $row['driver_id'] . '</td>
            <td>' . $row['first_name'] . '</td>
            <td>' . $row['last_name'] . '</td>
            <td>' . $row['phone_number'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['date_of_birth'] . '</td>
            <td>' . $row['licence'] . '</td>
            <td>' . $row['certification'] . '</td>
            <td>' . $row['perfomance'] . '</td>
            <td>' . $row['salary'] . '</td>
            <td>' . $row['driver_condition'] . '</td>
        </tr>';
    }
    $html .= '</table>';
} else {
    $html = "Data not found";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = 'drivers/'.time() .'.pdf'; // Save as PDF with unique timestamp
$mpdf->Output($file, 'I'); // Output PDF to browser

