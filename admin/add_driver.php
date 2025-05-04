<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="Buses.css">

  <style>
    form {
      display: flex;
      align-items: center;
      flex-direction: column;
    }

    .text-box {
      width: 500px;
      height: 30px;
    }

    .button-container {
      display: flex;
      justify-content: space-around;
    }

    #add-bus {
      margin: 20px;
      height: 30px;
      width: 150px;
    }
  </style>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
      <!-- Custom CSS -->

  <!-- Montserrat Font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="grid-container">

  <?php include("header_sidebar.php"); ?>

  <!-- Main -->
  <main class="main-container">
    <h1>Add Driver</h1>
    <form action="add_driver_process.php" method="POST" onsubmit="return validateForm()">

      <label for="first_name">First Name:</label>
      <div>
        <input class="text-box" type="text" id="first_name" name="first_name" required>
      </div>

      <label for="last_name">Last Name:</label>
      <div>
        <input class="text-box" type="text" id="last_name" name="last_name" required>
      </div>

      <label for="phone_number">Phone Number:</label>
      <div>
        <input class="text-box" type="text" id="phone_number" name="phone_number" required>
      </div>

      <br>

      <label for="email">Email:</label>
      <div>
        <input class="text-box" type="email" id="email" name="email" required>
      </div>

      <label for="date_of_birth">Date Of Birth:</label>
      <div>
        <input class="text-box" min = "1950-01-01" max = "2005-01-01" type="date" id="date_of_birth" name="date_of_birth" required >
      </div>

      <label for="license_number">License Number:</label>
      <div>
        <input class="text-box" type="text" id="license_number" name="license_number" required>
      </div>

      <label for="salary">Salary:</label>
      <div>
        <input class="text-box" type="number" id="salary" name="salary" required>
      </div>

      <br>

      <input class="text-box" hidden type="number" id="performance" name="performance" value='0' readonly>
      <br>

      <label for="driver_status">Status: </label>
      <select class="text-box" name="driver_status" id="driver_status" required>
        <option value="Active" selected>Active</option>
        <option value="Inactive">Inactive</option>
      </select>
      <br>

      <button class="text-box" type="submit" class="add-btn">ADD THIS DRIVER TO OUR DATABASE</button>
    </form>
  </main>
  <!-- End Main -->
</div>

<!-- Scripts -->
<script>
  function validateForm() {
    var firstName = document.getElementById("first_name").value;
    var lastName = document.getElementById("last_name").value;
    var phoneNumber = document.getElementById("phone_number").value;
    var email = document.getElementById("email").value;
    var licenseNumber = document.getElementById("license_number").value;
    var salary = document.getElementById("salary").value;

    // Validate first name and last name
    var nameRegex = /^[a-zA-Z]+$/;
    if (!nameRegex.test(firstName) || !nameRegex.test(lastName)) {
      alert("First name and last name must contain only letters and cannot be empty.");
      return false;
    }

    // Validate phone number
    if (phoneNumber.length !== 9 || isNaN(phoneNumber)) {
      alert("Phone number must contain exactly 9 digits and cannot be empty.");
      return false;
    }

    // Validate email
    var emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address.");
      return false;
    }

    // Validate license number
    if (licenseNumber.length !== 14 || isNaN(licenseNumber)) {
      alert("License number must contain exactly 14 digits and cannot be empty.");
      return false;
    }

    // Validate salary
    if (salary < 1000 || salary > 100000 || isNaN(salary)) {
      alert("Salary must be a number between 1000 and 100000.");
      return false;
    }

    return true; // Form is valid
  }
</script>
</body>
</html>
