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

    if ($action == "create") {
        create_person($medicare, $fname, $lname, $dob, $email, $telNum, $citizenship, $province, $address, $postal, $link);
        header('Location: ../view_patients_admin.php');
    } else {
        edit_person($medicare, $fname, $lname, $dob, $email, $telNum, $citizenship, $province, $address, $postal, $link);
        header('Location: ../view_patients_admin.php');
    }
} else if ($action == "delete") {
    $id = $_POST["id"];
    delete_person($id, $link);
}
