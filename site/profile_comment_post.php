<?php require_once('needed/scripts.php'); 
force_login();
$captchaid = generateId2(32);

         $favorites_of_you = $conn->prepare(
	"SELECT * FROM favorites
	LEFT JOIN videos ON favorites.vid = videos.vid
	LEFT JOIN users ON users.uid = videos.uid
	WHERE favorites.uid = ? AND videos.converted = 1 AND videos.privacy = 1
	ORDER BY favorites.fid DESC"
);
$favorites_of_you->execute([$session['uid']]);

$videos_of_you = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ? AND videos.converted = 1 AND videos.privacy = 1
	ORDER BY videos.uploaded DESC"
);
$videos_of_you->execute([$session['uid']]);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (strlen(trim($_POST['comment'])) < 1 || strlen(trim($_POST['comment'])) > 255) {
       alert("Please enter a comment.", "error");
    } elseif(!isset($error)) {
    $video = trim($_POST['field_reference_video']);
     if(isset($_POST['field_reference_video']) && $_POST['field_reference_video']  != null) {
    $checking = $conn->prepare("SELECT * FROM videos WHERE converted = 1 AND privacy = 1 AND vid = :vid");
    $checking->bindParam(':vid', $video, PDO::PARAM_STR);
    $checking->execute();
    $checking = $checking->fetch();
    if(!$checking) {
    session_error_index("Invaild video Id! Aborted.", "error");
    }
    } else {
        $checking['vid'] = null;
    }
     if($_POST['response'] != $_SESSION['captcha']) {
     alert ("Incorrect or expired captcha answer.", "error");  
     } else {
     $content = trim($_REQUEST['comment']);
     $current_time = date('Y-m-d H:i:s');
     $q = $conn->prepare('INSERT INTO channelcomments (uid, message, time, uuid, vidatt) VALUES (:uid, :message, :time, :uuid, :vidatt)');
     $q->bindParam(':uid', $_SESSION['uid'], PDO::PARAM_STR);
     $q->bindParam(':message', $content, PDO::PARAM_STR);
     $q->bindParam(':time', $current_time, PDO::PARAM_STR);
     $q->bindParam(':uuid', $theshit['uid'], PDO::PARAM_STR);
      $q->bindParam(':vidatt', $checking['vid'], PDO::PARAM_STR);
     $q->execute();
     exit(header("Location: /profile.php?user=". $_GET['user']));
                }
        }
}
$_PAGE["Page"] = "profile_comment_post";
require_once('_templates/_structures/profile.php'); ?> 