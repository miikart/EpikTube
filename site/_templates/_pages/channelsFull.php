<table width="875" align="center">
<tr>
<td align="center" valign="top" width="740">	
	<table width="740" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
		<tr>
			<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
			<td><img src="img/pixel.gif" width="1" height="5"></td>
			<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
		</tr>
		<tr>
			<td><img src="img/pixel.gif" width="5" height="1"></td>
			<td width="730">
			<div class="moduleTitleBar">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr valign="top">
						<td width="100%">
	
							<div class="moduleTitle">
									<a href="channels">All Channels</a>&nbsp;&gt;&nbsp;<?php echo htmlspecialchars($channel['name']) ?>
							</div>
						</td>
					</tr>
				</table>
			</div>
		 <?php if($videoc != 0) { ?>
		<div class="moduleFeatured"> 
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tbody>
			
				
				<?php $i = 0; foreach($videos as $video) { $i = $i + 1; if($i == 1) { echo '<tr valign="top">'; } ?>
     
			<td width="20%" align="center"><a href="watch.php?v=<?php echo $video['vid']; ?>"><img src="/get_still.php?video_id=<?php echo $video['vid']; ?>" width="120" height="90" class="moduleFeaturedThumb"></a><div class="moduleFeaturedTitle"><a href="watch.php?v=<?php echo $video['vid']; ?>" ><?php echo htmlspecialchars($video['title']); ?></a></div><div class="moduleFeaturedDetails">Added: <?php echo timeAgo($video['uploaded']); ?><br>by <a href="profile.php?user=<?php echo htmlspecialchars($video['username']); ?>"><?php echo htmlspecialchars($video['username']); ?></a></div><div class="moduleFeaturedDetails" style="padding-bottom: 5px;">Runtime: <?php echo gmdate("i:s", $video['time']); ?><br>Views: <?php echo number_format($video['views']); ?> | Comments: <?php echo getcommentcount($video['vid']) ?></div><? grabRatings($video['vid'], "SM", 0); ?></td><? if($i == 5) { echo '</tr>'; $i = 0; } } ?>
		

			  	</tbody></table>
		</div>
					   <?php } ?>    
		
						<?php if($totalPages > 1) { ?>  
			     <!-- begin paging -->
			<div style="font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;">Browse Pages:
				
<?php
$maxButtons = 10;
$startPage = max(1, $page - floor(($maxButtons - 1) / 2));
$endPage = min($totalPages, $startPage + $maxButtons - 1);
if ($endPage - $startPage < $maxButtons - 1) {
    $startPage = max(1, $endPage - $maxButtons + 1);
}

for ($i = $startPage; $i <= $endPage; $i++) {
    if ($i == $page) {
        echo '
        <span style="color: #444; background-color: #FFFFFF; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;">' . $i . '</span>';
    } else {
        echo '
        <span style="background-color: #CCC; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;"><a href="channels.php?page=' . $i . '&c=' . $channel['id'] . '">' . $i . '</a></span>';
    }
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


		</div>
		</td>
<td style="padding-left: 12px;" width="120" valign="top">
 <?php if(!isset($_SESSION['uid'])) { ?>
<a href="/signup"><img src="img/upload_banner.jpg" border="0"></a>
<?php } ?>
</td>
	</tr>
</table>