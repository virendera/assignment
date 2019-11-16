<?php
if(!defined('MYSQL_HOST'))
{
	define('MYSQL_HOST','localhost');
}
if(!defined('MYSQL_USER'))
{
	define('MYSQL_USER','root');
}
if(!defined('MYSQL_PASSWORD'))
{
	define('MYSQL_PASSWORD','');
}
if(!defined('MYSQL_DB'))
{
	define('MYSQL_DB','demo');
}
#$_SERVER['SERVER_NAME']

$mysqli = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD);

 if(! $mysqli ) {
      die('Could not connect: ' . mysqli_error());
   }
$mysqli->select_db("demo");
?>