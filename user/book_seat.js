



    // Get the current date
    var today = new Date();
    var currentMonth = today.getMonth() + 1; // Adding 1 because getMonth() returns 0-indexed month
    
    // Calculate the last day of the current month
    var lastDay = new Date(today.getFullYear(), currentMonth, 0).getDate();
    
    // Set the minimum and maximum date for the input
    var minDate = today.getFullYear() + '-' + ('0' + currentMonth).slice(-2) + '-01';
    var maxDate = today.getFullYear() + '-' + ('0' + currentMonth).slice(-2) + '-' + ('0' + lastDay).slice(-2);
    
    // Set the min and max attributes of the date input
    document.getElementById('date').setAttribute('min', minDate);
    document.getElementById('date').setAttribute('max', maxDate);



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

function calculatePayableAmount() {
    var age = parseInt(document.getElementById('age').value);
    var customerType = document.getElementById('customer_type').value;

    // Calculate payable amount based on age and customer type
    var payableAmount = basePrice; // Initialize payable amount with base price

    if (customerType == 'Children' && age < 16) {
        payableAmount *= 0.5; // Apply 50% discount for children
    } else if (customerType == 'Eldery' && age > 70) {
        payableAmount *= 0.5; // Apply 50% discount for elderly
    } else if (customerType == 'Student') {
        payableAmount *= 0.75; // Apply 25% discount for students
    } else {
        payableAmount *= 0.9; // Apply 10% discount for other customers
    }

    // Update the value of the payable_amount input field
    document.getElementById('payable_amount').value = payableAmount.toFixed(2);
}

function submitForm() {
    var form = document.getElementById('popup-form');
    // Collect form data
    var formData = new FormData(form);

     // Check if payment method is Mobile Money
     var paymentMethod = document.getElementById('payment_method').value;
     if (paymentMethod === 'Cash'){

        paymentMethod = 'Cash'
     }else if (paymentMethod === 'Credit Card'){
        paymentMethod = 'Credit Card'

     }else if (paymentMethod === 'Mobile Money') {
        // Check if a file has been selected for Mobile Money payment method
        var fileInput = document.getElementById('proof_of_payment');
        if (fileInput.files.length === 0) {
            // Display an alert message or handle the validation as per your requirement
            alert('Please upload a file');
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

