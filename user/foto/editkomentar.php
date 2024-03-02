<?php
session_start();
include "../../koneksi.php";

// Pastikan user telah login
if (!isset($_SESSION['UserID'])) {
    header("Location: ../../login.php");
    exit();
}

// Dapatkan nilai "UserID" dari session
$userID = $_SESSION['UserID'];

// Cek apakah parameter CommentID diterima dari permintaan GET
if(isset($_GET['CommentID'])) {
    $commentID = $_GET['CommentID'];

    // Query untuk mengambil detail komentar dari database
    $sql = "SELECT * FROM komentarfoto WHERE KomentarID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $commentID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Periksa apakah komentar ditemukan
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $isiKomentar = $row['IsiKomentar'];
    } else {
        echo "Komentar tidak ditemukan.";
        exit();
    }
} else {
    echo "Parameter CommentID tidak diterima.";
    exit();
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newComment = $_POST['new_comment'];

    // Query untuk mengupdate komentar di database
    $sql = "UPDATE komentarfoto SET IsiKomentar = ? WHERE KomentarID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $newComment, $commentID);
    $result = mysqli_stmt_execute($stmt);

    // Periksa apakah eksekusi query berhasil
    if ($result) {
        echo "Komentar berhasil diperbarui.";
        // Redirect ke halaman yang sesuai setelah berhasil diperbarui
        // Misalnya, Anda bisa mengarahkan pengguna ke halaman foto tertentu atau halaman lainnya
        // header("Location: halaman_tertentu.php");
        exit(); // Pastikan untuk keluar dari script setelah melakukan redirect
    } else {
        echo "Gagal memperbarui komentar: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Komentar</title>
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
        <h2>Edit Komentar</h2>
        <form action="" method="post">
            <textarea name="new_comment" rows="4" cols="50"><?php echo $isiKomentar; ?></textarea>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
