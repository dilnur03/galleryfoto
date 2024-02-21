<?php
session_start();
include "../koneksi.php";

// Cek apakah parameter FotoID diterima dari permintaan GET
if(isset($_GET['FotoID'])) {
    $fotoID = $_GET['FotoID'];

    // Query untuk mengambil detail foto dari database
    $sql = "SELECT * FROM foto WHERE FotoID = $fotoID";
    $stmt = mysqli_query($conn, $sql);

    // Periksa apakah query berhasil dieksekusi
    if ($stmt) {
        $row = mysqli_fetch_assoc($stmt);
        // Inisialisasi variabel fotoSebelumnya dengan foto yang saat ini ada dalam database
        $fotoSebelumnya = $row["LokasiFile"];

    } else {
        // Handle jika query gagal
        echo "Query gagal dieksekusi: " . mysqli_error($conn);
        exit; // Menghentikan eksekusi skrip
    }
} else {
    // Handle jika parameter FotoID tidak diterima
    echo"<script>console.log</script>";
}


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
    // Ambil nilai-nilai dari formulir
    $judulFoto = $_POST['judulFoto'];
    $deskripsiFoto = $_POST['deskripsiFoto'];
    $albumID = $_POST['albumID'];
    $userID = $_POST['UserID'];

    // Ambil nama file foto yang diupload, atau tetapkan foto sebelumnya jika tidak ada yang diunggah
    $fileName = isset($_FILES['gambar']['name']) && !empty($_FILES['gambar']['name']) ? $_FILES['gambar']['name'] : $fotoSebelumnya; // $fotoSebelumnya adalah variabel yang menyimpan nama file foto sebelumnya
    // Lokasi sementara file yang diupload
    $fileTemp = isset($_FILES['gambar']['tmp_name']) ? $_FILES['gambar']['tmp_name'] : '';
    // Tentukan lokasi penyimpanan file yang diupload
    $fileDestination = "../img/" . $fileName;

    // Pindahkan file yang diupload ke lokasi penyimpanan jika ada file yang diunggah
    if (!empty($fileTemp)) {
        move_uploaded_file($fileTemp, $fileDestination);
    }

    // Query SQL untuk melakukan update data foto ke dalam tabel 'foto'
    $sql = "UPDATE foto SET JudulFoto='$judulFoto', DeskripsiFoto='$deskripsiFoto', AlbumID=$albumID, LokasiFile='$fileName' WHERE FotoID = $fotoID";

    if (mysqli_query($conn, $sql)) {
        // Jika query berhasil dieksekusi, redirect ke halaman yang sesuai
        header("Location: datafoto.php");
        exit;
    } else {
        // Jika terjadi kesalahan saat eksekusi query
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
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

    <title>Edit foto</title>
    <style>
        /* Styling for the entire form */
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
img{
    max-width: 100px;
    min-width: 100px;
    min-height: 100px;
}



    </style>

</head>

<body>
    <!-- Content Wrapper -->
   

            <form method="POST" action="" enctype="multipart/form-data" class="form-tambah-foto">
               

                <label for="judulFoto">Judul Foto:</label>
                <input type="text" name="judulFoto" value="<?php  echo $row["JudulFoto"]; ?>">

                <label for="deskripsiFoto">Deskripsi Foto:</label>
                <textarea name="deskripsiFoto"><?php echo $row["DeskripsiFoto"]; ?></textarea>

             



                <div class="form-group">
                    <label for="AlbumID">Album:</label>
                    <select class="form-control" name="albumID">
                    <?php 
                        foreach($datasalbum as $data):
                    ?>
                        <option value='<?= $data['AlbumID'] ?>'>
                            <?= $data['NamaAlbum']; ?> 
                        </option>
                    <?php endforeach ?>
                    </select>
                </div>

                
                <input type="hidden" name="UserID" value="<?= $_SESSION['UserID'] ?>" readonly>
                <img id="preview" src="../img/<?php echo $fotoSebelumnya; ?>" width="100" height="100" alt="Preview Image">
                <label class="form-label">Pilih Foto:</label>
                <input type="file" class="form-control" name="gambar" onchange="previewImage(event);">

                 

                <input type="submit" value="Edit Foto" style="background-color: blue; color: white;">
            </form>


            <script>
        // Fungsi untuk menampilkan pratinjau gambar saat memilih gambar baru
        function previewImage(event) {
            const input = event.target;
            const reader = new FileReader();
            
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            
            // Jika ada file yang dipilih, baca file tersebut sebagai URL data
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
                

            </script>
</body>
</html>
