<div style="padding-bottom: 15px;">
<table align="center" cellpadding="0" cellspacing="0" border="0">
<?php require_once("profileLinks.php"); ?>
</table>

</div>
	<table class="commentPostTable" style="border-color:<?php echo $titlecolor ?>" cellpadding="0" cellspacing="0" align="center">
				<tbody><tr class="profileHeaders" style="background-color:999999">
					<td colspan="3">	<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px"><?php echo $profile['username'] ?>'s Comments</div>
	<div style="float: right; padding-right: 5px">

 </div></td>
				</tr>
<?php $index = 0; foreach($comment as $shitter) { $index++; ?>

		
			<tr class="<?php if($index == count($comment)) { echo "rowsLineBottom"; } else { echo "rowsLine"; } ?>">
                <td class="leftBg" style="padding-right: 10px" width="123" valign="top" align="center">
            <span class="profileTitles"><a href="/profile?user=<?php echo htmlspecialchars($shitter['username']) ?>"><?php echo htmlspecialchars($shitter['username']) ?></a></span>
            <br>
            <br>
            <a href="/profile?user=<?php echo htmlspecialchars($shitter['username']) ?>"><img src="<?php echo getlatestVideo($shitter['uid']) ?>" class="commentsImg"></a></td>
                <td colspan="2" style="padding-right: 5px;" valign="top">
            <span class="profileTitles"><?php echo retroDate($shitter['time']) ?></span> <br>
            <br><div style="word-wrap: anywhere; width: 400px"><?php echo htmlspecialchars($shitter['message'] )?></div></td></tr>
	
			<?php } ?>
				<tr class="commentsMsg">
						<td colspan="3" align="center"><span class="bulletinPost" style="padding-left: 5px; padding-right: 5px"><a href="/profile_comment_post?user=<?php echo htmlspecialchars($profile['username']); ?>">Leave a comment</a> for <?php echo htmlspecialchars($profile['username']); ?>. The comments you post will be visible to anyone who views <?php echo htmlspecialchars($profile['username']); ?>'s profile. <br></span></td>
				</tr>

				

			</tbody></table>