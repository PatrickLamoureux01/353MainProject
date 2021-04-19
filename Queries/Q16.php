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
                        <form id="theForm" name="theForm" action="Q16p.php" method="post">
                            <div class="form-group">
                                <label for="date" class="my-1 mr-2">Tested Positive On</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="form-group">
                                <label for="facility" class="my-1 mr-2">Facility</label><br>
                                <select class="selectpicker" id="facility" name="facility" data-live-search="true">
                                    <?php
                                    foreach ($facilities as $f) {
                                    ?>
                                        <option value="<?php echo $f['name']; ?>"><?php echo $f['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Get Workers</button>
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