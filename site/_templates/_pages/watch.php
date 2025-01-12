<script>
function CheckLogin() 
{   <?php if(!isset($_SESSION['uid'])) { ?>
    window.location="login?next=/watch?v=<?php echo htmlspecialchars($video['vid']); ?>";
      	return false;
	<?php } else { ?>
	    return true;
	<?php } ?>
    }
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

	function showCommentReplyForm(form_id, reply_parent_id, is_main_comment_form) {
		if(!CheckLogin()) 
			return false;
		printCommentReplyForm(form_id, reply_parent_id, is_main_comment_form);
	}
	function printCommentReplyForm(form_id, reply_parent_id, is_main_comment_form) {

		var div_id = "div_" + form_id;
		var reply_id = "reply_" + form_id;
		var reply_comment_form = "comment_form" + form_id;
		
		if (is_main_comment_form)
			discard_visible="style='display: none'";
		else
			discard_visible="";
		
		var innerHTMLContent = '\
		<form name="' + reply_comment_form + '" id="' + reply_comment_form + '" method="post" action="/comment_servlet" >\
			<input type="hidden" name="video_id" value="<?php echo $video['vid'] ?>">\
			<input type="hidden" name="add_comment" value="">\
			<input type="hidden" name="form_id" value="' + reply_comment_form + '">\
			<input type="hidden" name="reply_parent_id" value="' + reply_parent_id + '">\
			<input type="hidden" name="comment_type" value="V">\
		<textarea tabindex="2" name="comment" cols="55" rows="3"></textarea>\
			<br>\
			 <?php if(isset($_SESSION['uid'])) { ?>
			 Attach a video: <select name="field_reference_video"><option value="">- Your Videos -</option>				<?php if($videos_of_you !== false) { ?>
			<?php foreach($videos_of_you as $myvideo) { ?><option value="<?php echo htmlspecialchars($myvideo['vid']);?>"><?php echo htmlspecialchars($myvideo['title']);?></option> 				<?php } } ?><option value="">- Your Favorite Videos -</option>			<?php if($favorites_of_you !== false) { ?>
			<?php foreach($favorites_of_you as $myfavorites) { ?><option value="<?php echo htmlspecialchars($myfavorites['vid']);?>"><?php echo htmlspecialchars($myfavorites['title']);?></option> 				<?php } } ?></select><?php } ?>
			<input type="button" name="add_comment_button" \
								value="Post Comment" \
								onclick="postThreadedComment(\'' + reply_comment_form + '\');">\
			<input type="button" name="discard_comment_button"\
								value="Discard" ' + discard_visible + '\
								onclick="hideCommentReplyForm(\'' + form_id + '\',false);">\
		</form></div>';
		if(!is_main_comment_form) {
			toggleVisibility(reply_id, false);
		}
		toggleVisibility(div_id, true);
		setInnerHTML(div_id, innerHTMLContent);
	}
    function addFavorite()
    { getUrl("/add_favorites?video_id=<?php echo htmlspecialchars($video['vid']); ?>", true, execOnSuccess(function() { alert("This video has been added to your favorites."); }));
    }

function openFull() 
{ var fs = window.open( "/watch_fullscreen?video_id=<?php echo htmlspecialchars($video['vid']); ?>&l=<?php echo ceil($video['time']); ?>&fs=1&title=" + "<?php echo htmlspecialchars($video['title']); ?>" ,
           "FullScreenVideo", "toolbar=no,width=" + screen.availWidth  + ",height=" + screen.availHeight 
         + ",status=no,resizable=yes,fullscreen=yes,scrollbars=no");
  fs.focus();
}
<?php if($playlistmode != "related") { ?>
function gotoNext()
{ <?php if($playlistmode == "playlist") { ?>
window.location = "/watch?v=<?php echo $play_schedule['next'] ?>&feature=PlayList&p=<?php echo $playlistinfo['pid'] ?>&index=0&playnext=1";
<?php } elseif($playlistmode != "related" && $play_schedule['next'] != null && $play_schedule2['next'] == null) { ?>
window.location = "/watch?v=<?php echo $play_schedule['next'] ?><?php echo "&amp;feature=". $_GET['feature'] . "&amp;page=". $currentPage + 1 . "&amp;t=". $timeing . "&amp;f=b"; ?>";
<?php } elseif($playlistmode != "related" && $play_schedule['next'] != null  && $play_schedule2['next'] != null) { ?>
window.location = "/watch?v=<?php echo $play_schedule['next'] ?><?php echo "&amp;feature=". $_GET['feature'] . "&amp;page=". $currentPage  . "&amp;t=". $timeing . "&amp;f=b"; ?>";
<?php } elseif($playlistmode != "related" && $play_schedule['next'] == null  && $play_schedule2['next'] == null) { ?>
return true;
<?php } ?>	
}
<?php } ?>
</script>


<!--
<table align="center" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 10px;">
	<tr>
		<form name="searchForm" id="searchForm" method="GET" action="/results">
	 		<td style="padding-right: 5px;"><input tabindex="1" type="text" value="" name="search" maxlength="128" style="color:#ff3333; font-size: 12px; width: 300px;"></td>
			<td>
				<select name="search_type">
				<option value="search_videos"  selected >Search Videos</option>
				<option value="search_users"  >Search Members</option>
				<option value="search_groups" >Search Groups</option>
				<option value="search_playlists" >Search Playlists</option>
				</select>
			</td>
			<td>
				<input type="submit" name="search" value="Search">
			</td>
		</form>
	</tr>
</table>
-->



<table width="790" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td width="510" style="padding-right: 15px;">
	<div style="font-size: 16px; font-weight: bold; color: #333333; padding-left: 22px;"><?php echo htmlspecialchars($video['title']); ?></div>			

		
		

	<div style="text-align: center; padding-bottom: 8px;">
<div id="flashcontent">
			<embed type="application/x-shockwave-flash" src="/player.swf<?php if(isset($_SESSION['uid'])) { echo "?s=".session_id()."&"; } else { echo "?"; } ?>video_id=<?php echo $video['vid'] ?>&l=<?php echo $video['time'] ?><?php if($playlistmode && $play_schedule['next'] != null&& isset($_REQUEST['playnext']) && $_REQUEST['playnext'] == 1) { echo "&playnext=1"; } ?>" id="movie_player" quality="high" height="390" width="470" align="middle">
			</div>
		</div>
</div>
	
		<div style="font-size: 12px; font-weight: bold; text-align: center; padding-bottom: 10px;">
		
				<a <? if(!isset($_SESSION['uid'])) {?>href="signup?r=c&v=<?php echo htmlspecialchars($video['vid']); ?>"<? } else {?> href="#comment" <? } ?>>Post Comments</a>
		&nbsp;&nbsp;//&nbsp;&nbsp; <a <? if(!isset($_SESSION['uid'])) {?>href="signup?r=a&v=<?php echo htmlspecialchars($video['vid']); ?>"<? } else {?> href="#" onClick="return addFavorite();" <? } ?>>Add to Favorites</a>
		&nbsp;&nbsp;//&nbsp;&nbsp; <a <? if(!isset($_SESSION['uid'])) {?>href="signup?r=o&v=<?php echo htmlspecialchars($video['vid']); ?>"<? } else {?> href="#flag" <? } ?>>Flag This Video</a>
        <?php if (isset($_SESSION['uid']) && $uploader['uid'] == $session['uid']) { ?><p>Video Owner Options: <a href="/my_videos_edit?video_id=<?php echo htmlspecialchars($video['vid']); ?>">Edit Your Video Here</a><? } ?>
        <?php if (isset($_SESSION['uid']) && $session['staff'] == 1) { ?><p>Moderation: <a style="color:#f22b33;" href="/admin/feature?video_id=<?php echo htmlspecialchars($video['vid']); ?>"><?php if($really_featured->rowCount() == 1) { echo "Unfeature"; } else { echo "Feature"; } ?> This!</a>&nbsp;&nbsp;//&nbsp;&nbsp;<a style="color:#f22b33;" href="/admin/remove_video?video_id=<?php echo htmlspecialchars($video['vid']); ?>">Remove Video</a>&nbsp;&nbsp;//&nbsp;&nbsp;<a style="color:#f22b33;" href="/age_restrict?v=<?php echo htmlspecialchars($video['vid']); ?><?php if($video['agerestrict'] == 0) { echo"&restrict"; } ?>"><?php if($video['agerestrict'] == 0) { ?>Age Restrict Video<?php } else { echo"Remove Age Restriction"; } ?></a>
        <? } ?>
				</div>
                

		
<table width="400" cellpadding="0" cellspacing="0" border="0" align="center">
			<tr>
				<td style="padding-bottom: 15px;">
								<? if (getRatingCount($video['vid']) > 0) { ?>
										<div style="float:left; margin-left:5em; padding-right: 18px;">
							<span>Average (<? echo htmlspecialchars(getRatingCount($video['vid'])); ?> <? echo (getRatingCount($video['vid'])  == 1) ? 'vote' : 'votes' ?>)</span><br />
								
	<nobr>
                            <? grabRatings($video['vid'], "SM", 0); ?>
							</nobr>
		
						</div><? } ?>

														<div id="ratingDiv" style="<? if (getRatingCount($video['vid']) == 0) { ?> text-align:center; <? } else { ?> float:right; margin-right:5em; <? } ?>">
							<span id="ratingMessage"><?= htmlspecialchars($ratingMessage) ?></span><br />
                            <?  if(isset($rating_error)) { ?>
                            <a href="<? if(!isset($_SESSION['uid'])) { ?>signup.php<? } else { ?>#<? } ?>" style="text-decoration:none;" title="<?= htmlspecialchars($rating_error) ?>">	
	<nobr>
									<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="img/star_bg.gif">
														<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="img/star_bg.gif">
														<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="img/star_bg.gif">
														<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="img/star_bg.gif">
														<img style="border:0px; padding:0px; margin:0px; vertical-align:middle;" src="img/star_bg.gif">
							</nobr>
		
</a>
<? } else {  ?>
														<form style="display:none;" name="ratingForm" action="rating" method="POST">
	<input type="hidden" name="action_add_rating" value="1" />
	<input type="hidden" name="video_id" value="<?php echo htmlspecialchars($video['vid']); ?>">
	<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($session['uid']); ?>">
	<input type="hidden" name="rating" id="rating" value="">
	<input type="hidden" name="size" value="L">
</form>

<script language="javascript">
	ratingComponent = new UTRating('ratingDiv', 5, 'ratingComponent', 'ratingForm', 'ratingMessage');
	ratingComponent.starCount=<?php echo htmlspecialchars($ur_rating); ?>;
			onLoadFunctionList.push(function() { ratingComponent.drawStars(<?php echo htmlspecialchars($ur_rating); ?>, true); });
            
</script>
	
<div>
		<nobr>
			<a href="#" onclick="ratingComponent.setStars(1); return false;" onmouseover="ratingComponent.showStars(1);" onmouseout="ratingComponent.clearStars();"><img src="/img/star_bg.gif" id="star_1" class="rating" style="border: 0px" ></a>
			<a href="#" onclick="ratingComponent.setStars(2); return false;" onmouseover="ratingComponent.showStars(2);" onmouseout="ratingComponent.clearStars();"><img src="/img/star_bg.gif" id="star_2" class="rating" style="border: 0px" ></a>
			<a href="#" onclick="ratingComponent.setStars(3); return false;" onmouseover="ratingComponent.showStars(3);" onmouseout="ratingComponent.clearStars();"><img src="/img/star_bg.gif" id="star_3" class="rating" style="border: 0px" ></a>
			<a href="#" onclick="ratingComponent.setStars(4); return false;" onmouseover="ratingComponent.showStars(4);" onmouseout="ratingComponent.clearStars();"><img src="/img/star_bg.gif" id="star_4" class="rating" style="border: 0px" ></a>
			<a href="#" onclick="ratingComponent.setStars(5); return false;" onmouseover="ratingComponent.showStars(5);" onmouseout="ratingComponent.clearStars();"><img src="/img/star_bg.gif" id="star_5" class="rating" style="border: 0px" ></a>
	</nobr>
									</div>
                                    <? } ?>
					<!-- <br clear="all" />
				</div> -->
						</td>
		</tr>
	</table>
			
	<table width="485" cellpadding="0" cellspacing="0" border="0" align="center">
		<tr>
			<td>
	
			<div class="watchDescription">
			<?php $real_desc = nl2br(htmlspecialchars($video['description']));
            $real_desc = AutoLinkUrls($real_desc);
            echo $real_desc; ?>			</div>
			
			<div style="font-size: 11px; padding-bottom: 18px;">
			Added on <?php echo retroDate($video['uploaded'], "F j, Y, h:i a"); ?> by <a href="profile?user=<?php echo htmlspecialchars($uploader['username']); ?>"><?php echo htmlspecialchars($uploader['username']); ?></a>
			</div>
			
			</td>
		</tr>
	</table>
			
	<table width="485" cellpadding="0" cellspacing="0" border="0" align="center">
		<tr valign="top">
			<td width="245" style="border-right: 1px dotted #AAAAAA; padding-right: 5px;">
			<div style="font-weight: bold; color:#003399; padding-bottom: 7px;">Video Details //</div>
			
			<div style="font-size: 11px; padding-bottom: 10px;">
			Runtime: <?php echo gmdate("i:s", $video['time']); ?> | Views: <?php echo htmlspecialchars($video['views']); ?> | <a href="#comment">Comments</a>: <?php echo number_format($commentc); ?></div>
			
			<div style="padding-bottom: 10px;"><span style="background-color: #FFFFAA; padding: 2px;">Tags:</span>&nbsp; <?php $tags = explode(" ", $video['tags']); $tagCount = count($tags); foreach ($tags as $index => $tag) { echo '<a href="results?search=' . htmlspecialchars($tag) . '">' . htmlspecialchars($tag) . '</a>'; if ($index < $tagCount - 1) { echo ', '; } } ?>
			</div>

			<div style="padding-bottom: 10px;"><span style="background-color: #FFFFAA; padding: 2px;">Channels:</span>&nbsp; 
						<? showChannels($video['vid']); ?>

						</div>			
			<?php if($video['recorddate'] != null ||  $video['address'] != null) { ?>
			<div style="font-size: 11px; padding-bottom: 10px;">
			<?php if($video['recorddate'] != null) { ?>
			Recorded: <?php echo $video['recorddate']; ?><br>
			<?php } ?>
<?php if($video['address'] != null) { ?>
		Location: <a href="http://maps.google.com/maps?t=h&amp;q=<?php echo htmlspecialchars($video['address']) ?> <?php if($video['addrcountry'] != "---") { echo htmlspecialchars($video['addrcountry']); } ?>" target="_blank"><!-- google_ad_section_start --><?php echo htmlspecialchars($video['address']) ?> <?php if($video['addrcountry'] != "---") { echo htmlspecialchars($video['addrcountry']); } ?><!-- google_ad_section_end --></a>
<?php } ?>
	
			</div>
			<?php } ?>
			<td width="240" style="padding-left: 10px;">
			<div style="font-weight: bold; font-size: 12px; color:#003399; padding-bottom: 7px;">User Details //</div>
			
		
			<div style="font-size: 11px; padding-bottom: 10px;">
			<a href="profile_videos?user=<?php echo htmlspecialchars($uploader['username']); ?>">Videos</a>: <?php echo getpublicvideos($uploader['uid']); ?> | <a href="profile_favorites?user=<?php echo htmlspecialchars($uploader['username']); ?>">Favorites</a>: <?php echo getfavoritecount($uploader['uid']) ?> | <a href="profile_friends?user=<?php echo htmlspecialchars($uploader['username']); ?>">Friends</a>: <?php echo getfriendcount($uploader['uid']) ?>
					</div>
			
			<div style="padding-bottom: 10px;">
			<span style="background-color: #FFFFAA; padding: 2px;">User Name:</span>&nbsp; <a href="profile?user=<?php echo htmlspecialchars($uploader['username']); ?>"><?php echo htmlspecialchars($uploader['username']); ?></a>
			</div>
			
			<div style="padding-bottom: 5px;">	
				<img src="/img/SubscribeIcon.gif" align="absmiddle">&nbsp;<a href="/subscription_center?<? if(isset($_SESSION['uid']) && $subscribed->rowCount() > 0) { echo "cancel"; } else { echo "add_user"; } ?>=<?php echo htmlspecialchars($uploader['username']) ?>"><? if(isset($_SESSION['uid']) && $subscribed->rowCount() > 0) { echo "unsubscribe"; } else { echo "subscribe"; } ?></a> <? if(isset($_SESSION['uid']) &&$subscribed->rowCount() > 0) { echo "from"; } else { echo "to"; } ?> <?php echo htmlspecialchars($uploader['username']) ?>'s videos
			</div>
			
			<div style="padding-bottom: 10px;"><?php $isOnline = isUserOnline($uploader['last_act']); if ($isOnline) { echo '<img src="/img/Little_Man.gif" width="15" height="20" align="absmiddle">&nbsp;I am online now!'; } else { echo "I was on the site ". timeAgo($uploader['last_act']) ."."; } ?>
			</div>
			
			<div style="font-weight: bold; padding-bottom: 10px;">
						<a href="<? if(!isset($_SESSION['uid'])) {?>signup?r=o&v=<?php echo htmlspecialchars($video['vid']); } else { ?>outbox?user=<?php echo htmlspecialchars($uploader['username']); } ?>">Send Me a Private Message!</a>
			</div>
		
		</td>
	</tr>
</table>
<br />
		<!-- watchTable -->

		<table width="485" cellpadding="0" cellspacing="0" border="0" align="center" style="table-layout: fixed;">
          <tr>
            <td>
				<form name="linkForm" id="linkForm">
				  <table width="485"  border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;">
                    <tr>
                      <td width="33%">
					  <div align="left" style="font-weight: bold; font-size: 12px; color:#003399; padding-bottom: 7px;">
					  	Share Details // &nbsp;<a href="sharing">Help? </a>
					  </div>					  </td>
                      <td width="67%">&nbsp;</td>
                    </tr>
                    <tr>
                      <td valign="top"><span style="background-color: #FFFFAA; padding: 2px;">Video URL (Permalink):</span><font style="color: #000000;">&nbsp;&nbsp;</font> </td>
                      <td valign="top"><input name="video_link" type="text" onClick="javascript:document.linkForm.video_link.focus();document.linkForm.video_link.select();" value="http://www.epiktube.xyz/?v=<?php echo htmlspecialchars($video['vid']); ?>" style="width: 300px;" readonly="true" style="font-size: 10px;">
                        
                        <div style="font-size: 11px;">(E-mail or link it)<br>
                          <br>
                        </div>                      
					  </td>
                    </tr>
                    <tr>
                      <td valign="top"><span style="background-color: #FFFFAA; padding: 2px;">Embeddable Player:</span><font style="color: #000000;">&nbsp;&nbsp;</font> </td>
                      <td valign="top"><input name="video_play" type="text" onClick="javascript:document.linkForm.video_play.focus();document.linkForm.video_play.select();" value="<object width=&quot;425&quot; height=&quot;350&quot;><param name=&quot;movie&quot; value=&quot;http://www.epiktube.xyz/v/<?php echo $video['vid'] ?>&quot;></param><embed src=&quot;http://www.epiktube.xyz/v/<?php echo $video['vid'] ?>&quot; type=&quot;application/x-shockwave-flash&quot; width=&quot;425&quot; height=&quot;350&quot;></embed></object>" style="width: 300px;" readonly="true" style="font-size: 10px; text-align: center;">
                      <div style="font-size: 11px;">(Put this video on your website. Works on Friendster, eBay, Blogger, MySpace!)<br>
                        <br>
                      </div></td>
                    </tr>
					
							<?php  if ($SITE_LIST->rowCount() != 0) { ?><tr>
								<td colspan="2" valign="top">
								<span style="background-color: #FFFFAA; padding: 2px;">Sites linking to this video:</span>
									<div style="font-size: 11px; padding-bottom: 7px;"></div>
								
								<?php foreach($SITE_LIST as $referer) {
                                   
                    if(!empty($referer['referer'])) {
                
					echo '&#187; <b>'. getlinkedvideocount($video['vid'], $referer['referer']) . ' clicks from </b><a href="r?u='.htmlspecialchars($referer['referer']).'">'.htmlspecialchars($referer['referer']).'</a><br>'."\r\n"; }
				} ?>
							</td>
								</tr><? } ?>	
					
								
              </table>
			</form>
		    </td>
          </tr>
        </table>

		<br>


		<? if($video['comms_allow'] < 1){ ?><div style="padding-bottom: 5px; font-weight: bold; color: #444;">Comments have been disabled for this video.</div><? } else { ?>
		<a name="comment"></a>

		<div style="padding-bottom: 5px; font-weight: bold; color: #444;">Comment on this video:</div>
				<div id="div_main_comment">
				</div>
		</form>
		</div>
 			<? } ?>
	<br>





<div id="recent_comments" <?php if(!($commentc > 10))  { ?>style="display: none"<?php } ?>> 
<table width="495">
<tr>
<td>
	<table class="commentsTitle" width="100%">
	<tr>
		<td>Recent Comments (<?php echo number_format($commentc); ?> total): </td>
	</table>
</td>
</tr>
<tr>
<td>
<?php if($commentc > 10) { ?>
	<?php if($comments !== false) {
				foreach($recent as $comment) { ?>
<a name="<?php echo htmlspecialchars($comment['cid']); ?>">
					<table class="parentSection" id="comment_<?php echo htmlspecialchars($comment['cid']); ?>" width="100%" style="margin-left: 0px">
					<tbody><tr valign="top">
					<? if ($comment['removed'] == 1) { echo '----- Comment deleted by user -----</td>'; } else { ?>
				<?php if($comment['vid'] != null) { ?>
					<td>
							<a href="watch?v=<?php echo htmlspecialchars($comment['vid']); ?>"><img src="/get_still?video_id=<?php echo htmlspecialchars($comment['vid']); ?>" class="commentsThumb" width="60" height="45"></a>
							<div class="commentSpecifics">
								<a href="watch?v=<?php echo htmlspecialchars($comment['vid']); ?>">Related Video</a>
							</div>
						</td>
					<?php } ?>
						<td>
					
		<?= nl2br(htmlspecialsomechars($comment['body'], ['b', 'i', 'big'])) ?> 
							<div class="userStats">
								<? if($comment['termination'] != 1) {?><a href="profile?user=<?php echo htmlspecialchars($comment['username']); ?>"><?php echo htmlspecialchars($comment['username']); ?></a> // <a href="profile_videos?user=<?php echo htmlspecialchars($comment['username']); ?>">Videos</a> (<?php echo getpublicvideos($comment['uid']); ?>) | <a href="profile_favorites?user=<?php echo htmlspecialchars($comment['username']); ?>">Favorites</a> (<?php echo getfavoritecount($comment['uid']) ?>) | <a href="profile_friends?user=<?php echo htmlspecialchars($comment['username']); ?>">Friends</a> (<?php echo getfriendcount($comment['uid']) ?>)<? } ?>
								 - (<?= timeAgo($comment['post_date']); ?>)
	</div>	
			
				 
				  

	</div>

	



							</td>
					</tr>
				</tbody></table>


</a>


<?  }  getReplies($comment['cid'], $video['vid'], $video['uid'], 0, true);   } } ?>
<?php } ?>
</td>
<tr>
				<td><input type="button" id="all_comments_button" value="View All Comments" onclick="load_all_comments('<?php echo $video['vid'] ?>');"></input></td>
			</tr>
</tr>
</table>
</div>

<div id="all_comments" <?php if($commentc > 10)  { ?>style="display: none"<?php } ?>>
<table width="495">
<tr>
<td>
	<table class="commentsTitle" width="100%">
	<tr>
		<td>Comments (<?php echo number_format($commentc); ?>): </td>
	</table>
</td>
</tr>
<tr>
<td>
<div id="all_comments_content">
<?php if($commentc <= 10) { ?>
	<?php if($comments !== false) {
				foreach($comments as $comment) { ?>
<a name="<?php echo htmlspecialchars($comment['cid']); ?>">
					<table class="parentSection" id="comment_<?php echo htmlspecialchars($comment['cid']); ?>" width="100%" style="margin-left: 0px">
					<tbody><tr valign="top">
						<? if ($comment['removed'] == 1) { echo '----- Comment deleted by user -----</td>'; } else { ?>
				<?php if($comment['vid'] != null) { ?>
					<td>
							<a href="watch?v=<?php echo htmlspecialchars($comment['vid']); ?>"><img src="/get_still?video_id=<?php echo htmlspecialchars($comment['vid']); ?>" class="commentsThumb" width="60" height="45"></a>
							<div class="commentSpecifics">
								<a href="watch?v=<?php echo htmlspecialchars($comment['vid']); ?>">Related Video</a>
							</div>
						</td>
					<?php } ?>
						<td>
					
		<?= nl2br(htmlspecialsomechars($comment['body'], ['b', 'i', 'big'])) ?> 
							<div class="userStats">
								<? if($comment['termination'] != 1) {?><a href="profile?user=<?php echo htmlspecialchars($comment['username']); ?>"><?php echo htmlspecialchars($comment['username']); ?></a> // <a href="profile_videos?user=<?php echo htmlspecialchars($comment['username']); ?>">Videos</a> (<?php echo getpublicvideos($comment['uid']); ?>) | <a href="profile_favorites?user=<?php echo htmlspecialchars($comment['username']); ?>">Favorites</a> (<?php echo getfavoritecount($comment['uid']) ?>) | <a href="profile_friends?user=<?php echo htmlspecialchars($comment['username']); ?>">Friends</a> (<?php echo getfriendcount($comment['uid']) ?>)<? } ?>
								 - (<?= timeAgo($comment['post_date']); ?>)
							</div>
					
	<div class="userStats" id="container_comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>" style="display: none"></div>
			<div class="userStats" id="reply_comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>">
				  (<a href="javascript:showCommentReplyForm('comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>', '<?php echo htmlspecialchars($comment['cid']); ?>', false);">Reply to this</a>) &nbsp; 
				  (<a href="javascript:showCommentReplyForm('comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>', '', false);">Create new thread</a>) &nbsp; 
 <?php if (isset($_SESSION['uid']) && $uploader['uid'] == $session['uid'] || isset($_SESSION['uid'])  &&  $session['staff'] == 1 && $comment['uid'] != NULL) { ?>	
		<input type="button" name="remove_comment" id="remove_button_<?php echo htmlspecialchars($comment['cid']); ?>" value="Remove Comment" onclick="removeComment(document.getElementById('remove_comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>'));"> &nbsp; 
	<form name="remove_comment_form" id="remove_comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>">
		<input type="hidden" name="deleter_user_id" value="<?php echo htmlspecialchars($session['uid']); ?>">
		<input type="hidden" name="remove_comment" value="">
			<input type="hidden" name="comment_id" value="<?php echo htmlspecialchars($comment['cid']); ?>">
		<input type="hidden" name="comment_type" value="V">
	</form>
	<? } ?>
	</div>	
<div id="div_comment_form_id_<?php echo htmlspecialchars($comment['cid']); ?>"></div>
			
				  

	</div>

	
	


							</td>
					</tr>
				</tbody></table>


</a>
<? } getReplies($comment['cid'], $video['vid'], $video['uid']);  } } ?>
<?php } ?>
</div>
</td>
</tr>
</table>
</div>
		
		<a name="flag"></a>
		<table width="495" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFEEBB" style="margin-top: 10px;">
			<tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="485" style="padding: 5px 5px 10px 5px; text-align: center;">
				<div style="font-size: 14px; padding-bottom: 5px;">
				Please help keep this site <strong>FUN</strong>, <strong>CLEAN</strong>, and <strong>REAL</strong>.
				</div>
				
				<div style="font-size: 12px;">
				Flag this video:&nbsp;
				<a href="flag_video?v=<?php echo htmlspecialchars($video['vid']); ?>&flag=F">Feature This!</a> &nbsp; 
				<a href="flag_video?v=<?php echo htmlspecialchars($video['vid']); ?>&flag=I">Inappropriate</a>
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
		
		</td>

		<td width="300">


				<div style="padding-bottom: 10px;">
					<table width="300" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEEE">
						<tr>
							<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
							<td><img src="/img/pixel.gif" width="1" height="5"></td>
							<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
						</tr>
						<tr>
							<td><img src="/img/pixel.gif" width="5" height="1"></td>
							<td width="300" style="padding: 5px 0px 5px 0px;">
						
							<table width="300" cellpadding="0" cellspacing="0" border="0">
								<tr>
							<?php if($playlistmode != "related") { ?>
							    	<td align="center"><? if ($play_schedule['before'] != null) { ?>
							    	   <a href="<?php if ($playlistmode == "playlist") {echo '/watch?v=' . htmlspecialchars($play_schedule['before']) . '&feature=PlayList&p=' . $playlistinfo['pid'] . '&index=0';} elseif ($playlistmode != "related" && $play_schedule['before'] != null && $play_schedule2['before'] == null) {echo '/watch?v=' . $play_schedule['before'] . '&feature=' . $_GET['feature'] . '&page=' . ($currentPage - 1) . '&t=' . $timeing . '&f=b';} elseif ($playlistmode != "related" && $play_schedule['before'] != null && $play_schedule2['before'] != null) {echo '/watch?v=' . $play_schedule['before'] . '&feature=' . $_GET['feature'] . '&page=' . $currentPage . '&t=' . $timeing . '&f=b';}?>"><? } ?><img src="<? echo ($play_schedule['before'] === null) ? 'img/no_prev.gif' : '/get_still?video_id=' . $play_schedule['before'] ?>" width="60" height="45" style="border: 5px solid #FFFFFF;"><? if ($play_schedule['before'] != null) { ?></a><? } ?>
										<div style="font-size: 10px; font-weight: bold; padding-top: 3px;"><? if ($play_schedule['before'] != null) { ?><a href="<?php if ($playlistmode == "playlist") {echo '/watch?v=' . htmlspecialchars($play_schedule['before']) . '&feature=PlayList&p=' . $playlistinfo['pid'] . '&index=0';} elseif ($playlistmode != "related" && $play_schedule['before'] != null && $play_schedule2['before'] == null) {echo '/watch?v=' . $play_schedule['before'] . '&feature=' . $_GET['feature'] . '&page=' . ($currentPage - 1) . '&t=' . $timeing . '&f=b';} elseif ($playlistmode != "related" && $play_schedule['before'] != null && $play_schedule2['before'] != null) {echo '/watch?v=' . $play_schedule['before'] . '&feature=' . $_GET['feature'] . '&page=' . $currentPage . '&t=' . $timeing . '&f=b';}?>"><? } ?>&lt; PREV<? if ($play_schedule['before'] != null) { ?></a><? } ?></div></td>
									<td align="center"><img src="/get_still?video_id=<?php echo htmlspecialchars($video['vid']); ?>" width="80" height="60" style="border: 5px solid #FFFFFF;">
										<div style="font-size: 10px; font-weight: bold; padding-top: 3px;">NOW PLAYING</div></td>
									<td align="center"><? if ($play_schedule['next'] != null) { ?><a href="<?php if ($playlistmode == "playlist") {echo '/watch?v=' . htmlspecialchars($play_schedule['next']) . '&feature=PlayList&p=' . $playlistinfo['pid'] . '&index=0';} elseif ($playlistmode != "related" && $play_schedule['next'] != null && $play_schedule2['next'] == null) {echo '/watch?v=' . $play_schedule['next'] . '&feature=' . $_GET['feature'] . '&page=' . ($currentPage + 1) . '&t=' . $timeing . '&f=b';} elseif ($playlistmode != "related" && $play_schedule['next'] != null && $play_schedule2['next'] != null) {echo '/watch?v=' . $play_schedule['next'] . '&feature=' . $_GET['feature'] . '&page=' . $currentPage . '&t=' . $timeing . '&f=b';}?>"><? } ?><img src="<? if ($play_schedule['next'] === null && $play_schedule['before'] === null) {echo 'img/no_next.gif'; } else { echo ($play_schedule['next'] === null) ? 'img/no_next.gif' : '/get_still?video_id=' . $play_schedule['next']; } ?>" width="60" height="45" style="border: 5px solid #FFFFFF;"><? if ($play_schedule['next'] != null) { ?></a><? } ?>
										<div style="font-size: 10px; font-weight: bold; padding-top: 3px;"><? if ($play_schedule['next'] != null) { ?><a href="<?php if ($playlistmode == "playlist") {echo '/watch?v=' . htmlspecialchars($play_schedule['next']) . '&feature=PlayList&p=' . $playlistinfo['pid'] . '&index=0';} elseif ($playlistmode != "related" && $play_schedule['next'] != null && $play_schedule2['next'] == null) {echo '/watch?v=' . $play_schedule['next'] . '&feature=' . $_GET['feature'] . '&page=' . ($currentPage + 1) . '&t=' . $timeing . '&f=b';} elseif ($playlistmode != "related" && $play_schedule['next'] != null && $play_schedule2['next'] != null) {echo '/watch?v=' . $play_schedule['next'] . '&feature=' . $_GET['feature'] . '&page=' . $currentPage . '&t=' . $timeing . '&f=b';}?>"><? } ?>NEXT &gt;<? if ($play_schedule['next'] != null) { ?></a><? } ?></div></td>
					<?php } else { ?>
							<td align="center"><? if ($play_schedule['before'] != null) { ?><a href="watch?v=<? echo htmlspecialchars($play_schedule['before']) ?>"><? } ?><img src="<? echo ($play_schedule['before'] === null) ? 'img/no_prev.gif' : '/get_still?video_id=' . $play_schedule['before'] ?>" width="60" height="45" style="border: 5px solid #FFFFFF;"><? if ($play_schedule['before'] != null) { ?></a><? } ?>
										<div style="font-size: 10px; font-weight: bold; padding-top: 3px;"><? if ($play_schedule['before'] != null) { ?><a href="watch?v=<? echo htmlspecialchars($play_schedule['before']) ?>"><? } ?>&lt; PREV<? if ($play_schedule['before'] != null) { ?></a><? } ?></div></td>
								 <td align="center"><img src="/get_still?video_id=<?php echo htmlspecialchars($video['vid']); ?>" width="80" height="60" style="border: 5px solid #FFFFFF;">
										<div style="font-size: 10px; font-weight: bold; padding-top: 3px;">NOW PLAYING</div></td>
								<td align="center"><? if ($play_schedule['next'] != null) { ?><a href="watch?v=<? echo htmlspecialchars($play_schedule['next']) ?>"><? } ?><img src="<? if ($play_schedule['next'] === null && $play_schedule['before'] === null) {echo 'img/no_next.gif'; } else { echo ($play_schedule['next'] === null) ? 'img/no_next.gif' : '/get_still?video_id=' . $play_schedule['next']; } ?>" width="60" height="45" style="border: 5px solid #FFFFFF;"><? if ($play_schedule['next'] != null) { ?></a><? } ?>
									<div style="font-size: 10px; font-weight: bold; padding-top: 3px;"><? if ($play_schedule['next'] != null) { ?><a href="watch?v=<? echo htmlspecialchars($play_schedule['next']) ?>"><? } ?>NEXT &gt;<? if ($play_schedule['next'] != null) { ?></a><? } ?></div></td>
					<?php } ?>
									</tr>
				</table>
								
					</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				</tr>
				<tr>
				<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>
		</div>
							
<table width="300" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">

				<tr>
					<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
					<td><img src="/img/pixel.gif" width="1" height="5"></td>
					<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
				</tr>
				<tr>
					<td><img src="/img/pixel.gif" width="5" height="1"></td>
					<td width="290">
					<div class="moduleTitleBar">
					<table width="<?php if($playlistmode != "related") { ?>300<?php } else { ?>290<?php } ?>" cellpadding="0" cellspacing="0" border="0">
						<tr valign="top">
                 	<?php if($playlistmode != "related") { ?>
						<td><div class="moduleFrameBarTitle">
						    
						    <a href="<?php if($playlistmode == "playlist") { ?>/view_play_list?p=<?php echo htmlspecialchars($playlistinfo['pid']) ?><?php } elseif($playlistmode != "related") { echo "/browse?s=" . $thelinkingto . "&amp;&amp;t=". $timeing . "&amp;f=b&amp;page=" . $currentPage; } ?>" target="_parent"><?php if($playlistmode == "playlist") { ?>PlayList // <?php echo htmlspecialchars($playlistinfo['title']) ?><?php } elseif($playlistmode != "related") { echo $titlethingying; } ?></a> <?php if($playlistmode == "playlist") { ?>1-<?php echo number_format($related_vid_count) ?> of <?php echo number_format($related_vid_count) ?><?php } else { ?><?php if ($offset > 0) { echo htmlspecialchars(trim($offset)); } else { echo "1"; } ?>-<? $nextynexty = $offset + $howmanyvids; echo htmlspecialchars($nextynexty); ?> of <?php echo number_format($related_vid_count) ?><?php } ?></div></td><td align="right"><div style="font-size: 11px; margin-right: 5px;"><div id="playall" style="display:<?php if(isset($_GET['playnext']) && $_GET['playnext'] == 1) { echo "none"; } else { echo"block"; } ?>"><a href="javascript:autoNext()"><img src="/img/play_all.gif" border="0" align="absmiddle"></a>&nbsp;<a href="/watch?v=<?php echo $_GET['v'] ?><?php if($playlistmode == "playlist") { ?>&feature=PlayList&p=<?php echo $playlistinfo['pid'] ?>&playnext=1&index=0<?php } elseif($playlistmode != "related") { echo "&amp;feature=". $_GET['feature'] . "&amp;page=". $currentPage . "&amp;t=". $timeing . "&amp;f=b&playnext=1"; } ?>">Play all</a></div><div id="playingall" style="display:<?php if(isset($_GET['playnext']) && $_GET['playnext'] == 1) { echo "block"; } else { echo"none"; } ?>"><img src="/img/play_all_press.gif" align="absmiddle"> Playing all</div></td>
							<?php } else { ?>
							<td><div class="moduleFrameBarTitle">Related Videos (<? if ($related_vid_count > $howmanyrelatedresults) { echo "$howmanyrelatedresults of "; } else { echo htmlspecialchars($related_vid_count)." of "; } echo htmlspecialchars($related_vid_count); ?>)</div></td>
							<td align="right"><div style="font-size: 11px; margin-right: 5px;"><a href="/results?related=<?php echo urlencode(htmlspecialchars($video['tags'])); ?>" target="_parent">See All Results</a></div></td>
						<?php } ?>
						</tr>
					</table>
					</div>
	
							<div id="side_results" name="side_results"<?php if($playlistmode != "related") { ?> style="width: 303px; height: 350px; overflow: auto;" onscroll="render_full_side();"<?php } ?>>				<?php foreach($relatedq as $related) {

    if ($video['vid'] == $related['vid']) {
        $moduleEntry = "moduleFrameEntrySelected";
    } else {
        $moduleEntry = "moduleFrameEntry";
    }
?>


<div class="<?php echo $moduleEntry ?>">
						<table width="235" cellpadding="0" cellspacing="0" border="0">
							<tr valign="top">
								<td width="90">
									<a href="/watch?v=<?php echo htmlspecialchars($related['vid']) ?><?php if($playlistmode == "playlist") { ?>&feature=PlayList&p=<?php echo $playlistinfo['pid'] ?>&index=0<?php } elseif($playlistmode != "related") { echo "&amp;feature=". $_GET['feature'] . "&amp;page=". $currentPage . "&amp;t=". $timeing . "&amp;f=b"; } else { ?><?php echo htmlspecialchars($related['vid']); ?>&amp;search=<?php echo urlencode(htmlspecialchars($video['tags'])); ?><?php } ?>" class="bold" target="_parent"><img src="/get_still?video_id=<?php echo htmlspecialchars($related['vid']); ?>" class="moduleEntryThumb" width="80" height="60"></a></td>
								<td>
									<div class="moduleFrameTitle"><a href="/watch?v=<?php echo htmlspecialchars($related['vid']) ?><?php if($playlistmode == "playlist") { ?>&feature=PlayList&p=<?php echo $playlistinfo['pid'] ?>&index=0<?php } elseif($playlistmode != "related") { echo "&amp;feature=". $_GET['feature'] . "&amp;page=". $currentPage . "&amp;t=". $timeing . "&amp;f=b"; } else { ?>/watch?v=<?php echo htmlspecialchars($related['vid']); ?>&amp;search=<?php echo urlencode(htmlspecialchars($video['tags'])); ?><?php } ?>" target="_parent"><?php echo htmlspecialchars($related['title']); ?></a></div>
									<div class="moduleFrameDetails">
										by <a href="/profile?user=<?php echo htmlspecialchars($related['username']); ?>" target="_parent"><?php echo htmlspecialchars($related['username']); ?></a>
									</div>
									<div class="moduleFrameDetails">
										Runtime:<?php echo gmdate("i:s", $related['time']); ?><br>
										Views: <?php echo number_format($related['views']); ?><br>
										Comments: <?php echo getcommentcount($related['vid']); ?>
									</div>
		                            <?php if($moduleEntry == "moduleFrameEntrySelected") {?>
                                    <div style="font-size: 10px; font-weight:bold; color: #CC6600; padding: 3px 6px; background-color:#FFCC66;"><nobr>&lt;&lt;&lt; NOW PLAYING!</nobr></div>
                                    <?php } ?>
								</td>
							</tr>
						</table>
					</div>
<?php } ?>
<?php if($playlistmode != "related") { ?>
<div class="moduleFrameEntry">
	<table width="235" cellspacing="0" cellpadding="0" border="0">
		<tbody>
		    <tr valign="top" align="center">
				<td>
				    <a href="<?php if($playlistmode == "playlist") { ?>/view_play_list?p=<?php echo htmlspecialchars($playlistinfo['pid']) ?><?php } elseif($playlistmode != "related") { echo "/browse?s=" . $thelinkingto . "&amp;&amp;t=". $timeing . "&amp;f=b&amp;page=" . $currentPage; } ?>">See All Results</a></td>
			</tr>
				</tbody></table>
</div>
<?php } else { ?>			
<?php if($related_vid_count > 4) { ?>
<div class="moduleFrameEntry">
						<table width="235" cellspacing="0" cellpadding="0" border="0">
							<tbody><tr valign="top" align="center">
								<td><a href="results?related=<?php echo urlencode(htmlspecialchars($video['tags'])); ?>">See All Results</a></td>
							</tr>
						</tbody></table>
					</div>
<?php } ?>				
<?php } ?>				
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
		

		
		<? if(!empty($video_honors)) { ?>
		<div style="font-weight: bold; color: #333; margin: 10px 0px 5px 0px;">Honors:</div><? foreach ($video_honors as $honor) {
        echo '<div style="padding: 0px 0px 5px 0px; color: #999;">» <a href="/browse?' . htmlspecialchars($honor["url"]) . '">' . htmlspecialchars($honor["honor"]) . '</a></div>';
        } ?>		
        <? } ?>
						


		
		<div style="font-weight: bold; color: #333; margin: 10px 0px 5px 0px;">Related Tags:</div>
	<?php foreach($related_tags as $tag) { ?>
    <div style="padding: 0px 0px 5px 0px; color: #999;">&#187; <a href="results?search=<?php echo htmlspecialchars($tag); ?>"><?php echo htmlspecialchars($tag); ?></a></div>
<?php } ?>
	<?php if($check) { ?>
		<div style="font-weight: bold; color: #333; margin: 10px 0px 5px 0px;">Playlists:</div>

	<?php foreach($check as $playisting) { ?>
			<div style="padding: 0px 0px 5px 0px; color: #999;">&#187; <a href="view_play_list?p=<?php echo htmlspecialchars($playisting['pid']); ?>"><?php echo htmlspecialchars($playisting['title']); ?></a></div>
			<?php } ?>	
<?php } ?>
		</td>
	</tr>
</table>