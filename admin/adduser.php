<?php
ob_start();
include('../function.php');
include('../config.php');
require('common/header.php');
if(isset($_POST['save_user']))
{
	$id=$_POST['id'];
	$result='';
	$createDate=date("Y-m-d H:i:s");
	$username=$_POST['user_name'];
	$useremail=$_POST['user_email'];
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
    $usr_pswd = substr( str_shuffle( $chars ), 0, 8 );
    $password= md5($usr_pswd);
	$existEmail=getName("tbl_users","email_id",$useremail);
	$existUser=getName("tbl_users","username",$username);
	if($existUser && (!$id))//checking user username already exist or not
	{
		$mess="<div class='alert alert-danger fade in' id='success'>
						<strong>Oops! </strong> UserName Already Exist!
						</div>";
	}
	else if($existEmail && (!$id))//checking user email already exist or not
	{
		$mess="<div class='alert alert-danger fade in' id='success'>
						<strong>Oops! </strong> Email Already Exist!
						</div>";
	}
	else
	{
		
		
		$data=array(
						'username '=>$username,
						'password' =>$password,
						'email_id'=>$useremail,
						'created_date'=>$createDate
					);
					if($id)//if Id already exist update
					{
									
									//if(mysql_num_rows($existEmail)>0)
									//{
										$result=updateName("tbl_users",$data,$id);	
									    $mess="<div class='bs-example'>
											<div class='alert alert-success fade in'>
												<a href='#' class='close' data-dismiss='alert'>&times;</a>
												<strong>Success!</strong> Your message has been sent successfully.
											</div>
										</div>";
												
									//}
									/*else
									{
										$mess="<div class='alert alert-danger fade in' id='success'>
													<strong>Oops! </strong> UserName or Email Already Exist!
													</div>";
									}*/
								
					}
					else
					{
							
						
							$result=dbRowInsert("tbl_users",$data);//if Id already doesnot exist insert data	
							$mess="<div class='bs-example'>
											<div class='alert alert-success fade in'>
												<a href='#' class='close' data-dismiss='alert'>&times;</a>
												<strong>Success!</strong> User added successfully.
												<div class='control-group'>
											  <label class='control-label'>User Name : &nbsp".$username."</label></br>
											  <label class='control-label'>Password  : &nbsp".$usr_pswd."</label>
											</div>
											</div>
										</div>";
					
	
									//header("Refresh: 1;adduser.php");
								
					}
		
	}

}
if(isset($_POST['delete']))
{                               
				global $conn;
				$userId=$_POST['id'];
				$uId='';
				$query=mysql_query("SELECT * FROM tbl_users WHERE id=$userId");
				while($row=mysql_fetch_array($query))
				{
					$uId=$row['id'];
					$usertype=$row['user_type'];
				
				}
				if($uId)
				{
					$mess="<div class='alert alert-success fade in' id='success'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
						<strong>Success! </strong> Sucessfully Deleted
						</div>";
						$query=mysql_query("DELETE FROM tbl_users WHERE id =$uId ");
				}
			
				else
				{
					$mess="<div class='alert alert-danger fade in' id='success'>
						<strong>Danger! </strong> Something went wrong, go back and try again!
						</div>";
						header("Refresh: 1;adduser.php");
				}
}
?>
<div id="page-wrapper">
            <div class="container-fluid">
			<div class="col-lg-8">
                <h1 class="page-header">Add User</h1> 
            </div>             
    <div  class="row" id="user_tbl_view">
        <div class="col-md-10 col-md-offset-1">
         		<div class="mess" ><?php if(isset($mess)){echo $mess;}?></div>
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Users</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                    <button type="button" class="btn btn-sm btn-primary btn-create btnCreate" id="createUser">Create New</button>	
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list paginationTable">
                  <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>User Name</th>
					<!--<th>User Email</th> -->
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr> 
                  </thead>
                  <tbody>
                     <?php
                          $table_name='tbl_users';
                          $selectUsers=displayResult($table_name); 
						  $i=1;
						  if($selectUsers)
						  {
                          foreach($selectUsers as $row)
                                {
								?>
										<tr data-id=<?php echo $row['id']?>>
										<?php
											   echo '<td class="hidden-xs">'.$i.'</td><td class="hidden-xs">'.$row['username'].'</td>
											   <td align="center">
												<button data-user-id='.$row['username'].' data-email-id='.$row['email_id'].' data-id='.$row['id'].' type="button" class="btn btn-default edit" value='.$row['id'].'><em class="fa fa-pencil"></em></button>  </td>
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
<div  class="row" id="userForm" style="display: none;">
        <div class="col-md-10 col-md-offset-1">
         <div class="panel panel-default panel-table">
              <div class="panel-heading">
			    <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Add User </h3>
                  </div>
				  </div>
				  </div>
				 <div class="panel-body">
				  <form method="POST" action="" name="formUser" class="formUser">
					  <div class="row">
						<div class="col-lg-5">
						<input type="hidden" name="id" id="id" value="">
						   <div class="form-group">
									<label>User Name</label>
									<input type="text" class="form-control " placeholder="User Name"  id="user_name"  name="user_name" required><br>
							 </div>
							 		<div class="form-group">
									<label>User Email</label>
									<input type="email" class="form-control " placeholder="User Email"  id="user_email"  name="user_email"><br>
							 </div>
							  <div class="form-group">
							   <input type="submit"  class="btn btn-info" value="Save" name="save_user">
							  <button class="btn btn-info confirm" id="user_cancel" name="user_cancel" value="Cancel" type="button">Cancel </button>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
$( document ).ready(function() {
    $('.edit').click(function(){
	var id=$(this).data('id');
	var username=$(this).data('user-id');
	var email=$(this).data('email-id');
	$('#id').val(id);
	$('#user_name').val(username);
	$('#user_email').val(email);
	
});
});


</script>
<?php
require('common/footer.php');
?>



