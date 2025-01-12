<?php
require "needed/scripts.php";
force_login();
if(isset($_REQUEST['page'])) {
    $page = (int)$_REQUEST['page'];
} else {
     $page = 1;
}
 $page = max(1, $page);
 $ppv = 10;
 $playlistu = $conn->prepare(
	"SELECT * FROM playlists
	LEFT JOIN users ON users.uid = playlists.uid
	WHERE playlists.uid = ? AND playlists.action = 'create' ORDER BY playlists.created_at DESC"
);
$playlistu->execute([$session['uid']]);
$collectmypages = $playlistu->rowCount();
if($collectmypages != 0) {
$totalPages = ceil($collectmypages / $ppv);

    if($page > $totalPages) {
      $page = $totalPages;
  }
   
$offs = ($page - 1) * $ppv;
$playlists = $conn->prepare(
	"SELECT * FROM playlists
	LEFT JOIN users ON users.uid = playlists.uid
	WHERE playlists.uid = ? AND playlists.action = 'create' ORDER BY playlists.created_at DESC LIMIT $ppv OFFSET $offs"
);
$playlists->execute([$session['uid']]);
}

$related_tags = [];
?>




<?php
$_PAGE["Page"] = "pl_manager";
require_once "_templates/_structures/main.php";
?>