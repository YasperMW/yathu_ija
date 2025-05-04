<?php
require_once("../admin/vendor/autoload.php");
require_once("../db_connection.php");

// Check if the hire receipt ID is provided in the URL
if(isset($_GET['hire_receipt_id'])) {
  // Retrieve the hire receipt ID from the URL
  $hireReceiptId = $_GET['hire_receipt_id'];

  // Prepare SQL statement to prevent SQL injection (replace with prepared statement)
  $sql = "SELECT DISTINCT 
    b.bus_id, b.bus_name, b.number_plate, b.number_of_seats,
    h.hire_receipt_id, h.first_name, h.last_name, h.email, h.payment_method, h.payable_amount,
    h.receipt_status ,h.specified_distance
  FROM hire_receipt h
  JOIN bus b ON b.bus_id = h.bus_id
  WHERE h.hire_receipt_id = ?"; // Use prepared statement here

  // Prepare and execute the statement (replace with prepared statement logic)
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $hireReceiptId); // Bind the ID parameter
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($result->num_rows == 1) {
    // Hire receipt found, generate PDF
    $row = $result->fetch_assoc();

    // Create HTML content for the ticket
    $html = '
      <div class="receipt"> <p><strong>Receipt ID:</strong> ' . $row['hire_receipt_id'] . '</p>
        <p><strong>Name:</strong> ' . $row['first_name'] . ' ' . $row['last_name'] . '</p>
        <p><strong>Email:</strong> ' . $row['email'] . '</p>
        <p><strong>Bus Name:</strong> ' . $row['bus_name'] . '</p>
        <p><strong>Capacity:</strong> ' . $row['number_of_seats'] . '</p>
        <p><strong>Specified Distance:</strong> ' . $row['specified_distance'] . '</p>
        <p><strong>Payable Amount:</strong> ' . $row['payable_amount'] . '</p>
        <p><strong>Payment Method:</strong> ' . $row['payment_method'] . '</p>
        <p><strong>Hiring Status:</strong> ' . $row['receipt_status'] . '</p>
      </div>';

    // Generate PDF
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output('hire_receipt_' . $hireReceiptId . '.pdf', 'I'); // Output PDF as download

    exit; // Stop further execution
  } else {
    // Handle case where no hire receipt is found
    echo "No hire receipt found for ID: " . $hireReceiptId;
  }
}
