<?php
session_start();
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to delete photo data
    $query = "DELETE FROM foto WHERE FotoID = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        // Data deleted successfully
        header("Location: datafoto.php"); // Redirect back to the main page
        exit;
    } else {
        // Error in deleting data
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
