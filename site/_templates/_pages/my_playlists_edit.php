<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<div class="tableSubTitle">Edit PlayList<span style="float:right; font-size: 12px; font-weight: normal;">
<span style="float:right; font-size: 12px; font-weight: normal;"><a href="/pl_manager">Back to "My Playlists"</a></span>		

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
						<td><div class="moduleTitle">PlayList Videos // <span style="text-transform: capitalize;"><?php echo htmlspecialchars($playlistinfo['title']) ?></span></div><td width="260" align="right">
					<div style="font-weight: bold; color: #444444; margin-right: 5px;">Videos <?php echo number_format($playlist->rowCount()) ?>						
					</div>
					</td></td>
					
					</tr>
				</tbody></table>
				</div>
				<?php foreach($playlist as $video) { ?>
              <div class="moduleEntry"> 
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tbody><tr valign="top">
							<td>
							<a href="watch?v=6beLvIOXp40"><img src="/get_still?video_id=<?php echo htmlspecialchars($video['vid']); ?>" class="moduleEntryThumb" width="120" height="90"></a><p>
							</p><table width="130" cellpadding="0" cellspacing="0" border="0" class="tableFavRemove">
								<tbody><tr align="center">
									<td width="100%">
										<form method="POST" onsubmit="return confirm('Do you want to remove this video from your playlist?');">
											    <input type="hidden" name="video_id" value="<?php echo htmlspecialchars($video['vid']); ?>">
                                                <input type="hidden" name="current_form" value="remove">
											    <input type="submit" value="Remove Video">
										</form>
									</td>
								</tr>
							</tbody></table>
						</td>
							<td width="100%"><div class="moduleEntryTitle"><a href="/watch?v=<?php echo $video['vid'] ?>&amp;feature=PlayList&amp;p=<?php echo $playlistinfo['pid'] ?>&amp;index=0"><?php echo htmlspecialchars($video['title']) ?></a></div>
							<div class="moduleEntryDescription"><?php echo htmlspecialchars($video['description']) ?></div>
							<div class="moduleEntryTags">Tags // <?php foreach(explode(" ", $video['tags']) as $tag) { echo '
										<a href="/results.php?search='.htmlspecialchars($tag).'">'.htmlspecialchars($tag).'</a> : ';}?> 
							</div>
							<div class="moduleEntryDetails">Added: <?php echo timeAgo($video['uploaded']); ?> by <a href="/profile?user=<?php echo $video['username']; ?>"><?php echo $video['username']; ?></a></div>
						<div class="moduleEntryDetails">Runtime: <?php echo gmdate("i:s", $video['time']); ?> | Views: <?php echo number_format($video['views']); ?> | Comments: <?php echo getcommentcount($video['vid']) ?></div> 

							</td>
		
						</tr>
					</tbody></table>
				</div>		
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
		
	<td width="15">&nbsp;</td>
		
		<td width="280">
		
<br>	

<form action="" method="post">
<strong>PlayList</strong>: 
<input type="text" name="playlist_title" style="width:272px" maxlength="60" value="<?php echo htmlspecialchars($playlistinfo['title']) ?>" /><br>

<strong>Description</strong>: <br>
<textarea name="playlist_description" style="width:272px; height: 100px;" maxlength="1000"><?php echo htmlspecialchars($playlistinfo['description']) ?></textarea><br>
<strong>Video List:</strong>
<input type="text" style="width:272px" name="playlist_list" value="<?php foreach($playlistlistlist as $video) { ?><?php echo $video['vid'] ?> <?php } ?>
"><br>

<span class="formFieldInfo"><b>Enter video ID's, separated by spaces.</b></span>


					</div>
             <br> <br>
				<center>
                
    <input type="hidden" name="current_form" value="info">
    <button type="submit">
        Update PlayList
    </button>
</form>
				
				
					</center>			
                  <br>          
				  
      
					
</div></div></td>
	</tr>
</tbody></table>