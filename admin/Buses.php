<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

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
        .add-bus-button {
            
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            transition-duration: .3s;
        }

        .add-bus-button:hover {
            background-color: #45a049;
            transition-duration: .3s;
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

    <?php include  ("header_sidebar.php");?>

    

      <!-- Main -->
      <main class="main-container">
        <h1>Buses</h1>

        
        <?php
        include("busDisplay.php");
        ?>
        <br>
        

        <div class="type_sheet">
                  <a href="AddBus.php" class="add-bus-button">ADD BUS</a>
                  <div class="PDF-download">
                      <a href="PDF/BusPDF.php">
                      <button class="alt-btn"  style="
                        height: 40px;
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
  </body>
</html>