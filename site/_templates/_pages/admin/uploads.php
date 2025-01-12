	<table class="roundedTable" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#cccccc" align="left">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="100%">
				<div class="moduleTitleBar">
				<div class="moduleTitle">
			Flagged Videos
				</div>
				</div>
		
				
               
	             <?php foreach($flagged as $pick) { 
                    $q = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON users.uid = comments.uid WHERE vidon = :vid AND users.termination = 0 AND is_reply = 0 ORDER BY post_date DESC");
                   $q->bindParam(':vid', $pick['vid'], PDO::PARAM_STR);
                    $q->execute();
                    $comments = $q->rowCount();
                    ?>
                        <div class="moduleEntry<? if($pick['special'] == 1) {?>Selected<? } ?>">
					<table width="565" cellpadding="0" cellspacing="0" border="0">
						<tbody><tr valign="top">
							<td><a href="index.php?v=<?php echo htmlspecialchars($pick['vid']); ?>"><img src="/get_still.php?video_id=<?php echo htmlspecialchars($pick['vid']); ?>" class="moduleEntryThumb" width="120" height="90"></a></td>
							<td width="100%"><div class="moduleEntryTitle"><a href="index.php?v=<?php echo htmlspecialchars($pick['vid']); ?>"><?php echo htmlspecialchars($pick['title']); ?></a></div>
							<div class="moduleEntryDescription"><?php echo htmlspecialchars($pick['description']); ?></div>
							<div class="moduleEntryTags">
							Tags // <?php
						foreach(explode(" ", $pick['tags']) as $tag) {
							echo ' <a href="results.php?search='.htmlspecialchars($tag).'">'.htmlspecialchars($tag).'</a> :';
						}
						?> 							</div>
						<div class="moduleEntryTags">Channels // <? showChannels($pick['vid'], ' :'); ?></div>
							<div class="moduleEntryDetails">Added: <?php echo timeAgo($pick['uploaded']); ?> by <a href="profile.php?user=<?php echo htmlspecialchars($pick['username']); ?>"><?php echo htmlspecialchars($pick['username']); ?></a></div>
							<div class="moduleEntryDetails">Runtime: <?php echo gmdate("i:s", $pick['time']); ?> | Views: <?php echo number_format($pick['views']); ?> | Comments: <?php echo number_format($comments); ?></div>
                            <nobr>
			<? grabRatings($pick['vid'], "SM"); ?><br>
		<?php
$thehting = $conn->prepare("SELECT * FROM users WHERE uid = :who");
$thehting->bindParam(':who', $pick['who'], PDO::PARAM_STR);
$thehting->execute();
$userinfo = $thehting->fetch();
?>

			
			
			
			(reported by <a href="/profile?user=<?php echo $userinfo['username'] ?>"> <?php echo $userinfo['username'] ?></a> for <?php switch($pick['where']) { case "F": $reason = "Feature This!"; break; default: $reason = "Inappropriate"; } echo $reason; ?>)  (<a href="/admin/remove_video?video_id=<?php echo $pick['vid'] ?>">delete</a>) (feature) (resolve)
	</nobr>
							</td>
						</tr>
					</tbody></table>
					</div>
<?php } ?>
	       
					
									
				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</tbody></table>
	
	<table class="roundedTable" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#cccccc" align="left">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="100%">
				<div class="moduleTitleBar">
				<div class="moduleTitle"><div style="float: right; padding: 1px 5px 0px 0px; font-size: 12px;"><a href="/admin/allvideos.php">See More Videos</a></div>
				Recently Uploaded Videos
				</div>
				</div>
		
				
               
	             <?php foreach($lastupload as $pick) { 
                    $q = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON users.uid = comments.uid WHERE vidon = :vid AND users.termination = 0 AND is_reply = 0 ORDER BY post_date DESC");
                   $q->bindParam(':vid', $pick['vid'], PDO::PARAM_STR);
                    $q->execute();
                    $comments = $q->rowCount();
                    ?>
                        <div class="moduleEntry<? if($pick['special'] == 1) {?>Selected<? } ?>">
					<table width="565" cellpadding="0" cellspacing="0" border="0">
						<tbody><tr valign="top">
							<td><a href="index.php?v=<?php echo htmlspecialchars($pick['vid']); ?>"><img src="/get_still.php?video_id=<?php echo htmlspecialchars($pick['vid']); ?>" class="moduleEntryThumb" width="120" height="90"></a></td>
							<td width="100%"><div class="moduleEntryTitle"><a href="index.php?v=<?php echo htmlspecialchars($pick['vid']); ?>"><?php echo htmlspecialchars($pick['title']); ?></a></div>
							<div class="moduleEntryDescription"><?php echo htmlspecialchars($pick['description']); ?></div>
							<div class="moduleEntryTags">
							Tags // <?php
						foreach(explode(" ", $pick['tags']) as $tag) {
							echo ' <a href="results.php?search='.htmlspecialchars($tag).'">'.htmlspecialchars($tag).'</a> :';
						}
						?> 							</div>
						<div class="moduleEntryTags">Channels // <? showChannels($pick['vid'], ' :'); ?></div>
							<div class="moduleEntryDetails">Added: <?php echo timeAgo($pick['uploaded']); ?> by <a href="profile.php?user=<?php echo htmlspecialchars($pick['username']); ?>"><?php echo htmlspecialchars($pick['username']); ?></a></div>
							<div class="moduleEntryDetails">Runtime: <?php echo gmdate("i:s", $pick['time']); ?> | Views: <?php echo number_format($pick['views']); ?> | Comments: <?php echo number_format($comments); ?></div>
                            <nobr>
			<? grabRatings($pick['vid'], "SM"); ?>
	</nobr>
							</td>
						</tr>
					</tbody></table>
					</div>
<?php } ?>
					
									
				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</tbody></table>