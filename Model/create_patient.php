<?php
include_once('connect.php');
include_once('patients.php');
include_once('regions.php');

$db = new dbmysqli();
$link = $db->connect();

$medicare = $_POST["medicareNum"];
$fname = $_POST["fName"];
$lname = $_POST["lName"];
$dob = $_POST["dob"];
$email = $_POST["email"];
$city = $_POST["city"];
$telNum = $_POST["telNum"];
$citizenship= $_POST["citizenship"];
$province = $_POST["province"];
$address = $_POST["address"];
$postal = $_POST["postal"];
$region = $_POST["region"];

$region_id = get_region_id($link,$region);

create_person($medicare,$fname,$lname,$dob,$email,$city,$telNum,$citizenship,$province,$address,$postal,$region_id,$link);

header('Location: ../view_patients_admin.php');
?>