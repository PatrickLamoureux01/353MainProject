<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$personID = $_GET["pid"];

$p = get_patient_by_medicare($link, $personID);
$patient = mysqli_fetch_array($p);

$isAdmin = check_admin($personID, $link);

$cities = get_all_cities($link);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>Edit Health Worker - <?php echo $fname; ?></title>

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
                        <h1 class="h3 mb-0 text-gray-800">Edit Health Worker</h1>
                    </div>

                    <form action="../Model/worker_processor.php?action=edit" method="post">
                        <div class="form-group">
                            <label for="MedicareNum" class="my-1 mr-2">Medicare Number </label>
                            <input type="text" class="form-control" id="medicareNum" name="medicareNum" value="<?php echo $patient["medicareNum"]; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="fName" class="my-1 mr-2">First Name </label>
                            <input type="text" class="form-control" id="fName" name="fName" value="<?php echo $patient['firstName']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="lName" class="my-1 mr-2">Last Name </label>
                            <input type="text" class="form-control" id="lName" name="lName" value="<?php echo $patient['lastName']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="dob" class="my-1 mr-2">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $patient['dob']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email" class="my-1 mr-2">E-mail </label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $patient['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telNum" class="my-1 mr-2">Telephone Number </label>
                            <input type="text" class="form-control" id="telNum" name="telNum" value="<?php echo $patient['telNum']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="citizenship" class="my-1 mr-2">Citizenship </label>
                            <input type="text" class="form-control" id="citizenship" name="citizenship" value="<?php echo $patient['citizenship']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="province" class="my-1 mr-2">Province </label>
                            <input type="text" class="form-control" id="province" name="province" value="<?php echo $patient['province']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="address" class="my-1 mr-2">Address </label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $patient['address']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="postal" class="my-1 mr-2">Postal Code </label><br>
                            <select class="selectpicker" id="postal" name="postal" data-live-search="true">
                                <?php
                                foreach ($cities as $c) {
                                    $x = get_postal_codes_by_city($link, $c['name']);
                                ?>
                                    <optgroup label="<?php echo $c['name']; ?>">
                                        <?php
                                        foreach ($x as $code) {
                                            if ($code['postalCode'] == $patient['postalCode']) {
                                                ?>
                                                <option value="<?php echo $code['postalCode']; ?>" selected><?php echo $code['postalCode']; ?></option>
                                                <?php
                                            } else { ?>
                                                <option value="<?php echo $code['postalCode']; ?>"><?php echo $code['postalCode']; ?></option>
                                            <?php
                                            }
                                        } ?>
                                    </optgroup>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-check">
                            <?php if ($isAdmin == "0") {
                                ?><input class="form-check-input" type="checkbox" name="isAdmin" id="isAdmin"> <?php
                            } else {
                                ?><input class="form-check-input" type="checkbox" name="isAdmin" id="isAdmin" checked> <?php
                            } ?>
                            <label class="form-check-label" for="isAdmin">Grant Admin Privileges?</label>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Update Patient</button>

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