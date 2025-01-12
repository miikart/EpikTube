<?php 
require "needed/scripts.php";
force_login();

if(!isset($_GET['video_id'])) {
	die(header("Location: my_videos.php"));
}

$video = $conn->prepare("SELECT * FROM videos WHERE vid = ? AND uid = ?");
$video->execute([$_GET['video_id'], $session['uid']]);

if($video->rowCount() == 0) {
	die(header("Location: my_videos.php"));
} else {
	$video = $video->fetch(PDO::FETCH_ASSOC);
}
if (isset($_POST['private']) && $_POST['private'] == 2) {
             $privacy = 2;
         } else {
             $privacy = 1;
         }

if (isset($_POST['comms_allow']) && $_POST['comms_allow'] == 0) {
             $allow_comms = 0;
         } else if (isset($_POST['comms_allow']) && $_POST['comms_allow'] == 3) {
             $allow_comms = 3;
         } else {
             $allow_comms = 1;
         }

if (isset($_POST['allow_votes']) && $_POST['allow_votes'] == 0) {
             $allow_votes = 0;
         } else {
             $allow_votes = 1;
         }
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['field_command'] === "update_video") {


    
$checked_channels = $_POST['chlist'] ?? [];
$good = true;

if ($checked_channels) {
    $checked_channels = array_slice($checked_channels, 0, 3);
    $checked_channels = array_map(function($value) {
        return preg_replace('/^ch/', '', $value);
    }, $checked_channels);

    foreach ($checked_channels as $channel) {
        $qq = $conn->prepare("SELECT * FROM channels WHERE id = :a AND id != 22");
        $qq->bindParam(':a', $channel);
        $qq->execute();

        if ($qq->rowCount() == 0) {
            $good = false;
            break;
        }
    }
    
    if (!$good) {
        exit("No.");
    }
} else {
    $nochannels = "yes";
}
$error = false;
$field_upload_tags = trim($_POST['field_upload_tags']);
$field_upload_tags = str_replace(',', '', $field_upload_tags); // Remove commas
$field_upload_tags = str_replace('  ', ' ', $field_upload_tags); // Remove whitespaces
$field_upload_tags = str_replace('#', '', $field_upload_tags); // Remove hashtags
$taginglist = explode(' ', trim($field_upload_tags));
$word_count = count($taginglist);
if ($word_count < 1 || $word_count > 28) {
  if($word_count < 1) {
 alert("Enter some tags for your video.");
$error = true;
  } else {
  alert("Please remove some tags from your video.");
$error = true;
    
}
}
if(empty($field_upload_tags)) {
alert("Enter some tags for your video.", "error");
$error = true;
}
if(array_has_dupes($taginglist)) { 
alert("Please remove the duplicate tags from your video", "error");
$error = true;
}  
// from yuotoob
if (isset($_POST['addr_month']) &&isset($_POST['addr_yr']) && isset($_POST['addr_month'])) {
	if ($_POST['addr_month'] != '---' && $_POST['addr_day'] != '---' && $_POST['addr_yr'] != '---') {
		$recorddate = $_POST['addr_yr']."-".$_POST['addr_month']."-".$_POST['addr_day'];
	} else {
		$recorddate = null;
	}
} else {
	$recorddate = null;
}
if ($_POST['addr_month'] != '---' && $_POST['addr_day'] != '---' && $_POST['addr_yr'] != '---') {
$recorddate = $_POST['addr_yr']."-".$_POST['addr_month']."-".$_POST['addr_day'];
$currentDate = new DateTime();
$dateTime = DateTime::createFromFormat('Y-m-d', $recorddate);
$errors = DateTime::getLastErrors();

if ($dateTime === false || (isset($errors['warning_count']) && $errors['warning_count'] > 0) || (isset($errors['error_count']) && $errors['error_count'] > 0)) {
    $error = "Invaild Record date.";
}
}

if(!$error) {
    if(strlen($_POST["field_upload_title"]) > 100 || strlen($_POST["field_upload_title"]) < 2 || strlen($_POST["field_upload_description"]) > 1000) {
        alert("Couldn't update video.", "error");  
    } else {
   
    if (isset($nochannels)  && $nochannels == "yes"|| empty($_POST['field_upload_title']) || empty($_POST['field_upload_description'] )) {
    alert("Couldn't update video.", "error");
    } else {
	$update_video = $conn->prepare("UPDATE videos SET title = ?, description = ?, tags = ?, updated = CURRENT_TIMESTAMP, recorddate = ?, address = ?, addrcountry = ?, ch1 = ?, ch2 = ?, ch3 = ?, privacy = ?, allow_votes = ?, comms_allow = ? WHERE vid = ? AND uid = ?");

	$update_video->execute([
		trim($_POST['field_upload_title']),
		trim($_POST['field_upload_description']),
		trim($_POST['field_upload_tags']),
       	$recorddate,
        trim($_POST['field_upload_address']),
        trim($_POST['field_upload_country']),
        isset($checked_channels[0]) ? $checked_channels[0] : 5,
        isset($checked_channels[1]) ? $checked_channels[1] : null,
        isset($checked_channels[2]) ? $checked_channels[2] : null,
        $privacy,
        $allow_votes,
        $allow_comms,
		$video['vid'],
		$session['uid']
	]);
     // force html to also update
    $video = $conn->prepare("SELECT * FROM videos WHERE vid = ? AND uid = ?");
    $video->execute([$_GET['video_id'], $session['uid']]);
    $video = $video->fetch(PDO::FETCH_ASSOC);
	alert("Video has been updated!");
  
        
    }
}
} }
$_PAGE["Page"] = "my_videos_edit";
require_once "_templates/_structures/main.php";
?>