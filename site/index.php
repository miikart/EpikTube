<?php 
if(isset($_GET['v'])) {
	header("Location: watch.php?v=".$_GET['v'], true, 303);
	die();
}
require "needed/scripts.php";
if (isset($_SESSION['uid'])) {
$friends = $conn->prepare("SELECT DISTINCT * FROM relationships 

                        LEFT JOIN users ON users.uid = relationships.sender 

                        WHERE respondent = :uid AND accepted = 0  AND users.termination = 0

                        ORDER BY sent DESC LIMIT 30");

$friends->bindParam(':uid', $session['uid']);
$friends->execute();

$friend_request_count = $friends->rowCount();


$rizz = $conn->prepare("
   SELECT DISTINCT users.uid FROM relationships 
    LEFT JOIN users ON users.uid = CASE 
        WHEN relationships.sender = ? THEN relationships.respondent 
        WHEN relationships.respondent = ? THEN relationships.sender 
    END
    WHERE (relationships.sender = ? OR relationships.respondent = ?) 
    AND relationships.accepted = 1 AND users.termination = 0
    ORDER BY relationships.sent DESC
");
$rizz->execute([$session['uid'],$session['uid'],$session['uid'], $session['uid']]);
$REALFREIDNSREALFREIDNS = $rizz->rowCount();
}

$tags_strings = $conn->query("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE converted = 1 AND privacy = 1 AND users.termination = 0 ORDER BY uploaded DESC LIMIT 40");
$tag_list = [];
foreach($tags_strings as $result) {
    $tag_list = array_merge($tag_list, explode(" ", $result['tags']));
}
$tag_list = array_count_values($tag_list);
$tag_list = array_slice($tag_list, 0, 40, true);
$featured = $conn->query("SELECT * FROM picks LEFT JOIN videos ON videos.vid = picks.video LEFT JOIN users ON users.uid = videos.uid WHERE videos.converted = 1 AND videos.privacy = 1 ORDER BY picks.featured DESC LIMIT 10");
if(!isset($_SESSION['uid'])) {
$rec_viewed = $conn->prepare("
    SELECT views.viewed, videos.vid, videos.title
    FROM views 
    INNER JOIN videos ON videos.vid = views.vid 
    WHERE videos.privacy = 1 
    ORDER BY views.viewed DESC 
    LIMIT 12
");

$rec_viewed->execute();
$rec_viewed = $rec_viewed->fetchAll();
    
}


if (isset($_SESSION['uid'])) {
$sub_check = $conn->prepare("SELECT v.* FROM subscriptions s JOIN videos v ON s.subscribed_to = v.uid WHERE s.subscriber = :uid AND s.subscribed_type = 'user_uploads' AND v.converted = 1 AND v.privacy = 1 ORDER BY v.uploaded DESC LIMIT 15");
$sub_check->bindParam(':uid', $_SESSION['uid'], PDO::PARAM_STR);
$sub_check->execute();
$sub_check = $sub_check->fetchAll(PDO::FETCH_ASSOC);

$p_views = $conn->prepare(
	"SELECT SUM(views) FROM videos
	WHERE videos.uid = ? AND videos.converted = 1"
);
$p_views->execute([$session['uid']]);

}
$_PAGE["Page"] = "home";
require_once "_templates/_structures/main.php";
?>