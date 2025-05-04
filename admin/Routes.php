<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Your CSS styles for modal here */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 40%; /* Could be more or less, depending on screen size */
        }
        p{
            color: grey;
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Style for the No button */
        #noButton {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        #noButton:hover {
            background-color: #d32f2f;
        }

        /* Style for success message */
        #successMessage {
            display: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        /* Other CSS styles */
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
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="grid-container">
    <!-- Header and Sidebar -->
    <?php include("header_sidebar.php");?>
    <!-- Main -->
    <main class="main-container">
        <h1>Routes</h1>
        <!-- Routes Table -->
        <table border="1">
            <tr>
                <th>Route Name</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>Distance</th>
                <th>Action</th>
            </tr>
            <?php
            include 'db_connection.php';

            // Check if delete button is clicked for any row
            if(isset($_POST['route_id_to_delete'])) {
                $route_id_to_delete = $_POST['route_id_to_delete'];
                // SQL to delete record
                $sql_delete = "DELETE FROM route WHERE route_id=$route_id_to_delete";
                if ($conn->query($sql_delete) === TRUE) {
                    // Handle success
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }

            // Retrieve route records from the database
            $sql = "SELECT route_id, route_name, origin, destination, distance FROM route";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["route_name"]."</td>
                            <td>".$row["origin"]."</td>
                            <td>".$row["destination"]."</td>
                            <td>".$row["distance"]."</td>
                            <td>
                                <form method='post' id='deleteForm'>
                                    <input type='hidden' name='route_id_to_delete' value='".$row["route_id"]."'>
                                    <button type='button' onclick='confirmDelete(".$row["route_id"].")'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                }
            }
            else {
                echo "<tr><td colspan='5'>No routes found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <!-- End Routes Table -->
        <!-- PDF Download Button -->
        <div class="PDF-download">
            <a href="PDF/routePDF.php">
                <button class="alt-btn">Download PDF</button>
            </a>
        </div>
    </main>
    <!-- End Main -->
</div>

<!-- Modal for delete confirmation -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modalText">Are you sure you want to delete this route?</p>
        <input type="hidden" id="routeIdToDelete" name="delete_route">
        <button id="confirmDeleteYes">Yes</button>
        <button id="noButton" onclick="closeModal()">No</button>
    </div>
</div>

<!-- Success message -->
<div id="successMessage"></div>

<!-- JavaScript code -->
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Function to confirm delete and submit form
    function confirmDelete(routeId) {
        var modalText = document.getElementById("modalText");
        modalText.innerHTML = "Are you sure you want to delete this route?";
        modal.style.display = "block";
        // Set the form action dynamically to include the route id
        var form = document.getElementById("deleteForm");
        form.querySelector("[name='route_id_to_delete']").value = routeId;
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // When the user clicks on "Yes" button, submit the form
    document.getElementById("confirmDeleteYes").onclick = function() {
        document.getElementById("deleteForm").submit();
    }

    // When the user clicks on <span> (x), close the modal
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>
