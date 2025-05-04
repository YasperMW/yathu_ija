<?php 
    require_once("db_connection.php");

    // View drivers after running a query to select all rows of drivers table
    $sql = "SELECT * FROM driver";
    $result = mysqli_query($conn, $sql);

    // Delete driver if delete button is clicked
    if(isset($_POST['delete_driver'])) {
        $driver_id = $_POST['driver_id'];
        $delete_sql = "DELETE FROM driver WHERE driver_id = $driver_id";
        mysqli_query($conn, $delete_sql);
        // Refresh page after deletion
        echo "<meta http-equiv='refresh' content='0'>";
    }

    // Update driver information if edit button is clicked
    if(isset($_POST['edit_driver'])) {
        // Retrieve driver information from form
        $driver_id = $_POST['driver_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $license_number = $_POST['license_number'];
        $salary = $_POST['salary'];
        $perfomance = $_POST['perfomance'];
        $status = $_POST['status'];

        // Update driver information in the database
        $update_sql = "UPDATE driver SET first_name='$first_name', last_name='$last_name', phone_number='$phone_number', email='$email', date_of_birth='$date_of_birth', license='$license_number', salary='$salary', perfomance='$perfomance', status='$status' WHERE driver_id=$driver_id";
        mysqli_query($conn, $update_sql);
        // Refresh page after update
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <style> 
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color:black;
        }

        tr{
          transition-duration: .3s;
        }
        tr:hover {
            background-color: green;
            transition-duration: .3s;
        }
        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .type_sheet{
          display: flex;
          flex-direction: row-reverse;
          justify-content: space-between;
        }

        .header {
            grid-area: header;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px 0 30px;
            box-shadow: 0 6px 7px -3px rgba(0, 0, 0, 0.35);
  
            }
        .add-btn{
            margin:10px;
            padding:12px;
            background-color:#4CAF50;
            color:white;
            font-size:16px;
            border-style:none;
            border-radius:7px;
        }
    </style>
</head>
<body>
    <div class="grid-container">

    <?php include  ("header_sidebar.php");?>

      <!-- Main -->
      <main class="main-container">
        <h1>Drivers</h1>

        <?php 
            if(isset($_GET['success'])){
                echo "<p style = 'color: green;'>Successfully added Driver</p>";
            }
            else if(isset($_GET['error'])){
                echo "<p style = 'color: red;>Could not add Driver</p>";
            }
        ?>
            <table border=1>
                    <tr>
                        
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>PHONE NUMBER</th>
                        <th>EMAIL</th>
                        <th>DATE OF BIRTH</th>
                        <th>LICENSE NUMBER</th>
                        <th>SALARY</th>
                        <th>NUMBER OF ACCIDENTS</th>
                        <th>STATUS</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>

                                    
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['phone_number']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['date_of_birth']; ?></td>
                                    <td><?php echo $row['licence']; ?></td>
                                    <td> MWK <?php echo $row['salary']; ?></td>
                                    <td><?php echo $row['perfomance']; ?></td>
                                    <td><?php echo $row['driver_condition']; ?></td>

                                    <td>
                                        <form method="POST" action="edit_driver.php">
                                                <input type="hidden" name="driver_id" value="<?php echo $row['driver_id']; ?>">
                                                <button type="submit" class="alt-btn">Edit</button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="alt-btn" onclick="confirmDelete(<?php echo $row['driver_id']; ?>)">Delete</button>
                                    </td>

                                </tr>

                        </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='11'>No drivers found</td></tr>";
                        }
                    ?>
            </table>



            <div class="type_sheet">
                <form action="add_driver.php" method="post">
                    <button type="submit" class="add-btn">ADD A NEW DRIVER</button>
                </form>

                <div class="PDF-download">
                    <a href="PDF/DriverPDF.php">
                    <button class="alt-btn"  style="
                            margin: 5px;
                            height: 30px;
                            width: 200px;
                            font-size: 16px;
                        ">Download PDF</button>
                    </a>
                
                </div> 
            </div>
            
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
    <script >    
        function confirmDelete(driver_id) {
            if (confirm("Are you sure you want to delete this driver?")) {
                window.location.href = 'delete_driver.php?driver_id=' + driver_id;
            }
        }
    </script>
</body>
</html>
