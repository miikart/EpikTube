<?php
require "needed/scripts.php";
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1);
$profile = $session;
force_login();
$friends = $conn->prepare(" SELECT u.*
    FROM subscriptions s
    JOIN users u ON u.uid = s.subscriber
    WHERE s.subscribed_to = ? 
      AND s.subscribed_type = 'user_uploads'
      AND u.termination = 0 ORDER BY subscribed DESC");
      $friends->execute([$session['uid']]);
$friends = $friends->fetchAll();
$profile_latest_video = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ? AND videos.converted = 1
	GROUP BY videos.vid
	ORDER BY videos.uploaded DESC LIMIT 1"
);
$profile_latest_video->execute([$profile['uid']]);

if($profile_latest_video->rowCount() == 0) {
	$profile_latest_video = false;
} else {
	$profile_latest_video = $profile_latest_video->fetch(PDO::FETCH_ASSOC);

}


$_PAGE["Page"] = "my_subscribers";
require_once "_templates/_structures/main.php";
?>