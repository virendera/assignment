<?php 
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Database</title>
	  <link rel="stylesheet" href="../style/bootstrap.min.css" type="text/css">
</head>
<body>
<div>
<?php
$mysqli = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD);
if(mysqli_connect_errno()){
	exit('<p class="btn-danger">Connection failed</p>'.mysqli_connect_errno());
}
$sql=sprintf("CREATE DATABASE IF NOT EXISTS `demo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
if($mysqli->query($sql)===TRUE)
{
	echo "<p class='btn-success'>Database created successfully<p>";
}
else
{
	echo 'Error:'. $mysqli->error;
}
$mysqli->select_db("demo");
$sql =sprintf("CREATE TABLE IF NOT EXISTS `demo`.`login` ( `id` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(50) NOT NULL , `password` VARCHAR(20) NOT NULL , `name` VARCHAR(50) NOT NULL , `contact` BIGINT(10) NOT NULL , `address` VARCHAR(100) NOT NULL , `image` VARCHAR(100) NOT NULL , `gender` ENUM('M','F') NOT NULL , `user_type` TINYINT NOT NULL , `status` TINYINT NOT NULL , `date_created` DATE NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;");
if($mysqli->query($sql)===TRUE)
{
	echo "<p class='btn-success'>login table created successfully</p>";
}
else
{
	echo "<p class='btn-danger'>Error in table creation</p>";
}
$sql =sprintf("CREATE TABLE IF NOT EXISTS `demo`.`post` ( `id` INT NOT NULL AUTO_INCREMENT , `loginid` VARCHAR(50) NOT NULL , `message` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `image` VARCHAR(100) NOT NULL , `user_type` TINYINT NOT NULL ,  `date_created` DATE NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;");
if($mysqli->query($sql)===TRUE)
{
	echo "<p class='btn-success'>Post table created successfully</p>";
}
else
{
	echo "<p class='btn-danger'>Error in Post table creation</p>";
}


$sql =sprintf("CREATE EVENT Delete_login
				ON SCHEDULE EVERY 7 DAY -- interval
				COMMENT 'Event deletes login records after 7 days.'
				DO
				BEGIN
				DELETE FROM login WHERE DATEDIFF(NOW(), date_created) >= 7;
				END");
if($mysqli->query($sql)===TRUE)
{
	echo "<p class='btn-success'>After 7 days register user deleted event created successfully:)</p>";

}
else
{
	echo "<p class='btn-danger'>Error in delete event creation</p>";
}

$sql =sprintf("INSERT INTO `demo`.`login` (`id`,`email`,`password`,`name`,`contact`,`address`,`image`,`gender`,`user_type`,`status`,`date_created`) VALUES (NULL,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",'admin@gmail.com','admin','admin','99999999','Delhi','user.png','M','1','1',date('Y-m-d'));
if($mysqli->query($sql)===TRUE)
{
	echo "<p class='btn-success'>Administrator account created successfully:)</p>";
	echo "<p class='text-center text-muted'> <b>Email=</b></i>admin@gmail.com</i></p>";
	echo "<p class='text-center text-muted'> <b>Password=</b></i>admin</i></p>";
}
else
{
	echo "<p class='btn-danger'>Insert error in login table</p>";
}
$mysqli->close();
		echo '</br>Please login first <a href="../index.php">here</a>';
?>
</div>
</body>
</html>