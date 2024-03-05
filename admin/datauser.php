<?php
session_start();
include "../koneksi.php";

// Tangani input pencarian
if(isset($_POST['search_submit'])) {
    $search_query = $_POST['search_query'];
    // Modifikasi query SQL untuk pencarian
    $sql = "SELECT * FROM user WHERE username LIKE '%$search_query%' OR Email LIKE '%$search_query%' OR Nama_Lengkap LIKE '%$search_query%' OR Alamat LIKE '%$search_query%' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
} else {
    // Query aslinya tanpa pencarian
    $sql = "SELECT * FROM user ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
}

// Fetch hasil query
$semuauser = mysqli_fetch_all($result, MYSQLI_ASSOC);

// In koneksi.php or another included file
function ambilSemuauser() {
    global $conn; // Assuming $conn is your database connection variable

    // Your code to retrieve all user data from the database
    $query = "SELECT * FROM user";
    $result = mysqli_query($conn, $query);

    // Check for errors in the query
    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Fetch the data and return it
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // Free the result set
    mysqli_free_result($result);

    return $data;
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
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .navbar {
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000; /* ensure the navbar is above other content */
        }
        #content {
            margin-top: 100px; /* Adjust this value based on your navbar's height */
        }
        /* CSS for User Data Table */
        .container {
            width: 100%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            border: 1px solid transparent;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-warning {
            color: #fff;
            background-color: #f0ad4e;
            border-color: #eea236;
        }

        .btn-danger {
            color: #fff;
            background-color: #d9534f;
            border-color: #d43f3a;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .btn:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
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
                <!-- Navigation Links -->
                <ul style='display:flex;gap:1em;list-style:none;align-items:center;top:5px;position:relative'>
                    <li class="nav-item">
                        <a href='admin.php'>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href='datafoto.php'>Foto</a>
                    </li>
                    <li class="nav-item">
                        <a href='album.php'>Album</a>
                    </li>
                </ul>
                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST">
                    <div class="input-group" style='position:relative;left:12em'>
                        <input type="text" name="search_query" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="search_submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
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
                            <a class="dropdown-item" href="datauser.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Data User
                            </a>
                            <a class="dropdown-item" href="datalaporan.php">
                                 <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Data Laporan
                                </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- Button to add user -->
            <div class="container">
                <!-- Success message for user update -->
                <?php if (!empty($success_message)) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success_message ?>
                    </div>
                <?php endif; ?>
                <!-- Button to add user -->
               <?php if ($_SESSION['role'] === 'admin') : ?>
                    <!-- <a href="tambahuser.php" class="btn btn-primary mb-3">Tambah User</a> -->
                <?php endif; ?>
                <!-- User data table -->
                <table class="table mt-4">
                    <!-- table headers -->
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- loop through user data -->
                        <?php foreach ($semuauser as $user) : ?>
                            <?php if ($_SESSION['role'] === 'admin') : ?>
                                <tr>
                                    <td><?= $user['UserID']; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['Email']; ?></td>
                                    <td><?= $user['Nama_Lengkap']; ?></td>
                                    <td><?= $user['Alamat']; ?></td>
                                    <td><?= $user['role']; ?></td>
                                    <td><?= $user['created_at']; ?></td>
                                    <td>
                                        <a href="hapusdatauser.php?UserID=<?= $user['UserID']; ?>&success=true" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Additional content -->
            <div class="container-fluid">
                <!-- Additional content here -->
            </div>
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
                    <a class="btn btn-primary" href="../dashboard/guset.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Function to scroll to the top of the page smoothly
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Adding click event listener to the scroll-to-top button
    document.querySelector('.scroll-to-top').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default behavior of anchor link
        scrollToTop(); // Call the scrollToTop function
    });
</script>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
</body>
</html>
