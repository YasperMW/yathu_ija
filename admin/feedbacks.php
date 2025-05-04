<?php 
    require_once("db_connection.php");

    // View feedbacks after running a query to select all rows of tms_feedback table
    $sql = "SELECT * FROM tms_feedback";
    $result = mysqli_query($conn, $sql);

    // Delete feedback if delete button is clicked
    if(isset($_GET['delete_feedback'])) {
        $feedback_id = $_GET['feedback_id'];
        $delete_sql = "DELETE FROM tms_feedback WHERE f_id = $feedback_id";
        mysqli_query($conn, $delete_sql);
        // Redirect back to this page after deletion
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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


    

    </style>
</head>
<body>
    <div class="grid-container">
        <?php include("header_sidebar.php");?>
        <!-- Main -->
        <main class="main-container">
            <h1>Feedbacks</h1>
            <table border="1">
                <tr>
                    <th>Feedback ID</th>
                    <th>Username</th>
                    <th>Content</th>
                   
                    <th>Action</th>
                </tr>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['f_id']; ?></td>
                    <td><?php echo $row['f_uname']; ?></td>
                    <td><?php echo $row['f_content']; ?></td>
                  
                    <td>
                        <button class="alt-btn" onclick="confirmDelete(<?php echo $row['f_id']; ?>)">Delete</button>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No feedbacks found</td></tr>";
                }
                ?>
            </table>


            <div class="PDF-download">
                <a href="PDF/feedbackPDF.php">
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
        function confirmDelete(feedback_id) {
            if (confirm("Are you sure you want to delete this feedback?")) {
                window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?delete_feedback&feedback_id=' + feedback_id;
            }
        }
    </script>
</body>
</html>
