<?php
session_start();
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["report_id"])) {
    // Sanitize the input to prevent SQL injection
    $reportId = mysqli_real_escape_string($conn, $_POST["report_id"]);

    // Perform delete operation
    $sql = "DELETE FROM report WHERE report_id = '$reportId'";
    if (mysqli_query($conn, $sql)) {
        // Report deleted successfully
        echo "Report deleted successfully";
        // You can echo any response message you want to handle in the JavaScript success callback
    } else {
        // Error occurred while deleting the report
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // You can echo any error message you want to handle in the JavaScript error callback
    }
} else {
    // Invalid request
    echo "Invalid request";
}
?>
