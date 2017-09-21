var base_url=site_url;
$(document).ready(function(){
//onclick create new button function
  $("#createNewAdm").click(function(){
			$("#formAdmis").show();
			$('html,body').animate({
			scrollTop: $("#formAdmis").offset().top},
			'slow');
			$(".formAdmission").find('#id').val('');
				$(".formAdmission").find('#cName').val('');
				$(".formAdmission").find('#branch').val('');
					$(".formAdmission").find('#aIntake').val('');  
						$(".formAdmission").find('#aeligib').val('')
			
			$(".formAdmission").find('#aDuration').val('');    
			$(".formAdmission").find('#aFess').val('');   
			 
        
        });
 // onclick cancel button  function    
	$("#admiscancel").click(function(){
			var value=confirm("Are sure You want to Cancel");
			if(value==true)
			{
				
				$("#formAdmis").hide();
				 
			}
			
		});
		
// onclick edit button  function		
   $(".paginationTable").on('click','.editAdmission',function() {
				$("#formAdmis").show();
				$('html,body').animate({
				scrollTop: $("#formAdmis").offset().top},
				'slow');
				$(this).parents('.dataTables_wrapper').find('tr').removeClass('CCSelRow');
				var admId = $(this).parents('tr').eq(0).addClass('CCSelRow').attr('data-user-id');
				if(admId)
				{
					$.ajax({
					method: "GET",
					url: base_url+"/admin/api.php?action=admissionEdit&id="+admId,
					dataType : "json",
					success:function(data){
			// alert(data.id);
				console.log(data);
						$("#id").val(data.id);
					    $("#cName").val(data.course_name);
						$("#branch").val(data.branch);
					$("#aIntake").val(data.intake);
					    $("#aeligib").val(data.eligibility);
						
					    $("#aDuration").val(data.duration);
					    $("#aFess").val(data.fees);
						}
						
					});
			}		
        
         });
// onclick delete button  function
	 $("#deleteAdmission").click(function(){
		var value=confirm("Are sure You want to Delete");
		if(value==true)
		{
			$.ajax({
			method: "POST",
			url: base_url+"/admin/api.php?action=admissionDelete",
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
				   window.location.href = "addcourse.php"
				  }, 2000);
			   
			 }
				
			});
		}
		 
	});
		
     });
