<?php $thethingylolol = $conn->query('SELECT VERSION()')->fetchColumn(); $php = phpversion();
?> 
<div id="footerDiv">
	<div id="footerUtilDiv">
	<a href="/blog">Our Blog</a> | <a href="/explore_epiktube">Explore EpikTube</a> | <a href="/t/about">About Us</a> |
	<a href="/t/help">Help</a> | <a href="/t/safety">Safety Tips</a> | <a href="/dev">Developers</a> |
	<a href="/t/terms">Terms of Use</a> | <a href="/t/privacy">Privacy Policy</a> | <a href="/t/jobs">Jobs</a>
	</div>
	<div id="copyrightDiv">
	Reminder for "miimaker" to change this text. | <span id="footerRSSspan">PHP: <?php echo $php ?> | DB: mysqlnd <?php echo $thethingylolol;?> | <a href="/rssls"><img src="/img/rss.gif" style="vertical-align: text-top;" width="36" height="14" border="0"></a></span>
	</div>
</div>
<form name="logoutForm" method="post" action="/index">
<input type="hidden" name="action_logout" value="1">
</form>




<div id="sheet" style="position:fixed; top:0px; visibility:hidden; width:100%; text-align:center;">
	<table width="100%">
		<tr>
			<td align="center">
				<div id="sheetContent" style="filter:alpha(opacity=50); filter: opacity(50%); -moz-opacity:0.5; opacity:0.5; border: 1px solid black; background-color:#cccccc; width:40%; text-align:left;"></div>
			</td>
		</tr>
	</table>
</div>