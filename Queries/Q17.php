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
<title>Q17</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Q17</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <form id="theForm" name="theForm" action="Q17p.php" method="post">
                        <div class="form-group">
                                <label for="region" class="my-1 mr-2">Facility</label><br>
                                <select class="selectpicker" id="region" name="region" data-live-search="true">
                                    <?php
                                    foreach ($regions as $r) {
                                    ?>
                                        <option value="<?php echo $r['regionID']; ?>"><?php echo $r['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="startDate" class="my-1 mr-2">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="startDate" required>
                            </div>
                            <div class="form-group">
                                <label for="endDate" class="my-1 mr-2">End Date</label>
                                <input type="date" class="form-control" id="endDate" name="endDate" required>
                            </div>
                            
                            <button class="btn btn-primary" type="submit">Get Report</button>
                        </form>
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

    </script>

</body>

</html>