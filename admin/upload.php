<?php
include('../function.php');
include('../config.php');
if(is_array($_FILES)) {
foreach ($_FILES['image']['name'] as $name => $value){
if(is_uploaded_file($_FILES['image']['tmp_name'][$name])) {
$path = $_FILES['image']['name'][$name];
$ext = pathinfo($path, PATHINFO_EXTENSION);

$imagePath = '../uploads/gallery/';
$imagePaths = '/uploads/gallery/';
$uniquesavename=time().uniqid(rand());
$destFile = $imagePath.$uniquesavename.'.'.$ext;
$filename = $_FILES["image"]["tmp_name"][$name];
//list($width, $height) = getimagesize( $filename );       
move_uploaded_file($filename,  $destFile);

$data=array(
						'image_path '=>$imagePaths.$uniquesavename.'.'.$ext,
						'image_name' =>$uniquesavename,
						'image_ext'=>$ext,
						
					);

dbRowInsert("gallery",$data);
//function for insertquery



}}}
header('Location:addgallery.php');
?>