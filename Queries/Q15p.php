<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$facility = $_POST["facility"];
$facility_id = get_facility_id_by_name($facility,$link);

$workers = get_all_workers_of_facility($facility_id,$link);


?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>Q15</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Q15</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12 mb-4">
                            <!-- DataTales Example -->
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Query Result</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm" id="q15Table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Medicare Num</th>
                                                    <th>DOB</th>
                                                    <th>Tel</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (mysqli_num_rows($workers) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no results to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($workers as $w) {
                                                        $fname = get_Fname($link,$w['workerId']);
                                                        $lname = get_Lname($link,$w['workerId']);
                                                        $dob = get_dob($link,$w['workerId']);
                                                        $tel = get_tel($link,$w['workerId']);
                                                        $email = get_email($w['workerId'],$link);

                                                        echo ('<tr>');
                                                        echo ('<td>');
                                                        echo ($fname);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($lname);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($w['workerId']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($dob);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($tel);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($email);
                                                        echo  ('</td>');
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


    <?php include('../nav/footer.php'); ?>


    <script>
        $(document).ready(function() {

            var table = $('#q15Table').DataTable();

        });
    </script>

</body>

</html>