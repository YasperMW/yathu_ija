<?php
// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the update form is submitted
    if(isset($_POST['updateBusForm'])) {
        // Retrieve form data
        $updateBusId = $_POST['updateBusId'];

$updateMileage = $_POST['updateMileage'];
$updateAvailability = $_POST['updateAvailability'];

// Update the remaining fields in the bus table
$sql_update = "UPDATE bus SET mileage = '$updateMileage', availability = '$updateAvailability' WHERE bus_id = $updateBusId";

 if ($conn->query($sql_update) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
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
       
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Additional styles for the update modal */
        .modal input[type="text"],
        .modal input[type="number"],
        .modal select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        .modal button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        .modal button:hover {
            background-color: #45a049;
        }
    </style>
  </head>
  <body>
    <div class="grid-container">
        <!-- Header and Sidebar -->
        <?php include("header_sidebar.php");?>
        <!-- Main -->
        <main class="main-container">
            <h1>Maintenance</h1>
            <?php
            // Include the database connection file
            include 'db_connection.php';

            // Check if delete button is clicked for any row
            if(isset($_POST['delete'])) {
                $bus_id_to_delete = $_POST['bus_id_to_delete'];
                // SQL to delete record
                $sql_delete = "DELETE FROM bus WHERE bus_id=$bus_id_to_delete";
                if ($conn->query($sql_delete) === TRUE) {
                   
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }

            // Retrieve bus records from the database
            $sql = "SELECT bus_id, bus_name, number_plate, number_of_seats, weight, mileage, availability FROM bus WHERE mileage > 5000";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output table header
                echo "<table border='1'>
                        <tr>
                            <th>Bus ID</th>
                            <th>Bus Name</th>
                            <th>Number Plate</th>
                            <th>Number of Seats</th>
                            <th>Weight</th>
                            <th>Mileage</th>
                            <th>Availability</th>
                            <th>Action</th>
                        </tr>";

                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["bus_id"]."</td>
                            <td>".$row["bus_name"]."</td>
                            <td>".$row["number_plate"]."</td>
                            <td>".$row["number_of_seats"]."</td>
                            <td>".$row["weight"]."</td>
                            <td>".$row["mileage"]."</td>
                            <td>".$row["availability"]."</td>
                            <td>
                                <button onclick='openUpdateModal(".$row['bus_id'].")'>Update</button> 
                            </td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
            <!-- PDF Download -->
            <div class="PDF-download">
                <a href="PDF/MaintenancePDF.php">
                    <button class="alt-btn">Download PDF</button>
                </a>
            </div>
        </main>
        <!-- End Main -->

        <!-- Update Modal -->
        <div id="updateModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeUpdateModal()">&times;</span>
                <h2>Update Bus Details</h2>
                <!-- Form for updating bus details -->
                <form id="updateBusForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <!-- Bus ID (hidden input) -->
    <input type="hidden" id="updateBusId" name="updateBusId">
    
    <div class="form-group">
        <label for="updateMileage">Mileage</label>
        <input type="number" id="updateMileage" name="updateMileage">
    </div>
    <div class="form-group">
        <label for="updateAvailability">Availability</label>
        <select id="updateAvailability" name="updateAvailability">
            <option value="Available">Available</option>
            <option value="Not Available">Not Available</option>
        </select>
    </div>
    <button type="submit" name="updateBusForm">Update</button>
</form>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
    <script>
        // Function to open the update modal
        function openUpdateModal(busId) {
            
            document.getElementById('updateModal').style.display = "block";
            document.getElementById('updateBusId').value=busId;
        }

        // Function to close the update modal
        function closeUpdateModal() {
            // Hide the modal
            document.getElementById('updateModal').style.display = "none";
        }
    </script>
  </body>
</html>
