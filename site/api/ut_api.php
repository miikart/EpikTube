<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Built by idsniper on Aug 24, 2022 for my_clips.swf on YRT, modified to work with EpikTube and expanded to be compatible with the entire API from way back
// currently being modified by pi as of 20 nov 2023 to support more methods
// currently being modified by copy as of idk 2024 to support playlists
header("Content-Type: text/xml");

require_once($_SERVER["DOCUMENT_ROOT"] . "/needed/scripts.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$ut_request = new SimpleXMLElement(file_get_contents('php://input'));
$request_type = (string) $ut_request->request_type;
$vid = (string) $ut_request->request->video_id;
$pid = (string) $ut_request->request->set;
if ($request_type == 'sequence_request'){
$postuser = (string) $ut_request->request->query;
if(!isset($postuser)) die();

$posttype = (string) $ut_request->request->type;

if ($posttype == 'user'){
$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ?");
$profile->execute([$postuser]);

if($profile->rowCount() == 0) {
	die();
} else {
	$profile = $profile->fetch(PDO::FETCH_ASSOC);
}

/*
$profile['videos'] = $conn->prepare("SELECT vid FROM videos WHERE uid = ? AND converted = 1");
$profile['videos']->execute([$profile["uid"]]);
$profile['videos'] = $profile['videos']->rowCount();
$profile['favorites'] = $conn->prepare("SELECT fid FROM favorites WHERE uid = ?");
$profile['favorites']->execute([$profile["uid"]]);
$profile['favorites'] = $profile['favorites']->rowCount();
*/

//$videos = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE videos.uid = ? AND videos.converted = 1 ORDER BY videos.uploaded DESC");
$videos = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE videos.uid = ? AND videos.converted = 1 ORDER BY videos.uploaded DESC LIMIT 50");
$videos->execute([$profile['uid']]);
} elseif($posttype == 'tag'){
//$videos = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 ORDER BY (INSTR(LOWER(description), LOWER(?)) > 0) DESC LIMIT $ppv OFFSET $offs");
$videos = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 ORDER BY (INSTR(LOWER(description), LOWER(?)) > 0) DESC LIMIT 50");
$videos->execute([$postuser, $postuser]);
} else {
die();
}
$numvideos = $videos->rowCount();
?>

<ut_response>
	<response_type>sequence_response</response_type>
	<response>
		<sequence_overview>
		    <title><?= htmlspecialchars($postuser) ?></title>
		    <length><?= $numvideos ?></length>
		    <md5_sum></md5_sum><? // todo: how was the md5 sum retrieved? ?>

		</sequence_overview>
		<sequence_items>
<?php if($videos !== false) { ?>
<?php foreach($videos as $video) { ?>
<?php
$video['views'] = $conn->prepare("SELECT COUNT(view_id) AS views FROM views WHERE vid = ?");
$video['views']->execute([$video['vid']]);
$video['views'] = $video['views']->fetchColumn();
$video['comments'] = $conn->prepare("SELECT COUNT(cid) AS comments FROM comments WHERE vidon = ?");
$video['comments']->execute([$video['vid']]);
$video['comments'] = $video['comments']->fetchColumn();
$tags = explode(" ", $video['tags']);
?>
			<sequence_item>
				<id><?php echo htmlspecialchars($video['vid']); ?></id>
				<author><?php echo htmlspecialchars($video['username']); ?></author>
				<title><?php echo htmlspecialchars($video['title']); ?></title>
				<keywords><?php echo htmlspecialchars($video['tags']); ?></keywords>
				<description><?php echo htmlspecialchars($video['description']); ?></description>
				<date_uploaded><?php echo retroDate($video['uploaded']); ?></date_uploaded>
				<view_count><?php echo $video['views']; ?></view_count>
				<comment_count><?php echo $video['comments']; ?></comment_count>
			</sequence_item>
<?php } ?>
<?php } ?>
		</sequence_items>
	</response>
</ut_response>
<?php
} elseif($request_type == 'get_video_details_request'){
$video_id = (string) $ut_request->request->video_id;
$video = $conn->prepare("SELECT * FROM videos WHERE vid = ? AND converted = 1");
$video->execute([$video_id]);

if($video->rowCount() == 0) {
	die();
} else {
	$video = $video->fetch(PDO::FETCH_ASSOC);
}
$uploader = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$uploader->execute([$video['uid']]);
$uploader = $uploader->fetch(PDO::FETCH_ASSOC);
$video['views'] = $conn->prepare("SELECT COUNT(view_id) AS views FROM views WHERE vid = ?");
$video['views']->execute([$video['vid']]);
$video['views'] = $video['views']->fetchColumn();
$comments = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON users.uid = comments.uid WHERE vidon = ? AND users.termination = 0 AND is_reply = 0 ORDER BY post_date ASC");
$comments->execute([$video['vid']]);
$views = $conn->prepare("SELECT COUNT(view_id) AS views FROM views WHERE vid = ?");
$views->execute([$video['vid']]);
$video['views'] = $views->fetchColumn();
$vote_count = getRatingCount($video['vid']);
$avg = $GLOBALS['conn']->prepare("SELECT AVG(rating) FROM ratings WHERE video = ?");
$avg->execute([$video['vid']]);
$vote_sum = $avg->fetchColumn();
$search = preg_quote($video['tags']);
$search = str_replace(" ", "|", $search);
//$results = $conn->prepare("SELECT tags FROM videos WHERE videos.tags REGEXP ? AND videos.converted = 1 AND videos.privacy = 1 ORDER BY videos.uploaded DESC LIMIT 2");
$results = $conn->prepare("SELECT tags FROM videos WHERE videos.tags REGEXP ? AND videos.converted = 1 AND videos.privacy = 1 ORDER BY videos.uploaded DESC LIMIT 15");
$results->execute([$search]);
$related_videos_by_author = $conn->prepare("SELECT vid FROM videos WHERE videos.uid = ? AND videos.vid != ? AND (videos.converted = 1 AND videos.privacy = 1) ORDER BY videos.uploaded DESC LIMIT 3");
$related_videos_by_author->execute([$video['uid'], $video['vid']]);
if($video['privacy'] == 1){
$public = "true";
} else {
$public = "false";
}
?>
<ut_response>
    <response_type>get_video_details</response_type>
    <response>
        <public><?= $public ?></public>
        <view_count><?= $video['views'] ?></view_count>
        <vote_count><?= $vote_count ?></vote_count>
        <vote_sum><?= $vote_sum ?></vote_sum>
        <related_videos_by_author>
<?php
//$relatedvids = [];
//foreach($related_videos_by_author as $resultvid) $relatedvids = array_merge($relatedvids, $resultvid['vid']);
//$relatedvids = array_unique($relatedvids);
foreach($related_videos_by_author as $relatedvid) {
?>
            <video_id><?= $relatedvid['vid'] ?></video_id>
<?php } ?>
        </related_videos_by_author>
        <related_tags>
<?php
$related_tags = [];
foreach($results as $result) $related_tags = array_merge($related_tags, explode(" ", $result['tags']));
$related_tags = array_unique($related_tags);
foreach($related_tags as $tag) {
?>
            <tag><?= htmlspecialchars($tag) ?></tag>
<?php } ?>
        </related_tags>
        <author>
            <username><?= htmlspecialchars($uploader['username']) ?></username>
        </author>
        <video>
            <title><?= htmlspecialchars($video['title']) ?></title>
            <length><?= htmlspecialchars($video['time']) ?></length>
            <description><?= htmlspecialchars($video['description']) ?></description>
            <time_created><?= retroDate($video['uploaded']) ?></time_created>
        </video>
        <comments>
<?php foreach($comments as $comment) {
?>
            <comment>
                <time_created><?= retroDate($comment['post_date']) ?></time_created>
                <author><?= htmlspecialchars($comment['username']) ?></author>
                <comment><?= htmlspecialchars($comment['body']) ?></comment>
            </comment>
<? } ?>
        </comments>
    </response>
</ut_response>
<?php
} elseif($request_type == 'send_video_request'){

$postemails = (string) $ut_request->request->to;
$postemails = explode(',', $postemails);
$postfrom = (string) $ut_request->request->from;
$postmessage = (string) $ut_request->request->message;
$postsharevid = (string) $ut_request->request->video_id;
$postrequestertype = (string) $ut_request->requester->type;

if (($postrequestertype == "session" || $postrequestertype == "anonymous" && !empty($postfrom)) && !empty($postemails) && strlen($postmessage) < 10000 && !empty($postsharevid) && strlen($postmessage) > 0) {
$videodesc = $conn->prepare("SELECT description FROM videos WHERE vid = ?");
$videodesc->execute([$postsharevid]);
$videodesc = $videodesc->fetchColumn();
$videotitle = $conn->prepare("SELECT title FROM videos WHERE vid = ?");
$videotitle->execute([$postsharevid]);
$videotitle = $videotitle->fetchColumn();
if($postrequestertype == "session"){
$fromname = $session['username'];
$clickhere = 'To respond to '.  htmlspecialchars($fromname) .', <a href="http://www.epiktube.xyz/">click here</a>';
} elseif($postrequestertype == "anonymous"){
$fromname = $postfrom;
$clickhere = "";
}
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $config["host"];                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $config["email"];                // SMTP username
    $mail->Password = $config["epassword"];
    $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port $config["emport"]
    $mail->Port = $config["emport"];                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($config["email"], 'EpikTube Service');
foreach($postemails as $postemail) {
if(str_contains($postemail, "@")){
    $mail->addAddress($postemail);     // Add a recipient  
}
}

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = htmlspecialchars($fromname).' sent you a video!';
    //$mail->Body    = '<link href="//www.epiktube.xyz/styles.css" rel="stylesheet" type="text/css"><img src="//www.epiktube.xyz/img/logo.gif"  hspace="12" vspace="12" alt="EpikTube"><br>'.htmlspecialchars($fromname).' wants to share a video with you<p><div class="BoxedBorderTable" style="padding-left: 10px;border-top: 1px solid #CCCCCC;border-bottom: 1px solid #CCCCCC;border-right: 1px solid #CCCCCC;border-left: 1px solid #CCCCCC;padding: 5px 5px 5px 5px; width: 120px; text-align: center"><a href="//www.epiktube.xyz/watch.php?v='.htmlspecialchars($postsharevid).'"><img src="//www.epiktube.xyz/get_still.php?video_id='.htmlspecialchars($postsharevid).'"></a><div class="commentsSpecifics"><a href="//www.epiktube.xyz/watch.php?v='.htmlspecialchars($postsharevid).'">watch video</a></div></div><p><b style="font-size: 14px">Video Description</b><p>'. htmlspecialchars($videodesc) .'<p><b style="font-size: 14px">Personal Message</b><p>'. nl2br(htmlspecialsomechars($postmessage, ['b', 'i', 'big'])) .' <br>'.  $clickhere .'<p>Thanks, '.  htmlspecialchars($fromname) .'<p><i>EpikTube - '. invokethConfig("slogan") .'</i><p><small>To change or cancel your email notifications, go to your <a href="//www.epiktube.xyz/my_profile_email.php">email options</a>.</small><br><br><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png"  vspace="12" alt="EpikTube"><br>'.htmlspecialchars($fromname).' wants to share a video with you<p><div style="padding-left: 10px;border-top: 1px solid #CCCCCC;border-bottom: 1px solid #CCCCCC;border-right: 1px solid #CCCCCC;border-left: 1px solid #CCCCCC;padding: 5px 5px 5px 5px; width: 120px; text-align: center"><a href="http://www.epiktube.xyz/watch.php?v='.htmlspecialchars($postsharevid).'"><img src="http://www.epiktube.xyz/get_still.php?video_id='.htmlspecialchars($postsharevid).'"></a><div><a href="http://www.epiktube.xyz/watch.php?v='.htmlspecialchars($postsharevid).'">watch video</a></div></div><p><b style="font-size: 14px">Video Description</b><p>'. htmlspecialchars($videodesc) .'<p><b style="font-size: 14px">Personal Message</b><p>'. nl2br(htmlspecialsomechars($postmessage, ['b', 'i', 'big'])) .' <br>'.  $clickhere .'<p>Thanks, '.  htmlspecialchars($fromname) .'<p><i>EpikTube - '. invokethConfig("slogan") .'</i><p><small>To change or cancel your email notifications, go to your <a href="http://www.epiktube.xyz/my_profile_email.php">email options</a>.</small><br><br><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright &copy; '. retroDate(date("Y"), "Y") .' EpikTube, LLC';
    $mail->AltBody = $fromname.' wants to share a video with you

'.$videotitle.'

http://www.epiktube.xyz/watch.php?v='.$postsharevid.'

Video Description:
'. $videodesc .'

Personal Message:
'. $postmessage .'

Thanks, '.  $fromname;

    //$mail->XMailer = ' ';
    $mail->addReplyTo($config["email"], 'EpikTube Service');
    $mail->send();
} catch (Exception $e) {
   die("email fuckup");
}
//header("Location: outbox.php?thanks");
    } else {

// uh oh
die();
}
?>
<ut_response>
  <response_type>send_video_response</response_type>
  <response>
  </response>
</ut_response>
<?php
} elseif($request_type == 'get_contacts_request'){
if(isset($_SESSION['uid'])){
//$contacts = $conn->prepare("SELECT * FROM relationships WHERE (sender = ? OR respondent = ?) ORDER BY sent ASC");
$contacts = $conn->prepare("SELECT * FROM relationships WHERE (sender = ? OR respondent = ?) AND accepted = 1 ORDER BY sent ASC");
$contacts->execute([$_SESSION['uid'], $_SESSION['uid']]);
$contacts = $contacts->fetchAll(PDO::FETCH_ASSOC);

$contacts2 = $conn->prepare("SELECT * FROM relationships WHERE sender = ? AND accepted = 0 ORDER BY sent ASC");
$contacts2->execute([$_SESSION['uid']]);
$contacts2 = $contacts2->fetchAll(PDO::FETCH_ASSOC);
$contacts = array_merge($contacts, $contacts2);

} else {
die();
}
?>
<ut_response>
  <response_type>get_contacts_response</response_type>
  <response>
    <labels>
<? 
if(isset($customlabel)){
?>
        <label>cool</label>
<? } ?>
    </labels>
    <contacts>
<?php
foreach($contacts as $contact) {
if($contact['sender'] == $_SESSION['uid']){
$contactuid = $contact['respondent'];
} else {
$contactuid = $contact['sender'];
}
/*
if($contact['accepted'] == 1){
$accepted = "true";
} else {
$accepted = "false";
}
*/
?>
        <contact>
		<labels>
<? if($contact['status'] == 1) { ?>
		<label>Friends</label>
<? } elseif($contact['status'] == 2) { ?>
		<label>Family</label>
<? } 
if(isset($customlabel)){
?>
		<label>cool</label>
<? } ?>
		</labels>
<? if(0 == 1) { ?>
		<type>EMAIL</type>
		<email>jk1@jawed.com</email>
<? } else { ?>
		<type>USER</type>
<?php
$contact['username'] = $conn->prepare("SELECT username FROM users WHERE uid = ?");
$contact['username']->execute([$contactuid]);
$contact['username'] = $contact['username']->fetchColumn();
?>
		<username><?= htmlspecialchars($contact['username']) ?></username>
<? } 
if(isset($nick)){
?>
		<nick>jawed</nick>
<? }
if($contact['accepted'] == 1){
?>
		<accepted>true</accepted>
<? } ?>
		<id><?= htmlspecialchars($contact['relationship']) ?></id>
        </contact>
<? } ?>
    </contacts>
  </response>
</ut_response>
<?php
} elseif($request_type == 'add_label_request'){
$postlabel = (string) $ut_request->request->label;
?>
<ut_response>
  <response_type>add_label_response</response_type>
  <response>
    <label><?= htmlspecialchars($postlabel) ?></label>
  </response>
</ut_response>
<?php
} elseif($request_type == 'get_sets_request'){ 
 if(!isset($_SESSION['uid']) && $_SESSION['uid'] == null) {
     exit("LOGIN");
 } 
 $theplaylists = $conn->prepare(
	"SELECT * FROM playlists
	LEFT JOIN users ON users.uid = playlists.uid
	WHERE playlists.uid = ? AND playlists.action = 'create' ORDER BY playlists.created_at DESC"
);
$theplaylists->execute([$session['uid']]);
$theplaylists = $theplaylists->fetchAll();
echo '<ut_response>';
echo '<response_type>get_sets_response</response_type>';
echo '<response>';
echo '<sets>';
foreach ($theplaylists as $playlist) { 
echo '<set>';
echo '<name>'. $playlist['title'] .'</name>';
echo '</set>';
}
echo '</sets>';
echo '</response>';
echo '</ut_response>'; 
exit;
} elseif($request_type == 'add_set_video_request') { 
$wharplay = $conn->prepare("SELECT * FROM playlists WHERE title = :pid AND uid = :uid AND action = 'create'");
$wharplay->bindParam(':pid', $pid);
$wharplay->bindParam(':uid', $session['uid']);
$wharplay->execute();
$wharplay = $wharplay->fetch();
if($wharplay) {
$checkifalreadyadded = $conn->prepare("SELECT * FROM playlists WHERE vid = :vid AND uid = :uid AND action = 'add' AND title = :pid");
$checkifalreadyadded->bindParam(':vid', $vid);
$checkifalreadyadded->bindParam(':uid', $session['uid']);
$checkifalreadyadded->bindParam(':pid', $pid);
$checkifalreadyadded->execute();
$checkifalreadyadded = $checkifalreadyadded->fetch();
} else {
echo '<ut_response>';
echo '<response_type>error_message</response_type>';
echo '<response>';
echo '<error_message>PlayList does not exist.</error_message>';
echo '</response>';
echo '</ut_response>';   
exit;
}
if($checkifalreadyadded) {
echo '<ut_response>';
echo '<response_type>error_response</response_type>';
echo '<response>';
echo '<error_message>This video is already in the selected playlist.</error_message>';
echo '</response>';
echo '</ut_response>';
exit;
} else {
$videoexist = $conn->prepare("  SELECT v.* 
    FROM videos v
    JOIN users u ON u.uid = v.uid
    WHERE v.vid = :vid AND v.converted = 1 AND u.termination = 0");
$videoexist->bindParam(':vid', $vid);
$videoexist->execute();
$videoexist = $videoexist->fetch();
if($videoexist) {
$title = trim((string) $ut_request->request->set);
$desc = trim((string) $ut_request->request->description);
$action = "add";
$q = $conn->prepare("INSERT INTO playlists (title, description, uid, action, vid, pid) VALUES (:title, :desc, :uid, :action, :vid, :pid)");
$q->bindParam(':title', $title);
$q->bindParam(':desc', $desc);
$q->bindParam(':uid', $session['uid']);
$q->bindParam(':action', $action);
$q->bindParam(':vid', $vid);
$q->bindParam(':pid', $wharplay['pid']);
$q->execute();
echo '<ut_response>';
echo '<response_type>add_set_video_response</response_type>';
echo '<response>';
echo '</response>';
echo '</ut_response>';
exit;
} else {
echo '<ut_response>';
echo '<response_type>error_response</response_type>';
echo '<response>';
echo '<error_message>The video you are trying to add does not exist or the uploader is terminated.</error_message>';
echo '</response>';
echo '</ut_response>';    
exit;
}
}
} elseif($request_type = "add_set_request") {
 if(!(isset($_SESSION['uid'])) && $_SESSION['uid'] == null) {
     exit("LOGIN");
 } 
$videoexist = $conn->prepare(" SELECT v.* 
    FROM videos v
    JOIN users u ON u.uid = v.uid
    WHERE v.vid = :vid AND v.converted = 1 AND u.termination = 0");
$videoexist->bindParam(':vid', $vid);
$videoexist->execute();
$videoexist = $videoexist->fetch();
if($videoexist) {
$title = trim((string) $ut_request->request->set);
$desc = trim((string) $ut_request->request->description);
$action = "create";
$id = generateId2();
if (!empty($title) && strlen($title) <= 60 && strlen($desc) <= 1000) {
$checkiftaken = $conn->prepare("SELECT * FROM playlists WHERE title = :title");
$checkiftaken->bindParam(':title', $title);
$checkiftaken->execute();
$checkiftaken = $checkiftaken->fetch();
if($checkiftaken) {
echo '<ut_response>';
echo '<response_type>error_response</response_type>';
echo '<response>';
echo '<error_message>There is already another playlist with the same name.</error_message>';
echo '</response>';
echo '</ut_response>';  
exit;
} else {
$q = $conn->prepare("INSERT INTO playlists (title, description, uid, action, vid, pid) VALUES (:title, :desc, :uid, :action, '0', :pid)");
$q->bindParam(':title', $title);
$q->bindParam(':desc', $desc);
$q->bindParam(':uid', $session['uid']);
$q->bindParam(':action', $action);
$q->bindParam(':pid', $id);
$q->execute();
$addvideo = $conn->prepare("INSERT INTO playlists (title, description, uid, action, vid, pid) VALUES (:title, :desc, :uid, 'add', :vid, :pid)");
$addvideo->bindParam(':title',  $title);
$addvideo->bindParam(':desc', $desc);
$addvideo->bindParam(':uid', $session['uid']);
$addvideo->bindParam(':vid', $videoexist['vid']);
$addvideo->bindParam(':pid', $id);
$addvideo->execute();
echo '<ut_response>';
echo '<response_type>add_set_response</response_type>';
echo '<response>';
echo '</response>';
echo '</ut_response>';
exit;
}
} else {
if(strlen($title) > 60) {
echo '<ut_response>';
echo '<response_type>error_response</response_type>';
echo '<response>';
echo '<error_message>Title is too long.</error_message>';
echo '</response>';
echo '</ut_response>';    
exit;   
} elseif(strlen($desc) > 1000) {
echo '<ut_response>';
echo '<response_type>error_response</response_type>';
echo '<response>';
echo '<error_message>Description is too long.</error_message>';
echo '</response>';
echo '</ut_response>';     
} elseif(empty($title)) {
echo '<ut_response>';
echo '<response_type>error_response</response_type>';
echo '<response>';
echo '<error_message>Title is too short.</error_message>';
echo '</response>';
echo '</ut_response>';    
exit; 
}
}
}
}
} else {
die();
}