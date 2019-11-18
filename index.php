<?php
if(isset($_POST['login']) and $_POST['login']=='login')
{
  $email=isset($_POST['login_email'])?($_POST['login_email']):'';
  $password=isset($_POST['login_password'])?($_POST['login_password']):'';
  $login_email=htmlspecialchars(trim($email));
  $login_password=htmlspecialchars(trim($password));
  if(!empty($login_email) and !empty($login_password))
  {
    header('Location:menu.php?action=login&email='.$login_email.'&password='.$login_password.'');
  }
  else
  {
  echo '<script>alert("enter email and password");</script>';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="style/bootstrap.min.css" type="text/css">
  <style type="text/css">
    .box
    {
    margin-top: 2%;
    margin-bottom: 50px;
    width: 40%;
    }
  </style>
</head>
<body>
	<div class="page" >
<div class="container box ">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <form method="POST" action="<?php echo htmlspecialchars(trim($_SERVER['PHP_SELF']));?>">
              <div class="card-header">
                <h5 class="title">Login</h5>
              </div>
              <div class="card-body">
                  <div class="row">
                     <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" required name="login_email" value="<?php echo htmlspecialchars(trim(isset($_POST['login_email'])?$_POST['login_email']:''));?>"  placeholder="mike@email.com" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control" required name="login_password" placeholder="" >
                      </div>
                    </div>                 	              
                  </div>            
              </div>
              <div class="card-footer">
              <button type="submit" id="login" name="login" value="login" title="login"  class="btn btn-primary btn-block">Sign in</button>
              </div>
                </form>
            </div>
            <div class="text-center text-muted">
                Don't have account yet? <a href="register.php">Sign up</a>
              </div>
          </div>
        </div>
      </div>
      </div>
</body>
</html>