
<?php
include('../function.php');
include('../config.php');
$getaction=$_GET['action'];
if(isset($_GET['id'])){
$id=$_GET['id'];
$action= $getaction."".$id;
}
switch($getaction)
{
		case 'instituteEdit': 
							 getInstitute($id);
		break;
		case 'eventeEdit': 
	
							 getEvent($id);
		break;
		case 'courseEdit': 
	
							 getCourse($id);
		break;
		case 'directoryEdit':
							getDirectory($id);
		break;
		case 'BranchEdit': 
	
							 getBranch($id);
		break;
		case 'admissionEdit':
							getAdmission($id);
		
		break;
		case 'contactEdit': 
	
							 getContact($id);
		break;
		case 'urlEdit': 
	
							 getUrl($id);
		case 'userEdit': 
	
							 getUser($id);
		break;
		
		break;
		
		case 'directoryDelete':
					deleteDirectory();	
		break;
		case 'branchDelete':
					deleteBranch();	
		break;
		
		case 'courseDelete':
					deleteCourse();
		break;
		case 'instituteDelete':
					deleteinstitute();
		break;
		case 'eventDelete':
				deleteEvent();
		
		break;
		case 'admissionDelete';
				deleteAdmission();
		break;
		case 'notificationDelete':
				deleteNotification();
		break;
		case 'checkMain':
				checkMain();
		break;
		default: 
					echo 'No action found';
		break;
	 }
	 
	 
	 
//function for get the institution details based on id 	 
function getInstitute($id)
{

		$query=mysql_query("SELECT id, institution_name FROM tbl_college_institution WHERE id=$id");
		while($row=mysql_fetch_array($query))
		{
                $data['id']=$row['id'];
				$data['institution_name']=$row['institution_name'];
				
		}

		echo json_encode($data);
}
//function for get the directory details 

function getDirectory($id)
{

	$query=mysql_query("SELECT id, directory_name,tel_number,image,email_id FROM  tbl_directory WHERE id=$id");
	while($row=mysql_fetch_array($query))
	{
                $data['id']=$row['id'];
				$data['directory_name']=$row['directory_name'];
				$data['tel_number']=$row['tel_number'];
				$data['image']=$row['image'];
				$data['email_id']=$row['email_id'];
				
	}

		echo json_encode($data);
	}
	
function getEvent($id)
{

		
		$query=mysql_query("SELECT e.id, e.event_title, e.event_description, e.image_url, e.video_url, e.college_id, c.institution_name, e.sharing_facebook, 
							e.sharing_twitter,e.sharing_whatsapp,e.event, e.create_date, c.institution_name
							FROM tbl_event AS e
							JOIN tbl_college_institution c ON c.id = e.college_id
							WHERE e.id =$id
							ORDER BY e.id DESC
							");
		while($row=mysql_fetch_array($query))
		{
                $data['id']=$row['id'];
				$data['event_title']=$row['event_title'];
				$data['institution_name']=$row['institution_name'];
				$data['event_description']=$row['event_description'];
				$data['college_id']=$row['college_id'];
				$data['institution_name']=$row['institution_name'];
				$data['image_url']=$row['image_url'];
				$data['video_url']=$row['video_url'];
				$data['event']=$row['event'];
				$data['sharing_facebook']=$row['sharing_facebook'];
				$data['sharing_twitter']=$row['sharing_twitter'];
				$data['sharing_whatsapp']=$row['sharing_whatsapp'];
			
				
		}

		echo json_encode($data);
}
	
function getCourse($id)
{

		$query=mysql_query("SELECT id, course_name FROM tbl_course WHERE id=$id");
		while($row=mysql_fetch_array($query))
		{
                $data['id']=$row['id'];
				$data['course_name']=$row['course_name'];
				
		}

		echo json_encode($data);
}
	
function getBranch($id)
{

		$query=mysql_query("SELECT id, course_id, branch_name, course_duration, course_intake, image, date FROM tbl_course_branch WHERE id=$id");
		while($row=mysql_fetch_array($query))
		{
                $data['id']=$row['id'];
				$data['course_id']=$row['course_id'];
				$data['branch_name']=$row['branch_name'];
				$data['course_duration']=$row['course_duration'];
				$data['course_intake']=$row['course_intake'];
				$data['image']=$row['image'];
		}

		echo json_encode($data);
}
	
function getContact($id)
{

		$query=mysql_query("SELECT id, title, address, tel_number, email_id, site_url FROM  tbl_contact WHERE id=$id");
		while($row=mysql_fetch_array($query))
		{
                $data['id']=$row['id'];
				$data['title']=$row['title'];
				$data['address']=$row['address'];
				$data['tel_number']=$row['tel_number'];
				$data['email_id']=$row['email_id'];
				$data['site_url']=$row['site_url'];
			
		}

		echo json_encode($data);
}
	
function getAdmission($id)
{

		
		$query=mysql_query("SELECT id,course_name,branch,	intake,eligibility,duration,fees FROM  tbl_courses
							 WHERE id=$id");
		while($row=mysql_fetch_array($query))
		{
                $data['id']=$row['id'];
				$data['course_name']=$row['course_name'];
				$data['branch']=$row['branch'];
				$data['intake']=$row['intake'];
				$data['eligibility']=$row['eligibility'];
				$data['duration']=$row['duration'];
				$data['fees']=$row['fees'];
				
		
		}

		echo json_encode($data);
}
function getUrl($id)
{
$query=mysql_query("SELECT id,url FROM  tbl_weburl WHERE id=$id");
		while($row=mysql_fetch_array($query))
		{
                $data['id']=$row['id'];
				$data['url']=$row['url'];
			
		}

		echo json_encode($data);
}
function getUser($id)
{

       $query=mysql_query("SELECT id,username,email_id FROM  tbl_users WHERE id=$id");
		while($row=mysql_fetch_array($query))
		{
                $data['id']=$row['id'];
				$data['username']=$row['username'];
				$data['email_id']=$row['email_id'];		

		}

		echo json_encode($data);
}	

	
	
function deleteDirectory()
{
	
		$result=mysql_query("DELETE FROM tbl_directory");
		if($result)
		{
			$status= 1;
		}
		else
		{
			$status= 0;
		}
		
		echo json_encode($status);
}
	
function deleteBranch()
{
	
		$result=mysql_query("DELETE FROM tbl_course_branch");
		if($result)
		{
			$status= 1;
		}
		else
		{
			$status= 0;
		}
		
		echo json_encode($status);
}
function deleteCourse()
{
	
		$result=mysql_query("DELETE FROM tbl_course");
		if($result)
		{
			$status= 1;
		}
		else
		{
			$status= 0;
		}
		
		echo json_encode($status);
}
function deleteinstitute()
{
		$result=mysql_query("DELETE FROM tbl_college_institution");
		if($result)
		{
			$status= 1;
		}
		else
		{
			$status= 0;
		}
		
		echo json_encode($status);
}
function deleteEvent()
{
		$result=mysql_query("DELETE FROM tbl_event");
		if($result)
		{
			$status= 1;
		}
		else
		{
			$status= 0;
		}
		
		echo json_encode($status);
}
function deleteAdmission()
{
		$result=mysql_query("DELETE FROM tbl_courses
");
		if($result)
		{
			$status= 1;
		}
		else
		{
			$status= 0;
		}
		
		echo json_encode($status);
}
function deleteNotification()
{
			$result=mysql_query("DELETE FROM tbl_notification");
		if($result)
		{
			$status= 1;
		}
		else
		{
			$status= 0;
		}
		
		echo json_encode($status);
}

function checkMain()
{

		$query=mysql_query("SELECT id,event FROM tbl_event WHERE event=1");
		while($row=mysql_fetch_array($query))
		{
		 $data['id']=$row['id'];
         $data['event']=$row['event'];
			
			
		}

		echo json_encode($data);
}

?>