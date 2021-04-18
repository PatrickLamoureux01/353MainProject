<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$patients = get_all_patients($link);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>View All Patients</title>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('../nav/hcw_sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('../nav/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Patients Overview</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 mb-4">
                            <!-- DataTales Example -->
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">All Patients</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm" id="patientTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Medicare Number</th>
                                                    <th>DOB</th>
                                                    <th>E-mail</th>
                                                    <th>Address</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (mysqli_num_rows($patients) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no patients to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($patients as $patient) {
                                                        echo ('<tr><td class="clickable" data-href="view_patient.php?pid=');
                                                        echo $patient['medicareNum'];
                                                        echo ('">');
                                                        echo ($patient['firstName']);
                                                        echo ('</td><td class="clickable" data-href="view_patient.php?pid=');
                                                        echo $patient['medicareNum'];
                                                        echo ('">');
                                                        echo ($patient['lastName']);
                                                        echo ('</td><td class="clickable" data-href="view_patient.php?pid=');
                                                        echo $patient['medicareNum'];
                                                        echo ('">');
                                                        echo ($patient['medicareNum']);
                                                        echo ('</td><td class="clickable" data-href="view_patient.php?pid=');
                                                        echo $patient['medicareNum'];
                                                        echo ('">');
                                                        echo ($patient['dob']);
                                                        echo ('</td><td class="clickable" data-href="view_patient.php?pid=');
                                                        echo $patient['medicareNum'];
                                                        echo ('">');
                                                        echo ($patient['email']);
                                                        echo ('</td><td class="clickable" data-href="view_patient.php?pid=');
                                                        echo $patient['medicareNum'];
                                                        echo ('">');
                                                        echo ($patient['address']);
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
            <?php include('../nav/copyright.php'); ?>

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
    <div class="modal fade" id="deletePatientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button type="button" onclick="delete_patient()" id="reject_ft" name="reject_ft" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Delete Patient</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('../nav/footer.php'); ?>

    <script>
        $(document).ready(function() {
            var table = $('#patientTable').DataTable();

            $('#patientTable tbody').on('click','tr', function(){
                var data = table.row(this).data();
                window.location.href="view_patient.php?pid=" + data[2];
            });




            $('#patientTable').DataTable();

            //$('#patientTable').addClass("clickable");

            $(".clickable").click(function(e) {
                window.location = $(this).data("href");
            });

        });
    </script>

</body>

</html>