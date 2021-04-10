<?php
include_once('../header.php');

$db = new dbmysqli();
$link = $db->connect();

$action = $_GET["action"]; // get action type

if ($action == "create" || $action == "edit") {

    $groupzoneID = $_POST["id"];
    $name = $_POST["name"];


    if ($action == "create") {
        create_group_zone($groupzoneID, $name, $link);
        header('Location: ../GroupZone/view_groupzones.php');
    } else {
        edit_group_zone($groupzoneID, $name, $link);
        header('Location: ../GroupZone/view_groupzones.php');
    }
} else if ($action == "delete") {
    $id = $_POST["id"];
    delete_group_zone($id, $link);
}
