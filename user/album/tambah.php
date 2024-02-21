<?php
session_start();
include "../../koneksi.php";

// Dapatkan nilai "UserID" dari session
$userID = $_SESSION['UserID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaAlbum = $_POST["NamaAlbum"];
    $deskripsiAlbum = $_POST["Deskripsi"];
    $userID = $_POST["UserID"];

    // Query SQL untuk menambahkan data album ke dalam tabel
    $sql = "INSERT INTO album (NamaAlbum, Deskripsi, UserID) 
            VALUES ('$namaAlbum', '$deskripsiAlbum', $userID)";

    if (mysqli_query($conn, $sql)) {
        header("Location: album.php"); // Redirect ke halaman album setelah berhasil menambahkan album
        exit();
    } else {
        echo "<div style='color: red;'><strong>Error: " . $sql . "<br>" . mysqli_error($conn) . "</strong></div>";
    }

    mysqli_close($conn);
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

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        /* Styling for the entire form */
        .form-tambah-album {
            max-width: 1000px;
            margin: 10px auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        /* Styling for form labels */
        .form-tambah-album label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        /* Styling for form inputs */
        .form-tambah-album input[type="text"],
        .form-tambah-album textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .form-tambah-album input[type="submit"] {
        background-color: #1e88e5; /* Ubah warna background */
        color: #fff;
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-tambah-album input[type="submit"]:hover {
        background-color: #005cb2; /* Ubah warna background saat hover */
    }

        /* Optional: Add some additional styling for a cleaner look */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #ececec;
        }
    </style>
</head>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

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

                <ul style='display:flex;gap:1em;list-style:none;align-items:center;top:5px;position:relative'>
                    <li class="nav-item">
                        <a href='../beranda.php'>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href='../buat.php'>Buat</a>
                    </li>
                    <li class="nav-item">
                        <a href=''>Album</a>
                    </li>
                    
                </ul>

              


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                      
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username']  ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                                    
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Data User
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid">
        <div class="form-tambah-album">
            <h2>Tambah Album</h2>
            <form method="POST" action="tambah.php">
                <label for="NamaAlbum">Nama Album:</label>
                <input type="text" name="NamaAlbum" required>

                <label for="Deskripsi">Deskripsi Album:</label>
                <textarea name="Deskripsi"></textarea>

                <input type="hidden" name="UserID" value="<?= $_SESSION['UserID'] ?>" required readonly>

                <input type="submit" value="Tambah Album">
            </form>
        </div>
    </div>


           
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>

</body>
</html>
