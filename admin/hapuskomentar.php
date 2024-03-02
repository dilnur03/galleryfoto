<?php
// Pastikan komentar_id telah diterima melalui metode POST
if(isset($_POST['comment_id'])) {
    // Ganti nilai 'username' dan 'password' sesuai dengan kredensial database Anda
    $db_host = "localhost"; // Host database (biasanya localhost)
    $db_username = "root"; // Nama pengguna database (sesuaikan jika berbeda)
    $db_password = ""; // Kata sandi database (sesuaikan jika berbeda)
    $db_name = "gallery"; // Nama database

    // Lakukan koneksi ke database
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    // Periksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Lakukan sanitasi data
    $comment_id = mysqli_real_escape_string($conn, $_POST['comment_id']);

    // Buat query untuk menghapus komentar dari tabel komentarfoto
    $sql = "DELETE FROM komentarfoto WHERE KomentarID = '$comment_id'";

    // Jalankan query
    if (mysqli_query($conn, $sql)) {
        echo "Komentar berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
} else {
    echo "ID komentar tidak diterima.";
}
?>
