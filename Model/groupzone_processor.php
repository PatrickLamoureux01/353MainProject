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
} else if ($action == "add_people") {

    $people = $_POST["people"];
    $gz = $_POST["gz"];

    foreach ($people as $p) {
        //var_dump($p);
        $check = are_they_in_gz_already($p,$gz,$link);

        if (mysqli_num_rows($check) == 0) { // not in gz already
            add_person_to_gz($p,$gz,$link);
        } else {
            continue;
        }
    }
    header('Location: ../GroupZone/view_groupzones.php');
}
