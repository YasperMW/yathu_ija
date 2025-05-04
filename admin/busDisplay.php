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
        .labels{
            color: grey;
        }
        #mileage, #fuel {
            width: 90px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include 'db_connection.php';

// Check if delete button is clicked for any row
if(isset($_POST['bus_id_to_delete'])) {
    $bus_id_to_delete = $_POST['bus_id_to_delete'];
    // SQL to delete record
    $sql_delete = "DELETE FROM bus WHERE bus_id=$bus_id_to_delete";
    if ($conn->query($sql_delete) === TRUE) {
        // Handle success
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle update form submission
if(isset($_POST['bus_id_to_update'])) {
    $bus_id_to_update = $_POST['bus_id_to_update'];
    $availability = $_POST['availability'];
    $mileage = $_POST['mileage'];
    $fuel = $_POST['fuel']; // New fuel used value
    
    // SQL to update record
    $sql_update = "UPDATE bus SET availability='$availability', mileage='$mileage', fuel_used='$fuel' WHERE bus_id=$bus_id_to_update";
    if ($conn->query($sql_update) === TRUE) {
        // Handle success
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve bus records from the database
$sql = "SELECT bus_id, bus_name, bus_type, number_plate, number_of_seats, weight, mileage, availability, fuel_used FROM bus";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output table header
    echo "<table border='1'>
            <tr>
                <th>Bus Name</th>
                <th>Bus Type</th>
                <th>Number Plate</th>
                <th>Number of Seats</th>
                <th>Weight</th>
                <th>Mileage</th>
                <th>Availability</th>
                <th>Fuel</th>
                <th>Action</th>
                <th>Action 2</th>
            </tr>";

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["bus_name"]."</td>
                <td>".$row["bus_type"]."</td>
                <td>".$row["number_plate"]."</td>
                <td>".$row["number_of_seats"]."</td>
                <td>".$row["weight"]."</td>
                <td>".$row["mileage"]."</td>
                <td>".$row["availability"]."</td>
                <td>".$row["fuel_used"]."</td> <!-- Display fuel used -->
                <td>
                    <form method='post' id='deleteForm'>
                        <input type='hidden' name='bus_id_to_delete' value='".$row["bus_id"]."'>
                        <button type='button' onclick='confirmDelete(".$row["bus_id"].")'>Delete</button>
                    </form>
                </td>
                <td>
                    <button onclick='showUpdatePopup(".$row["bus_id"].", \"".$row["availability"]."\", \"".$row["mileage"]."\", \"".$row["fuel_used"]."\")'>Update</button>
                </td>
            </tr>";
    }
    echo "</table>";
}
else {
    echo "0 results";
}
$conn->close();
?>
<!-- Modal for delete confirmation -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p id="modalText">Are you sure you want to delete this bus?</p>
        <button id="confirmDeleteYes">Yes</button>
        <button id="noButton" onclick="closeModal()">No</button>
    </div>
</div>

<!-- Update modal -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateModal()">&times;</span>
        <form id="updateForm" method="post" onsubmit="return validateForm()">

    <label class="labels" for="availability">Availability:</label>
    <div>
        <input type="hidden" id="updateBusId" name="bus_id_to_update">
        <select id="availability" name="availability" required>
            <option value="Available">Available</option>
            <option value="Unavailable">Unavailable</option>
        </select>
    </div>

    <br>
    <label class="labels" for="mileage">Mileage:</label>
    <div>
        <input type="number" id="mileage" name="mileage" min="0" required>
    </div>
    
    <br>
    <label class="labels" for="fuel">Fuel Used (max 6 characters):</label>
    <div>
        <input type="text" id="fuel" name="fuel" pattern="\d+(\.\d{1,2})?" title="Please enter a non-negative number" maxlength="6" required>
    </div>
    
    <br>
    <button type="submit" name="update">Update</button>
</form>

<script>
    function validateForm() {
        var mileage = document.getElementById("mileage").value;
        var fuel = document.getElementById("fuel").value;
        
        // Check if mileage is non-negative
        if (mileage < 0) {
            alert("Mileage cannot be negative.");
            return false;
        }
        
        // Check if fuel is non-negative
        if (fuel < 0) {
            alert("Fuel used cannot be negative.");
            return false;
        }
        
        return true; // Form is valid
    }
</script>

    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");
    var updateModal = document.getElementById("updateModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close");

    // Function to confirm delete and submit form
    function confirmDelete(busId) {
        var modalText = document.getElementById("modalText");
        modalText.innerHTML = "Are you sure you want to delete this Bus?";
        modal.style.display = "block";
        // Set the form action dynamically to include the bus id
        var form = document.getElementById("deleteForm");
        form.querySelector("[name='bus_id_to_delete']").value = busId;
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    function showUpdatePopup(busId, availability, mileage, fuel) {
        document.getElementById("updateBusId").value = busId;
        document.getElementById("availability").value = availability;
        document.getElementById("mileage").value = mileage;
        document.getElementById("fuel").value = fuel; // Populate fuel used field
        updateModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    for (var i = 0; i < span.length; i++) {
        span[i].onclick = function() {
            modal.style.display = "none";
            updateModal.style.display = "none";
        }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal || event.target == updateModal) {
            modal.style.display = "none";
            updateModal.style.display = "none";
        }
    }

    function closeUpdateModal() {
        updateModal.style.display = "none";
    }
</script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("confirmDeleteYes");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Function to confirm delete and submit form
    function confirmDelete(busId) {
        var modalText = document.getElementById("modalText");
        modalText.innerHTML = "Are you sure you want to delete this Bus " + " " + "?";
        modal.style.display = "block";
        // Set the form action dynamically to include the bus id
        var form = document.getElementById("deleteForm");
        form.querySelector("[name='bus_id_to_delete']").value = busId;
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Check for session variable to show success message
    <?php if(isset($_SESSION['bus_deleted']) && $_SESSION['bus_deleted'] === true) { ?>
        document.getElementById("successMessage").innerHTML = "Bus deleted successfully!";
        document.getElementById("successMessage").style.display = "block";
    <?php 
        // Unset the session variable to avoid showing the message again on page reload
        unset($_SESSION['bus_deleted']);
    } ?>

    // When the user clicks on "Yes" button, submit the form
    btn.onclick = function() {
        document.getElementById("deleteForm").submit();
    }
</script>

</body>
</html>
