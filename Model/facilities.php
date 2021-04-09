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

