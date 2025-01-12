
	<?php if(!isset($session) || ($session['branding'] != 2)) { ?>
<div id="logoDiv"><a href="/"><img src="/img/<?php echo invokethConfig("logo") ?>" width="120" height="48" alt="EpikTube" border="0"></a></div>
<?php } ?>



 

<?php if(isset($session) && ($session['branding'] != 1)) { ?>
<div id="logoDiv"><a href="/"><img src="/img/logo_youtube.gif" width="120" height="48" alt="YouTube" border="0"></a></div>
<?php } ?>
<div id="taglineDiv"><img src="/img/tagline-20pt.gif" alt="Broadcast Yourself"></div>



<div id="utilDiv">
<?php if(isset($session)) { ?>

    <strong>Hello, <a href="/my_profile"><?php echo htmlspecialchars($session['username']) ?></a></strong>
     &nbsp;
    <a href="/my_messages"><img src="/img/icon_mail_<? if($inboxcount > 0) { echo 'on'; } else { echo "off"; } ?>.gif" id="mailico" border="0"></a>&nbsp;(<a href="/my_messages"><?php echo htmlspecialchars($inboxcount) ?></a>)
    <? if ($session['staff'] == 1) {?>
    <span class="utilDelim">|</span>
    <a href="/admin/" class="bold" style="color: #7F48FB;">Admin</a><? } ?>
    <span class="utilDelim">|</span>
    <a href="/logout?next=<?php echo $_SERVER['REQUEST_URI'] ?>">Log Out</a>
    <span class="utilDelim">|</span>
	<a href="/t/help">Help</a>
    <?php } else if(!isset($session)){ ?>
	<a href="/signup"><strong>Sign Up</strong></a>
	<span class="utilDelim">|</span>
	<a href="/login">Log In</a>
	<span class="utilDelim">|</span>
	<a href="/t/help">Help</a>
<?php } ?>
</div>
	<div id="searchDiv">
		<form name="searchForm" id="searchForm" method="GET" action="/results">
			<input tabindex="1" type="text" name="search" maxlength="128" id="searchField" value="<?php if(isset($_REQUEST['search'])) { echo htmlspecialchars(trim($_REQUEST['search'])); }?>">
			<select name="search_type">
			<option value="search_videos" 	
 >Videos</option>
			<option <?php if(isset($_REQUEST['search_type']) && $_REQUEST['search_type'] == "search_users" &&$current_page == "results"  ||  activetab($current_page, $tabs['members']) && $current_page != "results") { echo 'selected=""'; }?>value="search_users"  	
 >Members</option>
		<option <?php if(isset($_REQUEST['search_type']) && $_REQUEST['search_type'] == "search_groups" || activetab($current_page, $tabs['groups'])) { echo 'selected=""'; }?> value="search_groups" 	
 >Groups</option>
			<option <?php if(isset($_REQUEST['search_type']) && $_REQUEST['search_type'] == "search_playlists" && $current_page == "results") { echo 'selected=""'; }?> value="search_playlists" 	
>Playlists</option>
			</select>
			<input type="submit" value="Search">
		</form>
	</div>
<div id="globalNavDiv">
<table width="875" cellspacing="0" cellpadding="0" border="0">
	<tbody><tr>
		<td>
		<table style="<?php if (activetab($current_page, $tabs['home'])) { echo 'background-color: #DDDDDD;  border-bottom: 1px solid #DDDDDD;'; } else { echo "background-color: #BECEEE;"; }?> margin: 5px 2px 0px 0px; " cellspacing="0" cellpadding="0" border="0">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td style="padding-bottom: 5px; font-size: 13px; font-weight: bold; width:134px; text-align:center;"><a href="/index">Home</a></td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
		</tbody></table>
		</td>
		<td>
		<table style="<?php if (activetab($current_page, $tabs['videos'])) { echo 'background-color: #DDDDDD; border-bottom: 1px solid #DDDDDD;'; } else { echo "background-color: #BECEEE;"; }?> margin: 5px 2px 0px 0px; " cellspacing="0" cellpadding="0" border="0">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td style="padding-bottom: 5px; font-size: 13px; font-weight: bold; width:134px; text-align:center;"><a href="/browse">Videos</a></td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
		</tbody></table>
		</td>
		<td>
		<table style="<?php if (activetab($current_page, $tabs['channels'])) { echo 'background-color: #DDDDDD; border-bottom: 1px solid #DDDDDD;'; } else { echo "background-color: #BECEEE;"; }?>margin: 5px 2px 0px 0px;"  cellspacing="0" cellpadding="0" border="0">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td style="padding-bottom: 5px; font-size: 13px; font-weight: bold; width:134px; text-align:center;"><a href="/channels">Channels</a></td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
		</tbody></table>
		</td>
		<td>
		<table style="<?php if (activetab($current_page, $tabs['groups'])) { echo 'background-color: #DDDDDD; border-bottom: 1px solid #DDDDDD;'; } else { echo "background-color: #BECEEE;"; }?> margin: 5px 2px 0px 0px;" cellspacing="0" cellpadding="0" border="0">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td style="padding-bottom: 5px; font-size: 13px; font-weight: bold; width:134px; text-align:center;"><a href="/groups_main">Groups</a></td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
		</tbody></table>
		</td>
		<td>
		<table style="<?php if (isset($_REQUEST['search_type']) && $_REQUEST['search_type'] == "search_users" &&$current_page == "results"  ||  activetab($current_page, $tabs['members']) && $current_page != "results") { echo 'background-color: #DDDDDD; border-bottom: 1px solid #DDDDDD;'; } else { echo "background-color: #BECEEE; "; }?>margin: 5px 2px 0px 0px;" cellspacing="0" cellpadding="0" border="0">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td style="padding-bottom: 5px; font-size: 13px; font-weight: bold; width:134px; text-align:center;"><a href="/members">Members</a></td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
		</tbody></table>
		</td>
		<td>
		<table style="<?php if ($current_page == 'my_videos_upload') { echo 'background-color: #DDDDDD; border-bottom: 1px solid #DDDDDD;'; } else { echo "background-color: #BECEEE;"; }?>  margin: 5px 0px 0px 0px;" cellspacing="0" cellpadding="0" border="0">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td style="padding-bottom: 5px; font-size: 13px; font-weight: bold; width:135px; text-align:center;"><a href="/my_videos_upload">Upload</a></td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
		</tbody></table>
		</td>
	</tr>
	</tbody></table>
</div> <!-- end globalNavDiv -->
<div id="globalSubNavDiv">
<table valign="top" align="center" width="875" bgcolor="#DDDDDD" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 10px;">
	<tr>
		<td><img src="/img/pixel.gif" width="5" height="5"></td>
		<td><img src="/img/pixel.gif" width="1" height="5"></td>
		<td><img src="/img/pixel.gif" width="5" height="5"></td>
	</tr>
	<tr>
		<td><img src="/img/pixel.gif" width="5" height="1"></td>
		<td width="865" align="center" style="padding: 2px;">
	
		<table cellpadding="0" cellspacing="0" border="0">
				<tr>
				<?php if (activetab($current_page, $tabs['home'])) { ?>	
				<td<?php if ($current_page == 'my_videos') { echo ' style="font-weight: bold"'; } ?>><a href="/my_videos">My Videos</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if ($current_page == 'my_favorites') { echo ' style="font-weight: bold"'; } ?>><a href="/my_favorites">My Favorites</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if ($current_page == 'my_messages' || $current_page == 'outbox') { echo ' style="font-weight: bold"'; } ?>><a href="/my_messages">My Messages</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if ($current_page == 'subscription_center' || $current_page == 'my_subscribers') { echo ' style="font-weight: bold"'; } ?>><a href="/subscription_center">My Subscriptions</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
			    <td<?php if ($current_page == 'pl_manager') { echo ' style="font-weight: bold"'; } ?>><a href="/pl_manager">My Playlists</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td><a href="/groups_my">My Groups</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if ($current_page == 'my_profile') { echo ' style="font-weight: bold"'; } ?>><a href="/my_profile">My Profile</a></td>
				<? } else if ($current_page == "results" && isset($_REQUEST['search_type']) && $_REQUEST['search_type'] == "search_users" || activetab($current_page, $tabs['members']) && $current_page != "results") { ?>		
				<td style="font-size: 10px;">&nbsp;</td>
				<td<?php if ($current_page == "profile_comments" || $current_page == "results" && isset($_REQUEST['search_type']) && $_REQUEST['search_type'] == "search_users" || activetab($current_page, $tabs['memberbutton'])) { echo ' style="font-weight: bold"'; } ?>><a href="/members">Members</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if (activetab($current_page, $tabs['my_friends'])) { echo ' style="font-weight: bold"'; } ?>><a href="/my_friends">My Friends</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td><a href="/my_friends_videos">My Friends' Videos</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
			    <td><a href="/my_friends_favorites">My Friends' Favorites</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if ($current_page == 'my_friends_invite') { echo ' style="font-weight: bold"';} ?>><a href="/my_friends_invite">Invite More</a></td>
				<? } else if (activetab($current_page, $tabs['videos'])) { ?>		
				<td<?php if ($current_page == 'browse') { if ((!(isset($_GET['s']))) && empty($_GET['s']) || isset($_GET['s']) && $_GET['s'] == 'mr') { echo ' style="font-weight: bold"'; } } ?>><a href="/browse?s=mr">Most Recent</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if (isset($_GET['s']) && $_GET['s'] == 'mp') { echo ' style="font-weight: bold"'; } ?>><a href="/browse?s=mp">Most Viewed</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if (isset($_GET['s']) && $_GET['s'] == 'md') { echo ' style="font-weight: bold"'; } ?>><a href="/browse?s=md">Most Discussed</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if (isset($_GET['s']) && $_GET['s'] == 'mf') { echo ' style="font-weight: bold"'; } ?>><a href="/browse?s=mf">Top Favorites</a></td>
				  <td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if (isset($_GET['s']) && $_GET['s'] == 'tr') { echo ' style="font-weight: bold"'; } ?>><a href="/browse?s=tr">Top Rated</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if (isset($_GET['s']) && $_GET['s'] == 'rf') { echo ' style="font-weight: bold"'; } ?>><a href="/browse?s=rf">Recently Featured</a></td>
				<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if (isset($_GET['s']) && $_GET['s'] == 'r') { echo ' style="font-weight: bold"'; } ?>><a href="/browse?s=r">Random</a></td>
				<td style="font-size: 10px;">&nbsp;</td>
                <?php } elseif(activetab($current_page, $tabs['groups'])) { ?>
                <td <? if (activetab($current_page, $tabs['groups']) && $current_page != "groups_create") { echo ' style="font-weight: bold"'; } ?>><a href="/groups_main">Browse Groups</a></td>
								<td style="padding: 0px 10px 0px 10px;">|</td>
				<td><a href="/groups_my">My Groups</a></td>
								<td style="padding: 0px 10px 0px 10px;">|</td>
				<td<?php if ($current_page == 'groups_create') { echo ' style="font-weight: bold"'; } ?>><a href="/groups_create">Create Group</a></td>
				<td style="font-size: 10px;">&nbsp;</td>
                <? } else {?>
				<td width="865" align="center">
	
		<table cellspacing="0" cellpadding="0" border="0">
				<tbody><tr>
					<td style="font-size: 10px;">&nbsp;</td>
					<td style="font-size: 10px;">&nbsp;</td>
				</tr>
		</tbody></table>
				
		</td>
				<?php } ?>				
								</tr>
		</table>
				
		</td>
		<td><img src="/img/pixel.gif" width="5" height="1"></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #FFFFFF"><img src="/img/box_login_bl.gif" width="5" height="5"></td>
		<td style="border-bottom: 1px solid #BBBBBB"><img src="/img/pixel.gif" width="1" height="5"></td>
		<td style="border-bottom: 1px solid #FFFFFF"><img src="/img/box_login_br.gif" width="5" height="5"></td>
	</tr>
</table>
</div> <!-- end globalSubNavDiv -->