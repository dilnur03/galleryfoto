<?php 
include "../koneksi.php";

$comment = $_POST['comment'];
$fotoID = $_POST['fotoID'];
$userID = $_POST["userID"];
$tanggal = date("Y-m-d");

$result = mysqli_query($conn,"INSERT INTO komentarFoto (FotoID,UserID,IsiKomentar,TanggalKomentar) VALUES('$fotoID','$userID','$comment','$tanggal')");

if($result){
    header("Location: detail.php?id=$fotoID");
    exit; // Penting untuk menghentikan eksekusi skrip setelah header redirect
} else {
    echo "Error";
}
?>
