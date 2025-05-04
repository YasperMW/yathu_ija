<?php session_start();
if (!isset($_SESSION['user_email'])){
    header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiring Success</title>
    
    <style>



        
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .receipt {
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 20px;
            width: 400px;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .receipt h2 {
            text-align: center;
            color: #333;
        }
        .receipt p {
            margin: 10px 0;
            color: #666;
        }
        .receipt p strong {
            color: #333;
        }
    </style>
    
</head>
<body>
<?php include("user_dashboard_navbar.php"); ?>

<br><br>

    <h1 class="mt-4 mb-3">Booking
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="user_dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Hire Successful</li>
    </ol>
    


    <h2 class="success-message">SUCCESSFUL SUBMISSION</h2>

    <div class="receipt">
        <h2>Hiring Bus Receipt</h2>
        <?php
        // Connect to your database
        require_once('db_connection.php');

        // Check if the ticket ID is provided in the URL
        if (isset($_SESSION['hireticketId'])) {
            $hireticketId = $_SESSION['hireticketId'];

            // Retrieve details from the database based on the ticket ID
            $sql = "SELECT DISTINCT 
            b.bus_id, b.bus_name, b.number_plate, b.number_of_seats,
            h.hire_receipt_id, h.first_name, h.last_name, h.email,h.payment_method,h.payable_amount,h.gender,
            h.receipt_status
            FROM hire_receipt h
            JOIN bus b ON b.bus_id = h.bus_id
            WHERE hire_receipt_id = $hireticketId";

         
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                ?>
                <p><strong>Receipt ID:</strong> <?php echo $row['hire_receipt_id']; ?></p>
                <p><strong>Name:</strong> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
                <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <p><strong>Payment Method:</strong> <?php echo $row['payment_method']; ?></p>
                <p><strong>Payable Amount:</strong> MWK <?php echo $row['payable_amount']; ?></p>
                <p><strong>Bus Name:</strong> <?php echo $row['bus_name']; ?></p>
                <p><strong>Number Plate:</strong> <?php echo $row['number_plate']; ?></p>
                <p><strong>Capacity:</strong> <?php echo $row['number_of_seats']; ?></p>
                <p><strong>Receipt Status:</strong> <?php echo $row['receipt_status']; ?></p>

                
                <?php
            } else {
                echo "<p>No details found for this receipt ID.</p>";
            }
        } else {
            echo "<p>Receipt ID not provided.</p>";
        }
        ?>
    </div>


    <br><br><br>
    <?php include 'footer.php'; ?>
</body>
</html>
