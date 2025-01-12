<table width="45%" align="center" cellpadding="5" cellspacing="0" border="0">
         <tr align="center">
		 <td align="center" colspan="3">
                <a href="/my_profile.php">My Profile</a> | <span class="bold">My Email Preferences </span> | <a href="/my_settings.php" >My Site Visual Settings
            </td></tr>
            </table>
<div class="formTable">
    <form method="post" action="my_profile_email.php">
        <table cellpadding="5" width="700" cellspacing="0" border="0" align="center">
               <tr valign="top">
					<td colspan="2"><div class="highlight">Email Preferences</div><div class="tableSubTitleInfo">Here you can choose which types of emails you'd like to get from EpikTube.</div></td>
				</tr>
                <tr valign="top">
					<td><input type="checkbox" name="emailprefs_privatem" value="true" <? if($member['emailprefs_privatem'] == 1) { echo 'checked'; } ?>><label for="true">Email me on Private Messages</label></td>
                </tr>
                <tr valign="top">
					<td><input type="checkbox" name="emailprefs_vdocomments" value="true" <? if($member['emailprefs_vdocomments'] == 1) { echo 'checked'; } ?>><label for="true">Email me on Video Comments</label></td>
                </tr>
				<tr valign="top">
                    <td><input type="submit" id="save" name="save" value="Update Preferences"></td>
                </tr>
        </table>
    </form>
</div>