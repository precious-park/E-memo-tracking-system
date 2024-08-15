<?php
include('includes/dbh.php');
session_start();
$sql = "SELECT dept_id, dept_name FROM departments";
$result = $conn->query($sql); 
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../plugins/datatables/jquery.dataTables.min.js"> 
    <title>Ministry of ICT & National Guidance E-Memo Tracking System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        include('includes/header.php');
        ?>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar  elevation-4 .custom-switch-on-" style="background-color: #004472;">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="images/coa.jpg" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">EMTS</span>

            </a>
            <div class="brand-link">
                <span class="brand-text font-weight-light">MINISTRY OF ICT & <br>
                    NATIONAL GUIDANCE</span>
            </div>


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item menu-open">
                            <a href="view.php" class="nav-link active">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    View Memo
                                </p>
                            </a>

                        </li>
                        <li class="nav-item menu-open">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Register Memo
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="income.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Incoming</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="outgoing.php" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Outgoing</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="memos.php" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Send Memo
                                </p>
                            </a>

                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>