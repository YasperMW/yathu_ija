<?php
// Retrieve driver information from the database based on the provided ID
if (isset($_POST['driver_id'])) {
    $driver_id = $_POST['driver_id'];
    require_once("db_connection.php");
    $sql = "SELECT * FROM driver WHERE driver_id = $driver_id";
    $result = mysqli_query($conn, $sql);
    $driver = mysqli_fetch_assoc($result);
}
?>

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
    
        <h1>Edit Driver</h1>
        <form action="update_driver.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="driver_id" value="<?php echo $driver['driver_id']; ?>">

            <label for="first_name">First Name:</label>
            <input class="text-box" type="text" id="first_name" name="first_name"
                   value="<?php echo $driver['first_name']; ?>" required>
            <br>

            <label for="last_name">Last Name:</label>
            <input class="text-box" type="text" id="last_name" name="last_name"
                   value="<?php echo $driver['last_name']; ?>" required>
            <br>

            <label for="phone_number">Phone Number:</label>
            <div>
                <input class="text-box" type="text" id="phone_number" name="phone_number"
                       value="<?php echo $driver['phone_number']; ?>" required>
            </div>

            <br>

            <label for="email">Email:</label>
            <div>
                <input class="text-box" type="email" id="email" name="email" value="<?php echo $driver['email']; ?>"
                       required>
            </div>


            <label for="date_of_birth">Date Of Birth:</label>
            <div>
                <input class="text-box" type="date" id="date_of_birth" name="date_of_birth"
                       value="<?php echo $driver['date_of_birth']; ?>" required>
            </div>


            <label for="license_number">License Number:</label>
            <div>
                <input class="text-box" type="number" id="license_number" name="licence"
                       value="<?php echo $driver['licence']; ?>" required>
            </div>

            <br>

            <label for="salary">Salary:</label>
            <div>
                <input class="text-box" type="number" id="salary" name="salary"
                       value="<?php echo $driver['salary']; ?>" required>
            </div>


            <label for="performance">Number Of Accidents:</label>
            <div>
                <input class="text-box" type="number" id="performance" name="performance"
                       value="<?php echo $driver['perfomance']; ?>" required>
            </div>

            <label for="status">Status: </label>
            <select class="text-box" name="status" id="status" required>
                <option value="Active" <?php if ($driver['driver_condition'] === 'Active') echo 'selected'; ?>>Active</option>
                <option value="Inactive" <?php if ($driver['driver_condition'] === 'Inactive') echo 'selected'; ?>>Inactive
                </option>
            </select>
            <br>

            <button class="text-box" type="submit">Save</button>
        </form>


    </main>
    <!-- End Main -->

</div>

<!-- Scripts -->
<!-- Custom JS -->
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
