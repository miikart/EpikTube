<div style="color: #333; margin-bottom: 10px;">Related Tags:
		
		<?php $related_tags = array_unique($related_tags); ?>
		<?php foreach($related_tags as $tag) { ?>
		<a href="results.php?search=<?php echo htmlspecialchars($tag); ?>"><?php echo htmlspecialchars($tag); ?></a>,
		<?php } ?>	
		</div>
<div style="color: #333; margin-bottom: 10px; padding-top: 10px"><b>Sort by:</b>
Relevance - <a href="/results?search=&amp;sort=video_date_uploaded">Date Added</a> - <a href="/results?search=&amp;sort=title_sort">Title</a> - <a href="/results?search=&amp;sort=video_view_count">View Count</a> - <a href="/results?search=&amp;sort=rating_sort">Rating</a>	</div>
<table width="875" align="left">
	<tr>
		<td align="left" valign="top" width="740">

<table width="740" align="center"cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
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
				<td><div class="moduleTitle"><?php echo htmlspecialchars(trim($res_title)); ?> // <?php echo $real_search; ?></div></td>
						<td align="right">
						<? if($vidocount > 0) { ?><div style="font-weight: color: #444; margin-right: 5px;"><?php echo htmlspecialchars(trim($res_rlted)); ?> <b><?php if ($offs > 0) { echo htmlspecialchars(trim($offs)); } else { echo "1"; } ?>-<? if($vidocount > $ppv) { $nextynexty = $offs + $ppv; } else {$nextynexty = $vidocount; } echo htmlspecialchars($nextynexty); ?></b> of <b><?php                               echo $vidocount; ?></b> for '<b><?php echo $real_search; ?></b>'. (<b><?php echo(number_format(microtime(true) - $start_time, 2)); ?></b> seconds)</div><? } ?>
						</td>
		</tr>
	</table>
	</div>


			
	<?php foreach($videos as $video) { ?>
			
                <div class="moduleEntry"> 
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tbody><tr valign="top">
							<td>
							<table cellpadding="0" cellspacing="0" border="0">
								<tbody><tr>
									<td><a href="watch.php?v=<?php echo $video['vid']; ?>&search=<?php echo htmlspecialchars(urlencode($real_search)); ?>"><img src="get_still.php?video_id=<?php echo $video['vid']; ?>&still_id=1" class="moduleEntryThumb" width="100" height="75"></a></td>
									<td><a href="watch.php?v=<?php echo $video['vid']; ?>&search=<?php echo htmlspecialchars(urlencode($real_search)); ?>"><img src="get_still.php?video_id=<?php echo $video['vid']; ?>&still_id=2" class="moduleEntryThumb" width="100" height="75"></a></td>
									<td><a href="watch.php?v=<?php echo $video['vid']; ?>&search=<?php echo htmlspecialchars(urlencode($real_search)); ?>"><img src="get_still.php?video_id=<?php echo $video['vid']; ?>&still_id=3" class="moduleEntryThumb" width="100" height="75"></a></td>
								</tr>
							</table>
							
							</td>
							<td width="100%"><div class="moduleEntryTitle" style="word-break: break-all;"><a href="watch.php?v=<?php echo $video['vid']; ?>&search=<?php echo htmlspecialchars(urlencode($real_search)); ?>"><?php echo htmlspecialchars($video['title']); ?></a></div>
							<div class="moduleEntryDescription">
							<?php echo nl2br(htmlspecialchars($video['description'])); ?>    
							</div>
							<div class="moduleEntryTags">Tags // <?php foreach(explode(" ", $video['tags']) as $tag) echo '<a href="results.php?search='.htmlspecialchars($tag).'">'.htmlspecialchars($tag).'</a> : '; ?></div>
							<div class="moduleEntryDetails">Added: <?php echo retroDate($video['uploaded']); ?> by <a href="profile.php?user=<?php echo htmlspecialchars($video['username']); ?>"><?php echo htmlspecialchars($video['username']); ?></a></div>
							<div class="moduleEntryDetails">Channels // <? showChannels($video['vid']); ?>
							<div class="moduleEntryDetails">Runtime: <?php echo gmdate("i:s", $video['time']); ?> | Views: <?php echo $video['views']; ?> | Comments: <?php echo getcommentcount($video['vid']) ?></div>
								
	<nobr>
							</nobr>
		
							</td>
						</tr>
					</tbody></table>
				</div>
                <?php } ?> 
         
		<?php if($totalPages > 1) { ?>  
			     <!-- begin paging -->
			<div style="font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;">Result Page:
				
					<?php
  $maxButtons = 10;
$startPage = max(1, $page - floor(($maxButtons - 1) / 2));
$endPage = min($totalPages, $startPage + $maxButtons - 1);
if ($endPage - $startPage < $maxButtons - 1) {
    $startPage = max(1, $endPage - $maxButtons + 1);
}
if ($page > 1) { 
     echo '
     <a href="results.php?search=' . $real_search . '&page=' . $page-1 . '"> < Previous</a>';
}
for ($i = $startPage; $i <= $endPage; $i++) {
    if ($i == $page) {
        echo '
        <span style="color: #444; background-color: #FFFFFF; padding: 1px 4px 1px 4px; border: 1px solid #999; margin-right: 5px;">' . $i . '</span>';
    } else {
         echo '
         <span style="background-color: #CCC; padding: 1px 4px 1px 4px; border: 1px solid #999; margin-right: 5px;"><a href="results.php?search=' . $real_search . '&page=' . $i . '">' . $i . '</a></span>';
    }
}
if ($page < $totalPages) { 
  echo '
  <a href="results.php?search=' . $real_search . '&page=' . $page+1 . '">Next ></a>';     
} 
    ?>

</div>

				<!-- end paging -->
	<?php } ?>	




		</td>
		<td align=right><img src="img/pixel.gif" width="5" height="1"></td>
		
	</tr>
	<tr>
		<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
		<td><img src="img/pixel.gif" width="1" height="5"></td>
		<td><img src="img/box_login_br.gif" width="5" height="5"></td>
	</tr>


</table>
<?php
if(empty($videos) || $vidocount == 0) {
?>
	<br>
	<div class="moduleTitle">
		Found no videos matching <?php echo $real_search; ?>. Do you have one? <a href="my_videos_upload.php">Upload</a> it!
	</div><?php
}
?>

		</td>

		<td width="120"  valign="top" style="padding-left: 12px;">
<?php if(!isset($_SESSION['uid'])) { ?>
<a href="/signup"><img src="img/upload_banner.jpg" border="0"></a>
<?php } ?>
</td>
	</tr>
</table>