
<?php 
require_once("../vendor/autoload.php");
require_once("../db_connection.php");

$sql = "SELECT f_id, f_uname, f_content, f_status FROM tms_feedback";
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
        <td>Feedback ID</td>
        <td>Username</td>
        <td>Content</td>
        <td>Status</td>
    </tr>';

    while($row = $result->fetch_assoc()) {
        $html .= '<tr>
            <td>' . $row['f_id'] . '</td>
            <td>' . $row['f_uname'] . '</td>
            <td>' . $row['f_content'] . '</td>
            <td>' . $row['f_status'] . '</td>
        </tr>';
    }
    $html .= '</table>';
} else {
    $html = "No feedback records found";
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = '../tms_feedback/' . time() . '.pdf'; // Save as PDF with unique timestamp
$mpdf->Output($file, 'I'); // Output PDF to browser
