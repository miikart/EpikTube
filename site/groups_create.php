<?php require_once("needed/start.php"); force_login();
if($_SERVER['REQUEST_METHOD'] == "POST") {
alert("not done yet");
}


?>
<div class="tableSubTitle">Create a Group</div>
<table width="100%" cellpadding="5" cellspacing="0" border="0">
<form method="POST" action="">
	<tbody><tr>
		<td align="right"><strong>Group Name:</strong></td>
		<td><input type="text" name="group_name" size="30"></td>
	</tr>
	<tr>
		<td align="right"><strong>Tags:</strong></td>
		<td><input type="text" name="group_tags" size="30"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><span class="formFieldInfo"><b>Enter one or more keywords, separated by spaces.</b></span>
		<br><span class="formFieldInfo">It helps to use relevant keywords so that others can find your group!</span></td>
	</tr>
	<tr>
		<td align="right" valign="top"><span class="label">Description:</span></td>
		<td>
			<textarea name="video_description" maxlength="500" style="width:295px;resize:none" rows="3"></textarea><br><br>
			<b>Choose a unique group name URL:</b><br>
			http://www.epiktube.xyz/groups_layout?name=<input type="text" name="group_url"><br>
			<span class="formFieldInfo">Enter 3-16 characters with no spaces (such as "yourgroup") that will<br>become part of your group's web address. Please note, the group URL<br> you pick is permanent and can not be changed.</span>
		</td>
	</tr>
	<tr>
		<td width="200" align="right" valign="top"><span class="label">Group Channels:</span></td>
		<td align="left" style="float: left" valign="top">
			<input type="checkbox" name="channels[]" value="ch1"><label for="ch1">Arts &amp; Animation</label><br>
			<input type="checkbox" name="channels[]" value="ch2"><label for="ch2">Autos &amp; Vehicles</label><br>
			<input type="checkbox" name="channels[]" value="ch3"><label for="ch3">Education &amp; Instructional</label><br>
			<input type="checkbox" name="channels[]" value="ch4"><label for="ch4">Events &amp; Weddings</label><br>
			<input type="checkbox" name="channels[]" value="ch5"><label for="ch5">Entertainment</label><br>
			<input type="checkbox" name="channels[]" value="ch6"><label for="ch6">Family</label><br>
			<input type="checkbox" name="channels[]" value="ch7"><label for="ch7">For Sale &amp; Auctions</label><br>
			<input type="checkbox" name="channels[]" value="ch8"><label for="ch8">Hobbies &amp; Interests</label><br>
			<input type="checkbox" name="channels[]" value="ch9"><label for="ch9">Humor</label><br>
			<input type="checkbox" name="channels[]" value="ch10"><label for="ch10">Music</label><br>
			<input type="checkbox" name="channels[]" value="ch11"><label for="ch11">News &amp; Politics</label><br>
		</td>
		<td align="left" style="float: left" valign="top"> 
			<input type="checkbox" name="channels[]" value="ch12"><label for="ch12">Odd &amp; Outrageous</label><br>
			<input type="checkbox" name="channels[]" value="ch13"><label for="ch13">People</label><br>
			<input type="checkbox" name="channels[]" value="ch14"><label for="ch14">Personals &amp; Dating</label><br>
			<input type="checkbox" name="channels[]" value="ch15"><label for="ch15">Pets &amp; Animals</label><br>
			<input type="checkbox" name="channels[]" value="ch16"><label for="ch16">Science &amp; Technology</label><br>
			<input type="checkbox" name="channels[]" value="ch17"><label for="ch17">Sports</label><br>
			<input type="checkbox" name="channels[]" value="ch18"><label for="ch18">Short Movies</label><br>
			<input type="checkbox" name="channels[]" value="ch19"><label for="ch19">Travel &amp; Places</label><br>
			<input type="checkbox" name="channels[]" value="ch20"><label for="ch20">Video Games</label><br>
			<input type="checkbox" name="channels[]" value="ch21"><label for="ch21">Videoblogging</label>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><span class="formFieldInfo"><b>Select between one to three channels that best describe your group.</b></span>
		<br><span class="formFieldInfo">It helps to use relevant channels so that others can find your group!</span></td>
	</tr>
	<tr>
		<td width="195" align="right" valign="top"><span class="label">Type:</span></td>
		<td>
			<input checked="" type="radio" name="public" value="0"><span>Public, anyone can join<br>
			<input type="radio" name="public" value="1"><span>Private, only the people you invite can join<br>
		</span></td>
	</tr>
	<tr>
		<td width="195" align="right" valign="top"><span class="label">Video uploads:</span></td>
		<td>
			<input checked="" type="radio" name="uploads" value="0"><span>Post videos inmediately<br>
			<input type="radio" name="uploads" value="1"><span>Require videos to be approved<br>
		</span></td>
	</tr>
	<tr>
		<td width="195" align="right" valign="top"><span class="label">Group Icon:</span></td>
		<td>
			<input checked="" type="radio" name="icon" value="0"><span>Automatically set group icon to last uploaded video<br>
			<input type="radio" name="icon" value="1"><span>Let owner pick the video as group icon<br>
		</span></span></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="submit" value="Submit"></td>
	</tr>
</tbody></table>
</form>
<?php require_once("needed/end.php"); ?>