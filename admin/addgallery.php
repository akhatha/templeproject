<?php
ob_start();
include('../function.php');
include('../config.php');
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
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gallery</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                               <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                   
                                    <h5>Upload Gallery Here</h5>
                                    <form role="form" id="search-form" action="upload.php" method="post" enctype="multipart/form-data">
                                
                                <div class="form-group has-success ">
                                    <label class="control-label" for="inputSuccess">Choose Gallery</label>
                                    <input type="file" id="upload_file" name="image[]" onchange="preview_image(event);" multiple/>

                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Upload</button>
                            </form>
                                   
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                               <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-12" id="list">




                        </div>
                        
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
		<?php
require('common/footer.php');
?>


        <!-- /#page-wrapper -->