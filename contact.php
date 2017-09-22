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
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Contact
                        <strong>K.P.SHRINIVASA TANTRY</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-8">
                    <!-- Embedded Google Map using an iframe - to select your location find it on Google maps and paste the link as the iframe src. If you want to use the Google Maps API instead then have at it! -->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1487.2098489799398!2d74.76647726945279!3d13.239669876040661!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDE0JzIyLjUiTiA3NMKwNDUnNTguOSJF!5e1!3m2!1sen!2s!4v1501647693802" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>               
			   </div>
                <div class="col-md-4">
                    <p>Phone:
                        <strong>+91 99726 18986</strong>
                    </p>
                    <p>Email:
                        <strong><a href="mailto:kpshrinivasatantry">kpshrinivasatantry</a></strong>
                    </p>
                    <p>Address:
                        <strong>K.P.SHRINIVASA TANTRY<br/>Vidwan & Astrologer</br/>
                            <br>K.P.Shrinivasa Tantry Road</strong><br/>Near Madumbu Bus Stop<br/>Madumbu,Kaup<br/>Udupi- 576122<br/>Karnataka-India
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Contact
                        <strong>form</strong>
                    </h2>
                    <hr>
                                     <form role="form">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Email Address</label>
                                <input type="email" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <label>Message</label>
                                <textarea class="form-control" rows="6"></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

   
     	 <?php
include('footer.php');


?>
