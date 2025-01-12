<?php 
require_once('needed/scripts.php'); 
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
    if (strlen(trim($_POST['field_bulletin_subject'])) < 1 || strlen(trim($_POST['field_bulletin_content'])) < 1 || strlen(trim($_POST['field_bulletin_subject'])) > 25 || strlen(trim($_POST['field_bulletin_content'])) > 500) {
       $error = "Couldnt post bulletin";
       alert("Please enter both subject and body.", "error");
    } elseif(!isset($error)) {
      $video = trim($_POST['field_reference_video']);

    if(isset($_POST['field_reference_video']) && $_POST['field_reference_video']  != null) {
    $checking = $conn->prepare("SELECT * FROM videos WHERE converted = 1 AND privacy = 1 AND vid = :vid");
   $checking->bindParam(':vid', $video, PDO::PARAM_STR);
   $checking->execute();
    $checking = $checking->fetch();
if(!$checking) {
session_error_index("Not like us.", "error");
}

    } else {
        $checking['vid'] = null;
    }
    
    if($_POST['response'] != $_SESSION['captcha']) {
     alert ("Incorrect or expired captcha answer.", "error");  
     } else {
     $content = trim($_REQUEST['field_bulletin_subject']);
     $body = trim($_REQUEST['field_bulletin_content']);
     $id = generateId();
     $q = $conn->prepare('INSERT INTO bulletins (id,uid, title, body, vid) VALUES (:id, :uid, :title, :body, :vid)');
     $q->bindParam(':id', $id, PDO::PARAM_STR);
     $q->bindParam(':uid', $session['uid'], PDO::PARAM_STR);
$q->bindParam(':title', $body, PDO::PARAM_STR);
     $q->bindParam(':body', $content, PDO::PARAM_STR);
    $q->bindParam(':vid', $video, PDO::PARAM_STR);
   
     $q->execute();
   
     exit(header("Location: /profile.php?user=". $session['username']));
     }       }
        }
$_PAGE["Page"] = "bulletin_post";
require_once "_templates/_structures/profile.php";
 ?> 