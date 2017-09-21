var base_url=site_url;
 $(document).ready(function()
 {
			//custom validation for edit button
	$.validator.addMethod("fileExist", function(value, element) {
		if(parseInt($("#branchfrm").find('[name="branch_id"]').val()) > 0)
		{
			return true;
		}
		if(value == "")
		{
					return false
		}
				return true;
	}, "This field is required");
			
	//Form Validation
	 $("#branchfrm").validate({
				rules: {     
							branch : { required: true},
							course_select : {required: true},
							fileToUpload : {fileExist:true},
							duration : {required: true},
							intake : {required: true},	   
					  }
			});
			
	//onclick for cancel button
	$("#branch_cancel").click(function(){
		var value=confirm("Are sure You want to Cancel");
		if(value==true)
		{
			$(".add_branch").hide();

		}		  
		});
		   
		$('.paginationTable').DataTable();
		//onlick create new function
	$(".create_branch").click(function()
		{
				$("#branchfrm").find('#id').val('');
				$("#branchfrm").find('#branch').val('');
				$("#course_select").find('option:eq(0)').prop('selected', true);
				$("#branchfrm").find('#img').hide();
				$("#branchfrm").find('#duration').val('');
				$("#branchfrm").find('#intake').val('');
				$(".add_branch").show();
				$('html,body').animate({
				scrollTop: $(".add_branch").offset().top},
				'slow');
			});
				
		//onlick edit function
		$(".paginationTable").on('click','.branch_edit',function() 
		{

			var insId = $(this).closest('tr').find('.selected').val();
			$(".add_branch").show();
			$('html,body').animate({
					scrollTop: $(".add_branch").offset().top},
					'slow');
				
					 if(insId)
					 {
							$.ajax({
							method: "GET",
							url: base_url+"/admin/api.php?action=BranchEdit&id="+insId,
							dataType : "json",
							 success:function(data){
								   $("#branch_id").val(data.id);
								  $("#branch").val(data.branch_name);
								  $("#course_select").val(data.course_id);
								  $("#duration").val(data.course_duration);
								  console.log(data.image);
									$('#img').show();
								$('#img').html('<img height=100px; width=100px; src="' + data.image + '" />');
								   $("#intake").val(data.course_intake);
								 
							   
							 }
								
							});
					}		
			  
			 });
		//onlick dlete button function	 
		 $("#deleteBranch").click(function(){
				
				
					var value=confirm("Are sure You want to Delete");
					if(value==true)
					{
								$.ajax({
										method: "POST",
										url: base_url+"/admin/api.php?action=branchDelete",
										dataType : "json",
										success:function(data)
										{
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
	    