var base_url=site_url;
 $(document).ready(function(){

$('.paginationTable').DataTable();
//onclick create new button
$("#createNew").click(function(){
			$("#instituteForm").find('#cInstitute').val('');
			$("#instituteForm").find('#id').val('');
			 $("#instituteForm").show();
			 $('html,body').animate({
			scrollTop: $("#instituteForm").offset().top},
			'slow');
        
   });
//onclick cancel button    
$("#inst_cancel").click(function(){
		var value=confirm("Are sure You want to Cancel");
		if(value==true)
		{
			
			$("#instituteForm").hide();
			 
		}
		
		});
//onclick edit button		
		$(".paginationTable").on('click','.edit',function() {

		 	$("#instituteForm").show();
	
			$(this).parents('.dataTables_wrapper').find('tr').removeClass('CCSelRow');
			var insId = $(this).parents('tr').eq(0).addClass('CCSelRow').attr('data-user-id');
			 if(insId)
			 {
					$.ajax({
					method: "GET",
					url: base_url+"/admin/api.php?action=instituteEdit&id="+insId,
					dataType : "json",
					 success:function(data){
						   $("#id").val(data.id);
					   $("#cInstitute").val(data.institution_name);
					   
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
