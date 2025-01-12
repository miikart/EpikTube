<form name="comment_profile" id="new_comment_profile" method="post">
<table width="875" cellspacing="0" cellpadding="0">	
	<tbody><tr>
		<td valign="top">
			<div>&nbsp;</div>
			
			<table class="bulletinReadTable" cellspacing="0" cellpadding="0" align="center">
				<tbody><tr class="profileHeaders">
					<td colspan="3">	<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">Broadcast a New Bulletin</div>
	<div style="float: right; padding-right: 5px">

 </div></td>
				</tr>
				
				<tr class="rows">
				  <td class="bulletinRead" valign="top"><div align="center"><span class="profileTitles">From:</span></div></td>
				  <td class="bulletinReadRight"><span class="profileTitles"><img src="<?php echo getlatestVideo($_SESSION['uid']) ?>" class="aboutImg"><br><a href="/profile?user=<?php echo $session['username'] ?>"><?php echo $session['username'] ?></a><br>
				    <br>
				</span></td>
			  </tr>
				<tr class="rows">
				  <td class="bulletinRead" valign="top"><div align="center"><span class="profileTitles">To:</span></div></td>
				  <td class="bulletinReadRight"><span class="profileTitles">All of your EpikTube friends!</span></td>
			  </tr>
					<tr class="rows">
				  <td class="bulletinReadBottom" width="111" valign="top"><div align="center"><span class="profileTitles">Subject:</span></div></td>
				  <td width="447" valign="top">
				 
				 <input type="text" size="30" maxlength="25" name="field_bulletin_subject" autocomplete="on"></textarea></td>
			</tr>
				<tr class="rows">
				  <td class="bulletinReadBottom" width="111" valign="top"><div align="center"><span class="profileTitles">Attach a video:</span></div></td>
				  <td width="447" valign="top">
				<select name="field_reference_video">
		<?php if($videos_of_you !== false) { ?>
<option value="">- Your Videos -</option>
			<?php foreach($videos_of_you as $myvideo) { ?><option value="<?php echo htmlspecialchars($myvideo['vid']);?>"><?php echo htmlspecialchars($myvideo['title']);?></option> 				<?php } } ?><option value="">- Your Favorite Videos -</option>			<?php if($favorites_of_you !== false) { ?>
			<?php foreach($favorites_of_you as $myfavorites) { ?><option value="<?php echo htmlspecialchars($myfavorites['vid']);?>"><?php echo htmlspecialchars($myfavorites['title']);?></option> 				<?php } } ?>	</select></textarea>
			</tr>	
				<tr class="rows">
				  <td class="bulletinReadBottom" width="111" valign="top"><div align="center"><span class="profileTitles">Body:</span></div></td>
				  <td width="447" valign="top">
				 
				 <textarea tabindex="2" maxlength="500" name="field_bulletin_content" cols="55" rows="30"></textarea>
			</tr>
			
			<tr class="rows">
				  <td class="bulletinReadBottom" width="111" valign="top"><div align="center"><span class="profileTitles">Verification:</span></div></td>
				  <td width="447" valign="top">
				 
			        <div id="verificationField" name="verificationField" style="float:left;">
						<input size="20" tabindex="16" name="response" maxlength="5" value="" type="text">&nbsp;&nbsp;<br><span class="smallText">Enter the text in the image &nbsp;</span></div>
                                        <div id="verificationImage" name="verificationImage" style="float:left;margin-left:1px;"><a href="#" onclick="document.verificationImg.src='/cimg?c=<?php echo $captchaid ?>&amp;'+Math.random();return false"><img name="verificationImg" src="/cimg?c=<?php echo $captchaid ?>" border="0" align="texttop"></a> 
						<div class="smallText" style="text-align:center;">
							<a href="#" onclick="document.verificationImg.src='/cimg?c=<?php echo $captchaid ?>&amp;'+Math.random();return false">Can't read?</a>
						</div>
					</div>
                                        <input type="hidden" name="challenge" value="<?php echo $captchaid ?>"></td>
			</tr>
				
			</form>
						
				  </td>
				</tr>				
			</tbody></table>
			
			<br>
			<center>
				
				<input type="submit" value="Submit Bulletin">
				
			
			</center></form>
			<div>&nbsp;</div>		
			</td>
    </tr>
</tbody></table>