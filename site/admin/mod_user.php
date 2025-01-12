<?php
require_once __DIR__ . '/../needed/scripts.php';
if(!isset($session['staff']) || $session['staff'] != 1) {
	redirect("Location: /index.php"); 
    exit;
}
    $terminatehim = $conn->prepare("UPDATE users SET termination = 1 WHERE uid = ?");
	$terminatehim->execute([$_GET['user']]);




$q2 = $conn->prepare("DELETE FROM `videos` WHERE `uid` = :uid");
$q2->bindParam(':uid', $_REQUEST['user']);
$q2->execute();
	redirect("Location: /admin/"); 
    exit;