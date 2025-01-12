<?php 
require "needed/scripts.php";
force_login();
if ($session['em_confirmation'] != 'true') {
header("Location: email_confirm.php?next=". $_SERVER['REQUEST_URI']);
exit;
}
if (isset($_GET['tags'])) {
    alert("You need a tag!", "error");
}
if (isset($_GET['tags_2'])) {
    alert("Please remove some tags from your video.", "error");
}
if (isset($_GET['tags_3'])) {
    alert("Please remove the duplicate tags from your video", "error");
}
if (isset($_GET['title'])) {
    alert("Title is too short.", "error");
}

if (isset($_GET['title_2'])) {
    alert("Title is too long.", "error");
}
if (isset($_GET['desc'])) {
    alert("Please fill in a description.", "error");
}
if (isset($_GET['channels'])) {
    alert("You must enter at least one channel!", "error");
}
$_PAGE["Page"] = "my_videos_upload";
require_once "_templates/_structures/main.php";
?>
