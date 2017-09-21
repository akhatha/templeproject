  var base_url=site_url;
  $(document).ready(function()
  {
 $("#tel_num").keypress(function (e) {
 
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
    
              return false;
    }

	return true;
   }); 
			//onclick contact 
			$("#creat_contact").click(function(){
			$("#cnctfrm").find('#contact_id').val('');
			$("#cnctfrm").find('#title').val('');
			$("#cnctfrm").find('#address').val('');
			$("#cnctfrm").find('#email').val('');
			$("#cnctfrm").find('#tel_num').val('');
			$("#cnctfrm").find('#siteurl').val('');
			 $("#add_contact").show();
			});
        
		//onlcick cancel function
		$("#cont_cancel").click(function(){
		var value=confirm("Are sure You want to Cancel");
		if(value==true)
		{
			
			$("#add_contact").hide();
			 
		}
		
		});
		
		//edit button 
		$(".contact_edit").click(function(){
				$(this).parents('.dataTables_wrapper').find('tr').removeClass('CCSelRow');
				var insId = $(this).parents('tr').eq(0).addClass('CCSelRow').attr('data-user-id');
				$("#add_contact").show();
				$('html,body').animate({
					scrollTop: $("#add_contact").offset().top},
					'slow');
				if(insId)
				{
						$.ajax({
						method: "GET",
						url: base_url+"/admin/api.php?action=contactEdit&id="+insId,
						dataType : "json",
						 success:function(data){
						  $("#contact_id").val(data.id);
							 $("#title").val(data.title);
							  
						   $("#address").val(data.address);
							  $("#email").val(data.email_id);
						   $("#tel_num").val(data.tel_number)
							  $("#siteurl").val(data.site_url);
						 
						   
						 }	
					});
				}		
        
         });
		 
		
     });
