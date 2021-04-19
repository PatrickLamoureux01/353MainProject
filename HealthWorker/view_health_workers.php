<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$workers = get_all_health_workers($link);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>View All Health Workers</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Health Workers Overview</h1>
                    </div>

                    <div class="col pr-4 pt-4 text-right">
                        <a id="editbutton" class="m-0 pt-4 font-weight-bold text-primary" href="create_health_worker.php"><i class="fa fa-plus"></i> Create New Health Worker</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 mb-4">
                            <!-- DataTales Example -->
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">All Health Workers</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm" id="workersTable" width="100%" cellspacing="0">
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

                                                if (mysqli_num_rows($workers) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no health workers to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($workers as $worker) {
                                                        echo ('<tr><td class="clickable" data-href="view_health_worker.php?pid=');
                                                        echo $worker['medicareNum'];
                                                        echo ('">');
                                                        echo ($worker['firstName']);
                                                        echo ('</td><td class="clickable" data-href="view_health_worker.php?pid=');
                                                        echo $worker['medicareNum'];
                                                        echo ('">');
                                                        echo ($worker['lastName']);
                                                        echo ('</td><td class="clickable" data-href="view_health_worker.php?pid=');
                                                        echo $worker['medicareNum'];
                                                        echo ('">');
                                                        echo ($worker['medicareNum']);
                                                        echo ('</td><td class="clickable" data-href="view_health_worker.php?pid=');
                                                        echo $worker['medicareNum'];
                                                        echo ('">');
                                                        echo ($worker['dob']);
                                                        echo ('</td><td class="clickable" data-href="view_health_worker.php?pid=');
                                                        echo $worker['medicareNum'];
                                                        echo ('">');
                                                        echo ($worker['email']);
                                                        echo ('</td><td class="clickable" data-href="view_health_worker.php?pid=');
                                                        echo $worker['medicareNum'];
                                                        echo ('">');
                                                        echo ($worker['address']);
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

            <!-- Copyright -->
            <?php include('../nav/copyright.php'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Copyright Modal-->
    <?php include('../nav/copyright.php'); ?>


    <?php include('../nav/footer.php'); ?>
    <script>
        $(document).ready(function() {
            var table = $('#workersTable').DataTable();

            $('#workersTable tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
                window.location.href = "view_health_worker.php?pid=" + data[2];
            });

        });

    </script>
 

</body>

</html>