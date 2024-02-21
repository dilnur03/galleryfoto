<?php
session_start();
include "../../koneksi.php";

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

    <title>SB Admin 2 - Dashboard</title>

    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

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
       

                
<!-- Album gallery -->
<div class="gallery">
  

    <!-- PHP loop to display albums -->
    <?php
    // Fetch album data from the database
    $id = $_SESSION['UserID'];
    $sql = "SELECT * FROM album WHERE UserID = $id";
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
            echo "<img src='../../img/" . $photo_row['LokasiFile'] . "' alt='" . $row['NamaAlbum'] . "'>";
        } else {
            // If there are no photos for this album, you can display a placeholder image or leave it empty
            echo "<img src='../../../not.jpg' alt='No Image'>";
        }

        // Output the album name as the caption
        echo "<div class='caption' style='background-color: #007bff;'>" . $row['NamaAlbum'] . "</div>";
        echo "</a>"; // Closing link tag

        // Dropdown menu
        echo "<div class='dropdown' style='position: absolute; top: 5px; right: 5px;'>"; // Opening dropdown div
        echo "<span class='dropdown-icon' onclick='toggleDropdown(this)'>&#8942;</span>"; // Dropdown toggle icon
        echo "<div class='dropdown-content'>"; // Opening dropdown content div
        echo "<a href='edit.php?AlbumID=" . $row['AlbumID'] . "'>Edit</a>"; // Edit option


        echo "<a href='#' onclick='hapusAlbum(" . $row['AlbumID'] . ")'>Delete</a>"; // Delete option
        echo "</div>"; // Closing dropdown content div
        echo "</div>"; // Closing dropdown div

        echo "</div>"; // Closing gallery-item div
    }
    ?>
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
            url: "hapus.php", // Ganti dengan URL yang sesuai
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

    




</body>
</html>