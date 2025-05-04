<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Buses.css">
    <style>
      body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
      }
      .container {
        background-color: #263043;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .head {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px 5px 0 0;
      }
      .content {
        padding: 20px;
      }
      .detail {
        margin-bottom: 10px;
      }
      .cards {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        padding: 25px;
        border-radius: 5px;
      }
    </style>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <div class="grid-container">
      <?php include("header_sidebar.php");?>

      <main class="main-container">
        <div class="container">
          <div class="head">
            <h2>Hire Receipt Details</h2>
          </div>
          <div class="content">
            <?php
              // Include database connection
              require_once("db_connection.php");

              $hireReceiptId = $_GET['hire_receipt_id'];

              $sql = "SELECT * FROM hire_receipt hr
                      JOIN bus b ON hr.bus_id = b.bus_id
                      WHERE hr.hire_receipt_id=?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("s", $hireReceiptId);
              $stmt->execute();
              $result = $stmt->get_result();

              // Check if there is a result
              if ($result->num_rows > 0) {
                // Fetch the hire receipt details
                $hireReceipt = mysqli_fetch_assoc($result);
            ?>
            <div class="cards">
              <div class="detail">
                <label>Receipt ID:</label> <?php echo $hireReceipt['hire_receipt_id']; ?>
              </div>
              <div class="detail">
                <label>Bus Name:</label> <?php echo $hireReceipt['bus_name']; ?>
              </div>
              <div class="detail">
                <label>First Name:</label> <?php echo $hireReceipt['first_name']; ?>
              </div>
              <div class="detail">
                <label>Last Name:</label> <?php echo $hireReceipt['last_name']; ?>
              </div>
              <div class="detail">
                <label>Email:</label> <?php echo $hireReceipt['email']; ?>
              </div>
              <div class="detail">
                <label>Specified Distance:</label> <?php echo $hireReceipt['specified_distance']; ?>
              </div>
              <div class="detail">
                <label>Payable Amount:</label> <?php echo $hireReceipt['payable_amount']; ?>
              </div>
              <div class="detail">
                <label>Hire Status:</label> <?php echo $hireReceipt['receipt_status']; ?>
              </div>
            </div>
            <?php
              } else {
                echo "<p>Hire receipt not found.</p>";
              }
            ?>
          </div>
        </div>
      </main>
    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
  </body>
</html>
