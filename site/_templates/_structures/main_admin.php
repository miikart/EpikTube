<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<?php
$inbox = $conn->prepare("SELECT * FROM messages WHERE receiver = ? AND isRead = 0 ORDER BY created DESC");
$inbox->execute([$session['uid']]);
$inbox = $inbox->rowCount();
$getusersterm = $conn->query("SELECT * FROM users WHERE termination = 1")->rowCount();

$getusers = $conn->query("SELECT * FROM users WHERE termination = 0")->rowCount(); ?>
<html>
<head>
	
	<title>EpikTube - Broadcast Yourself.</title>
	  
	<link rel="stylesheet" href="/styles" type="text/css">
	<link rel="stylesheet" href="/base.css" type="text/css">
    
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	
    <meta name="description" content="Share your videos with friends and family">
	<meta name="keywords" content="video,sharing,camera phone,video phone">

	<link rel="alternate" title="EpikTube - [RSS]" href="/rssls">
	
	<script language="javascript" type="text/javascript">
		onLoadFunctionList = new Array();
		function performOnLoadFunctions()
		{
			for (var i in onLoadFunctionList)
			{
				onLoadFunctionList[i]();
			}
		}
	</script>

        
           
</head>

<body onLoad="performOnLoadFunctions();">
	
	

<div id="baseDiv">
<?php
if(!isset($session['staff']) || $session['staff'] != 1) {
	redirect("Location: /index.php"); 
    exit;
}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/_templates/_layout/header.php"; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/_templates/_layout/admin_head.php"; ?>
<?php if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/_templates/_pages/admin/".$_PAGE["Page"].".php")) { } require_once $_SERVER['DOCUMENT_ROOT'] . "/_templates/_pages/admin/".$_PAGE["Page"].".php"; ?>
</div> <!-- end baseDiv -->
</body>
</html>