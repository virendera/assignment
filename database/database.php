<?php
$mysqli = mysqli_connect('localhost', 'root' );

if(mysqli_connect_errno()){
	exit('Connection failed'.mysqli_connect_errno());
}

$sql=sprintf("CREATE DATABASE IF NOT EXISTS `demo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
if($mysqli->query($sql)===TRUE)
{
echo "Database created successfully";
}

else
{
	echo 'Error:'. $mysqli->error;
}


/* change db to demo db */
$mysqli->select_db("demo");

// /* return name of current default database */
// if ($result = $mysqli->query("SELECT DATABASE()")) {
//     $row = $result->fetch_row();
//     printf("Default database is %s.\n", $row[0]);
// }

 	$a =sprintf("CREATE TABLE IF NOT EXISTS `demo`.`login` ( `id` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(50) NOT NULL , `password` VARCHAR(20) NOT NULL , `name` VARCHAR(50) NOT NULL , `contact` BIGINT(10) NOT NULL , `address` VARCHAR(100) NOT NULL , `image` VARCHAR(100) NOT NULL , `gender` ENUM('M','F') NOT NULL , `user_type` TINYINT NOT NULL , `status` TINYINT NOT NULL , `date_created` DATE NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;");
	if($mysqli->query($a)===TRUE)
	{
		echo "tables created successfully";
	}
	else
	{
		echo "Error in table creation";
	}
$mysqli->close();

?>