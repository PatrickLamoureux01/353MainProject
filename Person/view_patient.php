<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$patientID = $_GET["pid"];

$patient_name = get_full_name($link,$patientID);

$p = get_patient_by_medicare($link, $patientID);
$patient = mysqli_fetch_array($p);

$isAdmin = check_admin($_SESSION["User"],$link);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>View Patient - <?php echo $patient['firstName'] ." ". $patient['lastName']; ?></title>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <?php
        if ($isAdmin == 0) {
            include('../nav/hcw_sidebar.php'); 
        } else {
            include('../nav/admin_sidebar.php'); 
        }
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include(' nav/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $patient_name?>'s Full Profile</h1>
                    </div>

                    <div class="card flex-row flex-wrap">
                        <div class="card-header border-0">
                            <img src="//placehold.it/200" alt="">
                        </div>
                        <div class="card-block px-2">
                            <h4 class="card-title" style="text-decoration:underline;">Patient Information</h4>
                            <p class="card-text"><strong>Medicare Number:</strong> <?php echo ($patient['medicareNum']); ?></p>
                            <p class="card-text"><strong>First Name:</strong> <?php echo ($patient['firstName']); ?></p>
                            <p class="card-text"><strong>Last Name:</strong> <?php echo ($patient['lastName']); ?></p>
                            <p class="card-text"><strong>Date of Birth:</strong> <?php echo ($patient['dob']); ?></p>
                            <p class="card-text"><strong>Email Address:</strong> <?php echo ($patient['email']); ?></p>
                            <p class="card-text"><strong>Telephone Number:</strong> <?php echo ($patient['telNum']); ?></p>
                            <p class="card-text"><strong>Citizenship:</strong> <?php echo ($patient['citizenship']); ?></p>
                            <p class="card-text"><strong>Province:</strong> <?php echo ($patient['province']); ?></p>
                            <p class="card-text"><strong>Address:</strong> <?php echo ($patient['address']); ?></p>
                            <p class="card-text"><strong>Postal Code:</strong> <?php echo ($patient['postalCode']); ?></p>
                        </div>
                        <div class="card-box px-2">
                        <h4 class="card-title" style="text-decoration:underline;">Patient Information</h4>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="row">
                                    <div class="col"><select name="test" id="test" class="selectpicker form-control" data-live-search="true">
                                        <?php
                                        $test_dates = get_pos_tests($link, $patientID);
                                        foreach ($test_dates as $td) {
                                        ?>
                                            <option value="<?php echo $td['testDate']; ?>"><?php echo $td['testDate']; ?></option>
                                        <?php
                                        } ?>
                                    </select></div>
                                    <div class="col"><button type="submit" class="btn btn-primary">Switch Test</button></div>

                                </div>
                                <input type="hidden" name="medicareNum" value=<?php echo $patientID;?>>

                            </form>
                            
                            <?php
                            if($_SERVER["REQUEST_METHOD"]=="POST"){
                                $med = $_POST["medicareNum"];
                                $testDate = $_POST["test"];
                                $list = get_test_symptoms($med,$testDate,$link);
                                foreach($list as $e){
                                    echo "<p class='card-text'>".$e["symptom"]."</p>";
                                }
                                

                            echo $_SERVER['QUERY_STRING'];
                            // header("Location: ../view_patient.php?pid=209672");
                            //header("Location:./Person/view_patient.php?pid=209672");
                            }
                            
                            


                            ?>

                            


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

    <!-- Logout Modal-->
    <?php include('../nav/logout.php'); ?>

    <?php include('../nav/footer.php'); ?>
</body>

</html>