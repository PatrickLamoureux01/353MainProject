<?php

function validate_patient($link,$medicare,$dob) {

    $sql = "SELECT firstName,lastName FROM person WHERE medicareNum = ? AND dob = ?";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($select_stmt,'is',$medicare,$dob);
    mysqli_stmt_execute($select_stmt);

    if ($check = mysqli_stmt_fetch($select_stmt)) {
            return 1;
    }
    else {
        if (is_null($check)) { // null means no rows were found, so invalid user
            return 0;
        }
    }
    mysqli_stmt_close($select_stmt);
}

function validate_healthcare($link,$medicare,$pass) {

    $sha1pw = sha1($pass);
    $sql = "SELECT isAdmin FROM publicHealthWorker WHERE workerId = ? AND password = ?";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($select_stmt,'is',$medicare,$sha1pw);
    mysqli_stmt_execute($select_stmt);

    if ($check = mysqli_stmt_fetch($select_stmt)) {
            return 1;
    }
    else {
        if (is_null($check)) { // null means no rows were found, so invalid user
            return 0;
        }
    }
    mysqli_stmt_close($select_stmt);
}

function isAdmin($link,$medicare) {

    $sql = "SELECT isAdmin FROM publicHealthWorker WHERE workerId = ?";
    $select_stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($select_stmt,'i',$medicare);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt,$adminBit);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);
    
    return $adminBit;		
}


?>