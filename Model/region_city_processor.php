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
    if ($current_level != $alert) { // alert level has changed
        $people = get_all_people_in_region($regionId,$link); // get all people in given region
        $measures = get_all_measures_for_alert($alert,$link);
        if ($current_level > $alert) { // alert level went up
            foreach ($people as $person) { 
                $fullname = $person['firstName'] . $person['lastName'];
                insert_msg_alert_level_increase(date("Y-m-d H:i:s"),$regionId,$fullname,$person['email'],$current_level,$alert,$measures,"The alert level for your region has increased. Please follow the following guidelines in regards to public health.",$link);
            }
            
        } else { // alert level went down
            //insert_msg_alert_level_decrease(date("Y-m-d H:i:s"));
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