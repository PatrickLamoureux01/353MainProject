<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$regions = get_all_regions($link);
$cities = get_all_cities($link);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>View All Regions</title>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../admin-index.php">
                <div class="sidebar-brand-icon">
                    <i class="fab fa-canadian-maple-leaf"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Welcome, <?php echo $fname; ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../admin-index.php">
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
                <a class="nav-link" href="#">
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
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
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
                        <h1 class="h3 mb-0 text-gray-800">Regions Overview</h1>
                    </div>

                    <div class="col pr-4 pt-4 text-right">
                        <a id="editbutton" class="m-0 pt-4 font-weight-bold text-primary" href="create_region.php"><i class="fa fa-plus"></i> Create New Region</a>
                        <a id="editbutton" class="m-0 pt-4 font-weight-bold text-primary" href="create_city.php"><i class="fa fa-plus"></i> Create New City</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 mb-4">
                            <!-- Regions -->
                            <div class="card shadow">
                                <div class="card-header py-3" data-toggle="collapse" data-target="#regionCollapse">
                                    <h6 class="m-0 font-weight-bold text-primary">All Regions</h6>
                                </div>
                                <div class="card-body collapse" id="regionCollapse">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm" id="regionsTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Region ID</th>
                                                    <th>Name</th>
                                                    <th>Alert Level</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (mysqli_num_rows($regions) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no regions to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($regions as $region) {
                                                        echo ('<tr>');
                                                        echo ('<td>');
                                                        echo ($region['regionID']);
                                                        echo ('</td>');
                                                        echo ('<td>');
                                                        echo ($region['name']);
                                                        echo ('</td>');
                                                        echo ('<td>');
                                                        echo ($region['alertLevel']);
                                                        echo ('</td>');
                                                        echo ('</tr>');
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Cities -->
                            <div class="card shadow">
                                <div class="card-header py-3" data-toggle="collapse" data-target="#citiesCollapse">
                                    <h6 class="m-0 font-weight-bold text-primary">All Cities</h6>
                                </div>
                                <div class="card-body collapse" id="citiesCollapse">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm" id="citiesTable" width="100%" cellspacing="0" data-page-list="[10, 20, 25, 50, 100, 200, All]">
                                            <thead>
                                                <tr>
                                                    <th>City ID</th>
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (mysqli_num_rows($cities) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no cities to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($cities as $city) {
                                                        echo ('<tr>');
                                                        echo ('<td>');
                                                        echo ($city['cityID']);
                                                        echo ('</td>');
                                                        echo ('<td>');
                                                        echo ($city['name']);
                                                        echo ('</td>');
                                                        echo ('</tr>');
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include('../nav/logout.php'); ?>


    <?php include('../nav/footer.php'); ?>

    <script>
        $(document).ready(function() {
            
            var rTable = $('#regionsTable').DataTable();
            

            var cTable = $('#citiesTable').DataTable();

            $('#regionsTable tbody').on('click', 'tr', function() {
                
                var dataR = rTable.row(this).data();
                window.location.href = "view_region.php?rid=" + dataR[0];
            });

            $('#citiesTable tbody').on('click', 'tr', function() {
                
                var dataC = cTable.row(this).data();
                window.location.href = "view_city.php?cid=" + dataC[0];
            });
        });
    </script>

</body>

</html>