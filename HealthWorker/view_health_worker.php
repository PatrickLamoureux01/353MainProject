<?php
include_once('../header.php');
session_start();

$db = new dbmysqli();
$link = $db->connect();

$fname = get_Fname($link, $_SESSION["User"]);
$fullname = get_full_name($link, $_SESSION["User"]);

$personID = $_GET["pid"];

$patient_name = get_full_name($link, $personID);

$p = get_patient_by_medicare($link, $personID);
$person = mysqli_fetch_array($p);

$isAdmin = check_admin($personID, $link);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('../nav/htmlheader.php'); ?>
<title>View Health Worker - <?php echo $patient_name; ?></title>

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
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $patient_name ?>'s Full Profile</h1>
                    </div>

                    <div class="card flex-row flex-wrap">
                        <div class="card-header border-0">
                            <img src="//placehold.it/200" alt="">
                        </div>
                        <div class="card-block px-2">


                            <h4 class="card-title" style="text-decoration:underline;">Health Worker Information</h4>
                            <p class="card-text"><strong>Medicare Number:</strong> <?php echo ($person['medicareNum']); ?></p>
                            <p class="card-text"><strong>First Name:</strong> <?php echo ($person['firstName']); ?></p>
                            <p class="card-text"><strong>Last Name:</strong> <?php echo ($person['lastName']); ?></p>
                            <p class="card-text"><strong>Date of Birth:</strong> <?php echo ($person['dob']); ?></p>
                            <p class="card-text"><strong>Email Address:</strong> <?php echo ($person['email']); ?></p>
                            <p class="card-text"><strong>Telephone Number:</strong> <?php echo ($person['telNum']); ?></p>
                            <p class="card-text"><strong>Citizenship:</strong> <?php echo ($person['citizenship']); ?></p>
                            <p class="card-text"><strong>Province:</strong> <?php echo ($person['province']); ?></p>
                            <p class="card-text"><strong>Address:</strong> <?php echo ($person['address']); ?></p>
                            <p class="card-text"><strong>Postal Code:</strong> <?php echo ($person['postalCode']); ?></p>
                            <p class="card-text"><strong>Administrative Priviliges:</strong>
                                <?php
                                if ($isAdmin == "0") {
                                    echo "No";
                                } else {
                                    echo "Yes";
                                }
                                ?></p>
                            <button type="button" onclick="window.location.href='edit_health_worker.php?pid=<?php echo $person['medicareNum']; ?>'" class="btn btn-secondary">Edit Health Worker</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteWorkerModal" data-id="<?php echo $person['medicareNum']; ?>" data-name="<?php echo $person['firstName'] . " " . $person['lastName']; ?>">Delete</button>
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


    <!-- Delete Modal-->
    <div class="modal fade" id="deleteWorkerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to continue?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="delete_txt"></p>
                    <p id="tmp"></p>
                    <button type="button" onclick="delete_worker()" id="reject_ft" name="reject_ft" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Delete Health Worker</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('../nav/footer.php'); ?>
    <script>
        $('#deleteWorkerModal').on('shown.bs.modal', function(event) {


            var button = $(event.relatedTarget) // Button that triggered the modal
            var name = button.data('name') // Extract patient name
            var id = button.data('id') // Extract patient ID

            $('#delete_txt').html("You are about to delete <strong>" + name + "</strong> from the health worker records.");
            $('#tmp').val(id);
        });

        function delete_worker() {

            var id = $('#tmp').val();

            $.ajax({
                type: "POST",
                url: "../Model/worker_processor.php?action=delete",
                data: {
                    action: "delete",
                    id: id
                }
            }).done(function(msg) {
                window.location.href="../HealthWorker/view_health_workers.php"
            });
        }
    </script>


</body>

</html>