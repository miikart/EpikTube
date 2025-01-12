<?php
require "needed/scripts.php";
force_login();
$member = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$member->execute([$session['uid']]);
$member = $member->fetch(PDO::FETCH_ASSOC);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
if($_SERVER['REQUEST_METHOD'] == "POST") {
	

if ($_POST['branding'] >  2 ) {
    $profile_err = "Invalid Selection Number.";
}


if (!empty($profile_err)) {
   alert($profile_err, "error");
}

	if (empty($profile_err)) {
	{
		$update_video = $conn->prepare("UPDATE users SET branding = ?, forcevidquality = ? WHERE uid = ?");
		$update_video->execute([
			$_POST['branding'],
			$_POST['videosetting'],
			$session['uid']
		]);
       $member = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$member->execute([$session['uid']]);
$member = $member->fetch(PDO::FETCH_ASSOC);
        alert("Your Settings has been successfully updated.");
        redirect("/my_settings");
	}
    }
}
$_PAGE["Page"] = "my_settings";
require_once "_templates/_structures/main.php";
?>