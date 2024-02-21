<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = new mysqli("localhost", "root", "", "gallery");

    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    $query = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($query);
    
    if ($result) {
        // Menggunakan num_rows bukan num_row
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verifikasi password dengan password_verify untuk hash password
            if (password_verify($password, $row["password"])) {
                // Data ditemukan, set session dan arahkan ke halaman sesuai peran
                session_start();
                $_SESSION["username"] = $row["username"];
                $_SESSION["role"] = $row["role"];
                $_SESSION["UserID"] = $row["UserID"];
                
                if ($row["role"] == "admin") {
                    header("Location: admin/admin.php");
                    exit; // tambahkan exit setelah header untuk memastikan redirect
                } elseif ($row["role"] == "user") {
                    header("Location: user/beranda.php");
                    exit; // tambahkan exit setelah header untuk memastikan redirect
                } else {
                    // Peran tidak valid, tambahkan penanganan sesuai kebutuhan
                    echo "Peran tidak valid";
                }
            } else {
                echo "Login gagal. Periksa kembali username dan password.";
            }
        } else {
            echo "Login gagal. Periksa kembali username dan password.";
        }
    } else {
        echo "Query gagal dieksekusi: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
  <title>Login | Petugas</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
     
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .login-container {
      margin-top: 100px;
    }

    .login-card {
      width: 300px;
      margin: auto;
    }
  </style>
</head>
<body>
  <div class="container login-container">
    <div class="card login-card">
      <div class="card-body">
        <h5 class="card-title text-center">Login</h5>

        <?php
        if(isset($error)){
          echo '<p class="text-danger">'.$error.'</p>';
        }
        ?>

        <form action="" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
        
        </form>
        <p class="mb-1">
          <!-- Tambahkan class Font Awesome icon -->
          <i class=" fa-user-plus"></i>
          <a href="registrasi.php">Registrasi</a>
        </p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
