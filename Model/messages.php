<?php

function insert_msg_covid_test_positive($datetime,$region,$person,$email,$description,$link) {

    $sql = "INSERT INTO messages(broadcastDateTime,region,person,emailAddress,oldAlertState,newAlertState,newGuidelines,description) VALUES(?,?,?,?,null,null,null,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'ssssssss',$datetime,$region,$person,$email,$description);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function insert_msg_covid_test_negative($datetime,$region,$person,$email,$description,$link) {

    $sql = "INSERT INTO messages(broadcastDateTime,region,person,emailAddress,oldAlertState,newAlertState,newGuidelines,description) VALUES(?,?,?,?,null,null,null,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'ssssssss',$datetime,$region,$person,$email,$description);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);
    
}

function insert_msg_alert_level_increase($datetime,$region,$person,$email,$oldAlert,$newAlert,$newMeasures,$description,$link) {

    $sql = "INSERT INTO messages(broadcastDateTime,region,person,emailAddress,oldAlertState,newAlertState,newGuidelines,description) VALUES(?,?,?,?,?,?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'ssssiiss',$datetime,$region,$person,$email,$oldAlert,$newAlert,$newMeasures,$description);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function insert_msg_alert_level_decrease($datetime,$region,$person,$email,$oldAlert,$newAlert,$newMeasures,$description,$link) {

    $sql = "INSERT INTO messages(broadcastDateTime,region,person,emailAddress,oldAlertState,newAlertState,newGuidelines,description) VALUES(?,?,?,?,?,?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'ssssiiss',$datetime,$region,$person,$email,$oldAlert,$newAlert,$newMeasures,$description);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

?>