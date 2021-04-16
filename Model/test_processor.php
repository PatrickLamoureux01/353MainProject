<?php
include_once('../header.php');

$db = new dbmysqli();
$link = $db->connect();

$action = $_GET["action"]; // get action type

$patient = $_POST["patient"];
$health_center = $_POST["institution"];
$adminBy = $_POST["adminBy"];
$testDate = $_POST["testDate"];

if ($action == "perform_test") {
    create_test($testDate, $patient, $adminBy, $health_center, $link);
    header('Location: ../healthcare-index.php');
} else if ($action == "edit") {
    edit_person($medicare, $fname, $lname, $dob, $email, $telNum, $citizenship, $province, $address, $postal, $link);
    header('Location: ../Person/view_patients_admin.php');
}
