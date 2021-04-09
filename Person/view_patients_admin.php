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

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View All Patients</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Data Tables -->
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('../nav/admin_sidebar.php'); ?>

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

                    <div class="col pr-4 pt-4 text-right">
                        <a id="editbutton" class="m-0 pt-4 font-weight-bold text-primary" href="create_patient_admin.php"><i class="fa fa-plus"></i> Create New Patient</a>
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
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (sizeof($patients) == 0) {
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
                                                        echo ('</td><td class="clickable" data-href="edit_patient.php?pid=');
                                                        echo $patient['medicareNum'];
                                                        echo ('"><button type="button" class="btn btn-secondary">Edit</button>');
                                                        echo ('</td><td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePatientModal" data-id="');
                                                        echo $patient['medicareNum'];
                                                        echo ('" data-name="');
                                                        echo ($patient['firstName'] . " " . $patient['lastName']);
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

    <!-- Data Tables -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#patientTable').DataTable();

            $(".clickable").click(function(e) {
                window.location = $(this).data("href");
            });

        });

        $('#deletePatientModal').on('shown.bs.modal', function(event) {


            var button = $(event.relatedTarget) // Button that triggered the modal
            var name = button.data('name') // Extract patient name
            var id = button.data('id') // Extract patient ID

            $('#delete_txt').html("You are about to delete <strong>" + name + "</strong> from the patient records.");
            $('#tmp').val(id);
        });

        function delete_patient() {

            var id = $('#tmp').val();

            $.ajax({
                type: "POST",
                url: "../Model/patient_processor.php?action=delete",
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