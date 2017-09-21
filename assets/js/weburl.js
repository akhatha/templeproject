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
        $("#create_url").click(function(){
				$("#url_frm").find('#url_name').val('');
				$("#url_frm").find('#url_id').val('');
				$("#add_url").show();
				$('html,body').animate({
				scrollTop: $("#add_url").offset().top},
				'slow');
        
			});
        
			//Onclick cancel button 
		 $(".cancel").click(function(){
			
			 var value=confirm("Are sure You want to Cancel");;
				if(value==true)
				{

				$("#add_url").hide();

				}	
		  
			});
	
        
			//Onclick edit button 
		$(".paginationTable").on('click','.url_edit',function() {
		  $(this).parents('.dataTables_wrapper').find('tr').removeClass('CCSelRow');
		  var insId = $(this).parents('tr').eq(0).addClass('CCSelRow').attr('data-user-id');
		  $("#add_url").show();
		  $('html,body').animate({
			scrollTop: $("#add_url").offset().top},
			'slow');
			 if(insId)
			 {
					$.ajax({
					method: "GET",
					url: base_url+"/admin/api.php?action=urlEdit&id="+insId,
					dataType : "json",
					 success:function(data){
						   $("#url_id").val(data.id);
					   $("#url_name").val(data.url);
					   
					 }
						
					});
			}		
        
         });
		 
		 	//Onclick cancel button 
		  $("#deleteUrl").click(function(){
			var value=confirm("Are sure You want to Delete");
			if(value==true)
			{
				$.ajax({
				method: "POST",
				url: base_url+"/admin/api.php?action=urlDelete",
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
				   window.location.href = "addweburl.php"
				  }, 2000);
			   
			 }
				
			});
			}
		 
		 });
		
     });
