<?php
include('../function.php');
include('../config.php');
$id=$_GET['id'];
$query=mysql_query("DELETE FROM gallery WHERE id =$id ");
echo json_encode(array('msg'=>'deleted'));