<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$start = $_POST["start"];
$end = $_POST["end"];

$messages = get_messages_between_two_dates($start, $end, $link);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>Q10</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Q10</h1>
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
                                        <table class="table table-hover table-sm" id="q10Table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sent On</th>
                                                    <th>Region</th>
                                                    <th>Person</th>
                                                    <th>E-mail</th>
                                                    <th>Old Alert</th>
                                                    <th>New Alert</th>
                                                    <th>New Guidelines</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (mysqli_num_rows($messages) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no results to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($messages as $msg) {
                                                        echo ('<tr>');
                                                        echo ('<td>');
                                                        echo ($msg['broadcastDateTime']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($msg['region']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($msg['person']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($msg['emailAddress']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($msg['oldAlertState']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($msg['newAlertState']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($msg['newGuidelines']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($msg['description']);
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

            var table = $('#q10Table').DataTable();

        });
    </script>

</body>

</html>