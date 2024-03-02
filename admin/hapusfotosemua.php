<?php
session_start();
include "../koneksi.php";

// Pastikan pengguna telah login
if (!isset($_SESSION['UserID'])) {
    header("Location: ../login.php");
    exit;
}

// Pastikan permintaan adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah ID foto disertakan dalam permintaan
    if (isset($_POST['fotoID'])) {
        $fotoID = $_POST['fotoID'];
        
        // Query SQL untuk menghapus foto dari basis data
        $deleteQuery = "DELETE FROM foto WHERE FotoID = $fotoID";

        // Jalankan kueri untuk menghapus foto
        if (mysqli_query($conn, $deleteQuery)) {
            // Jika penghapusan berhasil, alihkan pengguna kembali ke halaman admin.php
            $_SESSION['success_message'] = "Foto berhasil dihapus.";
            header("Location: admin.php");
            exit;
        } else {
            // Jika terjadi kesalahan saat menghapus, kirimkan pesan kesalahan
            $_SESSION['error_message'] = "Terjadi kesalahan saat menghapus foto.";
            header("Location: admin.php");
            exit;
        }
    } else {
        // Jika ID foto tidak disertakan dalam permintaan, kirimkan pesan kesalahan
        $_SESSION['error_message'] = "ID foto tidak valid.";
        header("Location: admin.php");
        exit;
    }
} else {
    // Jika permintaan bukan metode POST, kirimkan pesan kesalahan
    $_SESSION['error_message'] = "Metode tidak diizinkan.";
    header("Location: admin.php");
    exit;
}
?>
