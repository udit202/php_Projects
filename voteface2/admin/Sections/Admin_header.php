<?php
// Start session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: Index.php");
    exit();
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: Index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <!-- <script src="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css"></script> -->
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="CSS/AdminDashboard.css">  
    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

<!-- JSZip for Excel Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- pdfmake for PDF Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Buttons Extensions -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <style>
        td>div>i{
            cursor: pointer;
        }
    </style>
</head>
<body>
   
    <div class="container-fluid pt-2">
        <div class="top_menu">
            <div class="logo">
                <img src="images/logo.png" alt="" class="mx-2" style="width: 50PX" />
            </div>

            <div class="top_menu_list">
                <ul class="my-2 mx-3 menu_bars">

                    <li class="ms-3">
                        <i class="bi bi-list menu_open_btn"></i>
                    </li>

                </ul>
            </div>
        </div>

        <div class="dash_layout">
            <div class="sidemenu">
                <div class="mt-2 sideblock">
                    <div class="mt-2 text-center">
                        <div class="text-end w-100 menu_close_btn">
                            <i class="bi bi-x-lg close_me"></i>
                        </div>
                        <!-- <img src="images/logo.png" alt="" class="mx-2" style="width: 140PX;border-radius:25px;" /> -->
                         Voting
                    </div>
                    <h6 class="text-center text-white">Admin</h6>
                    <!-- Display the Admin's Name -->
                    <h6 class="text-center text-white"><?php echo $_SESSION['admin_name']; ?></h6>
                    <ul class="mt-4">
                        <hr style="color:white;" />
                        <li class="drop_btn">
                            <a href="Dashboard.php"><span><i class="bi bi-calendar2-plus-fill px-2"></i>Dashboard</span><span></span></a>
                        </li>
                        <hr style="color:white;" />
                        <li class="drop_btn">
                            <a href="Teams.php"><span><i class="bi bi-calendar2-plus-fill px-2"></i>Teams</span><span></span></a>
                        </li>
                        <hr style="color:white;" />
                        <li class="drop_btn">
                            <a href="voters.php"><span><i class="bi bi-calendar2-plus-fill px-2"></i> Voters</span><span></span></a>
                        </li>
                        <hr style="color:white;" />
                        <li class="drop_btn">
                            <a href="?logout=true" class="btn btn-danger "><span><i class="bi bi-box-arrow-right px-2"></i>Log-Out</span><span></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="containt_div">
                <div class="main">
                    <div class="pages">
                        <div class="px-3" >
                            <!-- Your dashboard content here -->
                        
