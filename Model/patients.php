<?php

function create_person($medicare, $fname, $lname, $dob, $email, $telNum, $citizenship, $province, $address, $postal, $link)
{

    $sql = "INSERT INTO person(medicareNum,firstName,lastName,dob,email,telNum,citizenship,province,address,postalCode) VALUES(?,?,?,?,?,?,?,?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'isssssssss', $medicare, $fname, $lname, $dob, $email, $telNum, $citizenship, $province, $address, $postal);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);
}

function edit_person($medicare, $fname, $lname, $dob, $email, $telNum, $citizenship, $province, $address, $postal, $link)
{

    $sql = "UPDATE person SET firstName = ?, lastName = ?, dob = ?, email = ?, telNum = ?, citizenship = ?, province = ?, address = ?, postalCode = ? WHERE medicareNum = ?";
    $update_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($update_stmt, 'sssssssssi', $fname, $lname, $dob, $email, $telNum, $citizenship, $province, $address, $postal, $medicare);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
}

function delete_person($medicare, $link)
{

    $sql = "DELETE FROM person WHERE medicareNum = ?";
    $delete_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($delete_stmt, 'i', $medicare);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);
}

function get_Fname($link, $medicare)
{

    $sql = "SELECT firstName FROM person WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $medicare);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $fname);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $fname;
}

function get_Lname($link, $medicare)
{

    $sql = "SELECT lastName FROM person WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $medicare);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $lname);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $lname;
}

function get_dob($link, $medicare)
{

    $sql = "SELECT dob FROM person WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $medicare);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $dob);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $dob;
}

function get_tel($link, $medicare)
{

    $sql = "SELECT telNum FROM person WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $medicare);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $tel);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $tel;
}

function get_full_name($link, $medicare)
{

    $sql = "SELECT firstName,lastName FROM person WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $medicare);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $fname, $lname);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $fname . ' ' . $lname;
}

function get_all_patients($link)
{

    $sql = "SELECT * FROM person";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($select_stmt);
    $patients = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $patients;
}

function get_all_patients_except_yourself($id, $link)
{

    $sql = "SELECT * FROM person WHERE medicareNum <> ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $patients = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $patients;
}

function get_patient_by_medicare($link, $medicare)
{

    $sql = "SELECT * FROM person WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $medicare);
    mysqli_stmt_execute($select_stmt);
    $patient = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $patient;
}

function does_person_already_exist($medicare, $link)
{

    $sql = "SELECT firstName FROM person WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $medicare);
    mysqli_stmt_execute($select_stmt);

    if ($check = mysqli_stmt_fetch($select_stmt)) {
        return 1;
    } else {
        if (is_null($check)) { // null means no rows were found, so invalid person
            return 0;
        }
    }
    mysqli_stmt_close($select_stmt);
}

function create_test($testDate,$patient,$adminBy,$facility,$link)
{

    $sql = "INSERT INTO diagnostic(testDate,resultDate,testResult,patient,adminBy,facilityId,followupTemperature,followedUp) VALUES(?,null,null,?,?,?,null,null)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'siii', $testDate,$patient,$adminBy,$facility);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);
}

function log_test_result($patient,$testDate,$result,$resultDate,$link) {

    $sql = "UPDATE diagnostic SET resultDate = ?, testResult = ? WHERE patient = ? AND testDate = ?";
    $update_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($update_stmt, 'siis', $resultDate,$result,$patient,$testDate);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);

}

function get_all_patients_awaiting_results($link) {

    $sql = "SELECT patient,testDate FROM diagnostic WHERE testResult IS NULL";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($select_stmt);
    $patients = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $patients;

}

function get_email($id,$link) {

    $sql = "SELECT email FROM person WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $email);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $email;

}

function get_people_by_address($address,$link) {

    $sql = "SELECT * FROM person WHERE address = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 's', $address);
    mysqli_stmt_execute($select_stmt);
    $people = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $people;
}

function get_mother($id,$link) {

    $sql = "SELECT firstName,lastName FROM person WHERE person.medicareNum = (SELECT motherMedicareNum FROM parentOf WHERE personMedicareNum = ?)";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt,$fname,$lname);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $fname." ".$lname;

}

function get_father($id,$link) {

    $sql = "SELECT firstName,lastName FROM person WHERE person.medicareNum = (SELECT fatherMedicareNum FROM parentOf WHERE personMedicareNum = ?)";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt,$fname,$lname);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $fname." ".$lname;

}
?>