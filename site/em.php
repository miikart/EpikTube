<?php 
require "needed/scripts.php";
$v = preg_replace('/\.swf$/i', '', $_GET['v']);
$video = $conn->prepare("SELECT * FROM videos WHERE vid = ? AND converted = 1");
$video->execute([$v]);

if($video->rowCount() == 0) {
echo $v; exit;
} else {
	$video = $video->fetch(PDO::FETCH_ASSOC);
}
$uploader = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$uploader->execute([$video['uid']]);
$uploader = $uploader->fetch(PDO::FETCH_ASSOC);

if ($uploader['uid'] == NULL) {
    redirect("/index.php");
}
if($video['converted'] == 0) {
	header("Location: /index.php");
}

// redirect people who chose the flash option to the embed player swf itself like how EpikTube did it back then
//if($_SESSION['flash'] == 1){
//header("Location: /watch_video.php?v=".$video['vid']);
//die();
//}
redirect("/watch_video?v=" . $video['vid']);
?>
