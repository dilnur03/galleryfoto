<?php
session_start();
include "../koneksi.php";

// Fetch photos from the database
$sql = "SELECT * FROM foto ORDER BY TanggalUnggah DESC";
$result = mysqli_query($conn, $sql);

$id = $_GET['id'];
$userid = $_SESSION["UserID"];
// $result = mysqli_query($conn,"SELECT * FROM foto WHERE FotoID = $id ");
$result =mysqli_query($conn,"SELECT u.username,foto.JudulFoto,foto.FotoID,foto.* FROM foto
JOIN user u ON u.UserID=foto.UserID
where foto.FotoID=$id");
$data = mysqli_fetch_assoc($result);







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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezCmP5C1TO1N2rDNbFPKb8J4jkUM55uwE4FksBn7I8fB6CqzHARMG8AxXGxI4jSg" crossorigin="anonymous">


    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        body {
    font-family: 'Roboto Mono', monospace;
    background-color: #cbd5e0; /* You can change this color as needed */
}

.img-container {
    height: 400px; /* Adjust the height as needed */
    overflow: hidden;
}

.img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.container {
    max-width: 100%;
}

.flex {
    display: flex;
}

.justify-center {
    justify-content: center;
}

.px-6 {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

.my-12 {
    margin-top: 3rem;
    margin-bottom: 3rem;
}

.w-full {
    width: 100%;
}



.hidden {
    display: none;
}

.lg\:block {
    display: block;
}



.bg-gray-400 {
    background-color: #cbd5e0; /* You can change this color as needed */
}

.bg-cover {
    background-size: cover;
}

.rounded-l-lg {
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}

.bg-white {
    background-color: #ffffff; /* You can change this color as needed */
}

.p-5 {
    padding: 1.25rem;
}

.rounded-lg {
    border-radius: 0.375rem;
}

.lg\:rounded-l-none {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.pt-4 {
    padding-top: 1rem;
}

.text-2xl {
    font-size: 1.5rem;
}

.text-center {
    text-align: center;
}

.px-8 {
    padding-left: 2rem;
    padding-right: 2rem;
}

.pt-6 {
    padding-top: 1.5rem;
}

.pb-8 {
    padding-bottom: 2rem;
}

.mb-4 {
    margin-bottom: 1rem;
}

.text-sm {
    font-size: 0.875rem;
}

.font-bold {
    font-weight: bold;
}

.text-gray-700 {
    color: #4a5568; /* You can change this color as needed */
}

.w-full {
    width: 100%;
}

.px-3 {
    padding-left: 0.75rem;
    padding-right: 0.75rem;
}

.py-2 {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

.leading-tight {
    line-height: 1.25;
}

.border {
    border-width: 1px;
    border-style: solid;
}

.shadow {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.appearance-none {
    appearance: none;
    outline: none;
}

.focus\:outline-none:focus {
    outline: none;
}

.focus\:shadow-outline:focus {
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
}

.border-red-500 {
    border-color: #e53e3e; /* You can change this color as needed */
}

.italic {
    font-style: italic;
}

.text-red-500 {
    color: #e53e3e; /* You can change this color as needed */
}

.mr-2 {
    margin-right: 0.5rem;
}

.checkbox_id {
    width: 1rem;
    height: 1rem;
}

.hover\:bg-blue-700:hover, .focus\:bg-blue-700:focus {
    background-color: #2b6cb0; /* You can change this color as needed */
}

.text-white {
    color: #ffffff; /* You can change this color as needed */
}

.hover\:text-blue-800:hover {
    color: #2c5282; /* You can change this color as needed */
}

.text-xs {
    font-size: 0.75rem;
}

.align-baseline {
    vertical-align: baseline;
}

.inline-block {
    display: inline-block;
}

.hover\:text-blue-800:hover {
    color: #2b6cb0; /* You can change this color as needed */
}

.border-t {
    border-top-width: 1px;
}

.text-blue-500 {
    color: #4299e1; /* You can change this color as needed */
}

.dropbtn {
    background-color: transparent;
    color: white;
    font-size: 20px;
    border: none;
    cursor: pointer;
}

/* Dropdown container (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #f1f1f1;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
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
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                
             

                <body class="font-mono bg-gray-400">
    <!-- Container -->
    <div class="container mx-auto">
        <div class="flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg img-container">
                    <img src="../img/<?= $data['LokasiFile']?>" alt="">
                </div>
                <!-- Col 2 -->
                <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
                
                    
    
                        <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                        <?= $data['username'] ?>
                            </label>
                            <br>
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                        <?= $data['JudulFoto'] ?>
                            </label>
                            <br>
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                <?= $data['DeskripsiFoto'] ?>
                            </label>
                            <br>
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                <?= $data['TanggalUnggah'] ?>
                            </label>
                        </div>
                        
                        <hr class="mb-6 border-t" />
                        <div class="flex items-center mb-4">
    <?php
        //$getlike = mysqli_query($conn,"SELECT * FROM likefoto WHERE FotoID = $_GET[id]");
        //$getlike = mysqli_query($conn,"SELECT * FROM likefoto WHERE FotoID = $id ");
        $getlike = mysqli_query($conn,"SELECT * FROM likefoto WHERE FotoID = $id");
        
        $datalike = mysqli_fetch_assoc($getlike);
        
        $ceklike = mysqli_query($conn,"SELECT count(*) as jml FROM likefoto WHERE FotoID = $id and UserId = $userid ");
        
        $cekdatalike = mysqli_fetch_assoc($ceklike);

        //echo var_dump($cekdatalike);

     //&& $cekdatalike["jml"] === 1
    ?>
            
    <?php
        if(!empty($datalike["FotoID"] ) && !empty($datalike["UserID"])){
            //echo 'tes1'.$_SESSION['UserID'];
            
            //if($datalike["FotoID"] === $id && $datalike["UserID"] === $_SESSION["UserID"] ){
                if($datalike["FotoID"] === $id && $cekdatalike["jml"] >= 1 ){  
                // if($datalike["FotoID"] === $id ){
               // echo 'test 2'.$_SESSION['UserID'];
    ?>
        <!-- Like Icon -->
       <!-- Kondisi user sudah like -->
        <form method="post" action="proses_like.php">
            <input type='number' name='fotoID' style="display:none" value='<?= $_GET['id']; ?>' />
            <input type='number' name='userID' style="display:none" value='<?= $_SESSION["UserID"] ?>'/>
            <button type='submit' name='hapus' style='border:none'>
                
                <i class="fas fa-heart" style="color: red;"></i>
            </button>
        </form>
        
            
            <!-- Buat kondisi user yang belum like tapi user lain udah like  -->
            <?php }else{
                 //echo 'test3'.$_SESSION['UserID'];?> 
                 <form method="post" action="proses_like.php">
                     <input type='number' name='fotoID' style="display:none" value='<?= $_GET['id']; ?>' />
                     <input type='number' name='userID' style="display:none" value='<?= $_SESSION["UserID"] ?>'/>
                     <button type='submit' name="tambah" style='border:none'>
                     <i class="far fa-heart"></i>
                     </button>
                 </form>
           <?php }
        } else{ //echo 'test4'.$_SESSION['UserID'];
        ?> 
            <!-- kondisi like saat awal jika belum ada like -->
            <form method="post" action="proses_like.php">
                <input type='number' name='fotoID' style="display:none" value='<?= $_GET['id']; ?>' />
                <input type='number' name='userID' style="display:none" value='<?= $_SESSION["UserID"] ?>'/>
                <button type='submit' name="tambah" style='border:none'>
                <i class="far fa-heart"></i>
                </button>
            </form>
        <?php } ?>


    <!-- Like Text and Comment Icon -->
    <span class="ml-2 text-sm text-gray-700">
        <?= mysqli_num_rows($getlike) ?> Likes
            <!-- Komentar Icon -->


<?php 
    $checkresult = mysqli_query($conn,"SELECT * FROM foto WHERE AlbumID <> 0 AND FotoID = $id");
    if(mysqli_num_rows($checkresult)>0){
?>
<div class="" style="display: inline-block;">
    <form style="display:flex;flex-direction:row;justify-content:between" id="addToAlbumForm" method="post" action="prosesalbum.php">
        <!-- Input hidden untuk menyimpan ID foto -->
        <input type="hidden" name="fotoID" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">
        <!-- Input hidden untuk menyimpan ID album yang dipilih -->
        <input type="hidden" id="selectedAlbumID" name="albumID" value="">
                <button type="submit" name='bookmark' class="dropbtn">
                    <i class="far fa-bookmark" style="background-color: black;" ></i>
                </button>
    </form>
</div>
<?php } else {?>
    <div class="dropdown" style="display: inline-block;">
        <form id="addToAlbumForm" method="post" action="prosesalbum.php">
            <!-- Input hidden untuk menyimpan ID foto -->
            <input type="hidden" name="fotoID" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">
            <!-- Input hidden untuk menyimpan ID album yang dipilih -->
            <input type="hidden" id="selectedAlbumID" name="albumID" value="">
                    <button type="button" class="dropbtn">
                        <i class="far fa-bookmark" style="color: black;"></i>
                    </button>
            <div class="dropdown-content">
                <!-- Fetch albums from the database -->
                <?php
         
       
    
    
                // Pastikan Anda memiliki koneksi ke database di sini
                $album_query = mysqli_query($conn, "SELECT * FROM album WHERE UserID = $userid");
                if ($album_query) {
                    while ($album = mysqli_fetch_assoc($album_query)) {
                        echo "<a href='#' class='albumLink' data-albumid='" . $album['AlbumID'] . "'>" . $album['NamaAlbum'] . "</a>";
                    }
                } else {
                    echo "Error fetching albums: " . mysqli_error($conn);
                }
                ?>
            </div>
        </form>
    </div>

<?php } ?>



        </div>

                        <!-- Comment Section -->
                       <!-- Comment Section -->
<div class="mb-4">
    <h2 class="text-xl font-bold mb-2">Komentar</h2>

    <?php
    // Assuming you have a table named 'comments' with columns 'username' and 'comment'
    $commentResult = mysqli_query($conn, "SELECT komentarfoto.*,user.* from komentarfoto INNER JOIN user ON komentarfoto.UserID = user.UserID WHERE komentarfoto.FotoID = $id");

    while ($comment = mysqli_fetch_assoc($commentResult)) {
        ?>
        <div class="mb-2">
            <span class="font-bold"><?= $comment['username'] ?>:</span>
            <p class="text-gray-700"><?= $comment['IsiKomentar'] ?></p>
        </div>
        <?php
    }
    ?>

    <!-- Comment Form -->
    <form action='komentar.php' method="post">

<div class="mb-2">
    <label class="block text-sm font-bold text-gray-700" for="comment">Tambahkan Komentar :</label>
    <textarea class="w-full h-20 px-3 py-2 border rounded-md" id="comment" name="comment" placeholder="Tulis komentar Anda"></textarea>
    <input type='hidden' name='fotoID' value="<?= $id ?>" />
    <input type='hidden' name='userID' value="<?= $_SESSION["UserID"] ?>" />
    <!-- Hapus kelas text-white untuk mengubah warna teks tombol menjadi hitam -->
    <button class=" px-4 py-2 rounded-md hover:bg-blue-600" style="color: #2b6cb0;" type="submit">Kirim Komentar</button>
</div>

</form>


</div>

                    
                </div>
            </div>
        </div>
    </div>
              
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
                    <a class="btn btn-primary" href="../beranda.php">Logout</a>
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
document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan event listener untuk setiap album link
    const albumLinks = document.querySelectorAll('.albumLink');
    albumLinks.forEach(function(albumLink) {
        albumLink.addEventListener('click', function(event) {
            event.preventDefault();
            const albumID = this.getAttribute('data-albumid');
            document.getElementById('selectedAlbumID').value = albumID;

            // Submit form secara otomatis setelah album dipilih
            document.getElementById('addToAlbumForm').submit();
        });
    });
});

</script>




</body>
</html>


