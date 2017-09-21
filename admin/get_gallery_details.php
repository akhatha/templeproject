<?php
include('../function.php');
include('../config.php');
$query=mysql_query("SELECT * FROM `gallery`");


				 if(mysql_num_rows($query)>0)
        {
			while($row=mysql_fetch_assoc($query))
			{
						
						$result[]=$row;
			}
			//print_r($result);
                        
                        echo json_encode($result);
	}