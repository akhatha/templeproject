<?php
ob_start();
include('../function.php');
include('../config.php');
require('common/header.php');
if(isset($_POST['videoUpload']))
{
	$id=$_POST['id'];
	$videoName=$_POST['vTitle'];
	$fileToVideoUpload=null;
	$fileToImageUpload=null;
	$target_video_dir = "../uploads/videos/";
	$target_image_dir = "../uploads/images/";

	$image='';
	$video='';
	if(isset($_FILES["fileToImageUpload"]["name"]))
	{
		$temp=explode(".",$_FILES["fileToImageUpload"]["name"]);
		$newfilename = time() . '_' . rand(100, 999) . '.' . end($temp);
		$fileName=$newfilename;
		$target_file =$target_image_dir."".$fileName;
		$imageupload=uploadFile($target_file);//upload a file if file doesnot exist
		$videourl=SITE_URL."/uploads/videos/".$fileName;
		
	}
	
	if(isset($_FILES["fileToVideoUpload"]["name"]))
	{
		$temps=explode(".",$_FILES["fileToVideoUpload"]["name"]);
		$newfilenames = time() . '_' . rand(100, 999) . '.' . end($temps);
		$fileNames=$newfilenames;
		$target_files =$target_video_dir."".$fileNames;
		$imageupload=uploadVideoFile($target_files);//upload a file if file doesnot exist
		$imageurl=SITE_URL."/uploads/videos/".$fileNames;
		
	}
	
	$data=array(
							'name'=>$videoName,
							'feature_image' 	=>$imageurl,
							'video_path'=>$videourl,
							'video_url'=>$video,
							'video_ext'=>'mp4'
							
						);
						$result=dbRowInsert('uploadvideo',$data);
						
						
}
?>
<div id="page-wrapper">
		
            <div class="container-fluid">
			<div class="col-lg-8">
                <h1 class="page-header">
                            Add Videos</h1>
					
            </div>
<div  class="row" id="course_tbl_view">
        <div class="col-md-10 col-md-offset-1">
<div class="mess" ><?php if(isset($mess)){echo $mess;}?></div>
<div class="panel panel-default panel-table">
<div class="panel-heading">
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
                        <th>Video Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr> 
                  </thead>
                  <tbody>
				  <?php
							
							?>
							
							
						</tbody>
                </table>
            
              </div>
			  </div>
			   </div>
			  
<div  class="row" id="eventForm" style="display: none;">
        <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default panel-table">
              <div class="panel-heading">
			    <div class="row">
                        
                  <div class="col col-xs-6">
				  
				  <h3 class="panel-title">Add Video </h3>
                  </div>
				  </div>
				  </div>
		 <div class="panel-body">
		
					  <form method="POST" action="" name="event" class="event" enctype="multipart/form-data">
					 
				  <div class="row">
                    <div class="col-lg-5">
							<input type="hidden" name="id" id="id" value="">
                       <div class="form-group">
                                <label>video Title</label>
									
                                <input type="text" name="vTitle" id="vTitle" class="form-control" placeholder="video Title" required>
                         </div>
					
						 <div id="img" class="actualyoutube" style="display:none">
						</div>
						<div class="form-group file fileNew">
                                <label class="fileName">upload Image/Video</label>
                                <input required="" type="file" name="fileToVideoUpload" id="fileToVideoUpload" accept="video/mp4"  >
                         </div>
						 
						 <div class="form-group file fileNew">
                                <label class="fileName">upload featured Image</label>
                                <input required=""type="file" name="fileToImageUpload" id="fileToImageUpload" accept="image/*"  >
                         </div>
						 <input type="hidden" name="imageUrl" id="imageUrl" value="">
						 <input type="hidden" name="videoUrl" id="videoUrl" value="">
						 <div id="screenShots"></div>
						 <div id="screenShotsVideo"></div>
						  <div class="form-group">
						  <input type="submit" class="btn btn-info" value="Save" name="videoUpload">
						   <button class="btn btn-info confirm" id="evn_cancel" name="evn_cancel" value="Cancel" type="button">Cancel </button>
							</div>
							
                   
                </div>
				</div>
				</form>
				</div>
					</div>
					</div>
					</div>
					 </div></div>
					  </div></div>
<?php
require('common/footer.php');
?>