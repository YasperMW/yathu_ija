<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php'; ?>
<?php session_start(); 
if (!isset($_SESSION['user_email'])){
    header('location: ../login.php');
}

 require_once('db_connection.php');?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Hiring</title>
    
    <style>
         .form-container {
        display: flex;
        justify-content: space-between;
       
    }

    .form-section {
        width: calc(50% - 10px); /* Adjust the width to leave space between sections */
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 40px;
        margin: 40px;
    }
    .button-section{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
       
        .search-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
        

        label {
            width: 100px;
            text-align: right;
            margin-right: 10px; /* Added margin for better spacing */
        }

        input[type="date"],
        select,
        input[type="submit"],
        input[type="text"],
        input[type="email"],
        input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 200px;
        }

        input[type="submit"]
        {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }


        input[type="submit"]:hover {
            background-color: #45a049;
        }
 #confirm-button {
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 5px;
}

#confirm-button:hover {
    background-color: #45a049;
}

#cancel-button {
    background-color: #f44336;
    color: white;
    border: none;
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 5px;
}

#cancel-button:hover {
    background-color: #da190b;
}


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Popup styles */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .popup {

display: none;
position: fixed;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
background-color: white;
padding: 20px;
border: 1px solid #ccc;
border-radius: 5px;
z-index: 1000;
overflow-y: auto; /* Enable vertical scrolling */
max-height: 95vh; /* Set maximum height */
width : 850px;
}


.popup label {
  width: auto; /* Adjusted width for labels */
  text-align: left; /* Align labels to the left */
  margin-right: 0; /* Removed margin for labels */
  margin-bottom: 5px; /* Added margin bottom for better spacing */
  display: block; /* Ensure labels are on a separate line */
}

        .popup-form{
            
        }
        
    </style>
</head>
<body>
    <?php include 'user_dashboard_navbar.php'; ?>
    <br><br><br><br><br><br>

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
                            
                            <td>BUS NAME</td>
                            <td>NUMBER PLATE</td>
                            <td>NUMBER OF SEATS</td>
                            <td>Action</td>
                        </tr>
                        <?php
                       
                       if (true) {
                        $bus_type='Hire Bus';
                       
                           // Construct the search query using the captured data
                           $query = "SELECT * FROM bus
                                     WHERE  bus_type= 'Hire Bus'
                                     AND    availability = 'Available'
                                       ;" ;
                       
                           $result = mysqli_query($conn, $query);
                       
                           if (mysqli_num_rows($result) > 0) {
                               while ($row = mysqli_fetch_assoc($result)) {
                                   ?>
                                   <tr>
                                       
                                       <td><?php echo $row['bus_name'] ?></td>
                                       <td><?php echo $row['number_plate'] ?></td>
                                       <td><?php echo $row['number_of_seats'] ?></td>
                                       <td>
                                       <button onclick="showPopup(<?php echo $row['bus_id']; ?>, 
                                       '<?php echo $row['bus_name']; ?>')" class="btn btn-primary">Hire Bus</button>
                                       </td>
                                   </tr>
                               <?php
                               }

                               
                           } else {
                               ?>
                               <tr>
                                   <td colspan="5">No buses available for hire</td>
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
    <h2>Hiring Details</h2>
    <form id="popup-form" class="popup-form">

 <h6>Note: Either select Origin and Destination or Specify the distance .
if you select origin and destination and also specify the distance
 ,the calculation will be based on the origin and destination not the specified distance
</h6>

<div class="form-container">

<div class="form-section">

<h5>Hirer Details</h5>
   
<input type="hidden" id="bus_id" name="bus_id">
    <input type="hidden" id="bus_name" name="bus_name">
        <div>
            <label for="firstname">firstname:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>
        <div>
            <label for="lastname">Lastname:</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>
        <br>
        <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" min="1900-01-01" max="2008-01-01" required>
            <label for="Gender">Gender:</label>
                <select name="gender" id="gender" required>
                <option value="">Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required readonly>
        </div>
        <br>
        
 


</div>
<div class="form-section">
<h5>Charges and Payment </h5>
<label for="origin">Origin:</label>
            <select id="origin" name="origin" required onchange="calculatePayableAmount()">
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
            <select id="destination" name="destination" required onchange="calculatePayableAmount()">
            <option value="">Select Destination</option>
             
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

                    <div>
                        <h5 style="
                            text-align: center;
                        ">OR</h5>
                    </div>
            
            <div>
            <label for="specified_distance">Specify distance(Kilometers)</label>
            <input type="number" name="specified_distance" id="specified_distance"  min="20" max='3000' required onchange="calculatePayableAmount()">
        </div>
        <br>
        <label for="payable_amount">payable amount(MWK):</label>
        <input type="text" id="payable_amount" name="payable_amount" readonly >

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required onchange="toggleAdditionalFields()">
            <option value="">Select Payment Method</option>
            <option value="Credit Card">Credit Card</option>
            <option value="Mobile Money">Mobile Money</option>
            <option value="Cash">Cash</option>
           
        </select>
        <br><br>
        <!-- Additional fields for credit card payment -->
        <div id="credit_card_fields" style="display: none;">
            <label for="card_number">Card Number:</label>
            <input type="number" id="card_number" name="card_number" required>
            <br>
            <label for="expiry_date">Expiry Date:</label>
            <input type="date" id="expiry_date" name="expiry_date" required>
            <br>
            <label for="ccv">CCV:</label>
            <input type="text" id="ccv" name="ccv" required>
            <br>
        </div>

        <div id="mobile_money_fields" style="display: none;">
            <label for="agent_number">Agent Number:</label>
            <input type="text" id="agent_number" name="agent_number" readonly value="980-890">
            <br>
            <label for="agent_name">Agent Name:</label>
            <input type="text" id="agent_name" name="agent_name" readonly value="Yathu Ija" >
            <br>
            <label for="proof_of_payment">Proof of Payment:</label>
            <input type="file" id="proof_of_payment" name="image" required accept="image/*">
            <br>
        </div>
        
</div>
</div>

<div id="validation-message" style="color: red;"></div>
        
        <br>
        <div class="button-section">
        <button type="button" id="confirm-button" onclick="submitForm(true)">Confirm</button>
        <button type="button" id="cancel-button" onclick="hidePopup()">Cancel</button>
        </div>

    </form>
</div>

    
    
<script>
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

function showPopup(busId, busName) {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';

    // Retrieve user details from session
    var userEmail = '<?php echo isset($_SESSION["user_email"]) ? $_SESSION["user_email"] : "" ?>';

    // Fill email field with the retrieved value
    document.getElementById('email').value = userEmail;

    // Fill bus_id and bus_name fields with the retrieved values
    document.getElementById('bus_id').value = busId;
    document.getElementById('bus_name').value = busName;
}

function hidePopup() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
}


function validateForm() {
    var firstName = document.getElementById('first_name').value;
    var lastName = document.getElementById('last_name').value;
    var dateOfBirth = document.getElementById('date_of_birth').value;
    var gender = document.getElementById('gender').value;
    var email = document.getElementById('email').value;
    var origin = document.getElementById('origin').value;
    var destination = document.getElementById('destination').value;
    var specifiedDistance = document.getElementById('specified_distance').value;
    var paymentMethod = document.getElementById('payment_method').value;

    var validationMessage = document.getElementById('validation-message');

    // Check if any field is empty
    if (
        firstName.trim() === '' ||
        lastName.trim() === '' ||
        dateOfBirth.trim() === '' ||
        gender.trim() === '' ||
        email.trim() === '' ||
        paymentMethod.trim() === ''
    ) {
        
        validationMessage.textContent = "Please fill out all required fields.";
        return false; // Prevent form submission
    }
   // Check if either specified distance or both origin and destination are provided
   if (specifiedDistance.trim() === '' && (document.getElementById('origin').value.trim() === '' || document.getElementById('destination').value.trim() === '')) {
        validationMessage.textContent = "Please specify a distance or choose both origin and destination.";
        return false; // Prevent form submission
    }  
        

    // If specified distance is provided, make sure it's within the allowed range
    if (specifiedDistance.trim() !== '' && (specifiedDistance < 20 || specifiedDistance > 3000)) {
        validationMessage.textContent = "Specified distance must be between 20 and 3000 kilometers.";
        return false; // Prevent form submission
    }

    // If origin or destination is blank, skip the check for equality
    if (origin.trim() !== '' && destination.trim() !== '') {
        // Check if origin and destination are the same
        if (origin === destination) {
            validationMessage.textContent = "Origin and destination cannot be the same.";
            return false; // Prevent form submission
        }
    }

    // Additional validation based on payment method
    if (paymentMethod === 'Credit Card') {
        var cardNumber = document.getElementById('card_number').value;
        var expiryDate = document.getElementById('expiry_date').value;
        var ccv = document.getElementById('ccv').value;
        // Check if any credit card field is empty
        if (cardNumber.trim() === '' || expiryDate.trim() === '' || ccv.trim() === '') {
            validationMessage.textContent = "Please fill out all credit card fields.";
            return false; // Prevent form submission
        }


        var cardNumber = document.getElementById('card_number').value;
    var ccv = document.getElementById('ccv').value;
    var expiryDate = document.getElementById('expiry_date').value;

    // Validate credit card number
    if (!/^\d{16}$/.test(cardNumber)) {
        validationMessage.textContent = 'Please enter a valid 16-digit credit card number.';
      return false;
    }

    // Validate CCV
    if (!/^\d{3}$/.test(ccv)) {
        validationMessage.textContent = 'Please enter a valid 3-digit CCV.';
      return false;
    }

    // Validate expiry date
    var today = new Date();
    var selectedDate = new Date(expiryDate);
    if (expiryDate.trim() === '') {
        validationMessage.textContent = 'Please select a valid expiry date.';
      return false;
    }
    if (selectedDate <= today) {
        validationMessage.textContent = 'Please select a future expiry date.';
      return false;
    }
    
} else if (paymentMethod === 'Mobile Money') {
        var proofOfPayment = document.getElementById('proof_of_payment').files[0];
            if (!proofOfPayment) {
                
                validationMessage.textContent = "Please upload a screenshot of your payment.";
                return false;
            }
        
    }

    // Clear any previous error messages if everything is okay
    validationMessage.textContent = "";
    return true; // Allow form submission if everything is okay
}



function calculatePayableAmount() {
    var origin = document.getElementById('origin').value;
    var destination = document.getElementById('destination').value;

    // Check if both origin and destination are selected
    if (origin && destination) {
        // Send AJAX request to fetch distance and calculate payable amount
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'calculate_distance.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Update the payable amount field with the fetched amount

            let responseText = xhr.responseText;

            // Remove HTML comments using regular expression
            let cleanedText = responseText.replace(/<!--[\s\S]*?-->/g, '').trim();
            let cleanedNumber = parseFloat(cleanedText);

            // Output the cleaned text
            console.log(cleanedText); 


                    document.getElementById('payable_amount').value = cleanedNumber;
                    console.log(xhr.responseText);

                } else {
                    // Handle errors
                    console.error('Error fetching distance:', xhr.status);
                }
            }
        };
        // Send origin and destination as parameters in the POST request
        var params = 'origin=' + encodeURIComponent(origin) + '&destination=' + encodeURIComponent(destination);
        xhr.send(params);
    } else {
    var specified_distance = parseInt(document.getElementById('specified_distance').value);
    var basePricePerKm = 600; 

    var basePrice = specified_distance * basePricePerKm;
   
    var payableAmount = basePrice; // Initialize payable amount with base price


    // Update the value of the payable_amount input field
    document.getElementById('payable_amount').value = payableAmount.toFixed(2);
}}

function submitForm(bool) {
    if (validateForm()) {


    var form = document.getElementById('popup-form');
    // Collect form data
    var formData = new FormData(form);
    
    // Send AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'hire_ticket.php', true);
    xhr.onload = function () {
        console.log(xhr.responseText);
        if (xhr.status === 200) {
            // Handle successful response
            var response = xhr.responseText;
           
             // Check response content
             if (response.includes('already booked')) {
                // Display the message to the user without redirection
                alert(response);
                hidePopup();
            } else {

          
            // Redirect the user to the success page with the ticket ID as a parameter
            window.location.href = 'hire_success_page.php';
        } }
    };
    xhr.onerror = function () {
        // Handle connection errors
        alert('Error: Connection failed');
    };
    xhr.send(formData);
}else {
        // If form is not valid, prevent submission
        return false;
    }
}
</script>


</body>
</html>
