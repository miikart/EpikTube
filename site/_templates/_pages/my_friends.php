<div style="padding-bottom: 15px;">
<table align="center" cellpadding="0" cellspacing="0" border="0">
	<tbody><tr>
	<td><strong>My Friends</strong></td>
        <td style="padding: 0px 5px 0px 5px;">|</td>
		<td><a href="my_friends_accept.php">My Friend Requests</a></td>
	</tr>
</tbody></table>
</div>

<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
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
							<td><div class="moduleTitle">My Friends</span></div></td>
 							<td align="right">
								<div style="font-weight: bold; color: #444; margin-right: 5px;">
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<?php $theoutput = array(); foreach($friends as $friend) {
				
				?>
               	 <?php if(!in_array($friend['uid'], $theoutput)) { ?>
                <div class="moduleEntry"> 
				<table width="565" cellpadding="0" cellspacing="0" border="0">
					<tr valign="top">
						<td align="center">
						<a href="profile?user=<?= htmlspecialchars($friend['username']) ?>"><img src="<?php echo getlatestvideo($friend['uid']); ?>" class="moduleEntryThumb" width="120" height="90"></a>
							                    <br>
				        <form method="post" action="my_friends?remove=<?= htmlspecialchars($friend['username']) ?>" style="margin: 0"><input type="submit" value="Remove from Friends" style="margin-right: 10px;margin-top:5px"></form>
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
	<td width="180">

		<table width="180" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFEEBB" align="center">
			<tbody><tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="170">
					<div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;"><a href="help.php">Share your videos with friends!</a></div>
				</td>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</tbody></table>

		
		</td>
	</tr>
</table>
