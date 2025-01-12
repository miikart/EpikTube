<script type="text/javascript" src="/js/video_bar.js"></script>
<script language="JavaScript">
onLoadFunctionList.push(function() { imagesInit_subscriptions();} );
function imagesInit_subscriptions() {
<?php foreach($sub_check as $thehting) { ?>
	imageBrowsers['<?php echo htmlspecialchars($thehting['username']);  ?>'] = new ImageBrowser(5, 1, "<?php echo htmlspecialchars($thehting['username']);  ?>");
<?php } ?>
<?php foreach($sub_check2 as $raah) { ?>
imageBrowsers['<?php echo htmlspecialchars($raah['username']);  ?>'].addImage(new etImage("get_still?video_id=<?php echo $raah['vid'] ?>", "/watch?v=<?php echo $raah['vid'] ?>", "<?php echo htmlspecialchars($raah['title']) ?>",  "/watch?v=<?php echo $raah['vid'] ?>", "<?php echo timeAgo($raah['uploaded']) ?>", "", false) )
<?php } ?>
<?php foreach($sub_check as $thehting) { ?>
<?php 	$ruouref = $conn->prepare("SELECT * FROM videos WHERE uid = :uid AND converted = 1 AND privacy = 1");
		$ruouref->bindParam(':uid', $thehting['uid']);
		$ruouref->execute();
		$resulta = $ruouref->rowCount();  ?>
	<?php if($resulta > 0) { ?>
	imageBrowsers['<?php echo htmlspecialchars($thehting['username']);  ?>'].initDisplay();
	imageBrowsers['<?php echo htmlspecialchars($thehting['username']);  ?>'].showImages();
<?php } ?>
<?php } ?>
	images_loaded = true;
}
</script>

<table cellspacing="0" cellpadding="5" border="0" align="center">
	<tbody><tr>
		<td class="bold">Subscription Center</td>
		<td style="padding: 0px 5px 0px 5px;">|</td>
		<td><a href="/my_subscribers">My Subscribers</a></td>
		</tr>
</tbody></table><br>

<div class="tableSubTitle">Subscriptions Management</div>

<b>Subscribe to user</b><br>
<form method="get">
	<input type="text" name="add_user" size="46"> <input type="submit" name="submit" value="Subscribe"><br><span class="formFieldInfo"><b>Enter the username of the user account you wish to subscribe to</b></span>
</form>

<hr>

<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr valign="top">
		<td>
		
		<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#EFEFEF" align="center">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td style="padding: 5px 0px 10px 0px;">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">

				<tbody><tr>
				<td>
					<b>Active Subscriptions<br><br></b>

								
			<?php foreach($sub_check as $subscription) { ?>	
<?php if(getpublicvideos($subscription['uid']) > 0) { ?>
<table style="padding-bottom:10px"cellspacing="0" cellpadding="0" border="0">
			<tbody>
			<tr>
				
				<td width="575">
								
    <div style="padding-left: 10px; padding-right: 10px;">
	<table width="648" height="28" cellspacing="0" cellpadding="0" border="0" background="/img/648Tab.jpg">
		<tbody><tr>
			<td width="430px">
				<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;"><a href="profile?user=<?php echo htmlspecialchars($subscription['username']);  ?>"><?php echo htmlspecialchars($subscription['username']);  ?></a></span>
				<span style="font-size: 10px; color: #999999;"><span id="counter_<?php echo htmlspecialchars($subscription['username']);  ?>"></span>
			</span></td>
			<td align="left">		
					<span style="font-size: 13px; color: #6D6D6D;"><span></span>
			</span></td>	
			<td align="right">	
				<span style="padding-right: 10px; padding-left: 10px;"><img src="/img/icon_todo.gif" style="padding-right: 5px; vertical-align: middle;" width="23" height="14" border="0">
						<a href="/subscription_center?cancel=<?php echo htmlspecialchars($subscription['username']);  ?>">Cancel Subscription</a>
				</span>
			</td>
		</tr>
	</tbody></table>
	</div>

	
		<div style="padding-left: 1px;">					
		<table width="21" height="121" cellspacing="0" cellpadding="0">
			<tbody><tr>
				<td><img onclick="shiftLeft('<?php echo htmlspecialchars($subscription['username']);  ?>')" src="/img/LeftTableArrow.gif" width="21" height="121" border="0"></td>
				<td>
		<table style="background-color: #FFFFFF; border-bottom: 1px solid #CCCCCC;" width="625" height="121" cellspacing="0" cellpadding="0">
						<tbody><tr>
							<td>

								<div class="videobarthumbnail_block" id="div_<?php echo htmlspecialchars($subscription['username']);  ?>_0">
								<center>
									<div><a id="href_<?php echo htmlspecialchars($subscription['username']);  ?>_0" href=".."><img class="videobarthumbnail_gray" id="img_<?php echo htmlspecialchars($subscription['username']);  ?>_0" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_<?php echo htmlspecialchars($subscription['username']);  ?>_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_<?php echo htmlspecialchars($subscription['username']);  ?>_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_<?php echo htmlspecialchars($subscription['username']);  ?>_0_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>

							<div class="videobarthumbnail_block" id="div_<?php echo htmlspecialchars($subscription['username']);  ?>_1">
								<center>
									<div><a id="href_<?php echo htmlspecialchars($subscription['username']);  ?>_1" href=".."><img class="videobarthumbnail_gray" id="img_<?php echo htmlspecialchars($subscription['username']);  ?>_1" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_<?php echo htmlspecialchars($subscription['username']);  ?>_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_<?php echo htmlspecialchars($subscription['username']);  ?>_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_<?php echo htmlspecialchars($subscription['username']);  ?>_1_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>

							<div class="videobarthumbnail_block" id="div_<?php echo htmlspecialchars($subscription['username']);  ?>_2">
								<center>
									<div><a id="href_<?php echo htmlspecialchars($subscription['username']);  ?>_2" href=".."><img class="videobarthumbnail_gray" id="img_<?php echo htmlspecialchars($subscription['username']);  ?>_2" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_<?php echo htmlspecialchars($subscription['username']);  ?>_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_<?php echo htmlspecialchars($subscription['username']);  ?>_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_<?php echo htmlspecialchars($subscription['username']);  ?>_2_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>

							<div class="videobarthumbnail_block" id="div_<?php echo htmlspecialchars($subscription['username']);  ?>_3">
								<center>
									<div><a id="href_<?php echo htmlspecialchars($subscription['username']);  ?>_3" href=".."><img class="videobarthumbnail_gray" id="img_<?php echo htmlspecialchars($subscription['username']);  ?>_3" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_<?php echo htmlspecialchars($subscription['username']);  ?>_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_<?php echo htmlspecialchars($subscription['username']);  ?>_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_<?php echo htmlspecialchars($subscription['username']);  ?>_3_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
                        	<div class="videobarthumbnail_block" id="div_<?php echo htmlspecialchars($subscription['username']);  ?>_4">
								<center>
									<div><a id="href_<?php echo htmlspecialchars($subscription['username']);  ?>_4" href=".."><img class="videobarthumbnail_gray" id="img_<?php echo htmlspecialchars($subscription['username']);  ?>_4" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_<?php echo htmlspecialchars($subscription['username']);  ?>_4" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_<?php echo htmlspecialchars($subscription['username']);  ?>_4" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_<?php echo htmlspecialchars($subscription['username']);  ?>_4_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>

							</td>
						</tr>
					</tbody></table>
				</td>
				<td><img onclick="shiftRight('<?php echo htmlspecialchars($subscription['username']);  ?>')" src="/img/RightTableArrow.gif" width="21" height="121" border="0"></td>
			</tr>
		</tbody></table>
		</div>

				</td>
				
			</tr>
			
		</tbody></table>
<?php } else { ?>
<p><?php echo $subscription['username']  ?>[<a href="/subscription_center?cancel=<?php echo $subscription['username']  ?>">cancel</a>]</p>
<?php } ?>
<?php } ?>
						

			

										</td>
				</tr>

				</tbody></table>
				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</tbody></table><br>
	

		
		</td>
	</tr>
</tbody></table>