<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
require_once $_SERVER["DOCUMENT_ROOT"] . "/needed/scripts.php";
$check = $conn->query("SELECT * FROM videos WHERE converted = 0 AND startedProcessing = 0 LIMIT 1")->fetch();
if($check && file_exists("../../". $check["cdn"] . ".epiktube.xyz/data/videos/" . $check["vid"] . "_temp.file")) {
    $ch = curl_init();
    $endpoint = 'https://'.$check["cdn"].'.epiktube.xyz/processRequest.php';
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, true);
    $thedata = array_merge($_POST, array(
    'video_id' => $check["vid"]
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $thedata);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
    $error = curl_error($ch);
    exit("failed to contact " . $check["cdn"]. " for video processing");
    } else {
    curl_close($ch);
    exit("done, started processing video " . $check["vid"]. "!");
    }
} else {
exit("there are no videos available for processing.");
}