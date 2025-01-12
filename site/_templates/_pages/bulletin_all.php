<div style="padding-bottom: 15px;">
<table align="center" cellpadding="0" cellspacing="0" border="0">
<?php require_once("profileLinks.php"); ?>
</table>
</div>

<div>
<table width="875" cellpadding="0" cellspacing="0">	
	<tr>
		<td valign="top">
			<table class="bulletinReadTable" cellpadding="0" cellspacing="0" align="center">
<tr class="profileHeaders" style="background-color:999999">
					<td colspan="3">	<div style="float: left; padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px"><?php echo $profile['username'] ?>'s Bulletins</div>
	<div style="float: right; padding-right: 5px">

 </div></td>
				</tr>
				
				<tr class="rows">
				  <td class="bulletinRead" valign="top" width="160"><span class="profileTitles">From</span></td>
				  <td class="bulletinRead" valign="top" width="100"><span class="profileTitles">Date</span></td>
				  <td class="bulletinReadLast" valign="top" width="300"><span class="profileTitles">Subject</span></td>
				</tr>
				<?php if(!$bulletin) {	?>	
                <!--Begin only show this row if no postings-->
				<tr class="emptyBulletin">
					<td colspan="3" align="center"><span class="profileTitles">There are no bulletins.</span></td>
				</tr>
				<!--End only show this row if no postings-->
                <?php } else { ?>
				<?php $index = 0; foreach($bulletin as $thebull) { $index++; ?>
						<tr class="<?php if($index == count($bulletin)) { echo "rowsLineBottom"; } else { echo "rowsLine"; } ?>" width="20">

					  <td class="bulletinData" valign="top">
						<div align="center">
						<span class="bulletinReadRight">
							<span class="profileTitles">
								<a href="/profile?user=<?php echo htmlspecialchars($thebull['username']) ?>"><?php echo htmlspecialchars($thebull['username']) ?></a>
								<br/>
								<br/>
								<a href="/profile?user=<?php echo htmlspecialchars($thebull['username']) ?>"><img src="<?php echo getlatestVideo($thebull['uid']) ?>" class="commentsImg"/></a>
	
							</span>
						</span>
						</div>
					  </td>

					  <td class="bulletinData" valign="middle"><div align="center"><span class="profileTitles"><?php echo (new DateTime($thebull['posted']))->format('m.d.y'); ?></span></div></td>
                           
						<td style="padding-left: 5px; padding-right: 3px;" align="left" valign="middle">
						<span class="profileTitles">
						  	<?php if($thebull['vid'] != null) { ?>
									<a href="/watch?v=<?php echo $thebull['vid'] ?>"><img src="/get_still?video_id=<?php echo $thebull['vid'] ?>" class="commentsImg" style="margin-right:10px" align="left"></a>
								<?php } ?>	  
						    <a href="bulletin_read?id=<?php echo $thebull['id'] ?>"><?php echo htmlspecialchars($thebull['body']) ?></a>
						</span>
						</td>
					 </tr>	
                <?php } ?>
			    <?php } ?>
			    <?php if(isset($_SESSION['uid']) && $profile['uid'] == $session['uid']) { ?>
			     <tr class="bulletinPost">
			             <td colspan="3" align="center"><span class="profileTitles"><a href="bulletin_post">Broadcast a message</a> to all your friends!</span>
			             </td>
			     </tr>	                                     			
				<?php } ?>         
					 </div>
			<!-- end paging -->




					</div>
				</td></tr>
</table>