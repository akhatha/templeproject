var base_url=site_url;

 $(document).ready(function(){

$('.paginationTable').DataTable();
//onclick create new button
$("#createUser").click(function(){
			$("#formUser").find('#user_name').val('');
			$("#formUser").find('#user_email').val('');
			$("#userForm").show();
			 $('html,body').animate({
			scrollTop: $("#userForm").offset().top},
			'slow');
        
   });
//onclick cancel button    
$("#user_cancel").click(function(){
		var value=confirm("Are sure You want to Cancel");
		if(value==true)
		{
			
			$("#userForm").hide();
			 
		}
		
		});
//onclick edit button		
$(".paginationTable").on('click','.edit',function() {
		 	$("#userForm").show();
			$('html,body').animate({
			scrollTop: $("#userForm").offset().top},
			'slow');
			$(this).parents('.dataTables_wrapper').find('tr').removeClass('CCSelRow');
			var insId = $(this).parents('tr').eq(0).addClass('CCSelRow').attr('data-user-id');
			 if(insId)
			 {
					$.ajax({
					method: "GET",
					url: base_url+"/admin/api.php?action=userEdit&id="+insId,
					dataType : "json",
					 success:function(data){
			
					$("#id").val(data.id);
					   $("#user_name").val(data.username);
					   $("#user_email").val(data.email_id);
					   
					 }
						
					});
			}		
			
         });
	//onclick delete all button
$("#deleteInstitute").click(function(){
			var value=confirm("Are sure You want to Delete");
			if(value==true)
			{
			$.ajax({
			method: "POST",
			url: base_url+"/admin/api.php?action=instituteDelete",
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
				   window.location.href = "addinstitution.php"
				  }, 2000);
			   
			 }
				
			});
			}
		 
		 });
});
