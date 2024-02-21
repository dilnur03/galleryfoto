<?php
session_start();
include "../koneksi.php";
function generateUserID() {
    // Misal, menggunakan timestamp sebagai nilai otomatis
    return time();
}

   
// Function to retrieve all payment data
function ambilSemuaAlbum() {
    global $conn;

    $query = "SELECT * FROM album";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    return $data;
}

// Dapatkan nilai "UserID" dari session
$userID = $_SESSION['UserID'];

$datasalbum = ambilSemuaAlbum();


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $judulFoto = $_POST["judulFoto"];
        $deskripsiFoto = $_POST["deskripsiFoto"];
        $TanggalUnggah = date("Y-m-d");
        $lokasiFile = "../img";
        $userID = $_POST["UserID"];
        $targetname = basename($_FILES["gambar"]["name"]);

        // Proses upload file
        $targetDirectory = "../img/"; // Folder untuk menyimpan file
        $targetFile = $targetDirectory . basename($_FILES["gambar"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Cek apakah $uploadOk bernilai 0 karena error
        if ($uploadOk == 0) {
            echo "Maaf, file tidak terunggah.";
        } else {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
                echo "<div style='color: green;'><strong>Data foto berhasil ditambahkan.</strong></div>";

                // Query SQL untuk menambahkan data foto ke dalam tabel
                $sql = "INSERT INTO foto (JudulFoto, DeskripsiFoto, TanggalUnggah, LokasiFile, UserID) 
                        VALUES ('$judulFoto', '$deskripsiFoto', '$TanggalUnggah', '$targetname', $userID)";

                if (mysqli_query($conn, $sql)) {
                    // Jika query berhasil dieksekusi, maka arahkan ke halaman datafoto.php
                    header("Location: datafoto.php");
                    exit(); // Pastikan untuk keluar dari skrip setelah pengalihan header
                } else {
                    echo "<div style='color: red;'><strong>Error: " . $sql . "<br>" . mysqli_error($conn) . "</strong></div>";
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        }

        mysqli_close($conn);
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tambah Foto</title>
    <style>
        /* Styling for the entire form */
.form-tambah-foto {
    max-width: 1000px;
    margin: 10px auto;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

/* Styling for form labels */
.form-tambah-foto label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

/* Styling for form inputs */
.form-tambah-foto input[type="text"],
.form-tambah-foto input[type="number"],
.form-tambah-foto textarea,
.form-tambah-foto input[type="date"],
.form-tambah-foto input[type="file"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

/* Styling for the submit button */
.form-tambah-foto input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.form-tambah-foto input[type="submit"]:hover {
    background-color: #45a049;
}

/* Optional: Add some additional styling for a cleaner look */
body {
    font-family: 'Nunito', sans-serif;
    background-color: #ececec;
}



    </style>

</head>

<body>
    <!-- Content Wrapper -->
   

            <form method="POST" action="buat.php" enctype="multipart/form-data" class="form-tambah-foto">
               

                <label for="judulFoto">Judul Foto:</label>
                <input type="text" name="judulFoto" required>

                <label for="deskripsiFoto">Deskripsi Foto:</label>
                <textarea name="deskripsiFoto"></textarea>

                <input type="hidden" name="UserID" value="<?= $_SESSION['UserID'] ?>" required readonly>

                <label class="form-label">Pilih Foto:</label>
                <input type="file" class="form-control" name="gambar" required onchange="previewImage(this);">

                <div id="imagePreview" style="display: none;">
                    <img id="preview" width="100" height="100" alt="Image Preview"/>
                </div>
                <input type="submit" value="Tambah Foto" style="background-color: blue; color: white;">

            </form>
            

          
       
        <script>
            function previewImage(input) {
                const preview = document.getElementById('preview');
                const imagePreview = document.getElementById('imagePreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                    imagePreview.style.display = 'block';
                } else {
                    preview.src = '';
                    imagePreview.style.display = 'none';
                }
            }
        </script>

    </body>

</html>
