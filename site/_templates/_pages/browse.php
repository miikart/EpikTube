<table width="875" align="left">
<tr>
<td align="left" valign="top" width="740">
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
				<tbody><tr valign="top">
					<td width="260">
						<div class="moduleTitle">
							<?php
				switch($browse_sort) {
					case 'mp':
						echo "Most Viewed";
						break;
					case 'md':
						echo "Most Discussed";
						break;
					case 'mf':
						echo "Top Favorites";
						break;
					case 'r':
						echo "Random";
						break;
				    case 'rf':
						echo "Recently Featured";
						break;
                    case 'tr':
						echo "Top Rated";
						break;
					default:
						echo "Most Recent";
				}
				?>						
				<?php
				switch($browse_sort) {
					case 'mp':
						$thelink = "Views";
						break;
					case 'md':
						$thelink = "Discussed";
						break;
					case 'mf':
						$thelink = "Favorites";
						break;
					case 'r':
						$thelink = "Random";
						break;
				    case 'rf':
						$thelink = "Featured";
						break;
                    case 'tr':
						$thelink = "TopRated";
						break;
					default:
						$thelink = "Recent";
				}
				?>
				</div>
					</td>
				<td width="300" align="center">
						<div style="font-weight: normal; font-size: 11px; color: #444444">
                        <?php 
                if($browse_sort !== "mr" && $browse_sort !== "r"  && $browse_sort !== "rf" && $browse_sort !== "tr" && $browse_sort != "mf") { ?>
			
						<?php echo ($time == "t") ? '<strong>Today</strong>' : '<a href="browse?s='.$browse_sort.'&t=t">Today</a>'; ?>
						|
						<?php echo ($time == "w") ? '<strong>This Week</strong>' : '<a href="browse?s='.$browse_sort.'&t=w">This Week</a>'; ?>
						|
						<?php echo ($time == "m") ? '<strong>This Month</strong>' : '<a href="browse?s='.$browse_sort.'&t=m">This Month</a>'; ?>
						|
						<?php echo ($time == "a") ? '<strong>All Time</strong>' : '<a href="browse?s='.$browse_sort.'&t=a">All Time</a>'; ?>
					</div>
				<?php } else { if (isset($_REQUEST['f']) && $_REQUEST['f'] == 'v') { ?>
				<div style="float: center; padding: 1px 5px 0px 0px; font-size: 12px;">
								<a href="/browse?s=<?= $browse_sort ?>&amp;f=b&amp;page=<?php echo ($_GET['page']) ? $_GET['page'] : '1'; ?>&amp;t=<?php echo ($_GET['t']) ? $_GET['t'] : 't'; ?>">Basic View</a>
								| 
								<strong>Detailed View</strong>
							</div>
				<? } else { ?>
				<div style="float: center; padding: 1px 5px 0px 0px; font-size: 12px;">
				<strong>Basic View</strong>
								| 
								<a href="/browse?s=<?= $browse_sort ?>&amp;f=v&amp;page=<?php echo ($_GET['page']) ? $_GET['page'] : '1'; ?>&amp;t=<?php echo ($_GET['t']) ? $_GET['t'] : 't'; ?>">Detailed View</a>
				</div>
				<? } ?>
				        	<? } ?>
											
					</td>
					<td width="310" align="right">
					<div style="font-weight: bold; color: #444444; margin-right: 5px;">
					
						Videos <?php if ($offs > 0) { echo htmlspecialchars(trim($offs)); } else { echo "1"; } ?>-<? $nextynexty = $offs + $ppv; echo htmlspecialchars($nextynexty); ?> of <?php echo number_format($videoc) ?>							
					</div>
					</td>
				</tr>
			</tbody></table>
		</div>
		<?php if($videoc > 0) { ?>
	    <?php if (!isset($_REQUEST['f']) || $_REQUEST['f'] !== 'v') { ?>	
		<div class="moduleFeatured"> 
		
		<table width="680" cellpadding="0" cellspacing="0" border="0">
				<tbody> 
		
			<?php } ?>
				<?php $i = 0;
       
        foreach($videos as $video) {
      
        
        ?>
        <? if (isset($_REQUEST['f']) && $_REQUEST['f'] == 'v') { ?>
        <div class="moduleEntry">
		<table>
			<tbody><tr>
				<td>
					<table style="border-right: 1px dashed #999999;">
						<tbody><tr>
							<td>
							</td><td>
								<a href="/watch?v=<?php echo $video['vid']; ?>&feature=<?php echo $thelink ?>&page=<?php echo $page ?>&t=<?php echo $time ?>&f=b"><img src="/get_still?video_id=<?php echo $video['vid']; ?>&amp;still_id=1" class="moduleFeaturedThumb" width="100" height="75"></a>
							</td>
							<td>
								<a href="/watch?v=<?php echo $video['vid']; ?>&feature=<?php echo $thelink ?>&page=<?php echo $page ?>&t=<?php echo $time ?>&f=b"><img src="/get_still?video_id=<?php echo $video['vid']; ?>&amp;still_id=2" class="moduleFeaturedThumb" width="100" height="75"></a>
							</td>
							<td>
								<a href="/watch?v=<?php echo $video['vid']; ?>&feature=<?php echo $thelink ?>&page=<?php echo $page ?>&t=<?php echo $time ?>&f=b"><img src="/get_still?video_id=<?php echo $video['vid']; ?>&amp;still_id=3" class="moduleFeaturedThumb" width="100" height="75"></a>
							</td>
						</tr>
					</tbody></table>
				</td>
				<td width="10px">&nbsp;</td>
					<td width="100%"><div class="moduleEntryTitle" style="word-break: break-all;"><a href="watch?v=<?php echo $video['vid']; ?>&feature=<?php echo $thelink ?>&page=<?php echo $page ?>&t=<?php echo $time ?>&f=b"><?php echo htmlspecialchars($video['title']); ?></a></div>
							<div class="moduleEntryDescription">
							<?php echo nl2br(htmlspecialchars($video['description'])); ?>
							</div>
					<div class="moduleEntryTags">
						Tags // <?php $tags = explode(" ", $video['tags']); $tagCount = count($tags); foreach ($tags as $index => $tag) { echo '<a href="results?search=' . htmlspecialchars($tag) . '">' . htmlspecialchars($tag) . '</a>'; if ($index < $tagCount - 1) { echo ' : '; } } ?>
					</div>
						<div class="moduleEntryDetails">Channels // <? showChannels($video['vid']); ?>
						</div>
					<div class="moduleEntryDetails">Added: <?php echo retroDate($video['uploaded']); ?> by <a href="profile?user=<?php echo htmlspecialchars($video['username']); ?>"><?php echo htmlspecialchars($video['username']); ?></a></div>
							<div class="moduleEntryDetails">Runtime: <?php echo gmdate("i:s", $video['time']); ?> | Views: <?php echo $video['views']; ?> | Comments: <?php echo getcommentcount($video['vid']); ?></div>
					<? grabRatings($video['vid'], "SM", 0); ?>
				</td>
			
		</tr>
		</tbody></table>
	</div>
       
        <? } else { ?>
				<?php			
                $i = $i + 1;
						if($i == 1) {
							echo '<tr valign="top">';
						}
				?>
				<td width="20%" align="center">
				    <a href="watch?v=<?php echo $video['vid']; ?>&feature=<?php echo $thelink ?>&page=<?php echo $page ?>&t=<?php echo $time ?>&f=b">
				    <img src="/get_still?video_id=<?php echo $video['vid']; ?>" width="120" height="90" class="moduleFeaturedThumb"></a>
				    <div class="moduleFeaturedTitle">
				    <a href="watch?v=<?php echo $video['vid']; ?>&feature=<?php echo $thelink ?>&page=<?php echo $page ?>&t=<?php echo $time ?>&f=b" ><?php echo htmlspecialchars($video['title']); ?></a></div>
				    <div class="moduleFeaturedDetails">Added: <?php echo timeAgo($video['uploaded']); ?><br>by <a href="profile?user=<?php echo htmlspecialchars($video['username']); ?>"><?php echo htmlspecialchars($video['username']); ?></a></div>
				    <div class="moduleFeaturedDetails" style="padding-bottom: 5px;">Runtime: <?php echo gmdate("i:s", $video['time']); ?><br>Views: <?php echo number_format($video['views']); ?> | Comments: <?php echo getcommentcount($video['vid']); ?></div>
				    <? grabRatings($video['vid'], "SM", 0); ?>
				    </td>
				<? if($i == 5) { echo '</tr>'; $i = 0; } } ?><? } ?>
		
	<?php if (!isset($_REQUEST['f']) || $_REQUEST['f'] !== 'v') { ?>
    </tbody></table>
    </div>
<?php } ?>

			<?php } ?>
		
			<?php if($totalPages > 1) { ?>  
<!-- begin paging -->
<div style="font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;">Browse Pages:
<?php
$maxButtons = 15;
$startPage = max(1, $page - floor(($maxButtons - 1) / 2));
$endPage = min($totalPages, $startPage + $maxButtons - 1);
if ($endPage - $startPage < $maxButtons - 1) {
    $startPage = max(1, $endPage - $maxButtons + 1);
}

for ($i = $startPage; $i <= $endPage; $i++) {
    if ($i == $page) {
        echo '
         <span style="color: #444; background-color: #FFFFFF; padding: 1px 4px 1px 4px; border: 1px solid #999; margin-right: 5px;">' . $i . '</span>';
    } else {
         echo '
         <span style="color: #CCC; padding: 1px 4px 1px 4px; border: 1px solid #999; margin-right: 5px;"><a href="browse?page=' . $i . '&s=' . $browse_sort . '&t=' . $time . '&f=' . $_GET['f'] . '">' . $i . '</a></span>';
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


		</td>
	<td style="padding-left: 12px;" width="120" valign="top">
<?php if(!isset($_SESSION['uid'])) { ?>
<a href="/signup"><img src="img/upload_banner.jpg" border="0"></a>
<?php } ?>
</td>
	</tr>
</table>