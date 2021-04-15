<?php

function create_city($id,$name,$link) {

    $sql = "INSERT INTO city(cityID,name) VALUES(?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'is',$id,$name);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function edit_city($id,$name,$link)
{

    $sql = "UPDATE city SET name = ? WHERE cityID = ?";
    $update_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($update_stmt, 'si', $name,$id);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
}

function delete_city($id, $link)
{

    $sql = "DELETE FROM city WHERE cityID = ?";
    $delete_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($delete_stmt, 'i', $id);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);
}

function insert_city_postal($cityID,$postalCode,$link) {

    $sql = "INSERT INTO cityPostal(cityID,postalCode) VALUES(?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'is',$cityID,$postalCode);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function get_all_cities($link) {

    $sql = "SELECT * FROM city";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_execute($select_stmt);
    $cities = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);
    
    return $cities;
}

function get_postal_codes_by_city($link,$city) {

    $sql = "SELECT postalCode FROM cityPostal WHERE cityID = (SELECT cityID FROM city WHERE name = ?)";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($select_stmt, 's', $city);
    mysqli_stmt_execute($select_stmt);
    $codes = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);
    
    return $codes;

}

function get_postal_codes_by_city_id($id,$link) {

    $sql = "SELECT code FROM postalCode WHERE code IN (SELECT postalCode FROM cityPostal WHERE cityID = ?)";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $codes = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);
    
    return $codes;

}

function get_cities_in_region($id,$link) {

    $sql = "SELECT * FROM city WHERE cityID IN (SELECT cityID FROM regionCity WHERE regionID = ?)";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $cities = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);
    
    return $cities;

}

function delete_cities_from_region($id,$link) {

    $sql = "DELETE FROM regionCity WHERE regionID = ?";
    $delete_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($delete_stmt, 'i', $id);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);

}

function delete_codes_from_city($id,$link) {

    $sql = "DELETE FROM cityPostal WHERE cityID = ?";
    $delete_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($delete_stmt, 'i', $id);
    mysqli_stmt_execute($delete_stmt);
    mysqli_stmt_close($delete_stmt);

}

function get_all_postal_codes($link) {

    $sql = "SELECT * FROM postalCode";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_execute($select_stmt);
    $codes = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);
    
    return $codes;

}

function get_city_by_id($id,$link) {

    $sql = "SELECT * FROM city WHERE cityID = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);
    $city = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $city;

}

?>