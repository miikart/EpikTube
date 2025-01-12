<?php include("admin_head.php"); 
$video_id = $_REQUEST['video_id'];
$q->prepare("INSERT IGNORE INTO picks (video) VALUES (:video_id)");
$q->bindParam(':video_id', $video_id, PDO::PARAM_INT);
$q->execute();
alert("done");
?>