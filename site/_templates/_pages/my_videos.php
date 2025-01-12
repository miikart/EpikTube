<script>
function mpfpHandler()
{
	var mpfp_button = document.sfp.mpfp_button;

	mpfp_button.disabled='true';
	mpfp_button.value='Done!';

	return true;
}
function RemovalHandler()
{
	var remove_vid_button = document.remove_vid.remove_vid_button;

	remove_vid_button.disabled='true';
	remove_vid_button.value='Done!';

	return true;
}

function showRealCount(num) {
    document.getElementById('fans_video' + num).style.display = '';
    document.getElementById('fan_count_video' + num).style.display = 'none';
}
</script>
<table align="center" cellpadding="0" cellspacing="0" border="0">
	<tbody><tr>
		<td><strong>Overview</strong></td>
		<td style="padding: 0px 5px 0px 5px;">|</td>
		<td><a href="sharing.php">Share</a></td>
        <td style="padding: 0px 5px 0px 5px;">|</td>
        <td><a href="my_videos_upload.php">Upload</a></td>
	</tr>
</tbody></table><p>
		

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
				<div class="moduleTitle"><? if($vidocount > 0) { ?><div style="float: right; padding: 1px 5px 0px 0px; font-size: 12px;">Videos <?php if ($offs > 0) { echo htmlspecialchars(trim($offs)); } else { echo "1"; } ?>-<? if($vidocount > $ppv) { $nextynexty = $offs + $ppv; } else {$nextynexty = $vidocount; } echo htmlspecialchars($nextynexty); ?> of <?php echo number_format($vidocount); ?></div><? } ?>
                My Videos</div>
				</div>
		
					</tr>
				</table>
				</div>
				
				<?php if($videos !== false) { ?>
			<?php $count = 0; foreach($videos->fetchAll(PDO::FETCH_ASSOC) as $video) { $related_tags = array_merge($related_tags, explode(" ", $video['tags']));  $count++; ?>
					<div class="moduleEntry"> 
				<table cellpadding="0" cellspacing="0" border="0">
					<tr valign="top">
						<td>
							<a href="watch.php?v=<?php echo htmlspecialchars($video['vid']); ?>"><img src="/get_still.php?video_id=<?php echo htmlspecialchars($video['vid']); ?>" class="moduleEntryThumb" width="120" height="90"></a>
							<table width="130" cellpadding="0" cellspacing="0" border="0">
								<tr align="center">
									<td width="100%">
										<br><? if ($video['rejected'] == 0) { ?><form method="get" action="my_videos_edit.php">
											<input type="hidden" value="<?php echo $video['vid']; ?>" name="video_id">
											<input type="submit" value="Edit Video">
										</form>
									
										<form method="get" action="remove_video.php" name="remove_vid" onsubmit="RemovalHandler();">
											<input type="hidden" value="<?php echo $video['vid']; ?>" name="video_id">
											<input type="submit" name="remove_vid_button" value="Remove Video">
										</form>
									<form method="post" id="sfp" name="sfp" onsubmit="return mpfpHandler();">
											<input type="hidden" value="<?php echo $video['vid']; ?>" name="selected_avatar">
											<input type="submit" value="Make Profile Icon" id="mpfp_button" name="mpfp_button">
										</form>
										<? } ?>
								
									</td>
								</tr>
							</table>
						</td>
						<td width="100%"><div class="moduleEntryTitle"><a href="index.php?v=<?php echo htmlspecialchars($video['vid']); ?>"><?php echo htmlspecialchars($video['title']); ?></a></div>
							<div class="moduleEntryDescription"><?php echo htmlspecialchars($video['description']); ?></div>
							<div class="moduleEntryTags">
							Tags // <?php echo htmlspecialchars($video['tags']); ?> 							</div>
                            <div class="moduleEntryDetails">Recorded: <?php if ($video['recorddate'] !== null) { echo $video['recorddate']; } else { echo "---"; } ?> | Location: <?php if ($video['address'] !== null && $video['address'] !== "") { echo htmlspecialchars($video['address']); } ?> <?php if ($video['addrcountry'] !== null && $video['addrcountry'] !== "---") { echo htmlspecialchars($video['addrcountry']); } ?><?php if (($video['address'] === null || $video['address'] === "") && ($video['addrcountry'] === null || $video['addrcountry'] === "---")) { echo "---"; } ?></div>
							<div class="moduleEntryDetails">Added: <?php echo retroDate($video['uploaded']); ?></div>
							<div class="moduleEntryDetails">Runtime: <?php echo gmdate("i:s", $video['time']); ?> | Views: <?php echo $video['views']; ?> | Comments: <?php echo getcommentcount($video['vid']); ?><span id="fan_count_video<?php echo $count ?>"> | Fans: <?php if(getvidfavcount($video['vid']) > 0) { ?><a href="javascript:void(0);" onclick="showRealCount(<?php echo $count ?>);"><?php } ?><?php echo getvidfavcount($video['vid']) ?><?php if(getvidfavcount($video['vid']) > 0) { ?></a><?php } ?></span><?php if(getvidfavcount($video['vid']) > 0) { ?><div class="moduleEntryDetails" id="fans_video<?php echo $count ?>" style="display: none";><strong>Your Fans</strong>: <?php echo getfavoriting($video['vid']) ?></div><?php } ?><?php if (getRatingCount($video['vid']) > 0) {  ?><div class="moduleEntryDetails"><? echo "<br>Rating:"; grabRatings($video['vid'], "SM"); ?></div><?php } ?></div>
                            <hr style="border: 0; border-bottom: 1px dashed #999999; margin: 1em 0;">
							<div class="moduleEntryDetails">File: <?php echo (!empty($video['file'])) ? htmlspecialchars($video['file']) : "undefined"; ?></div>
                            <div class="moduleEntryDetails">Broadcast: <?php echo ($video['privacy'] == 1) ? '<span style="color: #3e7335; font-weight: bold;">Public Video</span>' : '<span style="color: #d72d11; font-weight: bold;">Private Video</span>'; ?> <? if ($video['rejected'] > 0) { echo "| <strong>Rejected</strong> (<small>".$rejection_reasons[$video['reason']]."</small>)"; } ?></div>
							<div class="moduleEntryDetails">Status: <?php echo ($video['converted'] == 1) ? "Live!" : "Processing..."; ?><?php if($video['agerestrict'] == 1) { echo ", Age Restricted"; } ?></div>
						
								<form name="linkForm_<?php echo htmlspecialchars($video['vid']); ?>" id="linkForm_<?php echo htmlspecialchars($video['vid']); ?>">
									<input name="video_link" type="text" onClick="document.linkForm_<?php echo htmlspecialchars($video['vid']); ?>.video_link.focus();document.linkForm_<?php echo htmlspecialchars($video['vid']); ?>.video_link.select();" value="http://www.epiktube.xyz/?v=<?php echo htmlspecialchars($video['vid']); ?>" size="50" readonly="true" style="font-size: 10px; text-align: center;">
									<div class="moduleEntryDetails">Share this video with friends! Copy and paste this link above to an email or website.
	</div>			</form>
							</td>
						</tr>
					</tbody></table>
					</div><?  } } ?>

              	<?php if($totalPages > 1) { ?>  
			     <!-- begin paging -->
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
     <a href="my_videos?page='. $page-1 .'">< Previous</a>&nbsp;';
}
for ($i = $startPage; $i <= $endPage; $i++) {
    if ($i == $page) {
        echo '
        <span style="color: #444; background-color: #FFFFFF; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;">' . $i . '</span>';
    } else {
        echo '
        <span style="background-color: #CCC; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;"><a href="my_videos?page=' . $i . '">' . $i . '</a></span>';
    }
}
     if ($page < $totalPages) { 
  echo '
  &nbsp;<a href="my_videos?page='. $page+1 .'">Next ></a>';     
} 
    ?>

</div>

				<!-- end paging -->
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
		
		<td width="15"><img src="img/pixel.gif" width="15" height="1"></td>
		<td width="160">
        <table width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFEEBB">
			<tbody><tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="170">
		
				                <div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;"><a href="my_friends.php">Share your videos with friends!</a></div>
                				
								
				</td>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</tbody></table><br>
		<div style="font-weight: bold; margin-bottom: 3px; width: 160px;">My Tags:</div>
			<?php $related_tags = array_unique($related_tags); ?>
			<?php foreach($related_tags as $tag) { ?>
			<div style="padding: 0px 0px 5px 0px; color: #999;">&#187; <a href="results.php?search=<?php echo htmlspecialchars($tag); ?>"><?php echo htmlspecialchars($tag); ?></a></div>
			<?php } ?>
		</td>
		
	</tr>
</table>