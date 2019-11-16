<?php
class Logout
{
	private $fields;
	public function __construct()
	{
		$this->fields=array('expire'=>null,
							'email'=>null,
							'password'=>'',
							'logged'=>0
							);
		
	}
	public function logout()
	{
			$this->expire=time() -1000;
			setcookie('email',null,$this->fields['expire']);
			setcookie('password',null,$this->fields['expire']);
			$_SESSION['logged']=$this->fields['logged'];
			$_SESSION['email']=$this->fields['email'];
			session_unset();
			unset($expire);
			header('Refresh:0;URL=login.php');
			session_destroy();
			exit();
	}
}
?>