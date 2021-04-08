<?php

function get_all_cities($link) {

    $sql = "SELECT name FROM city";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_execute($select_stmt);
    $cities = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);
    
    return $cities;
}

function get_postal_codes_by_city($city,$link) {

    $sql = "SELECT postalCode FROM cityPostal WHERE cityID = (SELECT cityID FROM city WHERE name = ?)";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($select_stmt, 's', $city);
    mysqli_stmt_execute($select_stmt);
    $codes = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);
    
    return $codes;

}

?>