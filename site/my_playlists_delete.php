<?php include_once("needed/scripts.php");
force_login();
$q = $conn->prepare("SELECT * FROM playlists WHERE pid = :pid AND uid = :uid AND action = 'create'");
$q->bindParam(":pid", $_REQUEST['p']);
$q->bindParam(":uid", $session['uid']);
$q->execute();
$yourplaylistisreadysir = $q->fetch();
if($yourplaylistisreadysir) {
$q = $conn->prepare("DELETE FROM playlists WHERE pid = :pid AND uid = :uid");
$q->bindParam(":pid", $_REQUEST['p']);
$q->bindParam(":uid", $session['uid']);
$q->execute();    
redirect("pl_manager");
} else {
session_error_index("Not your playlist.", "error");
}

