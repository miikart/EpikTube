<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html>
<head>
	
	<?php if($current_page != "watch") { ?><title>EpikTube - Broadcast Yourself.</title>
	<?php } else { ?><title>EpikTube - <?php echo htmlspecialchars($video['title']) ?></title>
	<?php } ?>
  
	<link rel="stylesheet" href="/styles" type="text/css">
	<link rel="stylesheet" href="/base.css" type="text/css">
    <?php // echo '<script src="/js/snow.js?v=' . rand() . '"></script>'?>

	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<?php if($current_page == "watch") { ?><meta name="title" content="<?php echo htmlspecialchars($video['title']) ?>">
	<?php } ?>

    <meta name="description" content="<?php if($current_page != "watch") { ?>Share your videos with friends and family<?php } else { ?><?php echo htmlspecialchars($video['description']); } ?>">
	<meta name="keywords" content="<?php if($current_page != "watch") { ?>video,sharing,camera phone,video phone<?php } else { ?><?php $tags = explode(" ", $video['tags']); $thelast = end($tags); foreach ($tags as $tag) {echo htmlspecialchars($tag); if ($tag !== $thelast) { echo ', '; } } } ?>">

	<link rel="alternate" title="EpikTube - [RSS]" href="/rssls">
	
	<script language="javascript" type="text/javascript">
		onLoadFunctionList = new Array();
		function performOnLoadFunctions()
		{
			for (var i in onLoadFunctionList)
			{
				onLoadFunctionList[i]();
			}
		}
	</script>

<?php if ($current_page == 'watch') { ?>
 	        <script type="text/javascript" src="/flashobject.js"></script>
	    <script type="text/javascript" src="/js/components.js"></script>
	    <script type="text/javascript" src="/js/AJAX.js"></script>
	    <script type="text/javascript" src="/js/ui.js"></script>
	    <script type="text/javascript" src="/js/comments.js"></script>
	    <script type="text/javascript" src="/ruffle/ruffle.js"></script>
<? } ?>
        
        <?php if($current_page == "watch") { ?>
<script language="javascript" type="text/javascript">
		function dropdown_jumpto(x)
		{
			if (document.share_dropdown.jumpmenu.value != "null")
			{
				document.location.href = x;
			}
		}
			
			onLoadFunctionList.push(function() { printCommentReplyForm('main_comment', '', true) } );
		</script>
	    <?php } elseif($current_page == "groups_layout") { ?>

	<script type="text/javascript" src="/js/video_bar.js"></script>
	

	<script language="JavaScript">
			<?php if(getgroupmembers($group['gid']) > 0) { ?>
			onLoadFunctionList.push(function() { imagesInit_group_members();} );

		function imagesInit_group_members() {
			imageBrowsers['group_members'] = new ImageBrowser(5, 1, "group_members");
				<?php foreach($recentmembers as $members) { ?>
				imageBrowsers['group_members'].addImage(new etImage("<?php echo getlatestvideo($members['uid']) ?>", 
													  "/profile?user=<?php echo htmlspecialchars($members['username']) ?>",
													  "<?php echo htmlspecialchars($members['username']) ?>", 
													  "/profile?user=<?php echo htmlspecialchars($members['username']) ?>",
													  "",
													  "",
													  false) );
<?php } ?>
			imageBrowsers['group_members'].initDisplay();
			imageBrowsers['group_members'].showImages();
			images_loaded = true;
		}
<?php } ?>
	
	
	
	function checkAll(formObj, is_checked) 
	{
		for (var i=0;i < formObj.length;i++) {
			fldObj = formObj.elements[i];
			if (fldObj.type == 'checkbox') {
				fldObj.checked = is_checked;
			}
		}
	}
	function resetCheckAllValue(formObj, is_checked) {
		if(!is_checked) {
			main_checkbox = document.getElementById("checkall_checkbox");
			main_checkbox.checked = false;
		}
	}
	function confirmSubmit()
	{
		var agree=confirm("Are you sure you wish to continue?");
		if (agree)
			return true ;
		else
			return false ;
	}

	</script>
<?php } elseif($current_page == "profile" || $current_page == "profile_comments" || $current_page == "bulletin_all" || $current_page == "bulletin_read" || $current_page == "bulletin_post" || $current_page == "profile_comment_post") {
switch($current_page) {
case "profile_comment_post";
$q = $conn->prepare('SELECT * FROM users WHERE username = :id');
$q->bindParam(':id', $_GET['user'], PDO::PARAM_STR);
$q->execute();
$theshit = $q->fetch();
if(!$theshit) {
    session_error_index("User not found.", "error");
    exit;
} else {
$profile = $theshit;
}
break;
case "bulletin_post";
$profile = $session;
break;
case "bulletin_read";
$thebull = $conn->prepare("SELECT b.*, u.*
FROM bulletins b
JOIN users u ON b.uid = u.uid
WHERE b.id = :id
AND u.termination = 0;");
$thebull->bindParam(":id", $_GET['id']);
$thebull->execute();
$thebull = $thebull->fetch();
if(!$thebull) {
session_error_index("Bulletin not found.", "error");
} else {
$profile = $conn->prepare("SELECT * FROM users WHERE uid = :id AND termination = 0");
$profile->bindParam(":id", $thebull['uid']);
$profile->execute();
$profile = $profile->fetch();
}
break;
default:
$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ?");
$profile->execute([$_GET['user']]);
if($profile->rowCount() == 0) {
    if(empty($_GET['user'])) {
	redirect("index_down.php");
    } else {
    session_error_index("Invalid username", "error");
    }
} else {
	$profile = $profile->fetch(PDO::FETCH_ASSOC);
}
break;
}

require_once "profilecss.php"; 
 
} 
?>   
</head>

<body onLoad="performOnLoadFunctions();">
	
	


<div id="baseDiv">

<div id="logoDiv"><a href="/"><img src="/img/xmas.png" width="120" height="48" alt="EpikTube" border="0"></a></div>
<div id="taglineDiv"><img src="/img/tagline-xmas.png" alt="Broadcast Yourself"></div>
<div id="utilDiv">
<?php if(isset($session)) { ?>
    <strong>Hello, <a href="/my_profile"><?php echo htmlspecialchars($session['username']) ?></a></strong>
     &nbsp;
    <a href="/my_messages"><img src="/img/icon_mail_<? if($inbox > 0) { echo 'on'; } else { echo "off"; } ?>.gif" id="mailico" border="0"></a>&nbsp;(<a href="/my_messages"><?php echo htmlspecialchars($inbox) ?></a>)
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


		
		
	



