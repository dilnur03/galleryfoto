<?php
session_start();
include "../koneksi.php";

if(isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];

    // Query untuk menghapus komentar dari database
    $delete_query = "DELETE FROM komentarfoto WHERE KomentarID = $comment_id";
    $result = mysqli_query($conn, $delete_query);

    if($result) {
        // Komentar berhasil dihapus, alihkan kembali ke halaman sebelumnya
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        // Terjadi kesalahan saat menghapus komentar
        echo "Terjadi kesalahan saat menghapus komentar.";
    }
} else {
    // Jika tidak ada data yang dikirimkan melalui POST
    echo "Tidak ada data yang diterima untuk menghapus komentar.";
}
?>
