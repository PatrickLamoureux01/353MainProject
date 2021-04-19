<?php
//Get a list of test dates for a given medicate number
function get_tests($link, $med){
    $sql = "SELECT testDate from diagnostic where patient = ? and (followedUp is null)";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $med);
    mysqli_stmt_execute($select_stmt);
    $tests = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $tests;
}

function get_pos_tests($link, $med){
    $sql = "SELECT testDate from diagnostic where patient = ? and testResult = 1";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $med);
    mysqli_stmt_execute($select_stmt);
    $tests = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $tests;
}

//Get a list of all symptoms
function get_all_symptoms($link){
    $sql="SELECT name, symptomID from symptoms";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_execute($select_stmt);
    $symptoms = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $symptoms;
}

//Update the diagnostic to add temperature and bool
function u_diag($med, $testDate, $today, $temp, $link){
    $sql = "UPDATE diagnostic SET followupTemperature = ?, followedUp = ? WHERE patient = ? AND testDate = ?";
    $update_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($update_stmt,'isis', $temp, $today, $med, $testDate);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
}

//Count all symptoms
function count_symptoms($link){
    $sql = "SELECT count(*) as c from symptoms";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_execute($select_stmt);
    $count = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $count;
}

//Creates one new symptom
function add_new_sympton($symptom, $link){
    $sql = "INSERT INTO symptoms(name, isCustom) values(?,1)";
    $i = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($i,'s', $symptom);
    mysqli_stmt_execute($i);
    mysqli_stmt_close($i);
}

//Get a symptomID from name name
function get_symptom_by_name($symptom_name, $link){
    $sql = "SELECT symptomID from symptoms where name = ?";
    $s = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($s, 's', $symptom_name);
    mysqli_stmt_execute($s);
    mysqli_stmt_bind_result($s,$id);
    mysqli_stmt_fetch($s);
    mysqli_stmt_close($s);
    return $id;
}

//Set a new symptom for a person
function person_set_symptom($med, $symptom, $recorded, $link){
    $sql = "INSERT INTO personSymptom(medicareNum, symptomID, lastRecorded) values(?,?,?)";
    // $sID = get_symptom_by_name($symptom, $link);
    $i = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($i, 'iis', $med, $symptom, $recorded);
    mysqli_stmt_execute($i);
    mysqli_stmt_close($i);
}

function get_test_symptoms($med, $testDate, $link){

    $sql = "SELECT ps.medicareNum,
    p.firstName,
    p.lastName, 
    date(ps.lastRecorded) as lastRecorded, 
    s.name as symptom,
    d.testDate
FROM personSymptom ps, person p, symptoms s, diagnostic d 
where ps.medicareNum = p.medicareNum 
    and d.followedUp = ps.lastRecorded 
    and s.symptomID = ps.symptomID
    and ps.medicareNum = ?
    and testDate = ?";

$select_stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($select_stmt, 'is', $med, $testDate);
mysqli_stmt_execute($select_stmt);
$symptoms = mysqli_stmt_get_result($select_stmt);
mysqli_stmt_close($select_stmt);

return $symptoms;

}

function get_tests_on_date($start,$end,$link) {

    $sql = "SELECT * FROM diagnostic WHERE resultDate BETWEEN ? AND ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'ss', $start,$end);
    mysqli_stmt_execute($select_stmt);
    $tests = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $tests;

}



//Select a person --> get the dates they were tested