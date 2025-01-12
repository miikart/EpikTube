<?php 
require_once "needed/scripts.php";


force_login();
if ($session['em_confirmation'] != 'true') {
header("Location: email_confirm.php?next=". $_SERVER['REQUEST_URI']);
exit;
}
$video = $conn->prepare("SELECT * FROM videos WHERE vid = ?");
$video->execute([$_GET['v']]);

if($video->rowCount() == 0) {
	redirect("index.php");
	die();
} else {
	$video = $video->fetch(PDO::FETCH_ASSOC);
}

if($video['uid'] != $session['uid']){
    redirect("index.php");
}
$_PAGE["Page"] = "my_videos_upload_complete";
require_once "_templates/_structures/main.php";
?>