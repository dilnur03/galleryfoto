<?php
session_start();
include "../koneksi.php";

// Check if UserID is set
if (!isset($_GET['UserID'])) {
    header("Location: datauser.php");
    exit();
}

$userID = $_GET['UserID'];

// Delete user from database
$sql = "DELETE FROM user WHERE UserID = $userID";

if (mysqli_query($conn, $sql)) {
    // Redirect to datauser.php after successful deletion
    header("Location: datauser.php?success=true");
    exit();
} else {
    echo "Error deleting user: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
