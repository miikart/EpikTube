<table width="875" cellpadding="0" cellspacing="0">	
	<tr>
		<td valign="top">
			<div>&nbsp;</div>
			
			<table class="bulletinReadTable" cellpadding="0" cellspacing="0" align="center">
				<tr class="profileHeaders">
				  <td colspan="2">&nbsp;&nbsp;Bulletin Post </td>
				</tr>
				
				<tr class="rows">
				  <td class="bulletinRead" valign="top"><div align="center"><span class="profileTitles">From:</span></div></td>
				  <td class="bulletinReadRight"><span class="profileTitles"><a href="/profile?user=<?php echo $thebull['username'] ?>"><?php echo $thebull['username'] ?></a><br />
				    <br />
				</span></td>
			  </tr>
				<tr class="rows">
				  <td class="bulletinRead" valign="top"><div align="center"><span class="profileTitles">Date:</span></div></td>
				  <td class="bulletinReadRight"><span class="profileTitles"><?php echo (new DateTime($thebull['posted']))->format('F d, Y, h:i A'); ?>
</span></td>
			  </tr>
				<tr class="rows">
				  <td class="bulletinRead" valign="top"><div align="center"><span class="profileTitles">Subject:</span></div></td>
				  <td class="bulletinReadRight"><span class="profileTitles"><?php echo htmlspecialchars($thebull['body']) ?></span></td>
			  </tr>
				<tr class="rows">
				  <td width="111" class="bulletinReadBottom" valign="top"><div align="center"><span class="profileTitles">Body:</span></div></td>
				  <td width="447" valign="top">
								<?php if($thebull['vid'] != null) { ?>
									<a href="/watch?v=<?php echo $thebull['vid'] ?>"><img src="/get_still?video_id=<?php echo $thebull['vid'] ?>" class="commentsImg" style="margin-right:10px" align="left"></a>
								<?php } ?>	
										<div style="word-wrap: anywhere; width: 447px">
								<?php echo htmlspecialchars($thebull['title']) ?>
									</div>
						
				  </td>
				</tr>				
			</table>
			
			<br />
			<center>			
			</center>
			<div>&nbsp;</div>		
			</td>
    </tr>
</table>