<?php
include("database/db.php");
class login
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
					echo 'click <a href="login.php">'.'here</a> for login';
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

}

// $login= new login();
// $login->check('asdf@adf.com','asfd3242');
// $login->islogged(); 


?>