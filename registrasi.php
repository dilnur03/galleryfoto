<?php
// Inisialisasi variabel pesan kesalahan
$username_error = $email_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the registration form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $Nama_Lengkap = $_POST["full_name"];
    $Alamat = $_POST["address"];
    $role = $_POST["role"];

    // Perform database operations to check if email or username already exists
    $conn = new mysqli("localhost", "root", "", "gallery");

    if ($conn->connect_error) {
        die("Connection to database failed: " . $conn->connect_error);
    }

    // Check if email already exists
    $email_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $email_result = $conn->query($email_check_query);
    if ($email_result && $email_result->num_rows > 0) {
        $email_error = "Email already exists. Please choose a different email.";
    }

    // Check if username already exists
    $username_check_query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
    $username_result = $conn->query($username_check_query);
    if ($username_result && $username_result->num_rows > 0) {
        $username_error = "Username already exists. Please choose a different username.";
    }

    if (empty($email_error) && empty($username_error)) {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the 'user' table
        $query = "INSERT INTO user (username, password, email, Nama_Lengkap, Alamat, role) VALUES ('$username', '$hashed_password', '$email', '$Nama_Lengkap', '$Alamat', '$role')";
        $result = $conn->query($query);

      
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Guest</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('foto2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .registration-container {
            margin-top: 50px;
        }

        .registration-card {
            width: 400px;
            margin: auto;
        }

        .navbar {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000; /* ensure the navbar is above other content */
        }

        #content {
            margin-top: 100px; /* Adjust this value based on your navbar's height */
        }
    </style>


</head>

<body id="page-top">
    <!-- Content Wrapper -->
    <div id="content-wrapper">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Gallery Title -->
                <h2 class="gallery-title text-primary">Gallery Foto</h2>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <!-- Search Form -->
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <div class="hidden md:flex items-center space-x-1">
                        <a href="login.php" class="py-5 px-3">Login</a>
                        <a href="registrasi.php"
                            class="py-2 px-3 bg-yellow-400 hover:bg-yellow-300 text-yellow-900 hover:text-yellow-800 rounded transition duration-300">Signup</a>
                    </div>

                </ul>
            </nav>
            <!-- End of Topbar -->

          

            <!-- Registration Successful Notification -->
         <!-- Registration Successful Notification -->
<?php 
    $result = isset($result) ? $result : false; // Set nilai awal variabel $result
    if ($result !== false): ?>
    <div class="alert alert-success" role="alert">
        Registration successful. You can now <a href='login.php'>login</a>.
    </div>
<?php endif; ?>


            <!-- Registration Form -->
            <div class="container registration-container">
                <div class="card registration-card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Registration</h5>
                        <!-- Registration Form Content -->
                        <!-- Tampilkan pesan kesalahan di atas formulir -->
                        <?php if (!empty($username_error) || !empty($email_error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $username_error; ?>
                                <?php echo $email_error; ?>
                            </div>
                        <?php endif; ?>

                        <form action="" method="post" id="registration-form">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                            </div>
                            <div class="form-group" style="display:none">
                                <label for="role">Role</label>
                                <input name="role" value="user" />
                            </div>
                            <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
                        </form>

                        <p class="mt-3 mb-1 text-center">
                            <i class="fa fa-user"></i>
                            <a href="login.php">Already have an account? Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Content -->

    </div>
    <!-- End of Content Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <!-- Modal Content -->
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
