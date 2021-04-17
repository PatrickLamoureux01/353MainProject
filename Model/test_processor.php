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
    
    $name = get_full_name($link,$patientInfo[0]);
    $email = get_email($patientInfo[0],$link);
    $region = get_region_of_person($patientInfo[0],$link);
    if ($result == "1") { // positive COVID result

        $group_zones = get_all_groupzones_of_one_person($patientInfo[0],$link); // get all the group zones the person was in
        insert_msg_covid_test_positive(date("Y-m-d H:i:s"),$region,$name,$email,$link);
        insert_msg_questionnaire_reminder(date("Y-m-d H:i:s"),$region,$name,$email,$link);
        foreach ($group_zones as $group) { // for each of the positive person's group zones
            //var_dump($group);
            $people = get_all_people_in_group_zone_except_yourself($group['groupZoneId'],$patientInfo[0],$link); // get all the people in each zone
            foreach ($people as $person) { // for each person
                //var_dump($person);
                $p_name = get_full_name($link,$person['medicareNum']); // get their name
                $p_email = get_email($person['medicareNum'],$link); // get their email
                $p_region = get_region_of_person($person['medicareNum'],$link); // get their region
                insert_msg_exposed_to_positive(date("Y-m-d H:i:s"),$p_region,$p_name,$p_email,$link);
            }
        }
    } else if ($result == "0") {
        insert_msg_covid_test_negative(date("Y-m-d H:i:s"),$region,$name,$email,$link);
    }
    header('Location: ../healthcare-index.php');
}
