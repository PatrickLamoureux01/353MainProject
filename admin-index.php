<?php
include_once('header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard - <?php echo $fname; ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin-index.php">
                <div class="sidebar-brand-icon">
                    <i class="fab fa-canadian-maple-leaf"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Welcome, <?php echo $fname; ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="admin-index.php">
                    <i class="fas fa-columns"></i>
                    <span>Admin Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                COVID-19 Tracking
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="Person/hcw_followup.php">
                    <i class="fab fa-wpforms"></i>
                    <span>Health Form</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- End of Sidebar -->

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

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $fullname; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $fname; ?>'s Admin Dashboard</h1>
                    </div>

                    

                    <div class="row" style="text-align:center;">
                        <!-- Content Row -->
                        <div class="col-md-4">
                            <i class="fas fa-users" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>PATIENTS</strong></p>
                            <br>
                            <br>
                            <p>Manage patient records</p>
                            <button type="button" class="btn btn-outline-primary btn-block" onclick="view_patients()">Access Patients</button>
                        </div>
                        <div class="col-md-4" style="border-left:1px solid rgba(0,0,0,.1);height:250px">
                            <i class="fas fa-user-nurse" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>HEALTH WORKERS</strong></p>
                            <br>
                            <br>
                            <p>Manage health workers</p>
                            <button type="button" class="btn btn-outline-primary btn-block" onclick="view_healthworkers()">Access Health Workers</button>
                        </div>
                        <div class="col-md-4" style="border-left:1px solid rgba(0,0,0,.1);height:250px">
                            <i class="fas fa-hospital" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>FACILITIES</strong></p>
                            <br>
                            <br>
                            <p>Manage facilities</p>
                            <button type="button" class="btn btn-outline-primary btn-block" onclick="view_facilities()">Access Facilities</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="text-align:center;">
                        <!-- Content Row -->
                        <div class="col-md-4">
                            <i class="fas fa-globe" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>REGIONS</strong></p>
                            <br>
                            <br>
                            <p>Manage regions</p>
                            <button type="button" class="btn btn-outline-primary btn-block" onclick="view_regions()">Access Regions</button>
                        </div>
                        <div class="col-md-4" style="border-left:1px solid rgba(0,0,0,.1);height:250px">
                            <i class="fas fa-border-none" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>GROUP ZONES</strong></p>
                            <br>
                            <br>
                            <p>Manage group zones</p>
                            <button type="button" class="btn btn-outline-primary btn-block" onclick="view_groupzones()">Access Group Zones</button>
                        </div>
                        <div class="col-md-4" style="border-left:1px solid rgba(0,0,0,.1);height:250px">
                            <i class="far fa-comments" style="font-size:52px;"></i>
                            <p></p>
                            <p><strong>HEALTH RECOMMENDATIONS</strong></p>
                            <br>
                            <br>
                            <p>Manage health recommendations</p>
                            <button type="button" class="btn btn-outline-primary btn-block" onclick="view_recommendations()">Access Health Recommendations</button>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Copyright -->
            <?php include('nav/copyright.php'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-primary" href="admin-login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php include('../nav/footer.php'); ?>

    <script>
        function view_patients() {
            window.location.href = "Person/view_patients_admin.php";
        }

        function view_healthworkers() {
            window.location.href = "HealthWorker/view_health_workers.php";
        }

        function view_facilities() {
            window.location.href = "Facility/view_facilities.php";
        }

        function view_regions() {
            window.location.href= "Region/view_regions.php";
        }
        function view_groupzones() {
            window.location.href = "GroupZone/view_groupzones.php";
        }
        function view_recommendations() {
            window.location.href = "PublicHealthRecommendation/view_publichealthrecommendations.php";
        }
    </script>

</body>

</html>