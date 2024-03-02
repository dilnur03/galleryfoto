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
    $idpage = $_POST['id_page'];

    // Buat query untuk mengambil komentar sebelum menghapus
    $query_select_comment = "SELECT * FROM komentarfoto WHERE KomentarID = '$comment_id'";
    $result_select_comment = mysqli_query($conn, $query_select_comment);
    $comment = mysqli_fetch_assoc($result_select_comment);
    $username = $comment['username']; // Misalkan username tersimpan dalam kolom 'username'

    // Pemberitahuan sebelum menghapus komentar
    echo "Apakah Anda yakin ingin menghapus komentar dari pengguna $username?";

    // Buat query untuk menghapus komentar dari tabel komentarfoto
    $sql = "DELETE FROM komentarfoto WHERE KomentarID = '$comment_id'";

    // Jalankan query
    if (mysqli_query($conn, $sql)) {
        // Tutup koneksi ke database
        mysqli_close($conn);
        // Redirect kembali ke halaman detail.php
        header("Location: detail.php?id=$idpage");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
} else {
    echo "ID komentar tidak diterima.";
}
?>
