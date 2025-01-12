<?php
require "needed/scripts.php";
if(isset($_GET['video_id'])) {
$video_info = $conn->prepare("SELECT * FROM videos WHERE vid = ? AND converted = 1");
$video_info->execute([$_GET['video_id']]);
if ($video_info->rowCount() == 0) {
header("Content-Type: image/jpg");
readfile(__DIR__ . "/unavail.jpg");
exit;
} else {
$video_info = $video_info->fetch();
if (isset($_GET['still_id']) && $_GET['still_id'] <= 3) {
} else {
$_GET['still_id'] = 2;
}
$still_file = "../". $video_info["cdn"] . ".epiktube.xyz/data/thmbs/".$_GET['video_id']."_".$_GET['still_id'].".jpg";
if(isset($_GET['video_id']) && file_exists($still_file)) {
if(!isset($_SESSION['uid']) && $video_info['agerestrict'] != 0) {
header("Content-Type: image/jpg");
readfile(__DIR__ . "/unavail.jpg");
exit;
} else {
header("Content-Type: ".mime_content_type($still_file));
readfile($still_file);
exit;
}
} else {
header("Content-Type: image/jpg");
readfile(__DIR__ . "/unavail.jpg");
exit;
}
}
} else {
header("Content-Type: image/jpg");
readfile(__DIR__ . "/unavail.jpg");    
exit;
}
?>
