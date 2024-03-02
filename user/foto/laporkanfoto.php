<?php
// Mulai session
session_start();

// Include file koneksi.php
include "../../koneksi.php";

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['UserID'])) {
    // Jika belum, alihkan pengguna ke halaman login atau ke halaman lain yang sesuai
    header("Location: halaman_login.php"); // Ubah sesuai dengan halaman login Anda
    exit(); // Pastikan untuk menghentikan eksekusi skrip setelah pengalihan
}

// Tangkap ID foto yang akan dilaporkan dari URL
$id_foto = $_GET['id'];

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap alasan laporan dari form
    $alasan_laporan = $_POST['alasan_laporan'];

    // Masukkan data laporan ke dalam database
    $query = "INSERT INTO laporan_foto (FotoID, UserID, Alasan) VALUES ('$id_foto', '" . $_SESSION['UserID'] . "', '$alasan_laporan')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Laporan berhasil disampaikan. Terima kasih telah berpartisipasi dalam menjaga keamanan platform kami.";
    } else {
        echo "Terjadi kesalahan. Mohon coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Foto</title>
    <!-- Tambahkan link ke file CSS atau tambahkan style langsung di sini sesuai kebutuhan -->
</head>

<body>
    <h1>Report Foto</h1>
    <p>Silakan sampaikan alasan Anda untuk melaporkan foto ini:</p>
    <form action="" method="post">
        <textarea name="alasan_laporan" rows="4" cols="50"></textarea><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>
