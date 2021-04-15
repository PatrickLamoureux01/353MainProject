<?php

function get_tests($link, $med){
    $sql = "SELECT date(testDate) as testDate from diagnostic where patient = ? and (followedUp is null or followedUp = 0)";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $med);
    mysqli_stmt_execute($select_stmt);
    $tests = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $tests;

}


function get_all_symptoms($link){
    $sql="SELECT name from symptoms";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_execute($select_stmt);
    $symptoms = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $symptoms;
}
