/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $(document).ready(function(){

$('.paginationTable').DataTable();
//onclick create new button
$("#create_pn").click(function(){
            $(".row_push_notify").show();
			 $('html,body').animate({
			scrollTop: $(".row_push_notify").offset().top},
			'slow');
        
        });
		
	//onclick delete button		  
$("#deleteNotification").click(function(){
	var value=confirm("Are sure You want to Delete");
	if(value==true)
	{
			$.ajax({
			method: "POST",
			url: base_url+"/admin/api.php?action=notificationDelete",
			dataType : "json",
		     success:function(data){
				if(data == 1)
				{
						$(".mess").html('<div class="alert alert-success">Sucessfully deleted</div>');
						
					
				}
				else
				{
						$(".mess").html('<div class="alert alert-danger fade in messages">Something went wrong, go back and try again!</div>');
				}
					
						 setTimeout(function() {
				   window.location.href = "notification.php"
				  }, 2000);
			   
			 }
				
			});
			}
		 
		 });
		
		});
        
		   