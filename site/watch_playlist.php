<?php
require "needed/scripts.php";
$video = $conn->prepare("SELECT p.*, u.*
FROM playlists p
LEFT JOIN users u ON u.uid = p.uid
WHERE p.pid = ? AND p.action = 'create' AND u.termination = 0");
$video->execute([$_GET['id']]);
if($video->rowCount() == 0) {
die();
} else {
$video = $video->fetch(PDO::FETCH_ASSOC);
}
redirect('/ep.swf?id='.htmlspecialchars($_GET["id"]).$aparg);