<?php 
require "needed/scripts.php";
if(!isset($_GET['video_id'])) {
die();
}
$video = $conn->prepare("SELECT * FROM videos JOIN users ON videos.uid = users.uid WHERE videos.vid = :vid AND videos.converted = 1 AND users.termination = 0");
$video->bindParam(":vid", $_GET['video_id']);
$video->execute();
$video = $video->fetch();
if(!$video) {
session_error_index("This video is not available. please try again later");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?= htmlspecialchars($video['title']) ?></title>
<style>#flashcontent {position:absolute; left:0; top:0;right:0;bottom:0}</style>
</head>
<script src="/js/ruffle.js"></script>
<script>
function closeFull()
{
	window.close();
}

</script>


<body>
	<div id="flashcontent">
		<embed type="application/x-shockwave-flash" src="/player.swf<?php if(isset($_SESSION['uid'])) { echo "?s=".session_id()."&"; } else { echo "?"; } ?>video_id=<?php echo htmlspecialchars($video['vid']) ?>&l=<?php echo (int)$video['time'] ?>&fs=1" id="movie_player" quality="high" height="100%" width="100%" align="middle">
	</div>
</body>
