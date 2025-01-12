<?php
error_reporting(0);
ini_set('display_errors', 0); 
ini_set('session.cookie_path', '/');
ini_set('session.cookie_domain', '.epiktube.xyz');
session_start(); 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'dbpassword');
define('DB_NAME', 'dbname');
try {
$conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD, [ PDO::ATTR_PERSISTENT => true ]);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { ?>
<?php echo '' . $e . '<br><br><iframe width="560" height="315" src="https://www.youtube.com/embed/sh6LTfSaXpA?si=3nNQT1m3aVu1PIZV" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'; ?>
<?php exit; } 
date_default_timezone_set('America/Phoenix');
$config = [
    'host' => 'email',
    'email' => 'email',
    'epassword' => 'emailpasswd',
    'emport' => '465',
    'ffmpeg' => 'ffmpeg',
    'ffprobe' => 'ffprobe',
    'aeskey' => 'noidea',
    'key' => 'yourcdnkey'
];
if(isset($_SESSION['uid'])) {
    $session = $conn->prepare("SELECT * FROM users WHERE uid = :id");
    $session->bindParam(":id", $_SESSION['uid']);
    $session->execute();
    if(!$session->rowCount()) {
        session_start();
        session_destroy(); 
    } else {
        $session = $session->fetch(PDO::FETCH_ASSOC);
        if ($session['termination'] == 1) {
        session_start();
        session_destroy(); 
        }
    }
} else {
    $session = null;
}
?>