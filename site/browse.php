<?php
require "needed/scripts.php";
if(isset($_GET['s']) && in_array($_GET['s'], ["mr", "mp", "md", "mf", "r", "rf", "tr"])) {
	$browse_sort = $_GET['s'];
} else {
	$browse_sort = "mr";
}
if(isset($_GET['f'])) {
$_GET['f'] = $_GET['f'];    
} else {
$_GET['f'] = null;
}
if(isset($_GET['t']) && in_array($_GET['t'], ["t", "w", "m", "a"])) {
	$time = $_GET['t'];
} else {
	$time = "t";
    $_GET['t'] =  "t";
}
if($browse_sort == "rf") {
	$videoc = $conn->query("SELECT * FROM picks LEFT JOIN videos ON videos.vid = picks.video LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY picks.featured DESC LIMIT 100");
} elseif($browse_sort == "mr") {
	$videoc = $conn->query("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY uploaded DESC LIMIT 300");
} elseif($browse_sort == "mp") {
	if($time == "t") {
		$videoc = $conn->query(
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
ORDER BY view_counts.view_count DESC
LIMIT 100;

"
		);
	} elseif($time == "w") {
		$videoc = $conn->query(
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
ORDER BY view_counts.view_count DESC LIMIT 100;"
		);
	} elseif($time == "m") {
		$videoc = $conn->query(
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
ORDER BY view_counts.view_count DESC LIMIT 100;"
		);
	} elseif($time == "a") {
		$videoc = $conn->query(
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
ORDER BY view_counts.view_count DESC LIMIT 100;"
		);
	}
} elseif($browse_sort == "tr") {
	$videoc = $conn->query(
			"SELECT * 
FROM ratings
LEFT JOIN videos ON videos.vid = ratings.video
LEFT JOIN users AS video_uploader ON video_uploader.uid = videos.uid
LEFT JOIN users AS rating_user ON rating_user.uid = ratings.user
WHERE videos.converted = 1 
    AND videos.privacy = 1 
    AND video_uploader.termination = 0 
    AND rating_user.termination = 0
GROUP BY ratings.video
ORDER BY COUNT(ratings.rating) DESC, AVG(ratings.rating) DESC 
 LIMIT 100"
		);   
} elseif($browse_sort == "md") {
 if($time == "t") {
    $videoc = $conn->query(
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
ORDER BY COUNT(comments.cid) DESC  
LIMIT 100
"
    );
} elseif($time == "w") {
    $videoc = $conn->query(
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
ORDER BY COUNT(comments.cid) DESC 
LIMIT 100
"
    );
} elseif($time == "m") {
    $videoc = $conn->query(
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
ORDER BY COUNT(comments.cid) DESC 
LIMIT 100
"
    );
} elseif($time == "a") {
   
    $videoc = $conn->query(
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
ORDER BY COUNT(comments.cid) DESC 
LIMIT 100
"
    );
}
} elseif($browse_sort == "mf") {
	$videoc = $conn->query(
			"SELECT * FROM favorites
			LEFT JOIN videos ON videos.vid = favorites.vid
			LEFT JOIN users ON users.uid = videos.uid
			WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) GROUP BY favorites.vid
			ORDER BY COUNT(favorites.fid) DESC LIMIT 100"
		);
	
} elseif($browse_sort == "r") {
	$videoc = $conn->query("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY RAND() DESC LIMIT 100");
}
$videoc = $videoc->rowCount();
if(isset($_GET['page'])) {
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
} else {
$page = 1;
$_GET['page'] = null;
}
$page = max(1, $page);
$ppv = 20;
$totalPages = ceil($videoc / $ppv);
if($videoc != 0) {
if($page > $totalPages) {
    $page = $totalPages;
}
} else {
  $totalPages = 1;
}
$offs = ($page - 1) * $ppv;

if($browse_sort == "rf") {
	$videos = $conn->query("SELECT * FROM picks LEFT JOIN videos ON videos.vid = picks.video LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY picks.featured DESC LIMIT $ppv OFFSET $offs");
} elseif($browse_sort == "mr") {
	$videos = $conn->query("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY uploaded DESC LIMIT $ppv OFFSET $offs");
} elseif($browse_sort == "mp") {
	if($time == "t") {
		$videos = $conn->query(
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
ORDER BY view_counts.view_count DESC
LIMIT $ppv OFFSET $offs;
"
		);
	} elseif($time == "w") {
		$videos = $conn->query(
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
ORDER BY view_counts.view_count DESC LIMIT $ppv OFFSET $offs"
		);
	} elseif($time == "m") {
		$videos = $conn->query(
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
ORDER BY view_counts.view_count DESC LIMIT $ppv OFFSET $offs
		");
	} elseif($time == "a") {
		$videos = $conn->query("SELECT videos.*, users.*
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
ORDER BY view_counts.view_count DESC LIMIT $ppv OFFSET $offs;"
		);
	}
} elseif($browse_sort == "tr") {

		$videos = $conn->query(
			"SELECT videos.*, 
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
LIMIT $ppv OFFSET $offs

"
		);
} elseif($browse_sort == "md") {
 if($time == "t") {
    $videos = $conn->query(
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
ORDER BY COUNT(comments.cid) DESC 
LIMIT $ppv OFFSET $offs
"
    );
} elseif($time == "w") {
    $videos = $conn->query(
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
ORDER BY COUNT(comments.cid) DESC 
LIMIT $ppv OFFSET $offs
"
    );
} elseif($time == "m") {
    $videos = $conn->query(
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
ORDER BY COUNT(comments.cid) DESC 
LIMIT $ppv OFFSET $offs
"
    );
} elseif($time == "a") {
   
    $videos = $conn->query(
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
ORDER BY COUNT(comments.cid) DESC 
LIMIT $ppv OFFSET $offs
"
    );
}
} elseif($browse_sort == "mf") {

		$videos = $conn->query(
			"SELECT * FROM favorites
			LEFT JOIN videos ON videos.vid = favorites.vid
			LEFT JOIN users ON users.uid = videos.uid
			WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) GROUP BY favorites.vid
			ORDER BY COUNT(favorites.fid) DESC LIMIT $ppv OFFSET $offs"
		);
	
} elseif($browse_sort == "r") {
	$videos = $conn->query("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY RAND() DESC LIMIT $ppv OFFSET $offs");
}
$_PAGE["Page"] = "browse";
require_once "_templates/_structures/main.php";
?>