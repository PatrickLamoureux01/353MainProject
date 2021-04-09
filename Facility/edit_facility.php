<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$facilityID = $_GET["fid"];

$f = get_facility_by_id($facilityID, $link);
$facility = mysqli_fetch_array($f);

$drivethru = doesDriveThru($facilityID, $link);

?>

<!DOCTYPE html>
<html lang="en">


<?php include('../nav/htmlheader.php'); ?>
<title>Edit Health Facility - <?php echo $facility['name']; ?></title>


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
                        <h1 class="h3 mb-0 text-gray-800">Edit Health Facility</h1>
                    </div>

                    <form action="../Model/facility_processor.php?action=edit" method="post">
                        <div class="form-group">
                            <label for="facilityID" class="my-1 mr-2">Facility ID </label>
                            <input type="text" class="form-control" id="facilityID" name="facilityID" value="<?php echo $facility['facilityId']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name" class="my-1 mr-2">Institution Name </label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $facility['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telNum" class="my-1 mr-2">Phone Number</label>
                            <input type="text" class="form-control" id="telNum" name="telNum" value="<?php echo $facility['phoneNum']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="type" class="my-1 mr-2">Type of Institution</label><br>
                            <select class="selectpicker" id="type" name="type">
                            <?php
                            if ($facility['type'] == "Hospital") {
                                ?>
                                <option value="Hospital" selected>Hospital</option>
                                <?php
                            } else {
                                ?>
                                <option value="Hospital">Hospital</option>
                                <?php
                            }
                            ?>
                            <?php
                            if ($facility['type'] == "Clinic") {
                                ?>
                                <option value="Clinic" selected>Clinic</option>
                                <?php
                            } else {
                                ?>
                                <option value="Clinic">Clinic</option>
                                <?php
                            }
                            ?>
                            <?php
                            if ($facility['type'] == "Special Installation") {
                                ?>
                                <option value="Special Installation" selected>Special Installation</option>
                                <?php
                            } else {
                                ?>
                                <option value="Special Installation">Special Installation</option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address" class="my-1 mr-2">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $facility['address']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="website" class="my-1 mr-2">Website</label>
                            <input type="text" class="form-control" id="website" name="website" value="<?php echo $facility['website']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="adminType" class="my-1 mr-2">Administration Type </label><br>
                            <select class="selectpicker" id="adminType" name="adminType">
                            <?php
                            if ($facility['adminType'] == "1") {
                                ?>
                                <option value="1" selected>Appointment Only</option>
                                <?php
                            } else {
                                ?>
                                <option value="1">Appointment Only</option>
                                <?php
                            }
                            ?>
                            <?php
                            if ($facility['adminType'] == "2") {
                                ?>
                                <option value="2" selected>Walk-In Only</option>
                                <?php
                            } else {
                                ?>
                                <option value="2">Walk-in Only</option>
                                <?php
                            }
                            ?>
                            <?php
                            if ($facility['adminType'] == "3") {
                                ?>
                                <option value="3" selected>Appointment & Walk-In</option>
                                <?php
                            } else {
                                ?>
                                <option value="3">Appointment & Walk-In</option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-check">
                            <?php
                            if ($drivethru == "0") {
                            ?>
                                <input class="form-check-input" type="checkbox" name="drivethru" id="drivethru">
                            <?php
                            } else {
                            ?>
                                <input class="form-check-input" type="checkbox" name="drivethru" id="drivethru" checked>
                            <?php
                            }
                            ?>
                            <label class="form-check-label" for="drivethru">Drive-Thru Capable?</label>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Update Health Institution</button>

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