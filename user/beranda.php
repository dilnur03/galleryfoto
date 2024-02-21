<?php
session_start();
include "../koneksi.php";

// Kueri default untuk mengambil semua foto
$sql = "SELECT * FROM foto ORDER BY TanggalUnggah DESC";

// Periksa apakah ada permintaan pencarian
if(isset($_GET['search'])) {
    $search = $_GET['search'];
    // Ubah kueri SQL untuk mencari foto berdasarkan kata kunci yang diberikan
    $sql = "SELECT * FROM foto WHERE JudulFoto LIKE '%$search%' ORDER BY TanggalUnggah DESC";
}

// Fetch photos from the database
$result = mysqli_query($conn, $sql);
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    .photo-container {
        width: 100%;
        columns: 5;
        column-gap: 10px;

    }

    .photo-item {
        max-width: 100%;
        overflow: hidden;
        margin-bottom: 10px;
        border-radius: 10px;
        transition: transform 0.3s;
    }

    .photo-item img {
        max-width: 100%;
        border-radius: 10px;
        transition: transform 0.3s;
    }

    .photo-item:hover {
        transform: scale(1.05);
    }

    .photo-item:hover img {
        transform: scale(1.1);
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

                <ul style='display:flex;gap:1em;list-style:none;align-items:center;top:5px;position:relative'>
                    <li class="nav-item">
                        <a href='beranda.php'>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href='foto/datafoto.php'>Foto</a>
                    </li>
                    <li class="nav-item">
                        <a href='album/album.php?userid='>Album</a>
                    </li>

                </ul>

                <!-- Topbar Search -->
                <form action="" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group" style='position:relative;left:12em'>
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2" name="search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

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
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>


            <div class="container-fluid">


                <!-- Fetch and display photos -->
                <div class="photo-container">

                    <?php
                    // Display photos
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="photo-item">';
                        echo '<a href="#" onclick="openDetailModal(\'' . $row['FotoID'] . '\')">';
                        echo '<img src="' ."../img/" .$row['LokasiFile'] . '" alt="' . $row['JudulFoto'] . '">';
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>

                </div>
            </div>

            <!-- JavaScript function to open the detail modal -->
            <script>
                function openDetailModal(photoID) {
                    // Redirect to detail.php with the photo ID
                    window.location.href = './foto/detail.php?id=' + photoID;
                }
            </script>

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

<?php
mysqli_close($conn);
?>
