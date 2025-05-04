<!DOCTYPE html>
<html>
<head>
  
  <title>Customer Registration</title>
  <style>

    .centered-heading{
    text-align: center;
    }

    #signup-form {
      width: 900px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;


  
    }
    .form-container {
        display: flex;
        justify-content: space-between;
       
    }

    .form-section {
        width: calc(40% - 10px); /* Adjust the width to leave space between sections */
        padding: 20px;
        margin: 20px;
    }
    label {
      display: block;
      margin-bottom: 5px;
    }
select,
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"],
    input[type="password"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #45a049;
    }

    .error-message {
      color: red;
      font-size: 12px;
    }

  </style>
</head>
<body>
  <?php include("nav.php");?>
  
  
  
  <form action="signup_script.php" method="post" id="signup-form">
    <h3 class="centered-heading">Register for Online Bookings</h3>
    <div class ="form-container">

     <div class="form-section">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required><br>
    <span id="first_name-error" class="error-message"></span>
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required><br>
    <span id="last_name-error" class="error-message"></span>
    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required><br>
    <span id="email-error" class="error-message"></span>
    <label for="phone">Phone Number (Optional):</label>
    <input type="tel" id="phone" name="phone"><br>

    <label for="date_of_birth">Date of Birth:</label>
    <input type="date" id="date_of_birth" name="date_of_birth" min="1900-01-01" max="2008-01-01" required><br>
    <span id="date_of_birth-error" class="error-message"></span>
    </div>

    <div class="form-section">
    

    <label for="Gender">Gender:</label>
   <select name="gender" id="gender" required>
    <option value="">Select gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
   </select>
   <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <span id="password-error" class="error-message"></span>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>
    <span id="confirm_password-error" class="error-message"></span>

    <label for="User_type">Sign up as:</label>
   <select name="User_type" id="user" required>
    <option value="">Select User Type</option>
    <option value="Customer">Customer</option>
    <option value="Admin">Admin</option>
   </select><br>
    </div>
  </div>
   
   
    

    <button type="submit">Register</button>
    <br>

    <?php
  // Include success or error message (if registration is processed)
  if (isset($_GET['success'])) {
    echo "<p style='color:green;'>Registration Successful! , You can now log in.</p>";
  } elseif (isset($_GET['error'])) {
    echo "<p style='color:red;'>Registration Error: " . $_GET['error'] . "</p>";
  }
  ?>
<br>
    <p class="centered-heading"><a href="login.php" >already have an account? Click here to log in</a></p><br>
  </form>

  <script>
  const form = document.querySelector('#signup-form');
  const username = document.querySelector('#first_name');
  const email = document.querySelector('#email');
  const password = document.querySelector('#password');
  const confirmPassword = document.querySelector('#confirm_password');
  const dateOfBirth = document.querySelector('#date_of_birth');

  function showError(input, message) {
    const errorSpan = document.getElementById(`${input.id}-error`);
    errorSpan.innerText = message;
  }

  function clearError(input) {
    const errorSpan = document.getElementById(`${input.id}-error`);
    errorSpan.innerText = '';
  }

  function checkEmail(input) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(input.value.trim())) {
      showError(input, 'Email is not valid');
    } else {
      clearError(input);
    }
  }

  function checkPasswordsMatch(input1, input2) {
    if (input1.value !== input2.value) {
      showError(input2, 'Passwords do not match');
    } else {
      clearError(input2);
    }
  }

  function checkLength(input, min, max) {
    if (input.value.length < min) {
      showError(input, `${capitalizeWord(input.id)} must be at least ${min} characters`);
    } else if (input.value.length > max) {
      showError(input, `${capitalizeWord(input.id)} must be less than ${max} characters`);
    } else {
      clearError(input);
    }
  }

  function capitalizeWord(input) {
    return input.charAt(0).toUpperCase() + input.slice(1);
  }

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    checkLength(username, 3, 15);
    checkLength(password, 6, 25);
    checkEmail(email);
    checkPasswordsMatch(password, confirmPassword);
    // Checking for date of birth
    const today = new Date();
    const selectedDate = new Date(dateOfBirth.value);
    if (selectedDate > today) {
      showError(dateOfBirth, 'Date of Birth cannot be in the future');
    } else {
      clearError(dateOfBirth);
    }

    // If there are no errors, submit the form
    const errors = document.querySelectorAll('.error-message');
    if (!Array.from(errors).some(error => error.innerText !== '')) {
      form.submit();
    }
  });
</script>
<?php include("footer.php");?>
</body>
</html>
