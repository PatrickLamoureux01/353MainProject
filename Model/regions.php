<?php

function get_all_regions($link) {

    $sql = "SELECT name FROM region";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_execute($select_stmt);
    $regions = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);
    
    return $regions;
}

function get_region_id($link,$name) {

    $sql = "SELECT regionID FROM region WHERE name = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 's', $name);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $id);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $id;
}
?>