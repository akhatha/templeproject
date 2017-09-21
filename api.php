<?php
include('config.php');
include('function.php');
$action=$_REQUEST['action'];


switch($action)
 {
		case 'directory': 
					directorys();
		break;
		
		
		case 'contact':
					contact();
		break;
		
		
		case 'event':
					event();
		break;
				
				
		case 'courses':
					courses();
		break;
		
				
		case 'facebook':
					getFacebook();
		break;
		
				
		case 'twitter':
					getTwitter();
		break;
		case 'whatsapp':
					getWhatsapp();
		break;
		
		case 'map':
					getMapDetails();
		break;
		
		
		case 'admission':
				getadmission();
		break;
		
		case 'user':
				insertUser();
		break;
		
		case 'notification':
				notification();
		break;
		
		case 'notificationDetails':
				notificationDetails();
		break;
		case 'weburl':
				urlDetails();
		break;
		case 'nitteapps':
				nitteApps();
		break;
		
		case 'sendmail':
				sendMail();
		break;
		default: 
					echo 'No action found';
		break;
	 }

//function for displaying directorying API
function directorys()
{
	 
			$response=displayResult('tbl_directory');
			if(isset($response))
			{
				$responseDir=array("status"=>STATUS,"response"=>$response);
			}
			else
			{
					$responseDir=array("status"=>"failed");
			}
			
			echo json_encode($responseDir);

}
//function for sharing facebook information API	 
function getFacebook()
{
		$share="sharing_facebook";
		$response=displayEventShare($share);
		if(isset($response))
			{
				$responseDir=array("status"=>STATUS,"response"=>$response);
			}
			else
			{
					$responseDir=array("status"=>"failed");
			}
			
			
			echo json_encode($responseDir);
		
		
}
//function for sharing twitter information API
function getTwitter()
{
		$share="sharing_twitter";
		$response=displayEventShare($share);
		if(isset($response))
			{
				$responseDir=array("status"=>STATUS,"response"=>$response);
			}
			else
			{
					$responseDir=array("status"=>"failed");
			}
			
		
			
			echo json_encode($responseDir);
}
function getWhatsapp()
{
		$share="sharing_whatsapp";
		$response=displayEventShare($share);
		if(isset($response))
			{
				$responseDir=array("status"=>STATUS,"response"=>$response);
			}
			else
			{
					$responseDir=array("status"=>"failed");
			}
			
		
			
			echo json_encode($responseDir);
}
//function for get all map details information
function getMapDetails()
{
		$response=displayMarkerDetails();
		if(isset($response))
			{
				$responseDir=array("status"=>STATUS,"response"=>$response);
			}
			else
			{
					$responseDir=array("status"=>"failed");
			}
			
		
			
			echo json_encode($responseDir);
}
//function for displaying contact API 	 
function contact()
{
		
		$response=displayResult('tbl_contact');
		if(isset($response))
		{
		$responseCont=array("status"=>STATUS,"response"=>$response);
		}
		else
		{
		$responseCont=array("status"=>"failed");
		}
		echo json_encode($responseCont);


}	
//function for event API displayed main event and other event 
function event()
{
		$mainEvent=getMainEvent();
		if($mainEvent==1)
		{
				$maininstituteName=getmaineventInstituteName();
				while($row=mysql_fetch_assoc($maininstituteName))
			   {
					   
					$name=$row['institution_name'];
					$data=array("name" => $row['institution_name']);
					$event=displayMainEvent($name);
					while($rowEvent=mysql_fetch_assoc($event))
					{
							 
						$data["data"][]= $rowEvent;
			
					}
					$main[]=$data;
			   }
		}
		else
		{
			//$data[""]='';
			// $main[]=$data;
			$main=array();
		}
		
        $otherinstituteName=getotherInstituteName();
		$row_cnt=mysql_num_rows($otherinstituteName);
		while($row=mysql_fetch_assoc($otherinstituteName))
	   
	   {
			$name=$row['institution_name'];
			$data1=array("name" => $row['institution_name']);
			$event=displayOtherEvent($name);
		   while($rowEvent=mysql_fetch_assoc($event))
		   {
						  
				$data1["data"][]= $rowEvent;
			}
				$others[]=$data1;
	   }
		$responseCourse='';
		if($mainEvent==1 && $row_cnt==0)
		{
		$responseCourse=array("status"=>STATUS,"response"=>array("main"=>$main));
		
		}
		else if($others)
		{
				$responseCourse=array("status"=>STATUS,"response"=>array("main"=>$main,"others"=>$others));
		}
		
		else
		{
			$responseCourse=array("status"=>"failed");
		}
                	
			echo json_encode($responseCourse);
}
//function for courses API 		
function courses()
{
	   $displyCourse=courseDisplay();
		   while($row=mysql_fetch_assoc($displyCourse))
		   {
				$data=array("name" => $row['course_name']);
				$data["data"][]= $row;
				$response[]=$data;	
			}	 
		if(isset($response))
			{
				$responseDir=array("status"=>STATUS,"response"=>$response);
			}
		else
			{
					$responseDir=array("status"=>"failed");
			}
		echo json_encode($responseDir); 
	
}
//get all the admision detail API based on branch name
function getadmission()
{
		$disAdmission=admissionTable();
	
	  while($row=mysql_fetch_assoc($disAdmission))
	   
	   {
		$branch=$row['branch_name'];
		$data=array("name" => $row['branch_name']);
		$data["data"][]= $row;
		$response[]=$data;	
		}
		
		$resAdmission='';
		if(isset($data))
			{
				$resAdmission=array("status"=>STATUS,"response"=>$response);
			}
		else
			{
			$resAdmission=array("status"=>"failed");
			}
                	
			echo json_encode($resAdmission);
		
}
//function for insert user with registration Id and device Id            
function insertUser()
{
			$regid= $_GET['regid'];
			$device_id=$_GET['device_id'];
            $createDate=date("Y-m-d H:i:s");
            $form_data=array('regId'=>$regid,'device_id'=>$device_id,'create_date'=>$createDate);
			if(($regid!='' &&  $device_id!=''))
			{
			$getDeviceId=getName("tbl_reg_users","device_id",$device_id);
	
			if($getDeviceId)
			{
				
				$user=UpdateUser($regid, $createDate, $device_id);
			}
			else
			{	
				
				$user=dbRowInsert('tbl_reg_users',$form_data);
			
			}
			}
			
			
           if(isset($user))
			{
				$resp=array("status"=>STATUS);
			}
		else
			{
			$resp=array("status"=>"failed");
			}
		
			  
			echo json_encode($resp);
}
	 

	
function notification()
{
			$response=notifications('tbl_notification');
			if(isset($response))
			{
				$responseDir=array("status"=>STATUS,"response"=>$response);
			}
			else
			{
					$responseDir=array("status"=>"failed");
			}
			
			echo json_encode($responseDir);
}
		
//function get all the notifcation details
function notificationDetails()
{
			$id= $_GET['id'];
			if($id!='')
			{
				$getId=getName("tbl_notification","id",$id);
			}
	
			if($getId)
			{
				$getResult=getNotifications($id);
				$resp=array("status"=>STATUS,"response"=>$getResult);
			}
			else
			{	
				
				$resp=array("status"=>"failed");
			
			}
			
			echo json_encode($resp);
}

function urlDetails()
{

$response=displayResult('tbl_weburl');
			if(isset($response))
			{
				$responseDir=array("status"=>STATUS,"response"=>$response);
			}
			else
			{
					$responseDir=array("status"=>"failed");
			}
			
			echo json_encode($responseDir);
}
function nitteApps()
{

$response=displayResult('tbl_nitteapp');
			if(isset($response))
			{
				$responseDir=array("status"=>STATUS,"response"=>$response);
			}
			else
			{
					$responseDir=array("status"=>"failed");
			}
			
			echo json_encode($responseDir);
}
/*
function sendMail()
{
	$email_address='mobileapp@nitte.edu.in';
	
	$from_address=$_POST['from_address'];
	$message1=$_POST['message'];
	$message=html_entity_decode(htmlentities($message1));
	$phone=$_POST['phone'];
	$name=$_POST['name'];
	
		$email_body = "";
        $email_body = $email_body . "Name: " . $name . "<br>";
        $email_body = $email_body . "Email: " . $from_address . "<br>";
        $email_body = $email_body . "Phone No: " . $phone. "<br>";
		$email_body = $email_body . "Message: " . $message;


	require_once('PHPMailer/PHPMailerAutoload.php');
	$mail= new PHPMailer();
	$mail->isSMTP(); 
	$mail->Host = "smtp.gmail.com"; 
	$mail->SMTPAuth = true;                            
	$mail->Username = 'diyasystest@gmail.com';  
	$mail->Password = 'diyatest@123';                         
	$mail->Port = 465;
	$mail->SMTPDebug = 2;    
	$mail->SMTPDebug = 3;
	$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
); 
	$mail->SMTPSecure = 'ssl';
	$mail->isHTML(true);  
	$mail->SetFrom($from_address, $name);
	$mail->AddReplyTo($from_address);
    $mail->AddAddress($email_address, "Nitte");
    $mail->Subject = "Nitte Contact Form Submission";
    $mail->MsgHTML($email_body);
	
	if(!$mail->send())
			{
				$response='Message Sending Falied';
				$responseDir=array("status"=>"failed","response"=>$response);
				
			}
			else
			{
				$response='Message send sucessfully';
				$responseDir=array("status"=>'success',"response"=>$response);
			}
			
			echo json_encode($responseDir);
			
}	*/
function sendMail()
{
	$email_address='mobileapp@nitte.edu.in';
	
	$from_address=$_POST['from_address'];
	$message1=$_POST['message'];
	$message=html_entity_decode(htmlentities($message1));
	$phone=$_POST['phone'];
	$name=$_POST['name'];
	
		$email_body = "";
        $email_body = $email_body . "Name: " . $name . "<br>";
        $email_body = $email_body . "Email: " . $from_address . "<br>";
        $email_body = $email_body . "Phone No: " . $phone. "<br>";
		$email_body = $email_body . "Message: " . $message;


	require_once('PHPMailer/PHPMailerAutoload.php');
	$mail= new PHPMailer();
	$mail->isSMTP(); 
	//$mail->Host = "smtp.gmail.com"; 
	$mail->Host = 'tls://smtp.gmail.com:587';
	$mail->SMTPAuth = true;                            
	$mail->Username = 'diyasystest@gmail.com';  
	$mail->Password = 'diyatest@123';                         
	$mail->Port = 587;
	$mail->SMTPDebug = 2;    
	$mail->SMTPDebug = 3;
	$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
); 
	$mail->SMTPSecure = 'tls';
	$mail->isHTML(true);  
	$mail->SetFrom($from_address, $name);
	$mail->AddReplyTo($from_address);
    $mail->AddAddress($email_address, "Nitte");
    $mail->Subject = "Nitte Contact Form Submission";
    $mail->MsgHTML($email_body);
	
	if(!$mail->send())
			{
				$response='Message Sending Falied';
				$responseDir=array("status"=>"failed","response"=>$response);
				
			}
			else
			{
				$response='Message send sucessfully';
				$responseDir=array("status"=>'success',"response"=>$response);
			}
			
			echo json_encode($responseDir);
			
}	
?>