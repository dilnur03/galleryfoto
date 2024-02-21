<?php 
include "../../koneksi.php";

if(isset($_POST['tambah'])){
    $fotoid = $_POST['fotoID'];
    $userid = $_POST['userID'];
    $tanggal = date("Y-m-d");
      
    // echo 'tambah <br>';
    // echo  $fotoid,'<br>';
    // echo $userid,'<br>';
    // echo $tanggal;
    
    $result = mysqli_query($conn,"INSERT INTO likefoto (FotoID,UserID,created_at) VALUES ($fotoid,$userid,$tanggal)");
    
    if($result){
        header("Location:detail.php?id=$fotoid");
    }else{
        var_dump($conn);
    } 

}
else if(isset($_POST['hapus'])){
    $fotoid = $_POST['fotoID'];
    $userid = $_POST['userID'];
    $tanggal = date("Y-m-d");
    
    // echo 'delete <br>';
    // echo  $fotoid,'<br>';
    // echo $userid,'<br>';
    // echo $tanggal,'<br>';


    $result = mysqli_query($conn,"DELETE FROM likefoto WHERE FotoID = $fotoid AND UserID = $userid");
    
    if($result){
        header("Location:detail.php?id=$fotoid");
    }else{
        var_dump($conn);
    }

}
?>