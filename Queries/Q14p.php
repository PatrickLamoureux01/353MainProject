<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$date = $_POST["date"];
$start = $date." 00:00:00";
$end = $date." 23:59:59";

$tests = get_tests_on_date($start,$end,$link);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>Q14</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Q14</h1>
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
                                        <table class="table table-hover table-sm" id="q14Table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>DateTime of Result</th>
                                                    <th>Test Result</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>DOB</th>
                                                    <th>Tel</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (mysqli_num_rows($tests) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no results to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($tests as $t) {
                                                        $fname = get_Fname($link,$t['patient']);
                                                        $lname = get_Lname($link,$t['patient']);
                                                        $dob = get_dob($link,$t['patient']);
                                                        $tel = get_tel($link,$t['patient']);
                                                        $email = get_email($t['patient'],$link);

                                                        echo ('<tr>');
                                                        echo ('<td>');
                                                        echo ($t['resultDate']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        if ($t['testResult'] == "1") {
                                                            echo "Positive";
                                                        } else {
                                                            echo "Negative";
                                                        }
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($fname);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($lname);
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

            var table = $('#q14Table').DataTable();

        });
    </script>

</body>

</html>