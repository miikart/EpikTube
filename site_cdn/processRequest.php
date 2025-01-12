<?php
require_once __DIR__ . "/needed/scripts.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
$request = (object) [
    "targetdir" => __DIR__ . '/data/videos/',
    "vext" => "file",
    "v_id" =>  trim($_POST['video_id'])
];
system(sprintf('php process/video_process.php "%s" "%s" "%s" > %s 2>&1 &', $request->targetdir, $request->vext, $request->v_id, './data/.log'));
} else {
error_reporting(E_ALL);
ini_set('display_errors', 1);
}
?>