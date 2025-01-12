<div style="padding-bottom: 15px;">
<table align="center" cellpadding="0" cellspacing="0" border="0">
<?php require_once("profileLinks.php"); ?>
</table>
</div>

<script src="/js/AJAX.js" language="javascript"></script>
<script src="/js/ui.js" language="javascript"></script>




<script type="text/javascript" src="/js/video_bar.js"></script>

<script language="javascript">

	function getFormVars(form) 
	{	var formVars = new Array();
		for (var i = 0; i < form.elements.length; i++)
		{
			var formElement = form.elements[i];
			formVars[formElement.name] = formElement.value;
		}
		return urlEncodeDict(formVars);
	}



	
	function blockUser(form) 
	{
        if (!confirm("Are you sure you want to block this user?"))
            return true;

		postUrl("link_servlet", getFormVars(form), true, execOnSuccess(function (xmlHttpRequest) { 
				response_str = xmlHttpRequest.responseText;
				if(response_str == "SUCCESS") {
					form.block_button.value = "User blocked"
				} else {
					alert ("An error occured while blocking the user.");
					form.block_button.value = "Block this user"
					form.block_button.disabled = false;
				}
			}));	
		form.block_button.disabled = true
		form.block_button.value = "Please wait.."
		return true;
	}
	function unblockUser(form) 
	{
        if (!confirm("Are you sure you want to unblock this user?"))
            return true;

		postUrl("/link_servlet", getFormVars(form), true, execOnSuccess(function (xmlHttpRequest) { 
				response_str = xmlHttpRequest.responseText;
				if(response_str == "SUCCESS") {
					form.unblock_button.value = "User unblocked"
				} else {
					alert ("An error occured while unblocking the user.");
					form.unblock_button.value = "Unblock this user"
					form.unblock_button.disabled = false;
				}
			}));	
		
		form.unblock_button.disabled = true
		form.unblock_button.value = "Please wait.."
		return true;
	}
	
	function unblockUserLink(friend_id, url)
	{
        if (!confirm("Are you sure you want to unblock this user?"))
            return true;
		getUrlSync("/link_servlet?unblock_user=1&friend_id=" + friend_id);
	    window.location.href = url;
		return true;
	}
	function blockUserLink(friend_id, url)
	{
        if (!confirm("Are you sure you want to block this user?"))
            return true;
		getUrlSync("/link_servlet?block_user=1&friend_id=" + friend_id);
	    window.location.href = url;
		return true;
	}


        <?php if($thecount > 0) { ?>
		onLoadFunctionList.push(function() { imagesInit_profile_videos();} );
        
        function imagesInit_profile_videos() {
			imageBrowsers['profile_videos'] = new ImageBrowser(<?php echo $thecount ?>, 1, "profile_videos");
           <?php foreach($videos as $yippe) { ?>	
                imageBrowsers['profile_videos'].addImage(new etImage("/get_still.php?video_id=<?php echo htmlspecialchars($yippe['vid']); ?>",
                                                        "/watch.php?v=<?php echo htmlspecialchars($yippe['vid']); ?>",
                                                        "<?php echo htmlspecialchars($yippe['title']); ?>", "/watch?v=<?php echo htmlspecialchars($yippe['vid']); ?>",
                                                        "<?php echo timeAgo($yippe['uploaded']); ?>",
                                                "",
                                                false) );
            <?php } ?>
            imageBrowsers['profile_videos'].initDisplay();
            imageBrowsers['profile_videos'].showImages();        
			images_loaded = true;
        }
        <?php } ?>
        
        <?php if($tjecountbutfreiendd > 0) { ?>
        onLoadFunctionList.push(function() { imagesInit_recent_friends();} );
        
        function imagesInit_recent_friends() {
			imageBrowsers['recent_friends'] = new ImageBrowser(<?php echo $tjecountbutfreiendd ?>, 1, "recent_friends");
        <?php $theoutput = array(); foreach($friends as $yapping) { ?>	
        <?php if(!in_array($yapping['uid'], $theoutput) && $profile['uid'] != $yapping['uid']) { ?>
                imageBrowsers['recent_friends'].addImage(new etImage("<?php echo getlatestvideo($yapping['uid']); ?>",
                                                "<?php echo "profile?user=". $yapping['username'] ?>",
                                                "<?php echo htmlspecialchars($yapping['username']); ?>",
                                                "/profile.php?user=<?php echo htmlspecialchars($yapping['username']) ?>",
                                                "", 
                                                false) ); 
        <?php $theoutput[] = $yapping['uid']; } ?>
        <?php } ?>
            imageBrowsers['recent_friends'].initDisplay();
            imageBrowsers['recent_friends'].showImages();
			images_loaded = true;
        }
        <?php } ?>
function share_profile()
{
  var fs = window.open( "/share?u=<?php echo htmlspecialchars($profile['username']) ?>",
           "Share", "toolbar=no,width=546,height=485,status=no,resizable=yes,fullscreen=no,scrollbars=no");
  fs.focus();
}
</script>

<div>
<table width="875" cellpadding="0" cellspacing="0">	
	<tr>
		<td width="300" valign="top">
			<table class="userTable" cellpadding="0" cellspacing="0">
				<tr class="profileHeaders">
					
					<td colspan="2">
						<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">Hello. I'm <?php echo htmlspecialchars($profile['username']) ?></div>
	<div style="float: right; padding-right: 5px"><?php if(isset($_SESSION['uid']) && $profile['uid'] == $_SESSION['uid']) { ?>(<a href='/my_profile' class='edit'>Edit</a>)<?php } ?></div>


					
					</td>
				</tr>												
				<tr class="rows">	
					
				
					<td width="142" align="left">
						<img src="<?php echo getlatestvideo($profile['uid']) ?>" class="aboutImg"/>
					</td>
					
					<td width="144" align="left">
                        <?php if ($profile['birthday'] != '0000-00-00' && $profile['birthday'] != NULL) { ?>   
						<span class="profileTitles">Age: </span><?php echo str_replace(['years', 'old', 'ago'], '', timeAgo($profile['birthday'])); ?>
						<br />
				        <? } ?>		
                        <?php if(!isset($nogender)) { ?>
						<span class="profileTitles">Gender: </span><?php echo htmlspecialchars($gender); ?>
						<br />					
					    <?php } ?>
						<?php if (!empty($profile['country'])) { ?>
				        <?php echo htmlspecialchars($profile['country']) ?>
				        <?php } ?>	
					</td>
				</tr>

				<tr class="rows">
					<td colspan="3">
						<span class="profileTitles">Last Login: </span><?php echo timeAgo($profile['lastlogin']) ?>
						<br />
						<span class="profileTitles">Signed Up: </span><?php echo timeAgo($profile['joined']) ?>
						<br />
						<span class="profileTitles">URL: </span> <a href="/user/<?php echo htmlspecialchars($profile['username']) ?>">http://www.epiktube.xyz/user/<?php echo htmlspecialchars($profile['username']) ?></a>
					</td>
				</tr>
			</table>
		
			<div>&nbsp;</div>
			
						
			
			<table class="connectTable" cellpadding="0" cellspacing="0">
				<tr class="profileHeaders">
					<td colspan="5">&nbsp;&nbsp;Connect with <?php echo htmlspecialchars($profile['username']) ?></td>
				</tr>
				<tr class="connectRowsTop">
					<td width="5">&nbsp;</td>
					<td width="21" valign="middle"><img src="/img/SendMessage.gif"></td>
					<td><span class="connectLinks"><a href="/outbox?to_user=<?php echo htmlspecialchars($profile['username']) ?>">Send Message</a></span></td>
					<td width="21" valign="middle"><img src="/img/AddToFriends.gif"></td>
					<td><span class="connectLinks"><a href="/my_friends_<?php if ($friendswith != 1){ ?>invite<?php } else { ?>remove<?php } ?>_user?friend_id=<?php echo $profile['uid'] ?>"><?php if ($friendswith != 1){ ?>Add to Friends<? } elseif ($friendswith == 1){ ?>Remove from Friends<?php } ?></a></span></td>			
				</tr>
				<tr class="connectRows">
					<td width="5">&nbsp;</td>
					<td width="21" valign="middle"><img src="/img/AddComment.gif" class="connectImages"></td>
					<td><span class="connectLinks"><a href="/profile_comment_post?user=<?php echo htmlspecialchars($profile['username']) ?>">Add Comment</a></span></td>
					<td width="21" valign="middle"><img src="/img/FwdMember.gif"></td>
					<td><span class="connectLinks"><a href="javascript:share_profile()">Forward Member</a></span></td>
				</tr>	
				<tr class="connectRowsBottom">
					<td width="5">&nbsp;</td>
					<td width="21" valign="middle"><?php if(isset($_SESSION['uid'])) { ?><img class="connectImages" src="/img/BlockMember.gif"><?php } ?></td>
					<td><span class="connectLinks"><?php if(isset($_SESSION['uid'])) { ?><a href="#" onclick="return blockUserLink('<?php echo $profile['username']; ?>', '/profile?user=<?php echo $profile['username']; ?>');">Block this user</a><?php } ?></span></td>
					<td width="21" valign="middle"><img src="img/MiniSubscribe.gif"></td>
					<td><span class="connectLinks"><a href="/subscription_center?<?php if(isset($_SESSION['uid']) && $_SESSION['uid'] != $profile['uid'] && $subscribed->rowCount() > 0) { ?>cancel<?php } else { ?>add_user<?php } ?>=<?php echo htmlspecialchars($profile['username']) ?>"><?php if(isset($_SESSION['uid']) && $profile['uid'] != $_SESSION['uid']) { ?><?php if($subscribed->rowCount() > 0) { echo "Unsubscribe"; } else { echo "Subscribe"; } ?><?php } else { ?>Subscribe<?php } ?></a></span></td>
				</tr>
					
			</table>
			
			<div>&nbsp;</div>
			
		<table class="bulletinTable" cellpadding="0" cellspacing="0" style="border-color:<?php echo $titlecolor ?>">
				<tbody><tr class="profileHeaders">
					<td colspan="3">	<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">My Bulletin Board</div>
<?php if($bulletin2 > 5) { ?>
<div style="float: right; padding-right: 5px"><a href="bulletin_all?user=<?php echo $profile['username'] ?>" style="color:#FFFFFF">View All Bulletins</a>

</div>
<?php } ?>
</td>
				</tr>
				<tr class="bulletinTitle">
					<td align="center" class="bulletinTopFirstCells" valign="top"><span class="profileTitles">From</span></td>
					<td align="center" class="bulletinTopFirstCells" valign="top"><span class="profileTitles">Date</span></td>
					<td align="center" valign="top"><span class="profileTitles">Bulletin</span></td>
				</tr>
                <?php if(!$bulletin) {	?>	
                <!--Begin only show this row if no postings-->
				<tr class="emptyBulletin">
					<td colspan="3" align="center"><span class="profileTitles">There are no bulletins.</span></td>
				</tr>
				<!--End only show this row if no postings-->
                <?php } else { ?>
                <?php foreach($bulletin as $thethingy) { ?>
                <tr class="bulletin">
						<td align="center"><span class="profileTitles"><a href="/profile?user=<?php echo $thethingy['username']; ?>"><?php echo $thethingy['username']; ?></a></span></td>
						<td align="center"><?php echo (new DateTime($thethingy['posted']))->format('m.d.y'); ?>
                        </td>
                        
						<td align="center">
						  <?php if($thethingy['vid'] != null) { ?><img src="/img/tv_icon.gif" class="bulletinSmallImg" align="left"><?php } ?><a href="/bulletin_read?id=<?php echo $thethingy['id']; ?>"><?php echo htmlspecialchars($thethingy['body']); ?></a>
						</td>
				</tr>
                <?php } ?>
                <?php } ?>
			<?php if(isset($_SESSION['uid']) && $profile['uid'] == $session['uid']) { ?>
			     <tr class="bulletinPost">
			             <td colspan="3" align="center"><span class="profileTitles"><a href="bulletin_post">Broadcast a message</a> to all your friends!</span>
			             </td>
			     </tr>	                                     			
				<?php } ?>                                     			
		
		</td>
	           </tbody>
	   </table>	
	  <td width="15" valign="top"></td>
	  <td width="560" valign="top">
			<table class="aboutTable" cellpadding="0" cellspacing="0">
				<tr class="profileHeaders">
					<td>	<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">More About Me</div>
	<div style="float: right; padding-right: 5px"></a>

</td> 
				</tr>
				
				<tr class="rows">
					<td>
        
        <?php if (!empty($profile['about'])) { ?>
                           <div class="spaceMaker">
        <div style="border-bottom: 1px dashed #999999; padding-top:3px; padding-bottom: 3px; overflow: flow; width: 540px">							
							<?php echo nl2br(htmlspecialchars($profile['about'])); ?>						</div>
        </div>
        <?php } ?>

                            <?php if(getsubcount($profile['uid']) > 0) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Subscribers: </span><?php echo getsubcount($profile['uid']); ?>
        <br />
        </div>
        <?php } ?>
                            
                            <?php if (!empty($profile['name'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Name: </span> <?php echo htmlspecialchars($profile['name']); ?><br />
        </div>
        <?php } ?>


                            <?php if ($profile['vids_watched'] != 0) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Videos Watched: </span><?php echo number_format($profile['vids_watched']); ?>
        <br />
        </div>
        <?php } ?>

        <?php if ($profile['profile_views'] != 0) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Profile Viewed: </span><?php echo number_format($profile['profile_views']); ?><br />
        </div>
        <?php } ?>

                            <div class="spaceMaker">
        <span class="profileTitles">Last Login: </span><?php echo timeAgo($profile['lastlogin']); ?>
        <br />
        </div>

                            <div class="spaceMaker">
        <span class="profileTitles">Member Since: </span><?php echo timeAgo($profile['joined']); ?>
        <br />
        </div>

                            <?php if (!empty($profile['website'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Personal Website: </span>
        <a href="<?php echo htmlspecialchars($profile['website']); ?>" target="_blank"><?php echo htmlspecialchars($profile['website']); ?></a><br />
        </div>
        <?php } ?>

        <?php if (!empty($profile['hometown'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Hometown: </span><?php echo htmlspecialchars($profile['hometown']); ?>
        <br />
        </div>
        <?php } ?>

                            <?php if (!empty($profile['city'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Current City: </span><?php echo htmlspecialchars($profile['city']); ?>
        <br />
        </div>
        <?php } ?>

                            <?php if (!empty($profile['occupations'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Occupations: </span><?php echo htmlspecialchars($profile['occupations']); ?>
        <br />
        </div>
        <?php } ?>

                            <?php if (!empty($profile['companies'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Companies: </span><?php echo htmlspecialchars($profile['companies']); ?>
        <br />
        </div>
        <?php } ?>

                            <?php if (!empty($profile['schools'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Schools: </span><?php echo htmlspecialchars($profile['schools']); ?>
        <br />
        </div>
        <?php } ?>

                            <?php if (!empty($profile['hobbies'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Interests &amp; Hobbies: </span><?php echo htmlspecialchars($profile['hobbies']); ?>
        <br />
        </div>
        <?php } ?>

                            <?php if (!empty($profile['fav_media'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Favorite Movies &amp; Shows: </span><?php echo htmlspecialchars($profile['fav_media']); ?>
        <br />
        </div>
        <?php } ?>

                            <?php if (!empty($profile['music'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Favorite Music: </span><?php echo htmlspecialchars ($profile['music']); ?>
        <br />
        </div>
        <?php } ?>

                            <?php if (!empty($profile['books'])) { ?>
                            <div class="spaceMaker">
        <span class="profileTitles">Favorite Books: </span><?php echo htmlspecialchars($profile['books']); ?>
        <br />
        </div>
        <?php } ?>
	
					</td>
				</tr>				
			</table>
			<?php if($thecount > 0) { ?>
			<div>&nbsp;</div>
			
			<!--Begin Insert My Recent Videos Video Bar Here-->

				<table class="aboutTable" cellpadding="0" cellspacing="0">
					<tr class="profileHeaders">
					<td>
							<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">My Recent Videos</div>
	<div style="float: right; padding-right: 5px"><a href='/profile_videos?user=<?php echo htmlspecialchars($profile['username']) ?>' class='edit'>See All Videos</a>

&nbsp;
					</td>
					</tr>
					<tr>
					<td align="center">
							
		<div style="padding-left: 1px;">					
		<table width="21" height="121" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/img/LeftSingleArrowOff.gif" onclick="shiftLeft('profile_videos')" border=0></td>
				<td>
					<table width="500" height="121" cellpadding="0" cellspacing="0">
						<tr>
							<td style="border-bottom:none;">
							<?php for ($i = 0; $i < $thecount; $i++) { ?>
							<div class="videobarthumbnail_block" id="div_profile_videos_<?php echo $i ?>">
								<center>
									<div><a id="href_profile_videos_<?php echo $i ?>" href=".."><img class="videobarthumbnail_white" id="img_profile_videos_<?php echo $i ?>" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_profile_videos_<?php echo $i ?>" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_profile_videos_<?php echo $i ?>" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_profile_videos_<?php echo $i ?>_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<?php } ?>
							</td>
						</tr>
					</table>
				</td>
				<td><img src="/img/RightSingleArrowOff.gif" onclick="shiftRight('profile_videos')" border=0></td>
			</tr>
		</table>
		</div>


					</td>
					</tr>
				</table>

			<!--End Insert My Recent Videos Video Bar Here-->
			<div>&nbsp;</div>
			<?php } ?>
			<?php if($tjecountbutfreiendd > 0 && $thecount < 1) { ?>
			<div>&nbsp;</div>
            <?php } ?>
			<?php if($tjecountbutfreiendd > 0) { ?>
			<!--Begin Insert My Friends Video Bar Here-->
			<table class="aboutTable" cellpadding="0" cellspacing="0">
				<tr class="profileHeaders">
				<td>
						<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">My Friends</div>
	<div style="float: right; padding-right: 5px"><a href='/profile_friends?user=<?php echo htmlspecialchars($profile['username']) ?>' class='edit'>See All Friends</a>

&nbsp;					
				</tr>
				<tr>
				<td  align="center">
						
		<div style="padding-left: 1px;">					
		<table width="21" height="121" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/img/LeftSingleArrowOff.gif" onclick="shiftLeft('recent_friends')" border=0></td>
				<td>
					<table width="500" height="121" cellpadding="0" cellspacing="0">
						<tr>
							<td style="border-bottom:none;">
							<?php for ($i = 0; $i < $tjecountbutfreiendd; $i++) { ?>
							<div class="videobarthumbnail_block" id="div_recent_friends_<?php echo $i ?>">
								<center>
									<div><a id="href_recent_friends_<?php echo $i ?>" href=".."><img class="videobarthumbnail_white" id="img_recent_friends_<?php echo $i ?>" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_recent_friends_<?php echo $i ?>" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_recent_friends_<?php echo $i ?>" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_recent_friends_<?php echo $i ?>_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<?php } ?>
							</td>
						</tr>
					</table>
				</td>
				<td><img src="/img/RightSingleArrowOff.gif" onclick="shiftRight('recent_friends')" border=0></td>
			</tr>
		</table>
		</div>


				</td>
				</tr>
			</table>

			<!--End Insert My Friends Video Bar Here-->
			<div>&nbsp;</div>
            <?php } ?>
            <?php if($tjecountbutfreiendd < 1 && $thecount < 1) { ?>
			<div>&nbsp;</div>
            <?php } ?>
			<table class="commentPostTable" cellpadding="0" cellspacing="0">
				<tbody><tr class="profileHeaders">
					<td colspan="3">	<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">My Comments</div>
	<div style="float: right; padding-right: 5px">

 </div></td>
				</tr>
<?php $index = 0; foreach($comment as $shitter) { $index++; ?>

		
			<tr class="<?php if($index == $commentc) { echo "rowsLineBottom"; } else { echo "rowsLine"; } ?>">
                <td class="leftBg" style="padding-right: 10px" width="123" valign="top" align="center">
            <span class="profileTitles"><a href="/profile?user=<?php echo htmlspecialchars($shitter['username']) ?>"><?php echo htmlspecialchars($shitter['username']) ?></a></span>
            <br>
            <br>
            <a href="/profile?user=<?php echo htmlspecialchars($shitter['username']) ?>"><img src="<?php echo getlatestVideo($shitter['uid']) ?>" class="commentsImg"></a></td>
                <td colspan="2" style="padding-right: 5px" valign="top">
            <span class="profileTitles"><?php echo retroDate($shitter['time']) ?></span> <br>
            <br> <?php if($shitter['vidatt'] != null) { ?>
            <a href="/watch?v=<?php echo $shitter['vidatt']; ?>"><img src="/get_still?video_id=<?php echo $shitter['vidatt']; ?>" class="commentsImg" style="margin-right:3px; margin-left: 5px;"></a>
            <?php } ?><div style="word-wrap: anywhere; width: 400px"><?php echo htmlspecialchars($shitter['message'] )?></div></td></tr>
	
			<?php } ?>
				<tr class="commentsMsg">
						<td colspan="3" align="center"><span class="bulletinPost" style="padding-left: 5px; padding-right: 5px"><a href="/profile_comment_post?user=<?php echo htmlspecialchars($profile['username']); ?>">Leave a comment</a> for <?php echo htmlspecialchars($profile['username']); ?>. The comments you post will be visible to anyone who views <?php echo htmlspecialchars($profile['username']); ?>'s profile. <br></span></td>
				</tr>

				

			</tbody></table>
			
		</td>
	</tr>
</tbody></table>
