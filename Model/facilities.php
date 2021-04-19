<?php

function create_health_center($id,$name,$phone,$type,$address,$website,$drivethru,$adminType,$link) {

    $sql = "INSERT INTO publicHealthCenter(facilityId,name,phoneNum,type,address,website,doesDriveThru,adminType) VALUES(?,?,?,?,?,?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'isssssii',$id,$name,$phone,$type,$address,$website,$drivethru,$adminType);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function edit_health_center($id,$name,$phone,$type,$address,$website,$drivethru,$adminType,$link)
{

    $sql = "UPDATE publicHealthCenter SET name = ?, phoneNum = ?, type = ?, address = ?, website = ?, doesDriveThru = ?, adminType = ? WHERE facilityId = ?";
    $update_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($update_stmt, 'sssssiii', $name,$phone,$type,$address,$website,$drivethru,$adminType,$id);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
}

function delete_health_center($id, $link)
{

    $sql = "DELETE FROM publicHealthCenter WHERE facilityId = ?";
    $delete_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($delete_stmt, 'i', $id);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);
}

function get_all_health_centers($link) {

    $sql = "SELECT * FROM publicHealthCenter";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($select_stmt);
    $facilities = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $facilities;
}

function get_facility_by_id($id,$link) {

    $sql = "SELECT * FROM publicHealthCenter WHERE facilityId = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $facility = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $facility;

}

function get_facility_id_by_name($name,$link) {

    $sql = "SELECT facilityId FROM publicHealthCenter WHERE name = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 's', $name);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $id);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $id;

}

function doesDriveThru($id,$link) {

    $sql = "SELECT doesDriveThru FROM publicHealthCenter WHERE facilityId = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $drivethru);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $drivethru;

}

function get_number_of_emps($id,$link) {

    $sql = "SELECT workerId FROM workedAt WHERE facilityId = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $worker = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return mysqli_num_rows($worker);

}

function get_all_workers_of_facility($id,$link) {

    $sql = "SELECT workerId FROM workedAt WHERE facilityId = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $workers = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $workers;

}

function get_all_facilities_worked_at_14_days($id,$start,$end,$link) {

    $sql = "SELECT facilityId FROM workedAt WHERE workerId = ? AND startDatetime >= ? AND endDatetime <= ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'iss', $id,$start,$end);
    mysqli_stmt_execute($select_stmt);
    $facilities = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $facilities;

}



