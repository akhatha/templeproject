  var base_url=site_url;
  $(document).ready(function(){
	$('.paginationTable').DataTable();
	if ($('.paginationTable tr').length < 11) 
	{
           $('.dataTables_paginate').hide();
	}
	
	 if($('.paginationTable tr').length >11)
	{
		$('.dataTables_paginate').show();
	}
		//Onclick course create function
        $("#creat_course").click(function(){
				$("#course_frm").find('#course').val('');
				$("#course_frm").find('#course_id').val('');
				$("#add_course").show();
				$('html,body').animate({
				scrollTop: $("#add_course").offset().top},
				'slow');
        
			});
        
			//Onclick cancel button 
		 $(".cancel").click(function(){
			
			 var value=confirm("Are sure You want to Cancel");;
				if(value==true)
				{

				$("#add_course").hide();

				}	
		  
			});
	
        
			//Onclick edit button 
		$(".paginationTable").on('click','.course_edit',function() {
		  $(this).parents('.dataTables_wrapper').find('tr').removeClass('CCSelRow');
		  var insId = $(this).parents('tr').eq(0).addClass('CCSelRow').attr('data-user-id');
		  $("#add_course").show();
		  $('html,body').animate({
			scrollTop: $("#add_course").offset().top},
			'slow');
			 if(insId)
			 {
					$.ajax({
					method: "GET",
					url: base_url+"/admin/api.php?action=courseEdit&id="+insId,
					dataType : "json",
					 success:function(data){
						   $("#course_id").val(data.id);
					   $("#course").val(data.course_name);
					   
					 }
						
					});
			}		
        
         });
		 
		 	//Onclick cancel button 
		  $("#deleteCourse").click(function(){
			var value=confirm("Are sure You want to Delete");
			if(value==true)
			{
				$.ajax({
				method: "POST",
				url: base_url+"/admin/api.php?action=courseDelete",
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
				   window.location.href = "addbranch.php"
				  }, 2000);
			   
			 }
				
			});
			}
		 
		 });
		
     });
