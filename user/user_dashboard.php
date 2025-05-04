<?php session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to login page if not logged in
  header("Location: ../login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <?php include 'head.php'; ?>
    <?php include 'db_connection.php' ?>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>

<?php include 'user_dashboard_navbar.php'; ?>

<br><br><br><br>



  <!-- Page Content -->
  <div class="container">

    <h1 class="my-4">Welcome to Yathu Ija</h1>

    <!-- Marketing Icons Section -->
    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Why Us</h4>
          <div class="card-body">
            <p class="card-text">
        Choose Yathu-Ija Bus Line for a seamless and enjoyable travel experience.
        With a steadfast commitment to safety, reliability, and comfort, 
        we ensure that every journey with us is a smooth ride from start to finish. 
        Our competitive fares, convenient booking options, and exceptional customer service 
        make planning and executing your travel plans hassle-free. Whether you're commuting to work,
        exploring new destinations, or embarking on a group adventure, 
        trust Yathu-Ija Bus Line to get you there safely, comfortably, and affordably.
        Join us on the road to convenience, reliability, and unparalleled service –
          choose Yathu-Ija Bus Line for your next journey.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Core Values</h4>
          <div class="card-body">
            <p class="card-text">Excellence, Trust and Openness, Integrity,
               Take Responsibility, Customer Orientation</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Discounts Offered</h4>
          <div class="card-body">
          <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Discount Name</th>
            <th>Discount Amount</th>
            <th>Eligibility</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Children</td>
            <td>50%</td>
            <td>Children below the age of 16</td>
          </tr>
          <tr>
            <td>Elderly</td>
            <td>50%</td>
            <td>Any person over the age of 70</td>
          </tr>
          <tr>
            <td>Student</td>
            <td>25%</td>
            <td>Any person studying up to tertiary level</td>
          </tr>
          <tr>
            <td>Inter-Regional</td>
            <td>10%</td>
            <td>Any person traveling between 2 regions</td>
          </tr>
          <tr>
            <td rowspan="4">Kabwerebwere</td>
            <td rowspan="4">100%</td>
            <td>Any person traveling with the bus line for the 5th time in a month.</td>
          </tr>
          <tr>
            <td>*Not applicable to students, children, and the elderly.</td>
          </tr>
          <tr>
            <td>*All 5 trips must be inter-regional trips.</td>
          </tr>
          <tr>
            <td>*After the 5th trip (free), the discount counter is reset.</td>
          </tr>
        </tbody>
      </table>
    </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- /.row -->
    <hr>
    <!-- Portfolio Section -->
    <h2 class="center">Most Hired Vehicles</h2>
    <!--Portfolio Section -->
    <hr>
    <div class="row">
      
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="../images/hiredbus3.png" alt=""></a>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="../images/hiredbus2.png" alt=""></a>
        </div>
      </div>
      
    </div>
    <!-- /.row -->


    <hr>
    <h1 class="my-4">User feedbacks</h1>

<div class="row">
  <?php
  // Display existing feedbacks
  $sql ="SELECT * FROM tms_feedback  ORDER BY RAND() LIMIT 4 "; //get all feedbacks
  $stmt= $conn->prepare($sql);
  $stmt->execute();
  $res=$stmt->get_result();
  $cnt=1;
  while($row=$res->fetch_object()) {
  ?>
  <div class="col-lg-6 mb-4">
    <div class="card h-100">
      <h4 class="card-header"><?php echo $row->f_uname;?></h4>
      <div class="card-body">
        <p class="card-text"><?php echo $row->f_content;?></p>
      </div>
    </div>
  </div>
  <?php }?>


  <?php
$message = ''; // Initialize message variable

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $uname = $_POST['uname'];
    $content = $_POST['content'];

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO tms_feedback (f_uname, f_content, f_status) VALUES (?, ?, 'Pending')");
    $stmt->bind_param("ss", $uname, $content);

    // Execute the statement
    if ($stmt->execute()) {
        // Feedback inserted successfully
        $message = "Thank you for your feedback!";
    } else {
        // Error inserting feedback
        $message = "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}


$username = $_SESSION['user_email'];
// Retrieve user's name from the database based on the username
$sql = "SELECT first_name, last_name FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['first_name'] . ' ' . $row['last_name'];
} else {
    // Default to username if name not found
    $user_name = $_SESSION['user_email'];
}
?>

  <!-- Form for adding feedback -->
  <div class="col-lg-6 mb-4">
    <div class="card h-100">
      <h4 class="card-header">Add Your Feedback</h4>
      <div class="card-body">
        <form  method="post">
          <div class="form-group">
            <label for="uname">Your Name:</label>
            <input type="text" class="form-control" id="uname" name="uname" readonly value="<?php echo $user_name; ?>">

          </div>
          <div class="form-group">
            <label for="content">Feedback:</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit Feedback</button>

        <br><br>
                  <?php if (!empty($message)): ?>
            <div class="container">
                <div class="alert alert-success" role="alert">
                    <?php echo $message; ?>
                </div>
            </div>
                <?php endif; ?>
                </form>
              </div>
            </div>
          </div>
        </div>

  </div>
  
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <?php include 'footer.php'; ?>
</body>

</html>
