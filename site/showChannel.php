<?php
$channel = $conn->prepare("SELECT * FROM channels WHERE id = :id");
$channel->bindParam('id', $_REQUEST['c'], PDO::PARAM_INT);
$channel->execute();
$channel= $channel->fetch();
if (!$channel) {
redirect("index");
}
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, $page);
$ppv = 20;
$videoc = $conn->prepare("SELECT videos.*, users.* 
FROM videos 
LEFT JOIN users ON users.uid = videos.uid 
WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) 
AND (ch1 = :ch OR ch2 = :ch OR ch3 = :ch) 
ORDER BY uploaded DESC");
$videoc->bindParam(":ch", $_REQUEST['c'], PDO::PARAM_INT);
$videoc->execute();
$videoc = $videoc->rowCount();
$totalPages = ceil($videoc / $ppv);
if($videoc != 0) {
if($page > $totalPages) {
    $page = $totalPages;
}
} else {
    $totalPages = 1;
}
$offs = ($page - 1) * $ppv;
$videos = $conn->prepare("SELECT videos.*, users.* 
FROM videos 
LEFT JOIN users ON users.uid = videos.uid 
WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) 
AND (ch1 = :ch OR ch2 = :ch OR ch3 = :ch) 
ORDER BY uploaded DESC  LIMIT $ppv OFFSET $offs");
$videos->bindParam(":ch", $_REQUEST['c'], PDO::PARAM_INT);
$videos->execute();
require_once "needed/templates/showChannel.php";
require "needed/end.php";
?>