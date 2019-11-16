<?php
@session_start();
	if(!empty($_SESSION['logged']) and $_SESSION['logged'] === 1)
	{
?>


<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="style/bootstrap.min.css" type="text/css">
  <script src="javascript/jquery-3.2.1.min.js"></script>
</head>
<body>
     <div class="header">
      <div class="container">
        <div class="d-flex">
          <div class="d-flex order-lg-2 ml-auto">
                  <div class="text-muted d-block mt-1"> <?php echo ucfirst($_SESSION['name']);?><a href="menu.php?action=logout" class="btn ">logout</a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-profile">
              <div class="card-header" >
            <h5 class="title">Welcome <?php echo ucfirst($_SESSION['name']);?> </h5>
              </div>
              <div class="card-body text-center">
                <img class="card-profile-img" style="height:150px;width:150px;" src="img/<?php echo $_SESSION['image']?>">
                <h3 class="mb-3"><?php echo ucfirst($_SESSION['name']);?></h3>
                <p class="mb-4">
                 <?php echo ucfirst($_SESSION['name']);?>
                </p>
                <button class="btn btn-outline-primary btn-sm">
                  <a href="Profile.php" class="">Profile</a> 
                </button>
              </div>
            </div>
         
          </div>
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Message">
                  <div class="input-group-append">
                    <button type="button" class="btn btn-secondary">
                      <i class="fe fe-camera">Post</i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-body">
              <ul class="list-group card-list-group">
                
              </ul>
            </div>
            </div>
          
          </div>
        </div>
      </div>
</body>
</html>


<?php
	}
	else
	{
		echo 'Please login first <a href="index.php">here</a>';
	}
?>
