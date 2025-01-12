<div style="padding: 0px 5px 0px 5px;">

<table cellspacing="0" cellpadding="5" border="0" align="center">
	<tbody><tr>
		<td><a href="subscription_center">Subscription Center</a></td>
		<td style="padding: 0px 5px 0px 5px;">|</td>
		<td class="bold">My Subscribers</td>
		</tr>
</tbody></table><br>

<div class="tableSubTitle">My Subscribers</div>

<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr valign="top">
		<td style="padding-right: 15px;">
		
		<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
			<tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td>
				
				<div class="watchTitleBar">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr valign="top">
							<td><div class="moduleTitle">My Subscribers</span></div></td>
 							<td align="right">
								<div style="font-weight: bold; color: #444; margin-right: 5px;">
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<?php $theoutput = array(); foreach($friends as $friend) {
				$q = $conn->prepare("SELECT * FROM videos WHERE uid = :id AND converted = 1 AND privacy = 1");
				$q->bindParam(':id' , $friend['uid'], PDO::PARAM_STR);
				$q->execute();
				$thecountervid = $q->rowCount();
				/*
				if($friend['sender'] == $profile['uid']){
				$frienduid = $friend['respondent'];
				} else {
				$frienduid = $friend['sender'];
				}
				*/
				
				$friend_latest_video = $conn->prepare(
				"SELECT * FROM videos
				LEFT JOIN users ON users.uid = videos.uid
				WHERE videos.uid = ? AND videos.converted = 1 AND videos.privacy = 1
				GROUP BY videos.vid
				ORDER BY videos.uploaded DESC LIMIT 1"
				);
				$friend_latest_video->execute([$friend['uid']]);
				
				if($friend_latest_video->rowCount() == 0) {
				$friend_latest_video = false;
				} else {
				$friend_latest_video = $friend_latest_video->fetch(PDO::FETCH_ASSOC);
				}
				if($friend_latest_video['privacy'] !== 1) {
				$friend_latest_video = false;
				}
				
				?>
               	 <?php if(!in_array($friend['uid'], $theoutput)) { ?>
                <div class="moduleEntry"> 
				<table width="565" cellpadding="0" cellspacing="0" border="0">
					<tr valign="top">
						<td align="center"><a href="">
						
<? if($friend_latest_video) { ?>
							<a href="watch.php?v=<?= htmlspecialchars($friend_latest_video['vid']) ?>"><img src="/get_still.php?video_id=<?= htmlspecialchars($friend_latest_video['vid']) ?>" class="moduleEntryThumb" width="120" height="90"></a>
							<div class="moduleFeaturedTitle"><a href="watch.php?v=<?= htmlspecialchars($friend_latest_video['vid']) ?>"><?= htmlspecialchars($friend_latest_video['title']) ?></a></div>
							
<? } ?>
					
					
					
						<td width="100%">
						<div class="moduleEntryTitle" style="margin-bottom: 5px;">

						<a href="/profile?user=<?= htmlspecialchars($friend['username']) ?>"><?= htmlspecialchars($friend['username']) ?></a>

						</div>
						<div class="moduleEntryDescription"><a href="profile_videos.php?user=<?= htmlspecialchars($friend['username']) ?>">Videos</a> (<?php echo getpublicvideos($friend['uid']); ?>) | <a href="profile_favorites.php?user=<?= htmlspecialchars($friend['username']) ?>">Favorites</a> (<?php echo getfavoritecount($friend['uid']); ?>) | <a href="profile_friends.php?user=<?= htmlspecialchars($friend['username']) ?>">Friends</a> (<?php echo getfriendcount($friend['uid']); ?>)</div>
						</td>
					</tr>
				</table>
				</div>
              	 <?php $theoutput[] = $friend['uid']; ?>
                <?php } ?>
								
				  <?php } ?>				
				</td>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>
		
		</td>

	</tr>
</table>