var base_url=site_url;
$(document).ready(function(){
	  //validate form 
	  $(".event").validate({

        rules: {     
                eTitle : { required: true},
				eDesc : {required: true},
				fileToUpload : {required: true},
                changeEvent : {required: true},
				
               
        }
});
$('.paginationTable').DataTable();
//Onlclick cancel button
$("#evn_cancel").click(function(){
		var value=confirm("Are sure You want to Cancel");
		if(value==true)
		{
			
			 $("#eventForm").hide();
			 
		}
		
		});
//Onlclick create new button 
		$("#createNewEvent").click(function(){
					
					$.ajax({
						  url: base_url+"/admin/api.php?action=checkMain",
						  dataType : "json",
							success: function(data){
								if(data.event == 1)
							{
							
								$('.radioEvent').hide();
							
							}
							else
							{
					
								$('.radioEvent').show();
							}
								
							 }
						  });
					$("#eventForm").find('#eTitle').val('');
					$("#eventForm").find('#eDesc').val('');
				    $("#eventForm").find('#fileToUpload').val('');
					$("#changeEvent").find('option:eq(0)').prop('selected', true);
					$("#eventForm").find('#id').val('');
					$("#eventForm").find('img').remove();
					$("#eventForm").find('video').remove();
					$('.checkbox :checked').removeAttr('checked');
					$('.fileNew').show();
					$('#newImg').hide();
					$("#eventForm").show();
					$('html,body').animate({
					scrollTop: $("#eventForm").offset().top},
					'slow');
				});
        
		
//Onlclick edit button 		
		$(".paginationTable").on('click','.editEvent',function() {
					$('#img').show();
					$('#fileToUpload').rules("remove");
					$(this).parents('.dataTables_wrapper').find('tr').removeClass('CCSelRow');
					var eventId = $(this).parents('tr').eq(0).addClass('CCSelRow').attr('data-user-id');
					$("#eventForm").show();
					$('html,body').animate({
					scrollTop: $("#eventForm").offset().top},
					'slow');
					if(eventId)
					{
	 
						$.ajax({
						method: "GET",
						url: base_url+"/admin/api.php?action=eventeEdit&id="+eventId,
						dataType : "json",
						success:function(data)
						{
					
							var video=data.video_url;
							var image=data.image_url;
							$('#id').val(data.id);
							$('#eTitle').val(data.event_title);
							$('#changeEvent').val(data.institution_name);
							$('#eDesc').val(data.event_description);
							$('#screenShots').html('<img name="imgName" src="' + data.image_url + '" height="100" width="100"  />');
							if(data.video_url)
							{
									$('#screenShotsVideo').html(
									'<video width="320" height="240" controls id="video">  <source src="'+ data.video_url +'" type="video/mp4"  codecs="avc1.42E01E, mp4a.40.2" /> </video>');
						
							}

							$('#changeEvent').val(data.college_id);
							if(data.sharing_facebook == 1)
							{
							
								$('#share1').val("facebook").prop('checked', true);
						
							}
							else
							{
						
								$('#share1').val("facebook").prop('checked', false);
							
							}
							if(data.sharing_twitter == 1)
							{
									
								$('#share2').val("twitter").prop('checked', true);
							}
							else
							{
							
								$('#share2').val("twitter").prop('checked', false);
							
							}
							if(data.sharing_whatsapp == 1)
							{
									
								$('#share3').val("whatsapp").prop('checked', true);
							}
							else
							{
							
								$('#share3').val("whatsapp").prop('checked', false);
							
							}

							if(data.event == 1)
							{
							
								$('#mainEvent1').val("1").prop('checked', true);
								$('.radioEvent').show();
							
							}
							else
							{
						
								$('#mainEvent0').val("0").prop('checked', true);
								$('.radioEvent').hide();
							}
										   
						 }
							
						});
	}		
        
         });
		 
//onclick deelet event function
  $("#deleteEvent").click(function(){
			var value=confirm("Are sure You want to Delete");
			if(value==true)
			{
				$.ajax({
				method: "POST",
				url: base_url+"/admin/api.php?action=eventDelete",
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
				   window.location.href = "addevent.php"
				  }, 2000);
			   
			 }
				
			});
			}
		 
		 });
		
		
     });

	 
