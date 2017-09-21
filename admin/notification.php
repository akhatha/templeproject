<?php
ob_start();
include('../function.php');
include('../config.php');
require('common/header.php');
if(isset($_POST['notify_add']))
{
   $title=$_POST['pn_title'];
  
   $pn_desc=mysql_real_escape_string($_POST['pn_desc']);
   $message=$title.''.$pn_desc;
   $image='';
  if($_FILES["fileToUpload"]["name"])
	{
		$newfilename = time().'_'.rand(1,99999) . '.' . end(explode(".",$_FILES["fileToUpload"]["name"]));
		$target_dir = "../uploads/notification_icons/";
		$target_file =$target_dir.basename($newfilename);
		$upload_res=uploadFile($target_file);
		$image=SITE_URL."/uploads/notification_icons/".basename($newfilename); 
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	}
	$user_res=displayResult('tbl_reg_users');
	$createDate=date("Y-m-d H:i:s");
	$device_count=count($user_res);
    foreach($user_res as $row)
    {

	$regIds[]=$row['regId'];
	
    }
	$form_data=array('pn_title'=>$title,'pn_description'=>$pn_desc,'pn_image'=>$image,'pn_date'=>$createDate);
	$result_query=dbRowInsert('tbl_notification',$form_data);//insert the data
	$last_id=mysql_insert_id();
	$message_data= json_encode(array("title" => $title,"image"=>$image,"id"=>$last_id));
	$message = array("message" => $message_data);
	$push_notification=send_push_notification($regIds,$message);//sending push notification for anroid registered users
	//$ios_push_notification=send_push_notification_ios($regIds,$message);
	// print_r($push_notification);exit;
	if($result_query && $push_notification)
	{
			$style= '<div class="alert alert-success fade in" id="success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Success!</strong> Message Send Sucessfully
							</div>';
							header("Refresh: 1;notification.php");
	}
	else
	{
				
				$style= "<div class='alert alert-danger fade in' id='success'>
							<strong>;Danger! </strong> Something went wrong, go back and try again!
							</div>";
							header("Refresh: 1;notification.php");
	}
}
if(isset($_POST['delete']))
{
	$id=$_POST['id'];
				
				$notId=mysql_query("SELECT id FROM tbl_notification WHERE id=$id");
				$getNotice=mysql_fetch_array($notId);
			
				if($getNotice)
				{
				 mysql_query("DELETE FROM tbl_notification WHERE id=$id ");
						 $style= '<div class="alert alert-success fade in" id="success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Success!</strong> Data Deleted Successfully.
							</div>';
					header("Refresh: 1;notification.php");
				
				}
				else
				{
						
					$style= '<div class="alert alert-danger fade in" id="success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Falied!</strong> Failed to Delete
							</div>';	
						header("Refresh: 1;notification.php");
				}

}

?>

        <div id="page-wrapper">
		
            <div class="container-fluid">
			   <div class="row">
                    <div class="col-lg-8">
                        <h2 class="page-header">
                           Push Notification
                        </h2>
                       
                    </div>
                </div>
			    <div  class="row" id="pn_tbl_view">
        <div class="col-md-10 col-md-offset-1">
		<div class="mess">
         <?php if(isset($style)) { echo $style;} ?></div>
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Notification Result</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <button type="button" class="btn btn-sm btn-primary btn-create" id="create_pn">Create New</button>
					<button type="button" class="btn btn-sm btn-primary btn-create btnNotification" id="deleteNotification">Delete All</button>	
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list paginationTable">
                  <thead>
                    <tr>
                        <th>NotificationID</th>
                        <th>Title</th>
                         <th>Description</th>
                          <th>Push Date</th>
						  <th>Delete</th>
                    </tr> 
                  </thead>
                  <tbody>
                           <?php
                          $table_name='tbl_notification';
                          $select_course=displayResult($table_name); 
                          $i=1;
						  if($select_course)
						  {
                          foreach($select_course as $row)
                                {
									?><tr data-user-id=<?php echo $row['id']?>>
									<?php
											   echo ' <td class="hidden-xs">'.$i.'</td><td class="hidden-xs">'.$row['pn_title'].'</td><td class="hidden-xs">'.$row['pn_description'].'</td><td class="hidden-xs">'.$row['pn_date'].'</td><td><form method="POST"><input type="hidden" name="id" value='.$row['id'].'><input type="submit" class="btn btn-danger fa fa-trash" name="delete" value="Delete"> </form> </td>                        
								  </tr>
								  
								  ';
											   $i++;
                               }
							   }?>
                            
                        </tbody>
                </table>
            
              </div>
               
            </div>

        </div>
    </div>	
              
                
		<div  class="row_push_notify" style="display:none">
			<div class="col-md-10 col-md-offset-1">
			
				<div class="panel panel-default panel-table">
				  <div class="panel-heading">
					<div class="row">
						<div class="col col-xs-6">
				
						<h3 class="panel-title">Push Notification</h3>
					  </div>
					</div>
				</div>
              <div class="panel-body">
             <form id="notifyfrm" name="notifyfrm"action="#" method="post" enctype="multipart/form-data">
				  <div class="row">
                    <div class="col-lg-12">
                       <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" id="pn_title" name="pn_title" placeholder="Title" required>
								 <input  type="hidden" class="form-control" id="" name="" value="">
                         </div>
						  <div class="form-group">
                                <label>Description</label>
								 <textarea  id="pn_desc" name="pn_desc" placeholder="Description" class="form-control" rows="3"  required></textarea>
                               
                         </div>
						<div class="form-group fileNew">
                                <label>upload Image/Icon</label>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                         </div>
						 <hr>
						
						
						  <div class="form-group">
						  <input type="submit" name="notify_add" class="btn btn-info" value="Send Notification">
						  <button class="btn btn-info confirm" id="pn_cancel" name="pn_cancel" value="Cancel" type="button">Cancel </button>
							</div>
							<hr>
							
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