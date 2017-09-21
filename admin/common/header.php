<?php
session_start();
$user=getResult("tbl_users","username",$_SESSION['username']);
//$usertype=$user['user_type'];

if(!isset($_SESSION['username']))
{
	header('location:login.php');
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
	
    <title>Nitte University</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../assets/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a href=""><img src="../assets/images/banner.png" style="width:194px;height:46px"/></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['username']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
				<li class="active">
                        <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
					<li>
                        <a href="adduser.php"><i class="fa fa-user"></i>&nbsp  Add User</a>
                    </li>
			    
					<li>
                        <a href="adddirectory.php"><i class="fa fa-sitemap"></i> Directory</a>
                    </li>

                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Events <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li > <a href="addinstitution.php">Add Institution</a></li>
                            <li><a href="addevent.php">Add Events</a></li>
							</ul>
							</li>
					<li>
                        <a href="addcourse.php"><i class="fa fa-graduation-cap"></i>Add Course</a>
                    </li>
					<li>
                        <a href="addweburl.php"><i class="fa fa-globe"></i> Add Website URL</a>
                    </li>	
					<li>
                        <a href="addappurl.php"><i class="fa fa-mobile-phone  fa-lg">&nbsp;</i>Nitte Apps</a>
                    </li>	

                    <li>
                        <a href="notification.php"><i class="fa fa-bell"></i> Push Notification</a>
                    </li>
                    <li>
                        <a href="contact.php"><i class="fa fa-fw fa-edit"></i> Contact Details</a>
                    </li>
					  <li>
                        <a href="map.php"><i class="fa fa-fw fa-map-marker"></i>Map</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

       