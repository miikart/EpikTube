<?php
require_once __DIR__ . "/needed/scripts.php";
if($_SERVER['REQUEST_METHOD'] != 'POST') {
exit("How about no v1");
} 
$request = (object) [
    "targetdir" => __DIR__ . '/data/videos/',
    "vfile" => $_FILES["fileToUpload"],
    "v_id" =>  trim($_POST['video_id']),
    "access" => trim($_POST["key"])
];
if($request->access != $config['key']) {
exit("How about no v2");
}
$movfile = $request->targetdir . $request->v_id . "_temp.file";
if (move_uploaded_file($request->vfile['tmp_name'], $movfile)) {
exit("file upload sucess :3");
}
?>
