<script type="text/javascript" src="/js/video_bar.js"></script>

<?php if(!isset($_SESSION['uid'])) { ?>
<?php if (empty($sub_check)) { ?>
<script language="JavaScript">
    		onLoadFunctionList.push(function() { imagesInit_recently_viewed();} );
	
		function imagesInit_recently_viewed() {
			imageBrowsers['recently_viewed'] = new ImageBrowser(5, 1, "recently_viewed");
			<?php $theoutput = array(); foreach($rec_viewed as $vids_viewed) { ?>	
				 <?php if(!in_array($vids_viewed['vid'], $theoutput)) { ?>
				imageBrowsers['recently_viewed'].addImage(new etImage("/get_still.php?video_id=<?php echo htmlspecialchars($vids_viewed['vid']); ?>", 
													  "/watch.php?v=<?php echo htmlspecialchars($vids_viewed['vid']); ?>",
													  "<?php echo htmlspecialchars($vids_viewed['title']); ?>", 
													  "/watch.php?v=<?php echo htmlspecialchars($vids_viewed['vid']); ?>",
													  "<? echo timeAgo($vids_viewed['viewed']); ?>",
													  "",
													  false) );
				
				 <?php $theoutput[] = $vids_viewed['vid']; ?>
				<?php } ?>
				 <? } ?>
			imageBrowsers['recently_viewed'].initDisplay();
			imageBrowsers['recently_viewed'].showImages();
			images_loaded = true;
		}



</script>
<? } ?>

<?php  } ?> 

<?php if(isset($_SESSION['uid'])) { ?>
<?php if (!empty($sub_check)) { ?>
<script language="JavaScript">
    		onLoadFunctionList.push(function() { imagesInit_subscriptions();} );
	
		function imagesInit_subscriptions() {
			imageBrowsers['subscriptions'] = new ImageBrowser(5, 1, "subscriptions");
			<?php $theoutput = array(); foreach($sub_check as $sub) { ?>	
				 <?php if(!in_array($sub['vid'], $theoutput)) { ?>
				imageBrowsers['subscriptions'].addImage(new etImage("/get_still.php?video_id=<?php echo htmlspecialchars($sub['vid']); ?>", 
													  "/watch.php?v=<?php echo htmlspecialchars($sub['vid']); ?>",
													  "<?php echo htmlspecialchars($sub['title']); ?>", 
													  "/watch.php?v=<?php echo htmlspecialchars($sub['vid']); ?>",
													  "<? echo timeAgo($sub['uploaded']); ?>",
													  "",
													  false) );
				
				 <?php $theoutput[] = $sub['vid']; ?>
				<?php } ?>
				 <? } ?>
			imageBrowsers['subscriptions'].initDisplay();
			imageBrowsers['subscriptions'].showImages();
			images_loaded = true;
		}



</script>
<? } ?>

<?php  } ?> 

<table width="875" align="left" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td width="560" align="left">

					
				<?php if(isset($_SESSION['uid']) && $_SESSION['uid'] != null) { ?>				
<table class="roundedTable" width="680" cellspacing="0" cellpadding="0" border="0" bgcolor="#EFEFEF" align="center">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="670">
									<table width="100%" cellspacing="0" cellpadding="0" border="0">

												<tbody><tr valign="top">
													<td style="border-right: 1px dashed #CCCCCC; padding: 0px 53px 10px 10px; color: #444;" width="33%">
														<b>
															<div style="font-size: 16px; color: #0c3768; margin-top:4px">Welcome, <?php echo $session['username'] ?></div>
															<b></b>
														</b>
														<table class="roundedTable" style="margin-top: 10px;" cellspacing="0" cellpadding="0" border="0">
															<tbody>
																<tr valign="top">
																	<td width="271">
																		<div>
																			<table width="271" height="24" cellspacing="0" cellpadding="0" border="0" background="/img/SmallGenericTab.jpg">
																				<tbody>
																					<tr>
																						<td>
																							<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">My Stats</span>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																		<div>
																			<table width="21" height="121" cellspacing="0" cellpadding="0">
																				<tbody>
																					<tr>
																						<td>
																							<table style="background-color: #FFFFFF; border: 1px solid #CCCCCC; border-top: none; padding: 10px;" width="271" height="121" cellspacing="0" cellpadding="0">
																								<tbody>
																									<tr valign="top">
																										<td>
																											<div style="padding-bottom: 5px;">
																												<a href="/my_videos.php">My Videos</a> have been viewed <?php

$views = $p_views->fetchColumn();

if ($views > 0) {

    echo number_format($views);

} else {

    echo 0;

}

?> times
																											</div>
																											<div style="padding-bottom: 5px;">I have <?php echo number_format($REALFREIDNSREALFREIDNS); ?> <a href="/my_friends.php">Friends</a>
																											</div>
																											<div style="padding-bottom: 5px;">I've watched <?php echo number_format($session['vids_watched']) ?>
													Video<?php if($session['vids_watched'] != 1) { echo "s"; }?>
													</div>														<div>My Profile has been viewed <?php echo number_format($session['profile_views']) ?> times</div>
																										</td>
																									</tr>
																								</tbody>
																							</table>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
													<td style="padding: 0px 10px 0px 53px;border-right: 0px dashed #369; color: #444;" width="33%">
														<table class="roundedTable" style="margin-top: 32px;" cellspacing="0" cellpadding="0" border="0">
															<tbody>
																<tr valign="top">
																	<td width="271">
																		<div>
																			<table width="271" height="24" cellspacing="0" cellpadding="0" border="0" background="/img/SmallGenericTab.jpg">
																				<tbody>
																					<tr>
																						<td>
																							<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">My Inbox</span>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																		<div>
																			<table width="21" height="121" cellspacing="0" cellpadding="0">
																				<tbody>
																					<tr>
																						<td>
																							<table style="background-color: #FFFFFF; border: 1px solid #CCCCCC; border-top: none; padding: 10px;" width="271" height="121" cellspacing="0" cellpadding="0">
																								<tbody>
																									<tr valign="top">
																										<td>
																											<div style="padding-bottom: 5px;">
																											<img style="margin-right: 5px;" src="/img/icon_mail_on.gif">You have <a href="/my_messages.php"> <? if($inbox == 0) { $new_m = '0'; } else { $new_m = $inbox; } echo number_format($new_m) ?> new message<?php if($inbox > 1 ) { echo "s";} ?></a>
																											</div>
																												<div style="padding-bottom: 35px;">You have <a href="/my_friends_accept.php"><?php echo number_format($friend_request_count); ?> friend request<?php if($friend_request_count > 1) { echo "s"; } ?></a>
																											</div>
																											<div>
																																																							<a style="font-weight: bold;" href="/my_profile_email.php">Sign up for "The Weekly Tube" e-mail</a>
																												<br> The best <? echo $SiteBranding ?> videos delivered to you!
																																																						</div>
																												</td>
																									</tr>
																								</tbody>
																							</table>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
				</table>

				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
		<?php if(!empty($sub_check)) { ?>
			<tr>
			<td><img src="/img/pixel.gif" width="5" height="1"></td>
			<td>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
				<td width="575">
								
		
		       <div style="padding-left: 10px; padding-right: 10px;">
	<table width="648" height="28" cellpadding="0" cellspacing="0" border="0" background="/img/648Tab.jpg">
		<tr>
			<td width="430px">
				<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">My Subscriptions</span>
				<span style="font-size: 10px; color: #999999;"><span id="counter_subscriptions"></span>
			</td>
			<td align="left">		
					<span style="font-size: 13px; color: #6D6D6D;"><span></span>
			</td>	
			<td align="right">	
				<span style="padding-right: 10px;"><img src="/img/icon_todo.gif" border="0" width="23" height="14" style="padding-right: 5px; vertical-align: middle;">
						<a href="/subscription_center.php">View More Subscriptions..</a>
				</span>
			</td>
		</tr>
	</table>
	</div>

	
		<div style="padding-left: 1px;">					
		<table width="21" height="121" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/img/LeftTableArrow.gif" onclick="shiftLeft('subscriptions')" width=21 height=121 border=0></td>
				<td>
					<table width="625" height="121" style="background-color: #FFFFFF; border-bottom: 1px solid #CCCCCC;" cellpadding="0" cellspacing="0">
						<tr>
							<td>

							<div class="videobarthumbnail_block" id="div_subscriptions_0">
								<center>
									<div><a id="href_subscriptions_0" href=".."><img class="videobarthumbnail_gray" id="img_subscriptions_0" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_subscriptions_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_subscriptions_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_subscriptions_0_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>

							<div class="videobarthumbnail_block" id="div_subscriptions_1">
								<center>
									<div><a id="href_subscriptions_1" href=".."><img class="videobarthumbnail_gray" id="img_subscriptions_1" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_subscriptions_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_subscriptions_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_subscriptions_1_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>

							<div class="videobarthumbnail_block" id="div_subscriptions_2">
								<center>
									<div><a id="href_subscriptions_2" href=".."><img class="videobarthumbnail_gray" id="img_subscriptions_2" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_subscriptions_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_subscriptions_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_subscriptions_2_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>

							<div class="videobarthumbnail_block" id="div_subscriptions_3">
								<center>
									<div><a id="href_subscriptions_3" href=".."><img class="videobarthumbnail_gray" id="img_subscriptions_3" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_subscriptions_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_subscriptions_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_subscriptions_3_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
                        	<div class="videobarthumbnail_block" id="div_subscriptions_4">
								<center>
									<div><a id="href_subscriptions_4" href=".."><img class="videobarthumbnail_gray" id="img_subscriptions_4" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_subscriptions_4" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_subscriptions_4" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_subscriptions_4_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>

							</td>
						</tr>
					</table>
				</td>
				<td><img src="/img/RightTableArrow.gif" onclick="shiftRight('subscriptions')" width=21 height=121 border=0></td>
			</tr>
		</table>
		</div>

				</td>
			</tr>
			</table>
			</td>
		<?php } ?>
			</tr>
	
			<tr>
				<td valign="bottom"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td valign="bottom"><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>
		<?php } else { ?>		
						<table class="roundedTable" width="550" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFFFF">
			<tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="540">
								
		
	<div style="padding-left: 10px; padding-right: 10px;">
	<table width="648" height="28" cellpadding="0" cellspacing="0" border="0" background="/img/648Tab.jpg">
		<tr>
			<td width="430px">
				<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">Recently Viewed</span>
				<span style="font-size: 10px; color: #999999;"><span id="counter_recently_viewed"></span>
			</td>
			<td align="left">		
					<span style="font-size: 13px; color: #6D6D6D;"><span></span>
			</td>	
			<td align="right">	
				<span style="padding-right: 10px; padding-left: 10px; nowrap"><img src="/img/icon_todo.gif" border="0" width="23" height="14" style="padding-right: 5px; vertical-align: middle;">
						<a href="/browse?s=mp">More Recently Viewed..</a>
				</span>
			</td>
		</tr>
	</table>
	</div>

	
				
		<div style="padding-left: 1px;">					
		<table width="21" height="121" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/img/LeftTableArrowWhite.jpg" onclick="shiftLeft('recently_viewed')" border="0"></td>
				<td>
					<table width="625" height="121" style="background-color: #FFFFFF; border-bottom: 1px solid #CCCCCC;" cellpadding="0" cellspacing="0">
						<tr>
							<td style="border-bottom:none;">
							<div class="videobarthumbnail_block" id="div_recently_viewed_0">
								<center>
									<div><a id="href_recently_viewed_0" href=".."><img class="videobarthumbnail_gray" id="img_recently_viewed_0" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id="title1_recently_viewed_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id="title2_recently_viewed_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_recently_viewed_0_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_recently_viewed_1">
								<center>
									<div><a id="href_recently_viewed_1" href=".."><img class="videobarthumbnail_gray" id="img_recently_viewed_1" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id="title1_recently_viewed_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id="title2_recently_viewed_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_recently_viewed_1_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_recently_viewed_2">
								<center>
									<div><a id="href_recently_viewed_2" href=".."><img class="videobarthumbnail_gray" id="img_recently_viewed_2" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id="title1_recently_viewed_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id="title2_recently_viewed_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_recently_viewed_2_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_recently_viewed_3">
								<center>
									<div><a id="href_recently_viewed_3" href=".."><img class="videobarthumbnail_gray" id="img_recently_viewed_3" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id="title1_recently_viewed_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id="title2_recently_viewed_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_recently_viewed_3_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_recently_viewed_4">
								<center>
									<div><a id="href_recently_viewed_4" href=".."><img class="videobarthumbnail_gray" id="img_recently_viewed_4" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id="title1_recently_viewed_4" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id="title2_recently_viewed_4" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_recently_viewed_4_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							</td>
						</tr>
					</table>
				</td>
				<td><img src="/img/RightTableArrowWhite.jpg" onclick="shiftRight('recently_viewed')" border="0"></td>
			</tr>
		</table>
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
			<!-- begin recently featured -->
					<table class="roundedTable" width="680" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#cccccc">
			<tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="670">
					<div class="sunkenTitleBar">
						<div class="sunkenTitle">
							<div style="float: right; padding: 1px 5px 0px 0px; font-size: 12px;"><a href="/browse">See More Videos</a></div>
							<span style="color:#444;">Today's Featured Videos...</span>
						</div>
					</div>
						
						
						  <?php foreach($featured as $pick) { ?>
                    	<div class="moduleEntry<?php if($pick['special'] == 1) { echo "Premium"; } ?>">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr valign="top">
								<td width="120">
									<a href="/watch?v=<?php echo $pick['vid'] ?>"><img src="/get_still?video_id=<?php echo $pick['vid'] ?>" class="moduleEntryThumb" width="120" height="90"></a>
								</td>
								<td width="385" align="left">
									<div class="moduleEntryTitle">
										<a href="/watch?v=<?php echo $pick['vid'] ?>"><?php echo htmlspecialchars($pick['title'] )?></a>
									</div>
									
									<div class="moduleEntryDescription">
									<?php echo nl2br(htmlspecialchars($pick['description'])); ?>
									</div>
					
									<div class="moduleEntryTags">
										Tags // <?php $tags = explode(" ", $pick['tags']); $tagCount = count($tags); foreach ($tags as $index => $tag) { echo '<a href="results?search=' . htmlspecialchars($tag) . '">' . htmlspecialchars($tag) . '</a>'; if ($index < $tagCount - 1) { echo ' : '; } } ?>		
									</div>

										<div class="moduleEntryTags">Channels // 
										<? showChannels($pick['vid'], ' :'); ?></div>
							
									<div class="moduleEntryDetails">
										Added: <?php echo timeAgo($pick['uploaded']); ?> by <a href="/profile?user=<?php echo htmlspecialchars($pick['username']) ?>"><?php echo htmlspecialchars($pick['username']) ?></a>
									</div>
									<div class="moduleEntryDetails">
										Runtime: <?php echo gmdate("i:s", $pick['time']); ?> | Views: <?php echo number_format($pick['views']) ?> | Comments: <?php echo number_format($comments) ?>
									</div>
												
	<? grabRatings($pick['vid'], "SM"); ?>


								</td>
								<td width="100" align="right">
								</td>
							</tr>
						</table>
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
		</table>

			<!-- end recently featured -->

		</td>
		<td width="15">&nbsp;</td>
		<td width="300">
					<table class="roundedTable" width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#cccccc">
			<tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="170">
							<div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;">
		<div style="font-size: 13px; font-weight: bold; text-align: center; color: #444444; padding-bottom: 5px;"><img src="/img/gray_arrow.gif" width="14" height="14" broder="0" align="absmiddle">&nbsp;New Features</div>
		<table style="background-color: #EAEAEA;" width="100%">
			<tr>
				<td style="text-align: center;">
				<div style="padding-top: 5px;"><a href="my_profile">Custom Profiles</a></div>
				<div style="font-size: 11px; font-weight: normal; padding-bottom: 8px;">Choose your colors and interact with comments and bulletin boards</div>
				<div style="padding-top: 5px;"><a href="members">Members</a></div>
				<div style="font-size: 11px; font-weight: normal; padding-bottom: 12px;">New Members tab&#8212;improved search, featured members, and more!</div>	
				<div style="font-size: 14px; font-weight: bold; padding-bottom: 3px;"><a href="/explore_epiktube">Explore <? echo $SiteBranding ?></a></div>		
				</td>
			</tr>
		</table>
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

					<table class="roundedTable" width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#eeeeee">
			<tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="170">
					<!--Begin Monthly Contest Information-->
<div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;">
<div style="font-size: 12px; font-weight: bold; text-align: center;"><a href="/discord">Join our Discord!</a></div>
<!--End Monthly Contest Information-->

				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td valign="bottom"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td valign="bottom"><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>

			
		
<div style="margin: 10px 0px 5px 0px; font-size: 12px; font-weight: bold; color: #333; padding-left: 10px;">Recent Tags:</div>
		<div style="font-size: 13px; color: #333333;">
		
				
		<?php
        foreach($tag_list as $tag => $frequency    ) {
        $freqindex = $frequency*2;
        $freqindex = $freqindex+10;
        if ($freqindex > 28) {
            $freqindex = 28;
        }
            echo '<a style="font-size:'.htmlspecialchars($freqindex).'px; padding-left: 10px;" href="/results?search='.htmlspecialchars($tag).'">'.htmlspecialchars($tag).'</a> : ';
        } 

?>
		
			
<div style="font-size: 14px; font-weight: bold; margin-top: 10px; padding-left: 10px;">
				<a href="tags">See More Tags</a>
		</div>
		
		</div>
    
      

		<? whos_online(5); ?>
		
		</td>
	</tr>
</tbody></table>