<?php
require_once("needed/scripts.php");
force_login();
$q = $conn->prepare("SELECT * FROM playlists WHERE pid = :id AND action = 'create'");
$q->bindParam(':id', $_GET['p']);
$q->execute();
$playlistinfo = $q->fetch();
if(!$playlistinfo) {
session_error_index("Playlist doesn't exist.", "error");
} else {
if($playlistinfo['uid'] != $session['uid']) {
session_error_index("Not your playlist.", "error");
}
$playlist = $conn->prepare(
"SELECT v.*, u.* 
    FROM videos v
    JOIN playlists p ON v.vid = p.vid
    JOIN users u ON v.uid = u.uid  
    WHERE p.pid = ?
      AND v.converted = 1
  
      AND u.termination = 0
    AND p.action = 'add'
ORDER BY p.created_at DESC"
);
$playlist->execute([$_GET['p']]);
$playlistlistlist = $conn->prepare(
"SELECT v.*, u.* 
    FROM videos v
    JOIN playlists p ON v.vid = p.vid
    JOIN users u ON v.uid = u.uid  
    WHERE p.pid = ?
      AND v.converted = 1
      AND u.termination = 0
    AND p.action = 'add'
ORDER BY p.created_at DESC"
);
$playlistlistlist->execute([$_GET['p']]);
if($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['current_form'] == "info") {
$title = trim($_REQUEST['playlist_title']);
$desc = trim($_REQUEST['playlist_description']);
if (!empty($title) && strlen($title) <= 60 && strlen($desc) <= 1000) {
if($title != $playlistinfo['title']) {
$check = $conn->prepare("SELECT * FROM playlists WHERE title = :title AND action = 'create'");
$check->bindParam(':title', $title);
$check->execute();
$check = $check->fetch();
}
if(!$check) {
$q= $conn->prepare("UPDATE playlists SET title = :name, description = :description WHERE uid = :uid AND pid = :pid AND action = 'create'");

$q->bindParam(':name' , $title);
$q->bindParam(':description' , $desc);
$q->bindParam(':uid' , $session['uid']);
$q->bindParam(':pid' , $_GET['p']);
$q->execute();
$aaa = $conn->prepare("SELECT * FROM playlists WHERE pid = :id AND action = 'create'");
$aaa->bindParam(':id', $_GET['p']);
$aaa->execute();
$playlistinfo = $aaa->fetch();
alert("Successfully updated your playlist!", "success");
} else {
alert("There is already another playlist with the same name.", "error");
}
} else {
alert("no :3", "error");
}
} elseif($_SERVER['REQUEST_METHOD'] == "POST" && $_REQUEST['current_form'] == "remove") {
$q = $conn->prepare("SELECT * FROM videos WHERE vid = :vid AND converted = 1");
$q->bindParam(':vid', $_REQUEST['video_id']);
$q->execute();
$davideo = $q->fetch();
if($davideo) {
$q2 = $conn->prepare("SELECT * FROM playlists WHERE vid = :vid AND uid = :uid AND action = 'add' AND pid = :pid");
$q2->bindParam(':vid', $_REQUEST['video_id']);
$q2->bindParam(':uid', $session['uid']);
$q2->bindParam(':pid', $_GET['p']);
$q2->execute();
$playlistexistwhar = $q2->fetch();
if($playlistexistwhar) {
$q2 = $conn->prepare("DELETE FROM playlists WHERE vid = :vid AND uid = :uid AND action = 'add' AND pid = :pid");
$q2->bindParam(':vid', $_REQUEST['video_id']);
$q2->bindParam(':uid', $session['uid']);
$q2->bindParam(':pid', $_GET['p']);
$q2->execute();   
$playlist = $conn->prepare(
	"   SELECT v.*, u.* 
    FROM videos v
    JOIN playlists p ON v.vid = p.vid
    JOIN users u ON v.uid = u.uid  
    WHERE p.pid = ?
      AND v.converted = 1
   
      AND u.termination = 0
    AND p.action = 'add'
ORDER BY p.created_at DESC
"
);
$playlist->execute([$_GET['p']]);
alert("Video removed successfully!");    
} else {
alert("Video isn't in your playlist.", "error");    
}
} else {
alert("video doesnt exist so no :3", "error");
}
    
}    
}

$_PAGE["Page"] = "my_playlists_edit";
require_once "_templates/_structures/main.php";
?>