<?php

function create_health_center($medicare,$adm,$link) {

    $pass = "7c4a8d09ca3762af61e59520943dc26494f8941b"; // default 123456

    $sql = "INSERT INTO publicHealthWorker(workerId,password,isAdmin) VALUES(?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'isi', $medicare, $pass,$adm);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function edit_health_center($medicare, $isAdmin,$link)
{

    $sql = "UPDATE publicHealthWorker SET isAdmin = ? WHERE workerId = ?";
    $update_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($update_stmt, 'ii', $isAdmin, $medicare);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
}

function delete_health_center($medicare, $link)
{

    $sql = "DELETE FROM publicHealthWorker WHERE workerId = ?";
    $delete_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($delete_stmt, 'i', $medicare);
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

