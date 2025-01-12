<style>.vadio {
  width: 448px;
  height: 382px;
  background-color: black;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  text-align: center;
  border: none;
}
</style>
<div class="tableSubTitle">Thank You</div>
<span class="success">Your video was successfully added!</span>
<p>Your video is currently being processed and will be available to view in a few minutes.</p>
Want to upload more videos? <a href="/my_videos_upload.php">Click here</a>

<p>
<img src="/img/MoreOptionsTab.gif" />
<div class="tableSubTitle">Share your video (Optional):</div>
Use the share manager application below to easily share your video with friends, family, and other contacts.<br>If that's not your thing, you can copy and paste the video url (permalink) into an e-mail.
<table width="760" border="0" cellspacing="0" cellpadding="0">
    <tbody><tr>
      <td width="380" valign="middle">
        <div align="left"><div class="vadio">
  <p>The share manager is currently unavailable.</p>
</div></td>
      <td width="400" valign="top" align="center">
        <div style="font-size: 11px; font-weight: bold; color: #CC6600; padding: 5px 0px 5px 0px;">Video URL (Permalink): <span style="color: #000;">E-mail or link it!</span></div>
				<div style="font-size: 11px; padding-bottom: 15px;">
				<input name="video_link" type="text" onclick="javascript:document.linkForm.video_link.focus();document.linkForm.video_link.select();" value="https://www.epiktube.xyz/?v=<?php echo htmlspecialchars($_GET['v']); ?>" size="50" readonly="true" style="font-size: 10px; text-align: center;">

                <div style="font-size: 11px; font-weight: bold; color: #CC6600; padding: 5px 0px 5px 0px;">Embed your video: <span style="color: #000;">Put this video on your Web site!<br> Copy and paste the code below to embed the video.</span></div>
				<div style="font-size: 11px;">
                <textarea name="video_play" rows="4" cols="33" onclick="javascript:document.linkForm.video_play.focus();document.linkForm.video_play.select();" readonly="">&lt;iframe src=&quot;//www.epiktube.xyz/v/<?php echo htmlspecialchars($_GET['v']); ?>&quot; width=&quot;460&quot; height=&quot;357&quot; allowfullscreen scrolling=&quot;off&quot; frameborder=&quot;0&quot;&gt;&lt;/iframe&gt;
</textarea><p>
                        <div align="left"> <span class="standoutLabel">Tip:</span> Put EpikTube videos on <img src="/img/BloggerIcon.gif" width="61" height="21" align="absmiddle">&nbsp;&nbsp; <img src="/img/EbayIcon.gif" width="51" height="21">&nbsp;&nbsp; <img src="/img/MySpaceIcon.gif" width="81" height="21"> </div><p><strong>To watch your video now, please <a href="/?v=<?php echo htmlspecialchars($_GET['v']); ?>">go here</a>.</strong>

 

				</div></td>
    </tr>
  </tbody></table>
  <p><div class="tableSubTitle">Date & Address Details</div>
	<div class="pageTable">
		<table width="100%" cellpadding="5" cellspacing="0" border="0">
			<tbody>
				
				<tr>
					<td width="200" align="right"><span class="label">Address Recorded:</span><br><span class="formFieldInfo">(Optional)</span></td>
					<td><input type="text" size="30" maxlength="160" name="field_upload_address" autocomplete="on"><br></td>
				</tr>
                </table><span style="margin-left: 214px" class="formFieldInfo">Examples: "165 University Ave, Palto Alto, CA" "New York City, NY" "Kyoto"</span><div class="pageTable">
		<table width="100%" cellpadding="5" cellspacing="0" border="0">
				<tr>
					<td width="200" align="right"><span class="label">Country:</span><br><span class="formFieldInfo">(Optional)</span></td>
					<td><?php echo '<select name="field_upload_country" tabindex="5">';
                        foreach ($_COUNTRIES as $code => $name) {
                        echo '<option>' . $name . '</option>';
                        }
                    echo '</select>';?></td>
                    
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Continue ->"></td></form>
				</tr>
				<tr>
				</tr>
			</tbody>
		</table>
	</div>
</div>