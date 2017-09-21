<?php
include('../function.php');
include('../config.php');

        
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        
        if(is_array($_FILES)) {

if(is_uploaded_file($_FILES['image']['tmp_name'])) {
$path = $_FILES['image']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

$imagePath = '../uploads/featuredimages/';
$imagePaths = '/uploads/featuredimages/';
$uniquesavename=time().uniqid(rand());
$destFile = $imagePath.$uniquesavename.'.'.$ext;
$filename = $_FILES["image"]["tmp_name"];
//list($width, $height) = getimagesize( $filename );       
move_uploaded_file($filename,  $destFile);
}
if(is_uploaded_file($_FILES['video']['tmp_name'])) {
$path = $_FILES['video']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

$videoPath = '../uploads/video/';
$videoPaths = '/uploads/video/';
$uniquesavename=time().uniqid(rand());
$destFile = $videoPath.$uniquesavename.'.'.$ext;
$filenames = $_FILES["video"]["tmp_name"];
//list($width, $height) = getimagesize( $filename );       
move_uploaded_file($filenames,  $destFile);
}

$data=array('video_path '=>$videoPaths.$uniquesavename.'.'.$ext,
						'video_name' =>$uniquesavename,
						'video_ext'=>$ext,
						'image_path '=>$imagePaths.$uniquesavename.'.'.$ext,
						'image_name' =>$uniquesavename,
						'image_ext'=>$ext,
						
					);

dbRowInsert("uploadvideo",$data);
}
header('Location:addvideo.php');
?>

