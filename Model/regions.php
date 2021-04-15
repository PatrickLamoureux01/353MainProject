<?php

function create_region($id,$name,$alert,$link) {

    $sql = "INSERT INTO region(regionID,name,alertLevel) VALUES(?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'isi',$id,$name,$alert);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function edit_region($id,$name,$alert,$link)
{

    $sql = "UPDATE region SET name = ?, alertLevel = ? WHERE regionID = ?";
    $update_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($update_stmt, 'sii', $name,$alert,$id);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
}

function delete_region($id, $link)
{

    $sql = "DELETE FROM region WHERE regionID = ?";
    $delete_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($delete_stmt, 'i', $id);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);
}

function insert_region_city($regionID,$cityID,$link) {

    $sql = "INSERT INTO regionCity(regionID,cityID) VALUES(?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'ii',$regionID,$cityID);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function get_all_regions($link) {

    $sql = "SELECT * FROM region";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($select_stmt);
    $regions = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $regions;
}

function get_region_id_by_name($link,$name) {

    $sql = "SELECT regionID FROM region WHERE name = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 's', $name);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $id);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $id;
}

function get_region_name_by_id($link,$id) {

    $sql = "SELECT name FROM region WHERE regionID = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $name);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $name;

}

function get_region_by_id($id,$link) {

    $sql = "SELECT * FROM region WHERE regionID = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $region = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $region;

}

function get_current_alert_level($id,$link) {

    $sql = "SELECT alertLevel FROM region WHERE regionID = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $alert);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $alert;

}

function get_all_people_in_region($id,$link) {

    $sql = "SELECT * FROM person WHERE person.postalCode = cityPostal.postalCode AND cityPostal.cityID = regionCity.cityID AND regionCity.regionID = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $people = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $people;

}
?>