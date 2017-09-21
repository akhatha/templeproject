<?php
ob_start();
include('../function.php');
include('../config.php');
<<<<<<< HEAD:admin/addevent.php

require('common/header.php');?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script>
    function preview_image(event)
    {
        
        //$('#list').empty();
        
        var total_file = document.getElementById("upload_file").files.length;
      
        for (var i = 0; i < total_file; i++)
        {

            /*$('#borderback').append("<a type='button'>
             <i class='fa fa-times-circle btn btn-info btn-simple btn-xs pull-right'></i><img src='" + URL.createObjectURL(event.target.files[i]) + "' class='img-responsive'/></a>");
             }*/


            $('#list').append("<div class='col-lg-2 borderback'>\
                                <a type='button'>\
                                    <i class='fa fa-times-circle btn btn-info btn-simple btn-xs pull-right'></i>\
                                    <img src='" + URL.createObjectURL(event.target.files[i]) + "' class='img-responsive'>\
                                        </a>\
                            </div>");
        }
    }
    
    $(document).ready(function () {
         
        get_image();
        
      
var base_url=site_url;
    
     function get_image()
    {
        //$('#list').empty();
       
         $.ajax({
                url: "get_gallery_details.php",
                type: "GET",
                dataType: 'json',
                success: function (json) {
                 
                 
                  //console.log(json.data);
                  
                        //die();
                         for (var i = 0, len = json.length; i < len; i++) {
                         var image_path = json[i].image_path;

                      
                      $('#list').append("<div class='col-lg-2 borderback'>\
                                <a type='button'>\
                                    <i class='fa fa-times-circle btn btn-info btn-simple btn-xs pull-right'  onclick='delete_image("+ json[i].id +");'></i>\
                                    <img src='"+ base_url + image_path + "' class='img-responsive'>\
                                        </a>\
                            </div>");
                         }
                         }
                         });
                         }
                         
                         
                         
                         
                         
						 });
                                                 
    function delete_image(id)
    {
        
         
                
               $.ajax({
                url: "delete_gallery.php?id="+id,
                type: "GET",
                dataType: 'json',
                success: function (json) {
                    
                    location.reload();
                }
    });
    }
    
    </script>
    <div id="all-output" class="col-md-10 upload">
        	<div id="upload">
=======
require('common/header.php');
$getCollegeList=displayResult('tbl_college_institution');

if(isset($_POST['event']))
{
	
	$id=$_POST['id'];
	$eTitle=null;
	$eDesc=null;
	$fileToUpload=null;
	$cEvent=null;
	$mainEvent=null;
	$shareFace=0;$shareTwit=0;$sharewhatsapp=0;
	$eTitle=mysql_real_escape_string($_POST['eTitle']);
	$eDesc=mysql_real_escape_string($_POST['eDesc']);
	$cEvent=$_POST['cEvent'];
	if(isset($_POST['share']))
	{
		$share=$_POST['share'];
		if ( ! isset($share[0]) ) 
		{
				$share[0] = null;
		}
		else if(! isset($share[1]))
		{
			$share[1] = null;
		}
		else if(! isset($share[2]))
		{
			$share[2] = null;
		}
	if($share[0]=="facebook" && $share[1]=="twitter" && $share[2]=="whatsapp" )
		
		{
				$shareFace=1;$shareTwit=1;$sharewhatsapp=1;
		}

		
	 	elseif($share[0]=="facebook" && $share[1]=="twitter")
		
		{
				$shareFace=1;$shareTwit=1;$sharewhatsapp=0;
		}
		else if($share[0]=="facebook" && $share[1]=="whatsapp" )
		
		{
				$shareFace=1;$shareTwit=0;$sharewhatsapp=1;
		}
		else if($share[0]=="twitter" && $share[1]=="whatsapp" )
		
		{
				$shareFace=0;$shareTwit=1;$sharewhatsapp=1;
		}
		elseif(($share[0]=="facebook"))
		{
				$shareFace=1;$shareTwit=0;$sharewhatsapp=0;
		}

		
		elseif(($share[0]=="twitter"))
		{
				$shareTwit=1;$shareFace=0;$sharewhatsapp=0;
		}
		elseif(($share[0]=="whatsapp"))
		{
				$shareTwit=0;$shareFace=0;$sharewhatsapp=1;
		}
		
	}

	$mainEvent=$_POST['mainEvent'];
	$createDate=date("Y-m-d H:i:s");
	$target_dir = "../uploads/event/";
	$image='';
	$video='';
	if(isset($_FILES["fileToUpload"]["name"]))
	{
		$temp=explode(".",$_FILES["fileToUpload"]["name"]);
		$newfilename = time() . '_' . rand(100, 999) . '.' . end($temp);
		$fileName=$newfilename;
		$target_file =$target_dir."".$fileName;
		 if($_FILES["fileToUpload"]["name"] == '')
												 {

													$get_image=getResult('tbl_event','id',$id);
													$url=$get_image['image_url'];
											
													
												  }
			else
			{
			$imageupload=uploadFile($target_file);//upload a file if file doesnot exist
			$url=SITE_URL."/uploads/event/".$fileName;	
			}
		
		/*if (file_exists($target_file) && (!$id))//checking file already exist or not
		{
		echo "<div class='alert alert-danger fade in' id='success'>
		<strong>Danger! </strong> Sorry, file already exists.Not uploaded!
						</div>";
							header("Refresh: 1;addevent.php");
			
			$url='';

		} */

		
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);//checking file format
		$file=explode("/",$imageFileType);
	
		if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"|| $imageFileType == "gif" ) 
		{
				$image=$url;
		}
		else
		{
			if($_FILES["fileToUpload"]["name"] == '')
												 {
													$get_image=getResult('tbl_event','id',$id);
													$url=$get_image['image_url'];
													$image=$url;
											
													
												  }
												  else
												  {
												  				$image='';
												  }

		}
					
		if($imageFileType == "mp4" || $imageFileType == "WebM" ||$imageFileType == "Ogg")
		{
				
				$video=$url;
		}
		else
		{
				$video='';
		}
	}

			

	
												
	
	
	$chkEvent=getName("tbl_event","event_title",$eTitle);	//checking event title already exist or not

	if($chkEvent &&  (!$id) )
	{
		$mess="<div class='alert alert-danger fade in' id='success'>
						<strong>Danger! </strong> Event already Exist!
						</div>";
							header("Refresh: 1;addevent.php");
		
		
	}
	else
	{
			
				
				if($id)
						{
							if($video !=='')
							{?>
						
								<input type="hidden" name="hiddenId" id="hiddenId" value="<?php echo $id;?>">
								<video width="320" height="240" controls id="video" style="display:none">
									<source src="<?php echo $video; ?>" type="video/mp4">
								</video>
								 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
								 <!-- script for creating video thumbnail using canvas-->
								<script type="text/javascript">
							
								var time = 15;
								var scale = 1;
							
								var video_obj = null;

								document.getElementById('video').addEventListener('loadedmetadata', function() {
								 this.currentTime = time;
								 video_obj = this;

								}, false);

								document.getElementById('video').addEventListener('loadeddata', function() {
								 var video = document.getElementById('video');

								 var canvas = document.createElement("canvas");
								 canvas.width = 100;
								 canvas.height =100;
								 canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
								canvasData= canvas.toDataURL("image/png");
								thumb(canvasData);
								video_obj.currentTime = 0;
								}, false);
								
								function thumb(canvasData)
								{
										var thumb=canvasData;
										var site_url = '<?php echo SITE_URL; ?>';
										var id=document.getElementById('hiddenId').value;
										 $.post( 
												  site_url+"/admin/createthumb.php",
												  { name: thumb ,id:id},
											  function(data) {
											 
														}
										);
								}
								  
							
								</script>
						<?php
								
							$data=array(
							'event_title '=>$eTitle,
							'event_description'=>$eDesc,
							'video_url'=>$video,
							'college_id'=>$cEvent,
							'event'=>$mainEvent,
							'sharing_facebook'=>$shareFace,
							'sharing_twitter'=>$shareTwit,
							'sharing_whatsapp'=>$sharewhatsapp,
							'create_date'=>$createDate
						);
						
							$result=updateName("tbl_event",$data,$id);
							$mess="<div class='alert alert-success fade in' id='success'>
							<strong>Success!</strong> Updated Successfully.
							</div>";
								header("Refresh: 1;addevent.php");
						}
						else
						{
						
						$data=array(
							'event_title '=>$eTitle,
							'event_description'=>$eDesc,
							'video_url'=>$video,
							'image_url'=>$image,
							'college_id'=>$cEvent,
							'event'=>$mainEvent,
							'sharing_facebook'=>$shareFace,
							'sharing_twitter'=>$shareTwit,
							'sharing_whatsapp'=>$sharewhatsapp,
							'create_date'=>$createDate
						);
						
							$result=updateName("tbl_event",$data,$id);
							$mess="<div class='alert alert-success fade in' id='success'>
							<strong>Success!</strong> Updated Successfully.
							</div>";
								header("Refresh: 1;addevent.php");
						}
						
					}
						else
						{
						
							$data=array(
							'event_title '=>$eTitle,
							'event_description' 	=>$eDesc,
							'image_url'=>$image,
							'video_url'=>$video,
							'college_id'=>$cEvent,
							'event'=>$mainEvent,
							'sharing_facebook'=>$shareFace,
							'sharing_twitter'=>$shareTwit,
							'sharing_whatsapp'=>$sharewhatsapp,
							'create_date'=>$createDate
						);
						$result=dbRowInsert('tbl_event',$data);
						 $last_id=mysql_insert_id();
						 
						
						
						?>
						<!--passing hidden value for last inserted Id-->
						<input type="hidden" name="hiddenId" id="hiddenId" value="<?php echo $last_id;?>">
						<video width="320" height="240" controls id="video" style="display:none">
							<source src="<?php echo $video; ?>" type="video/mp4">
						</video>
						 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
						 <!-- script for creating video thumbnail using canvas-->
						<script type="text/javascript">
					
								var time = 15;
								var scale = 1;
								
								var video_obj = null;

								document.getElementById('video').addEventListener('loadedmetadata', function() {
								 this.currentTime = time;
								 video_obj = this;

								}, false);

								document.getElementById('video').addEventListener('loadeddata', function() {
								 var video = document.getElementById('video');

								 var canvas = document.createElement("canvas");
								 canvas.width = 100;
								 canvas.height =100;
								 canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
								canvasData= canvas.toDataURL("image/png");
								thumb(canvasData);
								video_obj.currentTime = 0;
								}, false);
								
								function thumb(canvasData)
								{
										var thumb=canvasData;
										var id=document.getElementById('hiddenId').value;
										 $.post( 
												  "http://117.240.88.103:8484/nittemobileapp/admin/createthumb.php",
												  { name: thumb ,id:id},
											  function(data) {
											 
														}
										);
								}
						  
					
						</script>
					

						<?php

						 $mess="<div class='alert alert-success fade in' id='success'>
						<strong>Success!</strong> Sucessfully Inserted.
						</div>";
							header("Refresh: 1;addevent.php");
						
						
						}
						if(empty($result))
						{
							
								$mess="<div class='alert alert-danger fade in' id='success'>
										<strong>Danger! </strong> Something went wrong, go back and try again!
										</div>";
									header("Refresh: 1;addevent.php");
					
						}
				
	 }
	
	
}
if(isset($_POST['delete']))
{
				$eId=$_POST['id'];
				$eventId='';
				$query=mysql_query("SELECT id, event_title,event_description,image_url, video_url,college_id, event,sharing_facebook,sharing_twitter,sharing_whatsapp FROM tbl_event WHERE id=$eId");
				while($row=mysql_fetch_array($query))
				{
                $eventId=$row['id'];
				 $eventImage=$row['image_url'];
				$event_Image= basename($eventImage);
				
				 $eventVideos=$row['video_url'];
				$event_Videos=  basename($eventVideos);
				}
				
				if($eventId)
				{
							$mess="<div class='alert alert-success fade in' id='success'>
								<strong>Success! </strong> Sucessfully Deleted
								</div>";
						
							header("Refresh: 1;addevent.php");
							mysql_query("DELETE FROM tbl_event WHERE id =$eId ");
							if($event_Videos)
							{	
								unlink("../uploads/event/".$event_Videos);
								unlink("../uploads/event/thumb_video/".$event_Image);
						
							}
							else
							{
								unlink("../uploads/event/".$event_Image);
							}
				?>
						<script type="text/javascript">
								setTimeout(function () {
								window.location.href= 'addevent.php'; // the redirect goes here

								},1000);
						</script>
						<?php
					}
					else
					{
						$mess="<div class='alert alert-danger fade in' id='success'>
							<strong>Danger! </strong> Something went wrong, go back and try again!
							</div>";
								header("Refresh: 1;addevent.php");
							?>
							
						<?php			
					}
}
if(isset($_GET['id'] , $_GET['thumb']))
{
			$id=$_GET['id'];
			$thumb=$_GET['thumb'];
			$data=array('thumb_image'=>$thumb);
			updateName("tbl_event",$data,$id);
}
?>
	  
	<canvas id="canvas" 
        width="750px" height="540px"
        style="display:none;">
</canvas>

<div id="screenshots"></div>
	  <div id="page-wrapper">
		
            <div class="container-fluid">
			<div class="col-lg-8">
                <h1 class="page-header">
                            Event</h1>
					
            </div>
                       
    <div  class="row" id="course_tbl_view">
        <div class="col-md-10 col-md-offset-1">
         		<div class="mess" ><?php if(isset($mess)){echo $mess;}?></div>
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
>>>>>>> parent of 30570a3... video and gallery:admin/addvideo.php
                <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Event</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <button type="button" class="btn btn-sm btn-primary btn-create" id="createNewEvent" onclick="myFunction()">Create New</button>
					<button type="button" class="btn btn-sm btn-primary btn-create btnEvent" id="deleteEvent">Delete All</button>	
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list paginationTable">
				  <col width="80">
					<col width="80">
                  <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Event <br> Title</th>
						 <th>Institution Name</th>
						  <th>Event </br>Description</th>
						   <th>Event</th>
							<th>Share </br>Facebook</th>
							<th>Share </br>Twitter</th>
							<th>Share </br> Whatsapp</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr> 
                  </thead>
                  <tbody>
				  <?php
							
							  $i=1;
							  if (!empty($_GET)) {
							  if($_GET['val']=="facebook")
							  {
										$share='sharing_facebook';
										$getEvent=  displayEventShare($share);
										if($getEvent)
										{
										 foreach($getEvent as $row)
										{		
												?>
												<tr data-user-id=<?php echo $row['id']?>>
												<?php
												  echo ' <td class="hidden-xs">'.$i.'</td>
												  <td class="hidden-xs">'.$row['event_title'].'</td>
												  <td class="hidden-xs">'.$row['institution_name'].'</td>
												   <td class="hidden-xs">'.substr($row['event_description'],0,100).'</td>
												 
														 <td class="hidden-xs">'.$row['event'].'</td>
														<td class="hidden-xs">'.$row['sharing_facebook'].'</td>
														<td class="hidden-xs">'.$row['sharing_twitter'].'</td>
														<td class="hidden-xs">'.$row['sharing_whatsapp'].'</td>
												 <td align="center">
											   <button type="button" class="btn btn-default editEvent" value='.$row['id'].'><em class="fa fa-pencil"></em></button>  </td>
										   
												<td><form method="POST"><input type="hidden" name="id" value='.$row['id'].'><input type="submit" class="btn btn-danger fa fa-trash" name="delete" value="Delete"> </form> </td>
												 </tr>';
										  $i++;
									}}
							  }
							  elseif($_GET['val']=="twitter")
							  
							  {
										$share='sharing_twitter';
										$getEvent=  displayEventShare($share);
										if($getEvent)
										{
										 foreach($getEvent as $row)
										{
											?>
											<tr data-user-id=<?php echo $row['id']?>>
											<?php
											  echo ' <td class="hidden-xs">'.$i.'</td>
											  <td class="hidden-xs">'.$row['event_title'].'</td>
											 
											   <td class="hidden-xs">'.substr($row['event_description'],0,100).'</td>
											 	  <td class="hidden-xs">'.$row['institution_name'].'</td>
													 <td class="hidden-xs">'.$row['event'].'</td>
													<td class="hidden-xs">'.$row['sharing_facebook'].'</td>
													<td class="hidden-xs">'.$row['sharing_twitter'].'</td>
													<td class="hidden-xs">'.$row['sharing_whatsapp'].'</td>
											 <td align="center">
										   <button type="button" class="btn btn-default editEvent" value='.$row['id'].'><em class="fa fa-pencil"></em></button>  </td>
									   
											<td><form method="POST"><input type="hidden" name="id" value='.$row['id'].'><input type="submit" class="btn btn-danger fa fa-trash" name="delete" value="Delete"> </form> </td>
											 </tr>';
										$i++;
									}
									}
							  }
							   elseif($_GET['val']=="main")
							  
							  {
										$share='e.event';
										$getEvent=  displayEventShare($share);
										if($getEvent)
										{
										 foreach($getEvent as $row)
										{
											?>
											<tr data-user-id=<?php echo $row['id']?>>
											<?php
											  echo ' <td class="hidden-xs">'.$i.'</td>
											  <td class="hidden-xs">'.$row['event_title'].'</td>
											 	  <td class="hidden-xs">'.$row['institution_name'].'</td>
											   <td class="hidden-xs">'.substr($row['event_description'],0,100).'</td>
											 
													 <td class="hidden-xs">'.$row['event'].'</td>
													<td class="hidden-xs">'.$row['sharing_facebook'].'</td>
													<td class="hidden-xs">'.$row['sharing_twitter'].'</td>
													<td class="hidden-xs">'.$row['sharing_whatsapp'].'</td>
											 <td align="center">
										   <button type="button" class="btn btn-default editEvent" value='.$row['id'].'><em class="fa fa-pencil"></em></button>  </td>
									   
											<td><form method="POST"><input type="hidden" name="id" value='.$row['id'].'><input type="submit" class="btn btn-danger fa fa-trash" name="delete" value="Delete"> </form> </td>
											 </tr>';
											$i++;
									}
									}
							  }
							    else
							  {
							  
										$getEvent=  displayEvent();
										if($getEvent)
										{
										foreach($getEvent as $row)
										{
												?>
												<tr data-user-id=<?php echo $row['id']?>>
												<?php
												  echo ' <td class="hidden-xs">'.$i.'</td>
												  <td class="hidden-xs">'.$row['event_title'].'</td>
												 	  <td class="hidden-xs">'.$row['institution_name'].'</td>
												   <td class="hidden-xs">'.substr($row['event_description'],0,100).'</td>
												 
														 <td class="hidden-xs">'.$row['event'].'</td>
														<td class="hidden-xs">'.$row['sharing_facebook'].'</td>
														<td class="hidden-xs">'.$row['sharing_twitter'].'</td>
														<td class="hidden-xs">'.$row['sharing_whatsapp'].'</td>
												 <td align="center">
											   <button type="button" class="btn btn-default editEvent" value='.$row['id'].'><em class="fa fa-pencil"></em></button>  </td>
										   
												<td><form method="POST"><input type="hidden" name="id" value='.$row['id'].'><input type="submit" class="btn btn-danger fa fa-trash" name="delete" value="Delete"> </form> </td>
												 </tr>';
										  $i++;
									}
									}
								}
							  }
							  else
							  {
							  
										$getEvent=  displayEvent();
										if($getEvent)
										{
										foreach($getEvent as $row)
										{
												?>
												<tr data-user-id=<?php echo $row['id']?>>
												<?php
												  echo ' <td class="hidden-xs">'.$i.'</td>
												  <td class="hidden-xs">'.$row['event_title'].'</td>
												 	  <td class="hidden-xs">'.$row['institution_name'].'</td>
												   <td class="hidden-xs">'.substr($row['event_description'],0,100).'</td>
												 
														 <td class="hidden-xs">'.$row['event'].'</td>
														<td class="hidden-xs">'.$row['sharing_facebook'].'</td>
														<td class="hidden-xs">'.$row['sharing_twitter'].'</td>
														<td class="hidden-xs">'.$row['sharing_whatsapp'].'</td>
												 <td align="center">
											   <button type="button" class="btn btn-default editEvent" value='.$row['id'].'><em class="fa fa-pencil"></em></button>  </td>
										   
												<td><form method="POST"><input type="hidden" name="id" value='.$row['id'].'><input type="submit" class="btn btn-danger fa fa-trash" name="delete" value="Delete"> </form> </td>
												 </tr>';
										  $i++;
									}
									}
								}
								?>
							
							
						</tbody>
                </table>
            
              </div>
                
            </div>

        </div>
    </div>
				
			
				<div  class="row" id="eventForm" style="display: none;">
        <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default panel-table">
              <div class="panel-heading">
			    <div class="row">
                        
                  <div class="col col-xs-6">
				  
				  <h3 class="panel-title">Add Event </h3>
                  </div>
				  </div>
				  </div>
		 <div class="panel-body">
		
					  <form method="POST" action="" name="event" class="event" enctype="multipart/form-data">
					 
				  <div class="row">
                    <div class="col-lg-5">
							<input type="hidden" name="id" id="id" value="">
                       <div class="form-group">
                                <label>Event Title</label>
									
                                <input type="text" name="eTitle" id="eTitle" class="form-control" placeholder="Event Title" required>
                         </div>
		
					
						 
						 
						 
						<div class="form-group">
                                <label>Event Description</label>
                                <textarea  name="eDesc" id="eDesc" class="form-control" rows="3"  required></textarea>
                         </div>
						 <div id="img" class="actualyoutube" style="display:none">
						</div>
						<div class="form-group file fileNew">
                                <label class="fileName">upload Image/Video</label>
                                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*, video/mp4"  >
                         </div>
						 <input type="hidden" name="imageUrl" id="imageUrl" value="">
						 <input type="hidden" name="videoUrl" id="videoUrl" value="">
						 <div id="screenShots"></div>
						 <div id="screenShotsVideo"></div>
						<div class="form-group">
						 <label>select Institution</label>
								<select  class="form-control select2me  CCHasDefault "  id="changeEvent" name="cEvent" required>
						<option id="select_inst">Select</option>
									<?php foreach($getCollegeList as $row)
		{
		?>
			<option  value="<?php echo $row['id']; ?>"><?php echo $row['institution_name']; ?></option>
		<?php 
		}
		?>
								</select>
						</div>
						<div class="form-group">
                                <label>Sharing</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="facebook" id="share1" name="share[]">Facebook
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="twitter" id="share2" name="share[]">Twitter
                                    </label>
                          </div>
						    <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="whatsapp" id="share3" name="share[]">Whatsapp
                                    </label>
                          </div>
						  </div>
						  
						  <div class="form-group">
                              
								<?php $getEvent=getMainEvent();

							
								if($getEvent == 1)
								{
	
								?>
								<div class="radioEvent" style="display:none">
								 <label>Main Event or Not</label>
                                <div class="radio" >
                                    <label>
                                        <input type="radio" value="1" id="mainEvent1" name="mainEvent">yes
                                    </label>
									</div>
									<div class="radio" >
                                    <label>
                                        <input type="radio" value="0" id="mainEvent0" name="mainEvent" checked>no
                                    </label>
                                </div>
								</div>
								<?php } else {?>
							
									<div id="radioEvent" >
									<?php  echo "<script type='text/javascript'>changecss('radioEvent');</script>"; ?>
								  <label>Main Event or Not</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="1" id="mainEvent1" name="mainEvent" >yes
                                    </label>
                                </div>
								<div class="radio">
                                    <label>
                                        <input type="radio" value="0" id="mainEvent0" name="mainEvent" >no
                                    </label>
									  </div>
								<?php }?>
								
                                

						
						  </div>
						  <div class="form-group">
						  <input type="submit" class="btn btn-info" value="Save" name="event">
						   <button class="btn btn-info confirm" id="evn_cancel" name="evn_cancel" value="Cancel" type="button">Cancel </button>
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
    	       <!-- /.row -->

<?php
require('common/footer.php');
?>
<script>
function changecss(id) {
    document.getElementById(id).style.display = "block";
}
</script>

