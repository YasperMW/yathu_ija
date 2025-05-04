
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php'; 
session_start(); 

if (!isset($_SESSION['user_email'])){
    header('location: ../login.php');
}

require_once('db_connection.php');

// Function to get the count of bookings made by an inter-regional customer
function getBookingCount($conn, $email)
{
    $query = "SELECT COUNT(*) AS total_bookings FROM seat_ticket WHERE email = '$email' AND customer_type = 'inter-regional'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_bookings'];
}

// Get the email of the current user 
$userEmail = $_SESSION['user_email'];

// Get the count of bookings made by the user
$bookingCount = getBookingCount($conn, $userEmail);

 ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking</title>
    <link rel="stylesheet" href="book_seat.css">
   
</head>
<body>
    <?php include 'user_dashboard_navbar.php'; ?>
    <br>
    <h1 class="mt-4 mb-3">Booking
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="user_dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Booking a Seat</li>
    </ol>

    <div>
        <!-- Form -->
        <form method="post" class="search-form" id="search-form" onsubmit="return validateForm()">
            <h2>Search for Available buses</h2>
           
            <label for="start_date">Start Date:</label>
<input type="date" id="start_date" name="start_date" required>

<label for="end_date">End Date:</label>
<input type="date" id="end_date" name="end_date" required>

            <br><br>
            
            <label for="origin">Origin:</label>
            <select id="origin" name="origin" required>
            <option value="">Select Origin</option>
            <option value="lilongwe">Lilongwe</option>
            <option value="blantyre">Blantyre</option>
            <option value="mzuzu">Mzuzu</option>
            <option value="zomba">Zomba</option>
            <option value="kasungu">Kasungu</option>
            <option value="balaka">Balaka</option>
            <option value="chikwawa">Chikwawa</option>
            <option value="chiradzulu">Chiradzulu</option>
            <option value="chitipa">Chitipa</option>
            <option value="dedza">Dedza</option>
            <option value="dowa">Dowa</option>
            <option value="karonga">Karonga</option>
            <option value="kasungu">Kasungu</option>
            <option value="likoma">Likoma</option>
            <option value="machinga">Machinga</option>
            <option value="mangochi">Mangochi</option>
            <option value="mchinji">Mchinji</option>
            <option value="mulanje">Mulanje</option>
            <option value="mwanza">Mwanza</option>
            <option value="neno">Neno</option>
            <option value="nkhata Bay">Nkhata Bay</option>
            <option value="nkhotakota">Nkhotakota</option>
            <option value="nsanje">Nsanje</option>
            <option value="ntcheu">Ntcheu</option>
            <option value="ntchisi">Ntchisi</option>
            <option value="phalombe">Phalombe</option>
            <option value="rumphi">Rumphi</option>
            <option value="salima">Salima</option>
            <option value="thyolo">Thyolo</option>
            <option value="zomba">Zomba</option>
            </select>
            
            <label for="destination">Destination:</label>
            <select id="destination" name="destination" required>
                <option value="">Select Destination</option>
                <option value="">Select Origin</option>
            <option value="lilongwe">Lilongwe</option>
            <option value="blantyre">Blantyre</option>
            <option value="mzuzu">Mzuzu</option>
            <option value="zomba">Zomba</option>
            <option value="kasungu">Kasungu</option>
            <option value="balaka">Balaka</option>
            <option value="chikwawa">Chikwawa</option>
            <option value="chiradzulu">Chiradzulu</option>
            <option value="chitipa">Chitipa</option>
            <option value="dedza">Dedza</option>
            <option value="dowa">Dowa</option>
            <option value="karonga">Karonga</option>
            <option value="kasungu">Kasungu</option>
            <option value="likoma">Likoma</option>
            <option value="machinga">Machinga</option>
            <option value="mangochi">Mangochi</option>
            <option value="mchinji">Mchinji</option>
            <option value="mulanje">Mulanje</option>
            <option value="mwanza">Mwanza</option>
            <option value="neno">Neno</option>
            <option value="nkhata Bay">Nkhata Bay</option>
            <option value="nkhotakota">Nkhotakota</option>
            <option value="nsanje">Nsanje</option>
            <option value="ntcheu">Ntcheu</option>
            <option value="ntchisi">Ntchisi</option>
            <option value="phalombe">Phalombe</option>
            <option value="rumphi">Rumphi</option>
            <option value="salima">Salima</option>
            <option value="thyolo">Thyolo</option>
            <option value="zomba">Zomba</option>
            </select>
            
            <br><br>
            <input type="submit" value="Search" id="search-button">

<br>
            <div id="validation-message" style="color: red;"></div>
        </form>

        
    </div>

    <div class="container">
      <div class="row mt-5" >
           <div class="col">
             <div class="card mt-5" >
                <div class="card-header">
                    <h2 class="display-6 text-center" >Available Buses</h2>

                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr class="bg-dark text-white">
                            <td>Bus Name</td>
                            <td>Number Plate</td>
                            <td>Capacity</td>
                            <td>Origin</td>
                            <td>Destination</td>
                            <td>Date</td>
                            <td>Departure time</td>
                            <td>Seats Booked</td>
                            <td>Action</td>
                        </tr>
                        <?php

                        
                       
                       if ($_SERVER["REQUEST_METHOD"] == "POST") {
                          
                           $origin = $_POST['origin'];
                           $destination = $_POST['destination'];
                       
                                                // Get form data
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];
                        $bus_type='Passenger Bus';

                        
                        // Construct the search query using the captured data
                        $query = "SELECT DISTINCT b.bus_id, b.bus_name, b.number_plate, b.number_of_seats, b.weight,b.bus_type, b.mileage,
                         s.date, s.time_stamp,s.schedule_id , r.route_id,
                                (SELECT COUNT(*) FROM seat_ticket WHERE bus_id = b.bus_id AND s.date = booking_date) AS booked_tickets
                                FROM bus b
                                JOIN schedule s ON b.bus_id = s.bus_id
                                JOIN route r ON s.route_id = r.route_id
                                WHERE r.origin = '$origin'
                                AND r.destination = '$destination'
                                AND b.bus_type ='$bus_type'
                                AND DATE(s.date) BETWEEN '$start_date' AND '$end_date'
                                AND b.availability = 'Available';";

                           $result = mysqli_query($conn, $query);
                       
                           if (mysqli_num_rows($result) > 0) {
                               while ($row = mysqli_fetch_assoc($result)) {

                                                                                    // Calculate remaining seats
                            $remainingSeats = $row['number_of_seats'] - $row['booked_tickets'];


                                   ?>
                                   <tr>

     

                                       
                                       <td><?php echo $row['bus_name'] ?></td>
                                       <td><?php echo $row['number_plate'] ?></td>
                                       <td><?php echo $row['number_of_seats'] ?></td>
                                       <td><?php echo $origin ?></td>
                                       <td> <?php echo $destination?></td>
                                       <td><?php echo $row['date']?></td>
                                       <td><?php echo $row['time_stamp']?></td>
                                       <td><?php echo $row['booked_tickets']."/" .$row['number_of_seats']?></td>
                                       <td>
                                       <button onclick="showPopup(<?php echo $row['bus_id']; ?>, 
                                       '<?php echo $row['schedule_id']; ?>',
                                       '<?php echo $row['date']?>',
                                       '<?php echo $row['route_id']?>',
                                       '<?php echo $remainingSeats?>')" class="btn btn-primary">Book</button>
                                       </td>
                                   </tr>
                               <?php
                               }

                               
                               function getDistance($conn , $origin, $destination) {
                               
                                $query="SELECT distance
                                FROM route
                                WHERE origin = '$origin' AND destination = '$destination';
                                ";
            

                               $result = mysqli_query($conn, $query);
                               return $result;
                               }
                               // Fetch distance from database
                                $distanceResult = getDistance($conn ,  $origin, $destination);
                                
                               
                            // Retrieve distance value from the result
                            $row = mysqli_fetch_assoc($distanceResult);
                            $distance = $row['distance'];

                            // Calculate base price
                            $basePricePerKm = 600; // Example base price per kilometer
                            $basePrice = $distance * $basePricePerKm;

                            // Pass base price to JavaScript
                            echo "<script>var basePrice = $basePrice;</script>";

                                
                                
                               
                           } else {
                               ?>
                               <tr>
                                   <td colspan="5">No buses available for the selected criteria.</td>
                               </tr>
                           <?php
                           }
                       }
                        ?> 
                    </table>

                </div>

             </div>
           </div>
       </div>
   
    </div>
    
 <!-- Popup -->
<!-- Popup -->
<div class="overlay" id="overlay"></div>
<div class="popup" id="popup">
    <h2>Booking Details</h2>
    <form id="popup-form" class="popup-form">
    <div class="form-container">
    <input type="hidden" id="origin" name="origin" value="<?php echo $origin; ?>">
    <input type="hidden" id="destination" name="destination" value="<?php echo $destination; ?>">
    <input type="hidden" id="bus_id" name="bus_id">
    <input type="hidden" id="schedule_id" name="schedule_id">
    <input type="hidden" id="route_id" name="route_id">
    <input type="hidden" id="booking_date" name="booking_date">
    
     <div class= "form-section">
     <h5>Passenger details</h5>

            <label for="firstname">Firstname:</label>
            <input type="text" id="first_name" name="first_name" required>
            <label for="lastname">Lastname:</label>
            <input type="text" id="last_name" name="last_name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required readonly>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth"  min="1900-01-01" max="2008-01-01" required>
            <label for="Gender">Gender:</label>
                <select name="gender" id="gender" required>
                <option value="">Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
    <br>
        
</div>
<div class= "form-section">
    <h5>payment</h5>
    

    <label for="customer_type">Customer Type:</label>
        <select id="customer_type" name="customer_type" required onchange="calculatePayableAmount(<?php echo $bookingCount; ?>)">
        <option value="">Select customer type</option>
            <option value="regional">regional</option>
            <option value="inter-regional">inter-regional</option>
        </select>
        <div id="customer_error" class="error" ></div>
        
        <input type="hidden" id="original_amount" name="original_amount">

        <label for="payable_amount">Payable Amount:</label>
        <input type="text" id="payable_amount" name="payable_amount" readonly >
        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required onchange="toggleAdditionalFields()">
            <option value="">Select Payment Method</option>
            <option value="Credit Card">Credit Card</option>
            <option value="Mobile Money">Mobile Money</option>
            <option value="Cash">Cash</option>
           
        </select>
        <div id="payment_error" class="error" ></div>
        
        <!-- Additional fields for credit card payment -->
        <div id="credit_card_fields" style="display: none;">
            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" required>
            <div id="card_number_error" class="error"></div>
           
            <label for="expiry_date">Expiry Date:</label>
            <input type="date" id="expiry_date" name="expiry_date" required>
            <div id="expiry_date_error" class="error"></div>
           
            <label for="ccv">CCV:</label>
            <input type="text" id="ccv" name="ccv" required>
            <div id="ccv_error" class="error"></div>
            
        </div>

        <div id="mobile_money_fields" style="display: none;">
            <label for="agent_number">Agent Code:</label>
            <input type="text" id="agent_number" name="agent_number" readonly value="890-890">
           
            <label for="agent_name">Agent Name:</label>
            <input type="text" id="agent_name" name="agent_name" readonly value="Yathu Ija">
         
            <label for="proof_of_payment">Proof of Payment:</label>
            <input type="file" id="proof_of_payment" name="image" accept="image/*" required>
            <div id="proof_of_payment_error" class="error"></div>
          
        </div>
    </div>
</div>
       



        
       <div class="button-section">
       <button type="button" id="confirm-button" onclick="submitForm()">Confirm</button>
        <button type="button" id="cancel-button" onclick="hidePopup()">Cancel</button>
       </div>
        
    </form>
</div>


<?php
// Function to get user details by email
function getUserDetails($conn, $email)
{
    $query = "SELECT first_name, last_name, date_of_birth FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

// Get the email of the current user (assuming it's stored in $_SESSION['user_email'])
$userEmail = $_SESSION['user_email'];

// Get user details
$userDetails = getUserDetails($conn, $userEmail);

// Populate form fields with user details
$firstName = $userDetails['first_name'];
$lastName = $userDetails['last_name'];
$dateOfBirth = $userDetails['date_of_birth'];
?>
    
    

<script >


function validateForm() {
        var origin = document.getElementById('origin').value;
        var destination = document.getElementById('destination').value;
        var validationMessage = document.getElementById('validation-message');

        // Check if origin and destination are the same
        if (origin === destination) {
            validationMessage.textContent = "Origin and destination cannot be the same.";
            return false; // Prevent form submission
        }else{
           
            validationMessage.textContent = ""; // Clear any previous error messages
            return true; // Allow form submission if everything is okay
        }

        
    }
    

// Get tomorrow's date
var tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);

// Format tomorrow's date as yyyy-mm-dd for setting the minimum date attribute
var minDate = tomorrow.toISOString().slice(0, 10);

// Calculate two months later
var twoMonthsLater = new Date(tomorrow.getFullYear(), tomorrow.getMonth() + 2, 0);
var maxDate = twoMonthsLater.toISOString().slice(0, 10);

// Set the minimum and maximum date attributes for the start date input
document.getElementById('start_date').setAttribute('min', minDate);
document.getElementById('start_date').setAttribute('max', maxDate);

// Set the minimum date attribute for the end date input to tomorrow
document.getElementById('end_date').setAttribute('min', minDate);

// Set the maximum date attribute for the end date input to two months later
document.getElementById('end_date').setAttribute('max', maxDate);


   function toggleAdditionalFields() {
    var paymentMethod = document.getElementById('payment_method').value;
    var creditCardFields = document.getElementById('credit_card_fields');
    var mobileMoneyFields = document.getElementById('mobile_money_fields');

    // Hide all additional fields by default
    creditCardFields.style.display = 'none';
    mobileMoneyFields.style.display = 'none';

    // Show additional fields based on payment method
    if (paymentMethod === 'Credit Card') {
        creditCardFields.style.display = 'block'; // Show credit card fields
    } else if (paymentMethod === 'Mobile Money') {
        mobileMoneyFields.style.display = 'block'; // Show mobile money fields
    }
}

function showPopup(busId,schedule_id,date,route_id ,remainingSeats) {

    if(remainingSeats>0){
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';

    // Retrieve user details from session
    var userEmail = '<?php echo isset($_SESSION["user_email"]) ? $_SESSION["user_email"] : "" ?>';
     var first_name='<?php echo $firstName?>';
     var last_name='<?php echo $lastName?>';
     var date_of_birth='<?php echo $dateOfBirth?>';


    // Fill  fields with the retrieved values
    document.getElementById('email').value = userEmail;
    document.getElementById('first_name').value= first_name;
    document.getElementById('last_name').value=last_name;
    document.getElementById('date_of_birth').value=date_of_birth;
    document.getElementById('original_amount').value=basePrice;
  
    document.getElementById('bus_id').value = busId;
    document.getElementById('booking_date').value = date;
    document.getElementById('route_id').value =route_id;
    document.getElementById('schedule_id').value = schedule_id;

}else{
    alert('Sorry, the bus is fully booked');

}
}

function hidePopup() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
}

function calculatePayableAmount(bookingCount) {
    
    var customerType = document.getElementById('customer_type').value;

    // Calculate payable amount based on age and customer type
    var payableAmount = basePrice; // Initialize payable amount with base price

    function calculateAge(dateOfBirth) {
    var today = new Date();
    var birthDate = new Date(dateOfBirth);
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDiff = today.getMonth() - birthDate.getMonth();
    
    // If the current month is less than the birth month or
    // if the current month is equal to the birth month but
    // the current day is less than the birth day, subtract 1 from age
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    return age;
}


var age = calculateAge(document.getElementById('date_of_birth').value);


 if(customerType =='regional'){
    if ( age < 16) {
        payableAmount *= 0.5; // Apply 50% discount for children
    } else if (age >= 16 && age <= 70){
        payableAmount *= 0.75; // Apply 25% discount for students
    }else if ( age > 70) {
        payableAmount *= 0.5; // Apply 50% discount for elderly
    } 
 }else {
    bookingCount += 1;
        if(bookingCount % 6 ==0 ){
            //kabwerebwere discount
            payableAmount = 0;
        }else{
            payableAmount *= 1
            ; // 0% discount for other customer

        }

       
    }

    // Update the value of the payable_amount input field
    document.getElementById('payable_amount').value = payableAmount.toFixed(2);
}

function submitForm() {


    // If all validations pass, proceed with form submission
    var form = document.getElementById('popup-form');
    var formData = new FormData(form);


     // Check if payment method is Mobile Money
     var paymentMethod = document.getElementById('payment_method').value;
var customer_type= document.getElementById('customer_type').value

if(customer_type==''){
    customer_typeError=document.getElementById('customer_error');
    customer_typeError.textContent='please select a customer type.' ;

    return;
}else if (paymentMethod === ''){
    payment_error=document.getElementById('payment_error');
    payment_error.textContent='Please Select a payment method'
 
return
}else if (paymentMethod === 'Cash'){

        paymentMethod = 'Cash'
     }else if (paymentMethod === 'Credit Card'){
        // Validate credit card number
var cardNumber = document.getElementById('card_number').value;
    var cardNumberError = document.getElementById('card_number_error');
    if (!/^\d{16}$/.test(cardNumber)) {
        cardNumberError.textContent = 'Please enter a valid 16-digit credit card number.';
        return;
    } else {
        cardNumberError.textContent = ''; // Clear error message if validation succeeds
    }

    // Validate CCV
    var ccv = document.getElementById('ccv').value;
    var ccvError = document.getElementById('ccv_error');
    if (!/^\d{3}$/.test(ccv)) {
        ccvError.textContent = 'Please enter a valid 3-digit CCV.';
        return;
    } else {
        ccvError.textContent = ''; // Clear error message if validation succeeds
    }


    // Validate expiry date

    var expiryDate = document.getElementById('expiry_date').value;
    var today = new Date();
    var selectedDate = new Date(expiryDate);
    var expiryDateError = document.getElementById('expiry_date_error');
    if (expiryDate.trim() === '') {
        expiryDateError.textContent = 'Please select a valid expiry date.';
        return;
    }
    if (selectedDate <= today) {
        expiryDateError.textContent = 'Please select a valid expiry date.';
        return;
    } else {
        expiryDateError.textContent = ''; // Clear error message if validation succeeds
    }
        paymentMethod = 'Credit Card'

     }else if (paymentMethod === 'Mobile Money') {
        // Check if a file has been selected for Mobile Money payment method
        var fileInput = document.getElementById('proof_of_payment');
        var error= document.getElementById('proof_of_payment_error');
        if (fileInput.files.length === 0) {
            // Display an alert message or handle the validation as per your requirement
            error.textContent='please upload an image for proof of payment';
            return;
        }}
   
    // Send AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ticket.php', true);
    xhr.onload = function () {
        console.log(xhr.responseText);
        if (xhr.status === 200) {
            // Handle successful response
            var response = xhr.responseText;
           
             // Check response content
             if (response.includes('fully booked')) {
                // Display the message to the user without redirection
                alert(response);
                hidePopup();
            } else {


            // Redirect the user to the success page with the ticket ID as a parameter
            window.location.href = 'success_page.php';
        } }
    };
    xhr.onerror = function () {
        // Handle connection errors
        alert('Error: Connection failed');
    };
    xhr.send(formData);
}


</script>

<?php include 'footer.php'; ?>
</body>
</html>
