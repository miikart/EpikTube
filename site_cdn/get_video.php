<?php
if (!isset($_GET['video_id'])) {
exit("no video id");
}

require_once "needed/scripts.php";

$v = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON videos.uid = users.uid WHERE users.termination = 0 AND videos.vid = :vid");
$v->bindParam(':vid', $_GET['video_id'], PDO::PARAM_STR);
$v->execute();
$v = $v->fetch();

if (!$v) {
    exit("video does NOT exist");
} else {
    if ($v['converted'] == 0) {
        exit("video is processing");
    } else {
    $p = __DIR__ . "/data/videos/" . $_GET['video_id'] . ".flv";
    if (!file_exists($p)) {
        exit("vid exists but no video file was found");
    }
    // start buffering and sending bytes (this is to use lessen network usage!)
    $filesize = filesize($p);
    $start = 0;
    $length = $filesize;
    $end = $filesize - 1;

    header("Content-Type: video/x-flv");
    header("Accept-Ranges: bytes");

    if (isset($_SERVER['HTTP_RANGE'])) {
        $range = $_SERVER['HTTP_RANGE'];
        list(, $range) = explode("=", $range, 2);
        list($start, $end) = explode("-", $range, 2);

        $start = intval($start);
        if ($end == "") {
            $end = $filesize - 1;
        } else {
            $end = intval($end);
        }

        $length = $end - $start + 1;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Range: bytes $start-$end/$filesize");
    }

    header("Content-Length: $length");

    $file = fopen($p, "rb");
    fseek($file, $start);
    $chunksize = 64 * 1024;

    while ($length > 0) {
        $read = min($chunksize, $length);
        echo fread($file, $read);
        $length -= $read;
        flush();
    }

    fclose($file);
    exit;

        
}
   }
?>
