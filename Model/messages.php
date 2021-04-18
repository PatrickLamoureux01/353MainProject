<?php

function insert_msg_covid_test_positive($datetime,$region,$person,$email,$link) {

    $description = "Your COVID-19 test has came back positive. Please follow the appropriate measures sent in the following message.";
    $sql = "INSERT INTO messages(broadcastDateTime,region,person,emailAddress,oldAlertState,newAlertState,newGuidelines,description) VALUES(?,?,?,?,null,null,null,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'sssss',$datetime,$region,$person,$email,$description);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function insert_msg_covid_test_negative($datetime,$region,$person,$email,$link) {

    $description = "Your COVID-19 test has came back negative.";
    $sql = "INSERT INTO messages(broadcastDateTime,region,person,emailAddress,oldAlertState,newAlertState,newGuidelines,description) VALUES(?,?,?,?,null,null,null,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'sssss',$datetime,$region,$person,$email,$description);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);
    
}

function insert_msg_alert_level_increase($datetime,$region,$person,$email,$oldAlert,$newAlert,$newMeasures,$link) {

    $description = "The alert level for your region has increased. Please follow the guidelines corresponding to the alert level of your region.";
    $sql = "INSERT INTO messages(broadcastDateTime,region,person,emailAddress,oldAlertState,newAlertState,newGuidelines,description) VALUES(?,?,?,?,?,?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'ssssiiss',$datetime,$region,$person,$email,$oldAlert,$newAlert,$newMeasures,$description);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function insert_msg_alert_level_decrease($datetime,$region,$person,$email,$oldAlert,$newAlert,$newMeasures,$link) {

    $description = "The alert level for your region has decreased. Please follow the guidelines corresponding to the alert level of your region.";
    $sql = "INSERT INTO messages(broadcastDateTime,region,person,emailAddress,oldAlertState,newAlertState,newGuidelines,description) VALUES(?,?,?,?,?,?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'ssssiiss',$datetime,$region,$person,$email,$oldAlert,$newAlert,$newMeasures,$description);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function insert_msg_questionnaire_reminder($datetime,$region,$person,$email,$link) {

    $description = "You will need to fill out a questionnaire within the next 14 days so that we can keep a tab of the evolution of your COVID-19 case. Please log in to the COVID-19 dashboard with your medicare number and DOB to fill out the questionnaire, or follow up with a healthcare worker so that they could fill it up for you.";
    $sql = "INSERT INTO messages(broadcastDateTime,region,person,emailAddress,oldAlertState,newAlertState,newGuidelines,description) VALUES(?,?,?,?,null,null,null,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'sssss',$datetime,$region,$person,$email,$description);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

function insert_msg_exposed_to_positive($datetime,$region,$person,$email,$link) {

    $description = "Our records show that you have been in contact with somebody who has tested positive for COVID-19. Please monitor your symptoms and get yourself tested.";
    $sql = "INSERT INTO messages(broadcastDateTime,region,person,emailAddress,oldAlertState,newAlertState,newGuidelines,description) VALUES(?,?,?,?,null,null,null,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'sssss',$datetime,$region,$person,$email,$description);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);

}

?>