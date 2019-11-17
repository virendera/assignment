<?php
@session_start();
include 'class/login_class.php';
include 'class/register_class.php';
include 'class/post_class.php';
if(isset($_REQUEST['action']) and !empty($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'login':
			$login= new Login();
			$login->check($_REQUEST['email'],$_REQUEST['password']);
			$login->islogged();
			if(isset($_SESSION['logged']) and $_SESSION['logged']==1)
			{
				header('Location: home.php');
			}
			else
			{
			header( 'HTTP/1.1 404 Not Found' );
			header('Location: index.php');
			unset($_REQUEST);
			}
			//print_r($_REQUEST);
		break;
		case 'logout':
			  logout();
			break;	
		case 'approve':
			$login= new Login();
			if(!empty($_REQUEST['id'] and $_REQUEST['id']!=''))
				{
					if($login->approve($_REQUEST['id']))
					{
						echo "Account Accepted successfully :)";
						header('Location: home.php');
					}
					else
					{
						echo "Error in Account acceptence :( ";
					}
				}
			else
			{
					echo "User does't exists :(";
					header('Location: home.php');
			}
			break;	
		case 'reject':
			$login= new Login();
			if(!empty($_REQUEST['id'] and $_REQUEST['id']!=''))
				{
					if($login->reject($_REQUEST['id']))
					{
						echo "Account rejected successfully :)";
						header('Location: home.php');
					}
					else
					{
						echo "Error in Account rejection :( ";
					}
				}
			else
			{
					echo "User does't exists :(";
					header('Location: home.php');
			}
			break;	
		default:
					echo "Wrong Request :(";
					header('Location: index.php');
					exit(0);
	}
}
if(isset($_POST['register']) and !empty($_POST['register']))
{
	switch($_POST['register'])
	{
		case 'Create new account':
				// print_r($_POST);
				// print_r($_FILES);
				$as =new Register();
				if($_POST['password']===$_POST['repassword'])
				{
					if($_FILES['image']['size']<256000)
					{
						if($_POST['gender']=='female')
						{
							$_POST['gender']='F';
						}
						else
						{
							$_POST['gender']='M';
						}
						if($_POST['usertype']=='teacher')
						{
							$_POST['usertype'] =2;
						}
						else
						{
							$_POST['usertype']=3;
						}
						$fields=array('email'=>$_POST['email'],
											'password'=>$_POST['password'],
											'name'=>$_POST['name'],
											'contact'=>$_POST['contact'],
											'address'=>$_POST['address'],
											'image'=>$_FILES['image']['name'],
											'gender'=>$_POST['gender'],
											'user_type'=>$_POST['usertype'],
											'status'=>'0'
											);
						$temp=$as->register($fields);
						// print_r($temp);
						// die();
						if($temp['status']==1)
						{
							$data = array('imagename' => image($temp['last_insert_id']) , 'id'=>$temp['last_insert_id']);
							$as->UpdateImageName($data);
							echo 'your registartion details are under review. ';
							echo 'Click <a href="index.php">here</a> for sign in!';
							exit(0);
						}
						else
						{
							echo 'please fill your form correctly';
							exit(0);
						}
					}
					else
					{
						echo "uploaded profile image size should be 250kb";
						exit(0);
					}
				}
				else
				{
					echo 'password not matched';
					exit(0);
				}
		break;
		case 'Update Profile':
			$as =new Register();
			if ($_POST['usertype']=='admin')
			{
				$_POST['usertype']=1;
			}
			elseif($_POST['usertype']=='teacher')
			{
				$_POST['usertype']=2;
			}
			elseif ($_POST['usertype']=='student')
			{
				$_POST['usertype']=3;
			}
			if($_POST['gender']=='Female')
			{
				$_POST['gender']='F';
			}
			else
			{
				$_POST['gender']='M';
			}
			$data = array('email' => $_POST['email'] , 'name'=>$_POST['name'],
				'contact'=>$_POST['contact'],
				'address'=>$_POST['address'],
				'gender'=>$_POST['gender'],
				'image'=>$_SESSION['image'],
				'user_type'=>$_POST['usertype'],
				'id'=>$_SESSION['id']);
				$as->UpdateRegister($data);
				header('Location: home.php');
		break;
		case 'Post':
			$post =new Post();
			$data = array('loginid' =>  $_SESSION['id'], 'message'=>$_POST['message'],'user_type'=>$_SESSION['usertype']);
			$post->createPost($data);
			header('Location: home.php');
		break;
		default:
					echo "Wrong Request :(";
					header('Location: index.php');
					exit(0);
	}
}
function logout()
{
		$expire=time() -1000;
		$_SESSION['logged']=null;
		$_SESSION['email']=null;
		session_unset();
		unset($expire);
		header('Refresh:0;URL=index.php');
		exit();
}
function image($last_insert_id)
{
	$dir =TEMP_DIR;
	if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
		switch ($_FILES['image']['error']) {
			case UPLOAD_ERR_INI_SIZE:
				die('The uploaded file exceeds the upload_max_filesize directive ' .
				'in php.ini.');
			break;
			case UPLOAD_ERR_FORM_SIZE:
				die('The uploaded file exceeds the MAX_FILE_SIZE directive that ' .
				'was specified in the HTML form.');
			break;
			case UPLOAD_ERR_PARTIAL:
				die('The uploaded file was only partially uploaded.');
			break;
			case UPLOAD_ERR_NO_FILE:
				die('No file was uploaded.');
			break;
			case UPLOAD_ERR_NO_TMP_DIR:
				die('The server is missing a temporary folder.');
			break;
			case UPLOAD_ERR_CANT_WRITE:
				die('The server failed to write the uploaded file to disk.');
			break;
			case UPLOAD_ERR_EXTENSION:
				die('File upload stopped by extension.');
			break;
		}
	}
	list($width, $height, $type, $attr) =getimagesize($_FILES['image']['tmp_name']);
	switch ($type) {
		case IMAGETYPE_GIF:
			$image = imagecreatefromgif($_FILES['image']['tmp_name']) or
			die('The file you uploaded was not a supported filetype.');
		$ext = '.gif';
		break;
		case IMAGETYPE_JPEG:
			$image = imagecreatefromjpeg($_FILES['image']['tmp_name']) or
			die('The file you uploaded was not a supported filetype.');
		$ext = '.jpg';
		break;
		case IMAGETYPE_PNG:
			$image = imagecreatefrompng($_FILES['image']['tmp_name']) or
			die('The file you uploaded was not a supported filetype.');
			$ext = '.png';
		break;
		default:
			die('The file you uploaded was not a supported filetype.');
		}
		$imagename = $last_insert_id . $ext;
		switch ($type) {
			case IMAGETYPE_GIF:
				imagegif($image, $dir . '/' . $imagename);
			break;
				case IMAGETYPE_JPEG:
			imagejpeg($image, $dir . '/' . $imagename, 100);
			break;
				case IMAGETYPE_PNG:
			imagepng($image, $dir . '/' . $imagename);
			break;
		}
		imagedestroy($image);
		return $imagename;
}
?>