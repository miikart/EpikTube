<?php 
require_once "needed/scripts.php";
$playlistingcount = $conn->prepare(
	"SELECT * FROM playlists
	LEFT JOIN users ON users.uid = playlists.uid
	WHERE playlists.uid = ? AND playlists.action = 'create' ORDER BY playlists.created_at DESC"
);
$playlistingcount->execute([$profile['uid']]);
$playlistingcount = $playlistingcount->rowCount();
$commentingcount = $conn->prepare("SELECT cc.*, u.* 
    FROM channelcomments cc
    JOIN users u ON cc.uid = u.uid
    WHERE cc.uuid = :id AND u.termination = 0
    ORDER BY cc.time DESC");
$commentingcount->bindParam(':id', $profile['uid'], PDO::PARAM_STR);
$commentingcount->execute();
$commentingcount = $commentingcount->rowcount();
$bulletiningcount = $conn->prepare("SELECT DISTINCT b.*, u.*
FROM bulletins b
JOIN users u ON b.uid = u.uid
LEFT JOIN relationships r ON (r.sender = :uid AND r.respondent = b.uid) 
    OR (r.respondent = :uid AND r.sender = b.uid)
WHERE (b.uid = :uid OR r.sender = :uid OR r.respondent = :uid)
AND u.termination = 0
AND (b.uid = :uid OR r.accepted = 1)
ORDER BY b.posted DESC");
$bulletiningcount->bindParam(":uid", $profile['uid']);
$bulletiningcount->execute();
$bulletiningcount = $bulletiningcount->rowCount();
if($profile['closure'] == 1) { $term_text = 'This user account is closed.'; } else { $term_text = 'This user account is suspended.'; } if($profile['termination'] == 1) { session_error_index($term_text, "error"); } else { ?>
<tr>
	<td>
    <?php if ($current_page == 'profile') { ?>
        <strong>Profile</strong>
    <?php } else { ?>
        <a href="profile?user=<?php echo htmlspecialchars($profile['username']); ?>">Profile</a>
    <?php } ?>
</td>
<td style="padding: 0px 5px 0px 5px;">|</td>
<td>
    <?php if ($current_page == 'profile_videos') { ?>
        <strong>Videos</strong>
    <?php } else { ?>
        <a href="profile_videos?user=<?php echo htmlspecialchars($profile['username']); ?>">Videos</a>
    <?php } ?>
(<?php echo getpublicvideos($profile['uid']); ?>)
</td>
<td style="padding: 0px 5px 0px 5px;">|</td>
<td>
    <?php if ($current_page == 'profile_favorites') { ?>
        <strong>Favorites</strong>
    <?php } else { ?>
        <a href="profile_favorites?user=<?php echo htmlspecialchars($profile['username']); ?>">Favorites</a>
    <?php } ?>
(<?php echo getfavoritecount($profile['uid']); ?>)
</td>
<td style="padding: 0px 5px 0px 5px;">|</td>
<td>
    <?php if ($current_page == 'profile_friends') { ?>
        <strong>Friends</strong> 
    <?php } else { ?>
        <a href="profile_friends?user=<?php echo htmlspecialchars($profile['username']); ?>">Friends</a>
    <?php } ?>
(<?php echo getfriendcount($profile['uid']); ?>)
</td>
<td style="padding: 0px 5px 0px 5px;">|</td>
<td>
    <?php if ($current_page == 'profile_play_list') { ?>
        <strong>Playlists</strong>
    <?php } else { ?>
        <a href="profile_play_list?user=<?php echo htmlspecialchars($profile['username']); ?>">Playlists</a>
    <?php } ?>
(<?php echo number_format($playlistingcount); ?>)
</td>
<td style="padding: 0px 5px 0px 5px;">|</td>
<td>
        <a href="profile_groups?user=<?php echo htmlspecialchars($profile['username']); ?>">Groups</a>
(0)
</td>
<td style="padding: 0px 5px 0px 5px;">|</td>
<td>
    <?php if ($current_page == 'bulletin_all') { ?>
        <strong>Bulletins</strong> 
    <?php } else { ?>
        <a href="bulletin_all?user=<?php echo htmlspecialchars($profile['username']); ?>">Bulletins</a> 
    <?php } ?>
(<?php echo number_format($bulletiningcount); ?>)
</td>
<td style="padding: 0px 5px 0px 5px;">|</td>
<td>
    <?php if ($current_page == 'profile_comments') { ?>
        <strong>Comments</strong>
    <?php } else { ?>
        <a href="profile_comments?user=<?php echo htmlspecialchars($profile['username']); ?>">Comments</a>
    <?php } ?>
(<?php echo number_format($commentingcount); ?>)
</td>
</tr>
<?php } ?>