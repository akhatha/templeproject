<?php
ob_start();
require('common/header.php');
include('../config.php');
include('../function.php');

if(isset($_POST['branch_add']))
{
		$branch_id=$_POST['branch_id'];
		$branch=mysql_real_escape_string($_POST['branch']);
		$course_select=$_POST['course_select'];
		$course_duration=$_POST['duration'];
		$course_intake=$_POST['intake'];
		$newfilename = time().'_'.rand(1,99999) . '.' . end(explode(".",$_FILES["fileToUpload"]["name"]));
		$files_upload=explode(".",$newfilename);
		$target_dir = "../uploads/course_icons/";
		$target_file =$target_dir.basename($newfilename);
		$course_exit=getName('tbl_course_branch','branch_name',$branch);//check branch name laready exist or not'
	    $date = date('Y-m-d H:i:s');						
								if($course_exit && (!$branch_id))
								{
											$style= '<div class="alert alert-danger fade in messages" id="success">
																<a href="#" class="close" data-dismiss="alert">&times;</a>
																<strong>Falied!</strong> Branch Name Already Exist.
																</div>';
																header("Refresh: 1;addbranch.php");
								}
								else
								{
								
									if($branch_id)
									{
													
												 if($_FILES["fileToUpload"]["name"] == '')
												 {
													$get_image=getResult('tbl_course_branch','id',$branch_id);
													$image=$get_image['image'];
												  }
												else
												{
												$image=SITE_URL."/uploads/course_icons/".basename($newfilename); 
												}
												$form_data=array('branch_name'=>$branch,'course_id'=>$course_select,'course_duration'=>$course_duration,'course_intake'=>$course_intake,'image'=>$image,'date'=>$date);
											   $update_course=updateName('tbl_course_branch',$form_data,$branch_id);//if branch ID exist then update 
												$style= '<div class="alert alert-success fade in messages" id="success">
																	<a href="#" class="close" data-dismiss="alert">&times;</a>
																	<strong>Success!</strong> Updated successfully.
																	</div>';
																	header("Refresh: 1;addbranch.php");
									 }
												
										
									else
									{
											$tbl_name='tbl_course_branch';
											$image=SITE_URL."/uploads/course_icons/".basename($newfilename); 
											$form_data=array('branch_name'=>$branch,'course_id'=>$course_select,'course_duration'=>$course_duration,'course_intake'=>$course_intake,'image'=>$image,'date'=>$date);
											$result_query=dbRowInsert($tbl_name,$form_data);//if branch ID does not exist then insert 
												if($result_query)
													{
														$style= '<div class="alert alert-success fade in messages" id="success">
																<a href="#" class="close" data-dismiss="alert">&times;</a>
																<strong>Success!</strong> Data added successfully.
																</div>';
																header("Refresh: 1;addbranch.php");
													}
										}
										}
		if($files_upload[1]!='')
		{
							$upload_res=uploadFile($target_file);//upload a file
						
						
							if(!$upload_res)
							{
							
								move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
								
						
					}
		}
		
}
if(isset($_POST['delete']))
{
	$id=$_POST['id'];
				
				$brnchId=mysql_query("SELECT id FROM tbl_course_branch WHERE id=$id");
				$getBranch=mysql_fetch_array($brnchId);
			
				if($getBranch)
				{
				 mysql_query("DELETE FROM tbl_course_branch WHERE id=$id ");
				 
						 $style= '<div class="alert alert-success fade in messages" id="success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Success!</strong> Data Deleted Successfully.
							</div>';
						
							header("Refresh: 1;addbranch.php");
					
				
				}
				else
				{
						
					$style= '<div class="alert alert-danger fade in messages" id="success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Falied!</strong> Failed to Delete
							</div>';	
							
						header("Refresh: 1;addbranch.php");
				}

}
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-header">
                            Branch</h1>
                       
            </div>
                             
    <div  class="row" id="branch_tbl_view">
        <div class="col-md-10 col-md-offset-1">
		<div class="mess">
         <?php if(isset($style)) { echo $style;} ?>
		 </div>
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Panel Heading</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <button type="button" class="btn btn-sm btn-primary btn-create create_branch" id="create_branch">Create New</button>
					<button type="button" class="btn btn-sm btn-primary btn-create btnDelete" id="deleteBranch">Delete All</button>	
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list paginationTable">
                  <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Course Branch Name</th>
                         <th>Course Name</th>
                          <th>Course Duration</th>
						   <th>Intake</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr> 
                  </thead>
                  <tbody>
                         
                       <?php
                          $table_name='branchDisplay';
                          $select_course=branchTable($table_name);
                           $i=1;
                           while($row=mysql_fetch_assoc($select_course))
                            {                     
							  ?>
							<?php
											   echo '<tr><td class="hidden-xs">'.$i.'</td><td class="hidden-xs">'.$row['branch_name'].'</td><td class="hidden-xs">'.$row['course_name'].'</td></td><td class="hidden-xs">'.$row['course_duration'].'</td><td class="hidden-xs">'.$row['course_intake'].'</td><td align="center">
												<button type="button" class="btn btn-default branch_edit" value='.$row['id'].'><em class="fa fa-pencil"></em></button>  </td>
												 <td><form method="POST"><input type="hidden" name="id" value='.$row['id'].'><input type="submit" class="btn btn-danger fa fa-trash" name="delete" value="Delete"> </form> </td>
												<input type="hidden" class = "selected" value="'.$row['id'].'">
												</tr>';
                                       $i++;
                             
                                }?>                           
                        </tbody>
                </table>
            
              </div>
               
            </div>

        </div>
    </div>
            <div  class="row add_branch"  style="display: none;">
        <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Add Branch</h3>
                  </div>
                 
                </div>
              </div>
              <div class="panel-body">
             <form id="branchfrm" name="branchfrm"action="#" method="post" enctype="multipart/form-data">
				  <div class="row">
                    <div class="col-lg-12">
                       <div class="form-group">
                                <label>Branch Name</label>
                                <input class="form-control" id="branch" name="branch" placeholder="branch Name" >
								 <input  type="hidden" class="form-control" id="branch_id" name="branch_id" value="">
                         </div>
						<div class="form-group">
										 <label>Main courses</label>
								 <select name="course_select" id="course_select" class="form-control" >
									<option id="optn_id" >Select Course</option>
									<?php 
									$table_name='tbl_course';
									$select_course=displayResult($table_name);
									 foreach($select_course as $row)
									 {
										echo "<option value='" . $row['id'] . "'>" . $row['course_name'] . "</option>";
									}
									?>
								</select>
						</div>
						 <div id="img" style="display:none">
						<a class="btn btn-info" name="image" id="image" >clickon Upload new image</a></div>
						<div class="form-group fileNew">
                                <label>upload Image/Icon</label>

                                <input type="file" name="fileToUpload" id="fileToUpload" >
                         </div>
						  <div class="form-group">
                                <label>Course Duration</label>
                                <input type="number"  min="1" step=0.01 class="form-control" id="duration" name="duration" placeholder="duration" >
                         </div>
						   <div class="form-group">
                                <label>Course Intake</label>
                                <input type="number"  min="1" step=0.01 class="form-control" id="intake" name="intake" placeholder="intake" >
                         </div>
						  <div class="form-group">
						  <input type="submit" name="branch_add" class="btn btn-info" value="Submit Button">
						  <button class="btn btn-info confirm" id="branch_cancel" name="branch_cancel" value="Cancel" type="button">Cancel </button>
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
            </div>
      
				
                <!-- /.row -->

<?php
require('common/footer.php');
?>
