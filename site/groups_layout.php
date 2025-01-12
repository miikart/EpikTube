<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/needed/scripts.php";
$group = $conn->prepare("SELECT * FROM groups JOIN users u ON groups.uid = u.uid  WHERE url = :url AND u.termination = 0");
$group->bindParam(":url", $_REQUEST['gid']);
$group->execute();
$group = $group->fetch();
if(!$group) {
session_error_index("Group not found.");
} else {
$recentmembers = $conn->prepare("SELECT g.*, u.* 
                                 FROM group_members g 
                                 JOIN users u ON g.uid = u.uid  
                                 WHERE g.gid = :gid 
                                 AND g.pending = 0
                                 AND u.termination = 0 
                                 ORDER BY g.joined DESC 
                                 LIMIT 10");
$recentmembers->bindParam(":gid", $group['gid']);
$recentmembers->execute();
$recentmembers = $recentmembers->fetchAll();
$status = null;
if(isset($_SESSION['uid'])) {
$isingroup = $conn->prepare("SELECT * FROM group_members WHERE uid = :uid");
$isingroup->bindParam(":uid", $session['uid']);
$isingroup->execute();
$isingroup = $isingroup->fetch();
if($isingroup["pending"] == 1) {
$status = "Pending";
} elseif($isingroup['uid'] == $session['uid']) {
$status = "Owner";
} elseif($isingroup["pending"] == 0) {
$status = "Member";
}
}
}
$_PAGE['Page'] = "groups_layout";
require_once $_SERVER['DOCUMENT_ROOT'] . "/_templates/_structures/main.php";
?>

<div class="tableSubTitle">Group // <a href="/group/<?php echo htmlspecialchars($group['url']); ?>"><?php echo htmlspecialchars($group['title']); ?> </a>
</div>

		<table class="roundedTable" width="720" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#EFEFEF">
			<tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="710">
						<br/>
		
		<div style="padding-left: 10px; padding-right: 10px;">
		<table width="708px" height="28" cellpadding="0" cellspacing="0" border="0" background="/img/LongGenericTab.jpg">
			<tr>
				<td align="left">
					<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;"><?php echo htmlspecialchars($group['title']); ?></span>
				</td>
				<td align="right">
					
				</td>
			</tr>
		</table>
		</div>

		<div style="padding-left: 10px;">					
		<table width="708" height="121" style="background-color: #FFFFFF; border-left: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;" cellpadding="0" cellspacing="0">
			<tr>
				<td>
						<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
			<td valign="top" width="100" style="padding-top: 5px; padding-left: 5px">
				<img src="http://static12.youtube.com/vi/9flkGBY-6h0/2.jpg"/>


				<div align="center" style="padding-top: 5px; padding-bottom: 5px">
				</span>
			</td>
		<td valign="top" width = "600" style="padding-top: 5px; padding-left: 5px;">
			<table width="100%"><tr><td>
			<div style="border-bottom: 1px dashed #999999; padding-top:3px; padding-bottom: 3px; overflow: flow; width: 550px">
			<?php echo nl2br(htmlspecialchars($group['description'])); ?>
			</div>
			</td></tr>
			</table>
			
			<table width="100%"><tr><td>
			<div style="padding-top: 3px; padding-bottom: 5px; padding-left: 3px;">
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666; pading-bottom: 3px; padding-right: 3px;">Tags:</span> <?php 
$tags = explode(" ", $group['tags']);
$thelast = end($tags);
foreach ($tags as $tag) {
    echo htmlspecialchars($tag);
    if ($tag !== $thelast) {
        echo ', ';
    }
}
?>
				<br />
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666; pading-bottom: 3px; padding-right: 3px;">Channels:</span> 		<?php echo showGroupChannels($group['url']); ?>


				<br />
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666; pading-bottom: 3px; padding-right: 3px;">Type:</span> Public
				<br />
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666; pading-bottom: 3px; padding-right: 3px;">Videos:</span> <a href="/groups_videos?name=<?php echo $group['username'] ?>">0</a>
				<br />
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666; pading-bottom: 3px; padding-right: 3px;">Members:</span> <a href="/groups_members?name=<?php echo $group['username'] ?>"><?php echo getgroupmembers($group['gid']) ?></a>
				<br />
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666; pading-bottom: 3px; padding-right: 3px;">Created By:</span> <a href="/profile?user=<?php echo $group['username'] ?>"><?php echo $group['username'] ?></a>
				<br />
		        <?php if(isset($_SESSION['uid']) && $status != null) { ?>
		        <span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666; pading-bottom: 3px; padding-right: 3px;">Membership Status:</span><?php echo $status ?>
		        <br/>
		        <?php  } ?>
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #666666; pading-bottom: 3px; padding-right: 3px;">Group URL:</span> <a href="/group/<?php echo htmlspecialchars($group['url']) ?>">http://www.epiktube.xyz/group/<?php echo htmlspecialchars($group['url']) ?></a>

				<br />
			</div>
			</td>
			<?php if($status == "Member" ||  $status == "Pending") { ?>
			<td >
			
				<div align="centre">
				<form method="post" action="/groups_layout" name="join_form">
					<input type="hidden" value="IndieFoodChannel" name="name">
					<input type="hidden" value="join" name="join">
				
					<div style="padding-right: 10px">
						
							<table class="roundedTable" width="140" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffeebb">
			<tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
	
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="130">
					<div style='font-size: 14px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;'><a href='javascript: document.join_form.submit();'><?php if($status == "Member" || $status == "Pending") { ?>Leave this Group<?php } else { ?>Join this Group<?php } ?>
					    </a>
				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>

			<tr>
				<td valign="bottom"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td valign="bottom"><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>

					</div>
				</form>
				</div>
			</td>
			<?php } ?>	
			</tr></table>
		</td>
	</tr>
	</table>

				</td>
			</tr>
		</table>
		</div>

	<br/>
		<div style="padding-left: 10px; padding-right: 10px;">
		<table width="708px" height="28" cellpadding="0" cellspacing="0" border="0" background="/img/LongGenericTab.jpg">
			<tr>
				<td align="left">
					<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">Forum Messages</span>
				</td>
				<td align="right">
						<td align="right" colspan="2">
		<div style="font-weight: bold; color: #444444; margin-right: 5px;">
			Topics 1 - 0 of 0
		</div>
	</td>

				</td>
			</tr>
		</table>
		</div>

		<div style="padding-left: 10px;">					
		<table width="708" height="121" style="background-color: #FFFFFF; border-left: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;" cellpadding="0" cellspacing="0">
			<tr>
				<td>
							<form name="topics_form" method="post" action="/groups_layout">
		<input type="hidden" name="topics_form"/>
	
	<div style="PADDING-LEFT: 5px; FONT-WEIGHT: bold; PADDING-BOTTOM: 5px; COLOR: #444; PADDING-TOP: 8px" align="center">
        There are no topics for this group!</div>
        <?php if($status != "Member" && $status != "Owner" && $status != "Pending") { ?>
        <br><br><br><br>
		<?php } ?>
		</form>
		<?php if(!isset($_SESSION['uid'])) { ?>
		<div align="center" style="padding-left: 5px; padding-top: 8px;padding-bottom: 5px; font-weight: bold; color: #444;">Please <a href="/signup?next=/group/<?php echo htmlspecialchars($group['title']) ?>">login</a> to post a topic.</div>
	<?php } elseif($status == "Member" || $status == "Owner") { ?>
	 <DIV style="PADDING-LEFT: 5px; FONT-WEIGHT: bold; PADDING-BOTTOM: 5px; COLOR: #444; PADDING-TOP: 8px">
                        Add New Topic:</DIV>
                        <DIV style="PADDING-LEFT: 5px; PADDING-BOTTOM: 5px">

                        <FORM name=add_group_topic action="groups_layout.php?gid=<?php echo htmlspecialchars($group['title']) ?>" method=post>
                        <TEXTAREA tabIndex=2 name=topic_title rows=3 cols=55></TEXTAREA>
                        <BR>Attach a video:
                        <SELECT name=topic_video>
                                
                        </SELECT>
                        <input type=hidden name=GID value=2>
                        <INPUT type=submit value="Add Topic" name=add_topic>
                        </FORM>
                        </DIV>
	<?php } ?>

				</td>
			</tr>
		</table>
		</div>

		<br/>
				<!--Begin Group Members Horizontal Scrolling Box-->
					
		
	<div style="padding-left: 10px; padding-right: 10px;">
	<table width="648" height="28" cellpadding="0" cellspacing="0" border="0" background="/img/648Tab.jpg">
		<tr>
			<td width="430px">
				<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">Recently Added Videos</span>
				<span style="font-size: 10px; color: #999999;"><span id="counter_group_videos"></span>
			</td>
			<td align="left">		
					<span style="font-size: 13px; color: #6D6D6D;"><span></span>
			</td>	
			<td align="right">	
				<span style="padding-right: 10px; padding-left: 10px; nowrap"><img src="/img/icon_todo.gif" border="0" width="23" height="14" style="padding-right: 5px; vertical-align: middle;">
						<a href="/groups_videos?name=IndieFoodChannel">View All Videos</a>
				</span>
			</td>
		</tr>
	</table>
	</div>

	
				
		<div style="padding-left: 1px;">					
		<table width="21" height="121" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/img/LeftTableArrow.gif" onclick="shiftLeft('group_videos')" border=0></td>
				<td>
					<table width="625" height="121" style="background-color: #FFFFFF; border-bottom: 1px solid #CCCCCC;" cellpadding="0" cellspacing="0">
						<tr>
							<td   style="border-bottom:none;">
							<div class="videobarthumbnail_block" id="div_group_videos_0">
								<center>
									<div><a id="href_group_videos_0" href=".."><img class="videobarthumbnail_white" id="img_group_videos_0" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_group_videos_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_group_videos_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_videos_0_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_videos_1">
								<center>
									<div><a id="href_group_videos_1" href=".."><img class="videobarthumbnail_white" id="img_group_videos_1" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_group_videos_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_group_videos_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_videos_1_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_videos_2">
								<center>
									<div><a id="href_group_videos_2" href=".."><img class="videobarthumbnail_white" id="img_group_videos_2" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_group_videos_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_group_videos_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_videos_2_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_videos_3">
								<center>
									<div><a id="href_group_videos_3" href=".."><img class="videobarthumbnail_white" id="img_group_videos_3" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_group_videos_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_group_videos_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_videos_3_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_videos_4">
								<center>
									<div><a id="href_group_videos_4" href=".."><img class="videobarthumbnail_white" id="img_group_videos_4" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_group_videos_4" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_group_videos_4" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_videos_4_alternate" style="display: none">
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
				<td><img src="/img/RightTableArrow.gif" onclick="shiftRight('group_videos')" border=0></td>
			</tr>
		</table>
		</div>



		<br/>
					
<?php if(getgroupmembers($group['gid']) > 0) { ?>	
	<div style="padding-left: 10px; padding-right: 10px;">
	<table width="648" height="28" cellpadding="0" cellspacing="0" border="0" background="/img/648Tab.jpg">
		<tr>
			<td width="430px">
				<span style="padding-left: 5px; font-size: 13px; color: #6D6D6D; font-weight: bold; padding-right: 5px;">Recent Members</span>
				<span style="font-size: 10px; color: #999999;"><span id="counter_group_members"></span>
			</td>
			<td align="left">		
					<span style="font-size: 13px; color: #6D6D6D;"><span></span>
			</td>	
			<td align="right">	
				<span style="padding-right: 10px; padding-left: 10px; nowrap"><img src="/img/icon_todo.gif" border="0" width="23" height="14" style="padding-right: 5px; vertical-align: middle;">
						<a href="/groups_members?name=IndieFoodChannel">View all Members</a>
				</span>
			</td>
		</tr>
	</table>
	</div>

	
				
		<div style="padding-left: 1px;">					
		<table width="21" height="121" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/img/LeftTableArrow.gif" onclick="shiftLeft('group_members')" border=0></td>
				<td>
					<table width="625" height="121" style="background-color: #FFFFFF; border-bottom: 1px solid #CCCCCC;" cellpadding="0" cellspacing="0">
						<tr>
							<td   style="border-bottom:none;">
							<div class="videobarthumbnail_block" id="div_group_members_0">
								<center>
									<div><a id="href_group_members_0" href=".."><img class="videobarthumbnail_white" id="img_group_members_0" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_group_members_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_group_members_0" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_members_0_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_members_1">
								<center>
									<div><a id="href_group_members_1" href=".."><img class="videobarthumbnail_white" id="img_group_members_1" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_group_members_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_group_members_1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_members_1_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_members_2">
								<center>
									<div><a id="href_group_members_2" href=".."><img class="videobarthumbnail_white" id="img_group_members_2" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_group_members_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_group_members_2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_members_2_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_members_3">
								<center>
									<div><a id="href_group_members_3" href=".."><img class="videobarthumbnail_white" id="img_group_members_3" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_group_members_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_group_members_3" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_members_3_alternate" style="display: none">
								<center>
									<div><img src="/img/pixel.gif" width="80" height="60"></div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
									<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_members_4">
								<center>
									<div><a id="href_group_members_4" href=".."><img class="videobarthumbnail_white" id="img_group_members_4" src="/img/pixel.gif" width="80" height="60"></a></div>
									<div id = "title1_group_members_4" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">loading...</div>
									<div id = "title2_group_members_4" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-color: #666666; padding-bottom: 3px;">&nbsp;</div>
								</center>
							</div>
							<div class="videobarthumbnail_block" id="div_group_members_4_alternate" style="display: none">
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
				<td><img src="/img/RightTableArrow.gif" onclick="shiftRight('group_members')" border=0></td>
			</tr>
		</table>
		</div>




		<br/>
<?php } ?>

				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td valign="bottom"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td valign="bottom"><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>

	<table width="495" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFEEBB" style="margin-top: 10px;">
	  <tr>
		<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
		<td><img src="/img/pixel.gif" width="1" height="5"></td>
		<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
	  </tr>
	  <tr>
		<td><img src="/img/pixel.gif" width="5" height="1"></td>
		<td width="485" style="padding: 5px 5px 10px 5px; text-align: center;">
				<div style="font-size: 14px; padding-bottom: 5px;">
					Please help keep this site <strong>FUN</strong>, <strong>CLEAN</strong>, and <strong>REAL</strong>.
				</div>
				<div style="font-size: 12px;">
					Flag this Group: &nbsp;
					<a href='/groups_flag?id=k1JbOlbe3iY&flag=feature'>Feature This!</a> &nbsp;
					<a href='/groups_flag?id=k1JbOlbe3iY&flag=inappropriate'>Inappropriate</a> &nbsp;
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
<?php require_once "needed/end.php"; ?>