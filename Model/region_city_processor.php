<?php
include_once('../header.php');

$db = new dbmysqli();
$link = $db->connect();

$action = $_GET["action"]; // get action type


if ($action == "create_region") {

    $regionId = $_POST["regionID"];
    $name = $_POST["name"];
    $alert = $_POST["alertLevel"];
    $cities = $_POST["cities"];

    create_region($regionId,$name,$alert,$link);
    foreach($cities as $city) {
        insert_region_city($regionId,$city,$link);
    }
    header('Location: ../Region/view_regions_cities.php');
} else if ($action == "edit_region") {

    $regionId = $_POST["regionID"];
    $name = $_POST["name"];
    $alert = $_POST["alertLevel"];
    $cities = $_POST["cities"];

    $current_level = get_current_alert_level($regionId,$link);
    $region_name = get_region_name_by_id($link,$regionId);

    if ($current_level != $alert) { // alert level has changed
        $people = get_all_people_in_region($regionId,$link); // get all people in given region
        $measures = get_all_measures_for_alert($alert,$link);
        $list = "";
        foreach($measures as $m) {
         $list .= $m['recommendation'] . " ";
        }
        if ($alert > $current_level) { // alert level went up
            foreach ($people as $person) { 
                $fullname = $person['firstName']." ".$person['lastName'];
                insert_msg_alert_level_increase(date("Y-m-d H:i:s"),$region_name,$fullname,$person['email'],$current_level,$alert,$list,$link);
            }
        } else { // alert level went down
            foreach ($people as $person) { 
                $fullname = $person['firstName']." ".$person['lastName'];
                insert_msg_alert_level_decrease(date("Y-m-d H:i:s"),$region_name,$fullname,$person['email'],$current_level,$alert,$list,$link);
            }
        }
    }
    edit_region($regionId,$name,$alert,$link);
    delete_cities_from_region($regionId,$link); // delete all previous records of links
    foreach($cities as $city) {
        insert_region_city($regionId,$city,$link); // populate table with new links
    }
    header('Location: ../Region/view_regions_cities.php');
} else if ($action == "create_city") {

    $cityID = $_POST["cityID"];
    $name = $_POST["name"];
    $pCode = $_POST["postals"];

    create_city($cityID,$name,$link);
    foreach($pCode as $postalCode) {
        insert_city_postal($cityID,$postalCode,$link);
    }
    header('Location: ../Region/view_regions_cities.php');
} else if ($action == "edit_city") {

    $cityID = $_POST["cityID"];
    $name = $_POST["name"];
    $pCode = $_POST["postals"];

    edit_city($cityID,$name,$link);
    delete_codes_from_city($cityID,$link); // delete all previous records of links
    foreach($pCode as $postalCode) {
        insert_city_postal($cityID,$postalCode,$link); // populate table with new links
    }
    header('Location: ../Region/view_regions_cities.php');
} else if ($action == "delete_region") {
    $id = $_POST["id"];
    delete_region($id, $link);
} else if ($action == "delete_city") {
    $id = $_POST["id"];
    delete_city($id, $link);
}