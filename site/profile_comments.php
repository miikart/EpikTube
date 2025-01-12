<?php
require "needed/start.php";
$comment = $conn->prepare("SELECT cc.*, u.* 
    FROM channelcomments cc
    JOIN users u ON cc.uid = u.uid
    WHERE cc.uuid = :id AND u.termination = 0
    ORDER BY cc.time DESC");
$comment->bindParam(':id', $profile['uid'], PDO::PARAM_STR);
$comment->execute();
$comment = $comment->fetchAll();	
require_once "needed/templates/profile_comments.php";
require_once "needed/end.php";