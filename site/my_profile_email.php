<?php
require "needed/scripts.php";
if(empty($_SESSION['uid'])) {
	header("Location: index.php");
}
$member = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$member->execute([$session['uid']]);
$member = $member->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['emailprefs_vdocomments']) && 
$_POST['emailprefs_vdocomments'] == 'true') {
$vdo_comm = 1;
} else {
$vdo_comm = 0;
}
if(isset($_POST['emailprefs_privatem']) && 
$_POST['emailprefs_privatem'] == 'true') {
$privatememmies= 1;
} else {
$privatememmies = 0;
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
        echo $vdo_comm;
        echo $privatememmies;
		$update_video = $conn->prepare("UPDATE users SET emailprefs_privatem = ?, emailprefs_vdocomments = ?  WHERE uid = ?");
		$update_video->execute([
			$vdo_comm,
 		    $privatememmies,
			$session['uid']
		]);
        alert("Your preferences have been updated.");

}


$_PAGE["Page"] = "my_profile_email";
require_once("_templates/_structures/main.php") ?>