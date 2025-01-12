<?php
require __DIR__ . "/../needed/scripts.php";

if($_SERVER['REQUEST_URI'] == "/rss/global/recently_added.rss" || $_SERVER['REQUEST_URI'] == "/rss/") {
	$feed_title =  "Recently Added Videos";
	$feed_link = "http://www.epiktube.xyz/rss/global/recently_added.rss";
	$videos = $conn->query("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0 ORDER BY videos.uploaded DESC LIMIT 15");
} elseif($_SERVER['REQUEST_URI'] == "/rss/global/top_rated.rss" || $_SERVER['REQUEST_URI'] == "/rss/") {
 	$feed_title =  "EpikTube :: Top Rated";
	$feed_link = "http://www.epiktube.xyz/rss/global/top_rated.rss";
	$videos = $conn->query("SELECT * 
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
 LIMIT 15");
$feed_description = "Top Rated";
} elseif($_SERVER['REQUEST_URI'] == "/rss/global/recently_featured.rss" || $_SERVER['REQUEST_URI'] == "/rss/") {
$feed_title =  "EpikTube :: Recently Featured";
$feed_link = "http://www.epiktube.xyz/rss/global/recently_featured.rss";
$videos = $conn->query("SELECT * FROM picks LEFT JOIN videos ON videos.vid = picks.video LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY picks.featured DESC LIMIT 15");
$feed_description = "Recently Featured";
} elseif($_SERVER['REQUEST_URI'] == "/rss/global/top_favorites.rss" || $_SERVER['REQUEST_URI'] == "/rss/") {
 $feed_title =  "EpikTube :: Top Favorites";
$feed_link = "http://www.epiktube.xyz/rss/global/top_favorites.rss";
$videos = $conn->query("SELECT * FROM favorites
			LEFT JOIN videos ON videos.vid = favorites.vid
			LEFT JOIN users ON users.uid = videos.uid
			WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) GROUP BY favorites.vid
			ORDER BY COUNT(favorites.fid) DESC LIMIT 15");
$feed_description = "Top Favorites";   
} elseif($_SERVER['REQUEST_URI'] == "/rss/global/top_viewed_today.rss" || $_SERVER['REQUEST_URI'] == "/rss/") {
$feed_title =  "EpikTube :: Most Viewed Videos - Today";
$feed_link = "http://www.epiktube.xyz/rss/global/top_viewed_today.rss";
$videos = $conn->query("SELECT videos.*, users.*
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
ORDER BY view_counts.view_count DESC LIMIT 15;
    ");
$feed_description = "Most Viewed Videos - Today";       
} elseif (preg_match_all('/^\/rss\/user\/(\w+)\/videos\.rss$/m', $_SERVER['REQUEST_URI'], $matches, PREG_SET_ORDER, 0)) {
	$user = $conn->prepare("SELECT * FROM users WHERE username = ?");
	$user->execute([$matches['0']['1']]);
	if($user->rowCount() > 0) {
		$user = $user->fetch(PDO::FETCH_ASSOC);
		$feed_title = "EpikTube :: Videos by ".htmlspecialchars($user['username']);
		$feed_description = "Videos uploaded by ".htmlspecialchars($user['username'])." hosted at http://www.epiktube.xyz.";
		$feed_link = "http://www.epiktube.xyz/rss/user/".htmlspecialchars($user['username'])."/videos.rss";
		$videos = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE videos.uid = ? AND videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0  ORDER BY videos.uploaded DESC LIMIT 15");
		$videos->execute([$user['uid']]);
	} else {
		exit();
	}
} elseif (preg_match_all('/^\/rss\/tag\/(.*).rss$/m', $_SERVER['REQUEST_URI'], $matches, PREG_SET_ORDER, 0)) {
	$matches['0']['1'] = str_replace("+", " ", $matches['0']['1']);
	$search = str_replace(" ", "|", $matches['0']['1']);
	$videos = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE videos.tags REGEXP ? AND videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0  ORDER BY videos.uploaded DESC"); // Regex!
	$videos->execute([$search]);
	
	
	$feed_title = "EpikTube :: Tag // ".htmlspecialchars($matches['0']['1']);
	$feed_description = "Videos tagged with ".htmlspecialchars($matches['0']['1']);
	$feed_link = "http://www.epiktube.xyz/rss/tag/".urlencode($matches['0']['1']).".rss";
} else {
		exit();
}

header("Content-Type: text/xml");
echo '<?xml version="1.0" encoding="utf-8"?>
';
?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss">
	<channel>
		<title><?php echo $feed_title; ?></title>
		<link><?php echo $feed_link; ?></link>
		<description><?php echo $feed_description; ?></description>
		<?php foreach ($videos as $video) { ?>
		<item>
			<author>rss@www.epiktube.xyz (<?php echo htmlspecialchars($video['username']); ?>)</author>
			<title><?php echo htmlspecialchars($video['title']); ?></title>
			<link>http://www.epiktube.xyz/?v=<?php echo htmlspecialchars($video['vid']); ?></link>
			<description><![CDATA[
				<img src="http://www.epiktube.xyz/get_still?video_id=<?php echo htmlspecialchars($video['vid']); ?>" align="right" border="0" width="120" height="90" vspace="4" hspace="4" />
				<p><?php echo htmlspecialchars($video['description']); ?></p>
				<p>
					Author: <a href="http://www.epiktube.xyz/profile?user=<?php echo htmlspecialchars($video['username']); ?>"><?php echo htmlspecialchars($video['username']); ?></a><br/>
					Keywords: <?php foreach(explode(" ", $video['tags']) as $tag) echo '<a href="http://www.epiktube.xyz/results?search='.htmlspecialchars($tag).'">'.htmlspecialchars($tag).'</a> '; ?><br/>
					Added: <?php echo retroDate($video['uploaded']); ?><br/>
				</p>
			]]></description>
			<guid isPermaLink="true">http://www.epiktube.xyz/?v=<?php echo htmlspecialchars($video['vid']); ?></guid>
			<pubDate><?php echo retroDate($video['uploaded'], "r"); ?></pubDate>

			<media:player url="http://www.epiktube.xyz/?v=<?php echo htmlspecialchars($video['vid']); ?>" />
			<media:thumbnail url="http://www.epiktube.xyz/get_still?video_id=<?php echo htmlspecialchars($video['vid']); ?>" width="120" height="90" />
			<media:title><?php echo htmlspecialchars($video['title']); ?></media:title>
			<media:category label="Tags"><?php echo htmlspecialchars($video['tags']); ?></media:category>
			<media:credit><?php echo htmlspecialchars($video['username']); ?></media:credit>
			<enclosure url="http://www.epiktube.xyz/v/<?php echo htmlspecialchars($video['vid']); ?>.swf" length="<?php echo htmlspecialchars($video['time']); ?>" type="application/x-shockwave-flash" />
		</item>
		<?php } ?>
	</channel>
</rss>