<?php
include("database/db.php");
class Login
{
	private $fields;
	protected $mysql;
	public function __construct()
	{
		$this->mysql = new mysqli('localhost', 'root');
		$this->mysql->select_db("demo");
		$this->fields=array('id'=>null,
							'email'=>'',
							'password'=>'',
							'logged'=>false,
							'status'=>0,
							'name'=>null,
							'usertype'=>null,
							'address'=>null,
							'image'=>null,
							'contact'=>null,
							'gender'=>null,
							);
	}
	public function check($email,$password)
	{
		$this->fields['email']=$email;
		$this->fields['password']=$password;
		$query=sprintf("select id,name,image,gender,contact,address,user_type,status from login where email='%s' and password='%s'",
						($this->fields['email']),
						($this->fields['password'])
					  );
		$result = mysqli_query($this->mysql,$query) or die(mysqli_error($this->mysql));
		$rows = mysqli_num_rows($result);
		if($rows>0)
			{
				$row=mysqli_fetch_assoc($result);
				$this->fields['status']=$row['status'];
				if($this->fields['status']==1)
				{
					$this->fields['id']=$row['id'];
					$this->fields['logged']=true;
					$this->fields['name']=$row['name'];
					$this->fields['email']=$this->fields['email'];
					$this->fields['image']=$row['image'];
					$this->fields['gender']=$row['gender'];
					$this->fields['usertype']=$row['user_type'];
					$this->fields['contact']=$row['contact'];
					$this->fields['address']=$row['address'];
				}
				else
				{
					echo "Your Account is not activated by Administrator.";
					echo 'click <a href="index.php">'.'here</a> for login';
					exit(0);
				}
			}
		else
			{
				echo "Please Register first";
			}
			mysqli_free_result($result);
		// print_r($this->fields);
	}
	public function islogged()
	{
		if($this->fields['logged']===true)
		{	
			$_SESSION['logged']=1;
			$_SESSION['id']=$this->fields['id'];
			$_SESSION['email']=$this->fields['email'];
			$_SESSION['name']=$this->fields['name'];
			$_SESSION['image']=$this->fields['image'];
			$_SESSION['gender']=$this->fields['gender'];
			$_SESSION['usertype']=$this->fields['usertype'];
			$_SESSION['contact']=$this->fields['contact'];
			$_SESSION['address']=$this->fields['address'];
			$expire=time() +(60*60*24*30);
		}
		else
		{	
			$_SESSION['logged']=0;
		}
	}
	public function users()
	{
		$query=sprintf("select id,name,image,gender,contact,address,user_type,status from login WHERE user_type !=1" );
		$result = mysqli_query($this->mysql,$query) or die(mysqli_error($this->mysql));
		while($obj = $result->fetch_object()){ 
			if($obj->status==0)
			{
				$btn=sprintf("<a href='menu.php?action=approve&id=%d' class='btn btn-success'>Accept</a>",$obj->id);
			}
			else if ($obj->status==1)
			{
				$btn=sprintf("<a href='menu.php?action=reject&id=%d' class='btn btn-danger'>Reject</a>",$obj->id);
			}
			$users=sprintf("<li>
				<div class='container'>
					<div class='row'>
						<div class='col-md-2'>%d</div>
						<div class='col-md-2'>
								<img class='card-profile-img' style='height:50px;width:50px;' src='img/%s'></img>
						</div>
						<div class='col-md-2'>%s</div>
						<div class='col-md-2'>%s</div>
						<div class='col-md-2'>%s %s </div>
						<div class='col-md-2'>%s</div>
					</div>
				</div></li>",$obj->id,$obj->image, $obj->name,$obj->gender,$obj->address,$obj->user_type,$btn);
            echo $users;
         } 
			mysqli_free_result($result);
	}
	public function approve($userid)
	{
		  $sql=sprintf("UPDATE `login` SET `status` = '%d' WHERE `login`.`id` = '%d';",1,$userid);
		if (mysqli_query($this->mysql, $sql)) {
			return 1;
		} else {
			return 0;
		}
	   mysqli_close($this->mysql);
	}
	public function reject($userid)
	{
		  $sql=sprintf("UPDATE `login` SET `status` = '%d' WHERE `login`.`id` = '%d';",0,$userid);
		if (mysqli_query($this->mysql, $sql)) {
			return 1;
		} else {
			return 0;
		}
	   mysqli_close($this->mysql);
	}
}
// $login= new Login();
// $login->check('asdf@adf.com','asfd3242');
// $login->islogged(); 
?>