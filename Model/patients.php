<?php

function create_person($medicare, $fname, $lname, $dob, $email, $city, $telNum, $citizenship, $province, $address, $postal, $region, $link)
{

    $sql = "INSERT INTO person(medicareNum,firstName,lastName,dob,email,city,telNum,citizenship,province,address,postalCode,region) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
    $insert_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($insert_stmt, 'issssssssssi',$medicare,$fname,$lname,$dob,$email,$city,$telNum,$citizenship,$province,$address,$postal,$region);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);
}

function get_Fname($link, $medicare)
{

    $sql = "SELECT firstName FROM person WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $medicare);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $fname);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $fname;
}

function get_full_name($link, $medicare)
{

    $sql = "SELECT firstName,lastName FROM person WHERE medicareNum = ?";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($select_stmt, 'i', $medicare);
    mysqli_stmt_execute($select_stmt);
    mysqli_stmt_bind_result($select_stmt, $fname, $lname);
    mysqli_stmt_fetch($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $fname . ' ' . $lname;
}

function get_all_patients($link)
{

    $sql = "SELECT * FROM person";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($select_stmt);
    $patients = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $patients;
}
