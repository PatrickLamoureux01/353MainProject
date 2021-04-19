<?php

function create_group_zone($id,$name,$link) {

    $sql = "INSERT INTO groupZone(id,name) VALUES(?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'is',$id,$name);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function edit_group_zone($id,$name,$link)
{

    $sql = "UPDATE groupZone SET name = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($update_stmt, 'si', $name,$id);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
}

function delete_group_zone($id, $link)
{

    $sql = "DELETE FROM groupZone WHERE id = ?";
    $delete_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($delete_stmt, 'i', $id);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);
}

function get_all_group_zones($link) {

    $sql = "SELECT * FROM groupZone";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($select_stmt);
    $groupzones = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $groupzones;
}

function get_group_zone_by_id($id,$link) {

    $sql = "SELECT * FROM groupZone WHERE id = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $groupzone = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $groupzone;

}

function get_gz_name_by_id($id,$link) {

    $sql = "SELECT name FROM groupZone WHERE id = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $name);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $name;

}

function get_all_people_in_group_zone_except_yourself($id,$medicare,$link) {

    $sql = "SELECT medicareNum FROM inGroup WHERE groupZoneId = ? AND medicareNum <> ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'ii', $id,$medicare);
    mysqli_stmt_execute($select_stmt);
    $people = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $people;

}

function get_all_groupzones_of_one_person($id,$link) {

    $sql = "SELECT groupZoneId FROM inGroup WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $zones = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $zones;

}

function add_person_to_gz($id,$gz,$link) {

    $sql = "INSERT INTO inGroup(medicareNum,groupZoneId) VALUES(?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'ii',$id,$gz);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function are_they_in_gz_already($id,$gz,$link) {

    $sql = "SELECT * FROM inGroup WHERE medicareNum = ? AND groupZoneId = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'ii', $id,$gz);
    mysqli_stmt_execute($select_stmt);
    $g = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $g;

}



