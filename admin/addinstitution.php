<?php
ob_start();
include('../function.php');
include('../config.php');
require('common/header.php');
if(isset($_POST['collInstitute']))
{
	$id=$_POST['id'];
	$result='';
	$collInstitue=null;
	$mess=null;
	$color=null;
	$createDate=date("Y-m-d H:i:s");
	$collInstitue=$_POST['cInstitute'];
	$existInstitue=getName("tbl_college_institution","institution_name",$collInstitue);
	if($existInstitue && (!$id))//checking institution_name already exist or not
	{
		$mess="<div class='alert alert-danger fade in' id='success'>
						<strong>Danger! </strong> Institution Name Already Exist!
						</div>";
	}
	else
	{
		$data=array(
						'institution_name '=>$collInstitue,
						'create_date' 	=>$createDate
					);
					if($id)//if Id already exist update institute data
					{
							$result=updateName("tbl_college_institution",$data,$id);	
							$mess="<div class='alert alert-success fade in' id='success'>
									<strong>Success!</strong> Updated Successfully.
									</div>";
										header("Refresh: 1;addinstitution.php");
					}
					else
					{
							$result=dbRowInsert("tbl_college_institution",$data);//if Id already doesnot exist insert data	
							$mess="<div class='alert alert-success fade in' id='success'>
									<strong>Success!</strong> Sucessfully Inserted.
									</div>";
									header("Refresh: 1;addinstitution.php");
					}
	
		if(empty($result))
		{
			$mess="<div class='alert alert-danger fade in' id='success'>
						<strong>Danger! </strong> Something went wrong, go back and try again!
						</div>";
						header("Refresh: 1;addinstitution.php");
		}
		
	}

}
if(isset($_POST['delete']))
{
	$id=$_POST['id'];
	$eId='';
	$instituteId='';
	$query=mysql_query("SELECT id, institution_name FROM tbl_college_institution WHERE id=$id");
	while($row=mysql_fetch_array($query))
	{
          $instituteId=$row['id'];
				
	}
				
	$eventId=mysql_query("SELECT 	college_id FROM tbl_event WHERE college_id=$instituteId");
	$getEvent=mysql_fetch_array($eventId);
	if($getEvent)
	{
		$mess="<div class='alert alert-danger fade in' id='success'>
				<strong>Danger! </strong> Something went wrong, go back and try again!
				</div>";
				header("Refresh: 1;addinstitution.php");
				
	}
	else
	{
		$mess="<div class='alert alert-success fade in' id='success'>
				<strong>Success! </strong> Sucessfully Deleted
				</div>";
				header("Refresh: 1;addinstitution.php");
		 mysql_query("DELETE FROM tbl_college_institution WHERE id =$instituteId ");
						
	}

}
?>

        <div id="page-wrapper">
		
            <div class="container-fluid">
			<div class="col-lg-8">
                <h1 class="page-header">
                            Institution</h1>
                       
            </div>
                             
    <div  class="row" id="course_tbl_view">
        <div class="col-md-10 col-md-offset-1">
         		<div class="mess" ><?php if(isset($mess)){echo $mess;}?></div>
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Institution</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <button type="button" class="btn btn-sm btn-primary btn-create btnCreate" id="createNew">Create New</button>
					<button type="button" class="btn btn-sm btn-primary btn-create btnInstitute" id="deleteInstitute">Delete All</button>	
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list paginationTable">
                  <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Institution Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr> 
                  </thead>
                  <tbody>
                         
                              <?php
                          $table_name='tbl_college_institution';
                          $selectInstitute=displayResult($table_name); 
						  $i=1;
						  if($selectInstitute)
						  {
                          foreach($selectInstitute as $row)
                                {
								?>
										<tr data-user-id=<?php echo $row['id']?>>
										<?php
											   echo ' <td class="hidden-xs">'.$i.'</td><td class="hidden-xs">'.$row['institution_name'].'</td>
											   <td align="center">
												<button type="button" class="btn btn-default edit" value='.$row['id'].'><em class="fa fa-pencil"></em></button>  </td>
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
			<div  class="row" id="instituteForm" style="display: none;">
        <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default panel-table">
              <div class="panel-heading">
			    <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Add Institution </h3>
                  </div>
				  </div>
				  </div>
		
				 <div class="panel-body">
				  <form method="POST" action="" name="formInstitute" class="formInstitute">
				  <div class="row">
                    <div class="col-lg-5">
					<input type="hidden" name="id" id="id" value="">
                       <div class="form-group">
					 
                                <label>Institution Name</label>
                               
								<input type="text" class="form-control " placeholder="Institution Name"  id="cInstitute"  name="cInstitute" required><br>
					
                         </div>
						
						  <div class="form-group">
						   <input type="submit"  class="btn btn-info" value="save" name="collInstitute">
						  <button class="btn btn-info confirm" id="inst_cancel" name="inst_cancel" value="Cancel" type="button">Cancel </button>
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
