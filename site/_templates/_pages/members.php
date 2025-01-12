<table width="875" align="left">
	<tr>
		<td align="left" valign="top" width="740">	
		<table width="740" align="left" cellpadding="0" cellspacing="0" border="0" bgcolor="#CCCCCC">
	<tr>
		<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
		<td><img src="img/pixel.gif" width="1" height="5"></td>
		<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
	</tr>
	<tr>
		<td><img src="img/pixel.gif" width="5" height="1"></td>
		<td width="740-20">
			<div class="moduleTitleBar">
					<div style="font-size: 14px; font-weight: bold; margin-bottom: 8px;">
						New Members
					</div>
			</div>
	<?php if($videos->rowCount() != 0)  { ?>
			<div class="moduleFeatured" style="padding-bottom: 0px"> 
						
						<table width="680" cellpadding="0" cellspacing="0" border="0">
		
				<?php $i = 0;
       
        foreach($videos->fetchAll() as $video) {   $i = $i + 1; if($i == 1) { echo '<tr valign="top">'; } ?>
		<td width="20%" align="center">
			<a href="/profile?user=<?php echo $video['username']; ?>"><img src="<?php echo getlatestvideo($video['uid']); ?>" width="120" height="90" class="moduleFeaturedThumb"></a>
			<div class="moduleFeaturedTitle"><a href="/profile?user=<?php echo $video['username']; ?>"><?php echo $video['username']; ?></a></div>
			<div class="moduleFeaturedDetails">
				Signed Up: <?php echo timeAgo($video['joined']); ?><br>
				Videos: <?php echo getpublicvideos($video['uid']); ?> | Viewed: <?php echo number_format($video['profile_views']) ?>
			</div>
		</td><? if($i == 5) { echo '</tr>'; $i = 0; } } ?>
	</table>
		</div>
	<?php } ?>
		</td>
		<td><img src="img/pixel.gif" width="5" height="1"></td>
	</tr>
	<tr>
		<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
		<td><img src="img/pixel.gif" width="1" height="5"></td>
		<td><img src="img/box_login_br.gif" width="5" height="5"></td>
	</tr>
</table>


		</div>
		</td>
<td width="120" valign="top" style="padding-left: 12px;">

  <?php if(!isset($_SESSION['uid'])) { ?>
<a href="/signup"><img src="img/upload_banner.jpg" border="0"></a>
<?php } ?>	

		
		</td>
	</tr>
</table>