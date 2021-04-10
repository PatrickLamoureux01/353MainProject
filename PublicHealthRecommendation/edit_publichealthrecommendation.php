<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$recommendationID = $_GET["fid"];

$f = get_public_health_rec_by_id($recommendationID,$link);
$publicHealthrec = mysqli_fetch_array($f);


?>

<!DOCTYPE html>
<html lang="en">


<?php include('../nav/htmlheader.php'); ?>
<title>Edit Public Health Recommendation - <?php echo $publicHealthrec['recommendation']; ?></title>


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
                        <h1 class="h3 mb-0 text-gray-800">Edit Public Health Recommendation</h1>
                    </div>

                    <form action="../Model/publichealthrecommendation_processor.php?action=edit" method="post">
                        <div class="form-group">
                            <label for="id" class="my-1 mr-2">Public Health Recommendation ID </label>
                            <input type="text" class="form-control" id="recommendationID" name="recommendationID" value="<?php echo $publicHealthrec['recommendationID']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name" class="my-1 mr-2">Recommendation </label>
                            <input type="text" class="form-control" id="recommendation" name="recommendation" value="<?php echo $publicHealthrec['recommendation']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="type" class="my-1 mr-2">Alert Level (1 to 4)</label><br>
                            <select class="selectpicker" id="alertLevel" name="alertLevel">
                                <?php
                                if ($publicHealthrec['alertLevel'] == 1) {
                                    ?>
                                    <option value=1 selected>1</option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=1>1</option>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($publicHealthrec['alertLevel'] == 2) {
                                    ?>
                                    <option value=2 selected>2</option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=2>2</option>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($publicHealthrec['alertLevel'] == 3) {
                                    ?>
                                    <option value=3 selected>3</option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=3>3</option>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($publicHealthrec['alertLevel'] == 4) {
                                    ?>
                                    <option value=4 selected>4</option>
                                    <?php
                                } else {
                                    ?>
                                    <option value=4>4</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-outline-primary">Update Public Health Recommendation</button>

                    </form>

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

</body>

</html>