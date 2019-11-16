<?php
@session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
		<link rel="stylesheet" href="style/bootstrap.min.css" type="text/css">
</head>
<body>
	<div class="header"></div>
<div class="container">
	  <form class="card" method="POST" action="menu.php" enctype="multipart/form-data">
                    <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">

                <div class="card-body">
                  <div class="row">
                     <div class="col-md-4">
                      <div class="form-group">
            						<div class="card card-user">
        			              <div class="card-body">
                                <div class="author" >
                                  <a href="javascript:void(0)">
                                    <img id="fileDisplayArea" style="height: 150px; width: 150px;" class="avatar" style="height:150px;width:150px;" src="img/<?php echo $_SESSION['image']?>" alt="...">
                                    
                                    <h5 class="title"><input type="file" name="image" id="fileInput" value="<?php echo $_SESSION['image'];?>"></h5>
                                  </a>
                                </div>
        			              </div>
        			              <div class="card-footer">
        			                <div class="button-container">
        			                  <button href="javascript:void(0)" class="btn btn-icon btn-round">
        			                    <i class=""></i>
        			                  </button>
        			                </div>
        			              </div>
            			       </div>
                      </div>
                    </div>                 	
                    <div class="col-md-4 pr-md-2">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="mike@email.com"  value="<?php echo $_SESSION['email'];?>">
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Home Address" value="<?php echo $_SESSION['address'];?>">
                      </div>  
                      <div class="form-group">
                        <label>Gender</label>
          							<select name="gender" class="form-control" >
                                                 <?php 

                        if($_SESSION['gender']=='M')
                        {
                          ?>

          								<option value="Male" label="Male" selected > Male </option >
          								<option value="Female" label="Female"> Female </option >
                                                    <?php
                        }
                        elseif($_SESSION['gender']=='F')
                        {
?>
                          <option value="Male" label="Male"  > Male </option >
                          <option value="Female" label="Female" selected> Female </option >
                                                    <?php
                        }
                        ?>
          							</select >     
                      </div>                               
                    </div>
                     <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $_SESSION['name'];?>" >
                      </div>
                      <div class="form-group">
                        <label>Contact</label>
                        <input type="number" name="contact" class="form-control" placeholder="1234567890" value="<?php echo $_SESSION['contact'];?>">
                      </div>
                      <div class="form-group">
                        <label>User Type</label>
          							<select name="usertype" class="form-control" >
                        <?php 

                        if($_SESSION['usertype']==2)
                        {
                          ?>

          								<option value="teacher" selected label="Teacher" > Teacher </option >
          								<option value="student" label="Student"> Student </option >
                          <?php
                        }
                        elseif($_SESSION['usertype']==3)
                        {
?>
                          <option value="teacher"  label="Teacher" > Teacher </option >
                          <option value="student" selected label="Student"> Student </option >
                          <?php
                        }
                        ?>
          							</select >                         	
                      </div>

                    </div>                   
                  </div>            
              </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <a href="home.php" class="btn btn-secondary" title="previous page">Back</a>
                    <input type="submit" name="register" value="Update Profile" class="btn btn-primary">

                  </div>
                </form>
</div>
<script type="text/javascript">
  
window.onload = function() {

    var fileInput = document.getElementById('fileInput');
    var fileDisplayArea = document.getElementById('fileDisplayArea');


    fileInput.addEventListener('change', function(e) {
      var file = fileInput.files[0];
      var imageType = /image.*/;

      if (file.type.match(imageType)) {
        var reader = new FileReader();

        reader.onload = function(e) {
          fileDisplayArea.src = reader.result;
        }

        reader.readAsDataURL(file); 
      } else {
        fileDisplayArea.innerHTML = "File not supported!"
      }
    });

}

</script>
</body>

</html>