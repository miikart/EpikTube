<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td width="100%">
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
					<tr valign="top">
				<div class="moduleTitle"><? if($vidocount > 0) { ?><div style="float: right; padding: 1px 5px 0px 0px; font-size: 12px;">Videos <?php if ($offs > 0) { echo htmlspecialchars(trim($offs)); } else { echo "1"; } ?>-<? if($vidocount > $ppv) { $nextynexty = $offs + $ppv; } else {$nextynexty = $vidocount; } echo htmlspecialchars($nextynexty); ?> of <?php echo $vidocount; ?></div><? } ?>
                My Favorites</div>
				</div>
		
					</tr>
				</table>
				</div>
				
				<?php if($videos !== false) { ?>
			<?php foreach($videos as $video) { 
        $related_tags = array_merge($related_tags, explode(" ", $video['tags']));
        ?>
					<div class="moduleEntry"> 
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr valign="top">
						<td>
							<a href="watch?v=<?php echo htmlspecialchars($video['vid']); ?>"><img src="/get_still?video_id=<?php echo htmlspecialchars($video['vid']); ?>" class="moduleEntryThumb" width="120" height="90"></a><p>
							<table width="130" cellpadding="0" cellspacing="0" border="0" class="tableFavRemove">
								<tr align="center">
									<td width="100%">
										<form method="get" action="remove_favorites.php" onsubmit="return confirm('Do you want to remove this video from your favorites?');">
											<input type="hidden" value="<?php echo htmlspecialchars($video['vid']); ?>" name="video_id">
											<input type="submit" value="Remove Favorite">
										</form>
									</td>
								</tr>
							</table>
						</td>
						<td width="100%"><div class="moduleEntryTitle"><a href="index.php?v=<?php echo htmlspecialchars($video['vid']); ?>"><?php echo htmlspecialchars($video['title']); ?></a></div>
							<div class="moduleEntryDescription"><?php echo htmlspecialchars($video['description']); ?></div>
							<div class="moduleEntryTags">
							Tags // <?php
						foreach(explode(" ", $video['tags']) as $tag) {
							echo ' <a href="results.php?search='.htmlspecialchars($tag).'">'.htmlspecialchars($tag).'</a> :';
						}
						?> 							</div>
                            <div class="moduleEntryDetails">Recorded: <?php if ($video['recorddate'] !== null) { echo $video['recorddate']; } else { echo "---"; } ?> | Location: <?php if ($video['address'] !== null && $video['address'] !== "") { echo htmlspecialchars($video['address']); } ?> <?php if ($video['addrcountry'] !== null && $video['addrcountry'] !== "---") { echo htmlspecialchars($video['addrcountry']); } ?><?php if (($video['address'] === null || $video['address'] === "") && ($video['addrcountry'] === null || $video['addrcountry'] === "---")) { echo "---"; } ?></div>
							<div class="moduleEntryDetails">Added: <?php echo retroDate($video['uploaded']); ?> by <a href="profile.php?user=<?php echo htmlspecialchars($video['username']); ?>"><?php echo htmlspecialchars($video['username']); ?></a></div>
							<div class="moduleEntryDetails">Runtime: <?php echo gmdate("i:s", $video['time']); ?> | Views: <?php echo $video['views']; ?> | Comments: <?php echo getcommentcount($video['vid']) ?>
		                    <?php if (getRatingCount($video['vid']) > 0) {  ?>
                            <div class="moduleEntryDetails"><? echo "<br>Rating:"; grabRatings($video['vid'], "SM"); ?></div>
                            <?php } ?>
		                    </div>
							</td>
						</tr>
					</tbody></table>
					</div><? } } ?>
                    <!-- begin paging -->
<?php if($vidocount > $ppv) { ?>
<div style="font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;">My Videos Page:
<?php   $maxButtons = 10;
$startPage = max(1, $page - floor(($maxButtons - 1) / 2));
$endPage = min($totalPages, $startPage + $maxButtons - 1);
if ($endPage - $startPage < $maxButtons - 1) {
    $startPage = max(1, $endPage - $maxButtons + 1);
}
if ($page > 1) { 
     echo '
     <a href="my_favorites?page='. $page-1 .'"> < Previous</a>';
}
for ($i = $startPage; $i <= $endPage; $i++) {
    if ($i == $page) {
        echo '
        <span style="color: #444; background-color: #FFFFFF; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;">' . $i . '</span>';
    } else {
        echo '
        <span style="background-color: #CCC; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;"><a href="my_favorites?page='. $i .'">' . $i . '</a></span>';
    }
}
    
   if ($page < $totalPages) { 
  echo '
  <a href="my_favorites?user=' . $profile['username'] . '&page='. $page+1 .'">Next ></a>';     
}   ?>
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
		
		<td width="15"><img src="img/pixel.gif" width="15" height="1"></td>
		<td width="160">
		<div style="font-weight: bold; margin-bottom: 3px; width: 160px;">Favorite Tags:</div>
			<?php $related_tags = array_unique($related_tags); ?>
			<?php foreach($related_tags as $tag) { ?>
			<div style="padding: 0px 0px 5px 0px; color: #999;">&#187; <a href="results.php?search=<?php echo htmlspecialchars($tag); ?>"><?php echo htmlspecialchars($tag); ?></a></div>
			<?php } ?>
		</td>
		
	</tr>
</table>