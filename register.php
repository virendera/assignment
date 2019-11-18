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
        width: 100%;
    }
  </style>
</head>
<body>
	<div>
<div class="container box">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Register</h5>
              </div>
              <div class="card-body">
                <form  method="POST" action="menu.php" enctype="multipart/form-data">
                  <div class="row">
                     <div class="col-md-4">
                      <div class="form-group">
            						<div class="card card-user">
        			              <div class="card-body">
        			                  <div class="author" >
        			                    <a href="javascript:void(0)">
        			                      <img id="fileDisplayArea" style="height: 150px; width: 150px;"class="avatar" src="img/user.png" alt="...">
        			                      <h5 class="title"><input type="file" required style="font-size: small;" name="image" id="fileInput"></h5>
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
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="mike@email.com" >
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address"  class="form-control"  required placeholder="Home Address" value="">
                      </div>  
                      <div class="form-group">
                        <label>Gender</label>
          							<select name="gender" required class="form-control" >
          								<option value="Male" label="Male" > Male </option >
          								<option value="Female" label="Female"> Female </option >
          							</select >     
                      </div>   
                      <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" name="password" required class="form-control" placeholder="" >
                      </div>
                      <div class="col-12">
                    <div class=" form-group custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                      <label class="custom-control-label" for="customCheckRegister">
                        <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                      </label>
                    </div>
                  </div>                                       
                    </div>
                     <div class="col-md-4 pr-md-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" required class="form-control" placeholder="Name" >
                      </div>
                      <div class="form-group">
                        <label>Contact</label>
                        <input type="number" name="contact" required class="form-control" placeholder="1234567890" >
                      </div>
                      <div class="form-group">
                        <label>User Type</label>
          							<select name="usertype" required class="form-control" >
          								<option value="teacher" label="Teacher" > Teacher </option >
          								<option value="student" label="Student"> Student </option >
          							</select >                         	
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword">Retype Password</label>
                        <input type="password" name="repassword" required class="form-control" placeholder="" >
                      </div>
                    </div>                   
                  </div>            
              </div>
                  <div class="card-footer text-right">
                    <input type="submit" name="register" value="Create new account" class="btn btn-primary">
                  </div>
                </form>
            </div>
            <div class="text-center text-muted">
                Already have account? <a href="index.php">Sign in</a>
              </div>
          </div>
        </div>
      </div>
      </div>
</body>
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
</html>