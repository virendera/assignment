<?php
@session_start();
include 'login_class.php';
include 'register_class.php';
if(isset($_REQUEST['action']) and !empty($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		
		case 'login':
			$login= new login();
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

		default:
	}
}
if(isset($_POST['register']) and !empty($_POST['register']))
{
	echo 'yes';
	switch($_POST['register'])
	{
		case 'Create new account':
				// print_r($_POST);
				// print_r($_FILES);
				$as =new register();

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
		  print_r($_POST);

		default:
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
	$dir ='C:\xampp\htdocs\Demo\img';
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
	//get info about the image being uploaded
	// $image_caption = $_POST['caption'];
	// $image_username = $_POST['username'];
	// $image_date = date('Y-m-d');
	list($width, $height, $type, $attr) =getimagesize($_FILES['image']['tmp_name']);
	// make sure the uploaded file is really a supported image
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
		//save the image to its final destination
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