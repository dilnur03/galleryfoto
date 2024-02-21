<?php
session_start();
include "../../koneksi.php";

// Dapatkan nilai "UserID" dari session
$userID = $_SESSION['UserID'];



// Cek apakah parameter AlbumID diterima dari permintaan GET
if(isset($_GET['AlbumID'])) {
    $albumID = $_GET['AlbumID'];

    // Query untuk mengambil detail album dari database
    $sql = "SELECT * FROM album WHERE AlbumID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $albumID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Periksa apakah album ditemukan
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $namaAlbum = $row['NamaAlbum'];
        $deskripsi = $row['Deskripsi'];
    } else {
        echo "Album tidak ditemukan.";
        exit();
    }
} else {
    echo "Parameter AlbumID tidak diterima.";
    exit();
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $NamaAlbum = $_POST['NamaAlbum'];
    $Deskripsi = $_POST['Deskripsi'];

    // Query untuk mengupdate detail album di database
    
    $sql = "UPDATE album SET NamaAlbum = '$NamaAlbum', Deskripsi = '$Deskripsi' WHERE AlbumID = $albumID";

    // Eksekusi query
    $result = mysqli_query($conn, $sql);

    // Periksa apakah eksekusi query berhasil
    if ($result) {
        echo "Album berhasil diperbarui.";
        // Redirect ke halaman album setelah berhasil diperbarui
        header("Location: album.php");
        exit(); // Pastikan untuk keluar dari script setelah melakukan redirect
    } else {
        echo "Gagal memperbarui album: " . mysqli_error($conn);
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 96%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Album</h2>
        <form action="" method="post">
            <!-- Tambahkan input tersembunyi untuk menyimpan AlbumID -->
            <input type="hidden" name="AlbumID" value="<?php echo $albumID; ?>">
            <div>
                <label for="namaAlbum">Album:</label>
                <input type="text" id="namaAlbum" name="NamaAlbum" value="<?php echo $namaAlbum; ?>">
            </div>
            <div>
                <label for="deskripsi">Deskripsi:</label>
                <textarea id="deskripsi" name="Deskripsi"><?php echo $deskripsi; ?></textarea>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
