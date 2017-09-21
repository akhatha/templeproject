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
                                        <i class="fa fa-facebook fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <div class="huge"><?php echo getSharFacebookCount();?></div>
                                        <div>shared Facebook</div>
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
                                        <i class="fa fa-twitter fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo getSharTwitterCount();?></div>
                                        <div>shared twitter </div>
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
                                        <i class="fa fa-calendar fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo getMainEventCount();?></div>
                                        <div>Main Event</div>
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
                                        <div class="huge"><?php echo getNotificationCount();?></div>
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
				
				<div class="row"> 
				  
					    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>Events</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
								<table class="table table-striped table-bordered table-list ">
                  <thead>
                                  <tr>
                        <th>Sl.No</th>
                        <th>Event Title</th>
						  <th>  	Institution Name</th>
						  
							  <th>  	 	event</th>
							   <th>  	 	sharing_facebook 	</th>
							   <th>sharing_twitter</th>
               
                    </tr> 
                  </thead>
                  <tbody>
				  <?php
							$getEvent=  displayDashboardEvent();
							  $i=1;
							  if($getEvent){
							    foreach($getEvent as $row)
                                {
									?>
									<tr data-user-id=<?php echo $row['id']?>>
									<?php
											echo ' <td class="hidden-xs">'.$i.'</td>
											<td class="hidden-xs">'.$row['event_title'].'</td>
											<td class="hidden-xs">'.substr($row['institution_name'],0,40).'</td>
											<td class="hidden-xs">'.$row['event'].'</td>
											<td class="hidden-xs">'.$row['sharing_facebook'].'</td>
											<td class="hidden-xs">'.$row['sharing_twitter'].'</td>
									 
									 </tr>';
										$i++;
								}}
								?>
							
							
						</tbody>
                </table>
            
                                </div>
                                <div class="text-right">
                                    <a href="addevent.php">View All Events <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
               

<?php

require('common/footer.php');
?>