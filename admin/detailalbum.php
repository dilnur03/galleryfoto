<?php
session_start();
include "../koneksi.php";

// Ambil AlbumID dari URL
if(isset($_GET['AlbumID'])) {
    $albumID = $_GET['AlbumID'];

    // Query untuk mendapatkan informasi album
    $query_album = "SELECT * FROM album WHERE AlbumID = $albumID";
    $result_album = mysqli_query($conn, $query_album);
    $album = mysqli_fetch_assoc($result_album);
}
else {
    // Redirect atau penanganan kesalahan jika AlbumID tidak ada di URL
    header("Location: ../beranda.php");
    exit();
}

// Query untuk mendapatkan foto-foto dari album tertentu
$query_foto = "SELECT * FROM foto WHERE AlbumID = $albumID";
$result_foto = mysqli_query($conn, $query_foto);

// Query untuk mendapatkan informasi user berdasarkan UserID
$query_user = "SELECT * FROM user WHERE UserID = {$album['UserID']}";
$result_user = mysqli_query($conn, $query_user);
$user = mysqli_fetch_assoc($result_user);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Album</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <title>Detail Album: <?= isset($album['NamaAlbum']) ? $album['NamaAlbum'] : 'Album Tidak Ditemukan' ?></title>
<style>
    body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fc;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .album-title {
    margin-top: 5px;
    margin-bottom: 5px;
    font-size: 24px;
    font-weight: bold;
    color: #333;
    text-align: center;
}


        .photo-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
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
                        <a href='admin.php'>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href='datafoto.php'>Foto</a>
                    </li>
                    <li class="nav-item">
                        <a href='album.php'>Album</a>
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
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container">

<!-- Judul Album -->
<h1 class="album-title"> <?= isset($album['NamaAlbum']) ? $album['NamaAlbum'] : 'Album Tidak Ditemukan' ?></h1>

<!-- UserID dan Tanggal Pembuatan -->
<p><strong><i class="fas fa-user"></i></strong> <?= isset($user['username']) ? $user['username'] : 'Username tidak tersedia' ?></p>

<p><strong>Deskripsi:</strong> <?= isset($album['Deskripsi']) ? $album['Deskripsi'] : 'Deskripsi tidak tersedia' ?></p>
<p><strong>Created At:</strong> <?= isset($album['created_at']) ? $album['created_at'] : 'Tanggal pembuatan tidak tersedia' ?></p>

<!-- Tampilkan foto-foto dalam album -->
<div class="photo-container">
    <?php while($foto = mysqli_fetch_assoc($result_foto)) : ?>
        <div class="photo-item" >
            <a href="detail.php?id=<?= $foto['FotoID'] ?>">
                <img src="../img/<?= $foto['LokasiFile'] ?>" alt="<?= $foto['JudulFoto'] ?>">
            </a>
        </div>
    <?php endwhile; ?>
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
                    <a class="btn btn-primary" href="../../dashboard/guset.php">Logout</a>
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