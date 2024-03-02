<?php
session_start();

// Sambungan database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set FotoID in session if it's available
if (isset($_GET["id"])) {
    $_SESSION["FotoID"] = $_GET["id"];
}

// Proses laporan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reason = $_POST["reason"];
    $userID = $_SESSION["UserID"]; // Menggunakan ID pengguna dari sesi
    $fotoID = $_SESSION["FotoID"]; // Menggunakan FotoID dari sesi

    $sql = "INSERT INTO report (type, UserID, reason, FotoID) VALUES ('komentar', '$userID', '$reason', '$fotoID')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Laporan berhasil dikirim";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup sambungan database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Laporan</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
        form {
            max-width: 300px; 
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
        select, input[type="submit"] {
            width: calc(100% - 22px); /* Mengurangi lebar select agar sesuai */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M6 9l6 6 6-6"></path></svg>');
            background-size: 25px 25px; /* Ganti dengan ukuran yang diinginkan */

            background-repeat: no-repeat;
            background-position-x: calc(100% - 5px);
            background-position-y: 50%;
            padding-right: 30px;
        }
        
    </style>
</head>
<body>
    <h2>Laporkan Komentar</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="reason">Alasan:</label><br>
        <select id="reason" name="reason" required>
            <option value="">Pilih Alasan</option>
            <option value="Spam atau penipuan">Spam atau penipuan</option>
            <option value="Mengandung kebencian atau pelecehan">Mengandung kebencian atau pelecehan</option>
            <option value="Melanggar hak cipta">Melanggar hak cipta</option>
            <option value="Informasi palsu atau menyesatkan">Informasi palsu atau menyesatkan</option>
            <option value="Ancaman atau intimidasi">Ancaman atau intimidasi</option>
            <option value="Melanggar kebijakan situs">Melanggar kebijakan situs</option>
            <option value="Merusak atau mengganggu">Merusak atau mengganggu</option>
        </select><br><br>
        <input type="submit" value="Laporkan">
    </form>
</body>
</html>
