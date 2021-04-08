<?php
include_once('../header.php');

$db = new dbmysqli();
$link = $db->connect();

$action = $_GET["action"]; // get action type

if ($action == "create" || $action == "edit") {

    $medicare = $_POST["medicareNum"];
    $fname = $_POST["fName"];
    $lname = $_POST["lName"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $telNum = $_POST["telNum"];
    $citizenship = $_POST["citizenship"];
    $province = $_POST["province"];
    $address = $_POST["address"];
    $postal = $_POST["postal"];

    if (isset($_POST["isAdmin"])) {
        $adm = 1;
    } else {
        $adm = 0;
    }
    if ($action == "create") {
        $flag = does_person_already_exist($medicare, $link);
        if ($flag) { // person already exists
            create_health_worker($medicare, $adm, $link);
        } else {
            create_person($medicare, $fname, $lname, $dob, $email, $telNum, $citizenship, $province, $address, $postal, $link);
            create_health_worker($medicare, $adm, $link);
        }
        header('Location: ../HealthWorker/view_health_workers.php');
    } else {
        edit_person($medicare, $fname, $lname, $dob, $email, $telNum, $citizenship, $province, $address, $postal, $link);
        edit_health_worker($medicare,$adm,$link);
        header('Location: ../HealthWorker/view_health_workers.php');
    }
} else if ($action == "delete") {
    $id = $_POST["id"];
    delete_health_worker($id, $link);
}
