<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$regions = get_all_regions($link);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>Q13</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Q13</h1>
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
                                        <table class="table table-hover table-sm" id="q13Table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Cities in Region</th>
                                                    <th>Postal Codes in Region</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                if (mysqli_num_rows($regions) == 0) {
                                                    echo ('<tr>
          <td>   </td> 
          <td> There are no results to display. </td> 
        </tr>');
                                                } else {
                                                    foreach ($regions as $r) {
                                                        $cities = "";
                                                        $postals = "";
                                                        $ct = get_cities_in_region($r['regionID'],$link);
                                                        
                                                        foreach ($ct as $c) {
                                                            $cities .= $c['name'] . ", ";
                                                            $pc = get_postal_codes_by_city($link,$c['name']);
                                                            foreach ($pc as $p) {
                                                                $postals .= $p['postalCode'] . ", ";
                                                            }
                                                        }
                                                        $cities_list = rtrim($cities, ", ");
                                                        $postals_list = rtrim($postals, ", ");
                                                        echo ('<tr>');
                                                        echo ('<td>');
                                                        echo ($r['name']);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($cities_list);
                                                        echo  ('</td>');
                                                        echo ('<td>');
                                                        echo ($postals_list);
                                                        echo  ('</td>');
                                                        echo ('<td>');
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

            var table = $('#q13Table').DataTable();

        });
    </script>

</body>

</html>