<?php
include("database/db.php");
class register
{
	private $register;
	private $mysql;
	public function __construct()
	{
        $this->mysql = new mysqli('localhost', 'root');
        $this->mysql->select_db("demo");
		if(mysqli_connect_errno()){
			exit('Connection failed'.mysqli_connect_errno());
		}
		$this->register=array('email'=>'',
							'password'=>'',
							'name'=>'',
							'contact'=>'',
							'address'=>'',
							'image'=>'',
							'gender'=>'',
							'user_type'=>'',
							'status'=>''
							);
	}
	public function register($fields)
	{
		// print_r($fields);
		$this->register['email']=$fields['email'];
		$this->register['password']=$fields['password'];
		$this->register['name']=$fields['name'];
		$this->register['contact']=$fields['contact'];
		$this->register['address']=$fields['address'];
		$this->register['image']=$fields['image'];
		$this->register['gender']=$fields['gender'];
		$this->register['user_type']=$fields['user_type'];
		$this->register['status']=$fields['status'];
		$sql=sprintf("INSERT INTO `demo`.`login` ( `email`, `password`, `name`, `contact`,`address`, `image`,`gender`,`user_type`,`status`,`date_created`) 
						VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
					($this->register['email']),
					($this->register['password']),
					($this->register['name']),
					($this->register['contact']),
					($this->register['address']),
					($this->register['image']),
					($this->register['gender']),
					($this->register['user_type']),
					($this->register['status']),
					date('Y-m-d')

					);
			if($this->mysql->query($sql)===TRUE)
			{
					$flag = array('last_insert_id' => $this->mysql->insert_id,'status'=>1);
					return $flag;
			}
			else
			{
					$flag = array('last_insert_id' => $this->mysql->insert_id,'status'=>0);
					return $flag;
			}
			// mysql_free_result($result);
	}



	public function UpdateImageName($fields)
	{
		$sql=sprintf("UPDATE `login` SET `image` = '%s' WHERE `login`.`id` = '%d';",
			$fields['imagename'],
			$fields['id']);
		// $sql=sprintf("DELETE FROM `login` WHERE `login`.`id` = %d;",$fields['id']);


		if (mysqli_query($this->mysql, $sql)) {
			// echo "Record Updated successfully";
		} else {
			echo "Error updating record: " . mysqli_error($this->mysql);
		}
	   mysqli_close($this->mysql);
	}

	public function UpdateRegister($fields)
	{
		$sql=sprintf("UPDATE `login` SET `email` = '%s',`name` = '%s',`contact` = '%s',`address` = '%s',`gender` = '%s',`image` = '%s',`usertype` = '%d' WHERE `login`.`id` = '%d';",
			$fields['imagename'],
			$fields['id']);
		// $sql=sprintf("DELETE FROM `login` WHERE `login`.`id` = %d;",$fields['id']);


		if (mysqli_query($this->mysql, $sql)) {
			// echo "Record Updated successfully";
		} else {
			echo "Error updating record: " . mysqli_error($this->mysql);
		}
	   mysqli_close($this->mysql);
	}
}
// $as =new register();
// $data = array('imagename' => '1.jpg' , 'id'=>23);
// $as->UpdateImageName($data);
?>