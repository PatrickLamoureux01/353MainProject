<?php
include_once('../header.php');

$db = new dbmysqli();
$link = $db->connect();

$action = $_GET["action"]; // get action type

if ($action == "create" || $action == "edit") {

    $groupzoneID = $_POST["recommendationID"];
    $recommendation = $_POST["recommendation"];
    $alertLevel = $_POST["alertLevel"];

    if ($action == "create") {
        create_public_health_rec($groupzoneID, $recommendation, $alertLevel, $link);
        header('Location: ../PublicHealthRecommendation/view_publichealthrecommendations.php');
    } else {
        edit_public_health_rec($groupzoneID, $recommendation, $alertLevel, $link);
        header('Location: ../PublicHealthRecommendation/view_publichealthrecommendations.php');
    }
} else if ($action == "delete") {
    $id = $_POST["id"];
    delete_public_health_rec($id, $link);
}
