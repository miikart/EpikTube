<table width="100%" align="center" bgcolor="#333333" cellpadding="6" cellspacing="3" border="0">
	<div class="tableSubTitle">Video Details <span style="float:right; font-size: 12px; font-weight: normal;"><a href="/my_videos.php">Back to "My Videos"</a></span></div>
		<table width="100%" cellpadding="5" cellspacing="0" border="0">
			<form method="post">
			<input type="hidden" name="field_command" value="update_video">
			<tbody>
				<tr>
					<td width="200" align="right"><span class="label">Title:</span></td>
					<td><input type="text" size="30" maxlength="100" name="field_upload_title" value="<?php echo htmlspecialchars($video['title']); ?>"></td>
				</tr>
				<tr>
					<td align="right" valign="top"><span class="label">Description:</span></td>
					<td><textarea name="field_upload_description" cols="40" rows="4"><?php echo htmlspecialchars($video['description']); ?></textarea></td>
				</tr>
				<tr>
					<td width="200" align="right"><span class="label">Tags:</span></td>
					<td><input type="text" size="30" maxlength="60" name="field_upload_tags" value="<?php echo htmlspecialchars($video['tags']); ?>"></td>
                 
				</tr>
                <tr align="left">
					<td></td>
					<td><div class="formFieldInfo"><strong>Enter one or more tags, separated
by spaces.</strong> <br>Tags are simply keywords used to describe
your video so they are easily searched and organized. For example,
if you have a surfing video, you might tag it: surfing beach
waves.<br></div></td>
				</tr>
                </table>
            <table width="100%" cellpadding="5" cellspacing="0" border="0">
            <tr>
					<td width="200" align="right" valign="top"><span class="label">Video Channels:</span></td><td align="left" style="float: left" valign="top">
				<? $index = 0; foreach ($_VCHANE as $channel) {
 			unset($isset);
 			if($video['ch1'] == $channel['id'] || $video['ch2'] == $channel['id'] || $video['ch3'] == $channel['id']) { $isset = 'checked'; } else { $isset = ""; }
 				if ($index == 11) { echo "</td><td style=\"float: left\" align=\"left\" valign=\"top\">"; } elseif ($index != 0){ echo "<br>"; }
    echo "<input type=\"checkbox\" name=\"chlist[]\" " . $isset . " id=\"" . $channel['id'] . "\" value=\"" . $channel['id'] . "\"><label for=\"ch" . $channel['id'] . "\">" . $channel['name'] . "</label>\n";
     $index++; } ?>

                    
                    </td>
                    
				</tr>
          </table>  <p><div class="tableSubTitle">Date & Address Details</div>
		<table width="100%" cellpadding="5" cellspacing="0" border="0">
			<tbody>
				<td width="200" align="right"><span class="label">Date Recorded:</span><br><span class="formFieldInfo">(Optional)</span></td>
					<td><select name="addr_month" tabindex="13">
					<?php if ($video['recorddate'] == null || empty($video['recorddate'])) { ?>
						<option value="---" selected>---</option>
							<option value="1"> Jan  </option>
							<option value="2"> Feb  </option>
							<option value="3"> Mar  </option>
							<option value="4"> Apr  </option>
							<option value="5"> May  </option>
							<option value="6"> Jun  </option>
							<option value="7"> Jul  </option>
							<option value="8"> Aug  </option>
							<option value="9"> Sep  </option>
							<option value="10"> Oct  </option>
							<option value="11"> Nov  </option>
							<option value="12"> Dec  </option>
					<?php } else { ?>
						<option value="---"<?php if ($video['recorddate'] == null || empty($video['recorddate'])) {echo " selected";} ?>>---</option>
							<option value="1"<?php if (date('m', strtotime($video['recorddate'])) === '01') {echo " selected";} ?>> Jan  </option>
							<option value="2"<?php if (date('m', strtotime($video['recorddate'])) === '02') {echo " selected";} ?>> Feb  </option>
							<option value="3"<?php if (date('m', strtotime($video['recorddate'])) === '03') {echo " selected";} ?>> Mar  </option>
							<option value="4"<?php if (date('m', strtotime($video['recorddate'])) === '04') {echo " selected";} ?>> Apr  </option>
							<option value="5"<?php if (date('m', strtotime($video['recorddate'])) === '05') {echo " selected";} ?>> May  </option>
							<option value="6"<?php if (date('m', strtotime($video['recorddate'])) === '06') {echo " selected";} ?>> Jun  </option>
							<option value="7"<?php if (date('m', strtotime($video['recorddate'])) === '07') {echo " selected";} ?>> Jul  </option>
							<option value="8"<?php if (date('m', strtotime($video['recorddate'])) === '08') {echo " selected";} ?>> Aug  </option>
							<option value="9"<?php if (date('m', strtotime($video['recorddate'])) === '09') {echo " selected";} ?>> Sep  </option>
							<option value="10"<?php if (date('m', strtotime($video['recorddate'])) === '10') {echo " selected";} ?>> Oct  </option>
							<option value="11"<?php if (date('m', strtotime($video['recorddate'])) === '11') {echo " selected";} ?>> Nov  </option>
							<option value="12"<?php if (date('m', strtotime($video['recorddate'])) === '12') {echo " selected";} ?>> Dec  </option>
					<? } ?>
					</select>
					<select name="addr_day" tabindex="14">
					<?php if ($video['recorddate'] == null || empty($video['recorddate'])) { ?>
						<option value="---" selected>---</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
							<option>16</option>
							<option>17</option>
							<option>18</option>
							<option>19</option>
							<option>20</option>
							<option>21</option>
							<option>22</option>
							<option>23</option>
							<option>24</option>
							<option>25</option>
							<option>26</option>
							<option>27</option>
							<option>28</option>
							<option>29</option>
							<option>30</option>
							<option>31</option>
					<?php } else { ?>
						<option value="---"<?php if ($video['recorddate'] == null || empty($video['recorddate'])) {echo " selected";} ?>>---</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '1') {echo "selected";} ?>>1</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '2') {echo "selected";} ?>>2</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '3') {echo "selected";} ?>>3</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '4') {echo "selected";} ?>>4</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '5') {echo "selected";} ?>>5</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '6') {echo "selected";} ?>>6</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '7') {echo "selected";} ?>>7</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '8') {echo "selected";} ?>>8</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '9') {echo "selected";} ?>>9</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '10') {echo "selected";} ?>>10</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '11') {echo "selected";} ?>>11</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '12') {echo "selected";} ?>>12</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '13') {echo "selected";} ?>>13</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '14') {echo "selected";} ?>>14</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '15') {echo "selected";} ?>>15</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '16') {echo "selected";} ?>>16</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '17') {echo "selected";} ?>>17</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '18') {echo "selected";} ?>>18</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '19') {echo "selected";} ?>>19</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '20') {echo "selected";} ?>>20</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '21') {echo "selected";} ?>>21</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '22') {echo "selected";} ?>>22</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '23') {echo "selected";} ?>>23</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '24') {echo "selected";} ?>>24</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '25') {echo "selected";} ?>>25</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '26') {echo "selected";} ?>>26</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '27') {echo "selected";} ?>>27</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '28') {echo "selected";} ?>>28</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '29') {echo "selected";} ?>>29</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '30') {echo "selected";} ?>>30</option>
							<option <?php if (date('d', strtotime($video['recorddate'])) === '31') {echo "selected";} ?>>31</option>
					<? } ?>
					</select>					
					<select name="addr_yr" tabindex="15">
						<option value="---"<?php if ($video['recorddate'] == null || empty($video['recorddate'])) {echo " selected";} ?>>---</option>
							<?php
							if ($video['recorddate'] == null || empty($video['recorddate'])) {
								$selectedYear = null;
							} else {
								$selectedYear = date('Y', strtotime($video['recorddate']));
							}
							$years = range(date("Y"), 1900);
							foreach ($years as $year) {
								$selected = ($year == $selectedYear) ? " selected" : "";
								echo '<option' . $selected . '>' . $year . '</option>';
							}
							?>
					</select></td>
					</tr>
					<td width="200" align="right"><span class="label">Address Recorded:</span><br><span class="formFieldInfo">(Optional)</span></td>
					<td><input type="text" size="30" maxlength="160" name="field_upload_address" value="<?php if($video['address'] != null) { ?><?php echo htmlspecialchars(trim($video['address'])); ?><?php } ?>"></td>
				</tr>
                </table><span style="margin-left: 214px" class="formFieldInfo">It helps to use relevant keywords so that others can find your video!</span>
		<table width="100%" cellpadding="5" cellspacing="0" border="0">
				<tr>
					<td width="200" align="right"><span class="label">Country:</span><br><span class="formFieldInfo">(Optional)</span></td>
					<td><?php echo '<select name="field_upload_country" tabindex="5">';
                        foreach ($_COUNTRIES as $code => $name) {
                        echo '<option ';
                        echo ($video['addrcountry'] == $name) ? ' selected' : '';
                        echo '>' . $name . '</option>';
                        }
                    echo '</select>';?></td>
                    </tr></table>
		<table width="100%" cellpadding="5" cellspacing="0" border="0"><div class="tableSubTitle">Sharing:</div><tr>
        <tr>
                   <td width="200" align="right" valign="top"><span class="label">Video URL:</span></td>
        <td>
									<input name="video_link" type="text" onClick="document.linkForm_<?php echo htmlspecialchars($video['vid']); ?>.video_link.focus();document.linkForm_<?php echo htmlspecialchars($video['vid']); ?>.video_link.select();" value="http://www.epiktube.xyz/?v=<?php echo htmlspecialchars($video['vid']); ?>" size="50" readonly="true" style="font-size: 10px; text-align: center;">

        </td>
        </tr>
        <tr>
                   <td width="200" align="right" valign="top"><span class="label">Broadcast:</span></td>
		<td>

                <input type="radio" name="private" value="1" <?php if ($video['privacy'] == 1) { echo 'checked="true"'; } ?>> 
                <label for="1"><strong>Public</strong>: Share your video with the world! (Reccomended)</label><br>
                <input type="radio" name="private" value="2" <?php if ($video['privacy'] == 2) { echo 'checked="true"'; } ?>>
                <label for="2"><strong>Private</strong>: Only viewable by you and the people you specify.</label><br>
		</td>
        </tr>
        <tr>
                   <td width="200" align="right" valign="top"><span class="label">Allow Comments:</span></td>
		<td>

                <input type="radio" name="comms_allow" value="1" <?php if ($video['comms_allow'] == 1) { echo 'checked="true"'; } ?>> 
                <label for="1"><strong>Yes</strong>: Allow comments to be added to your video.</label><br>
                <input type="radio" name="comms_allow" value="0" <?php if ($video['comms_allow'] == 0) { echo 'checked="true"'; } ?>>
                <label for="0"><strong>No</strong>: Disallow comments to be added to your video.</label><br>
	  <input type="radio" name="comms_allow" value="3" <?php if ($video['comms_allow'] == 3) { echo 'checked="true"'; } ?>>
                <label for="0"><strong>Kinda</strong>: Approval required for all comments added to this video.</label><br>
		</td>
        </tr>
        <tr>
                   <td width="200" align="right" valign="top"><span class="label">Allow Ratings:</span></td>
		<td>

                <input type="radio" name="allow_votes" value="1" <?php if ($video['allow_votes'] == 1) { echo 'checked="true"'; } ?>> 
                <label for="1"><strong>Yes</strong>: Allow people to rate your video.</label><br>
                <input type="radio" name="allow_votes" value="0" <?php if ($video['allow_votes'] == 0) { echo 'checked="true"'; } ?>>
                <label for="0"><strong>No</strong>: Disallow people to rate your video.</label><br><span class="formFieldInfo">If you disable ratings, this video will no longer be eligible to appear on the list of "Top Rated" videos.</span>
		</td>
        </tr>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Update Video"></td></form>
				</tr>
				<tr>
				</tr>
			</tbody>
		</table>