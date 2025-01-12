<?php
require_once "needed/scripts.php";
$info = $conn->prepare("SELECT * FROM channels WHERE id = :c");
$info->bindParam(':c', $_REQUEST['c'], PDO::PARAM_INT);
$info->execute();
$info = $info->fetch(PDO::FETCH_ASSOC);  
if(!$info) {
redirect("channels");
}
$recentlyadded = $conn->prepare("SELECT videos.*, users.* FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) AND (ch1 = :c OR ch2 = :c OR ch3 = :c) ORDER BY uploaded DESC LIMIT 5");
$recentlyadded->bindParam(':c', $_REQUEST['c'], PDO::PARAM_INT);
$recentlyadded->execute();
$recentlyadded = $recentlyadded->fetchAll(PDO::FETCH_ASSOC);
$mostviewed = $conn->prepare("SELECT videos.*, users.* FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) AND (ch1 = :c OR ch2 = :c OR ch3 = :c) ORDER BY views DESC LIMIT 5");
$mostviewed->bindParam(':c', $_REQUEST['c'], PDO::PARAM_INT);
$mostviewed->execute();
$mostviewed = $mostviewed->fetchAll(PDO::FETCH_ASSOC);
$activeusers = $conn->prepare("SELECT users.*, COUNT(videos.uid) AS actving FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) AND (ch1 = :c OR ch2 = :c OR ch3 = :c) GROUP BY users.uid ORDER BY actving DESC LIMIT 5");
$activeusers->bindParam(':c', $_REQUEST['c'], PDO::PARAM_INT);
$activeusers->execute();
$activeusers = $activeusers->fetchAll();
$tag_list = [];
foreach ($recentlyadded as $result) {
$tag_list = array_merge($tag_list, explode(" ", $result['tags']));
}
$tag_list = array_count_values($tag_list);
$tag_list = array_slice($tag_list, 0, 22, true);
$test = count($tag_list);
$index = 1;
$_PAGE["Page"] = "channels_portal";
require_once "_templates/_structures/main.php";
?>