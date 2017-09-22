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
            <div class="box" style="background: rgb(142, 52, 9)">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>Shopping Cart</strong>
                    </h2>
                    <hr>
                </div>
             <!--   <div class="col-md-12">
                    <img class="img-responsive " src="img/intro-pic.png" alt="">
                </div>  -->
                <div class="col-md-12">
<table class="table table-bordered" style="color:white;">
<thead><th>Sl.no.</th><th>Item Name</th><th>Price(Rs.)</th></thead>
<tbody>
<tr><td>1</td><td>Sri Yantra</td><td>500</td></tr>
<tr><td>2</td><td>Sri Yantra</td><td>500</td></tr>
<tr><td>-</td><td>Total</td><td>1000</td></tr>
</tbody>
</table>

<div class="col-md-12">

<a class="btn btn-primary" href="yantra-detail.php">Continue Shopping</a>
<a class="btn btn-primary" href="#">Checkout</a>

</div>


</p></div>
</div>


                <div class="clearfix"></div>
            </div>
        </div>

      
        </div>

    </div>
    <!-- /.container -->

     <?php
include('footer.php');


?>
