<?php session_start(); // Start the session to access session variables ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    body {
      
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    #login-form{
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      width: 400px;
    }

    h1 {
      text-align: center;
    }

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"],
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="checkbox"] {
      margin-right: 5px;
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

    #message-popup {
      color: red;
      font-size: 12px;
      text-align: center; /* Center the text */
      margin-top: 10px; /* Add some top margin */
    }
  </style>
</head>
<body>

  <br> <br> <br> <br>

  <div class="container" id="login-form">
    <form  action="login_process.php" method="post" >
      <h1>Login</h1>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br>
     
      
      <button type="submit">Login</button>
      <div id="message-popup">
      <?php 
  if(isset($_SESSION['error_message'])) { // Check if error message exists in session
    echo $_SESSION['error_message']; // Display error message
    unset($_SESSION['error_message']); // Remove error message from session
  }
  ?>
      </div>
      
    </form>
  </div>
 
  <br> <br> <br> <br> <br>
  
</body>
</html>
