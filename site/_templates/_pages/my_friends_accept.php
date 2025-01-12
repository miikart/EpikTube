<table align="center" cellpadding="0" cellspacing="0" border="0">
	<tbody><tr>
	<td><a href="my_friends.php">My Friends</a></td>
        <td style="padding: 0px 5px 0px 5px;">|</td>
		<td><strong>My Friend Requests</strong></td>
     
        
	</tr>
</tbody></table><p>
<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tbody><tr valign="top">
		<td style="padding-right: 15px;">

		<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td>
				
				<div class="watchTitleBar">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tbody><tr valign="top">
							<td><div class="moduleTitle">My Friend Requests</div></td>
 							<td align="right"> 
								<div style="font-weight: bold; color: #444; margin-right: 5px;">
								</div>
							</td>
						</tr>
					</tbody></table>
				</div>

	<? foreach($friends as $friend) { 
    $profile_latest_video = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ? AND videos.converted = 1
	GROUP BY videos.vid
	ORDER BY videos.uploaded DESC LIMIT 1"
    );
    $profile_latest_video->execute([$friend['uid']]); ?>				
				<div class="moduleEntry">
				<table width="565" cellpadding="0" cellspacing="0" border="0">
					<tbody><tr valign="top">
						<? if($profile_latest_video->rowCount() > 0) { $profile_latest_video = $profile_latest_video->fetch(PDO::FETCH_ASSOC); ?>	<td align="center"><a href="">
						
							</a><a href="watch.php?v=<? echo htmlspecialchars($profile_latest_video['vid']); ?>"><img src="/get_still.php?video_id=<? echo htmlspecialchars($profile_latest_video['vid']); ?>" class="moduleEntryThumb" width="120" height="90"></a>
							<div class="moduleFeaturedTitle"><a href="watch.php?v=<? echo htmlspecialchars($profile_latest_video['vid']); ?>"><? echo htmlspecialchars($profile_latest_video['title']); ?></a></div>
							
						</td><? } ?><td width="100%">
						<div class="moduleEntryTitle" style="margin-bottom: 5px;">

						<a href="profile.php?user=<? echo htmlspecialchars($friend['username']); ?>"><? echo htmlspecialchars($friend['username']); ?></a>

						</div>
                        <strong>Do you want to share private videos with this person?</strong><p>
						<form method="post" style="display:inline;">
				        <a href="my_friends_accept.php?user=<? echo htmlspecialchars($friend['username']); ?>">Accept</a> or <a href="my_friends_decline.php?user=<? echo htmlspecialchars($friend['username']); ?>">Decline</a>?
						<div class="moduleEntryDetails"></div>
						<div class="moduleEntryDetails"></div>
						</td>
					</tr>
				</tbody></table>
				</div>
                <? } ?>
		
						
				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</tbody></table>
		
		</td>
		<td width="180">
		</td>
	</tr>
</tbody></table>