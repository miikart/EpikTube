<?php 
require "needed/scripts.php";
force_login();

if ($session['em_confirmation'] != 'true') {
header("Location: email_confirm.php?next=". $_SERVER['REQUEST_URI']);
exit;
}


$video_CDN_key = array_rand($_CDNS);
$video_CDN = $video_CDN_key;
$video_KEY = $_CDNS[$video_CDN_key];

use SoftCreatR\MimeDetector\MimeDetector;
use SoftCreatR\MimeDetector\MimeDetectorException;


$mimeDetector = new MimeDetector();

try {
    $mimeDetector->setFile($_FILES['fileToUpload']['tmp_name']);
} catch (MimeDetectorException $e) {
    header("Location: my_videos_upload.php");
    exit;
}

$type = $mimeDetector->getFileType();

$mime = strtolower($type['mime']);
$isVideo = 0;

if (strpos($mime, 'video/') === 0) {
    $ok = 1;
    if ($ok == 1) {
        $cooldown = $conn->prepare(
			"SELECT * FROM videos
			WHERE uid = ? AND videos.uploaded > DATE_SUB(NOW(), INTERVAL 1 DAY)
			ORDER BY uploaded DESC"
		);
        $cooldown->execute([$session['uid']]);
        // blazing
        // 1 = Weak
        // 2 = Moderate
        // 3 = Strict
        // >4 = stop spamming up the site dumbass
if ($session['blazing'] > 0) {
        if ($session['blazing'] == 1) { $coolit = 8; }
        elseif ($session['blazing'] == 2) { $coolit = 5; }
        elseif ($session['blazing'] == 3) { $coolit = 3; }
        elseif ($session['blazing'] >= 4) { $coolit = 1; }
        } else { $coolit = 8; }
if($cooldown->rowCount() >= $coolit) {
			session_error_index("You have uploaded one too many videos today! Check back tomorrow.", "error");
		}

$channels = [
    'ch0' => $_POST['field_upload_ch0'] ?? null,
    'ch1' => $_POST['field_upload_ch1'] ?? null,
    'ch2' => $_POST['field_upload_ch2'] ?? null,
];
$good = true;
foreach ($channels as $channel) {
    if ($channel) {
        $qq = $conn->prepare("SELECT * FROM channels WHERE id = :a AND id != 22");
        $qq->bindParam(':a', $channel);
        $qq->execute();
        $good = $good && $qq->rowCount() > 0;
    }
}
if (!$good) {
 exit("No.");
}
$video_id = generateId();
$field_upload_tags = trim($_POST['field_upload_tags']);
$field_upload_tags = str_replace(',', '', $field_upload_tags); // Remove commas
$field_upload_tags = str_replace('  ', ' ', $field_upload_tags); // Remove whitespaces
$field_upload_tags = str_replace('#', '', $field_upload_tags); // Remove hashtags
$taginglist = explode(' ', trim($field_upload_tags));
$word_count = count($taginglist);
if ($word_count < 1 || $word_count > 28) {
  if($word_count < 1) {
 session_error_index("ENTER. AN. TAG.", "error");
} else {
  session_error_index("TOO. MANY. TAGS.", "error");
}
}
if(empty($field_upload_tags)) {
session_error_index("ENTER. AN. TAG.", "error");
}
if(array_has_dupes($taginglist)) { 
session_error_index("Remove. The. Duplicate. Tags.", "error");
}  
      if (strlen($_POST["field_upload_title"]) < 2) {
   redirect("my_videos_upload.php?title"); 
}

if (strlen($_POST["field_upload_title"]) > 60) {
   redirect("my_videos_upload.php?title_2"); 
}

if (empty($_POST["field_upload_description"])) {
   redirect("my_videos_upload.php?desc"); 
}

if (strlen($_POST["field_upload_description"]) > 1000) {
   redirect("my_videos_upload.php?title_2"); 
}   
    if($_POST['public'] == 1) {
    $privacy = 1;
    } else {
    $privacy = 2;   
    }   
  
    $duration = round((int) exec($config['ffprobe'] . ' -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 ' . escapeshellarg($_FILES["fileToUpload"]["tmp_name"])));
    if ($duration > 600 && $duration != 0) {
    session_error_index("This video is too long or invaild.");
    } else {
    $ch = curl_init();
    $endpoint = 'http://'.$video_CDN.'.epiktube.xyz/my_videos_upload_post.php';
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, true);
    // the file to upload :3
    $file = new \CURLFile($_FILES['fileToUpload']['tmp_name'], $_FILES['fileToUpload']['type'], $_FILES['fileToUpload']['name']);
    $thedata = array_merge($_POST, array(
    'fileToUpload' => $file,
    'video_id' => $video_id,
    'key' => $video_KEY
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $thedata);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
    $error = curl_error($ch);
    exit("file upload failed: cdn " . $video_CDN. " might be down report to copy.floppy");
    }
    curl_close($ch);
    $ch1 = isset($_POST['field_upload_ch0']) ? $_POST['field_upload_ch0'] : 5;
    $ch2 =  isset($_POST['field_upload_ch1']) ? $_POST['field_upload_ch1'] : null;
    $ch3 = isset($_POST['field_upload_ch2']) ? $_POST['field_upload_ch2'] : null;
    $filename = strip_tags($_FILES['fileToUpload']['name']);
    $stmt = $conn->prepare("INSERT IGNORE INTO videos (uid, vid, cdn, tags, title, ch1, ch2, ch3, description, file, privacy, recorddate) 
    VALUES (:uid, :vid, :cdn, :tags, :title, :ch1, :ch2, :ch3, :description, :file, :privacy, NULL)");
    $stmt->bindParam(':uid', $session['uid'], PDO::PARAM_STR);
    $stmt->bindParam(':vid', $video_id, PDO::PARAM_STR);
    $stmt->bindParam(':cdn', $video_CDN, PDO::PARAM_STR);
    $stmt->bindParam(':tags', $field_upload_tags, PDO::PARAM_STR);
    $stmt->bindParam(':title', $_POST['field_upload_title'], PDO::PARAM_STR);
    $stmt->bindParam(':description', $_POST['field_upload_description'], PDO::PARAM_STR);
    $stmt->bindParam(':ch1', $ch1, PDO::PARAM_STR);
    $stmt->bindParam(':ch2', $ch2, PDO::PARAM_STR);
    $stmt->bindParam(':ch3', $ch3, PDO::PARAM_STR);
    $stmt->bindParam(':file', $filename, PDO::PARAM_STR);
    $stmt->bindParam(':privacy', $privacy, PDO::PARAM_STR);
    $stmt->execute();
    $successful = "/my_videos_upload_complete.php?v=" . $video_id;
    header("Location: $successful");
    exit();
}}     
} else {
session_error_index("Invalid file format.", "error");
}
?>