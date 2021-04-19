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
<title>Q12</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Q12</h1>
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
                                        <table class="table table-hover table-sm" id="q12Table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th># Health Workers</th>
                                                    <th>Admin Type</th>
                                                    <th>Drive-Thru Capable</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (mysqli_num_rows($facilities) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no results to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($facilities as $f) {
                                                        $num_emps = get_number_of_emps($f['facilityId'],$link);
                                                        echo ('<tr>');
                                                        echo ('<td>');
                                                        echo ($f['name']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($f['address']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($num_emps);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        if ($f['adminType'] == "1") {
                                                            echo "Walk-In Only";
                                                        } else if ($f['adminType'] == "2") {
                                                            echo "Appointment Only";
                                                        } else {
                                                            echo "Both Walk-In & Appointment";
                                                        }
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        if ($f['doesDriveThru'] == "0") {
                                                            echo "No";
                                                        } else {
                                                            echo "Yes";
                                                        }
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

            var table = $('#q12Table').DataTable();

        });
    </script>

</body>

</html>