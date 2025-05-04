<?php
session_start();
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve form data
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $schedule_id =$_POST['schedule_id'];
    $date_of_birth = $_POST['date_of_birth'];
    $customerType = $_POST['customer_type'];
    $paymentMethod = $_POST['payment_method'];
    $busId = $_POST['bus_id'];
    $route_id = $_POST['route_id'];
    $payableAmount = $_POST['payable_amount'];
    $originalAmount= $_POST['original_amount'];
    $date= $_POST['booking_date'];
    $gender=$_POST['gender'];
    



    
   

    // Additional fields based on payment method
    $additionalColumns='';
    $additionalFields = '';

     // Find the next available seat number for the specific bus
     $result = $conn->query("SELECT MAX(seat_number) AS max_seat_number FROM seat_ticket WHERE bus_id = $busId");
     $row = $result->fetch_assoc();
     $next_seat_number = $row['max_seat_number'] + 1;



    if ($paymentMethod == 'Credit Card') { 
        $cardNumber = $_POST['card_number'];
        $expiryDate = $_POST['expiry_date'];
        $ccv = $_POST['ccv'];
        $additionalColumns = "card_number, expiry_date, ccv";
        $additionalFields = "'$cardNumber', '$expiryDate', '$ccv'";

 

      
      // Prepare and execute SQL INSERT statement
      $sql = "INSERT INTO seat_ticket (first_name, last_name, email, payment_method, bus_id, amount, seat_number ,date_of_birth,  customer_type ,schedule_id, route_id ,original_amount,booking_date,gender,$additionalColumns)
      VALUES ('$firstname', '$lastname', '$email', '$paymentMethod', '$busId', '$payableAmount', $next_seat_number, '$date_of_birth','$customerType','$schedule_id','$route_id' ,'$originalAmount','$date','$gender',$additionalFields)";

     if (mysqli_query($conn, $sql)) {
          // Retrieve the ID of the newly inserted ticket
          $ticketId = mysqli_insert_id($conn);
          
          // Store the ticket ID in a session variable
          $_SESSION['ticket_id'] = $ticketId;

          // Construct the success message including the ticket ID
          $successMessage = "Seat $next_seat_number successfully reserved for $firstname $lastname on bus $busName. Ticket ID: $ticketId";

          echo $successMessage;
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  
//
    } else if ($paymentMethod == 'Mobile Money') {
        // Check if file is uploaded successfully
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $img = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $final_image = 'uploads/' . $img;
            if (move_uploaded_file($tmp, $final_image)) {
                $additionalColumns = 'proof_of_payment';
                $additionalFields = "'$final_image'";
            } else {
                echo "Error uploading file.";
                exit;
            }
        } else {
            echo "No file uploaded or upload error.";
            exit;
        }
    
      
  
      
  
           // Prepare and execute SQL INSERT statement
        $sql = "INSERT INTO seat_ticket (first_name, last_name, email, payment_method, bus_id, amount, seat_number ,date_of_birth,  customer_type ,schedule_id, route_id ,original_amount,booking_date,gender,$additionalColumns)
        VALUES ('$firstname', '$lastname', '$email', '$paymentMethod', '$busId', '$payableAmount', $next_seat_number, '$date_of_birth','$customerType','$schedule_id','$route_id' ,'$originalAmount','$date','$gender',$additionalFields)";

          if (mysqli_query($conn, $sql)) {
              // Retrieve the ID of the newly inserted ticket
              $ticketId = mysqli_insert_id($conn);
              
              // Store the ticket ID in a session variable
              $_SESSION['ticket_id'] = $ticketId;
  
              // Construct the success message including the ticket ID
              $successMessage = "Seat $next_seat_number successfully reserved for $firstname $lastname on bus $busName. Ticket ID: $ticketId";
  
              echo $successMessage;
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
      
    
    //
    
    } else if ($paymentMethod == 'Cash') {
        // For cash payment method, no additional fields need to be inserted
       
    
       
        // Prepare and execute SQL INSERT statement
        $sql = "INSERT INTO seat_ticket (first_name, last_name, email, payment_method, bus_id, amount, seat_number ,date_of_birth,  customer_type ,schedule_id, route_id ,original_amount,booking_date,gender)
                VALUES ('$firstname', '$lastname', '$email', '$paymentMethod', '$busId', '$payableAmount', $next_seat_number, '$date_of_birth','$customerType','$schedule_id','$route_id' ,'$originalAmount','$date','$gender')";

        if (mysqli_query($conn, $sql)) {
            // Retrieve the ID of the newly inserted ticket
            $ticketId = mysqli_insert_id($conn);
            
            // Store the ticket ID in a session variable
            $_SESSION['ticket_id'] = $ticketId;

            // Construct the success message including the ticket ID
            $successMessage = "Seat $next_seat_number successfully reserved for $firstname $lastname on bus $busName. Ticket ID: $ticketId";

            echo $successMessage;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
   
    //
    }

  
}

