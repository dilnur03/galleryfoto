<?php
session_start();
include "../koneksi.php";

// Check if UserID is set
if (!isset($_GET['UserID'])) {
    header("Location: datauser.php");
    exit();
}

$userID = $_GET['UserID'];

// Delete user's photos/albums from the database
$sql_delete_photos = "DELETE FROM foto WHERE UserID = $userID";
$sql_delete_albums = "DELETE FROM album WHERE UserID = $userID";

// Execute the deletion queries
if (mysqli_query($conn, $sql_delete_photos) && mysqli_query($conn, $sql_delete_albums)) {
    // Proceed with deleting the user if the photos/albums deletion was successful
    $sql_delete_user = "DELETE FROM user WHERE UserID = $userID";

    if (mysqli_query($conn, $sql_delete_user)) {
        // Redirect to datauser.php after successful deletion
        header("Location: datauser.php?success=true");
        exit();
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    echo "Error deleting photos/albums: " . mysqli_error($conn);
}

mysqli_close($conn);

?>
