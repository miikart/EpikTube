<?php require_once("needed/start.php");
alert("Groups are not done yet! they will be soon though.");
if(isset($_REQUEST['c'])) {
$channel = $conn->prepare("SELECT * FROM channels WHERE id = :c");
$channel->bindParam(":c", $_REQUEST['c']);
$channel->execute();
$channel = $channel->fetch();
if($channel) {
$channelc = $channel['id'];
}
} else {
$channel = false;
}
if(isset($_REQUEST['b'])) {
$_REQUEST['b'] = (string)$_REQUEST['b'];
} else {
$_REQUEST['b'] = null;
}
if(!($channel)) {
switch ($_REQUEST['b']) {
    case 'recent':
        $groupc = $conn->query("
            SELECT g.*
            FROM groups g
            JOIN users u ON g.uid = u.uid
            WHERE u.termination = 0 LIMIT 100 
        ")->rowCount();
        break;

    case 'users':
        $groupc = $conn->query("
            SELECT g.*, COUNT(gm.gid) AS member_count
            FROM groups g
            JOIN users u ON g.uid = u.uid
            LEFT JOIN group_members gm ON g.gid = gm.gid
            LEFT JOIN users um ON gm.uid = um.uid
            WHERE u.termination = 0 AND um.termination = 0
            GROUP BY g.gid LIMIT 100
        ")->rowCount();
        break;

    case 'videos':
        $groupc = $conn->query("
               SELECT g.*, COUNT(gv.vid) AS video_count
            FROM groups g
            JOIN users u ON g.uid = u.uid
            LEFT JOIN group_videos gv ON g.gid = gv.gid
            JOIN videos v ON gv.vid = v.vid
            JOIN users u2 ON v.uid = u2.uid
            WHERE u.termination = 0 AND u2.termination = 0 AND v.converted = 1
            GROUP BY g.gid
            ORDER BY video_count DESC
            LIMIT 100
        ")->rowCount();
        break;

    default:
        $groupc = $conn->query("
            SELECT g.*
            FROM groups g
            JOIN users u ON g.uid = u.uid
            WHERE u.termination = 0 AND g.featured = 1 LIMIT 100
        ")->rowCount();
        break;
}


} else {
$groupc = $conn->query("SELECT * FROM groups g 
                         JOIN users u ON g.uid = u.uid  
                         WHERE (g.ch1 = $channelc OR g.ch2 = $channelc OR g.ch3 = $channelc) 
                         AND u.termination = 0 
                         LIMIT 100")->rowCount();
}
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = max(1, $page);
$ppv = 10;
$totalPages = ceil($groupc / $ppv);
if($groupc != 0) {
if($page > $totalPages) {
    $page = $totalPages;
}
} else {
    $totalPages = 1;
}
$offs = ($page - 1) * $ppv;

if(!($channel)) {
switch ($_REQUEST['b']) {
    case 'recent':
        $groupingthegroup = $conn->query("
            SELECT g.*
            FROM groups g
            JOIN users u ON g.uid = u.uid
            WHERE u.termination = 0
            ORDER BY g.when DESC
            LIMIT $ppv OFFSET $offs
        ")->fetchAll();
        break;

    case 'users':
        $groupingthegroup = $conn->query("
            SELECT g.*, COUNT(gm.gid) AS member_count
            FROM groups g
            JOIN users u ON g.uid = u.uid
            LEFT JOIN group_members gm ON g.gid = gm.gid
            LEFT JOIN users um ON gm.uid = um.uid
            WHERE u.termination = 0 AND um.termination = 0 
            GROUP BY g.gid
            ORDER BY member_count DESC
            LIMIT $ppv OFFSET $offs
        ")->fetchAll();
        break;

    case 'videos':
        $groupingthegroup = $conn->query("
            SELECT g.*, COUNT(gv.vid) AS video_count
            FROM groups g
            JOIN users u ON g.uid = u.uid
            LEFT JOIN group_videos gv ON g.gid = gv.gid
            JOIN videos v ON gv.vid = v.vid
            JOIN users u2 ON v.uid = u2.uid
            WHERE u.termination = 0 AND u2.termination = 0 AND v.converted = 1
            GROUP BY g.gid
            ORDER BY video_count DESC
            LIMIT $ppv OFFSET $offs
        ")->fetchAll();
        break;

    default:
        $groupingthegroup = $conn->query("
            SELECT g.*
            FROM groups g
            JOIN users u ON g.uid = u.uid
            WHERE u.termination = 0 AND g.featured = 1
            ORDER BY g.when DESC 
            LIMIT $ppv OFFSET $offs
        ")->fetchAll();
        break;
}

} else {
$groupingthegroup = $conn->query("SELECT * FROM groups g 
                         JOIN users u ON g.uid = u.uid  
                         WHERE (g.ch1 = $channelc OR g.ch2 = $channelc OR g.ch3 = $channelc) 
                         AND u.termination = 0 
                         LIMIT $ppv OFFSET $offs")->fetchAll();
}
?>
<table width="875" cellpadding="5" cellspacing="0" border="0">
	<tr>
		
	
	<!--Begin Left Side Group List Table-->
	<td width="710" valign="top" align="left">
	
	<!--Begin Gray Table-->
	<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
		<tr>
			<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
			<td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
			<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
		</tr>
		<tr>
			<td><img src="img/pixel.gif" width="5" height="1"></td>
			<td width="700">	
				<div class="watchTitleBar">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr valign="top">
							<td><div class="moduleTitle">
									<?php if(!($channel)) { ?>
										<?php
				switch($_REQUEST['b']) {
					case 'recent':
						echo "Recently Added";
						break;
					case 'users':
						echo "Most Members";
						break;
					case 'videos':
						echo "Most Videos";
						break;
				    case 'topics':
						echo "Most Topics";
						break;
					default:
						echo "Featured Groups";
				}
				?>	
			<?php } else { ?>
			<?php echo htmlspecialchars($channel['name']); ?>
			<?php } ?>
				//
								</div>
							</td>
								<td align="right" colspan="1">
		<div style="font-weight: bold; color: #444444; margin-right: 5px;">
			Groups <?php if ($offs > 0) { echo htmlspecialchars(trim($offs)); } else { echo "1"; } ?>-<? $nextynexty = $offs + $ppv; echo htmlspecialchars($nextynexty); ?> of <?php echo number_format($groupc) ?>	
		</tr>
					</table>
				</div>
		<?php foreach($groupingthegroup as $group) { ?>		
	<div class="moduleEntry"> 
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr valign="top">
				<td><a href="/group/<?php echo trim(htmlspecialchars($group['url'])) ?>">
					<img  class="moduleEntryThumb" width="120" height="90" src="<?php if($group['public'] == 1) { 
	echo ("/get_still"); } else { echo ("/img/private_groups.jpg"); } ?>"/>
					</a>
				</td>
				<td width="100%">
					<div class="moduleEntryTitle"><a href="/group/<?php echo trim(htmlspecialchars($group['url'])) ?>"><?php echo htmlspecialchars($group['title']) ?></a></div>	
	<div class="moduleEntryDescription" style="overflow: flow; width:480px">
	<?php echo nl2br(htmlspecialchars($group['description'])); ?>
	</div>
	<div class="moduleEntryTags">Tags // <?php $tags = explode(" ", $group['tags']); $thelast = end($tags); foreach ($tags as $tag) {echo htmlspecialchars($tag); if ($tag !== $thelast) { echo ', '; } } ?></div>
	
	<div class="moduleEntryTags">Status // <?php if($group['public'] == 1) { 
	echo ("Public"); } else { echo ("Private -Invite Only"); } ?></div>
	<div class="moduleEntryTags">Created // <?php echo date("F j, Y, h:i A", strtotime($group['when'])); ?>
</div>
	<div class="moduleEntryDescription"><a href="/groups_members?name=<?php echo trim(htmlspecialchars($group['url'])) ?>"><?php echo getgroupmembers($group['gid']) ?> Members</a> | <a href="/groups_videos?name=<?php echo trim(htmlspecialchars($group['title'])) ?>">0 Videos</a> | <a href="/group/<?php echo trim(htmlspecialchars($group['title'])) ?>">0 Topics</a></div>
	</td>
			</tr>
		</table>
	</div>

<?php } ?>

	



		

				
							<?php if($totalPages > 1) { ?>  
<!-- begin paging -->
<div style="font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;">
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
         <span style="color: #CCC; padding: 1px 4px 1px 4px; border: 1px solid #999; margin-right: 5px;"><a href="groups_main?page=' . $i . '&s=' . $browse_sort . '">' . $i . '</a></span>';
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
	<!--End Gray Table-->	
					
	</td>
	<!--End Left Side Group List Table-->


	<!--Begin Right Side Group Navigation Links-->
	<td align="left" valign="top" style="padding-left: 8px;">
		<div style="padding-bottom: 8px;">
		<span style="font-size: 14px; font-weight: bold; color: #CC6633;">Browse Groups</span>
		</div>
		<div class="groupSideNavDiv"><a href="/groups_main?b=featured">Featured</a></div>
		<div class="groupSideNavDiv"><a href="/groups_main?b=recent">Recently Added</a></div>
		<div class="groupSideNavDiv"><a href="/groups_main?b=users">Most Members</a></div>
		<div class="groupSideNavDiv"><a href="/groups_main?b=videos">Most Videos</a></div>
		<div class="groupSideNavDiv"><a href="/groups_main?b=topics">Most Topics</a></div>
		
		<div style="padding-top: 24px; padding-bottom: 8px;">
		<span style="font-size: 14px; font-weight: bold; color: #CC6633;">Groups By Channel</span>
		</div>
				
			<?php foreach($channelgroup as $imgroupingEVERYWHERE) { ?>	    
				   <div class="groupSideNavDiv">
				    <a href="/groups_main?c=<?php echo $imgroupingEVERYWHERE['id'] ?>"><?php echo htmlspecialchars($imgroupingEVERYWHERE['name']) ?></a> <span class="smallText">(<?php echo getgroupcountchannel($imgroupingEVERYWHERE['id']) ?>)</span></div>
		<?php } ?>

		<div style="padding-top: 12px;">
		<input type="submit" name="creategroup" value="Create a Group" onclick="window.location.href='/groups_create'">
		</div>
	</td>
	<!--End Right Side Group Navigation Links-->
		
	</tr>
</table>
<?php require_once("needed/end.php") ?>