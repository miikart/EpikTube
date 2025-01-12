<script>
function UploadHandler()
{
	var upload_button = document.uploader.upload;

    var fileInput = document.getElementById("fileToUpload");
    
    var go_ahead = 1;

    if (fileInput.files.length === 0) {
        var go_ahead = 0;
        alert("It looks like you didn't choose any file.");
    }
    if (go_ahead === 1) {
    document.getElementById('uploadBuffer').style.display = '';    
	upload_button.disabled='true';
	return true;
    } else {
    upload_button.value='Try Again';
    return false; // Make sure it doesn't process the request
    }
}
</script>

	<div class="tableSubTitle">Video Upload (Step 2 of 2)</div>
		<table width="100%" cellpadding="5" cellspacing="0" border="0">
			<form method="post" action="my_videos_post" enctype="multipart/form-data" id="uploader" name="uploader" onsubmit="return UploadHandler();">

<input type="hidden" name="field_upload_title" value="<?php echo htmlspecialchars($_POST["field_upload_title"]); ?>" hidden>
<input type="hidden" name="field_upload_description" value="<?php echo htmlspecialchars($_POST["field_upload_description"]); ?>" hidden>
<input type="hidden" name="field_upload_tags" value="<?php echo htmlspecialchars($_POST["field_upload_tags"]); ?>" hidden>

<? foreach ($checked_channels as $index => $channel) {
    $channel = str_replace("ch", "", $channel);
    $qq = $conn->prepare("SELECT * FROM channels WHERE id = :a");
    $qq->bindParam(':a', $channel);
    $qq->execute();
    $ImSoSmart = $qq->rowCount();
    if($ImSoSmart) {
    echo '<input type="hidden" name="field_upload_ch'.$index.'" value="'.$channel.'" hidden>';
    }  } ?><div style="display: none">
	<tr>
		<td width="200" align="right" valign="top"><span class="label">File:</span></td>
		<td>
		<div width="595" height="20" cellpadding="0" border="0" bgcolor="#E5ECF9" class="formHighlight">
			<input type="file" style="margin-bottom: 3px" id="fileToUpload" name="fileToUpload" accept="video/mp4,video/x-m4v,video/*"><br>
			<span class="formHighlightText"><p><b>Max file size: 100 MB, Max length: 10 minutes.</b></p><p><b>Do not upload copyrighted, obscene or any other material which violates EpikTube's Terms of Use. </b>&nbsp;By clicking "Upload Video", you are representing that this video does not violate EpikTube's terms of use and that you own copyrights in this video or have express permission from the copyright owners to upload it.</b></span>
		</div>
</td>
</tr>
	<tr>
		<td width="200" align="right" valign="top"><span class="label">Broadcast:</span></td>
		<td>

                <input type="radio" name="public" value="1" checked>
                <label for="1"><strong>Public</strong>: Share your video with the world! (Reccomended)</label><br>
                <input type="radio" name="public" value="2">
                <label for="2"><strong>Private</strong>: Only viewable by you and the people you specify.</label><br>
		</td>
</table>
<br>
<div style="margin-left: 220px">
    <h3>Do not upload any TV shows, music videos, music concerts, or commercials without permission unless they consist entirely of content you created yourself.</h3>
	<br><br>
	<input type="submit" value="Upload Video" name="upload" id="upload"><br><br><div id="uploadBuffer" style="display:none;"><img src="/img/LoadingGraphic.gif"><h1 style="display:inline;vertical-align: bottom;padding: 4px;">Uploading...</h1></div><br><br><br><br><b>PLEASE BE PATIENT, THIS MAY TAKE SEVERAL MINUTES. <br> ONCE COMPLETED, YOU WILL SEE A CONFIRMATION MESSAGE.</b><br><br>
</div>

</form>
		</table>
</div>