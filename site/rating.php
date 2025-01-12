<?php
require "needed/scripts.php";

force_login();

function drawStars($rating, $size = "L", $extras = NULL) {
    if ($size == "L") {
        $star_half_icon = "star_half.gif";
        $star_none_icon = "star_bg.gif";
        $star_full_icon = "star.gif";
    } elseif ($size == "SM") {
        $star_half_icon = "star_sm_half.gif";
        $star_none_icon = "star_sm_bg.gif";
        $star_full_icon = "star_sm.gif";  
    }

    $rating_half = fmod($rating, 1) !== 0.00;

    $star_rating_draw = '';
    
    for ($i = 1; $i <= 5; $i++) {
        if ($rating >= $i) {
            $star_rating_draw .= '
            <img class="rating" src="img/' . $star_full_icon . '">';
        } elseif ($rating_half && $rating > ($i - 1) && $rating < $i) {
            $star_rating_draw .= '
            <img class="rating" src="img/' . $star_half_icon . '">';
        } else {
            $star_rating_draw .= '
            <img class="rating" src="img/' . $star_none_icon . '">';
        }
    }

    echo $star_rating_draw;
}

if (!isset($_POST['action_add_rating']) || $_POST['action_add_rating'] != 1) {
    die();
}

$video_exists = $conn->prepare("SELECT vid, uid FROM videos WHERE vid = :video_id AND converted = 1");
$video_exists->bindParam(':video_id', $_REQUEST['video_id']);
$video_exists->execute();

if ($video_exists->rowCount() == 0) {
    die();
}

$video = $video_exists->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['uid']) && $session['uid'] == $video['uid']) {
    die();
}

$already_rated = $conn->prepare("SELECT rating_id FROM ratings WHERE user = :uid AND video = :video_id");
$already_rated->bindParam(':uid', $session['uid']);
$already_rated->bindParam(':video_id', $_REQUEST['video_id']);
$already_rated->execute();

if ($already_rated->rowCount() > 0) {
    $update_rating = $conn->prepare("UPDATE ratings SET rating = :rating WHERE user = :uid AND video = :video_id");
    $update_rating->bindParam(':rating', $_POST['rating']);
    $update_rating->bindParam(':uid', $session['uid']);
    $update_rating->bindParam(':video_id', $_POST['video_id']);
    $update_rating->execute();
} else {
    $rate_it = $conn->prepare("INSERT INTO ratings (rating_id, rating, user, video) VALUES (:rating_id, :rating, :user, :video)");
    $rating_id  = generateId(); 
    $rate_it->bindParam(':rating_id', $rating_id);
    $rate_it->bindParam(':rating', $_POST['rating']);
    $rate_it->bindParam(':user', $session['uid']);
    $rate_it->bindParam(':video', $_POST['video_id']);
    $rate_it->execute();
}

echo '<div class="label">Thanks for rating!</div>';
echo '<div class="spacer"></div>';
echo '<nobr>';
drawStars($_POST['rating'], $_POST['size'], 'class="rating"');
echo '</nobr>';
echo '<div class="smallText">' . htmlspecialchars(getRatingCount($_POST['video_id'])) . ' rating' . (htmlspecialchars(getRatingCount($_POST['video_id'])) != 1 ? 's' : '') . '</div>';
echo '<div class="spacer"></div>';
?>
