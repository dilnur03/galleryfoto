<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // Ambil nilai ID album dan ID foto dari formulir
        $albumID = $_POST['albumID'];
        $fotoID = $_POST['fotoID'];

        // Periksa apakah foto sudah ada dalam album yang dipilih
        $check_query = "SELECT * FROM foto WHERE FotoID = '$fotoID'";
        $result = mysqli_query($conn, $check_query);
        var_dump($conn);
    
        if (mysqli_num_rows($result) > 0) {
        // Foto ditemukan, update AlbumID
        $update_query = "UPDATE foto SET AlbumID = '$albumID' WHERE FotoID = '$fotoID'";
        if (mysqli_query($conn, $update_query)) {
            // Langsung kembali ke halaman detail.php setelah menambahkan foto ke album
            header("Location: detail.php?id=$fotoID");
            exit; // Pastikan untuk keluar setelah menggunakan header redirect
        } else {
            echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
        }
        } else {
            echo "Foto tidak ditemukan.";
        }
    
   
    
}  else if(isset($_POST['unbookmark'])){
    $albumID = $_POST['albumID'];
    $fotoID = $_POST['fotoID'];

    // Periksa apakah foto sudah ada dalam album yang dipilih
    $check_query = "SELECT * FROM foto WHERE FotoID = '$fotoID'";
    $result = mysqli_query($conn, $check_query);
    var_dump($conn);
    if (mysqli_num_rows($result) > 0) {
        // Foto ditemukan, update AlbumID
        $update_query = "UPDATE foto SET AlbumID = '' WHERE FotoID = '$fotoID'";
        if (mysqli_query($conn, $update_query)) {
            // Langsung kembali ke halaman detail.php setelah menambahkan foto ke album
            header("Location: detail.php?id=$fotoID");
            exit; // Pastikan untuk keluar setelah menggunakan header redirect
        } else {
            echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Foto tidak ditemukan.";
    }
}
?>
