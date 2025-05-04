<?php
// Start session
session_start();

// Include database connection
require_once('db_connection.php');

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $bus_id = $_POST['bus_id'];
    $bus_name = $_POST['bus_name'];
    // Assuming other fields are also received from the form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $specified_distance = $_POST['specified_distance'];
    $payable_amount = $_POST['payable_amount'];
    $payment_method = $_POST['payment_method'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender=$_POST['gender'];

    

    
    if ($payment_method == 'Credit Card') { 
        $cardNumber = $_POST['card_number'];
        $expiryDate = $_POST['expiry_date'];
        $ccv = $_POST['ccv'];
       

  // Construct SQL query to insert data into hire_receipt table
  $insert_query = "INSERT INTO hire_receipt (bus_id,  first_name, last_name, email, specified_distance, payable_amount, payment_method,gender,date_of_birth,credit_card_number, expiry_date, CCV) 
  VALUES ('$bus_id',  '$first_name', '$last_name', '$email', '$specified_distance', '$payable_amount', '$payment_method','$gender','$date_of_birth','$cardNumber', '$expiryDate', '$ccv')";

// Execute the query
if (mysqli_query($conn, $insert_query)) {
   // Retrieve the ID of the newly inserted ticket
   $hireticketId= mysqli_insert_id($conn);
        

   // Set session variable
   $_SESSION['hireticketId'] = $hireticketId;
 
} else {
    echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
}

    }elseif ($payment_method == 'Mobile Money') {
        
     // Check if file is uploaded successfully
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $final_image = 'uploads/' . $img;
    if (move_uploaded_file($tmp, $final_image)) {
        // File uploaded successfully
        echo "File uploaded successfully.";
    } else {
        // Error moving uploaded file
        echo "Error moving uploaded file.";
        exit;
    }
} else {
    // No file uploaded or upload error
    echo "No file uploaded or upload error.";
    exit;
}
    
    // Construct SQL query to insert data into hire_receipt table
    $insert_query = "INSERT INTO hire_receipt (bus_id,  first_name, last_name, email, specified_distance, payable_amount, payment_method,gender,date_of_birth,proof_of_payment) 
                     VALUES ('$bus_id',  '$first_name', '$last_name', '$email', '$specified_distance', '$payable_amount', '$payment_method','$gender','$date_of_birth','$final_image')";

    // Execute the query
    if (mysqli_query($conn, $insert_query)) {
       
       
      // Retrieve the ID of the newly inserted ticket
      $hireticketId= mysqli_insert_id($conn);
        

      // Set session variable
      $_SESSION['hireticketId'] = $hireticketId;
        
        
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }
    
    
    
    }else{
    // Construct SQL query to insert data into hire_receipt table
    $insert_query = "INSERT INTO hire_receipt (bus_id, first_name, last_name, email, specified_distance, payable_amount, payment_method,gender,date_of_birth) 
                     VALUES ('$bus_id', '$first_name', '$last_name', '$email', '$specified_distance', '$payable_amount', '$payment_method','$gender','$date_of_birth')";

    // Execute the query
    if (mysqli_query($conn, $insert_query)) {
       // Retrieve the ID of the newly inserted ticket
       $hireticketId= mysqli_insert_id($conn);
        

        // Set session variable
        $_SESSION['hireticketId'] = $hireticketId;
        
   
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }
    }
    // Close database connection
    mysqli_close($conn);
}

