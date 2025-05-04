<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Navbar</title>
    <style>
        /* Custom Styles */
        .navbar {
            background-color: #222023;
            color: #fff;
            padding: 20px 0;
            font-size: 16px;
        }
        
        .navbar-brand {
            font-size: 24px;
            font-weight: 600;
            color: #ed1b24;
        }
        
        .navbar-nav .nav-link {
            color: #fff;
            padding: 0.5rem 1rem;
            transition: color 0.3s;
        }
        
        .navbar-nav .nav-link:hover {
            color: #ed1b24;
        }
        
        .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
        }
        
        .dropdown-menu {
            display: none;
        }
        
        .navbar-toggler {
            border-color: #fff;
        }
        
        .navbar-toggler-icon {
            background-color: #fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" >Yathu ija Bus Company</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Signup</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>
