<?php
ob_start();
include('../config.php');
include('../function.php');
require('common/header.php');
if(isset($_POST['contact_add']))
{
	$contact_id=$_POST['contact_id'];
    $title=$_POST['title'];
    $address=$_POST['address'];
    $tel_num=$_POST['tel_num'];
    $email=$_POST['email'];
    $siteurl=$_POST['siteurl'];
	$tbl_name='tbl_contact';
	if($contact_id)
	{
			$form_data=array('title'=>$title,'address'=>$address,'tel_number'=>$tel_num,'email_id'=>$email,'site_url'=>$siteurl);
			 $update_course=updateName($tbl_name,$form_data,$contact_id);//if Id already exist update  data
			 $style= '<div class="alert alert-success fade in" id="success">
													<a href="#" class="close" data-dismiss="alert">&times;</a>
													<strong>Success!</strong> Updated successfully.
													</div>';
													header("Refresh: 1;contact.php");
	}
	else
	{
			$form_data=array('title'=>$title,'address'=>$address,'tel_number'=>$tel_num,'email_id'=>$email,'site_url'=>$siteurl);
			$result_query=dbRowInsert($tbl_name,$form_data);//if Id already does not exist insert  data
			if($result_query)
			{
				$style= '<div class="alert alert-success fade in" id="success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> Data added successfully.
						</div>';
						header("Refresh: 1;contact.php");
			}
	}
}
if(isset($_POST['delete']))
{
				$id=$_POST['id'];
				$brnchId=mysql_query("SELECT id FROM  tbl_contact WHERE id=$id");
				$getBranch=mysql_fetch_array($brnchId);
			
				if($getBranch)
				{
						mysql_query("DELETE FROM  tbl_contact WHERE id=$id ");
						 $style= '<div class="alert alert-success fade in" id="success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Success!</strong> Data Deleted Successfully.
							</div>';
							header("Refresh: 1;contact.php");
			
				}
				else
				{
						
					$style= '<div class="alert alert-danger fade in" id="success">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Falied!</strong> Failed to Delete
							</div>';	
							header("Refresh: 1;contact.php");
						
				}

}
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-header">
                            Contact</h1>
                        
            </div>
                             
    <div  class="row" id="course_tbl_view">
        <div class="col-md-10 col-md-offset-1">
         <?php if(isset($style)) { echo $style;} ?>
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Contact List</h3>
                  </div>
                
              </div>
			   </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Title</th>
						<th>Address</th>
						 <th>Telephone Number</th>
						 <th>Email Id</th>
						  <th>Site URL</th>
						   <th>Edit</th>
                        
                    </tr> 
                  </thead>
                  <tbody>
                         
                              <?php
                          $table_name='tbl_contact';
                          $select_contact=displayResult($table_name); 
                          $i=1;
                          foreach($select_contact as $row)
                           {
									?><tr data-user-id=<?php echo $row['id']?>>
									<?php
											   echo ' <td class="hidden-xs">'.$i.'</td><td class="hidden-xs">'.$row['title'].'</td><td class="hidden-xs">'.$row['address'].'</td><td class="hidden-xs">'.$row['tel_number'].'</td><td class="hidden-xs">'.$row['email_id'].'</td><td class="hidden-xs">'.$row['site_url'].'</td><td align="center">
									   <button type="button" class="btn btn-default contact_edit" value='.$row['id'].'><em class="fa fa-pencil"></em></button>  </td>
								<form method="POST"><input type="hidden" name="id" value='.$row['id'].'></form>
								  
								  </tr>';
                                   $i++;
                              }?> 
                        </tbody>
                </table>
            
              </div>
             
            </div>

        </div>
    </div>
            <div  class="row" id="add_contact" style="display: none;">
       <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Add Contact</h3>
                  </div>
               
                </div>
              </div>
              <div class="panel-body">
            
				<form name="cnctfrm" id="cnctfrm" action="#" method="post">
				  <div class="row">
                    <div class="col-lg-12">
                       <div class="form-group">
                                <label>Title</label>
                                <input id="title" name="title" class="form-control" placeholder="Title" required>
                         </div>
						<div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" id="address" name="address"  rows="3" required></textarea>
                         </div>
						<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
						</div>
						
						<div class="form-group">
						<label>Telephone Number</label>
                             
								<input type="text" class="form-control" placeholder="Telephone Number"  id="tel_num"  name="tel_num" required  pattern=".{0}|.{16,}"   required title="Invalid mobile number" maxlength="16"><br>
						
						</div>
						
						<div class="form-group">
                                <label>Site URL</label>
                                <input class="form-control"  type="url" id="siteurl" name="siteurl" placeholder="http://nitte.edu.in" required>
                         </div>
						   <input  type="hidden" class="form-control" id="contact_id" name="contact_id" value="">
						  <div class="form-group">
						  <input type="submit" class="btn btn-info" name="contact_add"  value="Add Contact Details">
						   <button class="btn btn-info confirm" id="cont_cancel" name="cont_cancel" value="Cancel" type="button">Cancel </button>
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
      
				
            
<?php
require('common/footer.php');
?>