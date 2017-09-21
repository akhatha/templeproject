<?php
require_once 'config.php';
$query=mysql_query("DELETE FROM tbl_notification WHERE `pn_date` < DATE_SUB(NOW(), INTERVAL 1 DAY)");
if($query)
	{
		$status= 1;
	}
else
	{
		$status= 0;
	}
		
echo $status;

