<?php
require "needed/scripts.php";
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['get_comments']) && isset($_GET['v'])) {
$check = $conn->prepare("
    SELECT videos.*
    FROM videos
    JOIN users ON videos.uid = users.uid
    WHERE videos.vid = :vid
    AND users.termination = 0 AND videos.converted = 1
");
$check->bindParam(':vid', $_REQUEST['v']);
$check->execute();
$check = $check->fetch();
if($check) {
$comments = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON users.uid = comments.uid WHERE vidon = ? AND users.termination = 0 AND is_reply = 0 ORDER BY post_date ASC");
$comments->execute([$_GET['v']]);

 if($comments !== false) {
				foreach($comments as $comment) { ?>

<a name="<?php echo htmlspecialchars($comment['cid']); ?>">

					<table class="parentSection" id="comment_<?php echo htmlspecialchars($comment['cid']); ?>" width="100%" style="margin-left: 0px">
					<tbody><tr valign="top">
						<? if ($comment['removed'] == 1) { echo '----- Comment deleted by user -----</td>'; } else { ?>
	
						<?php if($comment['vid'] != NULL) { ?>
					<td>
						<a href="watch.php?v=<?php echo htmlspecialchars($comment['vid']); ?>"><img src="/get_still.php?video_id=<?php echo htmlspecialchars($comment['vid']); ?>" class="commentsThumb" width="60" height="45"></a>
							<div class="commentSpecifics">
								<a href="watch.php?v=<?php echo htmlspecialchars($comment['vid']); ?>">Related Video</a>
							</div></td>
					<?php } ?>
					
						<td>

					
		<?= nl2br(htmlspecialsomechars($comment['body'], ['b', 'i', 'big'])) ?> 
							<div class="userStats">
								<? if($comment['termination'] != 1) {?>- <a href="profile?user=<?php echo htmlspecialchars($comment['username']); ?>"><?php echo htmlspecialchars($comment['username']); ?></a> // <a href="profile_videos.php?user=<?php echo htmlspecialchars($comment['username']); ?>">Videos</a> (<?php echo getpublicvideos($comment['uid']); ?>) | <a href="profile_favorites.php?user=<?php echo htmlspecialchars($comment['username']); ?>">Favorites</a> (<?php echo getfavoritecount($comment['uid']) ?>) | <a href="profile_friends.php?user=<?php echo htmlspecialchars($comment['username']); ?>">Friends</a> (<?php echo getfriendcount($comment['uid']) ?>)<? } ?>
								 (<?= timeAgo($comment['post_date']); ?>)
							</div>
	<div class="userStats" id="container_comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>" style="display: none"></div>
        <div class="userStats" id="reply_comment_form_id_<? echo htmlspecialchars($comment['cid']); ?>">
      (<a href="javascript:showCommentReplyForm('comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>', '<?php echo htmlspecialchars($comment['cid']); ?>', false);">Reply to this</a>) &nbsp; 
				  (<a href="javascript:showCommentReplyForm('comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>', '', false);">Create new thread</a>) &nbsp; 

			  <?php if (isset($_SESSION['uid']) && $check['uid'] == $session['uid'] || isset($_SESSION['uid']) && $session['staff'] == 1 && $comment['uid'] != NULL) { ?>
				<input type="button" name="remove_comment" id="remove_button_<?php echo htmlspecialchars($comment['cid']); ?>" value="Remove Comment" onclick="removeComment(document.getElementById('remove_comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>'));"> &nbsp; 
	<form name="remove_comment_form" id="remove_comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>">
		<input type="hidden" name="deleter_user_id" value="<?php echo htmlspecialchars($session['uid']); ?>">
		<input type="hidden" name="remove_comment" value="">
			<input type="hidden" name="comment_id" value="<?php echo htmlspecialchars($comment['cid']); ?>">
		<input type="hidden" name="comment_type" value="V">
	</form>
<? } ?>
	</div>
<div id="div_comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>"></div>
	
			</td>
					</tr>
				</tbody></table>


</a>
	
<? } getReplies($comment['cid'], $_REQUEST['v'], $check['uid']); } } ?>
<?php } exit; }  ?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_comment'])) {
if(empty($_POST['reply_parent_id'])) {
// Make sure the user is logged in.
if($_SESSION['uid'] == NULL) {
	echo "LOGIN";
	die();
}
if($session['em_confirmation'] != 'true') { echo("ERROR" ); echo("Your account needs to have an verified email."); exit; }

// Make sure variables are set
if(!isset($_POST['video_id']) || !isset($_POST['comment'])) {
	die("ERROR");
}

// Check if the video in question exists.
$video_exists = $conn->prepare("SELECT vid FROM videos WHERE vid = :video_id AND converted = 1");
$video_exists->execute([
	":video_id" => $_POST['video_id']
]);

if($video_exists->rowCount() == 0) {
	die("ERROR");
}

// Check if the video in question exists.
if(!empty($_POST['field_reference_video'])) {
    
$video_exists = $conn->prepare("SELECT vid FROM videos WHERE vid = :video_id AND converted = 1");
$video_exists->execute([
	":video_id" => $_POST['field_reference_video']
]);

if($video_exists->rowCount() == 0) {
	die("ERROR");
}
}
// Check if the user has already commented on this video within the past 5 minutes.
$comment_exists = $conn->prepare("SELECT cid FROM comments WHERE uid = :uid AND vidon = :video_id AND post_date > DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
$comment_exists->execute([
	":uid" => $session['uid'],
	":video_id" => $_POST['video_id']
]);

if($comment_exists->rowCount() > 4) {
	die("ERROR");
}
$comments_disabled = $conn->prepare("SELECT * FROM videos WHERE vid = :video_id AND converted = 1");
$comments_disabled->execute([
	":video_id" => $_POST['video_id']
]);

if($comments_disabled->rowCount() == 0) {
	die("ERROR");
} else {
	$comments_disabled = $comments_disabled ->fetch(PDO::FETCH_ASSOC);
}
$author = $comments_disabled['uid'];
$comments_disabled = $comments_disabled['comms_allow'];

if($comments_disabled < 1 && $session['uid'] != $author) { die("ERROR"); }
// Post that comment!
$post_comment = $conn->prepare("INSERT IGNORE INTO comments (cid, vidon, vid, uid, body) VALUES (:comment_id, :video_id, :referenced, :uid, :body)");
$post_comment->execute([
	":comment_id" => generateId(),
	":video_id" => $_POST['video_id'],
    ":referenced" => $_POST['field_reference_video'],
	":uid" => $session['uid'],
	":body" => trim($_POST['comment'])
]);
$add_cnt = $conn->prepare("UPDATE videos SET comm_count = comm_count + 1 WHERE vid = ?");
$add_cnt->execute([$_POST['video_id']]);
echo "OK "; echo htmlspecialchars($_POST["form_id"]);
exit;
} elseif(!empty($_POST['reply_parent_id'])) {
ob_get_clean();
// Make sure the user is logged in.
if($_SESSION['uid'] == NULL) {
	echo "LOGIN";
	die();
}
if($session['em_confirmation'] != 'true') { echo("ERROR" ); echo("Your account needs to have an verified email."); exit; }
// Make sure variables are set
if(!isset($_POST['video_id']) || !isset($_POST['comment'])) {
	die("ERROR");
}

// Check if the video in question exists.
$video_exists = $conn->prepare("SELECT vid FROM videos WHERE vid = :video_id AND converted = 1");
$video_exists->execute([
	":video_id" => $_POST['video_id']
]);

if($video_exists->rowCount() == 0) {
	die("ERROR");
}

// Check if the video in question exists.
if(!empty($_POST['field_reference_video'])) {
    
$video_exists = $conn->prepare("SELECT vid FROM videos WHERE vid = :video_id AND converted = 1");
$video_exists->execute([
	":video_id" => $_POST['field_reference_video']
]);

if($video_exists->rowCount() == 0) {
	die("ERROR");
}
}
// Check if the comment in question exists.
$parentcomment_exists = $conn->prepare("SELECT cid FROM comments WHERE cid = :comment_id");
$parentcomment_exists->execute([
	":comment_id" => $_POST['reply_parent_id']
]);

if($parentcomment_exists->rowCount() == 0) {
	die("ERROR");
}

// Check if the comment in question is a master comment.
$master_comment = $conn->prepare("SELECT master_comment FROM comments WHERE cid = :comment_id");
$master_comment->execute([
	":comment_id" => $_POST['reply_parent_id']
]);
$master_comment = $master_comment->fetchColumn();

if(empty($master_comment)) {
	$master_comment = $_POST['reply_parent_id'];
}

// Check if the user has already commented on this video within the past 5 minutes.
$comment_exists = $conn->prepare("SELECT cid FROM comments WHERE uid = :uid AND vidon = :video_id AND post_date > DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
$comment_exists->execute([
	":uid" => $session['uid'],
	":video_id" => $_POST['video_id']
]);

if($comment_exists->rowCount() > 4) {
	die("ratelimited lolzies");
}
$comments_disabled = $conn->prepare("SELECT * FROM videos WHERE vid = :video_id AND converted = 1");
$comments_disabled->execute([
	":video_id" => $_POST['video_id']
]);

if($comments_disabled->rowCount() == 0) {
	die("ERROR");
} else {
	$comments_disabled = $comments_disabled ->fetch(PDO::FETCH_ASSOC);
}
$author = $comments_disabled['uid'];
$comments_disabled = $comments_disabled['comms_allow'];

if($comments_disabled < 1 && $session['uid'] != $author) { die("ERROR"); }
// Post that comment!
$post_comment = $conn->prepare("INSERT IGNORE INTO comments (cid, vidon, vid, uid, body, is_reply, reply_to, master_comment) VALUES (:comment_id, :video_id, :referenced, :uid, :body, :is_reply, :reply_to, :master_comment)");
$post_comment->execute([
	":comment_id" => generateId(),
	":video_id" => $_POST['video_id'],
    ":referenced" => $_POST['field_reference_video'],
	":uid" => $session['uid'],
	":body" => trim($_POST['comment']),
	":is_reply" => 1,
	":reply_to" => $_POST['reply_parent_id'],
	":master_comment" => $master_comment
]);

$master_author = $conn->prepare("SELECT uid FROM comments WHERE cid = :cid");
$master_author->execute([
	":cid" => $_POST['reply_parent_id']
]);
$master_author = $master_author->fetch(PDO::FETCH_ASSOC);
$pmid = generateId();
if($_SESSION['uid']  !=  $master_author['uid']) {
$sssdsd = $conn->prepare("INSERT IGNORE INTO messages (pmid, subject, sender, receiver, body) VALUES (:pmid, :subject, :sender, :receiver, :body)");
$sssdsd->execute([
	":pmid" => trim($pmid),
	":subject" => encrypt('I have replied to your comment on a video'),
	":sender" => $session['uid'],
    ":receiver" => $master_author['uid'],
	":body" => encrypt('Check it out! https://www.epiktube.xyz/?v='.$_POST['video_id'])
]);
}
echo "OK "; echo htmlspecialchars($_POST["form_id"]);
exit;
} else {
die("ERROR");
}
} elseif($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_comment'])) {
if($session['em_confirmation'] != 'true') { echo("ERROR" ); echo("Your account needs to have an verified email."); exit; }
$comment = $conn->prepare("SELECT * FROM comments WHERE cid = ?");
$comment->execute([$_POST['comment_id']]);
$comment = $comment->fetch(PDO::FETCH_ASSOC);

$video = $conn->prepare("SELECT * FROM videos WHERE vid = ?");
$video->execute([$comment['vidon']]);
$video = $video->fetch(PDO::FETCH_ASSOC);

$uploader = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$uploader->execute([$video['uid']]);
$uploader = $uploader->fetch(PDO::FETCH_ASSOC);
// if ($uploader['uid'] == $session['uid'] || $comment['uid'] == $session['uid'] || $session['staff'] == 1 && $comment['uid'] != NULL) {
if ($uploader['uid'] == $session['uid'] || $session['staff'] == 1 && $comment['uid'] != NULL) {
    $remove_video = $conn->prepare("DELETE FROM comments WHERE cid = :cid");
    $remove_video->execute([
        ":cid" => $_POST['comment_id']
    ]);
echo("OK "); echo htmlspecialchars($_POST['comment_id']);
exit;
} else {
die("ERROR");
}
} else {
die("ERROR");
}
?>