<h3>The video you are about to delete is "<?php echo htmlspecialchars($info['title']) ?>".</h3>
<form action="" method="POST">
<input name="vid" value="<?php echo $_REQUEST['video_id'] ?>" style="display:none">   
<center>
<textarea name="why" style="width:100%" placeholder="Reason for deleting this video."></textarea>  
<br><br>
<button>Delete!</button>
</center>
</form>