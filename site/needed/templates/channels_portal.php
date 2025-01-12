<div style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold; color: #666666; padding-top: 15px; padding-bottom: 15px;"><img src="img/ChannelArrow.gif" align="absmiddle">&nbsp;<a href="channels">Channels</a> // <?php echo htmlspecialchars($info['name']) ?></div>

<table width="875" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td style="padding-right: 15px;">
		
		<!-- Begin Most Active Users in the Channel Section -->
		<div style="padding: 7px 0px 7px 0px;">
		<table width="680" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEDD">
			<tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="680">
				<div style="padding: 2px 5px 8px 5px;">
				<div style="float: right; padding: 1px 5px 0px 0px;">&nbsp;</div>
				<div style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666;">Most Active Users in the Channel</div>
				
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<?php foreach($activeusers as $usa) {  ?>
				<td style="text-align: center; width: 20%;" valign="top">
						<a href="/profile?user=<?php echo htmlspecialchars($usa['username']); ?>"><img src="<?php echo getlatestvideo($usa['uid']); ?>" style="border: 5px solid #FFFFFF; margin-top: 10px;" width="80" height="60"></a>
						<div class="moduleEntryDetails" style="padding-top:5px;"><a href="/profile?user=<?php echo htmlspecialchars($usa['username']); ?>"><?php echo htmlspecialchars($usa['username']); ?></a> (<?php echo getsubcount($usa['uid']) ?>)</div>
				</td>
				<?php } ?>	
				</tr>
				</table>
				
				</div>
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
		<!-- End Most Active Users in the Channel Section -->
		<!-- Begin Recently Added to Channel Section -->
	<div style="padding: 7px 0px 7px 0px;">
	<table width="680" cellspacing="0" cellpadding="0" border="0" bgcolor="#EEEEDD" align="center">
			<tbody><tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="680">
				<div style="padding: 2px 5px 8px 5px;">
				<div style="float: right; padding: 1px 5px 0px 0px;font-size: 12px; font-weight: bold;"><a href="channels?c=<?php echo (int)$info['id'] ?>">See More Videos</a></div>
				<div style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666;">Recently Added to <?php echo htmlspecialchars($info['name']) ?></div>
				
				<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
				<tbody>
				<tr>
				<?php foreach ($recentlyadded as $video) { ?>
				    <td valign="top" style="text-align: center; width: 20%;">
						<a href="watch?v=<?php echo htmlspecialchars($video['vid']) ?>"><img src="/get_still?video_id=<?php echo htmlspecialchars($video['vid']) ?>" width="80" height="60" style="border: 5px solid #FFFFFF; margin-top: 10px;">
						<div class="moduleEntrySpecifics" style="padding-top:5px; font-weight: bold;"><a href="/watch?v=<?php echo htmlspecialchars($video['vid']) ?>"><?php echo htmlspecialchars($video['title']) ?></a></div>
						<div class="moduleEntrySpecifics">By: <a href="/profile?user=<?php echo htmlspecialchars($video['username']) ?>"><?php echo htmlspecialchars($video['username']) ?></a></div>
						<div class="moduleEntrySpecifics">Runtime: <?php echo  gmdate("i:s", $video['time']) ?></div>
						<div class="moduleEntrySpecifics">Views: <?php echo number_format($video['views']); ?></div>
						<div class="moduleEntrySpecifics">Comments: <?php echo getcommentcount($video['vid']) ?></div>
						<?php echo grabRatings($video['vid'], "SM") ?>
				    </td>
			<?php } ?>
				
				</tr>
				</tbody></table>
				
				</div>
				</td>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</tbody></table>
		</div>
		<!-- End Recently Added to Channel Section -->
		
		<!-- Begin Top Watched in Channel Section -->
		<div style="padding: 7px 0px 7px 0px;">
		<table width="680" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#EAE9EF">
			<tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="680">
				<div style="padding: 2px 5px 8px 5px;">
				<div style="float: right; padding: 1px 5px 0px 0px;font-size: 12px; font-weight: bold;"><a href="channels?c=<?php echo (int)$info['id'] ?>">See More Videos</a></div>
				<div style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666;">Top Watched Videos in <?php echo htmlspecialchars($info['name']) ?> Channel</div>
				
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
				<tr>
				<?php foreach ($mostviewed as $video) { ?>
				    <td valign="top" style="text-align: center; width: 20%;">
						<a href="watch?v=<?php echo htmlspecialchars($video['vid']) ?>"><img src="/get_still?video_id=<?php echo htmlspecialchars($video['vid']) ?>" width="80" height="60" style="border: 5px solid #FFFFFF; margin-top: 10px;">
						<div class="moduleEntrySpecifics" style="padding-top:5px; font-weight: bold;"><a href="/watch?v=<?php echo htmlspecialchars($video['vid']) ?>"><?php echo htmlspecialchars($video['title']) ?></a></div>
						<div class="moduleEntrySpecifics">By: <a href="/profile?user=<?php echo htmlspecialchars($video['username']) ?>"><?php echo htmlspecialchars($video['username']) ?></a></div>
						<div class="moduleEntrySpecifics">Runtime: <?php echo  gmdate("i:s", $video['time']) ?></div>
						<div class="moduleEntrySpecifics">Views: <?php echo number_format($video['views']); ?></div>
						<div class="moduleEntrySpecifics">Comments: <?php echo getcommentcount($video['vid']) ?></div>
						<?php echo grabRatings($video['vid'], "SM") ?>
				    </td>
			    <?php } ?>
				</tr>
				</table>
				
				</div>
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
		<!-- End Top Watched in Channel Section -->
		

		</td>
		
		<td width="15">&nbsp;</td>
		
		<td width="180">
	
		<!--Begin Top Right Links Section-->
                
        <?php if(!isset($_SESSION['uid'])) { ?>
		<div style="font-size: 12px; font-weight: bold;"><a href="signup">Sign up for an account!</a></div>
		<?php } else { ?>
		<table width="180" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFEEBB" align="center">
			<tbody><tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="170">
					<div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;"><a href="my_videos_upload">Upload a video to this channel!</a></div>
				</td>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</tbody></table>
		<?php } ?>
		<!--End Top Right Links Section-->
		
		
		<!--Begin Recent Tags Section-->
		<div style="margin: 10px 0px 5px 0px; font-size: 12px; font-weight: bold; color: #333;">Recent Tags for this Channel:</div>
        
        <?php
        foreach ($tag_list as $tag => $frequency) { ?>
        <a href="results?search=<?php echo  htmlspecialchars($tag); ?>"><?php echo htmlspecialchars($tag); ?></a><?php if($index != $test) { echo ","; } ?> 
        <?php 
        $index++;
        }
        ?>
		
		<div style="font-size: 13px; color: #333333;">
		
		<div style="font-size: 14px; font-weight: bold; margin-top: 10px;"><a href="tags">See More Tags</a></div>
		
		</div>
		<!--End Recent Tags Section-->

		</td>
	</tr>
</table>