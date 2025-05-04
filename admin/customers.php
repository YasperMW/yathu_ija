<?php 
    require_once("db_connection.php");

    // View customers after running a query to select all rows of customers table
    $sql = "SELECT * FROM customer";
    $result = mysqli_query($conn, $sql);

    // Delete customer if delete button is clicked
    if(isset($_POST['delete_customer'])) {
        $customer_id = $_POST['customer_id'];
        $delete_sql = "DELETE FROM customer WHERE customer_id = $customer_id";
        mysqli_query($conn, $delete_sql);
        // Refresh page after deletion
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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />'
    '
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


        


        .header {
            grid-area: header;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px 0 30px;
            box-shadow: 0 6px 7px -3px rgba(0, 0, 0, 0.35);
  
            }
    </style>
  </head>
  <body>
    <div class="grid-container">

    
    <?php include  ("header_sidebar.php");?>
      <!-- Main -->
      <main class="main-container">
        <h1>Customers</h1>

            <table border=1>
                    <tr>
                        
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>PHONE NUMBER</th>
                        <th>EMAIL</th>
                        <th>DATE OF BIRTH</th>
                        <th>ACTION</th>
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
                                   
                                    <td>
                                        <button class="alt-btn" onclick="confirmDelete(<?php echo $row['customer_id']; ?>)">Delete</button>
                                    </td>

                                </tr>

                        </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='11'>No customers found</td></tr>";
                        }
                    ?>
            </table>
            <br>
            <div class="PDF-download">
                <a href="PDF/customerPDF.php">
                <button class="alt-btn">Download PDF</button>

                </a>
           
            </div>
           
        
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
    <script >    
        function confirmDelete(customer_id) {
            if (confirm("Are you sure you want to delete this customer?")) {
                window.location.href = 'delete_customer.php?customer_id=' + customer_id;
            }
        }
    </script>
  </body>
</html>