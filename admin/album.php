<?php
session_start();
include "../koneksi.php";

// Fetch photos from the database
    $sql = "SELECT * FROM foto ORDER BY TanggalUnggah DESC";
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

    <title>Album</title>

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
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); /* Adjusted minmax to 150px */
            grid-gap: 20px;
            padding: 20px;
            justify-content: center;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
            height: 150px; /* Fixed height for gallery items */
            position: relative;
        }

  

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .caption {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            text-align: center;
        }

        .add-album {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.add-album-icon {
    margin-bottom: 10px; /* Atur jarak antara ikon dan teks */
}

.add-album-icon i {
    color: #007bff; /* Warna ikon tambah */
}


        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        /* Dropdown styles */

        .dropdown1 {
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

                
<!-- Album gallery -->
<a href="tambahalbum.php" class="btn btn-primary" style="height:3em;width:200px;display:flex;justify-content:center;align-items:center;margin:0px auto;">
    <i class="fas fa-plus-circle"></i> Tambah Album
</a>

<div class="gallery">
   

    <!-- PHP loop to display albums -->
    <?php
    // Fetch album data from the database

    $sql = "SELECT * FROM album ";
    $result = mysqli_query($conn, $sql);

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Output HTML for each album
        echo "<div class='gallery-item dropdown' style='position: relative;'>"; // Opening gallery-item div
        echo "<a href='detailalbum.php?AlbumID=" . $row['AlbumID'] . "' class='gallery-item-link'>"; // Opening link tag

        // Fetch photo from the current album
        $sql_photo = "SELECT * FROM foto WHERE AlbumID = " . $row['AlbumID'] . " LIMIT 1";
        $result_photo = mysqli_query($conn, $sql_photo);
        $photo_row = mysqli_fetch_assoc($result_photo);

        // Output the album image with the src taken from the database
        if ($photo_row) {
            echo "<img src='../img/" . $photo_row['LokasiFile'] . "' alt='" . $row['NamaAlbum'] . "'>";
        } else {
            // If there are no photos for this album, you can display a placeholder image or leave it empty
            echo "<img src='../not.jpg' alt='No Image'>";
        }

        // Output the album name as the caption
        echo "<div class='caption' style='background-color: #007bff;'>" . $row['NamaAlbum'] . "</div>";
        echo "</a>"; // Closing link tag

        // Dropdown menu
        echo "<div class='dropdown1' style='position: absolute; top: 5px; right: 5px;'>"; // Opening dropdown div
        echo "<span class='dropdown-icon' onclick='toggleDropdown(this)'>&#8942;</span>"; // Dropdown toggle icon
        echo "<div class='dropdown-content'>"; // Opening dropdown content div
    


        echo "<a href='#' onclick='hapusAlbum(" . $row['AlbumID'] . ")'>Hapus</a>"; // Delete option
        echo "</div>"; // Closing dropdown content div
        echo "</div>"; // Closing dropdown div

        echo "</div>"; // Closing gallery-item div
    }
    ?>

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
        function hapusAlbum(albumID) {
    if (confirm("Apakah Anda yakin ingin menghapus album ini?")) {
        // Kirim permintaan AJAX untuk menghapus album
        $.ajax({
            type: "POST",
            url: "hapusalbum.php", // Ganti dengan URL yang sesuai
            data: { AlbumID: albumID },
            success: function(response) {
                // Reload halaman setelah penghapusan berhasil
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Terjadi kesalahan saat menghapus album.");
            }
        });
    }
}

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