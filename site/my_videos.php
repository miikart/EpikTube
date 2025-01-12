<?php 
require "needed/scripts.php";
force_login();
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$ppv = 10;
$videoss = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ?
	ORDER BY uploaded DESC"
);
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['mpfp_button'] == "Make Profile Icon") {
$isyours = $conn->prepare(
    "SELECT videos.vid 
     FROM videos
     WHERE videos.uid = :uid 
       AND videos.vid = :vid
       AND videos.converted = 1
     LIMIT 1"
);
$isyours->bindParam(':uid', $session['uid'], PDO::PARAM_STR);
$isyours->bindParam(':vid', $_REQUEST['selected_avatar'], PDO::PARAM_STR);  
$isyours->execute();
$isyours = $isyours->fetch(PDO::FETCH_OBJ);   
if($isyours) {
$q = $conn->prepare("UPDATE users SET profilePicture = :pfp WHERE uid = :uid");
$q->bindParam(':pfp', $_REQUEST['selected_avatar']);
$q->bindParam(':uid', $session['uid']);
$q->execute();
alert("Successfully set your profile picture.", "success");
} else {
alert("Failed to set your profile picture.", "error");
}}

$videoss->execute([$session['uid']]);
$thecool = $videoss->rowCount();
$vidocount = $thecool;
 $totalPages = ceil($vidocount / $ppv);
if($thecool != 0) {
if($page > $totalPages) {
    $page = $totalPages;
}
} else {
    $totalPages = 1;
}
$offs = ($page - 1) * $ppv;

$videos = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ?
	ORDER BY uploaded DESC LIMIT $ppv OFFSET $offs"
);


$videos->execute([$session['uid']]);

$related_tags = [];
$rejection_reasons = array(
        2 => 'content inappropriate',
        3 => 'copyright infringement'
);
$_PAGE["Page"] = "my_videos";
require_once "_templates/_structures/main.php";
?>