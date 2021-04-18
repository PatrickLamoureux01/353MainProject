<?php
include_once('../header.php');

$db = new dbmysqli();
$link = $db->connect();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $med = $_POST["medicareNum"];
    $testDate = $_POST["test"];
    $list = get_test_symptoms($med,$testDate,$link);
    foreach($list as $e){
        echo $e["symptom"];
    }

    // header("Location: /");
}