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
<title>View Public Health Recommendation - <?php echo $publicHealthrec['recommendation']; ?></title>



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
                    <h1 class="h3 mb-0 text-gray-800"><?php echo $publicHealthrec['recommendation'] ?>'s Full Profile</h1>
                </div>

                <div class="card flex-row flex-wrap">
                    <div class="card-header border-0">
                        <img src="//placehold.it/200" alt="">
                    </div>
                    <div class="card-block px-2">


                        <h4 class="card-title" style="text-decoration:underline;">Public Health Recommendation Information</h4>
                        <p class="card-text"><strong>Public Health Recommendation ID:</strong> <?php echo ($publicHealthrec['recommendationID']); ?></p>
                        <p class="card-text"><strong>Recommendation:</strong> <?php echo ($publicHealthrec['recommendation']); ?></p>
                        <p class="card-text"><strong>Alert Level:</strong> <?php echo ($publicHealthrec['alertLevel']); ?></p>
                        <button type="button" onclick="window.location.href='edit_publichealthrecommendation.php?fid=<?php echo $publicHealthrec['recommendationID']; ?>'" class="btn btn-secondary">Edit Public Health Recommendation</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePublicHealthRecModal" data-id="<?php echo $publicHealthrec['recommendationID']; ?>" data-name="<?php echo $publicHealthrec['recommendation']; ?>">Delete</button>
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
<!-- Delete Public health rec Modal-->
<div class="modal fade" id="deletePublicHealthRecModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button type="button" onclick="delete_public_health_rec()" id="reject_ft" name="reject_ft" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Delete Public Health Recommendation</button>
            </div>
        </div>
    </div>
</div>

<?php include('../nav/footer.php'); ?>
<script>

    $('#deletePublicHealthRecModal').on('shown.bs.modal', function(event) {


        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('name') // Extract patient name
        var id = button.data('id') // Extract patient ID

        $('#delete_txt').html("You are about to delete <strong>" + name + "</strong> from the public health recommendations.");
        $('#tmp').val(id);
    });

    function delete_public_health_rec() {

        var id = $('#tmp').val();

        $.ajax({
            type: "POST",
            url: "../Model/publichealthrecommendation_processor.php?action=delete",
            data: {
                action: "delete",
                id: id
            }
        }).done(function(msg) {
            window.location.href = "../PublicHealthRecommendation/view_publichealthrecommendations.php";
        });
    }
</script>
</body>

</html>