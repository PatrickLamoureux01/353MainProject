<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$people = get_all_patients_except_yourself($_SESSION["User"], $link);
$institutions = get_all_health_centers($link);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>Perform Covid Test - <?php echo $fname; ?></title>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('../nav/hcw_sidebar.php'); ?>

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
                        <h1 class="h3 mb-0 text-gray-800">Perform COVID-19 Test</h1>
                    </div>

                    <form id="patientInfo" name="patientInfo" action="../Model/test_processor.php?action=perform_test" method="post">
                        <div class="form-group">
                            <label for="patient" class="my-1 mr-2">Please select the patient that you are performing the COVID-19 test on.</label><br>
                            <select class="selectpicker" id="patient" name="patient" data-live-search="true">
                                <?php
                                foreach ($people as $p) {
                                ?>
                                    <option value="<?php echo $p['medicareNum']; ?>"><?php echo $p['firstName'] . " " . $p['lastName']; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="institution" class="my-1 mr-2">Performed At </label><br>
                            <select class="selectpicker" id="institution" name="institution" data-live-search="true">
                                <?php
                                foreach ($institutions as $i) {
                                ?>
                                    <option value="<?php echo $i['facilityId']; ?>"><?php echo $i['name'];?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="adminByName" class="my-1 mr-2">Administered By </label>
                            <input type="text" class="form-control" id="adminByName" name="adminByName" value="<?php echo $fullname; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="testDate" class="my-1 mr-2">Sample Taken On </label>
                            <input type="text" class="form-control" id="testDate" name="testDate" value="<?php echo date("Y-m-d H:i:s") ?>" readonly>
                        </div>
                        <div class="form-group" hidden>
                            <label for="adminBy" class="my-1 mr-2">Sample Taken On </label>
                            <input type="text" class="form-control" id="adminBy" name="adminBy" value="<?php echo $_SESSION["User"]; ?>" readonly>
                        </div>
                        
                        <button type="submit" class="btn btn-outline-primary">Take Sample</button>

                    </form>

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

    <!-- Logout Modal-->
    <?php include('../nav/logout.php'); ?>

    <?php include('../nav/footer.php'); ?>

</body>

</html>