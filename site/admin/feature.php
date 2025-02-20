<?php
require_once __DIR__ . '/../needed/scripts.php';

if(!isset($session['staff']) || $session['staff'] != 1) {
	redirect("Location: /index.php"); 
    exit;
}
$video_id = $_REQUEST['video_id'];
error_reporting(E_ALL);
ini_set('display_errors', 1); 

$q = $conn->prepare("SELECT * FROM picks WHERE video = :video_id");
$q->bindParam(':video_id', $video_id);
$q->execute();


if(($q->rowCount() == 0)) {
 // i love reusing epiktube(http://epiktube.xyz) querys -- mii 1/7/2025
    
    
    
    
    
        $update_video = $conn->prepare("INSERT INTO `picks` (`video`) VALUES (?);");
		$update_video->execute([
		    $video_id,
		    
		] );
    
    
             alert("Video has been successfully Featured", "success");
                      header("Location: /index.php");
                      exit;

} 
		
		
		else {
		    
		    
		    
		    
if(($q->rowCount() > 0)) {
    $update_video = $conn->prepare("DELETE FROM picks WHERE `picks`.`video` = ?");
		$update_video->execute([
		    $video_id,
		    
		]);}
		    
		    
	             alert("Video has been successfully unFeatured", "success");
	              header("Location: /index.php");
                      exit;
	    
		    
		}

?>
