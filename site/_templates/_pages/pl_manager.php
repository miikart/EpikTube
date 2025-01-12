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
						<td><div class="moduleTitle">My Playlists</span></div></td>
					
					</tr>
				</tbody></table>
				</div>
				<?php foreach($playlists as $playlist) { ?>
				<?php
			$aaa = $conn->prepare(
	"SELECT v.*, u.* 
    FROM videos v
    JOIN playlists p ON v.vid = p.vid
    JOIN users u ON v.uid = u.uid  
    WHERE p.pid = ?
      AND v.converted = 1
   
      AND u.termination = 0
    AND p.action = 'add'
ORDER BY p.created_at DESC
"
);
$aaa->execute([$playlist['pid']]);
$aaa = $aaa->rowCount();
				?>
               <div class="moduleEntry">
						<div class="moduleEntryTitle" style="margin-bottom: 5px;"><b>Playlist Name:</b> <a href="/view_play_list?p=<?php echo ($playlist['pid']); ?>"><?php echo htmlspecialchars($playlist['title']); ?></a>
                      (<a href="/my_playlists_edit?p=<?php echo ($playlist['pid']); ?>">edit</a>) (<a href="/my_playlists_delete?p=<?php echo ($playlist['pid']); ?>">delete</a>)
						</div>
						<div class="moduleEntryDescription"><?php echo htmlspecialchars($playlist['description']); ?></div>
						<div class="moduleEntryDetails">Videos in Playlist: <?php echo number_format($aaa) ?></div>
				</div>
                <?php } ?> <!-- begin paging -->
<?php if($collectmypages > $ppv) { ?>
<div style="font-size: 13px; font-weight: bold; color: #444; text-align: right; padding: 5px 0px 5px 0px;">Result Page:

   			<?php
      $maxButtons = 10;
$startPage = max(1, $page - floor(($maxButtons - 1) / 2));
$endPage = min($totalPages, $startPage + $maxButtons - 1);
if ($endPage - $startPage < $maxButtons - 1) {
    $startPage = max(1, $endPage - $maxButtons + 1);
}

for ($i = $startPage; $i <= $endPage; $i++) {
    if ($i == $page) {
        echo '
        <span style="color: #444; background-color: #FFFFFF; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;">' . $i . '</span>';
    } else {
        echo '
        <span style="background-color: #CCC; padding: 1px 4px; border: 1px solid #999; margin-right: 5px;"><a href="profile_play_list.php?user=' . $profile['username'] . '&page='. $page+1 .'">' . $i . '</a></span>';
    }
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
       
	
				
		</td>
		
	</tr>
</table>