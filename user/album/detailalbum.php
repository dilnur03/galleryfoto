<?php
session_start();
include "../../koneksi.php";

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            margin-top: 20px;
            margin-bottom: 20px;
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
<body>
    
<div class="container">

    <!-- Judul Album -->
    <h1 class="album-title"> <?= isset($album['NamaAlbum']) ? $album['NamaAlbum'] : 'Album Tidak Ditemukan' ?></h1>

    <!-- Tampilkan foto-foto dalam album -->
    <div class="photo-container">
        <?php while($foto = mysqli_fetch_assoc($result_foto)) : ?>
            <div class="photo-item" >
                <img src="../../img/<?= $foto['LokasiFile'] ?>" alt="<?= $foto['JudulFoto'] ?>">
            </div>
        <?php endwhile; ?>
    </div>

</div>
          
</body>
</html>
