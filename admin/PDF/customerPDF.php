<?php 
require_once("../vendor/autoload.php");
require_once("../db_connection.php");

$sql = "SELECT * FROM customer";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    $html = '
    <style>
.table{
    width: 100%;
    border: 1px solid;
}
    .th, td , tr {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }


    </style>
     <table class="table">';
    $html .= '<tr>
        <td>ID</td>
        <td>Firstname</td>
        <td>Lastname</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Date of Birth</td>
        <td>PASSWORD</td>
    </tr>';

    while($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
            <td>' . $row['customer_id'] . '</td>
            <td>' . $row['first_name'] . '</td>
            <td>' . $row['last_name'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['phone_number'] . '</td>
            <td>' . $row['date_of_birth'] . '</td>
            <td>' . $row['pass_word'] . '</td>
        </tr>';
    }
    $html .= '</table>';
} else {
    $html = "data not found";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = 'customers/' . time() . '.pdf';
$mpdf->Output($file, 'I');
