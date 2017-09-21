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
    <div id="all-output" class="col-md-10 upload">
        	<div id="upload">
                <div class="row">
                    <!-- upload -->
                    <div class="col-md-8">
						<h1 class="page-title"><span>Upload</span> Video</h1>
						 <form role="form" id="search-form" action="video.php" method="post" enctype="multipart/form-data">
                        	<div class="row">
                            	<div class="clearfix"></div>
                            	<div class="col-md-12">
                                	<label>Video upload</label>
                                    <input id="upload_file" type="file" name="video" class="file">
                                </div>
                                    <div class="clearfix"></div>
                            	<div class="col-md-12">
                                	<label>Post Featured Image</label>
                                    <input id="featured_image" type="file" name="image" class="file">
                                </div>
                                   <div class="clearfix"></div>
                            	<div class="col-md-12">
                                    <button type="submit" id="contact_submit" class="btn btn-dm">Save your post</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- // col-md-8 -->
                     
                    <div class="col-md-4">
                    	<a href="#"><img src="images/upload-adv.png" alt=""></a>
                    </div><!-- // col-md-8 -->
                    <div class="col-lg-12" id="list">




                        </div>
                    <!-- // upload -->
                </div><!-- // row -->
            </div><!-- // upload -->
		</div>

<?php
require('common/footer.php');
?>
<script>
function changecss(id) {
    document.getElementById(id).style.display = "block";
}
</script>

