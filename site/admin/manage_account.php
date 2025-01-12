<?php
require_once __DIR__ . '/../needed/scripts.php';

$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ?");
$profile->execute([$_GET['user']]);

if($profile->rowCount() == 0) {
    if(empty($_GET['user'])) {
	redirect("index_down.php");
    } else {
    session_error_index("Invalid username", "error");
    }
} else {
	$profile = $profile->fetch(PDO::FETCH_ASSOC);

    $profile['videos'] = $conn->prepare("SELECT vid FROM videos WHERE uid = ? AND privacy = 1 AND converted = 1");
    $profile['videos']->execute([$profile["uid"]]);
    $profile['videos'] = $profile['videos']->rowCount();
/*
    $profile['priv_videos'] = $conn->prepare("SELECT vid FROM videos WHERE uid = ? AND privacy = 2 AND converted = 1");
    $profile['priv_videos']->execute([$profile["uid"]]);
    $profile['priv_videos'] = $profile['priv_videos']->rowCount();
*/
    
    $view_profile = $conn->prepare("UPDATE users SET profile_views = profile_views + 1 WHERE uid = ?");
	$view_profile->execute([$profile['uid']]);


    $profile['favorites'] = $conn->prepare("SELECT fid FROM favorites WHERE uid = ?");
    $profile['favorites']->execute([$profile["uid"]]);
    $profile['favorites'] = $profile['favorites']->rowCount();

/*
    $profile['watched'] = $conn->prepare("SELECT COUNT(view_id) FROM views WHERE uid = ?");
    $profile['watched']->execute([$profile['uid']]);
    $profile['watched'] = $profile['watched']->fetchColumn();

    $profile['friends'] = $conn->prepare("SELECT COUNT(relationship) FROM relationships WHERE (sender = ? OR respondent = ?) AND accepted = 1");
    $profile['friends']->execute([$profile["uid"],$profile["uid"]]);
    $profile['friends'] = $profile['friends']->fetchColumn();
*/

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
	
	/*$profile_latest_video['views'] = $conn->prepare("SELECT COUNT(view_id) AS views FROM views WHERE vid = ?");
	$profile_latest_video['views']->execute([$profile_latest_video['vid']]);
	$profile_latest_video['views'] = $profile_latest_video['views']->fetchColumn();
	
	$profile_latest_video['comments'] = $conn->prepare("SELECT COUNT(cid) AS comments FROM comments WHERE vidon = ?");
	$profile_latest_video['comments']->execute([$profile_latest_video['vid']]);
	$profile_latest_video['comments'] = $profile_latest_video['comments']->fetchColumn();*/
    $videos = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ? AND videos.converted = 1
	ORDER BY videos.uploaded DESC"
);
if($profile_latest_video['privacy'] !== 1) {
    $profile_latest_video = false;
}
$videos->execute([$profile['uid']]);
$favorites = $conn->prepare(
	"SELECT * FROM favorites
	LEFT JOIN videos ON favorites.vid = videos.vid
	LEFT JOIN users ON users.uid = videos.uid
	WHERE favorites.uid = ? AND videos.converted = 1
	ORDER BY favorites.fid DESC"
);
$favorites->execute([$profile['uid']]);
}
}

if($profile['closure'] == 1) { $term_text = 'This user account is closed.'; } else { $term_text = 'This user account is suspended.'; } if($profile['termination'] == 1) { session_error_index($term_text, "error"); } else { ?>


<?

$_PAGE["Page"] = "/manage_account";
require_once "../_templates/_structures/main_admin.php"; } ?>
