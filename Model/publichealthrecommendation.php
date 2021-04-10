<?php

function create_public_health_rec($id,$rec,$alertlev,$link) {

    $sql = "INSERT INTO publicHealthRecommendation(recommendationID,recommendation,alertLevel) VALUES(?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'isi',$id,$rec,$alertlev);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function edit_public_health_rec($id,$rec,$alertlev,$link)
{

    $sql = "UPDATE publicHealthRecommendation SET recommendation = ?, alertLevel = ? WHERE recommendationID = ?";
    $update_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($update_stmt, 'sii', $rec, $alertlev, $id);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
}

function delete_public_health_rec($id, $link)
{

    $sql = "DELETE FROM publicHealthRecommendation WHERE recommendationID = ?";
    $delete_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($delete_stmt, 'i', $id);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);
}

function get_all_public_health_rec($link) {

    $sql = "SELECT * FROM publicHealthRecommendation";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($select_stmt);
    $healthrec = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $healthrec;
}

function get_public_health_rec_by_id($id,$link) {

    $sql = "SELECT * FROM publicHealthRecommendation WHERE recommendationID = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $healthrec = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $healthrec;

}



