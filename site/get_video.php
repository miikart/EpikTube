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
    } elseif ($v['privacy'] == 2) {
        $friendswith = 0;
        if (isset($_SESSION['uid'])) {
            $alreadyrelated = $conn->prepare("SELECT * FROM relationships WHERE sender = :member_id AND respondent = :him AND accepted = 1");
            $alreadyrelated->bindParam(":member_id", $session['uid']);
            $alreadyrelated->bindParam(":him", $v['uid']);
            $alreadyrelated->execute();
            $alreadyrelated = $alreadyrelated->rowCount();
            if ($alreadyrelated > 0) {
                $friendswith = 1;
            }

            $newrelated = $conn->prepare("SELECT * FROM relationships WHERE sender = :him AND respondent = :member_id AND accepted = 1");
            $newrelated->bindParam(":member_id", $session['uid']);
            $newrelated->bindParam(":him", $v['uid']);
            $newrelated->execute();
            $newrelated = $newrelated->rowCount();
            if ($newrelated > 0) {
                $friendswith = 1;
            }

            if ($session['staff'] == 1 || $v['uid'] == $session['uid']) {
                $friendswith = 1;
            }
        }

        if ($friendswith <= 0) {
            exit("no access");
        }
    }

    $p = "../". $v["cdn"] . ".epiktube.xyz/data/videos/" . $_GET['video_id'] . ".flv";
    if (!file_exists($p)) {
        exit("vid exists but no video file was found");
    } else {
    redirect("//". $v["cdn"] . ".epiktube.xyz/get_video?video_id=" . $_GET['video_id'] . "");
    }
}
?>
