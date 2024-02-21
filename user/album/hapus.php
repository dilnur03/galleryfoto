<?php
session_start();
include "../../koneksi.php";

if(isset($_POST['AlbumID'])) {
    $albumID = $_POST['AlbumID'];

    // Query untuk menghapus album berdasarkan ID
    $deleteAlbumQuery = "DELETE FROM album WHERE AlbumID = $albumID";

    // Jalankan query
    if(mysqli_query($conn, $deleteAlbumQuery)) {
        echo "Album berhasil dihapus.";
    } else {
        echo "Gagal menghapus album: " . mysqli_error($conn);
    }
} else {
    echo "Parameter AlbumID tidak diterima.";
}
?>
