<?php require_once __DIR__ . '/../needed/scripts.php';
if(!isset($session['staff']) || $session['staff'] != 1) {
	redirect("Location: /index.php"); 
    exit;
}
$q = $conn->prepare("SELECT * FROM videos WHERE vid = :vid");
$q->bindParam(':vid', $_REQUEST['video_id']);
$q->execute();
$info = $q->fetch();
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_REQUEST['why']) && isset($_REQUEST['vid'])) {
if(empty($_REQUEST['why'])) {
alert("Enter a reason.", "error");
} else {
$q2 = $conn->prepare("DELETE FROM `videos` WHERE `vid` = :vid");
$q2->bindParam(':vid', $_REQUEST['video_id']);
$q2->execute();
alert("Video has been Deleted.", "success");
}
}
$_PAGE["Page"] = "/remove_video";
require_once "../_templates/_structures/main_admin.php";  ?> 