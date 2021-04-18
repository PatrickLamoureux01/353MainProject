<?php
include_once('../header.php');

$db = new dbmysqli();
$link = $db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicare = $_POST["medicareNum"];
    $testDate = $_POST["test"];
    $today = $_POST["today"];
    $temp = $_POST["temperature"];

    //Update the diagnostic entry
    u_diag($medicare, $testDate, $today, $temp, $link);

    if (isset($_POST["otherSymps"])) {
        $new_symp = explode(",", $_POST["otherSymps"]);
        //Add the new symptoms to the symptom table
        foreach ($new_symp as $s) {
            add_new_sympton($s, $link);
        }
        //Associate a patient with these new symptoms
        foreach ($new_symp as $xx){
            $id = get_symptom_by_name($xx, $link);
            person_set_symptom($medicare, $id, $today, $link);
        }
    }

    //Associate a patient with existing symptoms
    if (isset($_POST["symptoms"])) {
        foreach($_POST["symptoms"] as $id){
            person_set_symptom($medicare, $id, $today, $link);
        }
    }

    if($_GET["u"]=="p"){header('Location: ../patient-index.php');}
    else if($_GET["u"]=="hc"){header('Location: ../Person/hcw_followup.php');}

    

}
