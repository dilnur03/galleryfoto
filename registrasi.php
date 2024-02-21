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

        if ($result) {
            echo "Registration successful. You can now <a href='login.php'>login</a>.";
        } else {
            echo "Registration failed. Please try again.";
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration | Gallery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
    </style>
</head>
<body>
    <div class="container registration-container">
        <div class="card registration-card">
            <div class="card-body">
                <h5 class="card-title text-center">Registration</h5>

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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
