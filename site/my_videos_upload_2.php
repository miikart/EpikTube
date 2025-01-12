<?php 
require "needed/scripts.php";
force_login();

if ($session['em_confirmation'] != 'true') {
header("Location: email_confirm.php?next=". $_SERVER['REQUEST_URI']);
exit;
}

if($_SERVER["REQUEST_METHOD"] != "POST") { header("Location: my_videos_upload.php"); }
if (!isset($_POST['field_upload_description'], $_POST['field_upload_tags'], $_POST['field_upload_title'])) { header("Location: my_videos_upload.php"); }

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
   redirect("my_videos_upload.php?desc_2"); 
}
$field_upload_tags = trim($_POST['field_upload_tags']);
$field_upload_tags = str_replace(',', '', $field_upload_tags); // Remove commas
$field_upload_tags = str_replace('  ', ' ', $field_upload_tags); // Remove whitespaces
$field_upload_tags = str_replace('#', '', $field_upload_tags); // Remove hashtags
$thetaging = explode(' ', trim($field_upload_tags));
$word_count = count($thetaging);
if (empty($field_upload_tags)) {
  redirect("my_videos_upload.php?tags");
}
if ($word_count < 1 || $word_count > 28) {
  if($word_count < 1) {
  redirect("my_videos_upload.php?tags");
} else {
  redirect("my_videos_upload.php?tags_2");
}
}
if(array_has_dupes($thetaging)) {
  redirect("my_videos_upload.php?tags_3");
}

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
         redirect("my_videos_upload.php?channels");
    }
} else {
    redirect("my_videos_upload.php?channels");
}

$_PAGE["Page"] = "my_videos_upload_2";
require_once "_templates/_structures/main.php";
?>