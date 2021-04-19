<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$address = $_POST["address"];

$people = get_people_by_address($address,$link);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>Q11</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Q11</h1>
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
                                        <table class="table table-hover table-sm" id="q11Table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>DOB</th>
                                                    <th>Medicare</th>
                                                    <th>Tel</th>
                                                    <th>Citizenship</th>
                                                    <th>Email</th>
                                                    <th>Mother Name</th>
                                                    <th>Father Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (mysqli_num_rows($people) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no results to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($people as $p) {

                                                        $mother = get_mother($p['medicareNum'],$link);
                                                        $father = get_father($p['medicareNum'],$link);
                                                        echo ('<tr>');
                                                        echo ('<td>');
                                                        echo ($p['firstName']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($p['lastName']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($p['dob']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($p['medicareNum']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($p['telNum']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($p['citizenship']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($p['email']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($mother);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($father);
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

            var table = $('#q11Table').DataTable();

        });
    </script>

</body>

</html>