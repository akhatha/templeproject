<?php
ob_start();
include('../config.php');
include('../function.php');
require('common/header.php');
if(isset($_POST['weburl_add']))
{
	$web_url=$_POST['url_name'];
    $url_id=$_POST['url_id'];
          
			if($url_id)
			{
					$data=array(
						'url '=>$web_url,
						);
				$update_course=updateName('tbl_weburl',$data,$url_id);//if courseId already exist update course data
					$style= '<div class="alert alert-success fade in" id="success">
										<a href="#" class="close" data-dismiss="alert">&times;</a>
										<strong>Success!</strong> Updated successfully.
										</div>';
										header("Refresh: 1;addweburl.php");
				}
				
				
			else
			{
				$form_data=array('url'=>$web_url);
				$result_query=dbRowInsert('tbl_weburl',$form_data);//if courseId already doesnot exist insert data
						if($result_query)
						{
							$style= '<div class="alert alert-success fade in" id="success">
									<a href="#" class="close" data-dismiss="alert">&times;</a>
									<strong>Success!</strong> Data added successfully.
									</div>';
									header("Refresh: 1;addweburl.php");
						}
				
			}

 }

?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-header">
                            Website URL</h1>
                      
            </div>
                             
    <div  class="row" id="url_tbl_view">
        <div class="col-md-10 col-md-offset-1">
			<div class="mess">
         <?php if(isset($style)) { echo $style;} ?>
		 </div>
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                        
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Add Website URL</h3>
                  </div>
                 
                </div>
              </div>
              <div class="panel-body">
               <form method="post" name="url_frm" id="url_frm">
			   <?php $table_name='tbl_weburl';
                          $select_url=displayResult($table_name); 
                          $i=1;
						  if($select_url)
						  {
                          foreach($select_url as $row)
                                { ?>
              <div class="col-lg-5">
                       <div class="form-group">
                                <label>URL</label>
                                <input type="url" class="form-control" id="url_name" name="url_name" value="<?php echo $row['url'];?>" placeholder="Website URL" required>
                                <input  type="hidden" class="form-control" id="url_id" name="url_id" value="<?php echo $row['id'];?>">
                         </div>
						<?php }} ?>
						  <div class="form-group">
						  <input type="submit" class="btn btn-info" name="weburl_add" value="Submit">
						
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
