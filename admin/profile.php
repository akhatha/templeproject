<?php
ob_start();
include('../function.php');
include('../config.php');
require('common/header.php');
$user=$_SESSION['username'];
$email=getEmail($user);
	
if(isset($_POST['profile']))
{
	$user=$_SESSION['username'];

	$pass=trim($_POST['password']);
	$cpass=trim($_POST['cpassword']);
	 $email=trim($_POST['email']);
	if($pass != $cpass)
	{
		$mess="<div class='alert alert-danger fade in' id='success'>
						<strong>Danger! </strong> Passwords do not match!
						</div>";
						header("Refresh: 1;profile.php");
						
	}

	$result=updateProfile($pass,$user,$email);//updating profile information 

	if($result)
	{
		$mess="<div class='alert alert-success fade in' id='success'>
						<strong>Success!</strong> Sucessfully Updated.
						</div>";
						header("Refresh: 1;profile.php");
	}
	
}
?>

        <div id="page-wrapper">
		
            <div class="container-fluid">
			<div class="col-lg-8">
                <h1 class="page-header">
                            Profile</h1>
                     
            </div>
                             

			<div  class="row" id="instituteForm">
        <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default panel-table">
              <div class="panel-heading">Profile Settings
			    <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title"></h3>
                  </div>
				  </div>
				  </div>
		
				 <div class="panel-body">
				 <form method="POST" action="">
				  <div class="row">
                    <div class="col-lg-12">
                       <div class="form-group">
					 
                                <label>Name</label>
                               
								<input type="text"class="form-control" value="<?php echo $_SESSION['username']?>" name="uName" required readonly><br>
					
                         </div>
						 
						  <div class="form-group">
					 
                                <label>Password</label>
                               
								<input type="password"class="form-control"  name="password" required ><br>
					
                         </div>
						   <div class="form-group">
					 
                                <label>Confirm Password</label>
                               
								<input type="password"class="form-control"  name="cpassword" required ><br>
					
                         </div>
						  <div class="form-group">
					 
                                <label>Email</label>
                               
								<input type="email"class="form-control" value="<?php echo $email;?>" name="email" required ><br>
					
                         </div>
						
						  <div class="form-group">
						   <input type="submit"  class="btn btn-info" value="save" name="profile">
						 
							</div>
							
                    </div>
					</div>
					</form> 
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>

<?php
require('common/footer.php');
?>
