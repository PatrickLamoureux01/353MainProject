<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$patients = get_all_patients_awaiting_results($link);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>Give Covid Test Results- <?php echo $fname; ?></title>

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
                        <h1 class="h3 mb-0 text-gray-800">COVID-19 Test Results</h1>
                    </div>

                    <form id="patientInfo" name="patientInfo" action="../Model/test_processor.php?action=give_results" method="post">
                        <div class="form-group">
                            <label for="patient" class="my-1 mr-2">Please select the patient that you are administering the COVID-19 results to.</label><br>
                            <select class="selectpicker" id="patient" name="patient" data-live-search="true">
                                <?php
                                foreach ($patients as $p) {
                                    $fullname = get_full_name($link,$p['patient']);
                                ?>
                                    <option value="<?php echo $p['patient']."/".$p['testDate']; ?>"><?php echo $fullname ." taken on ". $p['testDate']; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="result" class="my-1 mr-2">Please select the result of the test.</label><br>
                            <select class="selectpicker" id="result" name="result" data-live-search="true">
                                <option value="1">Positive</option>
                                <option value="0">Negative</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="resultDate" class="my-1 mr-2">Result Given On </label>
                            <input type="text" class="form-control" id="resultDate" name="resultDate" value="<?php echo date("Y-m-d H:i:s") ?>" readonly>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Give Result</button>

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