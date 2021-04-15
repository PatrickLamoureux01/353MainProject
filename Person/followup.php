<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$med;

$symptoms = get_all_symptoms($link)
?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('../nav/patient_sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('../nav/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Follow Up Form</h1>
                    </div>


                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="row">
                            <div class="col"><input type="text" id="medicareNum" name="medicareNum" class="form-control" placeholder="Medicare Number"></div>
                            <div class="col"><button type="submit" class="btn btn-primary">Find Tests</button></div>
                        </div>
                    </form>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $med = $_POST['medicareNum'];
                        $show;
                        if (does_person_already_exist($med, $link) == 1) {
                            $show = 1;
                        } else {
                            $show = 0;
                            echo "<p>There is nobody here by that name</p>";
                        }
                    }
                    ?>

                    <p>Bibendum at varius vel pharetra vel. Suspendisse faucibus interdum posuere lorem ipsum dolor sit amet consectetur. Mauris rhoncus aenean vel elit. Dignissim convallis aenean et tortor. Auctor urna nunc id cursus metus aliquam. </p>

                    <form <?php if ($show == 0) echo "style='display: none';"; ?> action="../Model/med_processor.php" method="post">
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="test" class="">Select a Test to Follow Up</label>
                                <select name="test" id="test" class="selectpicker form-control" data-live-search="true">
                                    <?php
                                    $test_dates = get_tests($link, $med);
                                    foreach ($test_dates as $td) {
                                    ?>
                                        <option value="<?php echo $td['testDate']; ?>"><?php echo $td['testDate']; ?></option>

                                    <?php
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="temperature">Current Temperature &#176;C</label>
                                <input type="number" value="37" name="temperature" id="temperature" class="form-control">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="symptoms" class="">Select Your Current Symptoms</label>
                                <select name="symptoms" id="symptoms" class="selectpicker form-control" multiple data-live-search="true">
                                    <?php
                                    foreach ($symptoms as $s) {
                                    ?>
                                        <option value="<?php echo $s['name']; ?>"><?php echo $s['name']; ?></option>

                                    <?php
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="otherSymp">Other Symptoms</label>
                                <input type="text" placeholder="ie. a,b,c" name="otherSymp" id="otherSymp" class="form-control">
                            </div>

                        </div>
                        



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

    <!-- Logout Modal Box -->
    <?php include('../nav/logout.php'); ?>

    <?php include('../nav/footer.php'); ?>

</body>

</html>