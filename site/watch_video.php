<?php
require "needed/scripts.php";
$video = $conn->prepare("SELECT time FROM videos WHERE vid = ?");
$video->execute([$_GET['v']]);
if($video->rowCount() == 0) {
die();
} else {
$video = $video->fetch(PDO::FETCH_ASSOC);
}
if(isset($_GET['autoplay']) && $_GET['autoplay'] == 1) {
$aparg = "&autoplay=1";
} else {
$aparg = "";
}
redirect('/p.swf?video_id='.htmlspecialchars($_GET["v"]).'&l='.$video["time"].$aparg);