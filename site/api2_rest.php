<?php
require "needed/scripts.php";
function getRatingAverage($vid) {
    $avg = $GLOBALS['conn']->prepare("SELECT AVG(rating) FROM ratings WHERE video = ?");
    $avg->execute([$vid]);
    $average = $avg->fetchColumn();
	if($average == NULL) {
	$average = 0;
	}
    return $average;

}

function getvidfavcountv2($what) {
global $conn;
  $thefavoritecount = $conn->prepare(
	"SELECT * FROM favorites
	LEFT JOIN videos ON favorites.vid = videos.vid
	LEFT JOIN users ON users.uid = videos.uid
	WHERE favorites.vid = ? AND videos.converted = 1
	ORDER BY favorites.fid DESC"
);
$thefavoritecount->execute([$what]);
$thefavoritecount = $thefavoritecount->rowCount();
return ($thefavoritecount);
}
function getfavoritecountv2($who) {
 global $conn;
  $thefavoritecount = $conn->prepare(
	"SELECT * FROM favorites
	LEFT JOIN videos ON favorites.vid = videos.vid
	LEFT JOIN users ON users.uid = videos.uid
	WHERE favorites.uid = ? AND videos.converted = 1
	ORDER BY favorites.fid DESC"
);
$thefavoritecount->execute([$who]);
$thefavoritecount = $thefavoritecount->rowCount();
return ($thefavoritecount);
}
function getfriendcountv2($who) {
  global $conn;
  $dafriendcount = $conn->prepare(
	"SELECT DISTINCT users.uid FROM relationships 
    LEFT JOIN users ON users.uid = CASE 
        WHEN relationships.sender = ? THEN relationships.respondent 
        WHEN relationships.respondent = ? THEN relationships.sender 
    END
    WHERE (relationships.sender = ? OR relationships.respondent = ?) 
    AND relationships.accepted = 1 AND users.termination = 0
    ORDER BY relationships.sent DESC"
);
$dafriendcount->execute([$who,$who,$who,$who]);
$dafriendcount = $dafriendcount->rowCount();
return ($dafriendcount);
}
function getpublicvideosv2($who) {
 global $conn;
  $dapubvidcount = $conn->prepare(
	"SELECT * FROM videos WHERE uid = ? AND converted = 1 AND privacy = 1"
);
$dapubvidcount->execute([$who]);
$dapubvidcount = $dapubvidcount->rowCount();
return ($dapubvidcount);
}
function getprivatevideosv2($who) {
global $conn;
  $daprivvidcount = $conn->prepare(
	"SELECT * FROM videos WHERE uid = ? AND converted = 1 AND privacy = 0"
);
$daprivvidcount->execute([$who]);
$daprivvidcount = $daprivvidcount->rowCount();
return ($daprivvidcount);
}
function getcommentcountv2($who) {
global $conn;
$replys = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON users.uid = comments.uid WHERE vidon = :id AND users.termination = 0 AND is_reply = 0 ORDER BY post_date DESC");
$replys->bindParam(':id', $who);
$replys->execute();
$replyc = $replys->rowCount();
return ($replyc);
}
header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="utf-8"?>';
$missingparam = '<ut_response status="fail"><error><code>4</code><description>Missing required parameter.</description></error></ut_response>';
if ($_GET['method'] == "EpikTube.videos.list_featured" || $_GET['method'] == "epiktube.videos.list_featured" || $_GET['method'] == "EpikTube.users.list_favorite_videos" || $_GET['method'] == "epiktube.users.list_favorite_videos" || $_GET['method'] == "EpikTube.videos.list_by_tag" || $_GET['method'] == "epiktube.videos.list_by_tag" || $_GET['method'] == "EpikTube.videos.list_by_user" || $_GET['method'] == "epiktube.videos.list_by_user") {
switch($_GET['method']) {
case "EpikTube.videos.list_featured":
$featured = $conn->query(
"SELECT * FROM picks 
LEFT JOIN videos ON videos.vid = picks.video
LEFT JOIN users ON users.uid = videos.uid
WHERE (videos.converted = 1 AND videos.privacy = 1) GROUP BY picks.video
ORDER BY picks.featured DESC LIMIT 25"
);
break;
case "epiktube.videos.list_featured":
$featured = $conn->query(
"SELECT * FROM picks 
LEFT JOIN videos ON videos.vid = picks.video
LEFT JOIN users ON users.uid = videos.uid
WHERE (videos.converted = 1 AND videos.privacy = 1) GROUP BY picks.video
ORDER BY picks.featured DESC LIMIT 25"
);
break;
case "EpikTube.users.list_favorite_videos":
if(!isset($_GET['user'])) {
echo $missingparam;
die();
}
$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ? AND users.termination = 0");
$profile->execute([$_GET['user']]);

if($profile->rowCount() == 0) {
echo '<ut_response status="fail"><error><code>101</code><description>No user was found with the specified username.</description></error></ut_response>';
die();
} else {
$profile = $profile->fetch(PDO::FETCH_ASSOC);
}

$featured = $conn->prepare(
"SELECT * FROM favorites
LEFT JOIN videos ON favorites.vid = videos.vid
LEFT JOIN users ON users.uid = videos.uid
WHERE favorites.uid = ? AND users.termination = 0
ORDER BY favorites.fid DESC LIMIT 10 "
);
$featured->execute([$profile['uid']]);
break;
case "epiktube.users.list_favorite_videos":
if(!isset($_GET['user'])) {
echo $missingparam;
die();
}
$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ? AND users.termination = 0");
$profile->execute([$_GET['user']]);

if($profile->rowCount() == 0) {
echo '<ut_response status="fail"><error><code>101</code><description>No user was found with the specified username.</description></error></ut_response>';
die();
} else {
$profile = $profile->fetch(PDO::FETCH_ASSOC);
}

$featured = $conn->prepare(
"SELECT * FROM favorites
LEFT JOIN videos ON favorites.vid = videos.vid
LEFT JOIN users ON users.uid = videos.uid
WHERE favorites.uid = ? AND users.termination = 0
ORDER BY favorites.fid DESC LIMIT 10"
);
$featured->execute([$profile['uid']]);
break;
case "EpikTube.videos.list_by_tag":
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$ppv = isset($_GET['per_page']) ? intval($_GET['per_page']) : 20;
if($ppv > 100) {
$ppv = 100;
}
$offs = ($page - 1) * $ppv;
if(!isset($_GET['tag'])) {
echo $missingparam;
die();
}
$search = str_replace(" ", "|", $_GET['tag']);
$featured = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP ? OR videos.description REGEXP ? OR videos.title REGEXP ? OR users.username REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 ORDER BY (INSTR(LOWER(tags), LOWER(?)) > 0) DESC LIMIT $ppv OFFSET $offs");
$featured->execute([$search, $search, $search, $search, $search]);
break;
case "epiktube.videos.list_by_tag":
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$ppv = isset($_GET['per_page']) ? intval($_GET['per_page']) : 20;
$offs = ($page - 1) * $ppv;
if(!isset($_GET['tag'])) {
echo $missingparam;
die();
}
$search = str_replace(" ", "|", $_GET['tag']);
$featured = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP ? OR videos.description REGEXP ? OR videos.title REGEXP ? OR users.username REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 ORDER BY (INSTR(LOWER(tags), LOWER(?)) > 0) DESC LIMIT $ppv OFFSET $offs");
$featured->execute([$search, $search, $search, $search, $search]);
break;
case "EpikTube.videos.list_by_user":
if(!isset($_GET['user'])) {
echo $missingparam;
die();
}
$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ? AND users.termination = 0");
$profile->execute([$_GET['user']]);

if($profile->rowCount() == 0) {
echo '<ut_response status="fail"><error><code>101</code><description>No user was found with the specified username.</description></error></ut_response>';
die();
} else {
$profile = $profile->fetch(PDO::FETCH_ASSOC);
}

$featured = $conn->prepare(
"SELECT * FROM videos
LEFT JOIN users ON users.uid = videos.uid
WHERE videos.uid = ? AND videos.converted = 1 AND videos.privacy = 1
ORDER BY videos.uploaded DESC"
);
$featured->execute([$profile['uid']]);
break;
case "epiktube.videos.list_by_user":
if(!isset($_GET['user'])) {
echo $missingparam;
die();
}
$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ? AND users.termination = 0");
$profile->execute([$_GET['user']]);

if($profile->rowCount() == 0) {
echo '<ut_response status="fail"><error><code>101</code><description>No user was found with the specified username.</description></error></ut_response>';
die();
} else {
$profile = $profile->fetch(PDO::FETCH_ASSOC);
}

$featured = $conn->prepare(
"SELECT * FROM videos
LEFT JOIN users ON users.uid = videos.uid
WHERE videos.uid = ? AND videos.converted = 1 AND videos.privacy = 1
ORDER BY videos.uploaded DESC"
);
$featured->execute([$profile['uid']]);
break;
}
?>

<ut_response status="ok">
    <video_list>
<?php foreach($featured as $pick) { 
$pick['views'] = $conn->prepare("SELECT COUNT(view_id) FROM views WHERE vid = ?");
$pick['views']->execute([$pick['vid']]);
$pick['views'] = $pick['views']->fetchColumn();

?>
        <video>
            <author><?php echo htmlspecialchars($pick['username']); ?></author>
            <id><?php echo htmlspecialchars($pick['vid']); ?></id>
            <title><?php echo htmlspecialchars($pick['title']); ?></title>
            <length_seconds><?php echo htmlspecialchars($pick['time']); ?></length_seconds>
            <rating_avg><? echo htmlspecialchars(getRatingAverage($pick['vid'])); ?></rating_avg>
            <rating_count><? echo htmlspecialchars(getRatingCount($pick['vid'])); ?></rating_count>
            <description><?php echo htmlspecialchars($pick['description']); ?></description>
            <view_count><?php echo htmlspecialchars($pick['views']); ?></view_count>
            <upload_time><?php echo strtotime($pick['uploaded']); ?></upload_time>
            <comment_count><?php if (getcommentcountv2($pick['vid']) != 0) { ?><?php echo getcommentcountv2($pick['vid']); ?><? } else { ?>None<? } ?></comment_count>
            <tags><?php echo htmlspecialchars($pick['tags']); ?></tags>
            <url>http://www.epiktube.xyz/watch.php?v=<?php echo htmlspecialchars($pick['vid']); ?></url>
            <thumbnail_url>http://www.epiktube.xyz/get_still.php?video_id=<?php echo htmlspecialchars($pick['vid']); ?></thumbnail_url>
        </video>
<? } ?>
    </video_list>
</ut_response>
<? } elseif ($_GET['method'] == "EpikTube.videos.get_details" || $_GET['method'] == "epiktube.videos.get_details") { 
if(!isset($_GET['video_id'])) {
echo $missingparam;
die();
}
$video = $conn->prepare("SELECT * FROM videos WHERE vid = ? AND converted = 1");
$video->execute([$_GET['video_id']]);

if($video->rowCount() == 0) {
	echo '<ut_response status="fail"><error><code>102</code><description>No video was found with the specified ID.</description></error></ut_response>';
	die();
} else {
	$video = $video->fetch(PDO::FETCH_ASSOC);
}
$uploader = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$uploader->execute([$video['uid']]);
$uploader = $uploader->fetch(PDO::FETCH_ASSOC);
$video['views'] = $conn->prepare("SELECT COUNT(view_id) FROM views WHERE vid = ?");
$video['views']->execute([$video['vid']]);
$video['views'] = $video['views']->fetchColumn();
	
//$video['comments'] = $conn->prepare("SELECT COUNT(cid) FROM comments WHERE vidon = ?");
//$video['comments']->execute([$video['vid']]);
//$video['comments'] = $video['comments']->fetchColumn();
$comments = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON users.uid = comments.uid WHERE vidon = ? AND users.termination = 0 AND is_reply = 0 ORDER BY post_date DESC");
$comments->execute([$video['vid']]);
$comments = $comments->fetchAll(PDO::FETCH_ASSOC);

function showChannelsXML($vid) {
global $conn;
$video2chan = $conn->prepare("SELECT * FROM videos WHERE vid = ? AND converted = 1");
$video2chan->execute([$vid]);

if($video2chan->rowCount() == 0) {
 echo "";
} else {
	$video2chan= $conn->prepare("SELECT * FROM videos WHERE vid = ? AND converted = 1");
$video2chan->execute([$vid]);
	$video2chan = $video2chan->fetch(PDO::FETCH_ASSOC);
    $ch1 = $video2chan['ch1'];
    $ch2 = $video2chan['ch2'];
    $ch3 = $video2chan['ch3'];
    
    // hope i can make this better someday
    $q = $conn->prepare("SELECT * FROM channels WHERE id = :ch1");
    $q->bindParam(':ch1', $ch1, PDO::PARAM_INT);
    $q->execute();
    $ch1 = $q->fetch(PDO::FETCH_ASSOC);
    $q = $conn->prepare("SELECT * FROM channels WHERE id = :ch1");
    $q->bindParam(':ch1', $ch2, PDO::PARAM_INT);
    $q->execute();
    $ch2 = $q->fetch(PDO::FETCH_ASSOC);
    $q = $conn->prepare("SELECT * FROM channels WHERE id = :ch1");
    $q->bindParam(':ch1', $ch3, PDO::PARAM_INT);
    $q->execute();
    $ch3 = $q->fetch(PDO::FETCH_ASSOC);
    if ($ch1 != NULL && $ch2 != NULL) {
     echo '<channel>'.$ch1['id'].'</channel>

						, ';
    } elseif ($ch1 != NULL && $ch2 == NULL && $ch3 == NULL) {
     echo '<channel>'.$ch1['id'].'</channel>';
    }
    
    if ($ch2 != NULL && $ch3 != NULL) {
     echo '<channel>'.$ch2['id'].'</channel>';
    } elseif ($ch2 != NULL && $ch3 == NULL) {
     echo '<channel>'.$ch2['id'].'</channel>';
    }

  if ($ch3 != NULL) {
     echo '<channel>'.$ch3['id'].'</channel>';
    }
  }
}
?>

<ut_response status="ok">
    <video_details>
        <author><?php echo htmlspecialchars($uploader['username']); ?></author>
        <title><?php echo htmlspecialchars($video['title']); ?></title>
        <rating_avg><? echo htmlspecialchars(getRatingAverage($video['vid'])); ?></rating_avg>
        <rating_count><? echo htmlspecialchars(getRatingCount($video['vid'])); ?></rating_count>
        <tags><?php echo htmlspecialchars($video['tags']); ?></tags>
        <description><?php echo htmlspecialchars($video['description']); ?></description>
        <update_time><?php echo strtotime($video['updated']); ?></update_time>
        <view_count><?php echo htmlspecialchars($video['views']); ?></view_count>
        <upload_time><?php echo strtotime($video['uploaded']); ?></upload_time>
        <length_seconds><?php echo htmlspecialchars($video['time']); ?></length_seconds>
        <recording_date<?php if ($video['recorddate'] != NULL) { ?>><?php echo htmlspecialchars($video['recorddate']); ?></recording_date><? } else { ?> /><? } ?>

        <recording_location<?php if ($video['address'] != NULL) { ?>><?php echo htmlspecialchars($video['address']); ?></recording_location><? } else { ?> /><? } ?>

        <recording_country<?php if ($video['addrcountry'] != NULL) { ?>><?php echo htmlspecialchars($video['addrcountry']); ?></recording_country><? } else { ?> /><? } ?>

        <comment_list>
<?php if($comments !== false) {
foreach($comments as $comment) {
?>
            <comment>
                <author><?php echo htmlspecialchars($comment['username']); ?></author>
                <text><?php echo htmlspecialchars($comment['body']); ?></text>
                <time><?php echo strtotime($comment['post_date']); ?></time>
            </comment>
<? } } ?>
        </comment_list>
        <channel_list>
            <?php showChannelsXML($video['vid']); ?>
        
        </channel_list>
        <thumbnail_url>http://www.epiktube.xyz/get_still.php?video_id=<?php echo htmlspecialchars($video['vid']); ?></thumbnail_url>
    </video_details>
</ut_response>
<? } elseif ($_GET['method'] == "EpikTube.users.get_profile" || $_GET['method'] == "epiktube.users.get_profile") { 

if(!isset($_GET['user'])) {
echo $missingparam;
die();
}

$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ? AND users.termination = 0");
$profile->execute([$_GET['user']]);

if($profile->rowCount() == 0) {
	echo '<ut_response status="fail"><error><code>101</code><description>No user was found with the specified username.</description></error></ut_response>';
	die();
} else {
	$profile = $profile->fetch(PDO::FETCH_ASSOC);
}

  
function isUserOnline($lastLoginDate) {
    // Define an online threshold (e.g., 5 minutes) in seconds
    $onlineThreshold = 5 * 60;

    // Convert the last login date to a Unix timestamp
    $lastLoginTimestamp = strtotime($lastLoginDate);

    // Calculate the difference between current time and last login time
    $timeDifference = time() - $lastLoginTimestamp;

    // Check if the time difference is within the online threshold with a margin of error
    // You can adjust the margin based on how accurate you want the online status to be
    $marginOfError = 30; // 30 seconds
    return $timeDifference <= ($onlineThreshold + $marginOfError);
}


?>

<ut_response status="ok">
    <user_profile>
        <first_name><?php echo htmlspecialchars($profile['name']); ?></first_name>
        <last_name></last_name>
        <about_me><?php echo htmlspecialchars($profile['about']); ?></about_me>
        <age><?php if ($profile['birthday'] != '0000-00-00' && $profile['birthday'] != NULL) { echo str_replace(' years ago', '', timeAgo($profile['birthday'])); } ?></age>
        <video_upload_count><?php echo getpublicvideosv2($profile['uid']); ?></video_upload_count>
        <video_watch_count><?php echo htmlspecialchars($profile['vids_watched']); ?></video_watch_count>
        <homepage><?php echo htmlspecialchars($profile['website']); ?></homepage>
        <hometown><?php echo htmlspecialchars($profile['hometown']); ?></hometown>
        <gender><?php
					switch($profile['gender']) {
						case '0':
							break;
						case '1':
							echo "m";
							break;
						case '2':
							echo "f";
							break;
                        case '3':
						echo "o";
						break;
                        default:
                        echo "o";
                        break;
					}
				?></gender>
        <occupations><?php echo htmlspecialchars($profile['occupations']); ?></occupations>
        <companies><?php echo htmlspecialchars($profile['companies']); ?></companies>
        <city><?php echo htmlspecialchars($profile['city']); ?></city>
        <country><?php echo htmlspecialchars($profile['country']); ?></country>
        <books><?php echo htmlspecialchars($profile['books']); ?></books>
        <hobbies><?php echo htmlspecialchars($profile['hobbies']); ?></hobbies>
        <movies><?php echo htmlspecialchars($profile['fav_media']); ?></movies>
        <relationship><?php
					    switch($profile['relationship']) {
						case '0':
							echo "open";
							break;
						case '1':
							echo "single";
							break;
						case '2':
							echo "taken";
							break; 
                            default:
                        echo "open";
                         break; }?></relationship>
        <friend_count><?php echo getfriendcountv2($profile['uid']); ?></friend_count>
        <favorite_video_count><?php echo getfavoritecountv2($profile['uid']); ?></favorite_video_count>
        <currently_on><?php $isOnline = isUserOnline($profile['last_act']); if ($isOnline) {
    echo 'true';
} else {
    echo "false";
} ?></currently_on>
    </user_profile>
</ut_response>
<? } elseif ($_GET['method'] == "EpikTube.users.list_friends" || $_GET['method'] == "epiktube.users.list_friends") {  
if(!isset($_GET['user'])) {
echo $missingparam;
die();
}

$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ? AND users.termination = 0");
$profile->execute([$_GET['user']]);

if($profile->rowCount() == 0) {
	echo '<ut_response status="fail"><error><code>101</code><description>No user was found with the specified username.</description></error></ut_response>';
	die();
} else {
	$profile = $profile->fetch(PDO::FETCH_ASSOC);
}

function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array, SORT_STRING | SORT_FLAG_CASE);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

//$friends = $conn->prepare("SELECT * FROM relationships WHERE (sender = ? OR respondent = ?) AND accepted = 1");
//$friends->execute([$profile['uid'], $profile['uid']]);
$friends = $conn->prepare("SELECT * FROM relationships LEFT JOIN users ON users.uid = relationships.respondent WHERE relationships.sender = ? AND relationships.accepted = 1 AND users.termination = 0");
$friends->execute([$profile['uid']]);
$friends = $friends->fetchAll(PDO::FETCH_ASSOC);

$friends2 = $conn->prepare("SELECT * FROM relationships LEFT JOIN users ON users.uid = relationships.sender WHERE relationships.respondent = ? AND relationships.accepted = 1 AND users.termination = 0");
$friends2->execute([$profile['uid']]);
$friends2 = $friends2->fetchAll(PDO::FETCH_ASSOC);
$friends = array_merge($friends, $friends2);

$friends = array_sort($friends, "username", SORT_ASC);
?>

<ut_response status="ok">
    <friend_list>
<?php foreach($friends as $friend) {
?>
        <friend>
            <user><?= htmlspecialchars($friend['username']) ?></user>
            <video_upload_count><?php echo getpublicvideosv2($friend['uid']); ?></video_upload_count>
            <favorite_count><?php echo getfavoritecountv2($friend['uid']); ?></favorite_count>
            <friend_count><?php echo getfriendcountv2($friend['uid']); ?></friend_count>
        </friend>
<? } ?>
    </friend_list>
</ut_response>
<? } elseif ($_GET['method'] == "EpikTube.videos.list_by_playlist" || $_GET['method'] == "epiktube.videos.list_by_playlist") { 

if(!isset($_GET['id'])) {
echo $missingparam;
die();
}
$profile = $conn->prepare("SELECT p.*, u.*
FROM playlists p
LEFT JOIN users u ON u.uid = p.uid
WHERE p.pid = ? AND p.action = 'create' AND u.termination = 0");
$profile->execute([$_GET['id']]);

if($profile->rowCount() == 0) {
echo '<ut_response status="fail"><error><code>101</code><description>No playlist was found with the specified id.</description></error></ut_response>';
die();
} else {
$profile = $profile->fetch(PDO::FETCH_ASSOC);
}

$featured = $conn->prepare(
"SELECT v.*, u.* FROM videos v JOIN playlists p ON v.vid = p.vid JOIN users u ON v.uid = u.uid  WHERE p.pid = ? AND v.converted = 1 AND u.termination = 0 AND p.action = 'add' ORDER BY p.created_at DESC"
);
$featured->execute([$profile['pid']]);
$index = 0;
echo '<ut_response status="ok">';
echo '<video_list>';
foreach ($featured as $pick) { 
    echo '<video>';
    echo '<title>' . htmlspecialchars($pick['title']) . '</title>';
    echo '<id>' . $pick['vid'] . '</id>';
    echo '<thumbnail_url>http://www.epiktube.xyz/get_still.php?video_id=' . $pick['vid'] . '</thumbnail_url>';
    echo '<embed_id>' . $pick['vid'] . '</embed_id>';
    echo '<index>' . $index .'</index>';
    echo '<length_seconds>' . htmlspecialchars($pick['time']) . '</length_seconds>';
    echo '</video>';
    $index++;
}
echo '</video_list>';
echo '</ut_response>';
} elseif (empty($_GET['method']) || !isset($_GET['method'])) { 
echo '<ut_response status="fail"><error><code>5</code><description>No method specified.</description></error></ut_response>';
} else {
echo '<ut_response status="fail"><error><code>6</code><description>Unknown method specified.</description></error></ut_response>';
}
?>