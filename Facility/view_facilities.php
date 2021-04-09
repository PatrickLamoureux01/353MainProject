<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$facilities = get_all_health_centers($link);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>View All Health Facilities</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Health Facilities Overview</h1>
                    </div>

                    <div class="col pr-4 pt-4 text-right">
                        <a id="editbutton" class="m-0 pt-4 font-weight-bold text-primary" href="create_facility.php"><i class="fa fa-plus"></i> Create New Health Facility</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 mb-4">
                            <!-- DataTales Example -->
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">All Health Facilities</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm" id="facilitiesTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Phone Number</th>
                                                    <th>Type</th>
                                                    <th>Address</th>
                                                    <th>Website</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (sizeof($facilities) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no health workers to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($facilities as $facility) {
                                                        echo ('<tr><td class="clickable" data-href="view_facility.php?fid=');
                                                        echo $facility['facilityId'];
                                                        echo ('">');
                                                        echo ($facility['name']);
                                                        echo ('</td><td class="clickable" data-href="view_facility.php?fid=');
                                                        echo $facility['facilityId'];
                                                        echo ('">');
                                                        echo ($facility['phoneNum']);
                                                        echo ('</td><td class="clickable" data-href="view_facility.php?fid=');
                                                        echo $facility['facilityId'];
                                                        echo ('">');
                                                        echo ($facility['type']);
                                                        echo ('</td><td class="clickable" data-href="view_facility.php?fid=');
                                                        echo $facility['facilityId'];
                                                        echo ('">');
                                                        echo ($facility['address']);
                                                        echo ('</td><td class="clickable" data-href="view_facility.php?fid=');
                                                        echo $facility['facilityId'];
                                                        echo ('">');
                                                        echo ($facility['website']);
                                                        echo ('</td><td class="clickable" data-href="edit_facility.php?fid=');
                                                        echo $facility['facilityId'];
                                                        echo ('"><button type="button" class="btn btn-secondary">Edit</button>');
                                                        echo ('</td><td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteFacilityModal" data-id="');
                                                        echo $facility['facilityId'];
                                                        echo ('" data-name="');
                                                        echo ($facility['name']);
                                                        echo ('">Delete</button>');
                                                        echo ('</td></tr>');
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

    <!-- Delete Patient Modal-->
    <div class="modal fade" id="deleteFacilityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to continue?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="delete_txt"></p>
                    <p id="tmp"></p>
                    <button type="button" onclick="delete_facility()" id="reject_ft" name="reject_ft" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Delete Facility</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('../nav/footer.php'); ?>

    <script>
        $(document).ready(function() {
            $('#facilitiesTable').DataTable();

            $(".clickable").click(function(e) {
                window.location = $(this).data("href");
            });

        });

        $('#deleteFacilityModal').on('shown.bs.modal', function(event) {


            var button = $(event.relatedTarget) // Button that triggered the modal
            var name = button.data('name') // Extract patient name
            var id = button.data('id') // Extract patient ID

            $('#delete_txt').html("You are about to delete <strong>" + name + "</strong> from the health facilities records.");
            $('#tmp').val(id);
        });

        function delete_facility() {

            var id = $('#tmp').val();

            $.ajax({
                type: "POST",
                url: "../Model/facility_processor.php?action=delete",
                data: {
                    action: "delete",
                    id: id
                }
            }).done(function(msg) {
                parent.window.location.reload();
            });
        }
    </script>

</body>

</html>