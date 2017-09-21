<?php
include('../function.php');
include('../config.php');

if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$userExist=user_exist($username,$password);//cheking user already exist or not
	$mess=null;
 
	
	if($userExist )
	{
		session_start();
		$_SESSION['username'] = $_POST['username'];
		header('Location:dashboard.php');//if user exist it redirects to dashboard
		
	}
	else
	{
		$mess='user doesnot exist';
	}

	
}
?>
  
  
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KP Shrinivas Tantry</title>
	<link href="../assets/css/login.css" rel="stylesheet">
	  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	  <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  </head>

<body>

  <div class="apollo">
			<div class="apollo-container clearfix">
				<div class="logo">
					<img src="../assets/images/logo.png" width="70%" >
				</div>

				<div class="apollo-login">
				
					<form class="form-signin" id="apollo-login-form" method="POST" action="">
						<div class="form-group">
							<input type="text" name="username" class="form-control email" placeholder="username" required/>
						</div>

						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password"/>
						</div>
							   <input class="btn btn-lg btn-signin btn-block" type="submit" name="submit" value="Sign in" required>
							
					</form>
				<?php if(isset($mess)){echo $mess;}?>
					<p class="apollo-register-account"> <a href="forgot.php" class="password-link"><small>Forgot your password?</small></a> </p>
					
				</div>
</div>
</div>
			
		  <script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

  </body>

</html>


