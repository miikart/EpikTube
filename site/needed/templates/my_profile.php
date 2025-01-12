<table width="45%" align="center" cellpadding="5" cellspacing="0" border="0">
         <tr align="center">
		 <td align="center" colspan="3">
                <span class="bold">My Profile</span> | <a href="/my_profile_email.php" >My Email Preferences</a>
            </td></tr>
            </table>
<div class="formTable">
    <form method="post" action="my_profile">
        <table cellpadding="5" width="700" cellspacing="0" border="0" align="center">
               <tr valign="top">
					<td colspan="2"><div class="tableSubTitle"><span style="float:right; font-size: 12px; font-weight: normal;"><a href="/user/<?= htmlspecialchars($member['username']) ?>">View Your Profile Page</a></span>Account Information</div><div class="tableSubTitleInfo">* Indicates required field. <span style="float:right; font-size: 12px;"><a style="font-weight: bold; color:#f22b33;" href="my_account_delete.php">Delete Your Account</a></span></div></td>
				</tr>
                <tr valign="top">
					<td align="right"><span class="label">User Name:</span></td>
					<td><?= htmlspecialchars($member['username']) ?></td>
                </tr>
                <tr valign="top">
                <td align="right"><span class="label">Email:</span></td>
				<td><input type="text" size="20" maxlength="500" name="email" value="<?php echo (!empty($member['email'])) ? htmlspecialchars($member['email']) : ""; ?>">*</td>
                </tr>
				<tr valign="top">
					<td colspan="2"><div class="tableSubTitle">Personal Information</div></td>
				</tr>
				<tr valign="top">
					<td align="right"><span class="label">First Name</span></td>
					<td><input type="text" size="20" maxlength="500" name="name" value="<?php echo (!empty($member['name'])) ? htmlspecialchars($member['name']) : ""; ?>"></td>
                </tr>
			<tr valign="top">
					<td align="right"><span class="label">Last Name</span></td>
					<td><input type="text" size="20" maxlength="500" name="last_n" value=""></td>
                </tr>
			<tr valign="top">
    <td align="right"><span class="label">Birthday:</span></td>
    <td>
        <select name="birthday_mon">
            <option value="---" <?php if (!$member['birthday'] || strtotime($member['birthday']) == strtotime('1969-12-31')) echo "selected"; ?>>---</option>
            <option value="1" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '01') echo "selected"; ?>>Jan</option>
            <option value="2" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '02') echo "selected"; ?>>Feb</option>
            <option value="3" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '03') echo "selected"; ?>>Mar</option>
            <option value="4" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '04') echo "selected"; ?>>Apr</option>
            <option value="5" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '05') echo "selected"; ?>>May</option>
            <option value="6" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '06') echo "selected"; ?>>Jun</option>
            <option value="7" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '07') echo "selected"; ?>>Jul</option>
            <option value="8" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '08') echo "selected"; ?>>Aug</option>
            <option value="9" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '09') echo "selected"; ?>>Sep</option>
            <option value="10" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '10') echo "selected"; ?>>Oct</option>
            <option value="11" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '11') echo "selected"; ?>>Nov</option>
            <option value="12" <?php if (date('m', strtotime($member['birthday'] ?? '')) === '12' && date('Y', strtotime($member['birthday'] ?? '')) != '1969') echo "selected"; ?>>Dec</option>
        </select>

        <select name="birthday_day">
            <option value="---" <?php if (!$member['birthday'] || strtotime($member['birthday']) == strtotime('1969-12-31')) echo "selected"; ?>>---</option>
            <?php
            for ($day = 1; $day <= 31; $day++) {
                $selected = ($member['birthday'] && date('d', strtotime($member['birthday'])) == $day && date('Y', strtotime($member['birthday'])) != '1969') ? "selected" : "";
                echo '<option ' . $selected . '>' . $day . '</option>';
            }
            ?>
        </select>

        <select name="birthday_yr">
            <option value="---" <?php if (!$member['birthday'] || strtotime($member['birthday']) == strtotime('1969-12-31')) echo "selected"; ?>>---</option>
            <?php
            $selectedYear = date('Y', strtotime($member['birthday'] ?? ''));
            $years = range(1900, 2010);
            foreach ($years as $year) {
                $selected = ($year == $selectedYear && $selectedYear != '1969') ? "selected" : "";
                echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
            }
            ?>
        </select>
 
				</td>
                </tr>
				<tr valign="top">
					<td align="right"><span class="label">Gender:</span></td>
					<td>
						<select name="gender">
							<option value="0" <?php echo ($member['gender'] == 0) ? "selected" : ""; ?>>Prefer not to say</option>
							<option value="1" <?php echo ($member['gender'] == 1) ? "selected" : ""; ?>>Male</option>
							<option value="2" <?php echo ($member['gender'] == 2) ? "selected" : ""; ?>>Female</option>
                            <option value="3" <?php echo ($member['gender'] == 3) ? "selected" : ""; ?>>Other</option>
						</select>
					</td>
                </tr>
				<tr valign="top">
					<td align="right"><span class="label">Relationship Status:</span></td>
					<td>
						<select name="relationship">
							<option value="0" <?php echo ($member['relationship'] == 0) ? "selected" : ""; ?>>Prefer not to say</option>
							<option value="1" <?php echo ($member['relationship'] == 1) ? "selected" : ""; ?>>Single</option>
							<option value="2" <?php echo ($member['relationship'] == 2) ? "selected" : ""; ?>>Taken</option>
						</select>
					</td>
                </tr>
				<tr valign="top">
					<td align="right" valign="top"><span class="label">About Me:</span><br><span class="formFieldInfo">(Describe Yourself)</span></td>
					<td><textarea maxlength="500" name="about" rows="5" cols="45"><?php echo (!empty($member['about'])) ? htmlspecialchars($member['about']) : ""; ?></textarea></td>
                </tr>
				<tr valign="top">
					<td align="right"><span class="label">Personal Website:</span></td>
					<td><input type="text" size="20" maxlength="500" name="website" value="<?php echo (!empty($member['website'])) ? htmlspecialchars($member['website']) : ""; ?>"></td>
                </tr>
			 <td valign="top" align="right"><span class="label">Profile Icon:</span></td>
		<td>

                <input type="radio" name="profile_icon" value="0" <?php if($member['profilePictureSetting'] == 0) { echo 'checked="true"'; } ?>> 
                <label for="1"> Use the last video I uploaded for my profile picture.</label><br>
                <input type="radio" name="profile_icon" value="1" <?php if($member['profilePictureSetting'] == 1) { echo 'checked="true"'; } ?>>
                <label for="2">I'll select the profile picture for "My Videos".</label><br>
		</td>
        </tr>
        <tr>
                   <td width="200" valign="top" align="right"><span class="label">Profile Comments:</span></td>
		<td>

                <input type="radio" name="profile_comm" value="1"  checked="true" > 
                <label for="1">Allow comments to be added to your profile.</label><br>
                <input type="radio" name="profile_comm" value="2" >
                <label for="2">Don't allow comments to be added to your profile.</label><br>
		</td>
        </tr>
        <tr>
                   <td width="200" valign="top" align="right"><span class="label">Profile Bulletins:</span></td>
		<td>

                <input type="radio" name="profile_bull" value="1"  checked="true" > 
                <label for="1">Receive bulletins from my friends.</label><br>
                <input type="radio" name="profile_bull" value="2" >
                <label for="2">Do not receive any bulletins.</label><br>
		</td>
				<tr valign="top">
					<td colspan="2"><br><div class="tableSubTitle">Location Information</div></td>
				</tr>
				<tr valign="top">
					<td align="right"><span class="label">Hometown:</span></td>
					<td><input type="text" size="50" maxlength="500" name="hometown" value="<?php echo (!empty($member['hometown'])) ? htmlspecialchars($member['hometown']) : ""; ?>"></td>
                </tr>
				<tr valign="top">
					<td align="right"><span class="label">Current City:</span></td>
					<td><input type="text" size="50" maxlength="500" name="city" value="<?php echo (!empty($member['city'])) ? htmlspecialchars($member['city']) : ""; ?>"></td>
                </tr>
			
				<tr valign="top">
					<td align="right"><span class="label">Current Country:</span></td>
					<td><?php echo '<select name="country">';
foreach ($_COUNTRIES as $code => $name) {
    echo '<option value="' . $code . '"';
    echo ($member['country'] == $code) ? ' selected' : '';
    echo '>' . $name . '</option>';
}
echo '</select>';?></td>
               
               
                </tr>
				 <tr valign="top">
					<td colspan="2"><div class="tableSubTitle">Select A Theme</div><div class="tableSubTitleInfo">Select a preferred color theme for your profile.</div></td>
				</tr>
              		</tbody></table>
               <table>
				<tbody><tr align="center">
				<td>
    <b style="color: #2b405b;">Iceberg Blue</b><br>
    <img src="/img/blue_selection.gif"><br><br>
    <input type="radio" name="profile_theme" value="blue" <?php if ($member['profileColor'] == 'blue') echo 'checked="true"'; ?>>
</td>
<td>
    <b style="color: #666666;">Classic</b><br>
    <img src="/img/classic_selection.gif"><br><br>
    <input type="radio" name="profile_theme" value="classic" <?php if ($member['profileColor'] == 'classic') echo 'checked="true"'; ?>>
</td>
<td>
    <b style="color: #006699;">Acid Wash</b><br>
    <img src="/img/cyan_selection.gif"><br><br>
    <input type="radio" name="profile_theme" value="cyan" <?php if ($member['profileColor'] == 'cyan') echo 'checked="true"'; ?>>
</td>
<td>
    <b style="color: #3a3a3a;">Storm</b><br>
    <img src="/img/gray_selection.gif"><br><br>
    <input type="radio" name="profile_theme" value="gray" <?php if ($member['profileColor'] == 'gray') echo 'checked="true"'; ?>>
</td>
<td>
    <b style="color: #234900;">Forest Green</b><br>
    <img src="/img/green_selection.gif"><br><br>
    <input type="radio" name="profile_theme" value="green" <?php if ($member['profileColor'] == 'green') echo 'checked="true"'; ?>>
</td>
<td>
    <b style="color: #e1600f;">Orange A Peel</b><br>
    <img src="/img/orange_selection.gif"><br><br>
    <input type="radio" name="profile_theme" value="orange" <?php if ($member['profileColor'] == 'orange') echo 'checked="true"'; ?>>
</td>
<td>
    <b style="color: #cc2550;">Pretty in Pink</b><br>
    <img src="/img/pink_selection.gif"><br><br>
    <input type="radio" name="profile_theme" value="pink" <?php if ($member['profileColor'] == 'pink') echo 'checked="true"'; ?>>
</td>
<td>
    <b style="color: #402061;">Purple Haze</b><br>
    <img src="/img/purple_selection.gif"><br><br>
    <input type="radio" name="profile_theme" value="purple" <?php if ($member['profileColor'] == 'purple') echo 'checked="true"'; ?>>
</td>
<td>
    <b style="color: #5d1719;">Ruby Red</b><br>
    <img src="/img/red_selection.gif"><br><br>
    <input type="radio" name="profile_theme" value="red" <?php if ($member['profileColor'] == 'red') echo 'checked="true"'; ?>>
</td>

				</tr>
				</tbody></table>
		
			
				</tr>
				<table width="100%" cellspacing="0" cellpadding="5" border="0" align="left">
				<tr valign="top">
					<td colspan="2"><br><div class="tableSubTitle">Random Information</div><div class="tableSubTitleInfo">Separate items with commas.</div></td>
                    
				</tr>
				<tr valign="top">
					<td align="right"><span class="label">Occupations:</span></td>
					<td><input maxlength="500" size="40" name="occupations" value="<?php echo (!empty($member['occupations'])) ? htmlspecialchars($member['occupations']) : ""; ?>"></td>
                </tr>
				<tr valign="top">
					<td align="right"><span class="label">Companies:</span></td>
					<td><input maxlength="500" size="40" name="companies" value="<?php echo (!empty($member['companies'])) ? htmlspecialchars($member['companies']) : ""; ?>"></td>
                </tr>
				<tr valign="top">
					<td align="right"><span class="label">Schools:</span></td>
					<td><input maxlength="500" size="40" name="schools" value="<?php echo (!empty($member['schools'])) ? htmlspecialchars($member['schools']) : ""; ?>"></td>
                </tr>
				<tr valign="top">
					<td align="right"><span class="label">Interests & Hobbies:</span></td>
					<td><textarea maxlength="500" name="hobbies" rows="5" cols="45"><?php echo (!empty($member['hobbies'])) ? htmlspecialchars($member['hobbies']) : ""; ?></textarea></td>
                </tr>
				<tr valign="top">
					<td align="right"><span class="label">Favorite Movies & Shows:</span></td>
					<td><textarea maxlength="500" name="fav_media" rows="5" cols="45"><?php echo (!empty($member['fav_media'])) ? htmlspecialchars($member['fav_media']) : ""; ?></textarea></td>
                </tr>
				<tr valign="top">
					<td align="right"><span class="label">Favorite Music:</span></td>
					<td><textarea maxlength="500" name="music" rows="5" cols="45"><?php echo (!empty($member['music'])) ? htmlspecialchars($member['music']) : ""; ?></textarea></td>
                </tr>
				<tr valign="top">
					<td align="right"><span class="label">Favorite Books:</span></td>
					<td><textarea maxlength="500" name="books" rows="5" cols="45"><?php echo (!empty($member['books'])) ? htmlspecialchars($member['books']) : ""; ?></textarea></td>
                </tr>
				<tr valign="top">
                    <td></td>
                    <td><input type="submit" id="save" name="save" value="Update Profile"></td>
                </tr>
        </table>
    </form>
</div>