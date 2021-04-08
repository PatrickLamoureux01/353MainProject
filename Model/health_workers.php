<?php

function create_health_worker($medicare,$adm,$link) {

    $pass = "7c4a8d09ca3762af61e59520943dc26494f8941b"; // default 123456

    $sql = "INSERT INTO publicHealthWorker(workerId,password,isAdmin) VALUES(?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'isi', $medicare, $pass,$adm);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function edit_health_worker($medicare, $isAdmin,$link)
{

    $sql = "UPDATE publicHealthWorker SET isAdmin = ? WHERE workerId = ?";
    $update_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($update_stmt, 'ii', $isAdmin, $medicare);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
}

function delete_health_worker($medicare, $link)
{

    $sql = "DELETE FROM publicHealthWorker WHERE workerId = ?";
    $delete_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($delete_stmt, 'i', $medicare);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);
}

function get_all_health_workers($link) {

    $sql = "SELECT * FROM person,publicHealthWorker WHERE person.medicareNum = publicHealthWorker.workerId";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($select_stmt);
    $workers = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $workers;
}

function check_admin($medicare, $link) {

    $sql = "SELECT isAdmin FROM publicHealthWorker WHERE workerId = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $medicare);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $isAdmin);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $isAdmin;
    
}
