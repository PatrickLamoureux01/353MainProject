<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$patientID = $_GET["pid"];

$p = get_patient_by_medicare($link,$patientID);
$patient = mysqli_fetch_array($p);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>Edit Patient - <?php echo $patient['firstName'] ." ". $patient['lastName']; ?></title>

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
                        <h1 class="h3 mb-0 text-gray-800">Edit Patient</h1>
                    </div>

                    <form action="../Model/patient_processor.php?action=edit" method="post">
                        <div class="form-group">
                            <label for="MedicareNum" class="my-1 mr-2">Medicare Number </label>
                            <input type="text" class="form-control" id="medicareNum" name="medicareNum" value="<?php echo $patient["medicareNum"];?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="fName" class="my-1 mr-2">First Name </label>
                            <input type="text" class="form-control" id="fName" name="fName" value="<?php echo $patient['firstName'];?>">
                        </div>
                        <div class="form-group">
                            <label for="lName" class="my-1 mr-2">Last Name </label>
                            <input type="text" class="form-control" id="lName" name="lName" value="<?php echo $patient['lastName'];?>">
                        </div>
                        <div class="form-group">
                            <label for="dob" class="my-1 mr-2">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $patient['dob'];?>">
                        </div>
                        <div class="form-group">
                            <label for="email" class="my-1 mr-2">E-mail </label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $patient['email'];?>">
                        </div>
                        <div class="form-group">
                            <label for="telNum" class="my-1 mr-2">Telephone Number </label>
                            <input type="text" class="form-control" id="telNum" name="telNum" value="<?php echo $patient['telNum'];?>">
                        </div>
                        <div class="form-group">
                            <label for="citizenship" class="my-1 mr-2">Citizenship </label>
                            <input type="text" class="form-control" id="citizenship" name="citizenship" value="<?php echo $patient['citizenship'];?>">
                        </div>
                        <div class="form-group">
                            <label for="province" class="my-1 mr-2">Province </label>
                            <input type="text" class="form-control" id="province" name="province" value="<?php echo $patient['province'];?>">
                        </div>
                        <div class="form-group">
                            <label for="address" class="my-1 mr-2">Address </label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $patient['address'];?>">
                        </div>
                        <div class="form-group">
                            <label for="postal" class="my-1 mr-2">Postal Code </label>
                            <input type="text" class="form-control" id="postal" name="postal" value="<?php echo $patient['postalCode'];?>">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Update Patient</button>

                    </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Copyright -->
            <?php include('../nav/copyright.php'); ?>
            <!-- End of Footer -->

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