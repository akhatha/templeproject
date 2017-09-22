 <?php
include('header.php');
//include('configphp');

?>

    <div class="brand"><img src="frontend/img/logo.png" class="img-responsivE"/></div>
	<!--
	<br/>
    <div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>
-->
    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.php">K.P.SHRINIVASA TANTRY</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="about.php">About uS</a>
                    </li>
                    <li>
                        <a href="gallery.php">Gallery</a>
                    </li>
                    <li>
                        <a href="gallery.php">Videos</a>
                    </li>
					<li><a data-toggle="dropdown" href="#" class="text-info dropdown-toggle">Services</a> <ul class="dropdown-menu dropdown_mod" data-dropdown-in="fadeInUp"
                                data-dropdown-out="fadeOut">
                                <li><a href="Jeernoddhara.php">Jeernoddhara</a></li>
                                <li><a href="vasthu.php">Vasthu</a></li>
                                <li><a href="homa.php">Homa</a></li>
								<li><a href="yantras.php">Yantras</a></li>
                            
                                <li><a href="Jyothishya.php">Jyothishya</a></li>
								<li><a href="problem-solving.php">Problem solving </a></li>
                                 <li><a href="gemstones.php">Gemstones</a></li>
                            </ul>
</li>
  <li>
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="box" style="background: rgb(142, 52, 9);">
             
                <div class="col-md-12">
                    <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 style="color:white;">Gallery</h2>
                    <hr class="star-primary">
                </div>
            </div>
           <div class="demo-gallery">
            <ul id="lightgallery" class="list-unstyled row">
                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="frontend/img/1-375.jpg 375, frontend/img/1-480.jpg 480, frontend/img/1.jpg 800" data-src="img/kp1.jpg" 
				>
                    <a href="">
                        <img class="img-responsive" src="frontend/img/kp1.jpg">
                    </a>
                </li>
                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="frontend/img/2-375.jpg 375, frontend/img/2-480.jpg 480, frontend/img/2.jpg 800" data-src="frontend/img/kp2.jpg" 
				>
                    <a href="">
                        <img class="img-responsive" src="frontend/img/kp2.jpg">
                    </a>
                </li>
                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="frontend/img/13-375.jpg 375, img/13-480.jpg 480, frontend/img/13.jpg 800" 
				data-src="frontend/img/kp3.jpg" >
                    <a href="">
                        <img class="img-responsive" src="frontend/img/kp3.jpg">
                    </a>
                </li>
                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="frontend/img/4-375.jpg 375, frontend/img/4-480.jpg 480, frontend/img/4.jpg 800" data-src="frontend/img/kp4.jpg" 
>
                    <a href="">
                        <img class="img-responsive" src="frontend/img/kp4.jpg">
                    </a>
                </li>
            </ul>
        </div>
        </div>
                </div>
              
                <div class="clearfix"></div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Our
                        <strong>Team</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    <h3>John Smith
                        <small>Job Title</small>
                    </h3>
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    <h3>John Smith
                        <small>Job Title</small>
                    </h3>
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    <h3>John Smith
                        <small>Job Title</small>
                    </h3>
                </div>
                <div class="clearfix"></div>
            </div> -->
        </div>

    </div>
    <!-- /.container -->

  	 <?php
include('footer.php');


?>
