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
						<td><div class="moduleTitle">Search Playlists</div></td>
						<td align="right">
					<div style="font-weight: color: #444; margin-right: 5px;"><?php echo htmlspecialchars(trim($res_rlted)); ?> <b><?php if ($offs > 0) { echo htmlspecialchars(trim($offs)); } else { if ($vidocount > 0) { echo "1"; } else { echo "0"; } ; } ?>-<? if($vidocount > $ppv) { $nextynexty = $offs + $ppv; } else {$nextynexty = $vidocount; } echo htmlspecialchars($nextynexty); ?></b> of <b><?php                               echo $vidocount; ?></b></div>
						</td>
					</tr>
				</tbody></table>
				</div>
				<?php foreach($videos as $video) { ?>
               <div class="moduleEntry">
						<div class="moduleEntryTitle" style="margin-bottom: 5px;"><b>Playlist Name:</b> <a href="/view_play_list?p=<?php echo ($video['pid']); ?>"><?php echo htmlspecialchars($video['title']); ?></a>

						</div>
						<div class="moduleEntryDescription"><?php echo htmlspecialchars($video['description']); ?></div>
						<div class="moduleEntryDetails">Videos in Playlist: <?php echo videosinplaylist($video['pid']) ?></div>
				</div>
                <?php } ?> <!-- begin paging -->
<?php if($totalPages > $ppv) { ?>
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
    <a href="results.php?search=' . $real_search . '&search_type=search_playlists&page=' . $page-1 . '"> < Previous</a>';
    }
for ($i = $startPage; $i <= $endPage; $i++) {
    if ($i == $page) {
        echo '
        <span style="color: #444; background-color: #FFFFFF; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;">' . $i . '</span>';
    } else {
        echo '
        <span style="background-color: #CCC; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;"><a href="results?search=' . $real_search . '&search_type=search_playlists&page='. $page+1 .'">' . $i . '</a></span>';
    }
}
    
     if ($page < $totalPages) { 
  echo '
 <a href="results.php?search=' . $real_search . '&search_type=search_playlists&page=' . $page+1 . '">Next ></a>';     
   }  


    
    ?>

</div>
<?php } ?>
				<!-- end paging -->			
								
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