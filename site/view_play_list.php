<?php
require_once("needed/scripts.php");
$playlisting = $conn->prepare("SELECT p.*, u.*
FROM playlists p
LEFT JOIN users u ON u.uid = p.uid
WHERE p.pid = :id AND p.action = 'create' AND u.termination = 0");
$playlisting->bindParam(':id', $_REQUEST['p'], PDO::PARAM_STR);
$playlisting->execute();
$playlisting = $playlisting->fetch();
if($playlisting) {
$videos = $conn->prepare("SELECT v.*, u.* FROM videos v JOIN playlists p ON v.vid = p.vid JOIN users u ON v.uid = u.uid  WHERE p.pid = :p AND v.converted = 1 AND u.termination = 0 AND p.action = 'add' ORDER BY p.created_at DESC");
$videos->bindParam(':p', $_REQUEST['p'], PDO::PARAM_STR);
$videos->execute();
$first = $conn->prepare("SELECT v.*, u.* FROM videos v JOIN playlists p ON v.vid = p.vid JOIN users u ON v.uid = u.uid  WHERE p.pid = :p AND v.converted = 1 AND u.termination = 0 AND p.action = 'add' ORDER BY p.created_at DESC LIMIT 1");
$first->bindParam(':p', $_REQUEST['p'], PDO::PARAM_STR);
$first->execute();
$first = $first->fetch();
} else {
redirect("index_down");
}
$_PAGE["Page"] = "view_play_list";
require_once "_templates/_structures/main.php";
?>