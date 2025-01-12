<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1); 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'cleansrc');
define('DB_PASSWORD', 'cleansrc');
define('DB_NAME', 'cleansrc');
try {
$conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD, [ PDO::ATTR_PERSISTENT => true ]);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { ?>
<?php echo '' . $e . '<br><br><iframe width="560" height="315" src="https://www.youtube.com/embed/sh6LTfSaXpA?si=3nNQT1m3aVu1PIZV" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'; ?>
<?php exit; } 
require_once("functions.php");
date_default_timezone_set('America/Chicago');
$current_page = basename($_SERVER['PHP_SELF'], '.php'); 
if (!isset($_COOKIE['downtiefuckingsucks']) && invokethConfig("maintenance") == 1 && $current_page != "upload"){
require $_SERVER['DOCUMENT_ROOT'] . '/_templates/_errors/maintenance.php';
die();
}
// cdn URLS
$_CDNS = [
    'cdnname' => 'cdnkey',
    
];
// PROFILE HANDLING
if($current_page == "profile" || $current_page == "profile_comments" || $current_page == "bulletin_all" || $current_page == "bulletin_read" || $current_page == "bulletin_post" || $current_page == "profile_comment_post") {
switch($current_page) {
case "profile_comment_post";
$q = $conn->prepare('SELECT * FROM users WHERE username = :id');
$q->bindParam(':id', $_GET['user'], PDO::PARAM_STR);
$q->execute();
$theshit = $q->fetch();
if(!$theshit) {
    session_error_index("User not found.", "error");
    exit;
} else {
$profile = $theshit;
}
break;
case "bulletin_post";
$profile = $session;
break;
case "bulletin_read";
$thebull = $conn->prepare("SELECT b.*, u.*
FROM bulletins b
JOIN users u ON b.uid = u.uid
WHERE b.id = :id
AND u.termination = 0;");
$thebull->bindParam(":id", $_GET['id']);
$thebull->execute();
$thebull = $thebull->fetch();
if(!$thebull) {
session_error_index("Bulletin not found.", "error");
} else {
$profile = $conn->prepare("SELECT * FROM users WHERE uid = :id AND termination = 0");
$profile->bindParam(":id", $thebull['uid']);
$profile->execute();
$profile = $profile->fetch();
}
break;
default:
$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ?");
$profile->execute([$_GET['user']]);
if($profile->rowCount() == 0) {
    if(empty($_GET['user'])) {
	redirect("index_down.php");
    } else {
    session_error_index("Invalid username", "error");
    }
} else {
	$profile = $profile->fetch(PDO::FETCH_ASSOC);
}
}
 
} 

?>
