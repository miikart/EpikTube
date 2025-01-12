<?php 
// ik its MESSY as FUCK but it works and honestly thats all i care about (the code is fine its just messy)
require_once "needed/scripts.php";
    $_GET['v'] = substr($_GET['v'], 0, 11);
$video = $conn->prepare("SELECT * FROM videos WHERE vid = ? AND converted = 1");
$video->execute([$_GET['v']]);
if($video->rowCount() == 0) {
session_error_index("The video you have requested is not available.
If you have recently uploaded this video, you may need to wait a few minutes for the video to process.", "error");
	die();
} else {
	$video = $video->fetch(PDO::FETCH_ASSOC);
}
$friendswith = 0;
$uploader = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$uploader->execute([$video['uid']]);
$uploader = $uploader->fetch(PDO::FETCH_ASSOC);
 if ($uploader['uid'] == NULL) {
    redirect("/index.php");
}

if ($uploader['termination'] == 1) {
    redirect("/index.php");
} 
if (isset($_SESSION['uid']) && $video['uid'] == $session['uid'] || isset($_SESSION['uid']) && $session['staff'] == 1) {
if($video['reason'] == 1) { session_error_index("This video has been removed by the user.", "error"); }
if($video['reason'] == 3) { alert("Your video has been removed due to copyright infringement.", "error"); }
if($video['reason'] == 2) { alert("Your video has been removed due to terms of use violation.", "error"); }
}
if(!isset($_SESSION['uid']) && $video['agerestrict'] != 0) {
redirect("verify_age");
}
   if(isset($_SESSION['uid'])) {
    $alreadyrelated = $conn->prepare("SELECT * FROM relationships WHERE sender = :member_id AND respondent = :him AND accepted = 1");
    $alreadyrelated->execute([
	":member_id" => $session['uid'],
    ":him" => $uploader['uid']
    ]);
$alreadyrelated = $alreadyrelated->rowCount();
    if($alreadyrelated > 0) {
	$friendswith = 1;
    }

    $newrelated = $conn->prepare("SELECT * FROM relationships WHERE sender = :him AND respondent = :member_id AND accepted = 1");
    $newrelated->execute([
	":member_id" => $session['uid'],
    ":him" => $uploader['uid']
    ]);
$newrelated = $newrelated->rowCount();

    if($newrelated > 0) {
	$friendswith = 1;
    }  
    if($session['staff'] == 1) {
    $friendswith = 1;    
    }
    if ($uploader['uid'] == $session['uid']) {
    $friendswith = 1;        
    }

}
   
if($friendswith < 1 && $video['privacy']  == 2) {
session_error_index("This is a private video. If you have been sent this video, please make sure you accept the sender's friend request.", "error");
}
if(isset($_REQUEST['t'])) {
switch ($_REQUEST['t']) {
case "t";
$timeing = "t";
break;
case "w";
$timeing = "w";
break;
case "m";
$timeing = "m";
break;
case "a";
$timeing = "a";
break;  
default:
$timeing = "t";
} 
} else {
$timeing = "t";
}
if(isset($_REQUEST['feature']) && $_REQUEST['feature'] == "PlayList" && isset($_REQUEST['p'])) {
$aejiwudwh = $conn->prepare("SELECT *
FROM playlists p
JOIN users u ON p.uid = u.uid
 WHERE p.pid = :pid  
  AND u.uid = p.uid AND action = 'create' 
  AND u.termination = 0;");
$aejiwudwh->bindParam(':pid', $_REQUEST['p']);
$aejiwudwh->execute();
$aejiwudwh = $aejiwudwh->fetch();
$aejiwudwhv2 = $conn->prepare("SELECT *
FROM playlists p
JOIN users u ON p.uid = u.uid
 WHERE p.vid = :pid  
  AND u.uid = p.uid AND action = 'add' 
  AND u.termination = 0;");
$aejiwudwhv2->bindParam(':pid', $_GET['v']);
$aejiwudwhv2->execute();
$aejiwudwhv2 = $aejiwudwhv2->fetch();
if($aejiwudwh && $aejiwudwhv2) {
$playlistmode = "playlist";
$playlistinfo = $conn->prepare("SELECT * FROM playlists WHERE pid = :pid");
$playlistinfo->bindParam(':pid', $_REQUEST['p']);
$playlistinfo->execute();
$playlistinfo = $playlistinfo->fetch();
} else {
$playlistmode = "related";   
}
  
} elseif(isset($_REQUEST['feature']) && $_REQUEST['feature'] == "Recent") {
$playlistmode = "recent";
$titlethingying = "Most Recent";
$thelinkingto = "mr";
} elseif(isset($_REQUEST['feature']) && $_REQUEST['feature'] == "Favorites") {
$playlistmode = "favorite";
$titlethingying = "Top Favorites";
$thelinkingto = "mf";   
} elseif(isset($_REQUEST['feature']) && $_REQUEST['feature'] == "Views") {
$playlistmode = "view";
$titlethingying = "Most Viewed";
$thelinkingto = "mp";       
} elseif(isset($_REQUEST['feature']) && $_REQUEST['feature'] == "Discussed") {
$playlistmode = "discussed";
$titlethingying = "Most Discussed";
$thelinkingto = "md"; 
} elseif(isset($_REQUEST['feature']) && $_REQUEST['feature'] == "TopRated") {
$playlistmode = "rated";
$titlethingying = "Top Rated";
$thelinkingto = "tr"; 
} elseif(isset($_REQUEST['feature']) && $_REQUEST['feature'] == "Featured") {
$playlistmode = "featured";
$titlethingying = "Recently Featured";
$thelinkingto = "rf"; 
} elseif(isset($_REQUEST['feature']) && $_REQUEST['feature'] == "Random") {
$playlistmode = "random";
$titlethingying = "Random";
$thelinkingto = "r";
} else {
$playlistmode = "related";  
}


$tagstuff = preg_quote($video['tags']); 
$tagstuff = str_replace(" ", "|", $tagstuff);   
                    
$notOrganic = false;
if($playlistmode == "playlist") {
$playing = $conn->prepare("SELECT v.*, u.* 
    FROM videos v
    JOIN playlists p ON v.vid = p.vid
    JOIN users u ON v.uid = u.uid  
    WHERE p.pid = :pid
      AND v.converted = 1

      AND u.termination = 0
    AND p.action = 'add'
ORDER BY p.created_at DESC");
$playing->bindParam(':pid', $_REQUEST['p'], PDO::PARAM_STR);
} elseif($playlistmode == "recent") {
$howmanyvids = 20; 
$videocaount = $conn->query("
    SELECT * 
    FROM videos 
    LEFT JOIN users ON users.uid = videos.uid 
    WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) 
    ORDER BY uploaded DESC 
    LIMIT 300
")->fetchAll();
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
if ($currentPage < 1) $currentPage = 1; 
$videocaount2 = count($videocaount);
$totalPages = ceil($videocaount2 / $howmanyvids);
if ($currentPage > $totalPages) $currentPage = $totalPages; 

$offset = ($currentPage - 1) * $howmanyvids;
$start = $offset + 1;
$end = min($offset + $howmanyvids, $videocaount2);
$playing = $conn->prepare("
    SELECT * 
    FROM videos 
    LEFT JOIN users ON users.uid = videos.uid 
    WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) 
    ORDER BY uploaded DESC 
    LIMIT $howmanyvids OFFSET $offset
");

} elseif($playlistmode == "favorite") {
$howmanyvids = 20; 
$videocaount = $conn->query("
SELECT * FROM favorites
			LEFT JOIN videos ON videos.vid = favorites.vid
			LEFT JOIN users ON users.uid = videos.uid
			WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) GROUP BY favorites.vid
			ORDER BY COUNT(favorites.fid) DESC
    LIMIT 100
")->fetchAll();
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
if ($currentPage < 1) $currentPage = 1; 
$videocaount2 = count($videocaount);
$totalPages = ceil($videocaount2 / $howmanyvids);
if ($currentPage > $totalPages) $currentPage = $totalPages; 

$offset = ($currentPage - 1) * $howmanyvids;
$start = $offset + 1;
$end = min($offset + $howmanyvids, $videocaount2);
$playing = $conn->prepare("
  SELECT * FROM favorites
			LEFT JOIN videos ON videos.vid = favorites.vid
			LEFT JOIN users ON users.uid = videos.uid
			WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) GROUP BY favorites.vid
			ORDER BY COUNT(favorites.fid) DESC
    LIMIT $howmanyvids OFFSET $offset
");
  
} elseif($playlistmode == "view") {
 $howmanyvids = 20; 
	if($timeing == "t") {
		$videocaount = $conn->query(
			"SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    WHERE viewed > DATE_SUB(NOW(), INTERVAL 1 DAY)
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT 100
"
		)->fetchAll();
	} elseif($timeing == "w") {
		$videocaount = $conn->query(
			"SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    WHERE viewed > DATE_SUB(NOW(), INTERVAL 1 WEEK)
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT 100"
		)->fetchAll();
	} elseif($timeing == "m") {
		$videocaount = $conn->query(
			"SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    WHERE viewed > DATE_SUB(NOW(), INTERVAL 1 MONTH)
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT 100"
		)->fetchAll();
	} elseif($timeing == "a") {
		$videocaount = $conn->query(
			"SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT 100"
		)->fetchAll();
}
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
if ($currentPage < 1) $currentPage = 1; 
$videocaount2 = count($videocaount);
$totalPages = ceil($videocaount2 / $howmanyvids);
if ($currentPage > $totalPages) $currentPage = $totalPages; 

$offset = ($currentPage - 1) * $howmanyvids;
$start = $offset + 1;
$end = min($offset + $howmanyvids, $videocaount2);


	if($timeing == "t") {
			$playing = $conn->query(
			"SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    WHERE viewed > DATE_SUB(NOW(), INTERVAL 1 DAY)
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT $howmanyvids OFFSET $offset
"
		);
	
	} elseif($timeing == "w") {
	$playing = $conn->query(
			"SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    WHERE viewed > DATE_SUB(NOW(), INTERVAL 1 WEEK)
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT $howmanyvids OFFSET $offset"
		);
	
	} elseif($timeing == "m") {
		$playing = $conn->query(
			"SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    WHERE viewed > DATE_SUB(NOW(), INTERVAL 1 MONTH)
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT $howmanyvids OFFSET $offset"
		);
	
	} elseif($timeing == "a") {
		$playing = $conn->query(
			"SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT $howmanyvids OFFSET $offset"
		);

}   
} elseif($playlistmode == "discussed") {
 $howmanyvids = 20; 
	if($timeing == "t") {
		$videocaount = $conn->query(
			"SELECT comments.*, videos.*, videouser.* FROM comments
LEFT JOIN videos ON videos.vid = comments.vidon
LEFT JOIN users AS videouser ON videouser.uid = videos.uid
LEFT JOIN users AS commenting ON commenting.uid = comments.uid
WHERE videos.converted = 1 
  AND videos.privacy = 1 
  AND videouser.termination = 0 
  AND commenting.termination = 0 
  AND comments.is_reply = 0 
    AND comments.post_date > DATE_SUB(NOW(), INTERVAL 1 DAY)
GROUP BY videos.vid
ORDER BY COUNT(comments.cid) DESC  LIMIT 100
"
		)->fetchAll();
	} elseif($timeing == "w") {
		$videocaount = $conn->query(
			"SELECT comments.*, videos.*, videouser.* FROM comments
LEFT JOIN videos ON videos.vid = comments.vidon
LEFT JOIN users AS videouser ON videouser.uid = videos.uid
LEFT JOIN users AS commenting ON commenting.uid = comments.uid
WHERE videos.converted = 1 
  AND videos.privacy = 1 
  AND videouser.termination = 0 
  AND commenting.termination = 0 
  AND comments.is_reply = 0 
    AND comments.post_date > DATE_SUB(NOW(), INTERVAL 1 WEEK)
GROUP BY videos.vid
ORDER BY COUNT(comments.cid) DESC  LIMIT 100"
		)->fetchAll();
	} elseif($timeing == "m") {
		$videocaount = $conn->query(
			"SELECT comments.*, videos.*, videouser.* FROM comments
LEFT JOIN videos ON videos.vid = comments.vidon
LEFT JOIN users AS videouser ON videouser.uid = videos.uid
LEFT JOIN users AS commenting ON commenting.uid = comments.uid
WHERE videos.converted = 1 
  AND videos.privacy = 1 
  AND videouser.termination = 0 
  AND commenting.termination = 0 
  AND comments.is_reply = 0 
    AND comments.post_date > DATE_SUB(NOW(), INTERVAL 1 MONTH)
GROUP BY videos.vid
ORDER BY COUNT(comments.cid) DESC  LIMIT 100"
		)->fetchAll();
	} elseif($timeing == "a") {
		$videocaount = $conn->query(
			"SELECT comments.*, videos.*, videouser.* FROM comments
LEFT JOIN videos ON videos.vid = comments.vidon
LEFT JOIN users AS videouser ON videouser.uid = videos.uid
LEFT JOIN users AS commenting ON commenting.uid = comments.uid
WHERE videos.converted = 1 
  AND videos.privacy = 1 
  AND videouser.termination = 0 
  AND commenting.termination = 0 
  AND comments.is_reply = 0 
GROUP BY videos.vid
ORDER BY COUNT(comments.cid) DESC LIMIT 100"
		)->fetchAll();
}
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
if ($currentPage < 1) $currentPage = 1; 
$videocaount2 = count($videocaount);
$totalPages = ceil($videocaount2 / $howmanyvids);
if ($currentPage > $totalPages) $currentPage = $totalPages; 

$offset = ($currentPage - 1) * $howmanyvids;
$start = $offset + 1;
$end = min($offset + $howmanyvids, $videocaount2);


	if($timeing == "t") {
			$playing = $conn->query(
			"SELECT comments.*, videos.*, videouser.* FROM comments
LEFT JOIN videos ON videos.vid = comments.vidon
LEFT JOIN users AS videouser ON videouser.uid = videos.uid
LEFT JOIN users AS commenting ON commenting.uid = comments.uid
WHERE videos.converted = 1 
  AND videos.privacy = 1 
  AND videouser.termination = 0 
  AND commenting.termination = 0 
  AND comments.is_reply = 0 
    AND comments.post_date > DATE_SUB(NOW(), INTERVAL 1 DAY)
GROUP BY videos.vid
ORDER BY COUNT(comments.cid) DESC  LIMIT $howmanyvids OFFSET $offset
"
		);
	
	} elseif($timeing == "w") {
	$playing = $conn->query(
			"SELECT comments.*, videos.*, videouser.* FROM comments
LEFT JOIN videos ON videos.vid = comments.vidon
LEFT JOIN users AS videouser ON videouser.uid = videos.uid
LEFT JOIN users AS commenting ON commenting.uid = comments.uid
WHERE videos.converted = 1 
  AND videos.privacy = 1 
  AND videouser.termination = 0 
  AND commenting.termination = 0 
  AND comments.is_reply = 0 
    AND comments.post_date > DATE_SUB(NOW(), INTERVAL 1 WEEK)
GROUP BY videos.vid
ORDER BY COUNT(comments.cid) DESC  LIMIT $howmanyvids OFFSET $offset"
		);
	
	} elseif($timeing == "m") {
		$playing = $conn->query(
			"SELECT comments.*, videos.*, videouser.* FROM comments
LEFT JOIN videos ON videos.vid = comments.vidon
LEFT JOIN users AS videouser ON videouser.uid = videos.uid
LEFT JOIN users AS commenting ON commenting.uid = comments.uid
WHERE videos.converted = 1 
  AND videos.privacy = 1 
  AND videouser.termination = 0 
  AND commenting.termination = 0 
  AND comments.is_reply = 0 
    AND comments.post_date > DATE_SUB(NOW(), INTERVAL 1 MONTH)
GROUP BY videos.vid
ORDER BY COUNT(comments.cid) DESC  LIMIT $howmanyvids OFFSET $offset"
		);
	
	} elseif($timeing == "a") {
		$playing = $conn->query(
			"SELECT comments.*, videos.*, videouser.* FROM comments
LEFT JOIN videos ON videos.vid = comments.vidon
LEFT JOIN users AS videouser ON videouser.uid = videos.uid
LEFT JOIN users AS commenting ON commenting.uid = comments.uid
WHERE videos.converted = 1 
  AND videos.privacy = 1 
  AND videouser.termination = 0 
  AND commenting.termination = 0 
  AND comments.is_reply = 0 
GROUP BY videos.vid
ORDER BY COUNT(comments.cid) DESC  LIMIT $howmanyvids OFFSET $offset"
		);

}  
} elseif($playlistmode == "rated") {

 $howmanyvids = 20; 
$videocaount = $conn->query("
  SELECT videos.*, 
       video_uploader.username AS username, 
       COUNT(ratings.rating) AS total_ratings, 
       AVG(ratings.rating) AS average_rating
FROM ratings
LEFT JOIN videos ON videos.vid = ratings.video
LEFT JOIN users AS video_uploader ON video_uploader.uid = videos.uid
LEFT JOIN users AS rating_user ON rating_user.uid = ratings.user
WHERE videos.converted = 1 
  AND videos.privacy = 1 
  AND video_uploader.termination = 0 
  AND rating_user.termination = 0
GROUP BY ratings.video, videos.vid, video_uploader.username
ORDER BY total_ratings DESC, average_rating DESC
LIMIT 100
")->fetchAll();
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
if ($currentPage < 1) $currentPage = 1; 
$videocaount2 = count($videocaount);
$totalPages = ceil($videocaount2 / $howmanyvids);
if ($currentPage > $totalPages) $currentPage = $totalPages; 

$offset = ($currentPage - 1) * $howmanyvids;
$start = $offset + 1;
$end = min($offset + $howmanyvids, $videocaount2);
$playing = $conn->prepare("
SELECT videos.*, 
       video_uploader.username AS username, 
       COUNT(ratings.rating) AS total_ratings, 
       AVG(ratings.rating) AS average_rating
FROM ratings
LEFT JOIN videos ON videos.vid = ratings.video
LEFT JOIN users AS video_uploader ON video_uploader.uid = videos.uid
LEFT JOIN users AS rating_user ON rating_user.uid = ratings.user
WHERE videos.converted = 1 
  AND videos.privacy = 1 
  AND video_uploader.termination = 0 
  AND rating_user.termination = 0
GROUP BY ratings.video, videos.vid, video_uploader.username
ORDER BY total_ratings DESC, average_rating DESC
LIMIT $howmanyvids OFFSET $offset
");   
} elseif($playlistmode == "featured") {


 $howmanyvids = 20; 
$videocaount = $conn->query("
SELECT * FROM picks LEFT JOIN videos ON videos.vid = picks.video LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY picks.featured DESC LIMIT 100
")->fetchAll();
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
if ($currentPage < 1) $currentPage = 1; 
$videocaount2 = count($videocaount);
$totalPages = ceil($videocaount2 / $howmanyvids);
if ($currentPage > $totalPages) $currentPage = $totalPages; 

$offset = ($currentPage - 1) * $howmanyvids;
$start = $offset + 1;
$end = min($offset + $howmanyvids, $videocaount2);
$playing = $conn->prepare("
SELECT * FROM picks LEFT JOIN videos ON videos.vid = picks.video LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY picks.featured DESC LIMIT $howmanyvids OFFSET $offset
"); 
} elseif($playlistmode == "random") {
 $howmanyvids = 20; 
$videocaount = $conn->query("
SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY RAND() DESC LIMIT 100
")->fetchAll();
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
if ($currentPage < 1) $currentPage = 1; 
$videocaount2 = count($videocaount);
$totalPages = ceil($videocaount2 / $howmanyvids);
if ($currentPage > $totalPages) $currentPage = $totalPages; 

$offset = ($currentPage - 1) * $howmanyvids;
$start = $offset + 1;
$end = min($offset + $howmanyvids, $videocaount2);
$playing = $conn->prepare("
SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY RAND() DESC LIMIT $howmanyvids OFFSET $offset
");     
} else {
$playing = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP :thetag) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 AND videos.rejected = 0   ORDER BY (INSTR(LOWER(tags), LOWER(:thetag)) > 0) DESC"); 
$playing->bindParam(':thetag', $tagstuff, PDO::PARAM_STR);
}
$playing->execute();
if($playlistmode != "related" && $playlistmode != "playlist") {
    $playingpage = $playing->fetchAll();
    $playing2 = $videocaount;
    $playing = $videocaount;
} else {
    $playing = $playing->fetchAll(PDO::FETCH_ASSOC);
}
    $schedulla = array_column($playing, 'vid');
    $schedex = array_search($video['vid'], $schedulla);
    $play_schedule = [];
    $play_schedule['before'] = ($schedex > 0) ? $schedulla[$schedex - 1] : null;
    $play_schedule['next'] = ($schedex < count($schedulla) - 1) ? $schedulla[$schedex + 1] : null;
if($playlistmode != "related" && $playlistmode != "playlist") {
    $schedulla2 = array_column($playingpage, 'vid');
    $schedex2 = array_search($video['vid'], $schedulla2);
    $play_schedule2 = [];
    $play_schedule2['before'] = ($schedex2 > 0) ? $schedulla2[$schedex2 - 1] : null;
    $play_schedule2['next'] = ($schedex2 < count($schedulla2) - 1) ? $schedulla2[$schedex2 + 1] : null;
}

$howmanyrelatedresults = 4;
if($playlistmode == "playlist") {
$related_vid_count = $conn->prepare("SELECT v.*, u.* 
    FROM videos v
    JOIN playlists p ON v.vid = p.vid
    JOIN users u ON v.uid = u.uid  
    WHERE p.pid = :pid
      AND v.converted = 1
      AND u.termination = 0
    AND p.action = 'add'
ORDER BY p.created_at DESC");
$related_vid_count->bindParam(':pid', $_REQUEST['p'], PDO::PARAM_STR);    
$relatedq = $conn->prepare("SELECT v.*, u.* 
    FROM videos v
    JOIN playlists p ON v.vid = p.vid
    JOIN users u ON v.uid = u.uid  
    WHERE p.pid = :pid
      AND v.converted = 1

      AND u.termination = 0
    AND p.action = 'add'
ORDER BY p.created_at DESC");
$relatedq->bindParam(':pid', $_REQUEST['p'], PDO::PARAM_STR);    
    
} else {
$relatedq = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP :thetag) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 AND videos.rejected = 0   ORDER BY (INSTR(LOWER(tags), LOWER(:thetag)) > 0) DESC LIMIT $howmanyrelatedresults");
$relatedq->bindParam(':thetag', $tagstuff, PDO::PARAM_STR);    

$related_vid_count = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP :thetag) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 AND videos.rejected = 0   ORDER BY (INSTR(LOWER(tags), LOWER(:thetag)) > 0) DESC");
$related_vid_count->bindParam(':thetag', $tagstuff, PDO::PARAM_STR);    
    
}

  if($playlistmode == "related" || $playlistmode == "playlist") {
    $related_vid_count->execute();
    $related_vid_count = $related_vid_count->rowCount();
  } else {
    $related_vid_count = $videocaount2;
  }
if($playlistmode != "related" && $playlistmode != "playlist") {
$relatedq = $playingpage;
} else {
$relatedq->execute();
$relatedq = $relatedq->fetchAll();
}


 $results = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 AND videos.rejected = 0   ORDER BY (INSTR(LOWER(tags), LOWER(?)) > 0) DESC");
    $results->execute([$tagstuff, $tagstuff]);    

$related_tags = [];
foreach($results as $result) {
    $related_tags = array_merge($related_tags, explode(" ", $result['tags']));
}
$related_tags = array_unique($related_tags);
$currenttaggy = explode(" ", $video['tags']);
$related_tags = array_diff($related_tags, $currenttaggy);
$related_tags = array_slice($related_tags, 0, 15);

// im gonna steal this for profiles
// Check for organic views (better spam prevention)
$organ_views = $conn->prepare("SELECT view_id AS views FROM views WHERE vid = ? AND viewed > DATE_SUB(NOW(), INTERVAL 1 DAY)");
$organ_views->execute([$video['vid']]);
$organc = $organ_views->rowCount();

if ($organc > 300) {
    $notOrganic = true;
}

// Check for organic views (better spam prevention)
$organ_views = $conn->prepare("SELECT view_id AS views FROM views WHERE vid = ? AND viewed > DATE_SUB(NOW(), INTERVAL 1 MINUTE)");
$organ_views->execute([$video['vid']]);
$organc = $organ_views->rowCount();

if ($organc > 15) {
    $notOrganic = true;
}

if ($notOrganic = true) {
$already_viewed = $conn->prepare("SELECT view_id AS views FROM views WHERE vid = ? AND viewed > DATE_SUB(NOW(), INTERVAL 1 HOUR)");    
$already_viewed->execute([$video['vid']]);
} else {
$already_viewed = $conn->prepare("SELECT view_id AS views FROM views WHERE vid = ? AND sid = ? AND viewed > DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
$already_viewed->execute([$video['vid'], session_id()]);
}
if(isset($_SERVER['HTTP_REFERER'])) {
    $vidReferer = $_SERVER['HTTP_REFERER'];
} else {
     $vidReferer = "https://www.epiktube.xyz";
}
if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], "www.epiktube.xyz") !== false){
  $vidReferer = "https://www.epiktube.xyz";  
}

if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], "24.155.166.254") !== false){
  $vidReferer = "https://www.epiktube.xyz";  
}
if($already_viewed->rowCount() == 0) {
    if(isset($_SESSION['uid'])) { 
	$add_view = $conn->prepare("INSERT IGNORE INTO views (view_id, referer, vid, sid, uid) VALUES (?, ? ,?, ?, ?)");
	$add_view->execute([generateId(34), $vidReferer, $video['vid'], session_id(), $session['uid']]);
	$add_view_cnt = $conn->prepare("UPDATE videos SET views = views + 1 WHERE vid = ?");
	$add_view_cnt->execute([$video['vid']]);
	$add_view_vidswatched = $conn->prepare("UPDATE users SET vids_watched = vids_watched + 1 WHERE uid = ?");
	$add_view_vidswatched->execute([$session['uid']]);
    } else {
    $add_view = $conn->prepare("INSERT IGNORE INTO views (view_id, referer, vid, sid, uid) VALUES (?, ?, ?, ?, NULL)");
	$add_view->execute([generateId(34), $vidReferer, $video['vid'], session_id()]);    
	$add_view_cnt = $conn->prepare("UPDATE videos SET views = views + 1 WHERE vid = ?");
	$add_view_cnt->execute([$video['vid']]);
    }
}


$comments = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON users.uid = comments.uid WHERE vidon = ? AND users.termination = 0 AND is_reply = 0 ORDER BY post_date ASC");
$comments->execute([$video['vid']]);
 
$commentc = $comments->rowCount();
if($commentc > 10) {
$recent = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON users.uid = comments.uid WHERE vidon = ? AND users.termination = 0 AND is_reply = 0 ORDER BY post_date ASC LIMIT 10");
$recent->execute([$video['vid']]);
}

if(isset($_SESSION['uid'])) { 
    // Logged in stuff
            $favorites_of_you = $conn->prepare(
	"SELECT * FROM favorites
	LEFT JOIN videos ON favorites.vid = videos.vid
	LEFT JOIN users ON users.uid = videos.uid
	WHERE favorites.uid = ? AND videos.converted = 1 AND videos.privacy = 1
	ORDER BY favorites.fid DESC"
);
$favorites_of_you->execute([$session['uid']]);

$videos_of_you = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ? AND videos.converted = 1 AND videos.privacy = 1
	ORDER BY videos.uploaded DESC"
);
$videos_of_you->execute([$session['uid']]);
$subscribed = $conn->prepare("SELECT subscription_id FROM subscriptions WHERE subscriber = ? AND subscribed_to = ? AND subscribed_type = 'user_uploads'");
    $subscribed->execute([
	$session['uid'],
	$uploader['uid']
    ]);

// End logged in stuff
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

    if (!isset($_SESSION['uid'])) {
    $par_link = 'signup';
    } else {
    $par_link = 'my_videos_upload';
    }


// HONORS
    $video_honors = [];
    /* Honors: Recently Featured */
    $really_featured = $conn->prepare("SELECT * FROM picks WHERE video = :video_id");
    $really_featured->bindParam(':video_id', $video['vid'], PDO::PARAM_STR);
    $really_featured->execute();

    if($really_featured->rowCount() == 1) {
        $video_honors[] = ["honor" => "Recently Featured", "url" => "s=rf&page=1"];
    }

    /* Honors: Most Viewed */
    $most_viewed = $conn->query(
    "SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT 50"
    );

    if ($most_viewed) {
    $most_viewed = $most_viewed->fetchAll(PDO::FETCH_ASSOC);
    $honor_find = array_search($video['vid'], array_column($most_viewed, 'vid'));
    unset($most_viewed);
    if ($honor_find !== false) {
        $where_it_is = $honor_find + 1;
        $video_honors[] = ["honor" => "#" . $where_it_is . " - Most Viewed", "url" => "s=mp&t=a&page=1"];
        }
    }
    /* Honors: Most Viewed (Today) */
    $most_viewed = $conn->query(
    "SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    WHERE viewed > DATE_SUB(NOW(), INTERVAL 1 DAY)
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT 50"
    );

    if ($most_viewed) {
    $most_viewed = $most_viewed->fetchAll(PDO::FETCH_ASSOC);
    $honor_find = array_search($video['vid'], array_column($most_viewed, 'vid'));
    unset($most_viewed);
    if ($honor_find !== false) {
        $where_it_is = $honor_find + 1;
        $video_honors[] = ["honor" => "#" . $where_it_is . " - Most Viewed (Today)", "url" => "s=mp&t=t&page=1"];
        }
    }
    /* Honors: Most Viewed (This Week) */
    $most_viewed = $conn->query(
    "SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    WHERE viewed > DATE_SUB(NOW(), INTERVAL 1 WEEK)
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT 50"
    );

    if ($most_viewed) {
    $most_viewed = $most_viewed->fetchAll(PDO::FETCH_ASSOC);
    $honor_find = array_search($video['vid'], array_column($most_viewed, 'vid'));
    unset($most_viewed);
    if ($honor_find !== false) {
        $where_it_is = $honor_find + 1;
        $video_honors[] = ["honor" => "#" . $where_it_is . " - Most Viewed (This Week)", "url" => "s=mp&t=w&page=1"];
        }
    }
    /* Honors: Most Viewed (This Month) */
    $most_viewed = $conn->query(
    "SELECT videos.*, users.*
FROM videos
LEFT JOIN users ON users.uid = videos.uid
LEFT JOIN (
    SELECT vid, COUNT(*) view_count
    FROM views
    WHERE viewed > DATE_SUB(NOW(), INTERVAL 1 MONTH)
    GROUP BY vid
) view_counts ON view_counts.vid = videos.vid
WHERE videos.converted = 1
  AND videos.privacy = 1
  AND users.termination = 0
GROUP BY videos.views
ORDER BY view_counts.view_count DESC LIMIT 50"
    );

    if ($most_viewed) {
    $most_viewed = $most_viewed->fetchAll(PDO::FETCH_ASSOC);
    $honor_find = array_search($video['vid'], array_column($most_viewed, 'vid'));
    unset($most_viewed);
    if ($honor_find !== false) {
        $where_it_is = $honor_find + 1;
        $video_honors[] = ["honor" => "#" . $where_it_is . " - Most Viewed (This Month)", "url" => "s=mp&t=m&page=1"];
        }
    }
    /* Honors: Most Discussed */
    $most_discussed = $conn->query(
    "SELECT * FROM comments
			LEFT JOIN videos ON videos.vid = comments.vidon
			LEFT JOIN users ON users.uid = videos.uid
			WHERE videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0 AND comments.is_reply = 0 GROUP BY comments.vidon
			ORDER BY COUNT(comments.cid) DESC LIMIT 50"
    );

    if ($most_discussed) {
    $most_discussed = $most_discussed->fetchAll(PDO::FETCH_ASSOC);
    $honor_find = array_search($video['vid'], array_column($most_discussed, 'vid'));
    unset($most_discussed);
    if ($honor_find !== false) {
        $where_it_is = $honor_find + 1;
        $video_honors[] = ["honor" => "#" . $where_it_is . " - Most Discussed", "url" => "s=md&page=1"];
        }
    }
    
    /* Honors: Top Favorite */
    $top_favorite = $conn->query(
    "SELECT * FROM favorites
			LEFT JOIN videos ON videos.vid = favorites.vid
			LEFT JOIN users ON users.uid = videos.uid
			WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) GROUP BY favorites.vid
			ORDER BY COUNT(favorites.fid) DESC LIMIT 1"
    );

    if ($top_favorite) {
    $top_favorite = $top_favorite->fetchAll(PDO::FETCH_ASSOC);
    $honor_find = array_search($video['vid'], array_column($top_favorite, 'vid'));
    unset($top_favorite);
    if ($honor_find !== false) {
        $where_it_is = $honor_find + 1;
        $video_honors[] = ["honor" => "Top Favorite", "url" => "s=mf&page=1"];
        }
    }
 $check = $conn->prepare("SELECT p.*, u.* 
        FROM playlists p
        JOIN users u ON p.uid = u.uid 
        WHERE u.termination = 0
          AND p.action = 'create'
          AND p.pid IN (SELECT DISTINCT p2.pid 
                        FROM playlists p2
                        WHERE p2.vid = :vid 
                          AND p2.action = 'add')
    ORDER BY p.created_at DESC");
      $check->bindParam(':vid', $video['vid']);
    $check->execute();
    $check = $check->fetchAll();

$ratingMessage = "Rate this video!"; 

                        if(isset($_SESSION['uid']) && $session['uid'] == $video['uid']) { $rating_error = "You cannot rate your own video."; }
                        if(!isset($_SESSION['uid'])) { $rating_error = "Please sign up and login to rate this video."; }
                        if($video['allow_votes'] == 0) { $rating_error = "Ratings have been disabled for this video."; }
                        if (getRatingCount($video['vid']) == 0) { $ratingMessage = "Be the first to rate this video!"; }
  if(!isset($rating_error)) {
  $already_rated = $conn->prepare("SELECT * FROM ratings WHERE user = :uid AND video = :video_id");
    $already_rated->execute([
	":uid" => $session['uid'],
	":video_id" => htmlspecialchars($video['vid'])
    ]);
    if ($already_rated->rowCount() == 0) {
    $ur_rating = 0;    
    } else {
    $already_rated = $already_rated->fetch(PDO::FETCH_ASSOC);
    $ur_rating = $already_rated['rating'];
    }
}
$SITE_LIST = $conn->prepare("SELECT DISTINCT referer FROM views WHERE vid = :id AND referer NOT LIKE '%epiktube.xyz%' AND referer NOT LIKE '%youtube.com%' AND referer != '' ORDER BY viewed DESC");
						$SITE_LIST->bindParam(':id', $video['vid']);
						$SITE_LIST->execute();
$_PAGE["Page"] = "watch";
require_once "_templates/_structures/watch.php";
?>