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
					<tr valign="top">
						<td width="100%">
	
							<div class="moduleTitle">
									All Channels
							</div>
						</td>
					</tr>
				</table>
			</div>
					
			<div class="moduleFeatured"> 
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr valign="top">
							<td width="100%">
							    <table width="100%" cellpadding="0" cellspacing="0" border="0">   
<?php
$counter = 0; 
foreach ($_VCHANE as $channel) {
    $video = $conn->prepare("SELECT vid FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) AND (ch1 = :channel OR ch2 = :channel OR ch3 = :channel) ORDER BY rand() DESC");
    $video->bindParam(':channel', $channel['id']);
    $video->execute();
    $today = $conn->prepare("SELECT vid FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) AND (ch1 = :channel OR ch2 = :channel OR ch3 = :channel) AND uploaded > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY uploaded DESC");
    $today->bindParam(':channel', $channel['id']);
    $today->execute();
    $today = $today->rowCount();
    if ($video->rowCount() != 0) { 
        $all = $video->rowCount();
        $video = $video->fetch(PDO::FETCH_ASSOC); 
    } else { 
        $videoisempty = true; 
        $all = 0;
    }
    if ($counter % 3 == 0) {
        echo '<tr valign="top">';
    }
    ?>
<td width="33%">
		<table>
		<tr>
		<td valign="top">
		<a href="/channels_portal?c=<?php echo (int)$channel['id'] ?>"><img src="/get_still?video_id=<?php echo !isset($videoisempty) ? htmlspecialchars($video['vid']) : ""; ?>" width="80" height="60" style="border: 5px solid #FFFFFF;"></a>&nbsp;
		</td>
		<td valign="top">
			<div style="font-size: 12px; font-weight: bold;"><a href="/channels_portal?c=<?php echo (int)$channel['id'] ?>"><?php echo htmlspecialchars($channel['name']) ?></div></a>
			<div style="font-size: 11px; font-family: Arial, Helvetica, sans-serif; color: #666666; padding-top: 2px;">
				<!--<img src="img/ChannelStar.gif" width='12px' align="absmiddle">&nbsp;-->Today: <?php echo number_format($today) ?> | Total: <?php echo number_format($all); ?>
			</div>
			<div style="font-size: 11px; font-family: Arial, Helvetica, sans-serif; color: #666666; padding-top: 2px;">
				<!--<img src="img/pixel.gif" width='12px'  align="absmiddle">&nbsp;-->Groups: <?php echo getgroupcountchannel($channel['id']) ?> 
			</div>
			<div style="padding-top: 4px; font-size: 11px;"><?php echo htmlspecialchars($channel['description']) ?></div>
		</td>
		</tr>
		</table>
	</td>
    <?php
 
    if (($counter + 1) % 3 == 0) {
        echo '<tr valign="top"><td colspan="2">&nbsp;</td></tr></tr>';
    }

    $counter++;
    unset($videoisempty);
}
?>		
								</table>
							</td>
						</tr>
				</table>
			</div>
			
			</td>
			<td><img src="/img/pixel.gif" width="5" height="1"></td>
		</tr>
		<tr>
			<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
			<td><img src="/img/pixel.gif" width="1" height="5"></td>
			<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
		</tr>
	</table>
</td>

<td width="120" valign="top" style="padding-left: 12px;">
<?php if(!isset($_SESSION['uid'])) { ?>
<a href="/signup"><img src="img/upload_banner.jpg" border="0"></a>
<?php } ?>
</td>
</tr>
</table>