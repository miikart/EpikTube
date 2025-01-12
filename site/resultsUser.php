<?php
 $res_title = "User Search";
    $res_rlted = "Results";
$related_tags = [];
// I took like 6 hours modernizing this and improving pagination. Shocking, eh?
// WARNING: Code below is probably shit. I can't for sure say how it'd look to someone other than me, but I imagine would not be too beautiful.
// awful but works :) -copy
$start_time = microtime(true);
   if(isset($_REQUEST['search']) && $_REQUEST['search'] != null) {
   
   $search = $_REQUEST['search'] ;
    $real_search = htmlspecialchars(trim($_GET['search']));
    } else {
     $search = "uf3whzf932ßtg20fh0fh4h4hro3ro43roi43uoiru43oru4oru4ruou3our43urouo4ruu";   
    }
    if ($_REQUEST['search']) {
    $trimmed_search = trim($_REQUEST['search']);
 
    if ($trimmed_search == "") {
        $search = "uf3whzf932ßtg20fh0fh4h4hro3ro43roi43uoiru43oru4oru4ruou3our43urouo4ruu";
    }
}


  $vidocount = $conn->prepare("SELECT * FROM users WHERE username REGEXP ? AND termination = 0 ");
$vidocount->execute([$search]);
    $vidocount = $vidocount->rowCount();
    $ppv = 10;
     $totalPages = ceil($vidocount / $ppv);
   $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    if($totalPages != 0) {
if($page > $totalPages) {
    $page = $totalPages;
}
} else {
    $totalPages = 1;
}
$offs = ($page - 1) * $ppv;
   
$videos = $conn->prepare("SELECT * FROM users WHERE username REGEXP ? AND termination = 0 LIMIT $ppv OFFSET $offs");
$videos->execute([$search]);
  
   $totalPages = ceil($vidocount / $ppv);



?>

<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td style="padding-right: 15px;">
		
		<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
			<tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td>
				<div class="moduleTitleBar">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tbody><tr valign="top">
						<td><div class="moduleTitle">Search Users </div></td>
						<td align="right">
					<div style="font-weight: color: #444; margin-right: 5px;"><?php echo htmlspecialchars(trim($res_rlted)); ?> <b><?php if ($offs > 0) { echo htmlspecialchars(trim($offs)); } else { if ($vidocount > 0) { echo "1"; } else { echo "0"; } ; } ?>-<? if($vidocount > $ppv) { $nextynexty = $offs + $ppv; } else {$nextynexty = $vidocount; } echo htmlspecialchars($nextynexty); ?></b> of <b><?php                               echo $vidocount; ?></b></div>
						</td>
					</tr>
				</tbody></table>
				</div>
				<?php foreach($videos as $video) { ?>
                <div class="moduleEntry"> 
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tbody><tr valign="top">
							<td>
							<table cellpadding="0" cellspacing="0" border="0">
								<tbody><tr>
									<td><a href="profile?user=<?= htmlspecialchars($video['username']) ?>"><img src="<?php echo getlatestvideo($video['uid']); ?>" class="moduleEntryThumb" width="90" height="70"></a></td>
								</tr>
							</table>
					
							</td>
							<td width="100%"><div class="moduleEntryTitle" style="word-break: break-all;"><a href="profile?user=<?php echo $video['username']; ?>"><?php echo htmlspecialchars($video['username']); ?></a></div>
							<div class="moduleEntryDescription"><?php echo htmlspecialchars($video['about']) ?></div>
						
							<? if (!empty($video['country'])) { ?>
			<div class="moduleEntryDescription">
				<? echo htmlspecialchars(getCountryName($video['country'])) ?>
				</div>
				<? } ?>	
						
							<div class="moduleEntryDescription"><a href="profile_videos.php?user=<?= htmlspecialchars($video['username']) ?>">Videos</a> (<?php echo getpublicvideos($video['uid']); ?>) | <a href="profile_favorites.php?user=<?= htmlspecialchars($video['username']) ?>">Favorites</a> (<?php echo getfavoritecount($video['uid']); ?>) | <a href="profile_friends.php?user=<?= htmlspecialchars($video['username']) ?>">Friends</a> (<?php echo getfriendcount($video['uid']); ?>)</div>
								
	<nobr>
							</nobr>
		
							</td>
						</tr>
					</tbody></table>
				</div>
                <?php } ?> 
         
		<?php if($totalPages > 1) { ?>  
			     <!-- begin paging -->
			<div style="font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;">Result Page:
				
	<?php
      $maxButtons = 10;
$startPage = max(1, $page - floor(($maxButtons - 1) / 2));
$endPage = min($totalPages, $startPage + $maxButtons - 1);
if ($endPage - $startPage < $maxButtons - 1) {
    $startPage = max(1, $endPage - $maxButtons + 1);
}
 
    if (1 < $totalPages && $page !== 1) { 
    echo '
    <a href="results.php?search=' . $real_search . '&search_type=search_users&page=' . $page-1 . '"> < Previous</a>';
    }
for ($i = $startPage; $i <= $endPage; $i++) {
    if ($i == $page) {
        echo '
        <span style="color: #444; background-color: #FFFFFF; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;">' . $i . '</span>';
    } else {
        echo '
        <span style="background-color: #CCC; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;"><a href="results?search=' . $real_search . '&search_type=search_users&page='. $page+1 .'">' . $i . '</a></span>';
    }
}
    
     if ($page < $totalPages) { 
  echo '
 <a href="results.php?search=' . $real_search . '&search_type=search_users&page=' . $page+1 . '">Next ></a>';     
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
		</td>
		<td width="180">
<?php if(!isset($_SESSION['uid'])) { ?>
		<table width="180" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFEEBB" align="center">
			<tbody><tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="170">
					<div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;"><a href="signup">Create an Account</a></div>
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
		
		</td>
	</tr>
</table>



	
		</div>
		</td>
	</tr>
</table>

<?php 
require "needed/end.php";
?>

