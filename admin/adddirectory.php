<?php
ob_start();
include('../function.php');
include('../config.php');
require('common/header.php');
if(isset($_POST['direcorty']))
{

	$id=$_POST['id'];
	$dName=$_POST['dName'];
	$tNum=$_POST['tNum'];
	$email=$_POST['email'];
	$image='';$filename ='';
	$target_dir = "../uploads/directory/";
	if(isset($_FILES["fileToUpload"]["name"]))
	{
	
		$temp=explode(".",$_FILES["fileToUpload"]["name"]);
		$newfilename = time() . '_' . rand(100, 999) . '.' . end($temp);
		$fileName= $newfilename;
		$target_file = $target_dir."".$fileName;
		if (file_exists($target_file) && (!$id))
		{
		
			echo "<div class='alert alert-danger fade in' id='success'>
					<strong>Danger! </strong> Sorry, file already exists.Not uploaded!
					</div>";
					header("Refresh: 1;adddirectory.php");
			$url='NULL';
			
			
		}
		
		else
		{
				//uploadFile($target_file);
				$url=SITE_URL."/uploads/directory/". $fileName;	
				/*$upload_res=uploadFile($target_file);//upload a file
						
						
							if(!$upload_res)
							{ */
							
								move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
								$image=$url;
							//} 
		}
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);//checking file format
		$file=explode("/",$imageFileType);
		if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"|| $imageFileType == "gif" ) 
		{
				$image=$url;
		}
					
	}
	else
	{
		$image='NULL';
	}
	
	$chkDir=getName("tbl_directory","directory_name",$dName);//checking directory_name already exist or not
	if($chkDir &&  (!$id))
	{
		$mess="<div class='alert alert-danger fade in' id='success'>
						<strong>Danger! </strong> Directory  already Exist!
						</div>";
							header("Refresh: 1;adddirectory.php");
	}
	
	else
	{
	 if($_FILES["fileToUpload"]["name"] == '')
												 {
													$get_image=getResult('tbl_directory','id',$id);
													$image=$get_image['image'];
												  }
												else
												{
												$image=SITE_URL."/uploads/directory/".basename($newfilename); 
												}
		$data=array(
							'directory_name '=>$dName,
							'tel_number' 	=>$tNum,
							'image'=>$image,
							'email_id'=>$email,
							);
							
							if($id)
							{
						
								$result=updateName("tbl_directory",$data,$id);//if Id already exist update course data
								$mess="<div class='alert alert-success fade in' id='success'>
										<strong>Success!</strong> Updated Successfully.
										</div>";
											header("Refresh: 1;adddirectory.php");
							}
						else
						{
							$result=dbRowInsert('tbl_directory',$data);//if Id already doesnot exist insert data
							$mess="<div class='alert alert-success fade in' id='success'>
									<strong>Success!</strong> Sucessfully Inserted.
									</div>";
										header("Refresh: 1;adddirectory.php");
						}
						
						if(empty($result))
						{
						
							$mess="<div class='alert alert-danger fade in' id='success'>
							<strong>Danger! </strong> Something went wrong, go back and try again!
							</div>";
								header("Refresh: 1;adddirectory.php");
					
						}
	
	}
}
if(isset($_POST['delete']))
{
	$id=$_POST['id'];
				
				$dirId=mysql_query("SELECT id FROM tbl_directory WHERE id=$id");
				$getdir=mysql_fetch_array($dirId);
			
				if($getdir)
				{
				 mysql_query("DELETE FROM tbl_directory WHERE id=$id ");
				 
						 $mess= '<div class="alert alert-success fade in messages" id="success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Success!</strong> Data Deleted Successfully.
							</div>';
						
							header("Refresh: 1;adddirectory.php");
					
				
				}
				else
				{
						
					$mess= '<div class="alert alert-danger fade in messages" id="success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Falied!</strong> Failed to Delete
							</div>';	
							
						header("Refresh: 1;adddirectory.php");
				}

}



?>

        <div id="page-wrapper">
		
            <div class="container-fluid">
			<div class="col-lg-8">
                <h1 class="page-header">
                            Directory</h1>
                       
            </div>
                             
    <div  class="row" id="course_tbl_view">
        <div class="col-md-10 col-md-offset-1">
         		<div class="mess" ><?php if(isset($mess)){echo $mess;}?></div>
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Directory</h3>
                  </div>
			
					 
                  <div class="col col-xs-6 text-right">
							  	 
				
                    <button type="button" class="btn btn-sm btn-primary btn-create btnCreate" id="createNewDir">Create New</button>	
					 <button type="button" class="btn btn-sm btn-primary btn-create btnDelete" id="deleteDir">Delete All</button>	
					
				
				
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list paginationTable">
                  <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Directory Name</th>
                        <th>Telephone Number</th>
						<th>Email Id</th>
						<th>Edit</th>
						<th>Delete</th>
                    </tr> 
                  </thead>
                 <tbody>
				  <?php
							  $table_name='tbl_directory';
							$selectdir=displayResult($table_name); 
							  $i=1;
							  if($selectdir)
							  {
							    foreach($selectdir as $row)
                                {
								?>
								<tr data-user-id=<?php echo $row['id']?>>
								<?php
								  echo ' <td class="hidden-xs">'.$i.'</td>
								  <td class="hidden-xs">'.$row['directory_name'].'</td>
								 
								
								     <td class="hidden-xs">'.$row['tel_number'].'</td>
									
									     <td class="hidden-xs">'.$row['email_id'].'</td>
									
								 <td align="center">
                               <button type="button" class="btn btn-default editDir" value='.$row['id'].'><em class="fa fa-pencil"></em></button>  </td>
                           
							    <td><form method="POST"><input type="hidden" name="id" value='.$row['id'].'><input type="submit" class="btn btn-danger fa fa-trash" name="delete" value="Delete"> </form> </td>
								 </tr>';
						  $i++;
								}
								}
								?>
							
							
						</tbody>
                </table>
            
              </div>
                
            </div>

        </div>
    </div>
			<div  class="row" id="formDirectory" style="display: none;">
        <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default panel-table">
              <div class="panel-heading">
			    <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Add Directory </h3>
                  </div>
				  </div>
				  </div>
		
				 <div class="panel-body">
				  <form method="POST" action="" name="formDir" class="formDir" enctype="multipart/form-data">
				  <div class="row">
                    <div class="col-lg-5">
					<input type="hidden" name="id" id="id" value="">
                       <div class="form-group">
					 
                                <label>Directory Name</label>
                               
								<input type="text" class="form-control " placeholder="Directory Name"  id="dName"  name="dName" required><br>
					
                         </div>
						                        <div class="form-group">
					 
                                <label>Telephone Number </label>
                             <input type="text" class="form-control" placeholder="Telephone Number"   id="tNum"  name="tNum"  required  pattern=".{0}|.{16,}"   required title="Invalid mobile number" maxlength="16"><br>
								<!--<input type="tel" class="form-control " pattern="^\d{4}-\d{3}-\d{3}$" placeholder="Telephone Number"  id="tNum"  name="tNum" required ><br>-->
					
                         </div>
						                        <div class="form-group">
					 	 <div id="img" style="display:none">
						<a class="btn btn-info" name="image" id="newImg" >clickon Upload new image</a></div>
                               <div class="form-group file fileNew">
							   
                                 <input type="file" name="fileToUpload" id="fileToUpload">

                         </div>
					
                         </div>
						 
						                        <div class="form-group">
					 
                                <label>Email id</label>
                               
								<input type="email" class="form-control " placeholder="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email"  name="email" required><br>
					
                         </div>
						
						  <div class="form-group">
						   <input type="submit"  class="btn btn-info" value="save" name="direcorty">
						 <button class="btn btn-info confirm" id="dircancel" name="dircancel" value="Cancel" type="button">Cancel </button>
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
               

<?php
require('common/footer.php');
?>
