	<div class="tableSubTitle">Video Upload (Step 1 of 2)</div>
		<table width="100%" cellpadding="5" cellspacing="0" border="0">
			<form method="post" action="my_videos_upload_2">
			<input type="hidden" name="field_command" value="upload_video">
			<tbody>
				<tr>
					<td width="200" align="right"><span class="label">Title:</span></td>
					<td><input type="text" size="30" maxlength="60" name="field_upload_title" autocomplete="on"></td>
				</tr>
				<tr>
					<td align="right" valign="top"><span class="label">Description:</span></td>
					<td><textarea name="field_upload_description" cols="40" rows="4"></textarea></td>
				</tr>
				<tr>
					<td width="200" align="right"><span class="label">Tags:</span></td>
					<td><input type="text" size="30" maxlength="60" name="field_upload_tags" autocomplete="on"></td>
                    
				</tr>
				<tr align="left">
					<td></td>
					<td><div class="formFieldInfo"><strong>Enter one or more tags, separated
by spaces.</strong> <br>Tags are simply keywords used to describe
your video so they are easily searched and organized. For example,
if you have a surfing video, you might tag it: surfing beach
waves.<br></div></td>
				</tr>
                <tr>
					<td width="200" align="right" valign="top"><span class="label">Video Channels:</span></td><td align="left" style="float: left" valign="top">
					<? $index = 0; foreach ($_VCHANE as $channel) {
 				if ($index == 11) { echo "</td><td style=\"float: left\" align=\"left\" valign=\"top\">"; } elseif ($index != 0){ echo "<br>"; }
    echo "<input type=\"checkbox\" name=\"chlist[]\" value=\"ch".$channel['id']."\"><label for=\"ch".$channel['id']."\">".$channel['name']."</label>\n";
   $index++; } ?>

    
                    
                    </td>
                    
				</tr>
			<tr>
		<td>&nbsp;</td>
		<td><span class="formFieldInfo"><b>Select between one to three channels that best describe your video.</b></span>
		<br><span class="formFieldInfo">It helps to use relevant channels so that others can find your video!</span></td>
	</tr>
			
                <tr>
                    <td></td>
                    <td><input type="submit" id="continue" name="continue" value="Continue ->"></td>
                </tr>
</table>