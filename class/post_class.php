<?php
include("database/db.php");
class POST
{
	private $post;
	private $mysql;
	public function __construct()
	{
        $this->mysql = new mysqli('localhost', 'root');
        $this->mysql->select_db("demo");
		if(mysqli_connect_errno()){
			exit('Connection failed'.mysqli_connect_errno());
		}
		$this->post=array('loginid'=>'',
							'message'=>'',
							'image'=>'NULL',
							'user_type'=>'',
							'date_created'=>date('Y-m-d')
							);
	}
	public function createPost($fields)
	{
		$this->post['loginid']=$fields['loginid'];
		$this->post['message']=$fields['message'];
		$this->post['user_type']=$fields['user_type'];
		$sql=sprintf("INSERT INTO `demo`.`post` ( `loginid`, `message`, `image`, `user_type`,`date_created`) 
						VALUES ('%d','%s','%s','%d','%s')",
					($this->post['loginid']),
					($this->post['message']),
					($this->post['image']),
					($this->post['user_type']),
					($this->post['date_created'])
					);
		echo $sql;
			if($this->mysql->query($sql)===TRUE)
			{
				return 1;
			}
			else
			{
				return 0;
			}
			mysql_free_result($result);
	}
	public function UpdatePosts($fields)
	{
	}
	function AdminPostsShow()
	{
		$query=sprintf("select * from post WHERE user_type=1 or user_type=2" );
		$result = mysqli_query($this->mysql,$query) or die(mysqli_error($this->mysql));
		while($obj = $result->fetch_object()){ 
			$adminPost=sprintf("<li>
				<div class='container'>
					<div class='row'>
						<div class='col-md-3'>%d</div>
						<div class='col-md-6'>%s</div>
						<div class='col-md-3'><em>%s</em></div>
					</div>
				</div></li>",$obj->id,$obj->message,$obj->date_created);
            print_r($adminPost);
         } 
			mysqli_free_result($result);
	}
	public function UserPostsShow()
	{
		$query=sprintf("select * from post" );
		$result = mysqli_query($this->mysql,$query) or die(mysqli_error($this->mysql));
		while($obj = $result->fetch_object()){ 
			$userPost=sprintf("<li>
				<div class='container'>
					<div class='row'>
						<div class='col-md-3'>%d</div>
						<div class='col-md-6'>%s</div>
						<div class='col-md-3'><em>%s</em></div>
					</div>
				</div></li>",$obj->id,$obj->message,$obj->date_created);
            print_r($userPost);
         } 
			mysqli_free_result($result);
	}
}
// $post =new Post();
// $data = array('loginid' => '1' , 'message'=>'happy','user_type'=>2);
// $post->createPost($data);
// $post->AdminPostsShow();
// $post->UserPostsShow();
?>