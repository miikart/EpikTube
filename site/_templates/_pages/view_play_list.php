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
						<td><div class="moduleTitle">PlayList Videos // <span style="text-transform: capitalize;"><?php echo htmlspecialchars($playlisting['title']) ?></span></div><td width="260" align="right">
					<div style="font-weight: bold; color: #444444; margin-right: 5px;">Videos <?php echo number_format($videos->rowCount()) ?>						
					</div>
					</td></td>
					
					</tr>
				</tbody></table>
				</div>
				<?php foreach($videos as $video) { ?>
			
              <div class="moduleEntry"> 
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tbody><tr valign="top">
							<td><a href="/watch?v=<?php echo $video['vid'] ?>&amp;feature=PlayList&amp;p=<?php echo $playlisting['pid'] ?>&amp;index=0"><img src="/get_still?video_id=<?php echo $video['vid'] ?>" class="moduleEntryThumb" width="120" height="90"></a></td>
							<td width="100%"><div class="moduleEntryTitle"><a href="/watch?v=<?php echo $video['vid'] ?>&amp;feature=PlayList&amp;p=<?php echo $playlisting['pid'] ?>&amp;index=0"><?php echo htmlspecialchars($video['title']) ?></a></div>
							<div class="moduleEntryDescription"><?php echo htmlspecialchars($video['description']) ?></div>
							<div class="moduleEntryTags">Tags // <?php foreach(explode(" ", $video['tags']) as $tag) { echo '
										<a href="/results.php?search='.htmlspecialchars($tag).'">'.htmlspecialchars($tag).'</a> : ';}?> 
							</div>
							<div class="moduleEntryDetails">Added: <?php echo timeAgo($video['uploaded']); ?> by <a href="/profile?user=copy"><?php echo $video['username']; ?></a></div>
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

						<strong>PlayList</strong>: <?php echo htmlspecialchars($playlisting['title']) ?> <br>
						<strong>Description</strong>: <span></span><br><?php echo htmlspecialchars($playlisting['description']) ?><br>
						<strong>Creator</strong> <a href="/profile?user=<?php echo $playlisting['username'] ?>"><?php echo $playlisting['username'] ?></a><br>
							<div><a href="/profile_play_list?user=<?php echo $playlisting['username'] ?>">more playlists by <?php echo $playlisting['username'] ?></a></div>
              <div watchdescription="">
                <div watchdescription=""><br>
				
                  <a href="http://www.epiktube.xyz/watch?v=<?php echo $first['vid'] ?>&amp;feature=PlayList&amp;p=<?php echo $playlisting['pid'] ?>&amp;index=0&amp;playnext=1"><img src="/img//play_playlistButton.gif" border="0" align="absmiddle"></a>&nbsp; <a href="http://www.epiktube.xyz/watch?v=<?php echo $first['vid'] ?>&amp;feature=PlayList&amp;p=<?php echo $playlisting['pid'] ?>&amp;index=0&amp;playnext=1">Play All Videos</a> 
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:share()"><img src="/img/emailButton.gif" border="0" align="absmiddle"></a>&nbsp; <a href="javascript:share()">Email PlayList</a><br>
                  <br>          
				  
                  PlayList/URL (Permalink):<br>
                  <input style="FONT-SIZE: 10px; WIDTH: 300px" onclick="javascript:document.linkForm.video_link.focus();document.linkForm.video_link.select();" readonly="readonly" value="http://www.epiktube.xyz/view_play_list?p=<?php echo $playlisting['pid'] ?>" name="video_link">
						<br/> <br/>			
									
									  Embeddable Player:<br/>  
									<input style="FONT-SIZE: 10px; WIDTH: 300px; TEXT-ALIGN: center" onclick="javascript:doc/ment.linkForm.video_play.focus();document.linkForm.video_play.select();" readonly value="<object width=&quot;530&quot; height=&quot;370&quot;><param name=&quot;movie&quot; value=&quot;http://www.epiktube.xyz/p/<?php echo $playlisting['pid'] ?>&quot;></param><embed src=&quot;http://www.epiktube.xyz/p/<?php echo $playlisting['pid'] ?>&quot; type=&quot;application/x-shockwave-flash&quot; width=&quot;530&quot; height=&quot;370&quot;></embed></object>" name="video_play"></span><span class="moduleFrameDetails">(Put this video on your website. Works on Friendster, eBay, Blogger, MySpace!)	
</div></div></td>
	</tr>
</tbody></table>