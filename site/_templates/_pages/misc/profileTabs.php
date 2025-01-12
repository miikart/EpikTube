<table align="center" cellpadding="0" cellspacing="0" border="0">
<?php require_once("profileLinks.php"); ?>
</table><p>
<? if($collectmypages > 0) { ?>
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
				<div class="moduleTitleBar">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tbody><tr valign="top">
						<td><div class="moduleTitle" style="text-transform: capitalize;"><?php if($current_page == "profile_videos") { echo "Public Videos"; } elseif($current_page == "profile_friends") { echo "Friends"; } elseif($current_page == "profile_play_list") { echo "Playlists"; } else { echo "Favorites"; } ?> // <?php echo htmlspecialchars($profile['username']) ?></div></td>
						<td align="right">
						<? if($collectmypages > 0 && $current_page != "profile_friends" && $current_page != "profile_play_list") { ?><div style="font-weight: color: #444; margin-right: 5px;"><b>Videos <?php if ($offs > 0) { echo htmlspecialchars(trim($offs)); } else { echo "1"; } ?>-<? if($collectmypages > $ppv) { $nextynexty = $offs + $ppv; } else {$nextynexty = $collectmypages; } echo htmlspecialchars($nextynexty); ?> of <?php                               echo $collectmypages; ?></b></div><? } ?>
						</td>
					</tr>
				</tbody></table>
				</div>
				<?php foreach($videos as $video) { ?>
				<?php
			     if($current_page == "profile_videos" || $current_page == "profile_favorites") {
			     $related_tags = array_merge($related_tags, explode(" ", $video['tags']));
			     }
				?>
                <div class="moduleEntry"> 
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tbody><tr valign="top">
							<?php if($current_page != "profile_play_list") { ?>
							<td>
							<table cellpadding="0" cellspacing="0" border="0">
								<tbody><tr>
									<td><?php if($current_page != "profile_friends") { ?><a href="watch?v=<?php echo $video['vid']; ?>&search=<? echo htmlspecialchars($profile['username']); ?>"><img src="/get_still?video_id=<?php echo $video['vid']; ?>" class="moduleEntryThumb"  width="120" height="90"></a><?php } else { ?><a href="profile?user=<?= htmlspecialchars($video['username']) ?>"><img src="<?php echo getlatestvideo($video['uid']); ?>" class="moduleEntryThumb" width="90" height="70"></a><?php } ?></td>
								
								</tr>
							</table>
							</td>
							<?php } ?>
							<?php if($current_page != "profile_friends" && $current_page != "profile_play_list") { ?>
							<td width="100%"><div class="moduleEntryTitle" style="word-break: break-all;"><a href="watch?v=<?php echo $video['vid']; ?>"><?php echo htmlspecialchars($video['title']); ?></a></div>
							<div class="moduleEntryDescription"><?php echo nl2br(htmlspecialchars($video['description'])); ?></div>
							<div class="moduleEntryTags">Tags // <?php $tags = explode(" ", $video['tags']); $tagCount = count($tags); foreach ($tags as $index => $tag) { echo '<a href="results?search=' . htmlspecialchars($tag) . '">' . htmlspecialchars($tag) . '</a>'; if ($index < $tagCount - 1) { echo ' : '; } } ?></div>
							<div class="moduleEntryDetails">Added: <?php echo retroDate($video['uploaded']); ?> by <a href="profile.php?user=<?php echo htmlspecialchars($video['username']); ?>"><?php echo htmlspecialchars($video['username']); ?></a></div>
							<div class="moduleEntryDetails">Runtime: <?php echo gmdate("i:s", $video['time']); ?> | Views: <?php echo $video['views']; ?> | Comments: <?php echo getcommentcount($video['vid']) ?></div>
                            <?php if (getRatingCount($video['vid']) > 0) {  ?>
                            <div class="moduleEntryDetails"><? echo "Rating:"; grabRatings($video['vid'], "SM"); ?></div>
                            <?php } ?>
		                    </div>
	                        </td> 
							<?php } elseif($current_page == "profile_play_list") { ?>
						 
						   <div class="moduleEntryTitle" style="margin-bottom: 5px;"><b>Playlist Name:</b> <a href="/view_play_list?p=<?php echo ($video['pid']); ?>"><?php echo htmlspecialchars($video['title']); ?></a>

						    </div>
						    <div class="moduleEntryDescription"><?php echo htmlspecialchars($video['description']); ?></div>
						    <div class="moduleEntryDetails">Videos in Playlist: <?php echo videosinplaylist($video['pid']) ?></div>
							<?php } elseif($current_page == "profile_friends") { ?>
						<td width="100%">
						<div class="moduleEntryTitle" style="margin-bottom: 5px;">

						<a href="/profile?user=<?= htmlspecialchars($video['username']) ?>"><?= htmlspecialchars($video['username']) ?></a>

						</div>
						<div class="moduleEntryDescription"><a href="profile_videos.php?user=<?= htmlspecialchars($video['username']) ?>">Videos</a> (<?php echo getpublicvideos($video['uid']) ?>) | <a href="profile_favorites.php?user=<?= htmlspecialchars($video['username']) ?>">Favorites</a> (<?php echo getfavoritecount($video['uid']) ?>) | <a href="profile_friends.php?user=<?= htmlspecialchars($video['username']) ?>">Friends</a> (<?php echo getfriendcount($video['uid']) ?>)</div>
						</td>
							<?php } ?>
							</td>
							</td>
						</tr>
					</tbody></table>
				</div>
                <?php } ?> <!-- begin paging -->
<?php if($totalPages > 1 && $current_page == "profile_videos" || $totalPages > 1 && $current_page == "profile_favorites" || $totalPages > 1 && $current_page == "profile_friends") { ?>
<div style="font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;">My Videos Page:

   			<?php
    $maxButtons = 10;
$startPage = max(1, $page - floor(($maxButtons - 1) / 2));
$endPage = min($totalPages, $startPage + $maxButtons - 1);
if ($endPage - $startPage < $maxButtons - 1) {
    $startPage = max(1, $endPage - $maxButtons + 1);
}
if ($page > 1) { 
     echo '
     <a href="' . $current_page . '?user=' . $profile['username'] . '&page='. $page-1 .'"> < Previous</a>';
}
for ($i = $startPage; $i <= $endPage; $i++) {
    if ($i == $page) {
        echo '
        <span style="color: #444; background-color: #FFFFFF; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;">' . $i . '</span>';
    } else {
        echo '
        <span style="background-color: #CCC; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;"><a href="' . $current_page . '?user=' . $profile['username'] . '&page='. $i .'">' . $i . '</a></span>';
    }
}
    
   if ($page < $totalPages) { 
  echo '
  <a href="' . $current_page . '?user=' . $profile['username'] . '&page='. $page+1 .'">Next ></a>';     
}  
    ?>

</div>
<?php } ?>
				<!-- end paging -->

								
								
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
		<?php if($current_page == "profile_videos") { ?>
		<table class="roundedTable" width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffeebb">
			<tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="170">
											<div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;">
							<a href="/my_friends_invite">Share your videos with friends!</a>
						</div>

				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td valign="bottom"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td valign="bottom"><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>
		<?php } ?>
		<?php if($current_page == "profile_videos") { ?>
		<a href="http://www.epiktube.xyz/rss/user/<? echo htmlspecialchars($profile['username']); ?>/videos.rss"><img src="img/rss.gif" width="36" height="14" border="0" style="vertical-align: text-top;"></a> 
		<span style="font-size: 11px; margin-right: 3px;"><a href="http://www.epiktube.xyz/rss/user/<? echo htmlspecialchars($profile['username']); ?>/videos.rss">Feed For User // <? echo htmlspecialchars($profile['username']); ?></a></span>
		<?php $related_tags = array_unique($related_tags); ?>
		<?php } ?>
		<?php if($current_page == "profile_videos" || $current_page == "profile_favorites") { ?>
		<div style="font-weight: bold; color: #333; margin: 10px 0px 5px 0px;"><?php if($current_page == "profile_videos") { echo "Recent"; } else { echo "Favorite"; } ?> Tags:</div>
		<?php foreach($related_tags as $tag) { ?>
		<div style="padding: 0px 0px 5px 0px; color: #999;">&#187; <a href="results?search=<?php echo htmlspecialchars($tag); ?>"><?php echo htmlspecialchars($tag); ?></a></div>
		<?php } ?>
		<?php } ?>
		</td>
		
	</tr>
</table>
<? } else { ?>
<? alert('This user has no ' . htmlspecialchars($_GET['type']) . '   at this time!', "profileerr", false, true); } ?>