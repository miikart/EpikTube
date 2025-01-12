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
$vidocount = $conn->prepare(
	"SELECT * FROM favorites
	LEFT JOIN videos ON favorites.vid = videos.vid
	LEFT JOIN users ON users.uid = videos.uid
	WHERE favorites.uid = ? AND users.termination = 0
	ORDER BY favorites.fid DESC"
);
$vidocount->execute([$session['uid']]);
$vidocount = $vidocount->rowCount();
if($vidocount != 0) {
$totalPages = ceil($vidocount / $ppv);

if($page > $totalPages) {
     $page = $totalPages;
 }
}
$offs = ($page - 1) * $ppv;
$videos = $conn->prepare(
    "SELECT * FROM favorites
    INNER JOIN videos ON favorites.vid = videos.vid
    INNER JOIN users ON users.uid = videos.uid
    WHERE favorites.uid = ? AND videos.converted = 1 AND videos.privacy = 1 AND videos.rejected = 0
   AND users.termination = 0  ORDER BY favorites.fid DESC LIMIT $ppv OFFSET $offs"
);
$videos->execute([$session['uid']]);
$related_tags = [];

$vidocount = getfavoritecount($session['uid']);
$_PAGE["Page"] = "my_favorites";
require_once "_templates/_structures/main.php";
?>