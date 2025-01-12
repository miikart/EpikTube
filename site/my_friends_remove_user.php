<?php require_once("needed/scripts.php"); 
$profile = $conn->prepare("SELECT * FROM users WHERE uid = :uid");
$profile->bindParam(':uid', $_REQUEST['friend_id']);
$profile->execute();
$profile = $profile->fetch();
if(!$profile) {
session_error_index('the vro you tried to delete doesnt even exist', "error");
}
$coolio = $conn->prepare("SELECT * FROM relationships WHERE (sender = :profileid AND respondent = :myid) OR (respondent = :profileid AND sender = :myid)");
$coolio->bindParam(':myid', $session['uid']);
$coolio->bindParam(':profileid', $profile['uid']);
$coolio->execute();
$cool = $coolio->rowCount();
if($cool < 1) {
session_error_index('Not on your friends list.', "error");
} else {
$aaa = $conn->prepare("DELETE FROM relationships WHERE (sender = :profileid AND respondent = :myid) OR (respondent = :profileid AND sender = :myid)");
$aaa->bindParam(':myid', $session['uid']);
$aaa->bindParam(':profileid', $profile['uid']);
$aaa->execute();
session_error_index('Successfully removed "' . $profile['uid'] .'" from your friends list!', "success");
exit;
}
    