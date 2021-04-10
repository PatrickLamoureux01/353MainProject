<?php
include_once('../header.php');

$db = new dbmysqli();
$link = $db->connect();

$action = $_GET["action"]; // get action type

if ($action == "create" || $action == "edit") {

    $facilityID = $_POST["facilityID"];
    $name = $_POST["name"];
    $phone = $_POST["telNum"];
    $type = $_POST["type"];
    $address = $_POST["address"];
    $website = $_POST["website"];
    $adminType = $_POST["adminType"];

    if (isset($_POST["drivethru"])) {
        $drivethru = 1;
    } else {
        $drivethru = 0;
    }

    if ($action == "create") {
        create_health_center($facilityID, $name, $phone, $type, $address, $website, $drivethru, $adminType, $link);
        header('Location: ../Regions/view_regions.php');
    } else {
        edit_health_center($facilityID, $name, $phone, $type, $address, $website, $drivethru, $adminType, $link);
        header('Location: ../Regions/view_regions.php');
    }
} else if ($action == "delete") {
    $id = $_POST["id"];
    delete_health_center($id, $link);
}
