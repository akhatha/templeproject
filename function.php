<?php

//function for insertquery
function dbRowInsert($table_name, $form_data)
{
    // retrieve the keys of the array (column titles)
    $fields = array_keys($form_data);

    // build the query
    $sql = "INSERT INTO ".$table_name."
    (".implode(",", $fields).")
    VALUES('".implode("','", $form_data)."')";
    // run and return the query result resource

    return mysql_query($sql);
}


//function for displaying data
function displayResult($table_name)
{
	$query=mysql_query("SELECT * FROM $table_name ORDER BY id desc");
	  if(mysql_num_rows($query)>0)
        {
			while($row=mysql_fetch_assoc($query))
			{
						
						$result[]=$row;
			}
			return $result;
	}
}
//function for displaying all the event information
function displayEvent()
{
			$query=mysql_query("SELECT e.id,e.event_title,e.event_description,e.image_url,e.video_url,e.college_id,c.institution_name,e.	sharing_facebook,e.sharing_twitter,e.sharing_whatsapp,e.event,e.create_date,c.institution_name FROM tbl_event as e 
									 JOIN tbl_college_institution c ON c.id=e.college_id
									 ORDER BY e.id DESC");
			while($row=mysql_fetch_assoc($query))
			{
						
						$result[]=$row;
			}

			if(!empty($result))
			
			{
				return $result;
			}
}


function getMainEvent()
{
			$query=mysql_query("SELECT * FROM tbl_event WHERE event=1");
			$row=mysql_fetch_assoc($query);
			$result= $row['event'];
			if(isset($result))
			{
				return $result;
			}
			else
			{		
				return  false;
			}

}

//function for disaplying notification details
function notifications()
{
	$query=mysql_query(" SELECT pn_title,pn_description,pn_image,pn_date FROM tbl_notification ORDER BY id DESC LIMIT 0 , 20 ");
	if(mysql_num_rows($query)>0)
     {
			while($row=mysql_fetch_assoc($query))
			{
						
						$result[]=$row;
			}
			return $result;
	}
}


function getNotifications($id)
{
	$query=mysql_query(" SELECT id,pn_title,pn_description,pn_image,pn_date
							FROM tbl_notification
							WHERE id=$id");
	
	  if(mysql_num_rows($query)>0)
      {
			while($row=mysql_fetch_assoc($query))
			{
						
						$result[]=$row;
			}
			return $result;
	}
}
//display all the admission details
function displayAdmission()
{
	$query=mysql_query("SELECT id, course_name,branch,	intake,eligibility,duration,fees FROM  tbl_courses
							 ORDER BY id DESC
							 ");
	while($row=mysql_fetch_assoc($query))
	{
				
				$result[]=$row;
	}
	if(!empty($result))
	{
	return $result;
	}
}
//dispaly event share based on facebook,twitter or main event
function displayEventShare($share)
{
			$query=mysql_query("SELECT e.id,e.event_title,e.event_description,e.image_url,e.video_url,e.college_id,c.institution_name,e.	sharing_facebook,e.sharing_twitter,e.sharing_whatsapp,e.event,e.create_date,c.institution_name FROM tbl_event as e 
									 JOIN tbl_college_institution c ON c.id=e.college_id
									 WHERE $share=1
									 ORDER BY e.id DESC");
	
			while($row=mysql_fetch_assoc($query))
			{
				
				$result[]=$row;
			}
			if(!empty($result))
			{
				return $result;
			}
}

function displayMarkerDetails()
{
			$query=mysql_query("SELECT name,address,lat,lng,type FROM tbl_markers");
			while($row=mysql_fetch_assoc($query))
			{
						
						$result[]=$row;
			}
			return $result;
}

function displayDashboardEvent()
{
			$query=mysql_query(" SELECT e.id, e.event_title, e.event_description, e.image_url, e.video_url, e.college_id, c.institution_name, e.sharing_facebook,
								e.sharing_twitter,e.sharing_whatsapp,e.event, e.create_date, c.institution_name
								FROM tbl_event AS e
								JOIN tbl_college_institution c ON c.id = e.college_id
								ORDER BY e.id DESC
								LIMIT 0 , 4 ");
			while($row=mysql_fetch_assoc($query))
			{
						
						$result[]=$row;
			}
			if(!empty($result))
			{
				return $result;
			}
}


function registerUsers()
{
		$query=mysql_query("SELECT COUNT( * ) as total
		FROM tbl_reg_users");
		$result=mysql_fetch_assoc($query);
		return $result['total'];

}

function getSharFacebookCount()
{
		$query=mysql_query("SELECT COUNT( * ) as total
		FROM tbl_event AS e
		JOIN tbl_college_institution c ON c.id = e.college_id
		WHERE sharing_facebook =1");
		$result=mysql_fetch_assoc($query);
		return $result['total'];
}

//checking email already exist or not
function getEmail($username)
{
			$query=mysql_query("SELECT * FROM  tbl_users WHERE username ='$username' ");
			$row=	mysql_fetch_assoc($query);
			$result= $row['email_id'];
			if(isset($result))
			{
				return $result;
			}
			else
			{		
				return  false;
			}
		
}

//function for update profile		
function updateProfile($pass,$user,$email)
{
			
		return mysql_query("UPDATE tbl_users SET password = MD5('$pass'),email_id='$email'  WHERE username = '$user'");
				
}


function getEventCount()
{
			$query=mysql_query("SELECT COUNT( * ) as total
				FROM tbl_event AS e
				JOIN tbl_college_institution c ON c.id = e.college_id");
				$result=mysql_fetch_assoc($query);
				return $result['total'];
}

function getNotificationCount()
{
		$query=mysql_query("SELECT COUNT( * ) as total
			FROM tbl_notification ");
			$result=mysql_fetch_assoc($query);
			return $result['total'];
}

function getSharTwitterCount()
{
		$query=mysql_query("SELECT COUNT( * ) as total
		FROM tbl_event AS e
		JOIN tbl_college_institution c ON c.id = e.college_id
		WHERE sharing_twitter =1");
		$result=mysql_fetch_assoc($query);
		return $result['total'];
}

function getMainEventCount()
{
		$query=mysql_query("SELECT COUNT( * ) as total
		FROM tbl_event AS e
		JOIN tbl_college_institution c ON c.id = e.college_id
		WHERE event =1");
		$result=mysql_fetch_assoc($query);
		return $result['total'];
}

//function for upload file
function uploadFile($target_file)
{

		$uploadOk = 1;
		 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		if (file_exists($target_file))
		{
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		
		if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF" && $imageFileType != "mp4" && $imageFileType != "MP4" && $imageFileType != "wmv" && $imageFileType != "WMV") 
		{
			echo "sorry wrong file uploaded.";
			$uploadOk = 0;
		}
// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) 
		{
			echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
		} 
		else
		{
			if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
			{
				echo "Sorry, there was an error uploading your file.";
			}
		}
	
		
}


function getmaineventInstituteName()
{
		
			$instituteName=mysql_query("SELECT c.institution_name,e.event FROM tbl_event as e 
							 JOIN tbl_college_institution c ON c.id=e.college_id WHERE e.event = '1'
							 GROUP BY c.institution_name");
			
				return $instituteName;
}

function getotherInstituteName()
		
{
		
		$instituteName=mysql_query("SELECT c.institution_name,e.event FROM tbl_event as e 
									 JOIN tbl_college_institution c ON c.id=e.college_id WHERE e.event = '0'
									 GROUP BY c.institution_name");
		return $instituteName;
}
		
//function for displaymain Event based on instituteName		
function displayMainEvent($instituteName)
{
		$event=mysql_query("SELECT e.event_title,e.event_description,e.image_url,e.video_url,e.college_id,c.institution_name,e.	sharing_facebook,e.sharing_twitter,e.sharing_whatsapp,e.event,e.create_date,c.institution_name FROM tbl_event as e 
							 JOIN tbl_college_institution c ON c.id=e.college_id
							 	WHERE c.institution_name='$instituteName' AND  e.event = '1'");

			return $event;
}
//function for displayOtherEvent  based on instituteName		

function displayOtherEvent($instituteName)
{
		$event=mysql_query("SELECT e.event_title,e.event_description,e.image_url,e.video_url,e.college_id,c.institution_name,e.	
							sharing_facebook,e.sharing_twitter,e.sharing_whatsapp,e.event,e.create_date,c.institution_name FROM tbl_event as e 
							JOIN tbl_college_institution c ON c.id=e.college_id
							 WHERE c.institution_name='$instituteName' AND  e.event = '0'");
			
		
			return $event;
}


function courseDisplay()
		
{
			$query=mysql_query("SELECT course_name,branch,intake,eligibility,duration ,fees FROM tbl_courses");
			return $query;
		/*	if(mysql_num_rows($query)>0)
		{
			while($row=mysql_fetch_assoc($query))
			{
							
				$result[]=$row;
			}
				return $result;
		} */
			
}
		
		
function branchDisplay($course)
{
			$branchdisplay=mysql_query("SELECT cb.course_id,cb.branch_name,cb.image,cb.date,c.course_name,cb.course_duration,cb.course_intake FROM tbl_course_branch AS cb JOIN tbl_course c ON c.id = cb.`course_id` WHERE c.course_name='$course'");
			return $branchdisplay;
			
}
	
//checking user laready exist based on username ,email and pwd	
function user_exist($username,$password)
{
			$pass=md5($password);
			$query=mysql_query("SELECT * FROM  tbl_users WHERE (username='$username' OR email_id='$username')AND password='$pass' ");
			$user=	mysql_fetch_assoc($query);
			$username= $user['username'];
			if(isset($username))
			{
				return $username;
			}
			else
			{		
				return false;
			}			
}
//common function for selecting name and value
function getName($tableName,$fieldName,$value)
{
			$query=mysql_query("SELECT * FROM  $tableName WHERE $fieldName ='$value' ");
			$row=	mysql_fetch_assoc($query);
			$result= $row[$fieldName];
			
			if(isset($result))
			{
				return $result;
			}
			else
			{		
				return  false;
			}
		
}
function getResult($tableName,$fieldName,$value)
{
			$query=mysql_query("SELECT * FROM  $tableName WHERE $fieldName ='$value' ");
			$result=	mysql_fetch_assoc($query);
		
			
			if(isset($result))
			{
				return $result;
			}
			else
			{		
				return  false;
			}
		
}
//common function for updating data
function updateName($tableName,$data,$id)
{
				
				 $cols = array();
				foreach($data as $key=>$val) 
				{
					$cols[] = "$key = '$val'";
				}
				$sql = mysql_query("UPDATE $tableName SET " . implode(', ', $cols) . " WHERE id=$id");
			
				return $sql;
		
}

//updateuser if devide id already exist		
function UpdateUser($regId,$create_date,$devide_id)
{
			$sql=mysql_query("UPDATE tbl_reg_users SET regId = '$regId', create_date = '$create_date' WHERE device_id='$devide_id'");
			return $sql;
}

function branchTable()
{
			$branchdisplay=mysql_query("SELECT cb.id,cb.course_id,cb.branch_name,cb.image,cb.date,c.course_name,cb.course_duration ,cb.course_intake FROM tbl_course_branch AS cb JOIN tbl_course c ON c.id = cb.`course_id` ORDER BY id desc");
			return $branchdisplay;
			
}

function admissionTable()
{
			$admissiondis=mysql_query("SELECT ad.id , ad.branch_id ,cb.branch_name, ad.description , ad.guidance , ad.eligibility , ad.intake , 	ad.course_duration , ad.create_date
			FROM tbl_admission AS ad
			JOIN tbl_course_branch cb ON ad.branch_id= cb.id
			ORDER BY id DESC");
			return $admissiondis;
		
}


//function for sending push notifcation using anroid
function send_push_notification($registatoin_ids, $message) {
			
			 
                // Set POST variables
                $url = 'https://android.googleapis.com/gcm/send';

                $fields = array(
                    'registration_ids' => $registatoin_ids,
                    'data' => $message,
                );

                $headers = array(
                    'Authorization: key=' . GOOGLE_API_KEY,
                    'Content-Type: application/json'
                );
                  
                // Open connection
                $ch = curl_init();

                // Set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);

                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Disabling SSL Certificate support temporarly
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

                // Execute post
                $result = curl_exec($ch);
                if ($result === FALSE) {
                    die('Curl failed: ' . curl_error($ch));
                }

                // Close connection
                curl_close($ch);
				//echo $result;
              return  json_encode($result);
             
    }
	
//function for sending notification using IOS	
/*
function send_push_notification_ios($registatoin_ids, $message)
{
			// Provide the Host Information.
			//$tHost = 'gateway.sandbox.push.apple.com';
			$tHost = 'gateway.push.apple.com';
			$tPort = 2195;
			// Provide the Certificate and Key Data.
				
			$tCert = 'SLWA_key.pem';
			// Provide the Private Key Passphrase (alternatively you can keep this secrete
			// and enter the key manually on the terminal -> remove relevant line from code).
			// Replace XXXXX with your Passphrase
			$tPassphrase = 'choc3747*';
			// Provide the Device Identifier (Ensure that the Identifier does not have spaces in it).
			// Replace this token with the token of the iOS device that is to receive the notification.
			//$tToken = 'b3d7a96d5bfc73f96d5bfc73f96d5bfc73f7a06c3b0101296d5bfc73f38311b4';
			$tToken = '0a32cbcc8464ec05ac3389429813119b6febca1cd567939b2f54892cd1dcb134';
			//0a32cbcc8464ec05ac3389429813119b6febca1cd567939b2f54892cd1dcb134
			// The message that is to appear on the dialog.
			$tAlert = 'You have a LiveCode APNS Message';
			// The Badge Number for the Application Icon (integer >=0).
			$tBadge = 8;
			// Audible Notification Option.
			$tSound = 'default';
			// The content that is returned by the LiveCode "pushNotificationReceived" message.
			$tPayload = 'APNS Message Handled by LiveCode';
			// Create the message content that is to be sent to the device.
			$tBody['aps'] = array (
			'alert' => $tAlert,
			'badge' => $tBadge,
			'sound' => $tSound,
			);
			$tBody ['payload'] = $tPayload;
			// Encode the body to JSON.
			$tBody = json_encode ($tBody);
			// Create the Socket Stream.
			$tContext = stream_context_create ();
			stream_context_set_option ($tContext, 'ssl', 'local_cert', $tCert);
			// Remove this line if you would like to enter the Private Key Passphrase manually.
			stream_context_set_option ($tContext, 'ssl', 'passphrase', $tPassphrase);
			// Open the Connection to the APNS Server.
			$tSocket = stream_socket_client ('ssl://'.$tHost.':'.$tPort, $error, $errstr, 30, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $tContext);
			// Check if we were able to open a socket.
			if (!$tSocket)
			exit ("APNS Connection Failed: $error $errstr" . PHP_EOL);
			// Build the Binary Notification.
			$tMsg = chr (0) . chr (0) . chr (32) . pack ('H*', $tToken) . pack ('n', strlen ($tBody)) . $tBody;
			// Send the Notification to the Server.
			$tResult = fwrite ($tSocket, $tMsg, strlen ($tMsg));
			if ($tResult)
			echo 'Delivered Message to APNS' . PHP_EOL;
			else
			echo 'Could not Deliver Message to APNS' . PHP_EOL;
			// Close the Connection to the Server.
			fclose ($tSocket);
	}
  */
function send_push_notification_ios($registration_ids, $message)
{
	$apnsHost = 'gateway.sandbox.push.apple.com';
	$apnsPort = 2195;
	$apnsCert = 'WenderCastPush.pem';
	$tAlert =$message ;
	$tBadge = 8;
	$tSound = 'default';
	$tPayload = 'APNS Message Handled by LiveCode';
	$tBody['aps'] = array (
	'alert' => $tAlert,
	'badge' => $tBadge,
	'sound' => $tSound,
	);
	$tBody ['payload'] = $tPayload;
	$payload = json_encode ($tBody);

	$streamContext = stream_context_create();
	stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);


	$apns = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
	if (!$apns)
	{
		exit ("APNS Connection Failed: $error $errorString" . PHP_EOL);
	}
	else
	{
		foreach($registration_ids as $token){
		$apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $deviceToken)) . chr(0) . chr(strlen($payload)) . $payload;
		fwrite($apns, $apnsMessage);
		}
	}
	socket_close($apns);
	fclose($apns);
	
			
}
?>