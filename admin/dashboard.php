<?php

include('../function.php');
include('../config.php');
require('common/header.php');
?>

        <div id="page-wrapper">
		
            <div class="container-fluid">
			   <div class="row">
                    <div class="col-lg-8">
                        <h1 class="page-header">
                            Dashboard 
                        </h1>
                       
                    </div>
                </div>
				
				
				   <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="glyphicon glyphicon-facetime-video fa-5x"
"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <div class="huge"><?php //echo getSharFacebookCount(); ?></div>
                                        <div>Upload Videos</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                   <a href="addevent.php?val=facebook">   <span class="pull-left">View Details</span></a>
                                   <a href="addevent.php?val=facebook">  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span><a>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-upload fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php //echo getSharTwitterCount();?></div>
                                        <div>Gallery </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                            <a href="addevent.php?val=twitter">   <span class="pull-left">View Details</span></a>
                                    <a href="addevent.php?val=twitter">   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-credit-card fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php //echo getMainEventCount();?></div>
                                        <div>Payment Details</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                           <a href="addevent.php?val=main"> <span class="pull-left">View Details</span></a>
                                 <a href="addevent.php?val=main">   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa fa-bell fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php //echo getNotificationCount();?></div>
                                        <div>Notifications</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                          <a href="notification.php">   <span class="pull-left">View Details</span></a>
                                      <a href="notification.php">   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
					
					
                </div>
				
			

<?php

require('common/footer.php');
?>