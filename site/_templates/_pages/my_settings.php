<table width="45%" align="center" cellpadding="5" cellspacing="0" border="0">
         <tr align="center">
		 <td align="center" colspan="3">
                 <a href="/my_profile.php" >My Profile</a> | <a href="/my_profile_email.php" >My Email Preferences</a> |  <span class="bold">My Site Visual Settings</span> 
            </td></tr>
            </table>
         <div class="formTable">
    <form method="post" action="my_settings">
        <table cellpadding="5" width="700" cellspacing="0" border="0" align="center">
               <tr valign="top">
					
        
        <tr valign="top">
					<td colspan="2"><div class="tableSubTitle">Site Settings</div> <div class="tableSubTitleInfo">This will only affect you.</div></td>
   <tr valign="top">
					<td align="right"><span class="label">Branding:</span> </td>
					<td>
						<select name="branding">
							<option value="1" <?php echo ($member['branding'] == 1) ? "selected" : ""; ?>>EpikTube</option>
							<option value="2" <?php echo ($member['branding'] == 2) ? "selected" : ""; ?>>YouTube</option>
						</select>
					</td>
                </tr>
         <tr>
             </tr>
             <tr valign="top">
					<td colspan="2"><div class="tableSubTitle">Video Page Settings</div><div class="tableSubTitleInfo">Past uploads before 1/4/2025 will not count toward this and will load in 360p*.</div></td>
				</tr>
                   <td width="200" valign="top" align="right"><span class="label">Force Video Quality:</span></td>
		<td>

                <input type="radio" name="videosetting" value="920p"   <?php echo ($member['forcevidquality'] == "920p") ?  'checked="true"' : ""; ?>>
                <label for="1">920p</label><br>
                <input type="radio" name="videosetting" value="360p" <?php echo ($member['forcevidquality'] == "360p") ?  'checked="true"' : ""; ?>>
                <label for="2">360p</label><br>
		</td>
        </tr>
        <tr>
        
        

                

                    <td><input type="submit" id="save" name="save" value="Update Settings"></td>
                </tr>
        </table>
    </form>
    