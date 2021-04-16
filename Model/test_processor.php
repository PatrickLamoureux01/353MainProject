<?php
include_once('../header.php');

$db = new dbmysqli();
$link = $db->connect();

$action = $_GET["action"]; // get action type

if ($action == "perform_test") {

    $patient = $_POST["patient"];
    $health_center = $_POST["institution"];
    $adminBy = $_POST["adminBy"];
    $testDate = $_POST["testDate"];

    create_test($testDate, $patient, $adminBy, $health_center, $link);
    header('Location: ../healthcare-index.php');
} else if ($action == "give_results") {

    $patient = $_POST["patient"];
    $result = $_POST["result"];
    $resultDate = $_POST["resultDate"];

    $patientInfo = explode("/",$patient);

    log_test_result($patientInfo[0],$patientInfo[1],$result,$resultDate, $link);
    header('Location: ../healthcare-index.php');
}
