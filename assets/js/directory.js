var base_url=site_url;
 $(document).ready(function(){
 //onclick create new button
       $("#createNewDir").click(function(){
       $("#formDirectory").show();
	   $('html,body').animate({
		scrollTop: $("#formDirectory").offset().top},
		'slow');
		$(".formDir").find('#dName').val('');
		$(".formDir").find('#tNum').val('');
		$(".formDir").find('#id').val('');
		$(".formDir").find('#fileToUpload').val('');
		$(".formDir").find('#email').val('');
		$('img').hide('');
			 
        
        });
      //onclick cancel button   
		$("#dircancel").click(function(){
		var value=confirm("Are sure You want to Cancel");
		if(value==true)
		{
			
			$("#formDirectory").hide();
			 
		}
		
		});
		
		//Onlclick edit function
         $(".paginationTable").on('click','.editDir',function() {
	
				$("#formDirectory").show();
				$('html,body').animate({
				scrollTop: $("#formDirectory").offset().top},
				'slow');
				$(this).parents('.dataTables_wrapper').find('tr').removeClass('CCSelRow');
				var dirId = $(this).parents('tr').eq(0).addClass('CCSelRow').attr('data-user-id');
				$('#img').show();
			 if(dirId)
			{
					$.ajax({
					method: "GET",
					url: base_url+"/admin/api.php?action=directoryEdit&id="+dirId,
					dataType : "json",
					 success:function(data)
					 {
								   $("#id").val(data.id);
									$("#dName").val(data.directory_name);
									$("#tNum").val(data.tel_number);
									$('#img').html('<img src="' + data.image + '" height="100" width="100" />');
									$("#email").val(data.email_id);
					   
					}
						
					});
			}		
        
         });
		 //Onlclick delete function
		 $("#deleteDir").click(function(){
			var value=confirm("Are sure You want to Delete");
			if(value==true)
			{
				$.ajax({
				method: "POST",
				url: base_url+"/admin/api.php?action=directoryDelete",
				dataType : "json",
				success:function(data){
					if(data == 1)
					{
						$(".mess").html('<div class="alert alert-success">Sucessfully deleted</div>');
					}
					else
					{
						$(".mess").html('<div class="alert alert-success">Something went wrong, go back and try again!</div>');
					}
					
					
						 setTimeout(function() {
				   window.location.href = "adddirectory.php"
				  }, 2000);
			   
			 }
				
			});
			}
		 
		 });
     });
