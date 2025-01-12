<?php
require "needed/start.php";
$bulletin = $conn->prepare("SELECT DISTINCT b.*, u.*
FROM bulletins b
JOIN users u ON b.uid = u.uid
LEFT JOIN relationships r ON (r.sender = :uid AND r.respondent = b.uid) 
    OR (r.respondent = :uid AND r.sender = b.uid)
WHERE (b.uid = :uid OR r.sender = :uid OR r.respondent = :uid)
AND u.termination = 0
AND (b.uid = :uid OR r.accepted = 1)
ORDER BY b.posted DESC");
$bulletin->bindParam(":uid", $profile['uid']);
$bulletin->execute();
$bulletin = $bulletin->fetchAll();
require_once "needed/templates/bulletin_all.php";   
require "needed/end.php";
