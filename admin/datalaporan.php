<?php
session_start();
include "../koneksi.php";

// Fetching data from the 'report' table
$sql = "SELECT report.report_id, report.type, report.FotoID, user.username, report.reason, report.reportedat 
        FROM report 
        INNER JOIN user ON report.UserID = user.UserID
        ORDER BY report.reportedat DESC";
$result = mysqli_query($conn, $sql);

// Fetching all the reports
$allReports = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <!-- Custom fonts for this template-->
    <style>
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fc;
        }
        .container {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        .btn {
            cursor: pointer;
        }
        .scroll-to-top {
            position: fixed;
            right: 20px;
            bottom: 20px;
            display: none;
            width: 40px;
            height: 40px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            z-index: 999;
        }
        .scroll-to-top:hover {
            background-color: #0056b3;
        }
    </style>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- Gallery Title -->
                <h2 class="gallery-title text-primary">Gallery Foto</h2>
                <!-- Navigation Links -->
                <ul style='display:flex;gap:1em;list-style:none;align-items:center;top:5px;position:relative'>
                    <li class="nav-item">
                        <a href='admin.php'>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href='datafoto.php'>Foto</a>
                    </li>
                    <li class="nav-item">
                        <a href='album.php'>Album</a>
                    </li>
                </ul>
                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST">
                    <div class="input-group" style='position:relative;left:12em'>
                        <input type="text" name="search_query" class="form-control bg-light border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="search_submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username']  ?></span>
                            <img class="img-profile rounded-circle"
                                src="../img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="datauser.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Data User
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
           
            <!-- Button to go back -->
            <div class="container">
                <!-- Report data table -->
                <table class="table mt-4">
        <thead>
            <tr>
                <th>Report ID</th>
                <th>Type</th>
                <th>User ID</th>
                <th>Foto ID</th> <!-- Add this line for Foto ID -->
                <th>Reason</th>
                <th>Reported At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allReports as $report) : ?>
                <tr>
                    <td><?= $report['report_id']; ?></td>
                    <td><?= $report['type']; ?></td>
                    <td><?= $report['username']; ?></td>
                    <td><?= $report['FotoID']; ?></td> <!-- Display Foto ID -->
                    <td><?= $report['reason']; ?></td>
                    <td><?= $report['reportedat']; ?></td>
                    <td>
                        <a href="detail.php?id=<?= $report['FotoID']; ?>" class="btn btn-info">View</a>
                        <button class="btn btn-danger" onclick="deleteReport(<?= $report['report_id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

            </div>
           

            <!-- Additional content -->
            <div class="container-fluid">
                <!-- Additional content here -->
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../dashboard/guset.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        <!-- Add this script block at the end of your HTML body -->
    function deleteReport(reportId) {
        if (confirm("Are you sure you want to delete this report?")) {
            $.ajax({
                type: "POST",
                url: "delete_report.php", // Specify the URL of the PHP script that handles the deletion
                data: { report_id: reportId },
                success: function(response) {
                    // Reload the page after successful deletion
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert("An error occurred while deleting the report.");
                    console.error(xhr.responseText);
                }
            });
        }
    }
</script>

</body>
</html>
