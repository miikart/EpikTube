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

        
        

                

                    <td><input type="submit" id="save" name="save" value="Update Settings"></td>
        </table>
    </form>
    
