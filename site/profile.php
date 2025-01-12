<?php
require_once "needed/scripts.php";
if(!isset($_GET["type"])) {
$organ_views = $conn->prepare("SELECT view_id AS views FROM profile_views WHERE vid = ? AND viewed > DATE_SUB(NOW(), INTERVAL 1 DAY)");
$organ_views->execute([$profile['uid']]);
$organc = $organ_views->rowCount();

if ($organc > 300) {
    $notOrganic = true;
}

// Check for organic views (better spam prevention)
$organ_views = $conn->prepare("SELECT view_id AS views FROM profile_views WHERE vid = ? AND viewed > DATE_SUB(NOW(), INTERVAL 1 MINUTE)");
$organ_views->execute([$profile['uid']]);
$organc = $organ_views->rowCount();

if ($organc > 15) {
    $notOrganic = true;
}

if ($notOrganic = true) {
$already_viewed = $conn->prepare("SELECT view_id AS views FROM profile_views WHERE vid = ? AND viewed > DATE_SUB(NOW(), INTERVAL 1 HOUR)");    
$already_viewed->execute([$profile['uid']]);
} else {
$already_viewed = $conn->prepare("SELECT view_id AS views FROM profile_views WHERE vid = ? AND sid = ? AND viewed > DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
$already_viewed->execute([$profile['uid'], session_id()]);
}
if($already_viewed->rowCount() == 0) {
    if(isset($_SESSION['uid'])) { 
	$add_view = $conn->prepare("INSERT IGNORE INTO profile_views (view_id,vid, sid, uid) VALUES (?, ?, ?, ?)");
	$add_view->execute([generateId(34),$profile['uid'], session_id(), $session['uid']]);
$theview = $conn->prepare("UPDATE users SET profile_views = profile_views + 1 WHERE uid = :id");
	$theview->bindParam(':id', $profile['uid'], PDO::PARAM_STR);
	$theview->execute();
    } else {
    $add_view = $conn->prepare("INSERT IGNORE INTO profile_views (view_id, vid, sid, uid) VALUES (?, ?, ?, NULL)");
	$add_view->execute([generateId(34),  $profile['uid'], session_id()]);    
$theview = $conn->prepare("UPDATE users SET profile_views = profile_views + 1 WHERE uid = :id");
	$theview->bindParam(':id', $profile['uid'], PDO::PARAM_STR);
	$theview->execute();
    }
}
   
 
   $friendswith = 0;
    if(isset($_SESSION['uid'])) {
    $subscribed = $conn->prepare("SELECT subscription_id FROM subscriptions WHERE subscriber = ? AND subscribed_to = ? AND subscribed_type = 'user_uploads'");
    $subscribed->execute([
	$session['uid'],
	$profile['uid']
    ]);
 
    $alreadyrelated = $conn->prepare("SELECT * FROM relationships WHERE sender = :member_id AND respondent = :him AND accepted = 1");
    $alreadyrelated->execute([
	":member_id" => $session['uid'],
    ":him" => $profile['uid']
    ]);
    $alreadyrelated = $alreadyrelated->rowCount();
    if($alreadyrelated > 0) {
	$friendswith = 1;
    }

    $newrelated = $conn->prepare("SELECT * FROM relationships WHERE sender = :him AND respondent = :member_id AND accepted = 1");
    $newrelated->execute([
	":member_id" => $session['uid'],
    ":him" => $profile['uid']
    ]);
$newrelated = $newrelated->rowCount();
    if($newrelated > 0) {
	$friendswith = 1;
    }
   }
$videos = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ? AND videos.converted = 1 AND privacy = 1
	ORDER BY videos.uploaded DESC LIMIT 12"
);
$videos->execute([$profile['uid']]);
$videos = $videos->fetchAll();
$thecount = min(count($videos), 4);

$friends = $conn->prepare("
    SELECT * FROM relationships 
    LEFT JOIN users ON users.uid = CASE 
        WHEN relationships.sender = :uid THEN relationships.respondent 
        WHEN relationships.respondent = :uid THEN relationships.sender 
    END
    WHERE (relationships.sender = :uid OR relationships.respondent = :uid) 
    AND relationships.accepted = 1 AND users.termination = 0
    ORDER BY relationships.sent DESC LIMIT 12
");
$friends->bindParam(":uid", $profile['uid'], PDO::PARAM_STR);
$friends->execute();
$friends = $friends->fetchAll(PDO::FETCH_ASSOC);

$tjecountbutfreiendd = min(count($friends), 4);

$bulletin = $conn->prepare("SELECT DISTINCT b.*, u.*
FROM bulletins b
JOIN users u ON b.uid = u.uid
LEFT JOIN relationships r ON (r.sender = :uid AND r.respondent = b.uid) 
    OR (r.respondent = :uid AND r.sender = b.uid)
WHERE (b.uid = :uid OR r.sender = :uid OR r.respondent = :uid)
AND u.termination = 0
AND (b.uid = :uid OR r.accepted = 1)
ORDER BY b.posted DESC LIMIT 5");
$bulletin->bindParam(":uid", $profile['uid']);
$bulletin->execute();
$bulletin = $bulletin->fetchAll();
// this is not useless its so that when user has more than 5 bulletins the show all bulletins link shows
$bulletin2 = $conn->prepare("SELECT DISTINCT b.*, u.*
FROM bulletins b
JOIN users u ON b.uid = u.uid
LEFT JOIN relationships r ON (r.sender = :uid AND r.respondent = b.uid) 
    OR (r.respondent = :uid AND r.sender = b.uid)
WHERE (b.uid = :uid OR r.sender = :uid OR r.respondent = :uid)
AND u.termination = 0
AND (b.uid = :uid OR r.accepted = 1)
ORDER BY b.posted DESC LIMIT 6");
$bulletin2->bindParam(":uid", $profile['uid']);
$bulletin2->execute();
$bulletin2 = $bulletin2->rowCount();


$comment = $conn->prepare("SELECT cc.*, u.* 
    FROM channelcomments cc
    JOIN users u ON cc.uid = u.uid
    WHERE cc.uuid = :id AND u.termination = 0
    ORDER BY cc.time DESC");
$comment->bindParam(':id', $profile['uid'], PDO::PARAM_STR);
$comment->execute();
$comment = $comment->fetchAll();
$commentc = count($comment);
switch($profile['gender']) {
						case '0':
							$nogender = true;
							break;
						case '1':
							$gender = "Male";
							break;
						case '2':
							$gender = "Female";
							break;
                        case '3':
						$nogender = true;
						break;
						default:
						$nogender = true;
						break;
    
} 
$_PAGE["Page"] = "profile";  
require_once "_templates/_structures/profile.php";
} else {
if($_GET["type"] == "videos" || $_GET["type"] == "videos.php") {
 if(isset($_REQUEST['page'])) {
    $page = (int)$_REQUEST['page'];
} else {
     $page = 1;
}
$page = max(1, $page);
$ppv = 10;
$videou = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ? AND videos.converted = 1 AND videos.privacy = 1
	ORDER BY videos.uploaded DESC"
);
$videou->execute([$profile['uid']]);
$collectmypages = $videou->rowCount();
if($collectmypages != 0) {
$totalPages = ceil($collectmypages / $ppv);
if($page > $totalPages) {
$page = $totalPages;
}
$offs = ($page - 1) * $ppv;
$videos = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ? AND videos.converted = 1 AND videos.privacy = 1
	ORDER BY videos.uploaded DESC LIMIT $ppv OFFSET $offs"
);
$videos->execute([$profile['uid']]);
}
$related_tags = [];   
$current_page = "profile_videos";
} elseif($_GET["type"] == "playlists" || $_GET["type"] == "playlists.php") {
$videos = $conn->prepare(
	"SELECT * FROM playlists
	LEFT JOIN users ON users.uid = playlists.uid
	WHERE playlists.uid = ? AND playlists.action = 'create' ORDER BY playlists.created_at DESC"
);
$videos->execute([$profile['uid']]);
$videos = $videos->fetchAll();
$collectmypages = count($videos);
$current_page = "profile_play_list";
    
} elseif($_GET["type"] == "friends" || $_GET["type"] == "friends.php") {
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

$friends = $conn->prepare("SELECT * FROM relationships LEFT JOIN users ON users.uid = relationships.respondent WHERE relationships.sender = ? AND relationships.accepted = 1 AND users.termination = 0");
$friends->execute([$profile['uid']]);
$friends = $friends->fetchAll(PDO::FETCH_ASSOC);

$friends2 = $conn->prepare("SELECT * FROM relationships LEFT JOIN users ON users.uid = relationships.sender WHERE relationships.respondent = ? AND relationships.accepted = 1 AND users.termination = 0");
$friends2->execute([$profile['uid']]);
$friends2 = $friends2->fetchAll(PDO::FETCH_ASSOC);
$friends = array_merge($friends, $friends2);

$videos = array_sort($friends, "username", SORT_ASC);
$collectmypages = count($videos);

$current_page = "profile_friends";    
} elseif($_GET["type"] == "favorites" || $_GET["type"] == "favorites.php") {
if(isset($_REQUEST['page'])) {
    $page = (int)$_REQUEST['page'];
} else {
     $page = 1;
}
 $page = max(1, $page);
$ppv = 10;
$collectmypages = $conn->prepare(
	"SELECT * FROM favorites
	LEFT JOIN videos ON favorites.vid = videos.vid
	LEFT JOIN users ON users.uid = videos.uid
	WHERE favorites.uid = ? AND users.termination = 0
	ORDER BY favorites.fid DESC"
);
$collectmypages->execute([$profile['uid']]);
$collectmypages = $collectmypages->rowCount();
if($collectmypages != 0) {
$totalPages = ceil($collectmypages / $ppv);

if($page > $totalPages) {
     $page = $totalPages;
 }
}
$offs = ($page - 1) * $ppv;
$videos = $conn->prepare(
    "SELECT * FROM favorites
    INNER JOIN videos ON favorites.vid = videos.vid
    INNER JOIN users ON users.uid = videos.uid
    WHERE favorites.uid = ? AND videos.converted = 1 AND videos.privacy = 1 AND videos.rejected = 0 AND users.termination = 0
    ORDER BY favorites.fid DESC LIMIT $ppv OFFSET $offs"
);
$videos->execute([$profile['uid']]);
$current_page = "profile_favorites";

$related_tags = [];
}
if(isset($_GET["type"])) {
$_PAGE["Page"] = "misc/profileTabs"; 
}
require_once "_templates/_structures/main.php";
}
