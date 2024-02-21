<?php
session_start();
include "../koneksi.php";

// Function to retrieve all photo data
function ambilSemuaFoto() {
    global $conn;
    $query = "SELECT * FROM foto";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    return $data;
}

$datasfoto = ambilSemuaFoto();
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
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(20%, 10%));
            gap: 1em;
            padding: 10px;
            columns: 4;
            justify-content: center;
            column-gap: 10px;
        }

        .gallery-item {
            position: relative;
            border: 1px solid #000;
            border-radius: 5px;
            height:20em;
            overflow: hidden;
            padding: 8px;
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            display: block;
        }

        .dropdown {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .dropdown-content {
            display: none;
            position: fixed; /* Menggunakan posisi tetap */
            background-color: #f9f9f9;
            min-width: 100px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 8px 10px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown-icon {
            cursor: default;
            font-size: 24px; /* Ubah ukuran ikon dropdown */
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
                        <a href='album.php?userid='>Album</a>
                    </li>
                    
                </ul>



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
                                <a class="dropdown-item" href="datauser.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Data User
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

                <a href="" class="btn btn-primary" style='height:3em;width:200px;display:flex;justify-content:center;align-items:center;margin:0px auto;' data-toggle="modal" data-target="#tambahFotoModal">
    <i class="fas fa-plus-circle"></i> Tambah Foto
</a>

                <div class="gallery" >
                    <!-- Tombol Tambah Foto -->
                    <!-- Modal Tambah Foto -->

<div class="modal fade" id="tambahFotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tambahFotoModalBody">
                <!-- Konten akan dimuat melalui AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Tombol Tambah Foto -->

        
            <?php
             foreach ($datasfoto as $datafoto) : 
                if($datafoto["UserID"] == $_SESSION["UserID"]){
            ?>
                
                <div class="gallery-item">
                    <img style="height:10em;object-fit:cover" src="../img/<?= $datafoto['LokasiFile'] ?>" alt="<?= $datafoto['JudulFoto'] ?>">
                    <div class="dropdown">
        <span class="dropdown-icon" onclick="toggleDropdown(this)">&#8942;</span>
        <div class="dropdown-content">
        <a href="editfoto.php?FotoID=<?= $datafoto['FotoID'] ?>">Edit</a>
            <a href="#" onclick="hapusFoto(<?php echo $datafoto['FotoID']; ?>)">Hapus</a>
        </div>
    </div>
    
    <script>
        function hapusFoto(id) {
            if (confirm("Apakah Anda yakin ingin menghapus foto ini?")) {
                // Kirim ID foto ke halaman hapus.php
                window.location.href = "hapusfoto.php?id=" + id;
            }
        }
    </script>
    
                    <div class="caption">
                        <h3><?= $datafoto['JudulFoto'] ?></h3>
                        <p><?= $datafoto['DeskripsiFoto'] ?></p>
                        <p>Tanggal Unggah: <?= $datafoto['TanggalUnggah'] ?></p>
                        <p>AlbumID: <?= $datafoto['AlbumID'] ?></p>
                       
                    </div>
                </div>
            <?php } ?>
            <?php endforeach; ?>
            
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
                    <a class="btn btn-primary" href="../guset.php">Logout</a>
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

    <script>
        function toggleDropdown(element) {
            var dropdownContent = element.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        }
    </script>

<script>
    // Fungsi untuk memuat halaman tambah foto ke dalam modal
    function loadTambahFotoForm() {
        $.ajax({
            url: 'buat.php',
            type: 'GET',
            success: function(response) {
                $('#tambahFotoModalBody').html(response);
            }
        });
    }

    // Panggil fungsi ketika modal ditampilkan
    $('#tambahFotoModal').on('show.bs.modal', function (e) {
        loadTambahFotoForm();
    });
</script>

</body>
</html>

