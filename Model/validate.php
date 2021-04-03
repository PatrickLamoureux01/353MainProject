<?php
include_once('connect.php');
include_once('user.php');

$db = new dbmysqli();
$link = $db->connect();

$sourcePage = $_POST["sourcePage"];

if ($sourcePage == "patient") {

    $medicare = $_POST["medicare_num"];
    $pass = $_POST["dob"];

    $day = substr($pass, 0, 2);
    $month = substr($pass, 2, 2);
    $year = substr($pass, 4, 4);

    $dob = $year . '-' . $month . '-' . $day;

    $validBit = validate_patient($link, $medicare, $dob);

    if ($validBit == "1" && strlen($pass) == 8) {
        session_start();
        header("Location: ../patient-index.php");
        $_SESSION["User"] = $medicare;
    } else {
        header("Location: ../patient-login.php?status=1001");
    }
} else if ($sourcePage == "healthcare") {

    $medicare = $_POST["medicare_num"];
    $pass = $_POST["password"];

    $validBit = validate_healthcare($link, $medicare, $pass);

    if ($validBit == "1") {
        session_start();
        header("Location: ../healthcare-index.php");
        $_SESSION["User"] = $medicare;
    } else {
        header("Location: ../healthcare-login.php?status=1001");
    }
} else {

    $medicare = $_POST["medicare_num"];
    $pass = $_POST["password"];

    $adminBit = isAdmin($link,$medicare);
    $validBit = validate_healthcare($link, $medicare, $pass);

    if ($adminBit == "1") {
        if ($validBit == "1"){
            session_start();
            header("Location: ../admin-index.php");
            $_SESSION["User"] = $medicare;
        } else {
            header("Location: ../admin-login.php?status=1001");
        }  
    } else {
        header("Location: ../admin-login.php?status=2001");
    }
}
