<?php
$servername = "localhost:3308";
$username = "qdc353_4";
$password = "Cx4273Dh";
$dbname = "qdc353_4";

// Create connection

class dbmysqli {
  function connect() {
    $link = mysqli_connect("localhost:3308","qdc353_4","Cx4273Dh","qdc353_4");
    if (!$link) {
      die('Error 001: Could not connect: '. mysqli_error($link));
    }
    return $link;
  }
}


?>
