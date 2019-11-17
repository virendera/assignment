<?php
include 'config.php';
$mysqli = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD);
 if(! $mysqli ) {
      die('Could not connect: ' . mysqli_error());
   }
$mysqli->select_db("demo");
?>