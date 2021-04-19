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
$facility = $_POST["facility"];
$workers = q16($start,$end,$facility,$link);
$begin_date = date('Y-m-d H:m:s',strtotime($start.'-14 days'));
// var_dump($start);
// var_dump($begin_date);
// foreach ($workers as $w) {
//     var_dump($w);
// }

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>Q16</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Q16</h1>
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
                                        <table class="table table-hover table-sm" id="q16Table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Medicare Num</th>
                                                    <th>DOB</th>
                                                    <th>Tel</th>
                                                    <th>Email</th>
                                                    <th>Potentially Exposed Workers</th>
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
                                                        $exposed_hcw = "";
                                                        $facs = get_all_facilities_worked_at_14_days($w['patient'],$begin_date,$end,$link);
                                                        //var_dump($w['patient']);
                                                        //var_dump($begin_date);
                                                        //var_dump($end);
                                                        //var_dump($facs);
                                                        foreach ($facs as $f) {
                                                            //var_dump($f);
                                                            $exposed = get_exposed_workers($f['facilityId'],$w['patient'],$link);
                                                            foreach ($exposed as $x) {
                                                                $full_name = get_full_name($link,$x['workerId']);

                                                                if (strpos($exposed_hcw,$full_name) !== false) {
                                                                    continue;
                                                                } else {
                                                                    $exposed_hcw .= $full_name.", ";
                                                                }
                                                            }
                                                        }
                                                        $fname = get_Fname($link,$w['patient']);
                                                        $lname = get_Lname($link,$w['patient']);
                                                        $dob = get_dob($link,$w['patient']);
                                                        $tel = get_tel($link,$w['patient']);
                                                        $email = get_email($w['patient'],$link);
                                                        $exposed_list = rtrim($exposed_hcw, ", ");
                                                        echo ('<tr>');
                                                        echo ('<td>');
                                                        echo ($fname);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($lname);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($w['patient']);
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
                                                        echo ('<td>');
                                                        echo ($exposed_list);
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

            var table = $('#q16Table').DataTable();

        });
    </script>

</body>

</html>